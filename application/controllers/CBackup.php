<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CBackup extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("MPaciente");
        $this->load->model("MAgenda");
        $this->load->model("MCita");
        $this->load->model("MHistoria");
    }


    public function index()
    {

        $data['title'] = 'IPS | BACKUP';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");



        $this->load->view("CBACKUP/VConsultar.php");

        $this->load->view("CPlantilla/VFooter");
    }
    ///Why does he catch in the header
    public function backup_hc()
    {

        $data['title'] = 'IPS | BACKUP';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");



        $this->load->view("CBACKUP/VConsultar_hc.php");

        $this->load->view("CPlantilla/VFooter");
    }
    ///Here are the different functions to extract the information by means of date range to synchronize general SQL code in a TXT

    public function backup_pacActualizado()
    {

        $data['title'] = 'IPS | BACKUP';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");



        $this->load->view("CBACKUP/VConsultarmodi.php");

        $this->load->view("CPlantilla/VFooter");
    }
    

    public function exportar_sql_hc()
    {
        $nombre_archivo = "HC_Datos";
        $fecha1 = $this->input->post('fecha');
        $fecha2 = $this->input->post('fecha1');

        $max_ids = [
            'paciente' => (int) $this->input->post('paciente_ids'),
            'agenda' => (int) $this->input->post('agenda_ids'),
            'cita' => (int) $this->input->post('cita_ids'),
            'hc' => (int) $this->input->post('hc_ids'),
            'hc_complementaria' => (int) $this->input->post('hc_complementaria_ids'),
            'historia_medicamento' => (int) $this->input->post('hc_medicamento_ids'),
            'historia_cups' => (int) $this->input->post('hc_cups_ids'),
            'historia_diagnostico' => (int) $this->input->post('hc_diagnostico_ids'),
            'historia_remision' => (int) $this->input->post('hc_remision_ids')
        ];

        $data_paciente = $this->MPaciente->ver_paciente_by_fecha($fecha1, $fecha2);
        $data_agenda = $this->MAgenda->ver_agenda_by_fecha($fecha1, $fecha2);
        $data_cita = $this->MCita->ver_cita_by_fecha($fecha1, $fecha2);
        $data_hc = $this->MHistoria->ver_hc_by_fecha($fecha1, $fecha2);
        $data_hc_complementaria = $this->MHistoria->ver_hc_complementaria_by_fecha($fecha1, $fecha2);
        $data_hc_medicamento = $this->MHistoria->ver_hc_medicamento_by_fecha($fecha1, $fecha2);
        $data_hc_cups = $this->MHistoria->ver_hc_cups_by_fecha($fecha1, $fecha2);
        $data_hc_diagnostico = $this->MHistoria->ver_hc_diagnostico_by_fecha($fecha1, $fecha2);
        $data_hc_remision = $this->MHistoria->ver_hc_remision_by_fecha($fecha1, $fecha2);

        if (
            empty($data_paciente) && empty($data_agenda) && empty($data_cita) &&
            empty($data_hc) && empty($data_hc_complementaria) && empty($data_hc_medicamento) &&
            empty($data_hc_cups) && empty($data_hc_diagnostico) && empty($data_hc_remision)
        ) {
            print "NO HAY DATOS PARA MOSTRAR";
            return;
        }

        $datos_tablas = [
            'paciente' => $this->MPaciente->get_field(),
            'agenda' => $this->MAgenda->get_campos_agenda(),
            'cita' => $this->MCita->get_campos_cita(),
            'hc' => $this->MHistoria->get_campos_hc(),
            'hc_complementaria' => $this->MHistoria->get_campos_hc_complementaria(),
            'historia_medicamento' => $this->MHistoria->get_campos_hc_medicamento(),
            'historia_cups' => $this->MHistoria->get_campos_hc_cups(),
            'historia_diagnostico' => $this->MHistoria->get_campos_hc_diagnostico(),
            'historia_remision' => $this->MHistoria->get_campos_hc_remision()
        ];

        $mapa_ids = [];

        $primary_key_fields = [
            'paciente' => 'idPaciente',
            'agenda' => 'idAgenda',
            'cita' => 'idCita',
            'hc' => 'id_hc',
            'hc_complementaria' => 'id_hc_complementaria',
            'historia_medicamento' => 'id_his_med',
            'historia_cups' => 'id_his_cups',
            'historia_diagnostico' => 'id_his_dia',
            'historia_remision' => 'id_his_rem'
        ];

        $foreign_key_mappings = [
            'paciente_idPaciente' => 'paciente',
            'agenda_idAgenda' => 'agenda',
            'cita_idCita' => 'cita',
            'hc_idHc' => 'hc',
            'historia_idHistoria' => 'hc'
        ];

        $tablas_ordenadas = [
            'paciente' => $data_paciente,
            'agenda' => $data_agenda,
            'cita' => $data_cita,
            'hc' => $data_hc,
            'hc_complementaria' => $data_hc_complementaria,
            'historia_diagnostico' => $data_hc_diagnostico,
            'historia_cups' => $data_hc_cups,
            'historia_medicamento' => $data_hc_medicamento,
            'historia_remision' => $data_hc_remision
        ];

        $hc_campos_nullables = $this->MHistoria->get_campos_nullables_hc();

        ob_start();

        foreach ($tablas_ordenadas as $tabla => $data) {
            if (empty($data)) {
                continue;
            }

            $datos_tabla = $datos_tablas[$tabla];
            $id_column = $primary_key_fields[$tabla];

            echo "--\r\n-- Volcado de datos para la tabla `$tabla`\r\n--\r\n\r\n";
            echo "INSERT INTO `$tabla` (" . implode(",", array_map(function ($field) {
                return "`$field`";
            }, $datos_tabla)) . ") VALUES\r\n";

            $valores_insert = [];

            foreach ($data as $row) {
                $row_sql = [];
                $id_original = $row->$id_column;

                if (!isset($mapa_ids[$tabla][$id_original])) {
                    $max_ids[$tabla]++;
                    $mapa_ids[$tabla][$id_original] = $max_ids[$tabla];
                }

                foreach ($datos_tabla as $column) {
                    $value = isset($row->$column) ? $row->$column : null;

                    if ($column === $id_column) {
                        $row_sql[] = "'" . $mapa_ids[$tabla][$id_original] . "'";
                        continue;
                    }

                    if (isset($foreign_key_mappings[$column])) {
                        $tabla_relacionada = $foreign_key_mappings[$column];

                        if ($tabla === 'cita' && $column === 'paciente_idPaciente') {
                            $row_sql[] = $value !== null && isset($mapa_ids['paciente'][$value])
                                ? "'" . $mapa_ids['paciente'][$value] . "'"
                                : ($value !== null ? "'" . addslashes($value) . "'" : "NULL");
                        } else {
                            $row_sql[] = ($value !== null && isset($mapa_ids[$tabla_relacionada][$value]))
                                ? "'" . $mapa_ids[$tabla_relacionada][$value] . "'"
                                : "NULL";
                        }

                        continue;
                    }

                    if ($tabla === 'hc' && in_array($column, $hc_campos_nullables, true)) {
                        $row_sql[] = ($value === '' || $value === null) ? "NULL" : "'" . addslashes($value) . "'";
                        continue;
                    }

                    $row_sql[] = $value !== null ? "'" . addslashes($value) . "'" : "''";
                }

                $valores_insert[] = "(" . implode(",", $row_sql) . ")";
            }

            if (!empty($valores_insert)) {
                echo implode(",\r\n", $valores_insert) . ";\r\n\r\n";
            }
        }

        $datos = ob_get_clean();
        header('Content-type: text/plain');
        header("Content-Disposition: attachment; filename=\"$nombre_archivo.txt\"");
        print $datos;
    }

    public function exportar_sql_paciente()
    {

        $nombre_archivo = "SQL_PACIENTES";

        $fecha1 = $this->input->post('fecha');
        $fecha2 = $this->input->post('fecha1');


        $data = $this->MPaciente->ver_paciente_by_fecha($fecha1, $fecha2);


        $field = $this->MPaciente->get_field();



    
        if ($nombre_archivo) {

            header('Content-type: text/plain');
            header("Content-Disposition: attachment; filename=\"$nombre_archivo.txt\"");

            $datos =   "INSERT INTO `paciente` (";

            foreach ($field as $f) {
                $datos .=   "`" . $f . "`,";
            }

            //$datos .=   ")VALUES";


            $datos = substr($datos, 0, -1);
            $datos .= ')';

            $datos .= ' VALUES' . "\r\n";

            foreach ($data as $p) {
                $datos .= '(';



                $datos .=



                 /*1"''" */    $p->idPaciente. ",'" 
                /*3*/          . $p->empresa_idEmpresa   . "','" 
                /*4*/    . $p->regimen_idRegimen . "','" 
                /*5*/         . $p->id_tipo_afiliacion . "','" 
                /*6*/         . $p->id_zona_residencia . "','" 
                /*7*/      . $p->depto_nacimiento . "','" 
                /*8*/         . $p->depto_residencia . "','" 
                /*9*/          . $p->municipio_nacimiento . "','" 
                /*10*/       . $p->municipio_residencia . "','" 
                /*11*/             . $p->raza_idRaza . "','" 
                /*12*/         . $p->escolaridad_idEscolaridad . "','" 
                /*13*/          . $p->parentesco_idParentesco . "','" 
                /*14*/          . $p->pacTipDocumento . "','"
                /*15*/             . $p->pacRegistro . "','"
                /*16*/             . $p->pacNombre . "','" 
                /*17*/             . $p->pacNombre2 . "','" 
                /*18*/             . $p->pacApellido . "','" 
                /*19*/              . $p->pacApellido2 . "','" 
                /*20*/             . $p->pacDocumento . "','" 
                /*21*/                  . $p->pacFecNacimiento . "','" 
                /*22*/                   . $p->pacSexo . "','" 
                /*23*/                . $p->pacDireccion . "','" 
                /*24*/                   . $p->pacTelefono . "','" 
                /*25*/               . $p->pacCorreo . "','" 
                /*26*/                 . $p->pacObservacion . "','" 
                /*27*/                 . $p->pacEstCivil . "','" 
                /*28*/                . $p->pacOcupacion . "','" 
                /*29*/                 . $p->nombre_acudiente . "','" 
                /*30*/                 . $p->pacParentesco . "','" 
                /*31*/              . $p->telefono_acudiente . "','" 
                /*32*/            . $p->direccion_acudiente . "','" 
                /*33*/              . $p->pacEstado . "','" 
                /*34*/               . $p->pacAcompananteNombre . "','" 
                /*35*/              . $p->pacAcompananteTelefono . "','"
				/*36*/               . $p->pacFecRegistro . "','"
				/*37*/              . $p->novedad_idnovedad . "','"
                 /*38*/               .$p->auxiliar_idauxiliar . "','"
                                       .$p->Brigada_idBrigada . "','"
                                       .$p->Fecha_Actua . "''";
                                      
                                



                $datos = substr($datos, 0, -1);
                $datos .= '),';
            }
            $datos = substr($datos, 0, -1) . '; ';

            print $datos;
        } else {

            $datos = "NO HAY DATOS PARA MOSTRAR";
            print $datos;
        }
    }

    public function exportar_sql_paciente_actua()
        {
            $nombre_archivo = "SQL_PACIENTES";
        
            $fecha1 = $this->input->post('fecha');
            $fecha2 = $this->input->post('fecha1');
        
            $data = $this->MPaciente->ver_paciente_by_actualizar($fecha1, $fecha2);
            $field = $this->MPaciente->get_field();
        
            if ($nombre_archivo && !empty($data)) {
                header('Content-type: text/plain');
                header("Content-Disposition: attachment; filename=\"$nombre_archivo.txt\"");
        
                foreach ($data as $p) {
                    // Genera la consulta de actualización
                    $update_query = "UPDATE `paciente` SET ";
                    foreach ($field as $f) {
                        $value = $this->db->escape($p->$f);
                        $update_query .= "`$f` = $value, ";
                    }
                    $update_query = rtrim($update_query, ', '); // Elimina la coma y el espacio extra al final
                    $update_query .= " WHERE `idPaciente` = {$p->idPaciente};";
                    echo $update_query . "\r\n";
                }
            } else {
                $datos = "NO HAY DATOS PARA EXPORTAR";
                echo $datos;
            }
        }
        
}
