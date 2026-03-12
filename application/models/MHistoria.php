<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * MHistoria — Modelo de Historia Clínica
 *
 * Extiende MY_Model para garantizar:
 *  - SoftDelete: ningún registro de HC se destruye físicamente
 *  - Audit Trail: todo CREATE/UPDATE/DELETE queda en auditoria_hc
 *  - Integridad: no se pueden modificar registros eliminados
 *
 * Cumplimiento: Resolución 1995/1999 MinSalud Colombia
 *
 * REGLA DE ORO: usar safe_insert() / safe_update() / soft_delete()
 *               en lugar de $this->db->insert/update/delete directo.
 */
class MHistoria extends MY_Model
{
    // Tablas principales que maneja este modelo
    const T_HC               = 'hc';
    const T_MEDICAMENTO      = 'historia_medicamento';
    const T_DIAGNOSTICO      = 'historia_diagnostico';
    const T_CUPS             = 'historia_cups';
    const T_COMPLEMENTARIA   = 'hc_complementaria';
    const T_PARACLINICO      = 'hcs_paraclinico';
    const T_VISITAS          = 'hcs_visitas';

    public function __construct()
    {
        parent::__construct();
    }

    // =========================================================================
    // HISTORIA CLÍNICA PRINCIPAL
    // =========================================================================

    /**
     * Obtiene la HC del paciente por cédula.
     * Solo retorna HCs activas (no soft-deleted).
     */
    public function get_historia_cedula($cedula)
    {
        return $this->db
            ->where('deleted_at IS NULL', null, false)
            ->where('pacDocumento', $cedula)
            ->get(self::T_HC)
            ->result();
    }

    /**
     * Crea (o recupera) la Historia Clínica de un paciente.
     * Registra en audit trail como CREATE.
     */
    public function create_historia($cedula)
    {
        // Buscar el paciente
        $paciente = $this->db
            ->get_where('paciente', ['pacDocumento' => $cedula, 'deleted_at IS NULL' => null])
            ->row_array();

        if (empty($paciente)) {
            log_message('error', "[MHistoria] create_historia: paciente {$cedula} no encontrado.");
            return false;
        }

        $datos = [
            'pacDocumento' => $cedula,
            'hcFecha'      => date('Y-m-d H:i:s'),
        ];

        $id = $this->safe_insert(self::T_HC, $datos);

        if (!$id) {
            return false;
        }

        return $this->db->get_where(self::T_HC, ['id_historia' => $id])->result();
    }

    // =========================================================================
    // MEDICAMENTOS
    // =========================================================================

    /**
     * Guarda un medicamento en la HC.
     * Audita automáticamente vía safe_insert().
     */
    public function guardar_medicamento(array $data)
    {
        return $this->safe_insert(self::T_MEDICAMENTO, $data);
    }

    /**
     * Actualiza un medicamento existente.
     * Toma snapshot ANTES, guarda DESPUÉS en auditoria_hc.
     */
    public function actualizar_medicamento(array $data, $id_his_med)
    {
        return $this->safe_update(self::T_MEDICAMENTO, $data, $id_his_med, 'id_his_med');
    }

    /**
     * Elimina lógicamente un medicamento (SoftDelete).
     * NUNCA borra físicamente. Queda registrado en auditoria_hc.
     */
    public function eliminar_medicamento($id_his_med)
    {
        return $this->soft_delete(self::T_MEDICAMENTO, $id_his_med, 'id_his_med');
    }

    /**
     * Consulta medicamentos activos de una HC.
     */
    public function ver_medicamento(array $where = [])
    {
        return $this->get_active(self::T_MEDICAMENTO, $where);
    }

    // =========================================================================
    // DIAGNÓSTICOS
    // =========================================================================

    /**
     * Guarda un diagnóstico CIE-10 en la HC.
     */
    public function guardar_diagnostico(array $data)
    {
        return $this->safe_insert(self::T_DIAGNOSTICO, $data);
    }

    /**
     * Actualiza un diagnóstico.
     */
    public function actualizar_diagnostico(array $data, $id_diagnostico)
    {
        return $this->safe_update(self::T_DIAGNOSTICO, $data, $id_diagnostico, 'id_diagnostico');
    }

    /**
     * Elimina lógicamente un diagnóstico.
     */
    public function eliminar_diagnostico($id_diagnostico)
    {
        return $this->soft_delete(self::T_DIAGNOSTICO, $id_diagnostico, 'id_diagnostico');
    }

    /**
     * Lista diagnósticos activos de una HC.
     */
    public function ver_diagnosticos($id_historia)
    {
        return $this->get_active(self::T_DIAGNOSTICO, ['historia_idHistoria' => $id_historia]);
    }

    // =========================================================================
    // CUPS (Procedimientos)
    // =========================================================================

    /**
     * Guarda un CUPS en la HC.
     */
    public function guardar_cups(array $data)
    {
        return $this->safe_insert(self::T_CUPS, $data);
    }

    /**
     * Elimina lógicamente un CUPS de la HC.
     */
    public function eliminar_cups($id_historia_cups)
    {
        return $this->soft_delete(self::T_CUPS, $id_historia_cups, 'id_historia_cups');
    }

    /**
     * Lista CUPS activos de una HC.
     */
    public function ver_cups($id_historia)
    {
        return $this->get_active(self::T_CUPS, ['historia_idHistoria' => $id_historia]);
    }

    // =========================================================================
    // INFORMACIÓN COMPLEMENTARIA
    // =========================================================================

    /**
     * Guarda datos adicionales/complementarios de la HC.
     */
    public function guardar_adicionales(array $datos_adicionales)
    {
        return $this->safe_insert(self::T_COMPLEMENTARIA, $datos_adicionales);
    }

    /**
     * Actualiza información complementaria.
     */
    public function actualizar_adicionales(array $datos, $id_complementaria)
    {
        return $this->safe_update(self::T_COMPLEMENTARIA, $datos, $id_complementaria, 'id_complementaria');
    }

    // =========================================================================
    // PARACLÍNICOS (Resultados de laboratorio / imágenes)
    // =========================================================================

    /**
     * Importa paraclínicos desde Excel (batch).
     * Cada fila se audita individualmente.
     */
    public function guardar_paraclinico_excel(array $_DATOS_EXCEL)
    {
        $insertados = 0;
        foreach ($_DATOS_EXCEL as $fila) {
            if ($this->safe_insert(self::T_PARACLINICO, $fila)) {
                $insertados++;
            }
        }
        return $insertados > 0;
    }

    /**
     * Elimina lógicamente un paraclínico.
     */
    public function eliminar_paraclinico($id_paraclinico)
    {
        return $this->soft_delete(self::T_PARACLINICO, $id_paraclinico, 'id_paraclinico');
    }

    /**
     * Lista paraclínicos activos.
     */
    public function ver_paraclinicos($id_historia)
    {
        return $this->get_active(self::T_PARACLINICO, ['historia_idHistoria' => $id_historia]);
    }

    // =========================================================================
    // VISITAS DOMICILIARIAS
    // =========================================================================

    /**
     * Importa visitas desde Excel (batch).
     */
    public function guardar_visitas_excel(array $_DATOS_EXCEL)
    {
        $insertados = 0;
        foreach ($_DATOS_EXCEL as $fila) {
            if ($this->safe_insert(self::T_VISITAS, $fila)) {
                $insertados++;
            }
        }
        return $insertados > 0;
    }

    /**
     * Elimina lógicamente una visita.
     */
    public function eliminar_visita($id_visita)
    {
        return $this->soft_delete(self::T_VISITAS, $id_visita, 'id_visita');
    }

    /**
     * Lista visitas activas de un paciente.
     */
    public function ver_visitas($id_historia)
    {
        return $this->get_active(self::T_VISITAS, ['historia_idHistoria' => $id_historia]);
    }

    // =========================================================================
    // AUDITORÍA — Consultas del stack de versiones
    // =========================================================================

    /**
     * Retorna el historial completo de cambios de una HC.
     * Incluye quién cambió qué, cuándo y desde qué IP.
     *
     * @param  int $id_historia
     * @return array
     */
    public function get_historial_auditoria($id_historia)
    {
        return $this->get_audit_trail(self::T_HC, $id_historia);
    }

    /**
     * Retorna el historial de cambios de los medicamentos de una HC.
     *
     * @param  int $id_his_med
     * @return array
     */
    public function get_auditoria_medicamento($id_his_med)
    {
        return $this->get_audit_trail(self::T_MEDICAMENTO, $id_his_med);
    }

    /**
     * Retorna el historial de cambios de los diagnósticos de una HC.
     *
     * @param  int $id_diagnostico
     * @return array
     */
    public function get_auditoria_diagnostico($id_diagnostico)
    {
        return $this->get_audit_trail(self::T_DIAGNOSTICO, $id_diagnostico);
    }

    /**
     * Retorna cómo estaba la HC en una fecha específica (viaje en el tiempo).
     * Útil para auditorías legales y revisiones médicas retrospectivas.
     *
     * @param  int    $id_historia
     * @param  string $fecha        Y-m-d H:i:s
     * @return array|null
     */
    public function get_hc_en_fecha($id_historia, $fecha)
    {
        return $this->get_snapshot_at(self::T_HC, $id_historia, $fecha);
    }

    // =========================================================================
    // CONSULTAS HEREDADAS (compatibilidad con código existente)
    // =========================================================================
    // Estos métodos mantienen la firma original del modelo anterior
    // para no romper los controladores existentes.

    /**
     * Obtiene HCs para impresión (incluye relaciones).
     * Solo registros activos.
     */
    public function get_historia_imprimir($id_historia)
    {
        return $this->db->query("
            SELECT hc.*, p.pacNombre, p.pacApellido, p.pacDocumento
            FROM hc
            INNER JOIN paciente p ON p.idPaciente = hc.paciente_idPaciente
            WHERE hc.id_historia = ?
              AND hc.deleted_at IS NULL
        ", [$id_historia])->result();
    }

    /**
     * Retorna el listado de HCs de un paciente por cédula.
     * Usado en historial clínico. Solo activas.
     */
    public function listar_historias_paciente($cedula)
    {
        return $this->db->query("
            SELECT hc.*, c.citFecha, p.idProceso, p.proNombre
            FROM hc
            INNER JOIN cita c ON c.idCita = hc.cita_idCita
            INNER JOIN agenda a ON a.idAgenda = c.agenda_idAgenda
            INNER JOIN proceso p ON p.idProceso = a.proceso_idProceso
            INNER JOIN paciente pac ON pac.idPaciente = c.paciente_idPaciente
            WHERE pac.pacDocumento = ?
              AND hc.deleted_at IS NULL
              AND c.deleted_at IS NULL
            ORDER BY c.citFecha DESC
        ", [$cedula])->result();
    }
}