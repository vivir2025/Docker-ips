<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CHistoria extends CI_Controller
{

    //primeraVez_control1

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model("MHistoria");
        $this->load->model("MHistorial");
        $this->load->model("MCita");
        $this->load->model("MMedicamento");
    }

    // This part is the functionality of the different medical records that are used if it is the first time control among others There is all its logic

    public function consultar_medicamento()
    {

        //$id_his_med = $this->input->post('id_his_med');

        $postData = $this->input->post();

        $medicamento = $this->MHistoria->ver_medicamento($postData);

        echo json_encode($medicamento);
        //json_encode($medicamento);

    }

    public function actualizar_medicamento()
    {

        $id = $this->input->post('id_his_med_actualizacion');

        $data = array(
            'hisMedCantidad' => $this->input->post('cantidad'),
            'hisMedDosis' => $this->input->post('dosis')
        );

        $this->MHistoria->actualizar_diagnostico($data, $id);


        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
        Registro actualizado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }

    public function index()
    {

        $data['title'] = 'IPS | AGENDA' . " " . date("Y-m-d", time());

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $this->load->view("CHistoria/VListar.php");

        $this->load->view("CPlantilla/VFooter");
    }
    public function desentimiento()
    {
        $data['title'] = 'HISTORIAL DESENTIMIENTO';

        $this->load->view("CPlantilla/VHead", $data);
        $this->load->view("CPlantilla/VBarraMenu");
        $this->load->view("CHistorial/L_vdesentimiento.php");
        $this->load->view("CPlantilla/VFooter");
    }

    public function visitas()
    {
        $data['title'] = 'HISTORIAL DE VISITAS';

        $this->load->view("CPlantilla/VHead", $data);
        $this->load->view("CPlantilla/VBarraMenu");
        $this->load->view("CHistorial/L_visitas.php");
        $this->load->view("CPlantilla/VFooter");
    }

    public function contador()
    {
    
        $data['title'] = 'IPS | IMPORTAR VISITAS';
    
        $this->load->view("CPlantilla/VHead", $data);
    
        $this->load->view("CPlantilla/VBarraMenu");
    
        $this->load->view("CHistorial/VContador.php");
    
        $this->load->view("CPlantilla/VFooter");
    }
    public function agenda_cita()
    {
        $idProceso = $this->input->post('idProceso');
        $idUsuario = $this->session->userdata('id_user');
        $fecha = date("Y-m-d", time());

        $consulta = $this->MHistoria->getItinerarioAgendaUser($idUsuario, $fecha);

        if (sizeof($consulta) == 0) {
            echo '<div class="empty-state">';
            echo '<i class="far fa-calendar-times"></i>';
            echo '<h5>No tienes agendas para hoy</h5>';
            echo '<p>Disfruta tu día libre o revisa si hay agendas programadas para otros días</p>';
            echo '</div>';
            return;
        }

        foreach ($consulta as $con) {

            // Filtrar citas por idAgenda específico para evitar duplicados
            $cita = $this->MHistoria->informacion_cita_por_agenda($con->idAgenda, $fecha);

            echo "<div class='agenda-card'>";
            echo "<div class='agenda-info-header'>";
            echo "<h5><i class='far fa-calendar-alt'></i> Agenda del " . date("d/m/Y", strtotime($con->ageFecha)) . "</h5>";
            echo "<div class='agenda-details'>";
            echo "<div class='agenda-detail-item'>";
            echo "<i class='fas fa-user-md'></i>";
            echo "<div>";
            echo "<span class='label'>Profesional</span>";
            echo "<span class='value'>" . $con->usuNombre . " " . $con->usuApellido . "</span>";
            echo "</div>";
            echo "</div>";
            echo "<div class='agenda-detail-item'>";
            echo "<i class='fas fa-stethoscope'></i>";
            echo "<div>";
            echo "<span class='label'>Proceso</span>";
            echo "<span class='value'>" . $con->proNombre . "</span>";
            echo "</div>";
            echo "</div>";
            echo "<div class='agenda-detail-item'>";
            echo "<i class='fas fa-map-marker-alt'></i>";
            echo "<div>";
            echo "<span class='label'>Sede</span>";
            echo "<span class='value'>" . $con->sedNombre . "</span>";
            echo "</div>";
            echo "</div>";
            echo "<div class='agenda-detail-item'>";
            echo "<i class='fas fa-door-open'></i>";
            echo "<div>";
            echo "<span class='label'>Consultorio</span>";
            echo "<span class='value'>" . $con->ageConsultorio . "</span>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";

            if (sizeof($cita) > 0) {
                echo "<table class='agenda-table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th><i class='far fa-clock'></i> Hora</th>";
                echo "<th><i class='fas fa-user'></i> Paciente</th>";
                echo "<th><i class='fas fa-hospital'></i> EPS</th>";
                echo "<th><i class='fas fa-notes-medical'></i> CUPS</th>";
                echo "<th><i class='fas fa-tag'></i> Tipo</th>";
                echo "<th><i class='fas fa-clipboard'></i> Tipo de Consulta</th>";
                echo "<th><i class='fas fa-info-circle'></i> Estado</th>";
                echo "<th><i class='fas fa-cog'></i> Acción</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                foreach ($cita as $c) {
                    $rowClass = ($c->citEstado == 'FINALIZADO' || $c->citEstado == 'FINALIZADO Y FACTURADO') ? 'finalizado' : '';
                    $clickable = ($c->citEstado == 'PROGRAMADO' || $c->citEstado == 'FACTURADO') ? "onclick='verValoracion($c->idCita, $c->id_cat_cups, $c->proceso_idProceso, $c->pacDocumento)' style='cursor: pointer;'" : '';
                    
                    echo "<tr class='$rowClass' $clickable>";
                    echo "<td><span class='cita-hora'>" . date("h:i A", strtotime($c->citFechaInicio)) . "</span></td>";
                    echo "<td>";
                    echo "<div class='cita-paciente'>" . $c->pacNombre . " " . $c->pacNombre2 . " " . $c->pacApellido . " " . $c->pacApellido2 . "</div>";
                    echo "<div class='cita-documento'>CC: " . $c->pacDocumento . "</div>";
                    echo "</td>";
                    echo "<td>" . $c->empNombre . "</td>";
                    echo "<td>" . $c->cupNombre . "</td>";
                    echo "<td>" . $c->catNombre . "</td>";
                    echo "<td>" . $c->citNota . "</td>";
                    echo "<td>";
                    if ($c->citEstado == 'PROGRAMADO') {
                        echo "<span class='badge-estado badge-programado'><i class='far fa-calendar-check'></i> Programado</span>";
                    } elseif ($c->citEstado == 'FINALIZADO') {
                        echo "<span class='badge-estado badge-finalizado'><i class='fas fa-check-circle'></i> Finalizado</span>";
                    } elseif ($c->citEstado == 'FACTURADO') {
                        echo "<span class='badge-estado badge-facturado'><i class='fas fa-file-invoice-dollar'></i> Facturado</span>";
                    } elseif ($c->citEstado == 'FINALIZADO Y FACTURADO') {
                        echo "<span class='badge-estado badge-finalizado'><i class='fas fa-check-double'></i> Finalizado y Facturado</span>";
                    }
                    echo "</td>";
                    echo "<td>";
                    if ($c->citEstado == 'PROGRAMADO' || $c->citEstado == 'FACTURADO') {
                        echo "<button class='btn-iniciar-cita' onclick='verValoracion($c->idCita, $c->id_cat_cups, $c->proceso_idProceso, $c->pacDocumento)'>";
                        echo "<i class='fas fa-play'></i> Iniciar";
                        echo "</button>";
                    } elseif ($c->citEstado == 'FINALIZADO' || $c->citEstado == 'FINALIZADO Y FACTURADO') {
                        echo "<a class='btn-adicional' href='" . base_url('index.php/CHistoria/adicional/' . $c->id_hc) . "'>";
                        echo "<i class='fas fa-plus'></i> Adicional";
                        echo "</a>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
            } else {
                echo "<div class='empty-state'>";
                echo "<i class='far fa-calendar-times'></i>";
                echo "<h5>No hay citas agendadas</h5>";
                echo "<p>Esta agenda no tiene citas programadas para hoy</p>";
                echo "</div>";
            }
            echo "</div>";
        }
    }

    public function agenda($tipo)
    {

        if ($tipo == 'guardar') {
            $data['tipmsg'] = 'success';
            $data['msg'] = '<strong>Excelente! </strong>registro se añadido correctamente.';
        }

        $data['title'] = 'IPS | AGENDA' . " " . date("Y-m-d", time());

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $this->load->view("CPlantilla/VHeader", $data);

        $this->load->view("CHistoria/VListar.php");

        $this->load->view("CPlantilla/VFooter");
    }


    public function buscar_cups()
    {
        $nombre_cups = $this->input->post('cups');


        $cups = $this->MHistoria->getCupsByNombre($nombre_cups);

        echo "<table class='table table-bordered'>";


        if (sizeof($cups) > 0) {
            foreach ($cups as $c) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_cups(this);' id='" . $c->idCups .
                    '&' . $c->cupNombre . "'>" . $c->cupNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun servicio asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_codigo()
    {

        $codigo = $this->input->post('codigo');

        $diagnostico = $this->MHistoria->ver_codigo($codigo);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . '&' . $d->diaCodigo . "'>" . $d->diaCodigo .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_codigo1()
    {

        $codigo = $this->input->post('codigo');

        $diagnostico = $this->MHistoria->ver_codigo($codigo);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico1(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . '&' . $d->diaCodigo . "'>" . $d->diaCodigo .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_codigo2()
    {

        $codigo = $this->input->post('codigo');

        $diagnostico = $this->MHistoria->ver_codigo($codigo);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico2(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . '&' . $d->diaCodigo . "'>" . $d->diaCodigo .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }


    public function buscar_codigo3()
    {

        $codigo = $this->input->post('codigo');

        $diagnostico = $this->MHistoria->ver_codigo($codigo);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico3(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . '&' . $d->diaCodigo . "'>" . $d->diaCodigo .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_diagnostico()
    {
        $nombre_diagnostico = $this->input->post('diagnostico');

        $diagnostico = $this->MHistoria->ver_diagnostico($nombre_diagnostico);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . "'>" . $d->diaNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_diagnostico1()
    {
        $nombre_diagnostico = $this->input->post('diagnostico');

        $diagnostico = $this->MHistoria->ver_diagnostico($nombre_diagnostico);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico1(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . "'>" . $d->diaNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_diagnostico2()
    {
        $nombre_diagnostico = $this->input->post('diagnostico');

        $diagnostico = $this->MHistoria->ver_diagnostico($nombre_diagnostico);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico2(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . "'>" . $d->diaNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_diagnostico3()
    {
        $nombre_diagnostico = $this->input->post('diagnostico');

        $diagnostico = $this->MHistoria->ver_diagnostico($nombre_diagnostico);

        echo "<table class='table table-bordered'>";


        if (sizeof($diagnostico) > 0) {
            foreach ($diagnostico as $d) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_diagnostico3(this);' id='" . $d->idDiagnostico .
                    '&' . $d->diaNombre . "'>" . $d->diaNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun diagnostico asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_medicamento()
    {
        $nombre_medicamento = $this->input->post('medicamento');


        $medicamento = $this->MHistoria->getMedicamentoByNombre($nombre_medicamento);

        echo "<table class='table table-bordered'>";


        if (sizeof($medicamento) > 0) {
            foreach ($medicamento as $m) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado(this);' id='" . $m->idMedicamento .
                    '&' . $m->medNombre . "'>" . $m->medNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ningun medicamento asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }

    public function buscar_remision()
    {
        $nombre_remision = $this->input->post('remision');


        $remision = $this->MHistoria->getRemisionByNombre($nombre_remision);

        echo "<table class='table table-bordered'>";


        if (sizeof($remision) > 0) {
            foreach ($remision as $r) {
                echo "<tr><td>";
                echo "<a onClick='elemento_selecionado_remision(this);' id='" . $r->idRemision .
                    '&' . $r->remNombre . "'>" . $r->remNombre .
                    "</a>";
                echo "</td></tr>";
            }
        } else {
            echo "<tr><td>No se encontro ninguna remision asociado a ese caracter.</td></tr>";
        }

        echo "</table>";
    }



    public function agregar_medicamento()
    {

        $id_medicamento = $this->input->post('idMedicamento');
        $nombre_medicamento = $this->input->post('medicamento');

        if ($id_medicamento == 0) {

            $data_medicamento = array(
                'medNombre' => $nombre_medicamento
            );

            $id = $this->MMedicamento->guardar($data_medicamento);

            $data = array(
                'medicamento_idMedicamento' => $id,
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'hisMedCantidad' => $this->input->post('cantidad'),
                'hisMedDosis' => $this->input->post('dosis')
            );

            $this->MHistoria->guardar_medicamento($data);
            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        } else {

            $data = array(
                'medicamento_idMedicamento' => $id_medicamento,
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'hisMedCantidad' => $this->input->post('cantidad'),
                'hisMedDosis' => $this->input->post('dosis')
            );

            $this->MHistoria->guardar_medicamento($data);
            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    }



      /////////////To add additional/////////////
      public function agregar_diagnosticot()
      {
          // To obtain primary diagnostic data using id_hc
          $datos = $this->MHistoria->detalle_historia_diagnostico_principal($this->input->post('id_hc'));
      
          if (sizeof($datos) > 0) {
      
              $data = array(
                  'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                  'historia_idHistoria' => $this->input->post('id_hc'), // Unificar id_hc
                  'his_dia_tipo' => $this->input->post('tipo_item'),
                  'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico')
              );
      
              $this->MHistoria->actualizardatos($data, $datos[0]->id_his_dia);
      
              echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
              Registro guardado correctamente
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
              </div>";
          } else {
      
              $data = array(
                  'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                  'historia_idHistoria' => $this->input->post('id_hc'), // Unificar id_hc
                  'his_dia_tipo' => $this->input->post('tipo_item'),
                  'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico')
              );
      
              $this->MHistoria->guardar_diagnostico($data);
      
              echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
              Registro guardado correctamente
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
              </div>";
          }
      }
      
  
      public function agregar_diagnostico1t()
      {
  
  
          $data = array(
              'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
              'historia_idHistoria' => $this->input->post('id_hc'),
              'his_dia_tipo' => $this->input->post('tipo_item'),
              'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico1')
  
          );
  
          $this->MHistoria->guardar_diagnostico($data);
          echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
          Registro guardado correctamente
          <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
          </button>
          </div>";
          //}
      }
  
      public function agregar_diagnostico2t()
      {
  
          $datos = $this->MHistoria->detalle_historia_diagnostico_Dx2($this->input->post('id_hc'));
  
          //print_r($datos);
  
          if (sizeof($datos) > 0) {
  
              $data = array(
                  'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                  'historia_idHistoria' => $this->input->post('id_hc'),
                  'his_dia_tipo' => $this->input->post('tipo_item'),
                  'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico2')
  
              );
  
              $this->MHistoria->actualizardatos($data, $datos[0]->id_his_dia);
  
  
              echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
              Registro guardado correctamente
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
              </div>";
          } else {
  
              $data = array(
                  'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                  'historia_idHistoria' => $this->input->post('id_hc'),
                  'his_dia_tipo' => $this->input->post('tipo_item'),
                  'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico2')
  
              );
  
              $this->MHistoria->guardar_diagnostico($data);
              echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
              Registro guardado correctamente
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
              </div>";
          }
      }
  
      public function agregar_diagnostico3t()
      {
  
          $datos = $this->MHistoria->detalle_historia_diagnostico_Dx3($this->input->post('id_hc'));
  
          //print_r($datos);
  
          if (sizeof($datos) > 0) {
  
              $data = array(
                  'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                  'historia_idHistoria' => $this->input->post('id_hc'),
                  'his_dia_tipo' => $this->input->post('tipo_item'),
                  'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico3')
  
              );
  
              $this->MHistoria->actualizardatos($data, $datos[0]->id_his_dia);
  
  
              echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
              Registro guardado correctamente
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
              </div>";
          } else {
  
              $data = array(
                  'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                  'historia_idHistoria' => $this->input->post('id_hc'),
                  'his_dia_tipo' => $this->input->post('tipo_item'),
                  'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico3')
  
              );
  
              $this->MHistoria->guardar_diagnostico($data);
              echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
              Registro guardado correctamente
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
              </button>
              </div>";
          }
      }
   

    public function agregar_diagnostico()
    {

        $datos = $this->MHistoria->detalle_historia_diagnostico_principal($this->input->post('idHistoria'));

        if (sizeof($datos) > 0) {

            $data = array(
                'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'his_dia_tipo' => $this->input->post('tipo_item'),
                'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico')

            );

            $this->MHistoria->actualizardatos($data, $datos[0]->id_his_dia);


            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        } else {

            $data = array(
                'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'his_dia_tipo' => $this->input->post('tipo_item'),
                'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico')

            );

            $this->MHistoria->guardar_diagnostico($data);
            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    }

    public function agregar_diagnostico1()
    {


        $data = array(
            'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
            'historia_idHistoria' => $this->input->post('idHistoria'),
            'his_dia_tipo' => $this->input->post('tipo_item'),
            'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico1')

        );

        $this->MHistoria->guardar_diagnostico($data);
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
        Registro guardado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
        //}
    }

    public function agregar_diagnostico2()
    {

        $datos = $this->MHistoria->detalle_historia_diagnostico_Dx2($this->input->post('idHistoria'));

        //print_r($datos);

        if (sizeof($datos) > 0) {

            $data = array(
                'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'his_dia_tipo' => $this->input->post('tipo_item'),
                'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico2')

            );

            $this->MHistoria->actualizardatos($data, $datos[0]->id_his_dia);


            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        } else {

            $data = array(
                'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'his_dia_tipo' => $this->input->post('tipo_item'),
                'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico2')

            );

            $this->MHistoria->guardar_diagnostico($data);
            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    }

    public function agregar_diagnostico3()
    {

        $datos = $this->MHistoria->detalle_historia_diagnostico_Dx3($this->input->post('idHistoria'));

        //print_r($datos);

        if (sizeof($datos) > 0) {

            $data = array(
                'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'his_dia_tipo' => $this->input->post('tipo_item'),
                'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico3')

            );

            $this->MHistoria->actualizardatos($data, $datos[0]->id_his_dia);


            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        } else {

            $data = array(
                'diagnostico_idDiagnostico' => $this->input->post('idDiagnostico'),
                'historia_idHistoria' => $this->input->post('idHistoria'),
                'his_dia_tipo' => $this->input->post('tipo_item'),
                'hcTipoDiagnostico' => $this->input->post('tipo_diagnostico3')

            );

            $this->MHistoria->guardar_diagnostico($data);
            echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
            Registro guardado correctamente
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    }

    public function agregar_remision()
    {

        $data = array(
            'remision_idRemision' => $this->input->post('idRemision'),
            'historia_idHistoria' => $this->input->post('idHistoria'),
            'remObservacion' => $this->input->post('observacion')
        );

        $this->MHistoria->guardar_remision($data);
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
        Registro guardado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
    // This is the part to add PDF in medical records
    public function agregar_pdf()
    {
        $data = array(
            'idHistoria' => $this->input->post('idHistoria'),
            'Observación' => $this->input->post('observacion')
        );
    
        if (!empty($_FILES['Archivo']['name'])) {
            $config['upload_path'] = './uploads/pdf/';
            $config['allowed_types'] = 'pdf';
            $config['file_name'] = uniqid() . '_' . $_FILES['Archivo']['name'];
    
            $this->load->library('upload', $config);
    
            if ($this->upload->do_upload('Archivo')) {
                $uploadData = $this->upload->data();
                $data['Archivo'] = 'uploads/pdf/' . $uploadData['file_name'];
            } else {
                echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Error al cargar el PDF: " . $this->upload->display_errors('', '') . "
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
                </button>
                </div>";
                return;
            }
        }
    
        $this->MHistoria->guardar_pdf($data);
    
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
        Registro guardado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
    
    
    
    public function agregar_cups()
    {

        $data = array(
            'cups_idCups' => $this->input->post('idCups'),
            'historia_idHistoria' => $this->input->post('idHistoria'),
            'cupObservacion' => $this->input->post('observacion')
        );

        $this->MHistoria->guardar_cups($data);
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
        Registro guardado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }

    public function primera_vez_hta($idCita)
    {

        $data['title'] = 'IPS | HC PRIMERA VEZ HTA';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);
        $datos['cita'] = $idCita;
        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_carga_priemra_vez($documento);

        $clasificacion = $this->MHistoria->detalle_clasificacion($documento);
        $datos['clasificacion'] = $clasificacion;

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {


            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {


                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VPrimeraVezHta.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function control_hta($idCita)
    {

        $data['title'] = 'IPS | HC CONTROL HTA';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);
        $datos['cita'] = $idCita;
        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control($documento);
        $clasificacion = $this->MHistoria->detalle_clasificacion($documento);


        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;
        $datos['clasificacion'] = $clasificacion;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);


            $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

            $contador = 0;

            for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data = array(
                    'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                    'historia_idHistoria' => $idHistoria,
                    'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                    'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                );

                $this->MHistoria->guardar_diagnostico($data);
                $contador++;
            }

            $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

            $contador1 = 0;



            for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data1 = array(
                    'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                    'historia_idHistoria' => $idHistoria,
                    'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                    'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                );

                $this->MHistoria->guardar_medicamento($data1);
                $contador1++;
            }

            $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

            $contador2 = 0;



            for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data2 = array(
                    'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                    'historia_idHistoria' => $idHistoria,
                    'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                );

                $this->MHistoria->guardar_remision($data2);
                $contador2++;
            }

            $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

            $contador3 = 0;



            for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data3 = array(
                    'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                    'historia_idHistoria' => $idHistoria,
                    'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                );

                $this->MHistoria->guardar_cups($data3);
                $contador3++;
            }
            
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VControl.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }

    public function trabajo_social_control($idCita)
    {

        $data['title'] = 'IPS | HC TRABAJO SOCIAL CONTROL HTA';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);
        $datos['cita'] = $idCita;
        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control1($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);


            $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

            $contador = 0;

            for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data = array(
                    'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                    'historia_idHistoria' => $idHistoria,
                    'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                    'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                );

                $this->MHistoria->guardar_diagnostico($data);
                $contador++;
            }

            $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

            $contador1 = 0;



            for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data1 = array(
                    'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                    'historia_idHistoria' => $idHistoria,
                    'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                    'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                );

                $this->MHistoria->guardar_medicamento($data1);
                $contador1++;
            }

            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VTrabajoSocialControl.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }

    public function trabajo_social($idCita)
    {

        $data['title'] = 'IPS | HC TRABAJO SOCIAL';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);
        //$datos['paraclinico'] = $this->MHistoria->get_paraclinico();
        $datos['historia'] = $paciente;

        $documento = $paciente[0]->pacDocumento;

        //$detalle = $this->MHistoria->detalle_trabajo_social($documento);
        $detalle = $this->MHistoria->detalle_control1($documento);


        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);


        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {


                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;
        //$datos['lista_paraclinico'] = $this->MHistoria->detalle_paraclinico_x_doc($documento);
        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VTrabajosocial.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function reformulacion($idCita)
    {

        $data['title'] = 'IPS | HC REFORMULACION';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['cita'] = $idCita;

        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control1($documento);
        //$detalle = $this->MHistoria->detalle_reformulacion($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {

                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VReformulacion.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }

    public function nutricionista($idCita)
    {

        $data['title'] = 'IPS | HC NUTRICIONISTA';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['cita'] = $idCita;

        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control($documento);
        //$detalle = $this->MHistoria->detalle_reformulacion($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {

                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VNutricionista.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }


    public function nutricionista_control($idCita)
    {

        $data['title'] = 'IPS | HC NUTRICIONISTA CONTROL';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['cita'] = $idCita;

        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control($documento);
        //$detalle = $this->MHistoria->detalle_reformulacion($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {

                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VNutricionistaControl.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }











    public function FISIOTERAPIA($idCita)
    {

        $data['title'] = 'IPS | HC FISIOTERAPIA';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['cita'] = $idCita;

        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control($documento);
        //$detalle = $this->MHistoria->detalle_reformulacion($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {

                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VFisioterapia.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }


    public function Fisioterapia_control($idCita)
    {

        $data['title'] = 'IPS | HC FISIOTERAPIA CONTROL';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['cita'] = $idCita;

        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control($documento);
        //$detalle = $this->MHistoria->detalle_reformulacion($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {

                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VFisioterapiaControl.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }

    public function historia_clinica($idCita)
    {

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['datos_cita'] = $paciente;

        $datos['proceso'] = $paciente[0]->proceso_idProceso;

        $datos['cita'] = $idCita;

        if ($paciente[0]->proceso_idProceso == 6) {
            $data['title'] = 'IPS | HC NEFROLOGIA';
        } else {
            $data['title'] = 'IPS | HC INTERNISTA';
        }

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        //$datos['diagnostico'] = $this->MHistoria->ver_diagnostico();

        $documento = $paciente[0]->pacDocumento;
        $detalle = $this->MHistoria->detalle_control($documento);
        $clasificacion = $this->MHistoria->detalle_clasificacion($documento);

        $datos['historia'] = $detalle;
        $datos['clasificacion'] = $clasificacion;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);


            if (count($detalle) != 0) {


                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VInternista_Nefro.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function psicologia_control($idCita)
    {

        $data['title'] = 'IPS | HC PSICOLOGIA CONTROL';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['cita'] = $idCita;

        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control($documento);
        //$detalle = $this->MHistoria->detalle_reformulacion($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {

                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }
		

        $datos['idHistoria'] = $idHistoria;

        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VPsicologiaControl.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }


    public function psicologia($idCita)
    {

        $data['title'] = 'IPS | HC PSICOLOGIA';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");

        $paciente = $this->MHistoria->get_data_paciente($idCita);

        $datos['cita'] = $idCita;

        $documento = $paciente[0]->pacDocumento;

        $detalle = $this->MHistoria->detalle_control($documento);
        //$detalle = $this->MHistoria->detalle_reformulacion($documento);

        $datos['detalles_cita'] = $paciente;
        $datos['historia'] = $detalle;

        $data = array('cita_idCita' => $idCita);

        $evaluar = $this->MHistoria->getHcByIdCita($idCita);

        if (count($evaluar) >= 1) {
            $idHistoria = $evaluar[0]->id_hc;
        } else {
            $idHistoria = $this->MHistoria->guardar($data);

            if (count($detalle) != 0) {

                $diagnostico_historia_antiguo = $this->MHistoria->detalle_historia_diagnostico($detalle[0]->id_hc);

                $contador = 0;

                for ($i = 1; $i <= count($diagnostico_historia_antiguo); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data = array(
                        'diagnostico_idDiagnostico' => $diagnostico_historia_antiguo[$contador]->diagnostico_idDiagnostico,
                        'historia_idHistoria' => $idHistoria,
                        'his_dia_tipo' => $diagnostico_historia_antiguo[$contador]->his_dia_tipo,
                        'hcTipoDiagnostico' => $diagnostico_historia_antiguo[$contador]->hcTipoDiagnostico

                    );

                    $this->MHistoria->guardar_diagnostico($data);
                    $contador++;
                }

                $detalle_historia_medicamento = $this->MHistoria->detalle_historia_medicamento($detalle[0]->id_hc);

                $contador1 = 0;



                for ($i = 1; $i <= count($detalle_historia_medicamento); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data1 = array(
                        'medicamento_idMedicamento' => $detalle_historia_medicamento[$contador1]->medicamento_idMedicamento,
                        'historia_idHistoria' => $idHistoria,
                        'hisMedCantidad' => $detalle_historia_medicamento[$contador1]->hisMedCantidad,
                        'hisMedDosis' => $detalle_historia_medicamento[$contador1]->hisMedDosis

                    );

                    $this->MHistoria->guardar_medicamento($data1);
                    $contador1++;
                }

                $detalle_historia_remision = $this->MHistoria->detalle_historia_remision($detalle[0]->id_hc);

                $contador2 = 0;



                for ($i = 1; $i <= count($detalle_historia_remision); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data2 = array(
                        'remision_idRemision' => $detalle_historia_remision[$contador2]->remision_idRemision,
                        'historia_idHistoria' => $idHistoria,
                        'remObservacion' => $detalle_historia_remision[$contador2]->remObservacion

                    );

                    $this->MHistoria->guardar_remision($data2);
                    $contador2++;
                }

                $detalle_historia_ayudas_diagnostica = $this->MHistoria->detalle_historia_cups($detalle[0]->id_hc);

                $contador3 = 0;



                for ($i = 1; $i <= count($detalle_historia_ayudas_diagnostica); $i++) {


                    //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                    $data3 = array(
                        'cups_idCups' => $detalle_historia_ayudas_diagnostica[$contador3]->cups_idCups,
                        'historia_idHistoria' => $idHistoria,
                        'cupObservacion' => $detalle_historia_ayudas_diagnostica[$contador3]->cupObservacion

                    );

                    $this->MHistoria->guardar_cups($data3);
                    $contador3++;
                }
            }
            $detalle_historia_pdf = $this->MHistoria->detalle_historia_pdf($detalle[0]->id_hc);

            $contador4 = 0;



            for ($i = 1; $i <= count($detalle_historia_pdf); $i++) {


                //echo $diagnostico_historia_antiguo[$contador]->his_dia_tipo;

                $data4 = array(
                    'Observación' => $detalle_historia_pdf[$contador4]->Observación,
                    'idHistoria' => $idHistoria,
                    'Archivo' => $detalle_historia_pdf[$contador4]->Archivo

                );

                $this->MHistoria->guardar_pdf($data4);
                $contador4++;
            }
        }

        $datos['idHistoria'] = $idHistoria;

        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['examenes_pdf'] = $this->MHistoria->detalle_historia_pdf($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);

        $this->load->view("CHistoria/VPsicologia.php", $datos);


        $this->load->view("CPlantilla/VFooter");
    }

    public function detalle_primera_vez()

    {

        $pacDocumento = $this->input->post('pacDocumento');

        $detalle = $this->MHistoria->detalle_primera_vez($pacDocumento);

        //print_r($contrato);

        if ($detalle != false) {
            echo json_encode($detalle);
        }
    }


    public function primeraVez_control()

    {

        $pacDocumento = $this->input->post('pacDocumento');

        $detalle = $this->MHistoria->detalle_control($pacDocumento);

        //print_r($contrato);

        if ($detalle != false) {
            echo json_encode($detalle);
        }
    }

    public function primeraVez_control1()

    {

        $pacDocumento = $this->input->post('pacDocumento');

        $detalle = $this->MHistoria->detalle_control1($pacDocumento);

        //print_r($contrato);

        if ($detalle != false) {
            echo json_encode($detalle);
        }
    }

    // This is the part where he keeps the data of the story

    public function guardar()
    {

        $idHistoria =  $this->input->post('idHistoria');


        $datos = array(

            'cita_idCita' => $this->input->post('id'),
            'hcAcompanante' => $this->input->post('acompanante'),
            'hcAcuTelefono' => $this->input->post('telefono'),
            'hcAcuParentesco' => $this->input->post('parentesco'),
            'hcCausaExterna' => $this->input->post('causa_externa'),
            'finalidad_idFinalidad' => $this->input->post('finalidad'),
			'fecha_final' => $this->input->post('fecha_final'),
            'hcMotivoConsulta' => $this->input->post('motivo'),
            'hcEnfermedadActual' => $this->input->post('enfermedad_actual'),
            'hcDiscapacidadFisica' => $this->input->post('discapacidad_fisica'),
            'hcDiscapacidadVisual' => $this->input->post('discapacidad_visual'),
            'hcDiscapacidadMental' => $this->input->post('discapacidad_mental'),
            'hcDiscapacidadAuditiva' => $this->input->post('discapacidad_auditiva'),
            'hcDiscapacidadIntelectual' => $this->input->post('discapacidad_intelectual'),
            'hcDrogoDependiente' => $this->input->post('drogodependiente'),
            'hcDrogoDependienteCual' => $this->input->post('drogodependiente_cual'),
            'hcPeso' => $this->input->post('peso'),
            'hcTalla' => $this->input->post('talla'),
            'hcIMC' => $this->input->post('imc'),
            'tasa_filtracion_glomerular_ckd_epi' => $this->input->post('tasa_filtracion_glomerular_ckd_epi'),
            'tasa_filtracion_glomerular_gockcroft_gault' => $this->input->post('tasa_filtracion_glomerular_gockcroft_gault'),
            'hcClasificacion' => $this->input->post('clasificacion'),
            'hcHipertensionArterial' => $this->input->post('hipertension_arterial'),
            'hcParentescoHipertension' => $this->input->post('parentesco_hipertension'),
            'hcDiabetesMellitus' => $this->input->post('diabetes_mellitus'),
            'hcParentescoMellitus' => $this->input->post('parentesco_diabetes_mellitus'),
            'hcArtritis' => $this->input->post('artritis'),
            'hcParentescoArtritis' => $this->input->post('parentesco_artritis'),
            'hcEnfermedadCardiovascular' => $this->input->post('enfermedad_cardiovascular'),
            'hcParentescoCardiovascular' => $this->input->post('parentesco_enfermedad_cardiovascular'),
            'hcAntecedenteMetabolico' => $this->input->post('antecedentes_metabolico'),
            'hcParentescoMetabolico' => $this->input->post('parentesco_antecedentes_metabolico'),
            'hcCancerMamaEstomagoProstataColon' => $this->input->post('cancer'),
            'hcParentescoCancer' => $this->input->post('parentesco_cancer'),
            'hcLucemia' => $this->input->post('lucemia'),
            'hcParentescoLucemia' => $this->input->post('parentesco_lucemia'),
            'hcVih' => $this->input->post('vih'),
            'hcParentescoVih' => $this->input->post('parentesco_vih'),
            'hcOtro' => $this->input->post('otro'),
            'hcParentescoOtro' => $this->input->post('parentesco_otro'),
            'hcHipertensionArterialPersonal' => $this->input->post('hipertension_arterial_personal'),
            'hcClasificacionEstadoMetabolico' => $this->input->post('ClasificacionEstadoMetabolico'),
            'hcObsPersonallHipertensionArterial' => $this->input->post('obs_hipertension_arterial_personal'),
            'hcDiabetesMellitusPersonal' => $this->input->post('diabetes_mellitus_personal'),
            'hcObsPersonalMellitus' => $this->input->post('obs_diabetes_mellitus_personal'),
            'hcEnfermedadCardiovascularPersonal' => $this->input->post('enfermedad_cardiovascular_personal'),
            'hcObsPersonalEnfermedadCardiovascular' => $this->input->post('obs_enfermedad_cardiovascular_personal'),
            'hcArterialPerifericaPersonal' => $this->input->post('arterial_periferica_personal'),
            'hcObsPersonalArterialPeriferica' => $this->input->post('obs_arterial_periferica_personal'),
            'hcCarotideaPersonal' => $this->input->post('carotidea_personal'),
            'hcObsPersonalCarotidea' => $this->input->post('obs_carotidea_personal'),
            'hcAneurismaAortaPersonal' => $this->input->post('aneurisma_aorta_peronal'),
            'hcObsPersonalAneurismaAorta' => $this->input->post('obs_aneurisma_aorta_peronal'),
            'hcSindromeCoronarioAgudoanginaPersonal' => $this->input->post('coronario_personal'),
            'hcObsPersonalSindromeCoronario' => $this->input->post('obs_coronario_personal'),
            'hcArtritisPersonal' => $this->input->post('artritis_personal'),
            'hcObsPersonalArtritis' => $this->input->post('obs_artritis_personal'),
            'hcIamPersonal' => $this->input->post('iam_personal'),
            'hcObsPersonalIam' => $this->input->post('obs_iam_personal'),
            'hcRevasculCoronariaPersonal' => $this->input->post('revascul_coronaria_personal'),
            'hcObsPersonalRevasculCoronaria' => $this->input->post('obs_revascul_coronaria_personal'),
            'hcInsuficienciaCardiacaPersonal' => $this->input->post('insuficiencia_cardiaca_personal'),
            'hcObsPersonalInsuficienciaCardiaca' => $this->input->post('obs_insuficiencia_cardiaca_personal'),
            'hcAmputacionPieDiabeticoPersonal' => $this->input->post('amputacion_pie_diabetico_personal'),
            'hcObsPersonalAmputacionPieDiabetico' => $this->input->post('obs_amputacion_pie_diabetico_personal'),
            'hcEnfermedadPulmonarPersonal' => $this->input->post('enfermedad_pulmonar_personal'),
            'hcObsPersonalEnfermedadPulmonar' => $this->input->post('obs_enfermedad_pulmonar_personal'),
            'hcVictimaMaltratoPersonal' => $this->input->post('victima_maltrato_personal'),
            'hcObsPersonalMaltratoPersonal' => $this->input->post('obs_victima_maltrato_personal'),
            'hcAntecedentesQuirurgicos' => $this->input->post('antecedentes_quirurgicos_personal'),
            'hcObsPersonalAntecedentesQuirurgicos' => $this->input->post('obs_antecedentes_quirurgicos_personal'),
            'hcAcontosisPersonal' => $this->input->post('acontosis_personal'),
            'hcObsPerrsonalAcontosis' => $this->input->post('obs_acontosis_personal'),
            'hcOtroPersonal' => $this->input->post('otro_personal'),
            'hcObsPersonalOtro' => $this->input->post('obs_otro_personal'),
            'insulina_requiriente' => $this->input->post('insulina_requiriente'),
            'hcOlvidaTomarMedicamentos' => $this->input->post('test_morisky_olvida_tomar_medicamentos'),
            'hcTomaMedicamentosHoraIndicada' => $this->input->post('test_morisky_toma_medicamentos_hora_indicada'),
            'hcCuandoEstaBienDejaTomarMedicamentos' => $this->input->post('test_morisky_cuando_esta_bien_deja_tomar_medicamentos'),
            'hcSienteMalDejaTomarlos' => $this->input->post('test_morisky_siente_mal_deja_tomarlos'),
            'hcValoracionPsicologia' => $this->input->post('test_morisky_valoracio_psicologia'),
            'hcCabeza' => $this->input->post('cabeza'),
            'hcOrl' => $this->input->post('orl'),
            'hcCardiovascular' => $this->input->post('cardiovascular'),
            'hcGastrointestinal' => $this->input->post('gastrointestinal'),
            'hcOsteoatromuscular' => $this->input->post('osteoatromuscular'),
            'hcSnc' => $this->input->post('snc'),
            'hcRevisionSistemas' => $this->input->post('revision_sistemas'),
            'hcPresionArterialSistolicaSentadoPie' => $this->input->post('ef_pa_sistolica_sentado_pie'),
            'hcPresionArterialDistolicaSentadoPie' => $this->input->post('ef_pa_distolica_sentado_pie'),
            'hcPresionArterialSistolicaAcostado' => $this->input->post('ef_pa_sistolica_acostado'),
            'hcPresionArterialDistolicaAcostado' => $this->input->post('ef_pa_distolica_acostado'),
            'hcFrecuenciaCardiaca' => $this->input->post('ef_frecuencia_fisica'),
            'hcFrecuenciaRespiratoria' => $this->input->post('ef_frecuencia_respiratoria'),
            'hcEfCabeza' => $this->input->post('ef_cabeza'),
            'hcObsCabeza' => $this->input->post('ef_obs_cabeza'),
            'hcAgudezaVisual' => $this->input->post('ef_agudeza_visual'),
            'hcObsAgudezaVisual' => $this->input->post('ef_obs_agudeza_visual'),
            'hcFundoscopia' => $this->input->post('ef_fundoscopia'),
            'hcObsFundoscopia' => $this->input->post('ef_obs_fundoscopia'),
            'hcCuello' => $this->input->post('ef_cuello'),
            'hcObsCuello' => $this->input->post('ef_obs_cuello'),
            'hcTorax' => $this->input->post('ef_torax'),
            'hcObsTorax' => $this->input->post('ef_obs_torax'),
            'hcMamas' => $this->input->post('ef_mamas'),
            'hcObsMamas' => $this->input->post('ef_obs_mamas'),
            'hcAbdomen' => $this->input->post('ef_abdomen'),
            'hcObsAbdomen' => $this->input->post('ef_obs_abdomen'),
            'hcGenitoUrinario' => $this->input->post('ef_genito_urinario'),
            'hcObsGenitoUrinario' => $this->input->post('ef_obs_genito_urinario'),
            'hcExtremidades' => $this->input->post('ef_extremidades'),
            'hcObsExtremidades' => $this->input->post('ef_obs_extremidades'),
            'hcPielAnexosPulsos' => $this->input->post('ef_piel_anexos_pulsos'),
            'hcObsPielAnexosPulsos' => $this->input->post('ef_obs_piel_anexos_pulsos'),
            'hcSistemaNervioso' => $this->input->post('ef_sistema_nervioso'),
            'hcObsSistemaNervioso' => $this->input->post('ef_obs_sistema_nervioso'),
            'hcCapacidadCognitiva' => $this->input->post('ef_capacidad_cognitiva'),
            'hcObsCapacidadCognitiva' => $this->input->post('ef_obs_capacidad_cognitiva'),
            'hcOrientacion' => $this->input->post('ef_orientacion'),
            'hcObsOrientacion' => $this->input->post('ef_obs_orientacion'),
            'hcReflejoAquiliar' => $this->input->post('ef_reflejo_aquiliar'),
            'hcObsReflejoAquiliar' => $this->input->post('ef_obs_reflejo_aquiliar'),
            'hcReflejoPatelar' => $this->input->post('ef_reflejo_patelar'),
            'hcObsReflejoPatelar' => $this->input->post('ef_obs_reflejo_patelar'),
            'hcHallazgoPositivoExamenFisico' => $this->input->post('ef_hallazco_positivo_examen_fisico'),
            'hcTabaquismo' => $this->input->post('tabaquismo'),
            'hcObsTabaquismo' => $this->input->post('obs_tabaquismo'),
            'hcDislipidemia' => $this->input->post('dislipidemia'),
            'hcObsDislipidemia' => $this->input->post('obs_dislipidemia'),
            'hcMenorCiertaEdad' => $this->input->post('menor_cierta_edad'),
            'hcObsMenorCiertaEdad' => $this->input->post('obs_menor_cierta_edad'),
            'hcPerimetroAbdominal' => $this->input->post('perimetro_abdominal'),
            'hcObsPerimetroAbdominal' => $this->input->post('obs_perimetro_abdominal'),
            'hcCondicionClinicaAsociada' => $this->input->post('condicion_clinica_asociada'),
            'hcObsCondicionClinicaAsociada' => $this->input->post('obs_condicion_clinica_asociada'),
            'hcLesionOrganoBlanco' => $this->input->post('lesion_organo_blanco'),
            'hcDescripcionLesionOrganoBlanco' => $this->input->post('descripcion_lesion_organo_blanco'),
            'hcObsLesionOrganoBlanco' => $this->input->post('obs_lesion_organo_blanco'),
            
            'hcClasificacionHta' => $this->input->post('clasificacion_hta'),
            'hcClasificacionDm' => $this->input->post('clasificacion_dm'),
            'hcClasificacionErcEstado' => $this->input->post('clasificacion_erc_estado'),
            'hcClasificacionErcCategoriaAmbulatoriaPersistente' => $this->input->post('clasificacion_erc_categoria_ambulatoria_persistente'),
            'hcClasificacionRcv' => $this->input->post('clasificacion_rcv'),
            'hcAlimentacion' => $this->input->post('alimentacion'),
            'hcDisminucionConsumoSalAzucar' => $this->input->post('disminucion_consumo_sal_azucar'),
            'hcFomentoActividadFisica' => $this->input->post('fomento_actividad_fisica'),
            'hcOmportanciaAdherenciaTratamiento' => $this->input->post('importancia_adherencia_tratamiento'),
            'hcConsumoFrutasVerduras' => $this->input->post('consumo_frutas_verduras'),
            'hcManejoEstres' => $this->input->post('manejo_estres'),
            'hcDisminucionConsumoCigarrillo' => $this->input->post('disminucion_consumo_cigarrillo'),
            'hcDisminucionPeso' => $this->input->post('disminucion_peso'),
            'hcObservacionesGenerales' => $this->input->post('observaciones_generales'),

            'hcRecibeTratamientoAlternativo' => $this->input->post('recibe_tratamiento_alternativo'),
            'hcRecibeTratamientoConPlantasMedicinales' => $this->input->post('recibe_tratamiento_plantas_medicinales'),
            'hcRecibeRitualMedicinaTradicional' => $this->input->post('recibe_ritual_medicina_tradicional'),

            'hcNumeroFrutasDiarias' => $this->input->post('numero_frutas_diarias'),
            'hcElevadoConsumoGrasaSaturada' => $this->input->post('elevado_consumo_grasa_saturada'),
            'hcAdicionaSalDespuesPrepararComida' => $this->input->post('adiciona_sal_despues_preparar_alimentos'),

            'hcGeneral' => $this->input->post('general'),
            'hcRespiratorio' => $this->input->post('respiratorio'),

           /*** ADDITIONAL HC CONTROL FIELDS ***/

            'hcOidos' => $this->input->post('oidos'),
            'hcNarizSenosParanasales' => $this->input->post('nariz_senos_paranasales'),
            'hcCavidadOral' => $this->input->post('cavidad_oral'),
            'hcCardioRespiratorio' => $this->input->post('cardio_respiratorio'),
            'hcMusculoEsqueletico' => $this->input->post('musculo_esqueletico'),

            'hcInspeccionSensibilidadPies' => $this->input->post('inspeccion_sensibilidad_pies'),
            'hcCapacidadCongnitivaOrientacion' => $this->input->post('capacidad_congnitiva_orientacion'),

            'adherente' => $this->input->post('adherente'),
            'fex_es' => $this->input->post('fex_es'),
            'fex_es1' => $this->input->post('fex_es1'),
            'fex_es2' => $this->input->post('fex_es2'),

            'hcElectrocardiograma' => $this->input->post('hcElectrocardiograma'),
            'hcEcocardiograma' => $this->input->post('hcEcocardiograma'),
            'hcEcografiaRenal' => $this->input->post('hcEcografiaRenal'),


            /***** HC REFORMULATION ************/
/////

            'hcRazonReformulacion' => $this->input->post('razon_reformulacion'),
            'hcMotivoReformulacion' => $this->input->post('motivo_reformulacion'),
            'hcReformulacionQuienReclama' => $this->input->post('quien_reclama'),
            'hcReformulacionNombreReclama' => $this->input->post('nombre_reclama')

        );

        $this->MHistoria->actualizar_guardado($datos, $idHistoria);


        $estado = $this->MCita->info_cita($this->input->post('id'));

        if ($estado[0]->proceso_idProceso == 2 || $estado[0]->proceso_idProceso == 4 || $estado[0]->proceso_idProceso == 5 || $estado[0]->proceso_idProceso == 6 || $estado[0]->proceso_idProceso == 7 || $estado[0]->proceso_idProceso == 13) {


            /*** ADDITIONAL HC NEPHROLOGY AND INTERNIST FIELDS ***/

            $datos_adicionales = array(

               /********************** HC NEFRO AND INTERNIST *************************************/
                'hc_idHc' => $idHistoria,
                'hcSistemaNerviosoNefroInter' => $this->input->post('sistema_nervioso'),
                'hcSistemaHemolinfatico' => $this->input->post('sistema_hemolinfatico'),
                'hcAparatoDigestivo' => $this->input->post('aparato_digestivo'),
                'hcOrganoSentido' => $this->input->post('organos_sentidos'),
                'hcEndocrinoMetabolico' => $this->input->post('endocrino_metabolico'),
                'hcInmunologico' => $this->input->post('inmunologico'),
                'hcCancerTumoresRadioterapiaQuimio' => $this->input->post('cancer_tumores_radio_quimioterapia'),
                'hcGlandulaMamaria' => $this->input->post('glandulas_mamarias'),
                'hcHipertensionDiabetesErc' => $this->input->post('hipertension_diabetes_erc'),


                'hcReacionesAlergica' => $this->input->post('reacion_alergica'),
                'hcCardioVasculares' => $this->input->post('cardio_vasculares'),
                'hcRespiratorios' => $this->input->post('respiratorios'),
                'hcCrinarias' => $this->input->post('crinarias'),
                'hcOsteoarticulares' => $this->input->post('osteoarticulares'),
                'hcInfecciosos' => $this->input->post('infecciosos'),
                'hcCirugiaTrauma' => $this->input->post('cirugias_traumas'),
                'hcTratamientoMedicacion' => $this->input->post('tratamiento_medicacion'),
                'hcAntecedenteQuirurgico' => $this->input->post('antecedentes_quirurgicos'),

                'hcAntecedentesFamiliares' => $this->input->post('antecedentes_familiares'),
                'hcConsumoTabaco' => $this->input->post('consumo_tabaco'),
                'hcAntecedentesAlcohol' => $this->input->post('antecedentes_alcohol'),
                'hcSedentarismo' => $this->input->post('sedentarismo'),
                'hcGinecologico' => $this->input->post('ginecologicos'),
                'hcCitologiaVaginal' => $this->input->post('citologia_vaginal'),
                'hcMenarquia' => $this->input->post('menarquia'),
                'hcGestaciones' => $this->input->post('gestaciones'),
                'hcParto' => $this->input->post('parto'),


                'hcAborto' => $this->input->post('aborto'),
                'hcCesaria' => $this->input->post('cesaria'),
                'hcMetodoConceptivo' => $this->input->post('metodo_anticonceptivo'),
                'hcMetodoConceptivoCual' => $this->input->post('metodo_anticonceptivo_cual'),
                'hcAntecedentePersonal' => $this->input->post('obs_antecedentes_personales'),

                'descripcion_sistema_nervioso' => $this->input->post('descripcion_sistema_nervioso'),
                'descripcion_sistema_hemolinfatico' => $this->input->post('descripcion_sistema_hemolinfatico'),
                'descripcion_aparato_digestivo' => $this->input->post('descripcion_aparato_digestivo'),
                'descripcion_organos_sentidos' => $this->input->post('descripcion_organos_sentidos'),
                'descripcion_endocrino_metabolico' => $this->input->post('descripcion_endocrino_metabolico'),
                'descripcion_inmunologico' => $this->input->post('descripcion_inmunologico'),
                'descripcion_cancer_tumores_radio_quimioterapia' => $this->input->post('descripcion_cancer_tumores_radio_quimioterapia'),
                'descripcion_glandulas_mamarias' => $this->input->post('descripcion_glandulas_mamarias'),
                'descripcion_hipertension_diabetes_erc' => $this->input->post('descripcion_hipertension_diabetes_erc'),
                'descripcion_reacion_alergica' => $this->input->post('descripcion_reacion_alergica'),
                'descripcion_cardio_vasculares' => $this->input->post('descripcion_cardio_vasculares'),
                'descripcion_respiratorios' => $this->input->post('descripcion_respiratorios'),
                'descripcion_crinarias' => $this->input->post('descripcion_crinarias'),
                'descripcion_osteoarticulares' => $this->input->post('descripcion_osteoarticulares'),
                'descripcion_infecciosos' => $this->input->post('descripcion_infecciosos'),
                'descripcion_cirugias_traumas' => $this->input->post('descripcion_cirugias_traumas'),
                'descripcion_tratamiento_medicacion' => $this->input->post('descripcion_tratamiento_medicacion'),
                'descripcion_antecedentes_quirurgicos' => $this->input->post('descripcion_antecedentes_quirurgicos'),
                'descripcion_antecedentes_familiares' => $this->input->post('descripcion_antecedentes_familiares'),
                'descripcion_consumo_tabaco' => $this->input->post('descripcion_consumo_tabaco'),
                'descripcion_antecedentes_alcohol' => $this->input->post('descripcion_antecedentes_alcohol'),
                'descripcion_sedentarismo' => $this->input->post('descripcion_sedentarismo'),
                'descripcion_ginecologicos' => $this->input->post('descripcion_ginecologicos'),
                'descripcion_citologia_vaginal' => $this->input->post('descripcion_citologia_vaginal'),



                /***************************************HC SOCIAL WORK *****************************/
                'hcMotivoConsulta' => $this->input->post('motivo_complementaria'),
                'hcEstructuraFamiliar' => $this->input->post('estructura_familiar'),
                'hcCantidadHabitantes' => $this->input->post('cantidad_habitantes'),
                'hcCantidadConformanFamilia' => $this->input->post('cantidad_conforman_familia'),
                'hcComposicionFamiliar' => $this->input->post('composicion_familiar'),
                'hcTipoVivienda' => $this->input->post('tipo_vivienda'),
                'hcTenenciaVivienda' => $this->input->post('tenencia_vivienda'),
                'hcMaterialParedes' => $this->input->post('material_paredes'),
                'hcMaterialPisos' => $this->input->post('material_pisos'),
                'hcEspaciosSala' => $this->input->post('espacios_sala'),
                'hcComedor' => $this->input->post('comedor'),
                'hcBanio' => $this->input->post('banio'),
                'hcCocina' => $this->input->post('cocina'),
                'hcPatio' => $this->input->post('patio'),
                'hcCantidadDormitorios' => $this->input->post('cantidad_dormitorios'),
                'hcCantidadPersonasOcupanCuarto' => $this->input->post('cantidad_personas_ocupan_cuarto'),
                'hcEnergiaElectrica' => $this->input->post('energia_electrica'),
                'hcAlcantarillado' => $this->input->post('alcantarillado'),
                'hcGasNatural' => $this->input->post('gas_natural'),
                'hcCentroAtencion' => $this->input->post('centro_atencion'),
                'hcAcueducto' => $this->input->post('acueducto'),
                'hcCentroCulturales' => $this->input->post('centro_culturales'),
                'hcVentilacion' => $this->input->post('ventilacion'),
                'hcOrganizacion' => $this->input->post('organizacion'),
                'hcCentroEducacion' => $this->input->post('centro_educacion'),
                'hcCentroRecreacionEsparcimiento' => $this->input->post('centro_recreacion_esparcimiento'),
                'hcDinamicaFamiliar' => $this->input->post('dinamica_familiar'),
                'hcDiagnostico' => $this->input->post('hc_diagnostico'),
                'hcNeurologicoEstadoMental' => $this->input->post('neurologia_estado_mental'),
                'hcObsNeurologicoEstadoMental' => $this->input->post('obs_neurologia_estado_mental'),
                'hcAccionesSeguir' => $this->input->post('acciones_seguir'),


                'hcObjetivoVisita' => $this->input->post('objetivo_visita'),
                'hcSituacionEncontrada' => $this->input->post('situacion_encontrada'),
                'hcCompromiso' => $this->input->post('compromiso'),
                'hcRecomendaciones' => $this->input->post('recomendaciones'),
                'hcSiguienteSeguimiento' => $this->input->post('siguiente_seguimiento'),


/*********************************HC PSYCHOLOGY *********************************/

                'hcPsicologiaDescripcionProblema' => $this->input->post('descripcion_problema'),
                'hcPsicologiaRedApoyo' => $this->input->post('red_apoyo_familiar'),
                'hcPsicologiaPlanIntervencionRecomendacion' => $this->input->post('plan_intervencion'),
                'hcPsicologiaTratamientoActualAdherencia' => $this->input->post('tratamiento_actual_adherencia'),
                'hcPsicologiaComportamientoConsulta' => $this->input->post('comportamiento_consulta'),
                'hcAnalisisConclusiones' => $this->input->post('analisis_conclusiones'),
                'hcAvancePaciente' => $this->input->post('avances_pacientes'),

                /*********************************NUTRITIONIST**************************************/

                'hcEnfermedadDiagnostica' => $this->input->post('enfermedad_diagnostica'),
                'hcHabitoIntestinal' => $this->input->post('habito_intestinal'),
                'hcQuirurgicos' => $this->input->post('quirurgicos'),
                'hcQuirurgicosObservaciones' => $this->input->post('quirurgicos_observaciones'),
                'hcAlergicos' => $this->input->post('alergicos'),
                'hcAlergicosObservaciones' => $this->input->post('alergicos_observaciones'),
                'hcFamiliares' => $this->input->post('familiares'),
                'hcFamiliaresObservaciones' => $this->input->post('familiares_observaciones'),
                'hcPsa' => $this->input->post('psa'),
                'hcPsaObservaciones' => $this->input->post('psa_observaciones'),
                'hcFarmacologicos' => $this->input->post('farmacologicos'),
                'hcFarmacologicosObservaciones' => $this->input->post('farmacologicos_observaciones'),
                'hcSueno' => $this->input->post('sueno'),
                'hcSuenoObservaciones' => $this->input->post('sueno_observaciones'),
                'hcTabaquismoObservaciones' => $this->input->post('tabaquismo_observaciones'),
                'hcEjercicio' => $this->input->post('ejercicio'),
                'hcEjercicioObservaciones' => $this->input->post('ejercicio_observaciones'),
                'hcEmbarazoActual' => $this->input->post('embarazo_actual'),
                'hcSemanasGestacion' => $this->input->post('semanas_gestacion'),
                'hcClimatero' => $this->input->post('climatero'),
                'hcToleranciaViaOral' => $this->input->post('tolerancia_via_oral'),
                'hcPercepcionApetito' => $this->input->post('percepcion_apetito'),
                'hcPercepcionApetitoObservacion' => $this->input->post('percepcion_apetito_observacion'),
                'hcAlimentosPreferidos' => $this->input->post('alimentos_preferidos'),
                'hcAlimentosRechazados' => $this->input->post('alimentos_rechazados'),
                'hcSuplementoNutricionales' => $this->input->post('suplementos_complomentos_nutricionales'),
                'hcDietaEspecial' => $this->input->post('dieta_especial'),
                'hcDietaEspecialCual' => $this->input->post('dieta_especial_cual'),
                'hcDesayunoHora' => $this->input->post('desayuno_hora'),
                'hcDesayunoHoraObservacion' => $this->input->post('desayuno_hora_observacion'),
                'hcMediaMañanaHora' => $this->input->post('media_mañana_hora'),
                'hcMediaMañanaHoraObservacion' => $this->input->post('media_mañana_hora_observacion'),
                'hcAlmuerzoHora' => $this->input->post('almuerzo_hora'),
                'hcAlmuerzoHoraObservacion' => $this->input->post('almuerzo_hora_observacion'),
                'hcMediaTardeHora' => $this->input->post('media_tarde_hora'),
                'hcMediaTardeHoraObservacion' => $this->input->post('media_tarde_hora_observacion'),
                'hcCenaHora' => $this->input->post('cena_hora'),
                'hcCenaHoraObservacion' => $this->input->post('cena_hora_observacion'),
                'hcRefrigerioNocturnoHora' => $this->input->post('refrigerio_nocturno_hora'),
                'hcRefrigerioNocturnoHoraObservacion' => $this->input->post('refrigerio_nocturno_hora_observacion'),
                'hcPesoIdeal' => $this->input->post('peso_ideal'),
                'hcInterpretacion' => $this->input->post('interpretacion'),
                'hcMetaMeses' => $this->input->post('meta_meses'),
                'hcAnalisisNutricional' => $this->input->post('analisis_nutricional'),
                'hcPlanSeguir' => $this->input->post('plan_seguir'),
                'hcComida_desayuno' => $this->input->post('Comida_desayuno'),
                'hcComidamedio_desayuno' => $this->input->post('Comidamedio_desayuno'),
                'hcComida_almuerzo' => $this->input->post('Comida_almuerzo'),
                'hcComidamedio_almuerzo' => $this->input->post('Comidamedio_almuerzo'),
                'hcComida_cena' => $this->input->post('Comida_cena'),
               
                'hcLacteo' => $this->input->post('Lacteo'),
                'hcLacteo_observacion' => $this->input->post('Lacteo_observacion'),
                'hcHuevo' => $this->input->post('Huevo'),
                'hcHuevo_observacion' => $this->input->post('Huevo_observacion'),
                'hcEmbutido' => $this->input->post('Embutido'),
                'hcEmbutido_observacion' => $this->input->post('Embutido_observacion'),
                'hcCarneroja' => $this->input->post('Carneroja'),
                'hcCarneblanca' => $this->input->post('Carneblanca'),
                'hcCarnevicera' => $this->input->post('Carnevicera'),
                'hcCarneobservacion' => $this->input->post('Carneobservacion'),
                'hcLeguminosas' => $this->input->post('Leguminosas'),
                'hcLeguminosasobservacion' => $this->input->post('Leguminosasobservacion'),
                'hcFrutas_jugo' => $this->input->post('Frutas_jugo'),
                'hcFrutas_porcion' => $this->input->post('Frutas_porcion'),
                'hcFrutas_observacion' => $this->input->post('Frutas_observacion'),
                'hcVerduras_hortalizas' => $this->input->post('Verduras_hortalizas'),
                'hcVh_observacion' => $this->input->post('Vh_observacion'),
                'hcCereales' => $this->input->post('Cereales'),
                'hcCereales_observacion' => $this->input->post('Cereales_observacion'),
                'hcRTP' => $this->input->post('RTP'),
                'hcRTP_observacion' => $this->input->post('RTP_observacion'),
                'hcAzucar_dulce' => $this->input->post('Azucar_dulce'),
                'hcAd_observacion' => $this->input->post('Ad_observacion'),
                'hcDiagnostico_nutri' => $this->input->post('Diagnostico_nutri'),


                //HC PHYSIOTHERAPY//
                'hcEvaluaciond' => $this->input->post('Evaluaciond'),
                'hcEvaluacionp' => $this->input->post('Evaluacionp'),
                'hcEstado' => $this->input->post('Estado'),
                'hcEvaluacion_dolor' => $this->input->post('Evaluacion_dolor'),
                'hcEvaluacionos' => $this->input->post('Evaluacionos'),
                'hcEvaluacionneu' => $this->input->post('Evaluacionneu'),
                'hcComitante' => $this->input->post('Comitante'),
                'hcActitud' => $this->input->post('Actitud')















                

            );

            $this->MHistoria->guardar_adicionales($datos_adicionales);
        }

        if ($estado[0]->citEstado == 'FACTURADO') {
            $data = array(
                'citEstado' => 'FINALIZADO Y FACTURADO',
            );
        } elseif ($estado[0]->citEstado == 'PROGRAMADO') {

            $data = array(
                'citEstado' => 'FINALIZADO',
            );
        }


        $this->MCita->actualizardatos($data, $this->input->post('id'));



        echo '<script>

window.location.replace("' . base_url('index.php/CHistoria/imprimir_historia_clinica/' . $idHistoria) . '");

</script>';
    }

    public function imprimir_historia_clinica($idHistoria)
    {



        $data['title'] = 'IPS | IMPRIMIO: ' . $this->session->userdata('nom_user');

        $this->load->view("CPlantilla/VHead", $data);



        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);
        $datos['antecedentes_personales'] = $this->MHistoria->detalle_antecedentes_personales($idHistoria);

        $datos['dato_historia'] = $this->MHistoria->datos_historia($idHistoria);
        $this->load->view("CHistoria/VImprimir.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function imprimir_historia_clinica_historial($idHistoria)
    {



        $data['title'] = 'IPS | IMPRIMIO: ' . $this->session->userdata('nom_user');

        $this->load->view("CPlantilla/VHead", $data);



        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($idHistoria);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($idHistoria);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($idHistoria);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($idHistoria);
        $datos['antecedentes_personales'] = $this->MHistoria->detalle_antecedentes_personales($idHistoria);

        $datos['dato_historia'] = $this->MHistoria->datos_historia($idHistoria);
        $this->load->view("CHistorial/VImprimir.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

    public function eliminar_medicamento()
    {
        $ids_his_med = $this->input->post('id_his_med');
    
        foreach ($ids_his_med as $id_his_med) {
            $this->MHistoria->delete_medicamento($id_his_med);
            // Puedes realizar otras acciones aquí para cada ID, como registrar el éxito o manejar errores
        }
    
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Registros eliminados correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
    public function eliminar_remision()
    {
        $remisionAEliminar = $this->input->post('id_his_rem');
    
        foreach ($remisionAEliminar as $id_his_rem) {
            $this->MHistoria->delete_remision($id_his_rem);
        }
    
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Registro eliminado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
    public function eliminar_cups()
    {
        $ayudaAEliminar = $this->input->post('id_his_cups');
    
        foreach ($ayudaAEliminar as $id_his_cups) {
            $this->MHistoria->delete_cups($id_his_cups);
        }
    
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Registro eliminado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }

    public function eliminar_diagnostico()
    {
        $diagnosticoAEliminar = $this->input->post('id_his_dia');
    
        foreach ($diagnosticoAEliminar as $id_his_dia) {
            $this->MHistoria->delete_diagnostico($id_his_dia);
        }
    
       echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        Registro eliminado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }

    public function nota_adicional()

    {
        $idHistoria = $this->input->post('id_hc');
        $nota = $this->input->post('nota');

        $datos = array(
            'hcAdicional' => $nota
        );

        $resp = $this->MHistoria->actualizar_guardado($datos, $idHistoria);

        json_encode($resp);
        //redirect(base_url("index.php/CAgenda"));
    }

    public function agregar_paraclinico()

{

    $doc = $this->input->post('doc');
    $fecha = $this->input->post('fecha');
    $colesterototal = $this->input->post('colesterototal');
    $colesterolhdl = $this->input->post('colesterolhdl');
    $trigliceridos = $this->input->post('trigliceridos');
	$colesterolldl = $this->input->post('colesterolldl');
	$hemoglobina = $this->input->post('hemoglobina');
	$hematocrocito = $this->input->post('hematocrocito');
	$plaquetas = $this->input->post('plaquetas');
	$hemoglobina_glicosilada = $this->input->post('hemoglobina_glicosilada');
	$glicemia_basal = $this->input->post('glicemia_basal');
	$glicemia_post = $this->input->post('glicemia_post');
	$creatinina = $this->input->post('creatinina');
	$creatinuria = $this->input->post('creatinuria');
	$microalbuminuria = $this->input->post('microalbuminuria');
	$albumina = $this->input->post('albumina');
	$relacion_albuminuria_creatinuria = $this->input->post('relacion_albuminuria_creatinuria');
	$parcial_orina = $this->input->post('parcial_orina');
	$depuracion_creatinina = $this->input->post('depuracion_creatinina');
	$creatinina_orina_24 = $this->input->post('creatinina_orina_24');
	$proteina_orina_24 = $this->input->post('proteina_orina_24');
	$hormona_estimulante_tiroides = $this->input->post('hormona_estimulante_tiroides');
	$hormona_paratiroidea = $this->input->post('hormona_paratiroidea');
	$albumina_suero = $this->input->post('albumina_suero');
	$fosforo_suero = $this->input->post('fosforo_suero');
	$nitrogeno_ureico = $this->input->post('nitrogeno_ureico');
	$acido_urico_suero = $this->input->post('acido_urico_suero');
	$calcio = $this->input->post('calcio');
	$sodio_suero = $this->input->post('sodio_suero');
	$potasio_suero = $this->input->post('potasio_suero');
	$hierro_total = $this->input->post('hierro_total');
	$ferritina = $this->input->post('ferritina');
	$transferrina = $this->input->post('transferrina');
	$fosfatasa_alcalina = $this->input->post('fosfatasa_alcalina');
	$acido_folico_suero = $this->input->post('acido_folico_suero');
	$vitamina_b12 = $this->input->post('vitamina_b12');
	$nitrogeno_ureico_orina_24 = $this->input->post('nitrogeno_ureico_orina_24');


    $dt = new DateTime($fecha);
   
    $format = $dt->format('n/j/Y');
   

    $datos = array(
        'fecha' => $format,
        'identificacion' => $doc,
        'colesterol_total' => $colesterototal,
        'colesterol_hdl' => $colesterolhdl,
        'trigliceridos' => $trigliceridos,
		'colesterol_ldl' => $colesterolldl,
		'hemoglobina' => $hemoglobina,
		'hematocrocito' => $hematocrocito,
		'plaquetas' => $plaquetas,
		'hemoglobina_glicosilada' => $hemoglobina_glicosilada,
		'glicemia_basal' => $glicemia_basal,
		'glicemia_post' => $glicemia_post,
		'creatinina' => $creatinina,
		'creatinuria' => $creatinuria,
		'microalbuminuria' => $microalbuminuria,
		'albumina' => $albumina,
		'relacion_albuminuria_creatinuria' => $relacion_albuminuria_creatinuria,
		'parcial_orina' => $parcial_orina,
		'depuracion_creatinina' => $depuracion_creatinina,
		'creatinina_orina_24' => $creatinina_orina_24,
		'proteina_orina_24' => $proteina_orina_24,
		'hormona_estimulante_tiroides' => $hormona_estimulante_tiroides,
		'hormona_paratiroidea' => $hormona_paratiroidea,
		'albumina_suero' => $albumina_suero,
		'fosforo_suero' => $fosforo_suero,
		'nitrogeno_ureico' => $nitrogeno_ureico,
		'acido_urico_suero' => $acido_urico_suero,
		'calcio' => $calcio,
		'sodio_suero' => $sodio_suero,
		'potasio_suero' => $potasio_suero,
		'hierro_total' => $hierro_total,
		'ferritina' => $ferritina,
		'transferrina' => $transferrina,
		'fosfatasa_alcalina' => $fosfatasa_alcalina,
		'acido_folico_suero' => $acido_folico_suero,
		'vitamina_b12' => $vitamina_b12,
		'nitrogeno_ureico_orina_24' => $nitrogeno_ureico_orina_24
    );

    $this->MHistoria->guardar_paraclinico($datos);

    echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
    Registro guardado correctamente
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}

public function upload_paraclinico()
{

    $data['title'] = 'IPS | IMPORTAR PARACLINICO';

    $this->load->view("CPlantilla/VHead", $data);

    $this->load->view("CPlantilla/VBarraMenu");

    $this->load->view("CHistoria/VParaclinico.php");

    $this->load->view("CPlantilla/VFooter");
   
}
// This is the logic for uploading the laboratories, home visits and disbursements in Excel format ...
public function importar_excel1()
{
    if (ob_get_level()) {
        ob_end_clean();
    }
    ob_start();

    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-cache, no-store, must-revalidate');

    $response = ['success' => false, 'message' => '', 'debug' => ''];

    $sendJson = function ($payload) {
        if (ob_get_level()) {
            ob_clean();
        }
        echo json_encode($payload, JSON_UNESCAPED_UNICODE);
        exit;
    };

    $previousDisplayErrors = ini_get('display_errors');
    $previousErrorReporting = error_reporting();
    $previousErrorHandler = null;

    ini_set('display_errors', '0');
    error_reporting($previousErrorReporting & ~E_DEPRECATED & ~E_NOTICE & ~E_WARNING);

    // PHPExcel en PHP 8 genera warnings/deprecations masivos; evitamos log flood en este flujo.
    $previousErrorHandler = set_error_handler(function ($severity, $message, $file) {
        $isPhpExcel = (strpos((string) $file, 'PHPExcel') !== false);
        $isNonFatal = in_array($severity, [E_WARNING, E_NOTICE, E_DEPRECATED, E_USER_DEPRECATED], true);

        if ($isPhpExcel && $isNonFatal) {
            return true;
        }

        return false;
    });

    try {
        $response['debug'] .= 'Inicio del proceso.\n';

        $path = 'archivo/';

        $phpExcelPath = APPPATH . '/third_party/PHPExcel.php';
        if (!file_exists($phpExcelPath)) {
            throw new Exception('PHPExcel.php no encontrado en ' . $phpExcelPath);
        }
        include $phpExcelPath;

        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['remove_spaces'] = true;
        $config['encrypt_name'] = false;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('uploadFile')) {
            $error_msg = strip_tags($this->upload->display_errors('', ''));
            $response['message'] = 'Error al subir archivo: ' . trim($error_msg);
            $sendJson($response);
        }

        $data = $this->upload->data();
        $import_xls_file = $data['file_name'];
        $inputFileName = $path . $import_xls_file;

        if (!file_exists($inputFileName)) {
            throw new Exception('El archivo no se guardo: ' . $inputFileName);
        }

        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($inputFileName);
        $allDataInSheet = $objPHPExcel->setActiveSheetIndex(0)->toArray(null, true, true, true);

        $inserdata = [];
        $flag = true;
        $i = 0;

        foreach ($allDataInSheet as $value) {
            if ($flag) {
                $flag = false;
                continue;
            }

            if (empty($value['A']) && empty($value['B'])) {
                continue;
            }

            $inserdata[$i]['fecha'] = $value['A'] ?? '';
            $inserdata[$i]['identificacion'] = $value['B'] ?? '';
            $inserdata[$i]['colesterol_total'] = $value['C'] ?? '';
            $inserdata[$i]['colesterol_hdl'] = $value['D'] ?? '';
            $inserdata[$i]['trigliceridos'] = $value['E'] ?? '';
            $inserdata[$i]['colesterol_ldl'] = $value['F'] ?? '';
            $inserdata[$i]['hemoglobina'] = $value['G'] ?? '';
            $inserdata[$i]['hematocrocito'] = $value['H'] ?? '';
            $inserdata[$i]['plaquetas'] = $value['I'] ?? '';
            $inserdata[$i]['hemoglobina_glicosilada'] = $value['J'] ?? '';
            $inserdata[$i]['glicemia_basal'] = $value['K'] ?? '';
            $inserdata[$i]['glicemia_post'] = $value['L'] ?? '';
            $inserdata[$i]['creatinina'] = $value['M'] ?? '';
            $inserdata[$i]['creatinuria'] = $value['N'] ?? '';
            $inserdata[$i]['microalbuminuria'] = $value['O'] ?? '';
            $inserdata[$i]['albumina'] = $value['P'] ?? '';
            $inserdata[$i]['relacion_albuminuria_creatinuria'] = $value['Q'] ?? '';
            $inserdata[$i]['parcial_orina'] = $value['R'] ?? '';
            $inserdata[$i]['depuracion_creatinina'] = $value['S'] ?? '';
            $inserdata[$i]['creatinina_orina_24'] = $value['T'] ?? '';
            $inserdata[$i]['proteina_orina_24'] = $value['U'] ?? '';
            $inserdata[$i]['hormona_estimulante_tiroides'] = $value['V'] ?? '';
            $inserdata[$i]['hormona_paratiroidea'] = $value['W'] ?? '';
            $inserdata[$i]['albumina_suero'] = $value['X'] ?? '';
            $inserdata[$i]['fosforo_suero'] = $value['Y'] ?? '';
            $inserdata[$i]['nitrogeno_ureico'] = $value['Z'] ?? '';
            $inserdata[$i]['acido_urico_suero'] = $value['AA'] ?? '';
            $inserdata[$i]['calcio'] = $value['AB'] ?? '';
            $inserdata[$i]['sodio_suero'] = $value['AC'] ?? '';
            $inserdata[$i]['potasio_suero'] = $value['AD'] ?? '';
            $inserdata[$i]['hierro_total'] = $value['AE'] ?? '';
            $inserdata[$i]['ferritina'] = $value['AF'] ?? '';
            $inserdata[$i]['transferrina'] = $value['AG'] ?? '';
            $inserdata[$i]['fosfatasa_alcalina'] = $value['AH'] ?? '';
            $inserdata[$i]['acido_folico_suero'] = $value['AI'] ?? '';
            $inserdata[$i]['vitamina_b12'] = $value['AJ'] ?? '';
            $inserdata[$i]['nitrogeno_ureico_orina_24'] = $value['AK'] ?? '';

            $i++;
        }

        if (empty($inserdata)) {
            if (file_exists($inputFileName)) {
                unlink($inputFileName);
            }
            $response['message'] = 'El archivo no contiene datos validos para procesar';
            $sendJson($response);
        }

        $result = $this->MHistoria->guardar_paraclinico_excel($inserdata);

        if (file_exists($inputFileName)) {
            unlink($inputFileName);
        }

        if ($result) {
            $response['success'] = true;
            $response['message'] = 'Se importaron ' . count($inserdata) . ' registros correctamente';
            $sendJson($response);
        }

        $response['message'] = 'Error al guardar los datos en la base de datos';
        $sendJson($response);
    } catch (Throwable $e) {
        if (!empty($inputFileName) && file_exists($inputFileName)) {
            unlink($inputFileName);
        }
        $response['message'] = 'Error interno al procesar el archivo';
        $response['debug'] = $e->getMessage() . ' @ ' . $e->getFile() . ':' . $e->getLine();
        $sendJson($response);
    } finally {
        if ($previousErrorHandler !== null) {
            set_error_handler($previousErrorHandler);
        } else {
            restore_error_handler();
        }
        ini_set('display_errors', (string) $previousDisplayErrors);
        error_reporting($previousErrorReporting);
    }
}

    public function lista_paraclinico($doc)
    {

        $data['title'] = 'IPS NUEVA | LISTA PARACLINICO';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");
        $datos['lista_paraclinico'] = $this->MHistoria->detalle_paraclinico_x_doc($doc);
        $datos['doc'] = $doc;

        $this->load->view("CHistoria/VListaParaclinico.php", $datos);

        $this->load->view("CPlantilla/VFooter");



    }
    public function vistaparaclinico($doc)
    {

        $data['title'] = 'IPS NUEVA | vistaparaclinico';

        $this->load->view("CPlantilla/VHead", $data);

        
        $datos['vistaparaclinico'] = $this->MHistoria->detalle_vistaparaclinico_x_doc($doc);
        $datos['doc'] = $doc;

        $this->load->view("CHistoria/vistaparaclinico.php", $datos);

        $this->load->view("CPlantilla/VFooter");



    }

    public function agregar_visitas()

    {
    
        $fecha = $this->input->post('fecha');
        $doc = $this->input->post('doc');
        $edad = $this->input->post('edad');
        $hta = $this->input->post('hta');
        $dm = $this->input->post('dm');
        $telefono = $this->input->post('telefono');
        $zona  = $this->input->post('zona');
        $peso  = $this->input->post('peso');
        $talla  = $this->input->post('talla');
        $imc  = $this->input->post('imc');
        $perimetro_abdominal  = $this->input->post('perimetro_abdominal');
        $frecuencia_cardiaca  = $this->input->post('frecuenmcia_cardiaca');
        $frecuencia_respiratoria  = $this->input->post('frecuencia_respiratoria');
        $tension_arterial  = $this->input->post('tension_arterial');
        $glucometria  = $this->input->post('glucometria');
        $temperatura  = $this->input->post('temperatura');
        $familiar  = $this->input->post('familiar');
        $abandono_social  = $this->input->post('abandono_social');
        $motivo  = $this->input->post('motivo');
        $medicamentos  = $this->input->post('medicamentos');
        $riesgos  = $this->input->post('riesgos');
        $conductas = $this->input->post('conductas');
        $novedades = $this->input->post('novedades');
        $encargado = $this->input->post('encargado');
        $fecha_control = $this->input->post('fecha_control');
      
        $dt = new DateTime($fecha);
       
        $format = $dt->format('n/j/Y');
       
    
        $datos = array(
            'fecha' => $format,
            'identificacion' => $doc,
            'edad' => $edad,
            'hta' => $hta,
            'dm' => $dm,
            'telefono' => $telefono,
            'zona' => $zona,
            'peso' => $peso,
            'talla' => $talla,
            'imc' => $imc,
            'perimetro_abdominal' => $perimetro_abdominal,
            'frecuencia_cardiaca' => $frecuencia_cardiaca,
            'frecuencia_respiratoria' => $frecuencia_respiratoria,
            'tension_arterial' => $tension_arterial,
            'glucometria' => $glucometria,
            'temperatura' => $temperatura,
            'familiar' => $familiar,
            'abandono_social' => $abandono_social,
            'motivo' => $motivo,
            'medicamentos' => $medicamentos,
            'riesgos' => $riesgos,
            'conductas' => $conductas,
            'novedades' => $novedades,
            'encargado' => $encargado,
            'fecha_control' => $fecha_control
           
        );
    
        $this->MHistoria->guardar_visitas($datos);
    
        echo "<div class='alert alert-info alert-dismissible fade show' role='alert'>
        Registro guardado correctamente
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
    
    public function upload_visitas()
    {
    
        $data['title'] = 'IPS | IMPORTAR VISITAS';
    
        $this->load->view("CPlantilla/VHead", $data);
    
        $this->load->view("CPlantilla/VBarraMenu");
    
        $this->load->view("CHistoria/VVisitas.php");
    
        $this->load->view("CPlantilla/VFooter");
    }
    
    public function importar_excel()
    {
    
        $path = 'archivo/';
        include APPPATH . "/third_party/PHPExcel.php";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls|csv';
        $config['remove_spaces'] = true;
    
    
        $this->load->library('upload', $config);
            $this->upload->initialize($config); // uploadFile
            $hc_idHc = $this->input->post('idHistoria');
    
    
    
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array(
                    'error' => $this->upload->display_errors()
                );
            } else {
                $data = array(
                    'upload_data' => $this->upload->data()
                );
            }
    
    
            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
    
    
                $inputFileName = $path . $import_xls_file;
    
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
                $allDataInSheet = $objPHPExcel->setActiveSheetIndex(0)
                ->toArray(null, true, true, true);
                $flag = true;
    
                $i = 0;
                foreach ($allDataInSheet as $value) {
                    if ($flag) {
                        $flag = false;
                        continue;
                    }
                    $inserdata[$i]['fecha'] = $value['A'];
                    $inserdata[$i]['identificacion'] = $value['B'];
                    $inserdata[$i]['edad'] = $value['C'];
                    $inserdata[$i]['hta'] = $value['D'];
                    $inserdata[$i]['dm'] = $value['E'];
                    $inserdata[$i]['telefono'] = $value['F'];
                    $inserdata[$i]['zona'] = $value['G'];
                    $inserdata[$i]['peso'] = $value['H'];
                    $inserdata[$i]['talla'] = $value['I'];
                    $inserdata[$i]['imc'] = $value['J'];
                    $inserdata[$i]['perimetro_abdominal'] = $value['K'];
                    $inserdata[$i]['frecuencia_cardiaca'] = $value['L'];
                    $inserdata[$i]['frecuencia_respiratoria'] = $value['M'];
                    $inserdata[$i]['tension_arterial'] = $value['N'];
                    $inserdata[$i]['glucometria'] = $value['O'];
                    $inserdata[$i]['temperatura'] = $value['P'];
                    $inserdata[$i]['familiar'] = $value['Q'];
                    $inserdata[$i]['abandono_social'] = $value['R'];
                    $inserdata[$i]['motivo'] = $value['S'];
                    $inserdata[$i]['medicamentos'] = $value['T'];
                    $inserdata[$i]['riesgos'] = $value['U'];
                    $inserdata[$i]['conductas'] = $value['V'];
                    $inserdata[$i]['novedades'] = $value['W'];
                    $inserdata[$i]['encargado'] = $value['X'];
                    $inserdata[$i]['fecha_control'] = $value['Y'];

                    $i++;
                }
                $result = $this->MHistoria->guardar_visitas_excel($inserdata);
    
                unlink($inputFileName);
    
                echo json_encode(['success' => $result == 1, 'message' => $result == 1 ? 'Datos importados correctamente' : 'Error al procesar el archivo']);
            } else {
    
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                unlink($inputFileName);
            }
        }
    
        public function Lista_Visitas($doc)
        {
    
            $data['title'] = 'IPS NUEVA | LISTA VISITAS';
    
            $this->load->view("CPlantilla/VHead", $data);
    
    
            $datos['Lista_Visitas'] = $this->MHistoria->detalle_visitas_x_doc($doc);
            $datos['doc'] = $doc;
    
            $this->load->view("CHistoria/VListaVisitas.php", $datos);
    
            $this->load->view("CPlantilla/VFooter");

            
    
    
    
        }
        public function Lista_desentimiento($id_desentimiento)
        {
            $data['title'] = 'IPS NUEVA | DESENTIMIENTO';
        
            $this->load->view("CPlantilla/VHead", $data);
        
            $datos['dato_desentimiento'] = $this->MHistoria->datos_desentimiento($id_desentimiento);
            $datos['id_desentimiento'] = $id_desentimiento;
        
            $this->load->view("CHistoria/VDesentimiento.php", $datos);
        
            $this->load->view("CPlantilla/VFooter");
        }
        // Paraclinic View1 for History Search
        public function Lista_Visita($id_visita)
        {
            $data['title'] = 'IPS NUEVA | LISTA VISITAS';
        
            $this->load->view("CPlantilla/VHead", $data);
        
            $datos['dato_visitas'] = $this->MHistoria->datos_visitas($id_visita);
            $datos['id_visita'] = $id_visita;
        
            $this->load->view("CHistoria/VListaVisitass.php", $datos);
        
            $this->load->view("CPlantilla/VFooter");
        }

      
            public function lis($doc)
            {
        
                $data['title'] = 'IPS NUEVA | LISTA PARACLINICO1';
        
                $this->load->view("CPlantilla/VHead", $data);
        
                $this->load->view("CPlantilla/VBarraMenu");
                $datos['lista_paraclinico'] = $this->MHistoria->detalle_paraclinico_x_doc($doc);
                $datos['doc'] = $doc;
        
                $this->load->view("CHistoria/VListaParaclinico1.php", $datos);
        
                $this->load->view("CPlantilla/VFooter");
        
        
        
            }
            // Termination of view paraclinico1 history search

    public function adicional($id_hc)
    {
        $data['title'] = 'IPS NUEVA | DATO ADICIONAL';

        $this->load->view("CPlantilla/VHead", $data);

        $this->load->view("CPlantilla/VBarraMenu");
        $datos['medicamento_historia'] = $this->MHistoria->detalle_historia_medicamento($id_hc);
        $datos['cups_historia'] = $this->MHistoria->detalle_historia_cups($id_hc);
        $datos['diagnostico_historia'] = $this->MHistoria->detalle_historia_diagnostico($id_hc);
        $datos['remision_historia'] = $this->MHistoria->detalle_historia_remision($id_hc);
        $hc_data = $this->MHistorial->getInfoxidHc($id_hc);
        //echo $hc_data[0]->proceso_idProceso;
        $datos['proceso_idProceso'] = $hc_data[0]->proceso_idProceso;
        $datos['id_hc'] = $id_hc;

        $this->load->view("CHistoria/VAdicional.php", $datos);

        $this->load->view("CPlantilla/VFooter");
    }

   
}
