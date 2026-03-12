<?php

defined('BASEPATH') or exit('No direct script access allowed');
// This is the patient CRUD adds updates deletes patient information
class CPaciente extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("MPaciente");
        $this->load->model("MEmpresa");
        $this->load->model("MDepartamento");
        $this->load->model("MMunicipio");
        $this->load->model("MZonaResidencial");
        $this->load->model("MRegimen");
        $this->load->model("MTipoAfiliacion");
        $this->load->model("MTipoDocumento");
        $this->load->model("MRaza");
        $this->load->model("MEscolaridad");
        $this->load->model("MTipoParentesco");
        $this->load->model("MOcupacion");
        $this->load->model("Mauxiliar");
        $this->load->model("Mnovedad");
        $this->load->model("MBrigada");
    }

    public function index()
    {

        $data['title'] = 'IPS | LISTAR PACIENTE';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $datos["departamento"] = $this->MDepartamento->ver();
        $datos["municipio"] = $this->MMunicipio->ver();
        $datos["paciente"] = []; // server-side DataTables: carga vía AJAX
        $datos["zona_residencial"] = $this->MZonaResidencial->ver();
        $datos["regimen"] = $this->MRegimen->ver();
        $datos["empresa"] = $this->MEmpresa->ver();
        $datos["tipo_documento"] = $this->MTipoDocumento->ver();
        $datos["tipo_afiliacion"] = $this->MTipoAfiliacion->ver();
        $datos["raza"] = $this->MRaza->ver();
        $datos["escolaridad"] = $this->MEscolaridad->ver();
        $datos["parentesco"] = $this->MTipoParentesco->ver();
        $datos["auxiliar"] = $this->Mauxiliar->ver();
        $datos["novedad"] = $this->Mnovedad->ver();
        $datos["brigada"] = $this->MBrigada->ver();


        $this->load->view("CPaciente/VListar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }
    public function index_($tipo = null)
    {
        if ($tipo == 'agregado') {
            $data['tipmsg'] = 'success';
            $data['msg'] = '<strong>Excelente! </strong>registro se añadido correctamente.';
        } elseif ($tipo == 'eliminado') {

            $data['tipmsg'] = 'danger';
            $data['msg'] =  '<strong>Bien! </strong>registro eliminado correctamente!.';
        } elseif ($tipo == 'actualizar') {
            $data['tipmsg'] = 'success';
            $data['msg'] = '<strong>Excelente! </strong>registro se actualizo correctamente.';

        } elseif ($tipo == 'doc_encontrado') {
            $data['tipmsg'] = 'danger';
            $data['msg'] = '<strong>Error! </strong>registro no se pudo guardar, ya existe un usuario con el numero de documento ingresado.';
        }

        $data['title'] = 'IPS | LISTAR PACIENTE';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $this->load->view("CPlantilla/VHeader", $data);

        $datos["departamento"] = $this->MDepartamento->ver();
        $datos["municipio"] = $this->MMunicipio->ver();
        $datos["paciente"] = []; // server-side DataTables: carga vía AJAX
        $datos["zona_residencial"] = $this->MZonaResidencial->ver();
        $datos["regimen"] = $this->MRegimen->ver();
        $datos["empresa"] = $this->MEmpresa->ver();
        $datos["tipo_documento"] = $this->MTipoDocumento->ver();
        $datos["tipo_afiliacion"] = $this->MTipoAfiliacion->ver();
        $datos["raza"] = $this->MRaza->ver();
        $datos["escolaridad"] = $this->MEscolaridad->ver();
        $datos["parentesco"] = $this->MTipoParentesco->ver();
        $datos["auxiliar"] = $this->Mauxiliar->ver();
        $datos["novedad"] = $this->Mnovedad->ver();
        $datos["brigada"] = $this->MBrigada->ver();


        $this->load->view("CPaciente/VListar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function formulario_paciente()
    {

        $data['title'] = 'IPS | AGREGAR PACIENTE';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $datos["paciente"] = $this->MPaciente->ver();
        $datos["zona_residencial"] = $this->MZonaResidencial->ver();
        $datos["regimen"] = $this->MRegimen->ver();
        $datos["empresa"] = $this->MEmpresa->ver();
        $datos["tipo_documento"] = $this->MTipoDocumento->ver();
        $datos["tipo_afiliacion"] = $this->MTipoAfiliacion->ver();
        $datos["raza"] = $this->MRaza->ver();
        $datos["escolaridad"] = $this->MEscolaridad->ver();
        $datos["parentesco"] = $this->MTipoParentesco->ver();
        $departamento = $this->MDepartamento->ver();
        $datos['departamento'] = $departamento;
        $datos["ocupacion"] = $this->MOcupacion->ver();
        $datos["auxiliar"] = $this->Mauxiliar->ver();
        $datos["novedad"] = $this->Mnovedad->ver();
        $datos["brigada"] = $this->MBrigada->ver();



        $this->load->view("CPaciente/VAgregar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }


    public function agregar()
    {
        $pacTipDocumento = $this->input->post('tipo');
        $pacDocumento = $this->input->post('identificacion');
        $pacNombre = $this->input->post('nombre');
        $pacNombre2 = $this->input->post('nombre2');
        $pacApellido = $this->input->post('apellido');
        $pacApellido2 = $this->input->post('apellido2');
        $pacFecNacimiento = $this->input->post('fecha_nacimiento');
        $pacSexo = $this->input->post('sexo');
        $depto_nacimiento = $this->input->post('departamento_nacimiento');
        $municipio_nacimiento = $this->input->post('municipio_nacimiento');
        $pacDireccion = $this->input->post('domicilio');
        $pacTelefono = $this->input->post('telefono');
        $depto_residencia = $this->input->post('departamento_residencia');
        $municipio_residencia = $this->input->post('municipio_residencia');
        $id_zona_residencia = $this->input->post('zona_residencial');
        $regimen_idRegimen = $this->input->post('regimen');
        $empresa_idEmpresa = $this->input->post('empresa');
        $id_tipo_afiliacion = $this->input->post('tipo_afiliacion');
        $raza_idRaza = $this->input->post('raza');
        $pacEstCivil = $this->input->post('estado_civil');
        $escolaridad_idEscolaridad = $this->input->post('escolaridad');
        $pacOcupacion = $this->input->post('ocupacion');
        $nombre_acudiente = $this->input->post('acudiente');
        $parentesco_idParentesco = $this->input->post('tipo_parentesco');
        $auxiliar_idauxiliar = $this->input->post('auxiliar_idauxiliar');
        $telefono_acudiente = $this->input->post('telefono_acudiente');
        $direccion_acudiente = $this->input->post('direccion_acudiente');
        $pacCorreo = $this->input->post('correo');
        $pacObservacion = $this->input->post('observacion');
		$acompanante = $this->input->post('acompanante');
        $telefono_acompanante = $this->input->post('telefono_acompanante');
        $Brigada_idBrigada = $this->input->post('Brigada_idBrigada');
        $Fecha_Actua = $this->input->post('Fecha_Actua');
        $novedad_idnovedad = $this->input->post('novedad_idnovedad');
        


        $dt_paciente = $this->MPaciente->get_paciente_by_doc($pacDocumento);

        if (count($dt_paciente)==0) {

            $datos = array(
                'pacFecRegistro' => date("Y-m-d",time()),
                'pacRegistro' => $this->session->userdata('nom_user'),
                'pacTipDocumento' => $pacTipDocumento,
                'pacDocumento' => $pacDocumento,
                'pacNombre' => $pacNombre,
                'pacNombre2' => $pacNombre2,
                'pacApellido' => $pacApellido,
                'pacApellido2' => $pacApellido2,
                'pacFecNacimiento' => $pacFecNacimiento,
                'pacSexo' => $pacSexo,
                'depto_nacimiento' => $depto_nacimiento,
                'municipio_nacimiento' => $municipio_nacimiento,
                'pacDireccion' => $pacDireccion,
                'pacTelefono' => $pacTelefono,
                'depto_residencia' => $depto_residencia,
                'municipio_residencia' => $municipio_residencia,
                'id_zona_residencia' => $id_zona_residencia,
                'regimen_idRegimen' => $regimen_idRegimen,
                'empresa_idEmpresa' => $empresa_idEmpresa,
                'id_tipo_afiliacion' => $id_tipo_afiliacion,
                'raza_idRaza' => $raza_idRaza,
                'pacEstCivil' => $pacEstCivil,
                'escolaridad_idEscolaridad' => $escolaridad_idEscolaridad,
                'pacOcupacion' => $pacOcupacion,
                'nombre_acudiente' => $nombre_acudiente,
                'parentesco_idParentesco' => $parentesco_idParentesco,
                'auxiliar_idauxiliar' => $auxiliar_idauxiliar,
                'telefono_acudiente' => $telefono_acudiente,
                'direccion_acudiente' => $direccion_acudiente,
                'pacCorreo' => $pacCorreo,
                'pacObservacion' => $pacObservacion,
				'novedad_idnovedad' => $novedad_idnovedad,
                'Brigada_idBrigada' => $Brigada_idBrigada,
                'Fecha_Actua' => $Fecha_Actua,
                'pacAcompananteNombre' => $acompanante,
                'pacAcompananteTelefono' => $telefono_acompanante
                

            );

            $this->MPaciente->guardar($datos);
            // Redireccionar con parámetro
            redirect(base_url("index.php/CPaciente/index_/agregado"));

        }else{

            redirect(base_url("index.php/CPaciente/index_/doc_encontrado"));

        }
    }

    public function modRecuperar($idPaciente)
    {

        $data['title'] = 'IPS | ACTUALIZAR PACIENTE';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $datos["departamento"] = $this->MDepartamento->ver();
        $datos["municipio"] = $this->MMunicipio->ver();
        $datos["zona_residencial"] = $this->MZonaResidencial->ver();
        $datos["regimen"] = $this->MRegimen->ver();
        $datos["empresa"] = $this->MEmpresa->ver();
        $datos["tipo_afiliacion"] = $this->MTipoAfiliacion->ver();
        $datos["tipo_documento"] = $this->MTipoDocumento->ver();
        $datos["raza"] = $this->MRaza->ver();
        $datos["escolaridad"] = $this->MEscolaridad->ver();
        $datos["parentesco"] = $this->MTipoParentesco->ver();
        $datos["ocupacion"] = $this->MOcupacion->ver();
        $datos["paciente"] = $this->MPaciente->recuperardatos($idPaciente);
        $datos["auxiliar"] = $this->Mauxiliar->ver();
        $datos["brigada"] = $this->MBrigada->ver();
        
        $datos["novedad"] = $this->Mnovedad->ver();

        $this->load->view("CPaciente/VModificar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function mostrarMunicipio()
    {
        // POST data
        $postData = $this->input->post();

        // get Municipio
        $data = $this->MMunicipio->getMunicipio($postData);

        echo json_encode($data);
    }


    public function Editar()
    {

        $idPaciente = $this->input->post('id');
        $pacTipDocumento = $this->input->post('tipo');
        $pacDocumento = $this->input->post('identificacion');
        $pacNombre = $this->input->post('nombre');
        $pacNombre2 = $this->input->post('nombre2');
        $pacApellido = $this->input->post('apellido');
        $pacApellido2 = $this->input->post('apellido2');      
        $pacFecNacimiento = $this->input->post('fecha_nacimiento');
        $pacSexo = $this->input->post('sexo');
        $depto_nacimiento = $this->input->post('departamento_nacimiento');
        $municipio_nacimiento = $this->input->post('municipio_nacimiento');
        $pacDireccion = $this->input->post('domicilio');
        $pacTelefono = $this->input->post('telefono');
        $depto_residencia = $this->input->post('departamento_residencia');
        $municipio_residencia = $this->input->post('municipio_residencia');
        $id_zona_residencia = $this->input->post('zona_residencial');
        $regimen_idRegimen = $this->input->post('regimen');
        $empresa_idEmpresa = $this->input->post('empresa');
        $id_tipo_afiliacion = $this->input->post('tipo_afiliacion');
        $raza_idRaza = $this->input->post('raza');
        $pacEstCivil = $this->input->post('estado_civil');
        $escolaridad_idEscolaridad = $this->input->post('escolaridad');
        $pacOcupacion = $this->input->post('ocupacion');
        $nombre_acudiente = $this->input->post('acudiente');
        $parentesco_idParentesco = $this->input->post('tipo_parentesco');
        $auxiliar_idauxiliar = $this->input->post('auxiliar_idauxiliar');
        $telefono_acudiente = $this->input->post('telefono_acudiente');
        $direccion_acudiente = $this->input->post('direccion_acudiente');
        $pacCorreo = $this->input->post('correo');
        $pacObservacion = $this->input->post('observacion');
		$novedad_idnovedad = $this->input->post('novedad_idnovedad');
        $acompanante = $this->input->post('acompanante');
        $Brigada_idBrigada = $this->input->post('Brigada_idBrigada');
        $Fecha_Actua = $this->input->post('Fecha_Actua');
        $telefono_acompanante = $this->input->post('telefono_acompanante');
       
        $datos = array(
            'pacTipDocumento' => $pacTipDocumento,
            'pacDocumento' => $pacDocumento,
            'pacNombre' => $pacNombre,
            'pacNombre2' => $pacNombre2,
            'pacApellido' => $pacApellido,
            'pacApellido2' => $pacApellido2,
            'pacFecNacimiento' => $pacFecNacimiento,
            'pacSexo' => $pacSexo,
            'depto_nacimiento' => $depto_nacimiento,
            'municipio_nacimiento' => $municipio_nacimiento,
            'pacDireccion' => $pacDireccion,
            'pacTelefono' => $pacTelefono,
            'depto_residencia' => $depto_residencia,
            'municipio_residencia' => $municipio_residencia,
            'id_zona_residencia' => $id_zona_residencia,
            'regimen_idRegimen' => $regimen_idRegimen,
            'empresa_idEmpresa' => $empresa_idEmpresa,
            'id_tipo_afiliacion' => $id_tipo_afiliacion,
            'raza_idRaza' => $raza_idRaza,
            'pacEstCivil' => $pacEstCivil,
            'escolaridad_idEscolaridad' => $escolaridad_idEscolaridad,
            'pacOcupacion' => $pacOcupacion,
            'nombre_acudiente' => $nombre_acudiente,
            'parentesco_idParentesco' => $parentesco_idParentesco,
            'auxiliar_idauxiliar' => $auxiliar_idauxiliar,
            'telefono_acudiente' => $telefono_acudiente,
            'direccion_acudiente' => $direccion_acudiente,
            'pacCorreo' => $pacCorreo,
            'pacObservacion' => $pacObservacion,
			'novedad_idnovedad' => $novedad_idnovedad,
            'pacAcompananteNombre' => $acompanante,
            'Brigada_idBrigada' => $Brigada_idBrigada,
            'Fecha_Actua' => $Fecha_Actua,
            'pacAcompananteTelefono' => $telefono_acompanante,
            
        );

        $this->MPaciente->actualizardatos($datos, $idPaciente);

        redirect(base_url("index.php/CPaciente/index_/actualizar"));
    }



    public function eliminar($idPaciente)
    {
        $estado = array(
            'pacEstado' => 'INACTIVO'
        );

        $this->MPaciente->eliminar($estado, $idPaciente);

        redirect(base_url("index.php/CPaciente/index_/eliminado"));
    }

    // ─── Endpoint server-side DataTables ─────────────────────────────────────
    public function ajax_pacientes()
    {
        $draw       = intval($this->input->post('draw'));
        $start      = intval($this->input->post('start'));
        $length     = intval($this->input->post('length'));
        $search     = $this->input->post('search');
        $order      = $this->input->post('order');
        $search_val = isset($search['value']) ? trim($search['value']) : '';
        $order_col  = isset($order[0]['column']) ? intval($order[0]['column']) : 1;
        $order_dir  = isset($order[0]['dir'])    ? $order[0]['dir'] : 'asc';

        $total    = $this->MPaciente->ver_ajax_total();
        $filtered = $this->MPaciente->ver_ajax_filtrado($search_val);
        $rows     = $this->MPaciente->ver_ajax($start, $length, $search_val, $order_col, $order_dir);

        $base     = base_url();
        $data_arr = [];

        foreach ($rows as $pac) {
            list($anio, $mes, $dia) = explode('-', $pac->pacFecNacimiento);
            $edad = (int)date('Y') - (int)$anio;
            if ((int)date('m') < (int)$mes || ((int)date('m') === (int)$mes && (int)date('d') < (int)$dia)) {
                $edad--;
            }

            $btn_actualizar = '<a class="btn btn-primary btn-sm" href="' . $base . 'index.php/CPaciente/modRecuperar/' . $pac->idPaciente . '">Actualizar</a>';
            $btn_eliminar   = ($pac->pacEstado === 'ACTIVO')
                ? '<a class="btn btn-danger btn-sm" onclick="eliminar(\'' . $pac->idPaciente . '\')">Eliminar</a>'
                : '';

            $data_arr[] = [
                htmlspecialchars($pac->pacDocumento),
                htmlspecialchars($pac->nombre_completo),
                htmlspecialchars($pac->pacCorreo),
                $edad,
                htmlspecialchars($pac->tipNombre),
                htmlspecialchars($pac->tipo_novedad),
                $btn_actualizar,
                $btn_eliminar,
            ];
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'draw'            => $draw,
                'recordsTotal'    => (int)$total,
                'recordsFiltered' => (int)$filtered,
                'data'            => $data_arr,
            ]));
    }
    // ─────────────────────────────────────────────────────────────────────────
}
