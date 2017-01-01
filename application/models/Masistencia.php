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
		echo $this->db->last_query();
		exit;
	     if( $query->num_rows() > 0 ) {
	     	foreach ( $query->result() as $key => $row ) {
				$rows[$row->id] = $row;
			}
		}
		return $rows;
	}
}	
