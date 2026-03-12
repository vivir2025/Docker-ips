<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MHistoria extends CI_Model
{
  //detalle_control1

  public function __construct()
  {
    parent::__construct();

    $this->load->database();
  }
  // There is the function where it saves the related data of the different medical
  //  records and retrieves the data of the previous history and to print the history 
  //  with its related fields, whether it is referral medications among the other functionalities. 
  public function guardar_paraclinico_excel($_DATOS_EXCEL)
  {
    $resultado = $this
      ->db
      ->insert_batch('hcs_paraclinico', $_DATOS_EXCEL);

    if ($resultado) {
      return true;
    } else {
      return false;
    }
  }
  public function guardar_visitas_excel($_DATOS_EXCEL)
  {
    $resultado = $this
      ->db
      ->insert_batch('hcs_visitas', $_DATOS_EXCEL);

    if ($resultado) {
      return true;
    } else {
      return false;
    }
  }


  public function guardar_medicamento($data)
  {

    return $this->db->insert('historia_medicamento', $data);

    return true;
  }

  public function guardar_adicionales($datos_adicionales)
  {

    return $this->db->insert('hc_complementaria', $datos_adicionales);

    return true;
  }

  public function guardar_diagnostico($data)
  {

    return $this->db->insert('historia_diagnostico', $data);

    return true;
  }

  public function guardar_cups($data)
  {

    return $this->db->insert('historia_cups', $data);

    return true;
  }

  public function guardar_remision($datos)
  {
    $this->db->insert('historia_remision', $datos);

    return true;
  }
  public function guardar_pdf($datos)
  {
    $this->db->insert('hc-pdf', $datos);

    return true;
  }


  public function detalle_carga_priemra_vez($pacDocumento)
  {
    $consulta = $this->db->query("
      SELECT hc.insulina_requiriente, hc.id_hc, c.idCita, tp.nom_abreviacion, d.depNombre, m.munNombre, e.empNombre, o.ocuNombre, zr.zonNombre, pac.pacEstCivil, pac.pacDocumento, pac.pacNombre, pac.pacApellido, pac.pacFecNacimiento, pac.pacSexo, r.regNombre, pac.pacTelefono, pac.pacDireccion, hc.hcAcompanante, hc.hcAcuParentesco, hc.hcAcuTelefono, hc.finalidad_idFinalidad,hc.fecha_final,
      hc.hcClasificacionHta,  hc.hcClasificacionDm, hc.hcClasificacionRcv,hc.hcClasificacionEstadoMetabolico, hc.hcAlimentacion, hc.hcHipertensionArterialPersonal,hcDiabetesMellitusPersonal,hc.hcFomentoActividadFisica, hc.hcOmportanciaAdherenciaTratamiento, hc.hcDisminucionConsumoSalAzucar, hc.hcDisminucionConsumoCigarrillo, hc.hcDisminucionPeso, hc.hcConsumoFrutasVerduras, hc.hcOlvidaTomarMedicamentos, hc.hcTomaMedicamentosHoraIndicada, hc.hcCuandoEstaBienDejaTomarMedicamentos, hc.hcSienteMalDejaTomarlos, u.usuNombre, u.usuApellido, u.usuRegistroProfesional, hc.hcClasificacionErcEstado, hc.hcClasificacionErcCategoriaAmbulatoriaPersistente, hc.tasa_filtracion_glomerular_ckd_epi, hc.tasa_filtracion_glomerular_gockcroft_gault, c.citFecha
      FROM hc AS hc

      INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
      INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente
      INNER JOIN tipo_documento AS tp ON tp.idTipDocumento = pac.pacTipDocumento
      INNER JOIN departamento AS d ON d.idDepartamento  = pac.depto_residencia
      INNER JOIN municipio AS m ON m.idMunicipio  = pac.municipio_residencia
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN zona_residencial AS zr ON zr.zona_residencial = pac.id_zona_residencia
      INNER JOIN tipo_afiliciacion AS ta ON ta.tip_afi = pac.id_tipo_afiliacion
      INNER JOIN ocupacion AS o ON o.idOcupacion = pac.pacOcupacion
      INNER JOIN regimen AS r ON r.idRegimen = pac.regimen_idRegimen

      WHERE 
      pac.pacDocumento = '" . $pacDocumento . "' AND
      (c.citEstado = 'FINALIZADO' OR c.citEstado = 'FINALIZADO Y FACTURADO') AND
      a.proceso_idProceso = 3
      ORDER BY c.citFechaInicio DESC LIMIT 1;");

    return $consulta->result();
  }

  public function detalle_control($pacDocumento)
  {
    $consulta = $this->db->query("
      SELECT hc.insulina_requiriente, hc.id_hc, c.idCita, tp.nom_abreviacion, d.depNombre, m.munNombre, e.empNombre, o.ocuNombre, zr.zonNombre, pac.pacEstCivil, pac.pacDocumento, pac.pacNombre, pac.pacApellido, pac.pacFecNacimiento, pac.pacSexo, r.regNombre, pac.pacTelefono, pac.pacDireccion, hc.hcAcompanante, hc.hcAcuParentesco, hc.hcAcuTelefono, hc.finalidad_idFinalidad,hc.fecha_final,
      hc.hcClasificacionHta,hc.hcTalla, hc.hcClasificacionDm, hc.hcClasificacionRcv,hc.hcClasificacionEstadoMetabolico, hc.hcAlimentacion, hc.hcHipertensionArterialPersonal,hc.hcDiabetesMellitusPersonal,hc.hcFomentoActividadFisica, hc.hcOmportanciaAdherenciaTratamiento, hc.hcDisminucionConsumoSalAzucar, hc.hcDisminucionConsumoCigarrillo, hc.hcDisminucionPeso, hc.hcConsumoFrutasVerduras, hc.hcOlvidaTomarMedicamentos, hc.hcTomaMedicamentosHoraIndicada, hc.hcCuandoEstaBienDejaTomarMedicamentos, hc.hcSienteMalDejaTomarlos, u.usuNombre, u.usuApellido, u.usuRegistroProfesional, hc.hcClasificacionErcEstado, hc.hcClasificacionErcCategoriaAmbulatoriaPersistente, hc.tasa_filtracion_glomerular_ckd_epi, hc.tasa_filtracion_glomerular_gockcroft_gault
      FROM hc AS hc

      INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
      INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente
      INNER JOIN tipo_documento AS tp ON tp.idTipDocumento = pac.pacTipDocumento
      INNER JOIN departamento AS d ON d.idDepartamento  = pac.depto_residencia
      INNER JOIN municipio AS m ON m.idMunicipio  = pac.municipio_residencia
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN zona_residencial AS zr ON zr.zona_residencial = pac.id_zona_residencia
      INNER JOIN tipo_afiliciacion AS ta ON ta.tip_afi = pac.id_tipo_afiliacion
      INNER JOIN ocupacion AS o ON o.idOcupacion = pac.pacOcupacion
      INNER JOIN regimen AS r ON r.idRegimen = pac.regimen_idRegimen

      WHERE 
      pac.pacDocumento = '" . $pacDocumento . "' AND
      (c.citEstado = 'FINALIZADO' OR c.citEstado = 'FINALIZADO Y FACTURADO') AND
      (a.proceso_idProceso = 1 OR a.proceso_idProceso = 3 OR a.proceso_idProceso = 4 OR a.proceso_idProceso = 6 OR a.proceso_idProceso = 7)
      ORDER BY c.citFechaInicio DESC LIMIT 1;");

    return $consulta->result();
  }


  public function detalle_clasificacion($pacDocumento)
  {
    $consulta = $this->db->query("
      SELECT hc.insulina_requiriente, hc.id_hc, c.idCita, hc.hcAcompanante, hc.hcAcuParentesco, 
      hc.hcAcuTelefono, hc.finalidad_idFinalidad,hc.fecha_final,
      hc.hcClasificacionHta, hc.hcClasificacionDm, hc.hcClasificacionRcv,hc.hcClasificacionEstadoMetabolico, hc.hcAlimentacion, hc.hcHipertensionArterialPersonal, hc.hcDiabetesMellitusPersonal,
      hc.hcFomentoActividadFisica,
      hc.hcOmportanciaAdherenciaTratamiento, hc.hcDisminucionConsumoSalAzucar, 
      hc.hcDisminucionConsumoCigarrillo, hc.hcDisminucionPeso, hc.hcConsumoFrutasVerduras, 
      hc.hcOlvidaTomarMedicamentos, hc.hcTomaMedicamentosHoraIndicada, 
      hc.hcCuandoEstaBienDejaTomarMedicamentos, hc.hcSienteMalDejaTomarlos,
      hc.hcClasificacionErcEstado, hc.hcClasificacionErcCategoriaAmbulatoriaPersistente, 
      hc.tasa_filtracion_glomerular_ckd_epi, hc.tasa_filtracion_glomerular_gockcroft_gault
      FROM hc AS hc

      INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
      INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente

      WHERE 
      pac.pacDocumento = '" . $pacDocumento . "' AND
      (c.citEstado = 'FINALIZADO' OR c.citEstado = 'FINALIZADO Y FACTURADO') AND
      (a.proceso_idProceso = 1 OR a.proceso_idProceso = 6 OR a.proceso_idProceso = 7)
      ORDER BY c.citFechaInicio DESC LIMIT 1;");

    return $consulta->result();
  }

  public function detalle_control1($pacDocumento)
  {
    $consulta = $this->db->query("
      SELECT hc.insulina_requiriente, hc.id_hc, c.idCita, tp.nom_abreviacion, d.depNombre, m.munNombre, e.empNombre, o.ocuNombre, zr.zonNombre, pac.pacEstCivil, pac.pacDocumento, pac.pacNombre , pac.pacNombre2, pac.pacApellido , pac.pacApellido2, pac.pacFecNacimiento, pac.pacSexo, r.regNombre, pac.pacTelefono, pac.pacDireccion, hc.hcAcompanante, hc.hcAcuParentesco, hc.hcAcuTelefono, hc.finalidad_idFinalidad,hc.fecha_final,
      hc.hcClasificacionHta, hc.hcClasificacionDm, hc.hcClasificacionRcv,hc.hcClasificacionEstadoMetabolico, hc.hcAlimentacion, hc.hcHipertensionArterialPersonal, hc.hcDiabetesMellitusPersonal,hc.hcFomentoActividadFisica, hc.hcOmportanciaAdherenciaTratamiento, hc.hcDisminucionConsumoSalAzucar, hc.hcDisminucionConsumoCigarrillo, hc.hcDisminucionPeso, hc.hcConsumoFrutasVerduras, hc.hcOlvidaTomarMedicamentos, hc.hcTomaMedicamentosHoraIndicada, hc.hcCuandoEstaBienDejaTomarMedicamentos, hc.hcSienteMalDejaTomarlos, u.usuNombre, u.usuApellido, u.usuRegistroProfesional, hc.hcClasificacionErcEstado, hc.hcClasificacionErcCategoriaAmbulatoriaPersistente, hc.tasa_filtracion_glomerular_ckd_epi, hc.tasa_filtracion_glomerular_gockcroft_gault
      FROM hc AS hc

      INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
      INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente
      INNER JOIN tipo_documento AS tp ON tp.idTipDocumento = pac.pacTipDocumento
      INNER JOIN departamento AS d ON d.idDepartamento  = pac.depto_residencia
      INNER JOIN municipio AS m ON m.idMunicipio  = pac.municipio_residencia
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN zona_residencial AS zr ON zr.zona_residencial = pac.id_zona_residencia
      INNER JOIN tipo_afiliciacion AS ta ON ta.tip_afi = pac.id_tipo_afiliacion
      INNER JOIN ocupacion AS o ON o.idOcupacion = pac.pacOcupacion
      INNER JOIN regimen AS r ON r.idRegimen = pac.regimen_idRegimen

      WHERE 
      pac.pacDocumento = '" . $pacDocumento . "' AND
      (c.citEstado = 'FINALIZADO' OR c.citEstado = 'FINALIZADO Y FACTURADO') AND
      (a.proceso_idProceso = 1 OR a.proceso_idProceso = 3 OR a.proceso_idProceso = 4 OR a.proceso_idProceso = 5 OR a.proceso_idProceso = 6 OR a.proceso_idProceso = 7)
      ORDER BY c.citFechaInicio DESC LIMIT 1;");

    return $consulta->result();
  }

  public function detalle_hc_por_documento($pacDocumento)
  {
    $consulta = $this->db->query("

     SELECT *
     FROM hc AS hc
     INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
     INNER JOIN cups_contratado AS cc ON cc.id_cups_contrato = c.idCupsContratado
     INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
     INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
     INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
     INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente
     WHERE 
     a.proceso_idProceso = 1 AND
     pac.pacDocumento = '" . $pacDocumento . "' 
     ORDER BY c.citFechaInicio DESC LIMIT 1 ");

    return $consulta->result();
  }

  public function getPaciente($idUsuario, $fecha)
  {
    $consulta = $this->db->query("

      SELECT
      ccups.id_cat_cups, ccups.catNombre, c.idCita, c.citFechaInicio, pac.pacDocumento, pac.pacNombre, pac.pacApellido, e.empNombre, cup.cupNombre, ccups.catNombre, c.citEstado, usu_age.usuNombre, usu_age.usuApellido, a.proceso_idProceso 
      FROM  cita AS c

      INNER JOIN usuario AS usu_age ON usu_age.idUsuario = c.usu_creo_cita
      INNER JOIN cups_contratado AS cc ON cc.id_cups_contrato = c.idCupsContratado
      INNER JOIN cups AS cup ON cup.idCups = cc.cups_idCups
      INNER JOIN categoria_cups AS ccups ON ccups.id_cat_cups = cc.id_categoria_cups
      INNER JOIN paciente AS pac ON c.paciente_idPaciente = pac.idPaciente
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN agenda AS a ON c.agenda_idAgenda = a.idAgenda
      INNER JOIN proceso AS p ON a.proceso_idProceso = p.idProceso
      INNER JOIN usuario AS u ON a.usuario_idUsuario = u.idUsuario

      WHERE
      c.citFecha = '" . $fecha . "' AND
      u.idUsuario = '" . $idUsuario . "' ");
    return $consulta->result();
  }
  public function informacion_cita($idProceso, $idUsuario, $fecha)
  {
    $consulta = $this->db->query("

      SELECT * FROM  cita AS c
      
      INNER JOIN usuario AS usu_age ON usu_age.idUsuario = c.usu_creo_cita
      INNER JOIN cups_contratado AS cc ON cc.id_cups_contrato = c.idCupsContratado
      INNER JOIN cups AS cup ON cup.idCups = cc.cups_idCups
      INNER JOIN categoria_cups AS ccups ON ccups.id_cat_cups = cc.id_categoria_cups
      INNER JOIN paciente AS pac ON c.paciente_idPaciente = pac.idPaciente
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN agenda AS a ON c.agenda_idAgenda = a.idAgenda
      INNER JOIN proceso AS p ON a.proceso_idProceso = p.idProceso
      INNER JOIN usuario AS u ON a.usuario_idUsuario = u.idUsuario

      WHERE

      c.citEstado != 'CANCELADO' AND  
      /*c.citEstado != 'FINALIZADO' AND
      c.citEstado != 'FINALIZADO Y FACTURADO' AND*/
      p.idProceso = '" . $idProceso . "' AND
      u.idUsuario =  '" . $idUsuario . "' AND 
      c.citFecha=  '" . $fecha . "'
      ORDER BY c.citFechaInicio ASC
      ");

    return $consulta->result();
  }

  public function informacion_cita1($idProceso, $idUsuario, $fecha)
  {
    $consulta = $this->db->query("

      SELECT * FROM  cita AS c
      
      LEFT JOIN hc AS h ON h.cita_idCita = c.idCita
      INNER JOIN usuario AS usu_age ON usu_age.idUsuario = c.usu_creo_cita
      INNER JOIN cups_contratado AS cc ON cc.id_cups_contrato = c.idCupsContratado
      INNER JOIN cups AS cup ON cup.idCups = cc.cups_idCups
      INNER JOIN categoria_cups AS ccups ON ccups.id_cat_cups = cc.id_categoria_cups
      INNER JOIN paciente AS pac ON c.paciente_idPaciente = pac.idPaciente
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN agenda AS a ON c.agenda_idAgenda = a.idAgenda
      INNER JOIN proceso AS p ON a.proceso_idProceso = p.idProceso
      INNER JOIN usuario AS u ON a.usuario_idUsuario = u.idUsuario

      WHERE

      c.citEstado != 'CANCELADO' AND  
      /*c.citEstado != 'FINALIZADO' AND
      c.citEstado != 'FINALIZADO Y FACTURADO' AND*/
      p.idProceso = '" . $idProceso . "' AND
      u.idUsuario =  '" . $idUsuario . "' AND 
      c.citFecha=  '" . $fecha . "'
      ORDER BY c.citFechaInicio ASC
      ");

    return $consulta->result();
  }

  // Nueva función para obtener citas por agenda específica
  public function informacion_cita_por_agenda($idAgenda, $fecha)
  {
    $consulta = $this->db->query("

      SELECT * FROM  cita AS c
      
      LEFT JOIN hc AS h ON h.cita_idCita = c.idCita
      INNER JOIN usuario AS usu_age ON usu_age.idUsuario = c.usu_creo_cita
      INNER JOIN cups_contratado AS cc ON cc.id_cups_contrato = c.idCupsContratado
      INNER JOIN cups AS cup ON cup.idCups = cc.cups_idCups
      INNER JOIN categoria_cups AS ccups ON ccups.id_cat_cups = cc.id_categoria_cups
      INNER JOIN paciente AS pac ON c.paciente_idPaciente = pac.idPaciente
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN agenda AS a ON c.agenda_idAgenda = a.idAgenda
      INNER JOIN proceso AS p ON a.proceso_idProceso = p.idProceso
      INNER JOIN usuario AS u ON a.usuario_idUsuario = u.idUsuario

      WHERE

      c.citEstado != 'CANCELADO' AND  
      a.idAgenda = '" . $idAgenda . "' AND 
      c.citFecha=  '" . $fecha . "'
      ORDER BY c.citFechaInicio ASC
      ");

    return $consulta->result();
  }

  public function getItinerarioAgendaUser($idUsuario, $fecha)
  {
    $consulta = $this->db->query("

     SELECT * FROM agenda AS a
     INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
     INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
     INNER JOIN sede AS s ON s.idSede = a.sede_idSede

     WHERE
     a.ageFecha = '" . $fecha . "' AND
     a.usuario_idUsuario = '" . $idUsuario . "'

     ");
    return $consulta->result();
  }

  public function get_data_paciente($idCita)
  {
    $consulta = $this->db->query("

      SELECT * FROM  cita AS c
      INNER JOIN cups_contratado AS cc ON cc.id_cups_contrato = c.idCupsContratado
      INNER JOIN cups AS cup ON cup.idCups = cc.cups_idCups
      INNER JOIN agenda AS a ON  a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON  a.usuario_idUsuario = u.idUsuario
	  INNER JOIN especialidad AS ui ON ui.idEspecialidad = u.especialidad_idEspecialidad	  
      INNER JOIN paciente AS pac ON c.paciente_idPaciente = pac.idPaciente
      INNER JOIN tipo_documento AS tp ON tp.idTipDocumento = pac.pacTipDocumento
      INNER JOIN departamento AS d ON d.idDepartamento  = pac.depto_residencia
      INNER JOIN municipio AS m ON m.idMunicipio  = pac.municipio_residencia
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN zona_residencial AS zr ON zr.zona_residencial = pac.id_zona_residencia
      INNER JOIN regimen AS r ON r.idRegimen = pac.regimen_idRegimen
      INNER JOIN tipo_afiliciacion AS ta ON ta.tip_afi = pac.id_tipo_afiliacion
      INNER JOIN ocupacion AS o ON o.idOcupacion = pac.pacOcupacion

      WHERE

      c.idCita = '" . $idCita . "'


      ");
    return $consulta->result();
  }

  public function guardar($datos)
  {
    $this->db->insert('hc', $datos);

    return $this->db->insert_id();
  }

  public function ver_codigo($codigo)
  {
    $consulta = $this->db->query("

      SELECT * FROM  diagnostico AS d WHERE d.diaCodigo LIKE '" . $codigo . "%'");
    return $consulta->result();
  }

  public function ver_diagnostico($nombre_diagnostico)
  {
    $consulta = $this->db->query("

      SELECT * FROM  diagnostico AS d WHERE d.diaNombre LIKE '%" . $nombre_diagnostico . "%'");
    return $consulta->result();
  }

  public function getCupsByNombre($nombre_cups)
  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      cups AS c
      WHERE
      c.cupNombre LIKE '%" . $nombre_cups . "%'");
    return $consulta->result();
  }

  public function getMedicamentoByNombre($nombre_medicamento)
  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      medicamento AS m
      WHERE
      m.medNombre LIKE '%" . $nombre_medicamento . "%'");
    return $consulta->result();
  }

  public function getRemisionByNombre($nombre_remision)
  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      remision AS r
      WHERE
      r.remNombre LIKE '%" . $nombre_remision . "%'");
    return $consulta->result();
  }

  public function detalle_historia_medicamento($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_medicamento AS hm
      INNER JOIN medicamento AS m ON m.idMedicamento = hm.medicamento_idMedicamento
      WHERE
      hm. historia_idHistoria = $idHistoria");
    return $consulta->result();
  }

  public function detalle_historia_diagnostico($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_diagnostico AS hd
      INNER JOIN diagnostico AS d ON d.idDiagnostico = hd.diagnostico_idDiagnostico
      WHERE
      hd. historia_idHistoria = $idHistoria");
    return $consulta->result();
  }

  public function detalle_historia_diagnostico_principal($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_diagnostico AS hd
      INNER JOIN diagnostico AS d ON d.idDiagnostico = hd.diagnostico_idDiagnostico
      WHERE
      hd.his_dia_tipo = 'PRINCIPAL' AND
      hd.historia_idHistoria = $idHistoria");
    return $consulta->result();
  }

  public function detalle_historia_diagnostico_Dx1($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_diagnostico AS hd
      INNER JOIN diagnostico AS d ON d.idDiagnostico = hd.diagnostico_idDiagnostico
      WHERE
      hd.his_dia_tipo = 'TIPO 1' AND
      hd.historia_idHistoria = $idHistoria");
    return $consulta->result();
  }

  public function detalle_historia_diagnostico_Dx2($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_diagnostico AS hd
      INNER JOIN diagnostico AS d ON d.idDiagnostico = hd.diagnostico_idDiagnostico
      WHERE
      hd.his_dia_tipo = 'TIPO 2' AND
      hd.historia_idHistoria = $idHistoria");
    return $consulta->result();
  }

  public function detalle_historia_diagnostico_Dx3($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_diagnostico AS hd
      INNER JOIN diagnostico AS d ON d.idDiagnostico = hd.diagnostico_idDiagnostico
      WHERE
      hd.his_dia_tipo = 'TIPO 3' AND
      hd.historia_idHistoria = $idHistoria");
    return $consulta->result();
  }


  public function detalle_historia_remision($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_remision AS hr
      INNER JOIN remision AS r ON r.idRemision = hr.remision_idRemision
      WHERE
      hr. historia_idHistoria = $idHistoria");
    return $consulta->result();
  }


  // funcion para listar las rutas de los pdf
  public function detalle_historia_pdf($idHistoria)
  {
      $consulta = $this->db->query("SELECT *
                                    FROM `hc-pdf`
                                    WHERE idHistoria = $idHistoria");
      return $consulta->result();
  }
  

  public function detalle_antecedentes_personales($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      hc_complementaria AS hcc
    
      WHERE
      hcc. hc_idHc = $idHistoria");
    return $consulta->result();
  }

  public function detalle_historia_cups($idHistoria)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      historia_cups AS hc
      INNER JOIN cups AS c ON c.idCups = hc.cups_idCups
      WHERE
      hc. historia_idHistoria = $idHistoria");
    return $consulta->result();
  }

  public function getHcByIdCita($idCita)
  {
    $consulta = $this->db->query("

      SELECT * FROM  hc
      WHERE

      hc.cita_idCita = $idCita

      ");
    return $consulta->result();
  }


  public function actualizar_guardado($datos, $idHistoria)
  {
    $this->db->where('id_hc', $idHistoria);
    $consulta = $this->db->update('hc', $datos);
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_medicamento($id_his_med)
  {
    $consulta = $this->db->query("DELETE FROM historia_medicamento WHERE id_his_med=$id_his_med");
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }
  public function delete_remision($id_his_rem)
  {
    $consulta = $this->db->query("DELETE FROM historia_remision WHERE id_his_rem=$id_his_rem");
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_cups($id_his_cups)
  {
    $consulta = $this->db->query("DELETE FROM historia_cups WHERE id_his_cups=$id_his_cups");
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }

  public function delete_diagnostico($id_his_dia)
  {
    $consulta = $this->db->query("DELETE FROM historia_diagnostico WHERE id_his_dia=$id_his_dia");
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }

  public function datos_historia($idHistoria)
  {
    $consulta = $this->db->query("

      SELECT * FROM  hc AS hc 
      INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
      INNER JOIN cups_contratado AS cc ON cc.id_cups_contrato = c.idCupsContratado
      INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente
      INNER JOIN tipo_documento AS tp ON tp.idTipDocumento = pac.pacTipDocumento
      INNER JOIN departamento AS d ON d.idDepartamento  = pac.depto_residencia
      INNER JOIN municipio AS m ON m.idMunicipio  = pac.municipio_residencia
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN zona_residencial AS zr ON zr.zona_residencial = pac.id_zona_residencia
      INNER JOIN tipo_afiliciacion AS ta ON ta.tip_afi = pac.id_tipo_afiliacion
      INNER JOIN ocupacion AS o ON o.idOcupacion = pac.pacOcupacion
      INNER JOIN regimen AS r ON r.idRegimen = pac.regimen_idRegimen
      WHERE hc.id_hc = $idHistoria");
    return $consulta->result();

  }
  public function datos_visitas($id_visita)
  {
      $consulta = $this->db->query("
          SELECT * FROM hcs_visitas
          WHERE id_hcs_visitas = $id_visita
      ");
  
      return $consulta->result();
  }
  public function datos_desentimiento($id_desentimiento)
  {
      $consulta = $this->db->query("
          SELECT * FROM desentimiento
          WHERE id_de = $id_desentimiento
      ");
  
      return $consulta->result();
  }
  public function actualizardatos($data, $id_his_dia)
  {
    $this->db->where('id_his_dia', $id_his_dia);
    $consulta = $this->db->update('historia_diagnostico', $data);
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }

  public function actualizar_diagnostico($data, $id)
  {
    $this->db->where('id_his_med', $id);
    $consulta = $this->db->update('historia_medicamento', $data);
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }


  function ver_medicamento($postData = array())
  {

    $response = array();

    if (isset($postData['id_his_med'])) {

      // Select record
      $this->db->select('*');
      $this->db->where('id_his_med', $postData['id_his_med']);
      $records = $this->db->get('historia_medicamento');
      $response = $records->result_array();
    }

    return $response;
  }

  public function detalle_trabajo_social($pacDocumento)
  {
    $consulta = $this->db->query("
      SELECT * FROM hc AS hc

      INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
      INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente
      INNER JOIN tipo_documento AS tp ON tp.idTipDocumento = pac.pacTipDocumento
      INNER JOIN departamento AS d ON d.idDepartamento  = pac.depto_residencia
      INNER JOIN municipio AS m ON m.idMunicipio  = pac.municipio_residencia
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN zona_residencial AS zr ON zr.zona_residencial = pac.id_zona_residencia
      INNER JOIN tipo_afiliciacion AS ta ON ta.tip_afi = pac.id_tipo_afiliacion
      INNER JOIN ocupacion AS o ON o.idOcupacion = pac.pacOcupacion
      INNER JOIN regimen AS r ON r.idRegimen = pac.regimen_idRegimen

      WHERE 
      pac.pacDocumento = '" . $pacDocumento . "' AND
      (c.citEstado = 'FINALIZADO' OR c.citEstado = 'FINALIZADO Y FACTURADO') AND
      a.proceso_idProceso = 2
      ORDER BY c.citFechaInicio DESC LIMIT 1;");



    return $consulta->result();
  }

  public function detalle_reformulacion($pacDocumento)
  {
    $consulta = $this->db->query("
      SELECT * FROM hc AS hc

      INNER JOIN cita AS c ON c.idCita = hc.cita_idCita
      INNER JOIN agenda AS a ON a.idAgenda = c.agenda_idAgenda
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN paciente AS pac ON pac.idPaciente = c.paciente_idPaciente
      INNER JOIN tipo_documento AS tp ON tp.idTipDocumento = pac.pacTipDocumento
      INNER JOIN departamento AS d ON d.idDepartamento  = pac.depto_residencia
      INNER JOIN municipio AS m ON m.idMunicipio  = pac.municipio_residencia
      INNER JOIN empresa AS e ON e.idEmpresa = pac.empresa_idEmpresa
      INNER JOIN zona_residencial AS zr ON zr.zona_residencial = pac.id_zona_residencia
      INNER JOIN tipo_afiliciacion AS ta ON ta.tip_afi = pac.id_tipo_afiliacion
      INNER JOIN ocupacion AS o ON o.idOcupacion = pac.pacOcupacion
      INNER JOIN regimen AS r ON r.idRegimen = pac.regimen_idRegimen

      WHERE 
      pac.pacDocumento = '" . $pacDocumento . "' AND
      (c.citEstado = 'FINALIZADO' OR c.citEstado = 'FINALIZADO Y FACTURADO') AND
      (a.proceso_idProceso = 1 OR a.proceso_idProceso = 6 OR a.proceso_idProceso = 7)
      ORDER BY c.citFechaInicio DESC LIMIT 1;");
    return $consulta->result();
  }


  function get_campos_hc()
  {
    $result = $this->db->list_fields('hc');


    return $result;
  }

  function get_campos_hc_complementaria()
  {
    $result = $this->db->list_fields('hc_complementaria');


    return $result;
  }

  public function ver_hc_by_fecha($fecha1, $fecha2)
  {

    $consulta = $this->db->query("

      SELECT h.* FROM hc AS h

      INNER JOIN cita AS c ON c.idCita = h.cita_idCita

      WHERE
      c.citFecha BETWEEN '" . $fecha1 . "'
      AND '" . $fecha2 . "'
      ");

    return $consulta->result();
  }

  public function ver_hc_complementaria_by_fecha($fecha1, $fecha2)
  {

    $consulta = $this->db->query("

      SELECT hcc.* FROM hc_complementaria AS hcc

      INNER JOIN hc AS h ON h.id_hc = hcc.hc_idHc
      INNER JOIN cita AS c ON c.idCita = h.cita_idCita

      WHERE
      c.citFecha BETWEEN '" . $fecha1 . "'
      AND '" . $fecha2 . "'
      ");

    return $consulta->result();
  }

  function get_campos_hc_medicamento()
  {
    $result = $this->db->list_fields('historia_medicamento');


    return $result;
  }

  public function ver_hc_medicamento_by_fecha($fecha1, $fecha2)
  {

    $consulta = $this->db->query("

      SELECT hm .* FROM historia_medicamento AS hm

      INNER JOIN hc AS h ON h.id_hc = hm.historia_idHistoria
      INNER JOIN cita AS c ON c.idCita = h.cita_idCita

      WHERE
      c.citFecha BETWEEN '" . $fecha1 . "'
      AND '" . $fecha2 . "'

      ");

    return $consulta->result();
  }

  function get_campos_hc_cups()
  {
    $result = $this->db->list_fields('historia_cups');


    return $result;
  }

  public function ver_hc_cups_by_fecha($fecha1, $fecha2)
  {

    $consulta = $this->db->query("

      SELECT cc.* FROM historia_cups AS cc

      INNER JOIN hc AS h ON h.id_hc = cc.historia_idHistoria
      INNER JOIN cita AS c ON c.idCita = h.cita_idCita

      WHERE
      c.citFecha BETWEEN '" . $fecha1 . "'
      AND '" . $fecha2 . "'

      ");

    return $consulta->result();
  }

  function get_campos_hc_diagnostico()
  {
    $result = $this->db->list_fields('historia_diagnostico');


    return $result;
  }

  public function ver_hc_diagnostico_by_fecha($fecha1, $fecha2)
  {

    $consulta = $this->db->query("

      SELECT cc.* FROM historia_diagnostico AS cc

      INNER JOIN hc AS h ON h.id_hc = cc.historia_idHistoria
      INNER JOIN cita AS c ON c.idCita = h.cita_idCita

      WHERE
      c.citFecha BETWEEN '" . $fecha1 . "'
      AND '" . $fecha2 . "'

      ");

    return $consulta->result();
  }

  function get_campos_hc_remision()
  {
    $result = $this->db->list_fields('historia_remision');


    return $result;
  }

  public function ver_hc_remision_by_fecha($fecha1, $fecha2)
  {

    $consulta = $this->db->query("

      SELECT cc.* FROM historia_remision AS cc

      INNER JOIN hc AS h ON h.id_hc = cc.historia_idHistoria
      INNER JOIN cita AS c ON c.idCita = h.cita_idCita

      WHERE
      c.citFecha BETWEEN '" . $fecha1 . "'
      AND '" . $fecha2 . "'

      ");

    return $consulta->result();
  }

  public function get_campos_nullables_hc()
  {
    $consulta = $this->db->query("SHOW COLUMNS FROM hc");
    $campos = array();

    foreach ($consulta->result() as $column) {
      if (isset($column->Null) && $column->Null === 'YES') {
        $campos[] = $column->Field;
      }
    }

    return $campos;
  }

  public function get_paraclinico()
  {
    $consulta = $this->db->query("

     SELECT *
     FROM paraclinico");

    return $consulta->result();
  }

  public function guardar_paraclinico($data)
  {

    return $this->db->insert('hcs_paraclinico', $data);

    return true;
  }

  public function detalle_paraclinico_x_doc($documento)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      hcs_paraclinico AS hcp
      WHERE
      hcp.identificacion = $documento

      ORDER BY hcp.fecha DESC LIMIT 2");
    return $consulta->result();
  }
 

  

  public function guardar_visitas($data)
  {

    return $this->db->insert('hcs_visitas', $data);

    return true;
  }

  public function detalle_visitas_x_doc($documento)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      hcs_visitas AS hcp
      WHERE
      hcp.identificacion = $documento

      ORDER BY hcp.fecha DESC LIMIT 2");
    return $consulta->result();
  }







  //paraclinico1 vista para historial busqueda

  public function get_vistaparaclinico()
  {
    $consulta = $this->db->query("

     SELECT *
     FROM paraclinico");

    return $consulta->result();
  }

  public function guardar_vistaparaclinico($data)
  {

    return $this->db->insert('hcs_paraclinico', $data);

    return true;
  }

  public function detalle_vistaparaclinico_x_doc($documento)

  {
    $consulta = $this->db->query("SELECT
                                     *
      FROM
      hcs_paraclinico AS hcp
      WHERE
      hcp.identificacion = $documento

      ORDER BY hcp.fecha DESC LIMIT 2");
    return $consulta->result();
  }
  
}
