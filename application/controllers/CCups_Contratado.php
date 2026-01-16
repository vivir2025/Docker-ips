<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CCups_Contratado extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("MCups_Contratado");
        $this->load->model("MContrato");
        $this->load->model("MCups");
        $this->load->model("MCategoria_Cups");
        $this->load->model("MHistoria");
        $this->load->model("MAgenda");
    }
    // This code administers the contracted CUPS, allowing:
    // ✅ List them
    // ✅ Add new CUPS to a contract
    // ✅ Edit information
    // ✅ Delete (switch to inactive)
    // ✅ Search for CUPS by name or code
    public function index()
    {
        echo "Funcionalidad por defecto. No hay lógica implementada.";
        exit;
    }

    public function listar($idContrato)
    {

        $data['title'] = 'IPS | LISTAR CUPS CONTRATADO';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $datos["cups_contratado"] = $this->MCups_Contratado->ver($idContrato);

        $this->load->view("CCups_Contratado/VListar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function modRecuperar($id_cups_contrato)
    {

        $data['title'] = 'IPS | ACTUALIZAR CUPS';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $datos["cups"] = $this->MCups->ver();
        $datos["categoria"] = $this->MCategoria_Cups->ver();
        $datos["cups_contratado"] = $this->MCups_Contratado->recuperardatos($id_cups_contrato);

        $this->load->view("CCups_Contratado/VModificar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function guardar_vista($idContrato)
    {

        $data['title'] = 'IPS | AGREAGAR CUPS AL CONTRATO';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        //$datos["idContrato"]=   $idContrato;
        $datos["cups"] = $this->MCups->ver();
        $datos["categoria"] = $this->MCategoria_Cups->ver();
        $datos["contrato"] = $this->MContrato->recuperardatos($idContrato);

        $this->load->view("CCups_Contratado/VAgregar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function agregar()
    {
        $contrato_idContrato = $this->input->post('id');
        $cups_idCups = $this->input->post('cups');
        $cupTarifa = $this->input->post('valor');
        $id_categoria_cups = $this->input->post('categoria');

        $datos = array(
            'contrato_idContrato' => $contrato_idContrato,
            'cups_idCups' => $cups_idCups,
            'cupTarifa' => $cupTarifa,
            'id_categoria_cups' => $id_categoria_cups
        );

        $this->MCups_Contratado->guardar($datos);

        redirect(base_url("index.php/CContrato/index_/agregado"));
    }

    public function eliminar($id_cups_contrato)
    {
        $estado = array(
            'cup_con_estado' => 'INACTIVO'
        );

        $this->MCups_Contratado->eliminar($estado, $id_cups_contrato);

        redirect(base_url("index.php/CContrato/index_/eliminado"));
    }

    public function Editar()
    {

        $id_cups_contrato = $this->input->post('id');
        $cups_idCups = $this->input->post('cups');
        $cupTarifa = $this->input->post('valor');
        $id_categoria_cups = $this->input->post('categoria');

        $datos = $this->MCups_Contratado->recuperardatos($id_cups_contrato);

        // echo $datos[0]->idContrato;
        $id_contra = $datos[0]->idContrato;

        $datos = array(
            'cups_idCups' => $cups_idCups,
            'cupTarifa' => $cupTarifa,
            'id_categoria_cups' => $id_categoria_cups
        );

        $this->MCups_Contratado->actualizardatos($datos, $id_cups_contrato);

        redirect(base_url("index.php/CCups_Contratado/listar/" . $id_contra));
    }

    function cups_nombre_detalle()
    {
        $cupsNombre = $this->input->post('valorBusqueda');
        $documento = $this->input->post('documento');
        $idAgenda = $this->input->post('agenda');

        $data = $this->MCups_Contratado->getCupsByNombre($cupsNombre, $documento);
        $detalle = $this->MHistoria->detalle_hc_por_documento($documento);
        $agenda = $this->MAgenda->getAgendaByid($idAgenda);

        $detalle_nefro_inter = $this->MHistoria->detalle_control($documento);

        if ($agenda[0]->proceso_idProceso == 1) {

            if ($detalle != false) {
                $paciente_categoria = $detalle[0]->id_categoria_cups;
            } else {

                $paciente_categoria = 3;
            }
        } elseif ($agenda[0]->proceso_idProceso == 6 || $agenda[0]->proceso_idProceso == 7) {

            if (count($detalle_nefro_inter) == 0) {
                $paciente_categoria = 5;
            } else {

                $paciente_categoria = 6;
            }
        } else {
            $paciente_categoria = 4;
        }

        if (sizeof($data) > 0) {
            foreach ($data as $d) {
                echo "<div class='elemento-lista' ";
                echo "data-nombre='" . htmlspecialchars($d->cupNombre, ENT_QUOTES) . "' ";
                echo "data-codigo='" . htmlspecialchars($d->cupCodigo, ENT_QUOTES) . "' ";
                echo "data-cups-contratado='" . $d->id_cups_contrato . "' ";
                echo "data-tarifa='" . $d->cupTarifa . "' ";
                echo "data-categoria='" . $d->id_categoria_cups . "' ";
                echo "data-paciente-categoria='" . $paciente_categoria . "'>";
                echo htmlspecialchars($d->cupNombre) . " - " . htmlspecialchars($d->cupCodigo);
                echo "</div>";
            }
        } else {
            echo "<div class='text-danger'>No se encontró ningún CUPS asociado.</div>";
        }
    }

    function cups_codigo_detalle()
    {
        $cupsCodigo = $this->input->post('valorBusqueda');
        $documento = $this->input->post('documento');
        $idAgenda = $this->input->post('agenda');

        $data = $this->MCups_Contratado->getCupsByCodigo($cupsCodigo, $documento);
        $detalle = $this->MHistoria->detalle_hc_por_documento($documento);
        $agenda = $this->MAgenda->getAgendaByid($idAgenda);

        $detalle_nefro_inter = $this->MHistoria->detalle_control($documento);

        if ($agenda[0]->proceso_idProceso == 1) {

            if ($detalle != false) {
                $paciente_categoria = $detalle[0]->id_categoria_cups;
            } else {

                $paciente_categoria = 3;
            }
        } elseif ($agenda[0]->proceso_idProceso == 6 || $agenda[0]->proceso_idProceso == 7) {

            if (count($detalle_nefro_inter) == 0) {
                $paciente_categoria = 5;
            } else {

                $paciente_categoria = 6;
            }
        } else {
            $paciente_categoria = 4;
        }

        if (sizeof($data) > 0) {
            foreach ($data as $d) {
                echo "<div class='elemento-lista' ";
                echo "data-nombre='" . htmlspecialchars($d->cupNombre, ENT_QUOTES) . "' ";
                echo "data-codigo='" . htmlspecialchars($d->cupCodigo, ENT_QUOTES) . "' ";
                echo "data-cups-contratado='" . $d->id_cups_contrato . "' ";
                echo "data-tarifa='" . $d->cupTarifa . "' ";
                echo "data-categoria='" . $d->id_categoria_cups . "' ";
                echo "data-paciente-categoria='" . $paciente_categoria . "'>";
                echo htmlspecialchars($d->cupCodigo) . " - " . htmlspecialchars($d->cupNombre);
                echo "</div>";
            }
        } else {
            echo "<div class='text-danger'>No se encontró ningún código asociado.</div>";
        }

        echo "</table>";
    }

    function cups_codigo_contrato()
    {
        $cupsCodigo = $this->input->post('valorBusqueda');
        $idContrato = $this->input->post('contrato');

        $data = $this->MCups_Contratado->getCupsByCodigoContrato($cupsCodigo, $idContrato);

        echo "<table class='table table-striped'>";

        if (sizeof($data) > 0) {
            foreach ($data as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado(this);' id='" . $d->cupNombre .
                    '&' . $d->cupCodigo . '&' . $d->id_cups_contrato . '&' . $d->cupTarifa . '&' . $d->cups_idCups . "'>" . $d->cupCodigo .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun codigo asociado a ese numero.</td></tr>";
        }

        echo "</table>";
    }

    function cups_nombre_contrato()
    {
        $cupsNombre = $this->input->post('valorBusqueda');
        $idContrato = $this->input->post('contrato');

        $data = $this->MCups_Contratado->getCupsByNombreContrato($cupsNombre, $idContrato);

        echo "<table class='table table-striped'>";

        if (sizeof($data) > 0) {
            foreach ($data as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado(this);' id='" . $d->cupNombre .
                    '&' . $d->cupCodigo . '&' . $d->id_cups_contrato . '&' . $d->cupTarifa . '&' . $d->cups_idCups ."'>" . $d->cupNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun cups asociado a esa letra.</td></tr>";
        }

        echo "</table>";
    }
}
