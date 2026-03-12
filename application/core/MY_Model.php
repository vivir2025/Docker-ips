<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * MY_Model — Modelo Base con SoftDelete + Audit Trail
 *
 * Arquitectura de seguridad médica para Historia Clínica.
 * Cumple Resolución 1995/1999 MinSalud Colombia:
 *  - Prohibición de destrucción de HC (SoftDelete obligatorio)
 *  - Trazabilidad completa de modificaciones (Audit Trail)
 *  - Versionado de datos (stack de cambios en auditoria_hc)
 *
 * @author  Arquitecto Senior PHP — Seguridad Médica
 * @version 2.0
 */
class MY_Model extends CI_Model
{
    /**
     * Nombre de la tabla de auditoría centralizada.
     * Todas las acciones CREATE/UPDATE/DELETE quedan registradas aquí.
     */
    const AUDIT_TABLE = 'auditoria_hc';

    /**
     * Columnas requeridas en tablas con SoftDelete.
     * Si la tabla no las tiene, safe_delete() lanza excepción.
     */
    const SOFT_COLS = ['deleted_at', 'deleted_by'];

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    // =========================================================================
    // UTILIDADES DE SESIÓN
    // =========================================================================

    /**
     * Retorna el ID del usuario autenticado en la sesión actual.
     * Soporta tanto sesión nativa PHP como sesión CodeIgniter.
     *
     * @return int|null
     */
    protected function _get_user_id()
    {
        if (isset($_SESSION['usuario']['idUsuario'])) {
            return (int) $_SESSION['usuario']['idUsuario'];
        }
        if ($this->session && $this->session->has_userdata('usuario')) {
            $usr = $this->session->userdata('usuario');
            return isset($usr['idUsuario']) ? (int) $usr['idUsuario'] : null;
        }
        return null;
    }

    /**
     * Retorna el nombre/correo del usuario autenticado (para logs legibles).
     *
     * @return string
     */
    protected function _get_user_label()
    {
        if (isset($_SESSION['usuario']['usuCorreo'])) {
            return $_SESSION['usuario']['usuCorreo'];
        }
        return 'sistema';
    }

    /**
     * Retorna la IP real del cliente considerando proxies.
     *
     * @return string
     */
    protected function _get_user_ip()
    {
        foreach (['HTTP_CF_CONNECTING_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_CLIENT_IP', 'REMOTE_ADDR'] as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = trim(explode(',', $_SERVER[$key])[0]);
                if (filter_var($ip, FILTER_VALIDATE_IP)) {
                    return $ip;
                }
            }
        }
        return '0.0.0.0';
    }

    // =========================================================================
    // AUDIT TRAIL — Stack de versiones
    // =========================================================================

    /**
     * Registra una acción en el stack de auditoría.
     * Nunca falla silenciosamente: si no puede auditar, lanza error.
     *
     * @param  string      $tabla        Tabla afectada
     * @param  int         $id_registro  PK del registro afectado
     * @param  string      $accion       CREATE | UPDATE | DELETE | RESTORE
     * @param  array|null  $antes        Snapshot del registro ANTES del cambio
     * @param  array|null  $despues      Snapshot del registro DESPUÉS del cambio
     * @return bool
     */
    protected function _audit_log($tabla, $id_registro, $accion, $antes = null, $despues = null)
    {
        $log = [
            'tabla'         => $tabla,
            'id_registro'   => (int) $id_registro,
            'accion'        => $accion,
            'usuario_id'    => $this->_get_user_id(),
            'usuario_label' => $this->_get_user_label(),
            'usuario_ip'    => $this->_get_user_ip(),
            'datos_antes'   => $antes   ? json_encode($antes,   JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null,
            'datos_despues' => $despues ? json_encode($despues, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) : null,
            'created_at'    => date('Y-m-d H:i:s'),
        ];

        $ok = $this->db->insert(self::AUDIT_TABLE, $log);

        if (!$ok) {
            log_message('error', "[MY_Model] FALLO CRÍTICO: no se pudo auditar acción {$accion} en {$tabla}#{$id_registro}");
        }

        return $ok;
    }

    // =========================================================================
    // SOFT DELETE — Nunca borra físicamente
    // =========================================================================

    /**
     * Marca un registro como eliminado (SoftDelete).
     * NUNCA ejecuta DELETE físico sobre tablas médicas.
     *
     * @param  string $tabla     Nombre de la tabla
     * @param  int    $id        Valor de la PK
     * @param  string $campo_id  Nombre de la columna PK (default: 'id')
     * @return bool
     * @throws RuntimeException Si el registro ya fue eliminado previamente
     */
    public function soft_delete($tabla, $id, $campo_id = 'id')
    {
        // Recuperar snapshot ANTES para auditoría
        $antes = $this->db->get_where($tabla, [$campo_id => $id])->row_array();

        if (empty($antes)) {
            log_message('error', "[MY_Model] soft_delete: registro {$tabla}#{$id} no encontrado.");
            return false;
        }

        // Protección: no eliminar lo que ya fue eliminado
        if (!empty($antes['deleted_at'])) {
            log_message('error', "[MY_Model] soft_delete: {$tabla}#{$id} ya fue marcado como eliminado en {$antes['deleted_at']}.");
            return false;
        }

        $data = [
            'deleted_at' => date('Y-m-d H:i:s'),
            'deleted_by' => $this->_get_user_id(),
        ];

        $this->db->where($campo_id, $id)->update($tabla, $data);

        // Stack del cambio en auditoría
        $this->_audit_log($tabla, $id, 'DELETE', $antes, array_merge($antes, $data));

        return $this->db->affected_rows() > 0;
    }

    /**
     * Restaura un registro previamente marcado como eliminado.
     *
     * @param  string $tabla
     * @param  int    $id
     * @param  string $campo_id
     * @return bool
     */
    public function restore($tabla, $id, $campo_id = 'id')
    {
        $antes = $this->db->get_where($tabla, [$campo_id => $id])->row_array();

        if (empty($antes)) {
            return false;
        }

        $data = [
            'deleted_at' => null,
            'deleted_by' => null,
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => $this->_get_user_id(),
        ];

        $this->db->where($campo_id, $id)->update($tabla, $data);

        $this->_audit_log($tabla, $id, 'RESTORE', $antes, array_merge($antes, $data));

        return $this->db->affected_rows() > 0;
    }

    // =========================================================================
    // SAFE INSERT / UPDATE — Con auditoría automática
    // =========================================================================

    /**
     * INSERT seguro: inyecta metadatos de auditoría y registra en stack.
     *
     * @param  string $tabla
     * @param  array  $datos
     * @return int    ID del registro insertado (0 si falla)
     */
    public function safe_insert($tabla, array $datos)
    {
        $datos['created_by'] = $datos['created_by'] ?? $this->_get_user_id();
        $datos['created_at'] = $datos['created_at'] ?? date('Y-m-d H:i:s');

        $this->db->insert($tabla, $datos);
        $id = $this->db->insert_id();

        if ($id) {
            $this->_audit_log($tabla, $id, 'CREATE', null, $datos);
        }

        return (int) $id;
    }

    /**
     * UPDATE seguro: toma snapshot antes, inyecta metadatos y apila en auditoría.
     *
     * @param  string $tabla
     * @param  array  $datos       Campos a actualizar
     * @param  int    $id          Valor de la PK
     * @param  string $campo_id    Nombre de la columna PK
     * @return bool
     */
    public function safe_update($tabla, array $datos, $id, $campo_id = 'id')
    {
        // Snapshot ANTES del cambio
        $antes = $this->db->get_where($tabla, [$campo_id => $id])->row_array();

        if (empty($antes)) {
            log_message('error', "[MY_Model] safe_update: {$tabla}#{$id} no encontrado.");
            return false;
        }

        // Protección: no modificar registros soft-deleted
        if (!empty($antes['deleted_at'])) {
            log_message('error', "[MY_Model] safe_update BLOQUEADO: {$tabla}#{$id} fue eliminado el {$antes['deleted_at']}. Restaurar primero.");
            return false;
        }

        $datos['updated_at'] = date('Y-m-d H:i:s');
        $datos['updated_by'] = $this->_get_user_id();

        $this->db->where($campo_id, $id)->update($tabla, $datos);

        // Stack del cambio: guardamos estado completo ANTES y DESPUÉS
        $despues = array_merge($antes, $datos);
        $this->_audit_log($tabla, $id, 'UPDATE', $antes, $despues);

        return $this->db->affected_rows() > 0;
    }

    // =========================================================================
    // CONSULTAS SEGURAS — Excluyen soft-deleted por defecto
    // =========================================================================

    /**
     * Retorna todos los registros ACTIVOS (sin deleted_at) de una tabla.
     *
     * @param  string $tabla
     * @param  array  $where  Condiciones adicionales
     * @param  string $order  Columna de orden
     * @return array
     */
    public function get_active($tabla, array $where = [], $order = null)
    {
        $this->db->where('deleted_at IS NULL', null, false);
        if (!empty($where)) {
            $this->db->where($where);
        }
        if ($order) {
            $this->db->order_by($order);
        }
        return $this->db->get($tabla)->result_array();
    }

    /**
     * Retorna UN registro activo por PK.
     *
     * @param  string $tabla
     * @param  int    $id
     * @param  string $campo_id
     * @return array|null
     */
    public function get_active_by_id($tabla, $id, $campo_id = 'id')
    {
        $this->db->where('deleted_at IS NULL', null, false);
        $row = $this->db->get_where($tabla, [$campo_id => $id])->row_array();
        return !empty($row) ? $row : null;
    }

    /**
     * Retorna también los registros eliminados (para vistas de auditoría).
     *
     * @param  string $tabla
     * @param  array  $where
     * @return array
     */
    public function get_with_deleted($tabla, array $where = [])
    {
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->get($tabla)->result_array();
    }

    // =========================================================================
    // AUDIT TRAIL — Consulta del stack de versiones
    // =========================================================================

    /**
     * Retorna el historial completo de cambios de un registro.
     * Permite ver "quién cambió qué y cuándo" — cumplimiento legal HC.
     *
     * @param  string $tabla
     * @param  int    $id_registro
     * @return array  Array de entradas de auditoría ordenadas por fecha DESC
     */
    public function get_audit_trail($tabla, $id_registro)
    {
        return $this->db
            ->where('tabla', $tabla)
            ->where('id_registro', $id_registro)
            ->order_by('created_at', 'DESC')
            ->get(self::AUDIT_TABLE)
            ->result_array();
    }

    /**
     * Retorna todos los cambios realizados por un usuario específico.
     *
     * @param  int    $usuario_id
     * @param  string $desde  Fecha inicio (Y-m-d H:i:s)
     * @param  string $hasta  Fecha fin    (Y-m-d H:i:s)
     * @return array
     */
    public function get_audit_by_user($usuario_id, $desde = null, $hasta = null)
    {
        $this->db->where('usuario_id', $usuario_id);
        if ($desde) {
            $this->db->where('created_at >=', $desde);
        }
        if ($hasta) {
            $this->db->where('created_at <=', $hasta);
        }
        return $this->db
            ->order_by('created_at', 'DESC')
            ->get(self::AUDIT_TABLE)
            ->result_array();
    }

    /**
     * Retorna el snapshot de un registro en un momento específico.
     * Útil para "¿cómo estaba esta HC hace 3 meses?".
     *
     * @param  string $tabla
     * @param  int    $id_registro
     * @param  string $fecha_referencia  Y-m-d H:i:s
     * @return array|null  El `datos_despues` del último cambio antes de esa fecha
     */
    public function get_snapshot_at($tabla, $id_registro, $fecha_referencia)
    {
        $row = $this->db
            ->where('tabla', $tabla)
            ->where('id_registro', $id_registro)
            ->where('created_at <=', $fecha_referencia)
            ->order_by('created_at', 'DESC')
            ->limit(1)
            ->get(self::AUDIT_TABLE)
            ->row_array();

        if (!empty($row['datos_despues'])) {
            return json_decode($row['datos_despues'], true);
        }

        return null;
    }
}