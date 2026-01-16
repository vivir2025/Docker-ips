<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MAgenda extends CI_Model
{

  public function __construct()
  {
    parent::__construct();

    $this->load->database();
  }

  public function verificar_traslape_horario($usuario_id, $proceso_id, $fecha, $hora_inicio, $hora_fin)
  {
    // Verifica si existe una agenda que se traslape con el horario propuesto
    $consulta = $this->db->query("
      SELECT idAgenda, ageHoraInicio, ageHoraFin
      FROM agenda
      WHERE usuario_idUsuario = ? 
      AND proceso_idProceso = ? 
      AND ageFecha = ?
      AND (
        (ageHoraInicio < ? AND ageHoraFin > ?) OR  -- La agenda existente contiene el nuevo horario
        (ageHoraInicio >= ? AND ageHoraInicio < ?) OR  -- La agenda existente empieza dentro del nuevo horario
        (ageHoraFin > ? AND ageHoraFin <= ?) -- La agenda existente termina dentro del nuevo horario
      )
    ", array($usuario_id, $proceso_id, $fecha, $hora_fin, $hora_inicio, $hora_inicio, $hora_fin, $hora_inicio, $hora_fin));
    
    return $consulta->result();
  }

  public function guardar($datos)
  {
    $consulta = $this->db->insert('agenda', $datos);

    return $this->db->insert_id();
  }
// The function returns an array of objects that contains the
// details of the agenda corresponding to the parameters provided.
  public function getAgenda($idUsuario, $ageFecha, $idProceso)
  {
    $consulta = $this->db->query("

      SELECT *

      FROM agenda AS a
      INNER JOIN usuario AS u ON u.idUsuario = a.usuario_idUsuario
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso
      INNER JOIN sede AS s ON s.idSede = a.sede_idSede
      INNER JOIN brigada AS b ON b.idBrigada = a.brigada_idBrigada
      WHERE

      a.proceso_idProceso = '" . $idProceso . "' AND  
      a.usuario_idUsuario = '" . $idUsuario . "' AND 
      a.ageFecha = '" . $ageFecha . "'
      ");
    return $consulta->result();
  }

  // It counts the number of appointments in a specific state for a given user, process, and date.
  public function contar_citas($idProceso, $idUsuario, $ageFecha){
    $consulta = $this->db->query("
        SELECT c.citEstado, COUNT(*) AS total
        FROM cita AS c
        INNER JOIN agenda AS a ON c.agenda_idAgenda = a.idAgenda
        INNER JOIN proceso AS p ON a.proceso_idProceso = p.idProceso
        INNER JOIN usuario AS u ON a.usuario_idUsuario = u.idUsuario
        WHERE 
            c.citEstado IN ('PROGRAMADO', 'FINALIZADO') AND
            p.idProceso = '" . $idProceso . "' AND
            u.idUsuario =  '" . $idUsuario . "' AND
            a.ageFecha = '" . $ageFecha . "'
        GROUP BY c.citEstado
    ");
    return $consulta->result();
}

  // Cuenta las citas por agenda específica
  public function contar_citas_por_agenda($idAgenda){
    $consulta = $this->db->query("
        SELECT c.citEstado, COUNT(*) AS total
        FROM cita AS c
        WHERE 
            c.citEstado IN ('PROGRAMADO', 'FINALIZADO') AND
            c.agenda_idAgenda = '" . $idAgenda . "'
        GROUP BY c.citEstado
    ");
    return $consulta->result();
}
// Gets the appointment information for a specific user, process, and start date, excluding canceled appointments.

  public function informacion_cita($idProceso, $idUsuario, $fechaInit)
  {
    $consulta = $this->db->query("

      SELECT * FROM  cita AS c
      INNER JOIN paciente AS pac ON c.paciente_idPaciente = pac.idPaciente
      INNER JOIN agenda AS a ON c.agenda_idAgenda = a.idAgenda
      INNER JOIN proceso AS p ON a.proceso_idProceso = p.idProceso
      INNER JOIN usuario AS u ON a.usuario_idUsuario = u.idUsuario

      WHERE

      c.citEstado != 'CANCELADO' AND
      p.idProceso = '" . $idProceso . "' AND
      u.idUsuario =  '" . $idUsuario . "' AND 
      c.citFechaInicio =  '" . $fechaInit . "'
      ");

    if ($consulta->num_rows() > 0) {

      return $consulta->result();
    } else {

      return 0;
    }
  }
  // Gets the agenda for a specific calendar ID

  public function getAgendaByid($idAgenda)
  {
    $consulta = $this->db->query("

      SELECT *

      FROM agenda AS a
      INNER JOIN proceso AS p ON p.idProceso = a.proceso_idProceso

      WHERE

      a.idAgenda = $idAgenda ");

    return $consulta->result();
  }

  public function eliminar($idAgenda) {
    $consulta = $this->db->query("DELETE FROM agenda WHERE idAgenda=$idAgenda");
    if ($consulta == true) {
      return true;
    } else {
      return false;
    }
  }

// You get a list of all the fields in the 'agenda' table.
  function get_campos_agenda()
  {
    $result = $this->db->list_fields('agenda');


    return $result;

  }
//  Gets the agenda for a specific date range.

  public function ver_agenda_by_fecha($fecha1, $fecha2)
  {

    $consulta = $this->db->query("

      SELECT * FROM agenda AS a

      WHERE
      a.ageFecha BETWEEN '" . $fecha1 . "'
      AND '" . $fecha2 . "'
      ");

    return $consulta->result();
  }
}
