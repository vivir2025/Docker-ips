<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CInforme extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("MInforme");
$this->load->model("MBrigada");
    }

    public function index()
    {

        $data['title'] = 'IPS | INFORMES';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");
$datos["brigada"] = $this->MBrigada->ver();

        $this->load->view("CInforme/VConsultar.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

public function informe1()
    {

        $data['title'] = 'IPS | INFORMES';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $this->load->view("CInforme/VConsultar1.php");

        $this->load->view("CPlantilla/VFooter");
    }
    public function informe2()
    {

        $data['title'] = 'IPS | INFORMES';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $this->load->view("CInforme/VConsultar2.php");

        $this->load->view("CPlantilla/VFooter");
    }

    public function informe3()
    {
        // Verificar que solo admin (rol_user == 1) pueda acceder
        if ($this->session->userdata('rol_user') != 1) {
            redirect(site_url('CHome'));
        }

        $data['title'] = 'IPS | INFORME FACTURACIÓN';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $this->load->view("CInforme/VConsultar3.php");

        $this->load->view("CPlantilla/VFooter");
    }

    public function informe4()
    {
        // Verificar que solo admin (rol_user == 1) pueda acceder
        if ($this->session->userdata('rol_user') != 1) {
            redirect(site_url('CHome'));
        }

        $data['title'] = 'IPS | GENERAR RIPS JSON';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $this->load->view("CInforme/VConsultar4.php");

        $this->load->view("CPlantilla/VFooter");
    }

    public function exportar() {
        // Crear nombre del archivo
        $filename = 'Informe_Rcv_' . date('Y-m-d', time()) . '.xls';  
    
        $fecha1 = $this->input->post('fecha');
        $fecha2 = $this->input->post('fecha1');
    
        // Usar la misma consulta rápida de exportar_1 con filtro
        $data = $this->MInforme->ver_pac_by_fecha_especial_control($fecha1, $fecha2);
    
        // Headers para Excel con soporte UTF-8 completo
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        // BOM UTF-8 - CRÍTICO para que Excel detecte correctamente acentos y ñ
        echo "\xEF\xBB\xBF";
    
        // Inicio de tabla HTML con meta UTF-8
        echo '<html><head><meta charset="UTF-8"></head><body>';
        echo '<table border="1">';
        
        if (sizeof($data) > 0) {
            // Encabezados de tabla
            echo "<tr>";
            echo "<td><b>Primer Nombre</b></td>";
            echo "<td><b>Segundo Nombre</b></td>";
            echo "<td><b>Primer Apellido</b></td>";
            echo "<td><b>Segundo Apellido</b></td>";
            echo "<td><b>Tipo Documento</b></td>";
            echo "<td><b>Numero de Identificacion</b></td>";
            echo "<td><b>Fecha de Nacimiento</b></td>";
            echo "<td><b>Direccion</b></td>";
            echo "<td><b>Edad</b></td>";
            echo "<td><b>TALLA</b></td>";
            echo "<td><b>PESO</b></td>";
            echo "<td><b>IMC</b></td>";
            echo "<td><b>PERIMETRO ABDOMINAL</b></td>";
            echo "<td><b>PRESIÓN ARTERIAL SISTÓLICA</b></td>";
            echo "<td><b>PRESIÓN ARTERIAL DIASTÓLICA</b></td>";
            echo "<td><b>TASA DE FILTRACIÓN GLOMERULAR CKD-EPI</b></td>";
            echo "<td><b>TASA DE FILTRACIÓN GLOMERULAR Cockcroft-Gault</b></td>";
            echo "<td><b>HIPERTENSIÓN ARTERIAL</b></td>";
            echo "<td><b>DIABETES MELLITUS</b></td>";
            echo "<td><b>CLASIFICACIÓN HTA</b></td>";
            echo "<td><b>CLASIFICACIÓN DM</b></td>";
            echo "<td><b>CLASIFICACIÓN ERC ESTADO</b></td>";
            echo "<td><b>CATEGORÍA DE ALBUMINURIA PERSISTENTE</b></td>";
            echo "<td><b>CLASIFICACIÓN ESTADO METABÓLICO</b></td>";
            echo "<td><b>CLASIFICACIÓN RCV</b></td>";
            echo "<td><b>Sexo</b></td>";
            echo "<td><b>Genero</b></td>";
            echo "<td><b>Departamento Afiliado</b></td>";
            echo "<td><b>Municipio Afiliado</b></td>";
            echo "<td><b>Telefono</b></td>";
            echo "<td><b>Fecha Solicitud Cita</b></td>";
            echo "<td><b>Fecha en que el usuario solicita le sea asignada la cita (fecha deseada)</b></td>";
            echo "<td><b>Fecha para la cual se asigna la cita</b></td>";
            echo "<td><b>Cups</b></td>";
            echo "<td><b>Nombre del CUPS / Examen</b></td>";
            echo "<td><b>Zona</b></td>";
echo "<td><b>Brigada</b></td>";
            echo "<td><b>Departamento IPS</b></td>";
            echo "<td><b>NIT</b></td>";
            echo "<td><b>Codigo Habilitacion</b></td>";
            echo "<td><b>Razon Social de Institución prestadora de servicios</b></td>";
            echo "<td><b>Servicio Solicitado</b></td>";
            echo "<td><b>Regimen</b></td>";
            echo "<td><b>Fecha apertura hc</b></td>";
            echo "<td><b>Fecha cierre hc</b></td>";
            echo "<td><b>Medico</b></td>";
            echo "<td><b>AUX</b></td>";
            echo "<td></td>";
            echo "<td><b>Tipo Profesional</b></td>";
            echo "<td><b>Codigo Trabajo</b></td>";
            echo "</tr>"; 
            
            echo "<tbody>";
            foreach ($data as $d) {
                // Calcular edad
                list($anio, $mes, $dia) = explode("-", $d->pacFecNacimiento);
                $anio_dif = date("Y") - $anio;
                $mes_dif = date("m") - $mes;
                $dia_dif = date("d") - $dia;
    
                if ($dia_dif < 0 || $mes_dif < 0) {
                    $anio_dif--;
                }
                
                $sexo = ($d->pacSexo == 'M') ? 'Hombre' : 'Mujer';
                
                // Helper function para valores por defecto
                $getValue = function($value) {
                    return (isset($value) && $value != '' && $value != null) ? $value : 'sin dato';
                };
    
                echo "<tr>";
                echo "<td>" . mb_strtoupper($d->pacNombre, 'UTF-8') . "</td>";
                echo "<td>" . mb_strtoupper($d->pacNombre2, 'UTF-8') . "</td>";
                echo "<td>" . mb_strtoupper($d->pacApellido, 'UTF-8') . "</td>";
                echo "<td>" . mb_strtoupper($d->pacApellido2, 'UTF-8') . "</td>";
                echo "<td>" . $d->nom_abreviacion . "</td>";
                echo "<td>" . $d->pacDocumento . "</td>";
                echo "<td>" . $d->pacFecNacimiento . "</td>";
                echo "<td>" . $d->pacDireccion . "</td>";
                echo "<td>" . $anio_dif . "</td>";
                echo "<td>" . str_replace('.', '', $d->hcTalla) . "</td>";
                echo "<td>" . $getValue($d->hcPeso) . "</td>";
                echo "<td>" . $getValue($d->hcIMC) . "</td>";
                echo "<td>" . $getValue($d->hcPerimetroAbdominal) . "</td>";
                echo "<td>" . $getValue($d->hcPresionArterialSistolicaSentadoPie) . "</td>";
                echo "<td>" . $getValue($d->hcPresionArterialDistolicaSentadoPie) . "</td>";
                echo "<td>" . $getValue($d->tasa_filtracion_glomerular_ckd_epi) . "</td>";
                echo "<td>" . $getValue($d->tasa_filtracion_glomerular_gockcroft_gault) . "</td>";
                echo "<td>" . $getValue($d->hcHipertensionArterialPersonal) . "</td>";
                echo "<td>" . $getValue($d->hcDiabetesMellitusPersonal) . "</td>";
                echo "<td>" . $getValue($d->hcClasificacionHta) . "</td>";
                echo "<td>" . $getValue($d->hcClasificacionDm) . "</td>";
                echo "<td>" . $getValue($d->hcClasificacionErcEstado) . "</td>";
                echo "<td>" . $getValue($d->hcClasificacionErcCategoriaAmbulatoriaPersistente) . "</td>";
                echo "<td>" . $getValue($d->hcClasificacionEstadoMetabolico) . "</td>";
                echo "<td>" . $getValue($d->hcClasificacionRcv) . "</td>";
                echo "<td>" . $sexo . "</td>";
                echo "<td>" . $d->pacSexo . "</td>";
                echo "<td>" . $d->depNombre . "</td>";
                echo "<td>" . $d->munNombre . "</td>";
                echo "<td>" . $d->pacTelefono . "</td>";  
                echo "<td>" . $d->citFecha . "</td>";     
                echo "<td>" . $d->citFechaDeseada . "</td>";  
                echo "<td>" . $d->citFechaInicio . "</td>";
                echo "<td>" . $d->N_cups_ajustado . "</td>";
                echo "<td>" . ($d->cupNombre ?? 'N/A') . "</td>";
                echo "<td>" . $d->zonNombre . "</td>";
                echo "<td>" . $d->briNombre . "</td>";   
                echo "<td>Cauca</td>";
                echo "<td>900817959</td>";  
                echo "<td>190010882401</td>";
                echo "<td>Fundacion Nacer Para Vivir IPS</td>";
                echo "<td>" . $d->proNombre . "</td>";
                echo "<td>" . $d->regNombre . "</td>";   
                echo "<td>" . $d->fecha_actual . "</td>";
                echo "<td>" . $d->fecha_final . "</td>";
                echo "<td>" . $d->usuNombre . " " . $d->usuApellido . "</td>";   
                echo "<td>" . $d->idauxiliar . " " . $d->nombreauxiliar . "</td>";
                echo "<td>" . $d->usu_creo_cita . " " . $d->usuNombre . "</td>";
                echo "<td>" . $d->tipo_profesional . "</td>";
                echo "<td>" . $d->codigo_trabajo . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
        } else {
            echo "<tr><td colspan='49'>No se encontró ningún registro para el rango de fechas seleccionado.</td></tr>";
        }
    
        echo "</table>";
        echo '</body></html>';
    }

    public function exportar_1() {
        // create file name
        $filename = 'Informe_' . date('Y-m-d',time()).'.xls';  
    
        $fecha1 = $this->input->post('fecha');
        $fecha2 = $this->input->post('fecha1');
    
        $data = $this->MInforme->ver_pac_by_fecha_y_brigada($fecha1, $fecha2);
    
        header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
        header("Content-Disposition: attachment; filename=$filename");
        header("Pragma: no-cache");
        header("Expires: 0");
        
        // BOM UTF-8 para Excel
        echo "\xEF\xBB\xBF";
    
        echo "<html><head><meta charset=\"UTF-8\"></head><body>";
        echo "<table border=\"1\">";
        
        if (sizeof($data) > 0) {
            // Headers solo los 11 campos requeridos
            echo "<tr>";
            echo "<td><b>No.</b></td>";
            echo "<td><b>SEDE</b></td>";
            echo "<td><b>TIPO DOCUMENTO</b></td>";
            echo "<td><b>NUMERO DOCUMENTO</b></td>";
            echo "<td><b>TELÉFONO</b></td>";
            echo "<td><b>FECHA USUARIO SOLICITA</b></td>";
            echo "<td><b>FECHA REQUERIDA USUARIO</b></td>";
            echo "<td><b>FECHA ASIGNACIÓN IPS</b></td>";
            echo "<td><b>CÓDIGO HABILITACIÓN</b></td>";
            echo "<td><b>CÓDIGO DE SERVICIO</b></td>";
            echo "<td><b>CÓDIGO CUPS</b></td>";
            echo "</tr>";
            
            $contador = 1;
            foreach ($data as $d) {
                echo "<tr>";
                echo "<td>" . $contador . "</td>";
                echo "<td>" . $d->briNombre . "</td>";
                echo "<td>" . $d->nom_abreviacion . "</td>";
                echo "<td>" . $d->pacDocumento . "</td>";
                echo "<td>" . $d->pacTelefono . "</td>";
                echo "<td>" . $d->citFecha . "</td>";
                echo "<td>" . $d->citFechaDeseada . "</td>";
                echo "<td>" . $d->citFechaInicio . "</td>";
                echo "<td>190010882403</td>";
                echo "<td>" . $d->codigo_trabajo . "</td>";
                echo "<td>" . $d->N_cups_ajustado . "</td>";
                echo "</tr>";
                $contador++;
            }
        } else {
            echo "<tr><td>No se encontraron registros para el rango de fechas seleccionado.</td></tr>";
        }
    
        echo "</table>";
        echo "</body></html>";
    
    }     

public function exportar_2() {
    // create file name
    $filename = date('Y-m-d', time()) . '.xls';

    // Obtener las fechas seleccionadas desde el formulario
    $fecha1 = $this->input->post('fecha');
    $fecha2 = $this->input->post('fecha1');

    $idBrigada = $this->input->post('id_brigada');

    // Obtener los campos seleccionados en el formulario
    $campos_seleccionados = $this->input->post('campos');

    $data = $this->MInforme->ver_pac_by_fecha1($fecha1, $fecha2, $idBrigada);

    header("Pragma: public");
    header("Expires: 0");
    header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

    // Imprimir las cabeceras de las columnas
    echo "<table border=1";
    echo "<tr>";
    foreach ($campos_seleccionados as $campo) {
        echo "<td>" . $campo . "</td>";
    }
    echo "</tr>";
 // Agrega aquí los demás campos con sus respectivos nombres de columna
                    // en la base de datos.
    if (sizeof($data) > 0) {
        foreach ($data as $d) {
            list($anio, $mes, $dia) = explode("-", $d->pacFecNacimiento);
            $anio_dif = date("Y") - $anio;
            $mes_dif = date("m") - $mes;
            $dia_dif = date("d") - $dia;

            if($d->pacSexo == 'M'){
                $sexo = 'Hombre';
            }else{
                $sexo = 'Mujer';
            } 

            if ($dia_dif < 0 || $mes_dif < 0) {
                $anio_dif--;
                        //return $anio_dif;
            } 

            echo "<tr>";
            foreach ($campos_seleccionados as $campo) {
                switch ($campo) {
                    case 'Nombre':
                        echo "<td>" . $d->pacNombre . "</td>";
                        break;
                    case 'Seg Nombre':
                        echo "<td>" . $d->pacNombre2 . "</td>";
                        break;
                    case 'Apellido':
                        echo "<td>" . $d->pacApellido . "</td>";
                        break;
                    case 'Apellido2':
                        echo "<td>" . $d->pacApellido2 . "</td>";
                        break;
                    case 'Tipo Documento':
                        echo "<td>" . $d->nom_abreviacion . "</td>";
                        break;
                    case 'Identificación':
                        echo "<td>" . $d->pacDocumento . "</td>";
                        break;
                    case 'Fecha de nacimiento':
                        echo "<td>". $d->pacFecNacimiento . "</td>";
                        break;
                    case 'Edad':
                         echo "<td>" . $anio_dif . "</td>";
                        break;
                    
                    case 'Genero':
                        echo "<td>" . $d->pacSexo . "</td>";
                        break;
                    case 'Departamento Afiliado':
                        echo "<td>" . $d->depNombre . "</td>";
                        break;
                    case 'Municipio Afiliado':
                        echo "<td>" . $d->munNombre . "</td>";
                        break;
                    case 'Telefóno':
                        echo "<td>" . $d->pacTelefono . "</td>";
                        break;
                    case 'Grupo Etnico':
                        echo "<td>" . $d->razNombre . "</td>";
                        break;
                    case 'Grupo Poblacion':
                        echo "<td>28</td>";
                        break;  
                    case 'Orientacion Sexual':
                        echo "<td>6</td>";
                        break;
                    case 'Tipos de Discapacidad':
                         echo "<td>8</td>";
                        break;
                    case 'Codigo Ocupacion':
                        echo "<td>" . $d->ocuCodigo . "</td>";
                        break;   
                    case 'Escolaridad':
                        echo "<td>" . $d->escNombre . "</td>";
                        break; 
                    case 'Codigo DANE Municipio de Residencia':
                        echo "<td>19130</td>";
                        break;    
                    case 'Descripcion Municipio de Residencia':
                        echo "<td>" . $d->municipio_residencia . "</td>";
                        break;   
                    case 'Direccion de Residencia':
                        echo "<td>" . $d->zonNombre ."</td>";
                        break; 
                    case 'Zona':
                        echo "<td>". $d->zonNombre."</td>";
                        break;
                        case 'Zona':
                            echo "<td>". $d->briNombre."</td>";
                            break;
                        ///hasta aqui llega datos del paciente 
                        ///////////sigue datos historia clinica
                        

                    case 'Peso (kg)':
                        echo "<td>" . $d->hcPeso . "</td>";
                        break;
                    case 'Talla (cms)':
                        echo "<td>" . $d->hcTalla . "</td>";
                        break;
                    case 'IMC':
                        echo "<td>". $d->hcIMC . "</td>";
                        break;
                    case 'Perimetro de Cintura':
                        echo "<td>". $d->hcPerimetroAbdominal . "</td>";
                        break;
                    case 'Presion Arterial Sistolica':
                        echo "<td>". $d->hcPresionArterialSistolicaSentadoPie . "</td>";
                        break;
                        case 'Presion Arterial Diastolica':
                            echo "<td>". $d->hcPresionArterialDistolicaSentadoPie . "</td>";
                            break;

                    case 'Codigo Habilitacion IPS de Atencion':
                        echo "<td>" . $d->empCodigo . "</td>";
                        break;
                    case 'Nombre IPS Atencion':
                        echo "<td>" . $d->empNombre ."</td>";
                        break;
                    case 'Fecha de Ingreso al Programa':
                        echo "<td>Fecha de Ingreso al Programa</td>";
                        break;
                    case 'Diagnostico HTA':
                        echo "<td>" . $d->hcHipertensionArterialPersonal ."</td>";
                        break;
                    case 'Fecha Diagnostico HTA':
                        echo "<td>" . $d->citFecha . "</td>";
                            break;
                    case 'Diagnostico DM':
                        echo "<td>" . $d->hcDiabetesMellitusPersonal .  "</td>";
                        break;
                    case 'Fecha Diagnostico DM':
                        echo "<td>" . $d->citFecha . "</td>";
                        break;
                    case 'Tipo de Diabetes':
                        echo "<td>"  . $d->hcClasificacionDm . "</td>";
                        break;
                    case 'Diagnostico EPOC':
                        echo "<td>Diagnostico EPOC</td>";
                        break;
                    case 'Fecha Diagnostico EPOC':
                        echo "<td>Fecha Diagnostico EPOC</td>";
                        break;

                    case 'Diagnostico ERC':
                        echo "<td>" . $d->hcClasificacionErcEstado . "</td>";
                        break;
                    case 'Fecha Diagnostico ERC':
                        echo "<td>" . $d->citFecha . "</td>";
                        break;
                    case 'Dx Enfermedad Cardiaca Isquemica':
                        echo "<td>Dx Enfermedad Cardiaca Isquemica</td>";
                        break;
                    case 'Dx Enfermedad Cerebrovascular':
                        echo "<td>Dx Enfermedad Cerebrovascular</td>";
                        break;
                    case 'Dx Enfermedad Arterial Periferica':
                        echo "<td>Dx Enfermedad Arterial Periferica</td>";
                        break;
                    case 'Dx Insuficiencia Cardiaca':
                        echo "<td>Dx Insuficiencia Cardiaca</td>";
                        break;
                    case 'Dx Retinopatia':
                        echo "<td>Dx Retinopatia</td>";
                        break;
                    case 'Dx Aterosclerosis':
                        echo "<td>Dx Aterosclerosis</td>";
                        break;
                    case 'Discapacidad':
                        echo "<td>Discapacidad</td>";
                        break;
                    case 'Habito Tabaquico':
                        echo "<td>" . $d->hcTabaquismo . "</td>";
                        break;
                    case 'Cocina con Leña':
                        echo "<td>Cocina con Leña</td>";
                         break;
                    case 'Fecha de Control':
                        echo "<td>" . $d->citFecha . "</td>";
                        break;
///////////////comienzo los datos paraclinicos
                    case 'colesterol_total':
                        echo "<td>" . $d->colesterol_total . "</td>";
                        break;
                    case 'colesterol_hdl':
                        echo "<td>" . $d->colesterol_hdl . "</td>";
                        break;
                    case 'trigliceridos':
                        echo "<td>" . $d->trigliceridos . "</td>";
                        break;
                     case 'colesterol_ldl':
                        echo "<td>" . $d->colesterol_ldl . "</td>";
                         break;
                    case 'hemoglobina':
                        echo "<td>" . $d->hemoglobina . "</td>";
                         break;
                    case 'hematocrocito':
                         echo "<td>" . $d->hematocrocito . "</td>";
                         break;
                    case 'plaquetas':
                        echo "<td>" . $d->plaquetas . "</td>";
                        break;
                    case 'hemoglobina_glicosilada':
                        echo "<td>" . $d->hemoglobina_glicosilada . "</td>";
                        break;
                    case 'glicemia_basal':
                        echo "<td>" . $d->glicemia_basal . "</td>";
                        break;
                    case 'glicemia_post':
                        echo "<td>" . $d->glicemia_post . "</td>";
                        break;
                    case 'creatinina':
                        echo "<td>" . $d->creatinina . "</td>";
                        break;
                    case 'creatinuria':
                        echo "<td>" . $d->creatinuria . "</td>";
                        break;
                    case 'microalbuminuria':
                        echo "<td>" . $d->microalbuminuria . "</td>";
                        break;
                    case 'albumina':
                        echo "<td>" . $d->albumina . "</td>";
                        break;
                    case 'relacion_albuminuria_creatinuria':
                        echo "<td>" . $d->relacion_albuminuria_creatinuria . "</td>";
                        break;
                    case 'parcial_orina':
                        echo "<td>" . $d->parcial_orina . "</td>";
                        break;
                    case 'depuracion_creatinina':
                        echo "<td>" . $d->depuracion_creatinina . "</td>";
                        break;
                    case 'creatinina_orina_24':
                        echo "<td>" . $d->creatinina_orina_24 . "</td>";
                        break;
                    case 'proteina_orina_24':
                        echo "<td>" . $d->proteina_orina_24 . "</td>";
                        break;
                    case 'hormona_estimulante_tiroides':
                        echo "<td>" . $d->hormona_estimulante_tiroides . "</td>";
                        break;
                    case 'hormona_paratiroidea':
                        echo "<td>" . $d->hormona_paratiroidea . "</td>";
                        break;
                    case 'albumina_suero':
                        echo "<td>" . $d->albumina_suero . "</td>";
                        break;
                    case 'fosforo_suero':
                        echo "<td>" . $d->fosforo_suero . "</td>";
                        break;
                    case 'nitrogeno_ureico':
                        echo "<td>" . $d->nitrogeno_ureico . "</td>";
                        break;
                    case 'acido_urico_suero':
                        echo "<td>" . $d->acido_urico_suero . "</td>";
                        break;
                    case 'calcio':
                        echo "<td>" . $d->calcio . "</td>";
                        break;
                    case 'sodio_suero':
                        echo "<td>" . $d->sodio_suero . "</td>";
                        break;
                    case 'potasio_suero':
                        echo "<td>" . $d->potasio_suero . "</td>";
                        break;
                    case 'hierro_total':
                        echo "<td>" . $d->hierro_total . "</td>";
                        break;
                    case 'ferritina':
                        echo "<td>" . $d->ferritina . "</td>";
                        break;
                    case 'transferrina':
                        echo "<td>" . $d->transferrina . "</td>";
                        break;
                    case 'fosfatasa_alcalina':
                        echo "<td>" . $d->fosfatasa_alcalina . "</td>";
                        break;
                    case 'acido_folico_suero':
                        echo "<td>" . $d->acido_folico_suero . "</td>";
                        break;
                    case 'vitamina_b12':
                        echo "<td>" . $d->vitamina_b12 . "</td>";
                        break;
                    case 'nitrogeno_ureico_orina_24':
                        echo "<td>" . $d->nitrogeno_ureico_orina_24 . "</td>";
                        break;
            
        /////////////// sigue datos de calidad
                    case 'Fecha Solicitud Cita':
                        echo "<td>" . $d->citFecha . "</td>";
                        break;
                    case 'Fecha en que el usuario le asigna la cita':
                        echo "<td>" . $d->citFechaDeseada . "</td>";
                        break;
                    case 'Fecha Que se le asigna la cita':
                        echo "<td>" . $d->citFechaInicio . "</td>";
                        break;
                    case 'Departamento IPS':
                        echo "<td> Cauca </td>";
                        break;
                    case 'NIT':
                        echo "<td>900817959</td>";
                        break;
                    case 'Codigo Habilitacion':
                        echo "<td>190010882401</td>";
                        break;
                    case 'Razon Social de Institución prestadora de servicios':
                        echo "<td>Fundacion Nacer Para Vivir IPS</td>";
                        break;
                    case 'Servicio Solicitado':
                        echo "<td>". $d->proNombre ."</td>";
                        break;
                    case 'Regimen':
                        echo "<td>". $d->regNombre ."</td>";
                        break;
                    case 'Cups': 
                        echo "<td>" . $d->N_cups_ajustado . "</td>";
                        break;
                  

                    case 'Inicio de cita':
                        echo "<td>". $d->fecha_actual ."</td>";
                        break;
                    case 'Finalización Cita':
                        echo "<td>". $d->fecha_final."</td>";
                        break;
                    case 'Medico':
                        echo "<td>". $d->usuNombre ." " . $d->usuApellido . "</td>";
                        break;
                    case 'Auxiliar':
                        echo "<td>". $d->nombreauxiliar . "</td>";
                        break;
                    case 'Tipo Profesional':
                        echo "<td>" . $d->tipo_profesional . "</td>";
                        break;
                    case 'Codigo Trabajo':
                        echo "<td>" . $d->codigo_trabajo . "</td>";
                        break;
                                                                                            
                }
            }
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='" . sizeof($campos_seleccionados) . "'>No se encontraron datos para las fechas seleccionadas.</td></tr>";
    }

    echo "</table>";
}

public function exportar3() {
    $filename = 'informe_facturacion_' . date('Y-m-d') . '.xls';

    $fecha1 = $this->input->post('fecha');
    $fecha2 = $this->input->post('fecha1');

    $data = $this->MInforme->informe_facturacion($fecha1, $fecha2);

    header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
    header("Content-Disposition: attachment; filename=$filename");
    header("Pragma: no-cache");
    header("Expires: 0");

    // BOM UTF-8 para Excel
    echo "\xEF\xBB\xBF";

    echo "<html><head><meta charset='UTF-8'></head><body>";
    echo "<table border='1'>";
    echo "<tr style='background-color:#f2f2f2; font-weight:bold;'>";
    echo "<th>Tipo Documento</th>";
    echo "<th>Documento</th>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "<th>Fecha</th>";
    echo "<th>CUPS</th>";
    echo "<th>Nombre del CUPS / Examen</th>";
    echo "<th>Estado Factura</th>";
    echo "<th>Profesional</th>";
    echo "</tr>";

    if (!empty($data)) {
        foreach ($data as $d) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($d->tipo_documento ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($d->documento ?? 'N/A') . "</td>";
            echo "<td>" . strtoupper(htmlspecialchars($d->nombre ?? '')) . "</td>";
            echo "<td>" . strtoupper(htmlspecialchars($d->apellido ?? '')) . "</td>";
            echo "<td>" . htmlspecialchars($d->fecha ?? '') . "</td>";
            echo "<td>" . htmlspecialchars($d->cups ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($d->nombre_cups ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($d->estado_factura ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars(($d->usuNombre ?? 'N/A') . ' ' . ($d->usuApellido ?? 'N/A')) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No se encontraron registros para el rango de fechas seleccionado.</td></tr>";
    }

    echo "</table>";
    echo "</body></html>";
}

public function exportar_json() {
    $fecha1 = $this->input->post('fecha');
    $fecha2 = $this->input->post('fecha1');
    
    $data = $this->MInforme->informe_json_rips($fecha1, $fecha2);
    
    // Agrupar datos por paciente
    $pacientes_agrupados = [];
    foreach ($data as $registro) {
        $documento = trim($registro->documento); // ✅ TRIM para eliminar espacios
        if (!isset($pacientes_agrupados[$documento])) {
            $pacientes_agrupados[$documento] = [
                'info_paciente' => $registro,
                'servicios' => [
                    'facturado' => [],
                    'no_facturado' => [],
                    'laboratorio_sin_cita' => []
                ]
            ];
        }
        
        // Clasificar servicios por estado
        switch ($registro->estado_factura) {
            case 'Facturado':
            case 'Finalizado':
                $pacientes_agrupados[$documento]['servicios']['facturado'][] = $registro;
                break;
            case 'No facturado':
                $pacientes_agrupados[$documento]['servicios']['no_facturado'][] = $registro;
                break;
            case 'Laboratorio sin cita':
                $pacientes_agrupados[$documento]['servicios']['laboratorio_sin_cita'][] = $registro;
                break;
        }
    }
    
    // Construir estructura JSON RIPS
    $json_structure = [
        "numDocumentoIdObligado" => "900817959",
        "numFactura" => null,
        "tipoNota" => "RS",
        "numNota" => "PGP",
        "usuarios" => []
    ];
    
    // ✅ SOLUCIÓN: Inicializar consecutivo solo UNA VEZ
    $consecutivo_global = 1;
    
    foreach ($pacientes_agrupados as $documento => $paciente_data) {
        $info_paciente = $paciente_data['info_paciente'];
        
        // Verificar que el documento no esté vacío
        if (empty($documento) || $documento == null) {
            continue; // Saltar este paciente si no tiene documento
        }
        
        // Obtener información adicional del paciente
        $info_adicional = $this->obtener_info_adicional_paciente($documento);
        
        $usuario = [
            "tipoDocumentoIdentificacion" => $info_paciente->tipo_documento ?? "CC",
            "numDocumentoIdentificacion" => trim($documento),
            "tipoUsuario" => "02",
            "fechaNacimiento" => $info_adicional->fecha_nacimiento ?? "1980-01-01",
            "codSexo" => $info_adicional->sexo ?? "M",
            "codPaisResidencia" => "170",
            "codMunicipioResidencia" => "19130",
            "codZonaTerritorialResidencia" => "01",
            "incapacidad" => "NO",
            "codPaisOrigen" => "170",
            "consecutivo" => $consecutivo_global,
            "servicios" => []
        ];
        
        $consecutivo_servicio = 1;
        $consultas_agregadas = [];
        $tiene_servicios = false;
        
        // Arrays temporales para consultas y procedimientos
        $consultas_temp = [];
        $procedimientos_temp = [];
        
        // Procesar servicios facturados
        foreach ($paciente_data['servicios']['facturado'] as $servicio) {
            if ($this->es_consulta($servicio->cups)) {
                if (!in_array($servicio->cups, $consultas_agregadas)) {
                    $consultas_temp[] = [
                        "causaMotivoAtencion" => "38",
                        "codConsulta" => $servicio->cups,
                        "codDiagnosticoPrincipal" => "I10X",
                        "codDiagnosticoRelacionado1" => "E660",
                        "codDiagnosticoRelacionado2" => null,
                        "codDiagnosticoRelacionado3" => null,
                        "codPrestador" => "191300882403",
                        "codServicio" => 325,
                        "consecutivo" => $consecutivo_servicio++,
                        "fechaInicioAtencion" => $this->formatear_fecha_hora($servicio->fecha),
                        "finalidadTecnologiaSalud" => "44",
                        "grupoServicios" => "01",
                        "modalidadGrupoServicioTecSal" => "01",
                        "numAutorizacion" => "",
                        "numDocumentoIdentificacion" => trim($documento),
                        "numFEVPagoModerador" => "",
                        "tipoDiagnosticoPrincipal" => "03",
                        "tipoDocumentoIdentificacion" => $info_paciente->tipo_documento ?? "CC",
                        "conceptoRecaudo" => "05",
                        "valorPagoModerador" => 0,
                        "vrServicio" => 0
                    ];
                    $consultas_agregadas[] = $servicio->cups;
                    $tiene_servicios = true;
                }
            } else {
                $procedimientos_temp[] = [
                    "codPrestador" => "191300882403",
                    "fechaInicioAtencion" => $this->formatear_fecha_hora($servicio->fecha),
                    "idMIPRES" => null,
                    "numAutorizacion" => "",
                    "codProcedimiento" => $servicio->cups,
                    "viaIngresoServicioSalud" => "02",
                    "modalidadGrupoServicioTecSal" => "01",
                    "grupoServicios" => "01",
                    "codServicio" => 325,
                    "finalidadTecnologiaSalud" => "44",
                    "tipoDocumentoIdentificacion" => "CC",
                    "numDocumentoIdentificacion" => trim($documento),
                    "codDiagnosticoPrincipal" => "I10X",
                    "codDiagnosticoRelacionado" => null,
                    "codComplicacion" => null,
                    "vrServicio" => 0,
                    "conceptoRecaudo" => "05",
                    "valorPagoModerador" => 0,
                    "numFEVPagoModerador" => "FACP522",
                    "consecutivo" => $consecutivo_servicio++
                ];
                $tiene_servicios = true;
            }
        }
        
        // Procesar servicios no facturados, laboratorios
        foreach ($paciente_data['servicios']['no_facturado'] as $servicio) {
            if ($this->es_consulta($servicio->cups)) {
                if (!in_array($servicio->cups, $consultas_agregadas)) {
                    $consultas_temp[] = [
                        "causaMotivoAtencion" => "38",
                        "codConsulta" => $servicio->cups,
                        "codDiagnosticoPrincipal" => "I10X",
                        "codDiagnosticoRelacionado1" => "E660",
                        "codDiagnosticoRelacionado2" => null,
                        "codDiagnosticoRelacionado3" => null,
                        "codPrestador" => "191300882403",
                        "codServicio" => 325,
                        "consecutivo" => $consecutivo_servicio++,
                        "fechaInicioAtencion" => $this->formatear_fecha_hora($servicio->fecha),
                        "finalidadTecnologiaSalud" => "44",
                        "grupoServicios" => "01",
                        "modalidadGrupoServicioTecSal" => "01",
                        "numAutorizacion" => "",
                        "numDocumentoIdentificacion" => trim($documento),
                        "numFEVPagoModerador" => "",
                        "tipoDiagnosticoPrincipal" => "03",
                        "tipoDocumentoIdentificacion" => $info_paciente->tipo_documento ?? "CC",
                        "conceptoRecaudo" => "05",
                        "valorPagoModerador" => 0,
                        "vrServicio" => 0
                    ];
                    $consultas_agregadas[] = $servicio->cups;
                    $tiene_servicios = true;
                }
            } else {
                $procedimientos_temp[] = [
                    "codPrestador" => "191300882403",
                    "fechaInicioAtencion" => $this->formatear_fecha_hora($servicio->fecha),
                    "idMIPRES" => null,
                    "numAutorizacion" => "",
                    "codProcedimiento" => $servicio->cups,
                    "viaIngresoServicioSalud" => "02",
                    "modalidadGrupoServicioTecSal" => "01",
                    "grupoServicios" => "01",
                    "codServicio" => 325,
                    "finalidadTecnologiaSalud" => "44",
                    "tipoDocumentoIdentificacion" => "CC",
                    "numDocumentoIdentificacion" => trim($documento),
                    "codDiagnosticoPrincipal" => "I10X",
                    "codDiagnosticoRelacionado" => null,
                    "codComplicacion" => null,
                    "vrServicio" => 0,
                    "conceptoRecaudo" => "05",
                    "valorPagoModerador" => 0,
                    "numFEVPagoModerador" => "FACP522",
                    "consecutivo" => $consecutivo_servicio++
                ];
                $tiene_servicios = true;
            }
        }
        
        // Procesar laboratorios sin cita
        foreach ($paciente_data['servicios']['laboratorio_sin_cita'] as $servicio) {
            $procedimientos_temp[] = [
                "codPrestador" => "191300882403",
                "fechaInicioAtencion" => $this->formatear_fecha_hora($servicio->fecha),
                "idMIPRES" => null,
                "numAutorizacion" => "",
                "codProcedimiento" => $servicio->cups,
                "viaIngresoServicioSalud" => "02",
                "modalidadGrupoServicioTecSal" => "01",
                "grupoServicios" => "01",
                "codServicio" => 325,
                "finalidadTecnologiaSalud" => "44",
                "tipoDocumentoIdentificacion" => "CC",
                "numDocumentoIdentificacion" => trim($documento),
                "codDiagnosticoPrincipal" => "I10X",
                "codDiagnosticoRelacionado" => null,
                "codComplicacion" => null,
                "vrServicio" => 0,
                "conceptoRecaudo" => "05",
                "valorPagoModerador" => 0,
                "numFEVPagoModerador" => "FACP522",
                "consecutivo" => $consecutivo_servicio++
            ];
            $tiene_servicios = true;
        }
        
        // Solo agregar el usuario si tiene servicios
        if ($tiene_servicios) {
            // Solo agregar consultas si existen
            if (!empty($consultas_temp)) {
                $usuario["servicios"]["consultas"] = $consultas_temp;
            }
            
            // Solo agregar procedimientos si existen
            if (!empty($procedimientos_temp)) {
                $usuario["servicios"]["procedimientos"] = $procedimientos_temp;
            }
            
            $json_structure["usuarios"][] = $usuario;
            $consecutivo_global++;
        }
    }
    
    // Enviar respuesta JSON
    header('Content-Type: application/json; charset=utf-8');
    header('Content-Disposition: attachment; filename="rips_cajibio_' . date('Y-m', strtotime($fecha1)) . '.json"');
    echo json_encode($json_structure, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

private function formatear_fecha_hora($fecha) {
    if (empty($fecha)) {
        return date('Y-m-d') . ' 00:00';
    }
    
    $timestamp = strtotime($fecha);
    if ($timestamp === false) {
        return date('Y-m-d') . ' 00:00';
    }
    
    $fecha_original = date('H:i:s', $timestamp);
    if ($fecha_original == '00:00:00') {
        return date('Y-m-d', $timestamp) . ' 00:00';
    }
    
    return date('Y-m-d H:i', $timestamp);
}

private function obtener_info_adicional_paciente($documento) {
    return $this->db->query("
        SELECT 
            pacFecNacimiento as fecha_nacimiento,
            pacSexo as sexo
        FROM paciente 
        WHERE pacDocumento = ?
    ", [$documento])->row();
}

private function es_consulta($cups_code) {
    $consulta_ranges = ['890', '891', '892', '893'];
    $codigo_str = (string)$cups_code;
    
    foreach ($consulta_ranges as $range) {
        if (strpos($codigo_str, $range) === 0) {
            return true;
        }
    }
    return false;
}

}