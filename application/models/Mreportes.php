<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mreportes extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function tecnico_getEncuestas($tid = null) {
		$rows = array();
		$this->db->select('s.id, s.fecha_instalacion');
		$this->db->from('solicitudes s');
		$this->db->join('solicitudestecnicos st', 'st.sid = s.id', 'left');
		$this->db->where('s.estadoid', 2);
		$where = "(st.t1id = $tid OR st.t2id = $tid)";
		$this->db->where($where);
		$query = $this->db->get();
		$rows['promedio'] = 0;
		if ( $query->num_rows() > 0 ) {
			foreach ( $query->result() as $key => $row ) {
				$row->encuestas = $this->mreportes->preguntas_bySid($row->id);
				$row->fecha_instalacion = date('d/m/Y', $row->fecha_instalacion);
				$this->db->select_avg('respuesta');
				$this->db->where('sid', $row->id);
				$row->promedio = $this->db->get('encuestas')->row()->respuesta;
				$rows['promedio'] += $row->promedio;
				$rows['solicitudes'][] = $row;
			}
			$rows['promedio'] = $rows['promedio'] / ( count($rows['solicitudes']) - 1 );
		}
		return $rows;
	}

	public function preguntas_bySid($sid) {
		$rows = array();
		$query = $this->db->query("SELECT preguntaid, respuesta FROM encuestas WHERE sid = '$sid'");
		foreach ( $query->result() as $key=>$row ) {
			$rows[$row->preguntaid] = $row->respuesta;
		}
		return $rows;
	}

	public function supervisor_getEncuestas($tecnicos) {
		$rows = array();
		$rows['promedio'] = 0;
		if ( is_array($tecnicos) && count($tecnicos) ) {
			foreach ( $tecnicos as $tid => $tecnico ) {
				$this->db->select_avg('respuesta');
				$this->db->from('encuestas e');
				$this->db->join('solicitudestecnicos st', 'st.sid = e.sid', 'left');
				$this->db->join('solicitudes s', 's.id = e.sid', 'left');
				$this->db->where('s.estadoid', 2);
				$where = "(st.t1id = $tid OR st.t2id = $tid)";
				$this->db->where($where);
				$promedio = $this->db->get()->row()->respuesta;
				$rows['promedio'] += $promedio;
				$rows['tecnicos'][] = array('nombres' => $tecnico, 'promedio' => $promedio);
			}
			$rows['promedio'] = $rows['promedio'] / ( count($rows['tecnicos']) - 1 ); 
		}
		return $rows;
	}

}