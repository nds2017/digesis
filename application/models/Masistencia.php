<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Masistencia extends CI_Model
{
	public function __construct()
	{
		parent::__construct();		
	}
	public function getAsistenciaByIdAndMonth($id=null){		

		$rows = array();
		$this->db->select('a.*');
		$this->db->from('asistencia a');
		$this->db->where('month(FROM_UNIXTIME(a.fecha))=',intval(date('m')));
		$this->db->where('a.idtecnico=',$id);
		$this->db->order_by("a.fecha");
		$query = $this->db->get();  
		//echo $this->db->last_query();
		//exit;
	     if( $query->num_rows() > 0 ) {
	     	foreach ( $query->result() as $key => $row ) {
				$rows[$row->id] = $row;
			}
		}
		return $rows;
	}

	function get_records($fecha = null)
      	{
            date_default_timezone_set('America/Lima');
            $this->db->select('*');
            $this->db->from('asistencia');
            $this->db->join('tecnicos', 'tecnicos.id = asistencia.idtecnico');
        	$this->db->where('fecha', strtotime($fecha));
            $query = $this->db->get();
            $data = $query->result();
            //
            if(!empty($query->result())){
              $data = $query->result();
            } else{
              $query = $this->db->get('tecnicos');
              $data = $query->result();
            }

            if(!empty($data)){
              return $data;
            }
            return false;
        }

        function set_records($output = array())
        {
            date_default_timezone_set('America/Lima');
            $this->db->select('*');
            $this->db->from('asistencia');
            $this->db->where('fecha', $output['date']);
            $query = $this->db->get();
            $dataa = $query->result();

            if(!empty($dataa)){
              $this->db->delete('asistencia', array('fecha' =>strtotime($output['date'])));
            }

            for ($i=1; $i <= $output['cantidad']; $i++) {

                $idtecnico  = $output['idtecnico-' . $i];
                $fecha      = (isset($output['date']) && $output['date'] != '') ? $output['date'] : date('Y-m-d');
                $asistio    = (isset($output['asistencia-' . $i])) ? $output['asistencia-' . $i] : '0';
                $falto      = (isset($output['descanso-' . $i])) ? $output['descanso-' . $i] : '0';
                $motivo     = (isset($output['motivo-' . $i]) && trim($output['motivo-' . $i]) != '') ? $output['motivo-' . $i] : '';

              //  echo '<pre>';
              //  var_dump($motivo);
              //  echo '</pre>';
              //  die();

                $data = array(
                    'idTecnico' => $idtecnico,
                    'fecha'     => $fecha,
                    'asistencia'   => $asistio,
                    'descanso'     => $falto,
                    'motivo'    => $motivo
                );
                $result = $this->db->insert('asistencia', $data);

            }

            if($result){
              return $result;
            }
            return false;
        }

}	
