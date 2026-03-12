<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * CHistoria — Controlador de Historia Clínica
 *
 * Política de seguridad médica:
 *  - NUNCA llama a $this->db->delete() directo sobre tablas de HC
 *  - Toda eliminación usa MHistoria::eliminar_*() → soft_delete()
 *  - Toda modificación usa MHistoria::actualizar_*() → safe_update()
 *  - Toda creación usa MHistoria::guardar_*() → safe_insert()
 *
 * Cumplimiento: Resolución 1995/1999 MinSalud Colombia
 */
class CHistoria extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('MHistoria');
        $this->load->model('MHistorial');
        $this->load->model('MCita');
        $this->load->model('MMedicamento');
        $this->load->library('session');
    }

    // =========================================================================
    // AUTENTICACIÓN — Helper privado
    // =========================================================================

    /**
     * Verifica sesión activa. Redirige a login si no hay sesión.
     */
    private function _require_auth()
    {
        if (!isset($_SESSION['usuario'])) {
            redirect('CLogin');
        }
    }

    // =========================================================================
    // HISTORIA CLÍNICA — CRUD principal
    // =========================================================================

    public function index()
    {
        $this->_require_auth();
        $data['menu']  = $this->load->view('menu', ['menu' => $this->session->userdata('menu')], true);
        $data['title'] = 'Historia Clínica';
        $this->load->view('historia/VHistoria', $data);
    }

    /**
     * Crea o recupera la HC de un paciente por cédula.
     * Registra en audit trail como CREATE al ser nueva.
     */
    public function create()
    {
        $this->_require_auth();

        $cedula   = $this->input->post('cedula', true);
        $historia = $this->MHistoria->get_historia_cedula($cedula);

        if (empty($historia)) {
            $historia = $this->MHistoria->create_historia($cedula);
        }

        if (!$historia) {
            echo json_encode(['error' => 'No se encontró el paciente con esa cédula.']);
            return;
        }

        $id_historia = $historia[0]->id_historia;
        echo json_encode(['id_historia' => $id_historia, 'ok' => true]);
    }

    // =========================================================================
    // MEDICAMENTOS
    // =========================================================================

    /**
     * Consulta medicamentos activos de una HC.
     * Solo retorna registros donde deleted_at IS NULL.
     */
    public function consultar_medicamento()
    {
        $this->_require_auth();

        $postData    = $this->input->post(null, true);
        $medicamento = $this->MHistoria->ver_medicamento($postData);

        echo json_encode($medicamento);
    }

    /**
     * Guarda un nuevo medicamento en la HC.
     * Audita automáticamente vía safe_insert().
     */
    public function guardar_medicamento()
    {
        $this->_require_auth();

        $data = [
            'hisMedCantidad'    => $this->input->post('cantidad',    true),
            'hisMedDosis'       => $this->input->post('dosis',       true),
            'hisMedFrecuencia'  => $this->input->post('frecuencia',  true),
            'hisMedNombre'      => $this->input->post('nombre',      true),
            'historia_idHistoria' => $this->input->post('id_historia', true),
        ];

        $id = $this->MHistoria->guardar_medicamento($data);
        echo json_encode(['ok' => (bool) $id, 'id' => $id]);
    }

    /**
     * Actualiza un medicamento.
     * Toma snapshot ANTES → guarda en auditoria_hc → aplica cambio.
     */
    public function actualizar_medicamento()
    {
        $this->_require_auth();

        $id_his_med = (int) $this->input->post('id_his_med_actualizacion', true);

        $data = [
            'hisMedCantidad'   => $this->input->post('cantidad',   true),
            'hisMedDosis'      => $this->input->post('dosis',      true),
            'hisMedFrecuencia' => $this->input->post('frecuencia', true),
        ];

        $ok = $this->MHistoria->actualizar_medicamento($data, $id_his_med);
        echo json_encode(['ok' => $ok]);
    }

    /**
     * Elimina LÓGICAMENTE un medicamento (SoftDelete).
     *
     * ⚠️  PROHIBIDO: $this->db->delete('historia_medicamento', ...)
     *     CORRECTO:   $this->MHistoria->eliminar_medicamento($id)
     */
    public function eliminar_medicamento()
    {
        $this->_require_auth();

        $id_his_med = (int) $this->input->post('id_his_med', true);
        $ok         = $this->MHistoria->eliminar_medicamento($id_his_med);

        echo json_encode(['ok' => $ok]);
    }

    // =========================================================================
    // DIAGNÓSTICOS
    // =========================================================================

    /**
     * Guarda un diagnóstico CIE-10.
     */
    public function guardar_diagnostico()
    {
        $this->_require_auth();

        $data = [
            'hisDxCodigo'         => $this->input->post('codigo_cie10',  true),
            'hisDxDescripcion'    => $this->input->post('descripcion',   true),
            'hisDxTipo'           => $this->input->post('tipo',          true),
            'historia_idHistoria' => $this->input->post('id_historia',   true),
        ];

        $id = $this->MHistoria->guardar_diagnostico($data);
        echo json_encode(['ok' => (bool) $id, 'id' => $id]);
    }

    /**
     * Elimina LÓGICAMENTE un diagnóstico.
     */
    public function eliminar_diagnostico()
    {
        $this->_require_auth();

        $id = (int) $this->input->post('id_diagnostico', true);
        $ok = $this->MHistoria->eliminar_diagnostico($id);

        echo json_encode(['ok' => $ok]);
    }

    // =========================================================================
    // CUPS (Procedimientos)
    // =========================================================================

    /**
     * Guarda un procedimiento CUPS en la HC.
     */
    public function guardar_cups()
    {
        $this->_require_auth();

        $data = [
            'cups_idCups'         => $this->input->post('id_cups',     true),
            'historia_idHistoria' => $this->input->post('id_historia', true),
        ];

        $id = $this->MHistoria->guardar_cups($data);
        echo json_encode(['ok' => (bool) $id, 'id' => $id]);
    }

    /**
     * Elimina LÓGICAMENTE un CUPS de la HC.
     */
    public function eliminar_cups()
    {
        $this->_require_auth();

        $id = (int) $this->input->post('id_historia_cups', true);
        $ok = $this->MHistoria->eliminar_cups($id);

        echo json_encode(['ok' => $ok]);
    }

    // =========================================================================
    // INFORMACIÓN COMPLEMENTARIA
    // =========================================================================

    /**
     * Guarda datos complementarios de la HC.
     */
    public function guardar_adicionales()
    {
        $this->_require_auth();

        $datos = $this->input->post(null, true);

        if (empty($datos['id_historia'])) {
            echo json_encode(['ok' => false, 'error' => 'id_historia requerido']);
            return;
        }

        $id = $this->MHistoria->guardar_adicionales($datos);
        echo json_encode(['ok' => (bool) $id]);
    }

    // =========================================================================
    // AUDITORÍA — Vista del stack de versiones
    // =========================================================================

    /**
     * Muestra el historial completo de cambios de una HC.
     * Vista de cumplimiento legal — acceso restringido a roles autorizados.
     *
     * @param int $id_historia
     */
    public function auditoria($id_historia)
    {
        $this->_require_auth();

        // Solo usuarios con rol autorizado pueden ver auditoría
        $usuario = $_SESSION['usuario'];
        if (!in_array($usuario['rolNombre'] ?? '', ['ADMINISTRADOR', 'AUDITOR', 'MEDICO'])) {
            show_error('No tiene permisos para ver el historial de auditoría.', 403);
            return;
        }

        $id_historia = (int) $id_historia;

        $data['auditoria'] = $this->MHistoria->get_historial_auditoria($id_historia);
        $data['id_historia'] = $id_historia;
        $data['title'] = 'Auditoría Historia Clínica #' . $id_historia;
        $data['menu']  = $this->load->view('menu', ['menu' => $this->session->userdata('menu')], true);

        $this->load->view('historia/VAuditoria', $data);
    }

    /**
     * API: retorna el snapshot de la HC en una fecha dada.
     * Permite "viaje en el tiempo" para revisiones médico-legales.
     *
     * POST: id_historia, fecha (Y-m-d H:i:s)
     */
    public function snapshot_en_fecha()
    {
        $this->_require_auth();

        $id_historia = (int) $this->input->post('id_historia', true);
        $fecha       = $this->input->post('fecha', true);

        if (!$id_historia || !$fecha) {
            echo json_encode(['ok' => false, 'error' => 'Parámetros requeridos: id_historia, fecha']);
            return;
        }

        $snapshot = $this->MHistoria->get_hc_en_fecha($id_historia, $fecha);

        echo json_encode([
            'ok'       => !empty($snapshot),
            'snapshot' => $snapshot,
        ]);
    }
}