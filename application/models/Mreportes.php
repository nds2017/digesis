<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mreportes extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('msupervisores');
		$this->load->model('mtecnicos');
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
				if ( $row->promedio ) {
					$row->promedio = number_format($row->promedio, 2);
					$rows['promedio'] += $row->promedio;
					$rows['solicitudes'][] = $row;
				}
			}
			$rows['promedio'] = $rows['promedio'] / (count($rows['solicitudes']));
			$rows['id'] = $tid;
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

	public function supervisor_getEncuestas($tecnicos, $supid) {
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
				if ( @$promedio ) {
					$promedio = number_format($promedio, 2);
					$rows['promedio'] += $promedio;
					$rows['tecnicos'][$tid] = array('id' => $tid, 'nombres' => $tecnico, 'promedio' => $promedio);
				}
			}
			if ( isset($rows['tecnicos']) && count($rows['tecnicos']) ) {
				$rows['promedio'] = $rows['promedio'] / (count($rows['tecnicos'])); 
				$rows['id'] = $supid;
			}
		}
		return $rows;
	}

	public function jefe_getEncuestas($supervisores, $jefeid) {
		$rows = array();
		$rows['promedio'] = 0;
		if ( is_array($supervisores) && count($supervisores) ) {
			foreach ( $supervisores as $id => $supervisor ) {
				$tecnicos = $this->mtecnicos->tecnicos_bySupervisor($id);
				if ( count($tecnicos) ) {
					$data_sup = $this->mreportes->supervisor_getEncuestas($tecnicos, $id);
					if ( isset($data_sup['tecnicos']) && count($data_sup['tecnicos']) ) {
						$rows['promedio'] += $data_sup['promedio'];
						$rows['supervisores'][$id] = $data_sup;
					}
				}
			}
			if ( isset($rows['supervisores']) && count($rows['supervisores']) ) {
				$rows['promedio'] = $rows['promedio'] / (count($rows['supervisores']));
				$rows['id'] = $jefeid;
			}
		}
		return $rows;
	}

	public function jefes_getEncuestas($jefes) {
		$rows = array();
		if ( is_array($jefes) && count($jefes) ) {
			foreach ( $jefes as $id => $jefe ) {
				$supervisores = $this->msupervisores->supervisores_combo($id);
				if ( count($supervisores) )
					$rows[$id] = $this->mreportes->jefe_getEncuestas($supervisores, $id);
			}
		}
		return $rows;
	}


	public function solicitudes_estadosbySupervisor($supid = null, $estado = null) {

	}

	public function jefes_getTotalSolicitudes($supervisores) {
		$rows = array();
		$rows['totalprogramadas'] = $rows['totaladicionales'] = $rows['totalsolicitudes'] = 0;
		$rows['totalsinestado'] = $rows['totalreprogramados'] = $rows['totalrechazados'] = $rows['totalvalidados'] = $rows['totalpendientes'] = 0;
		foreach ( $supervisores as $rkey => $sup ) {
			$this->db->select('COUNT(st.sid) AS cantidad, s.upload');
			$this->db->from('solicitudestecnicos st');
			$this->db->join('solicitudes s', 'st.sid = s.id', 'left');
			$this->db->where('st.supid', $sup->id);
			$this->db->group_by("s.upload");
			$query = $this->db->get();
			if ( $query->num_rows() > 0 ) {
				$rows['bases'][$sup->baseid][$sup->id]['adicional'] = $rows['bases'][$sup->baseid][$sup->id]['programadas'] = 0;
				foreach ( $query->result() as $key => $row ) {
					if ( $row->upload == 1 ) {
						$rows['bases'][$sup->baseid][$sup->id]['programadas'] = $row->cantidad;
						$rows['totalprogramadas'] += $row->cantidad;
					}
					else if ( $row->upload == 0 ) {
						$rows['bases'][$sup->baseid][$sup->id]['adicional'] = $row->cantidad;
						$rows['totaladicionales'] += $row->cantidad;
					}
					$rows['totalsolicitudes'] += $row->cantidad;
				}
				$rows['bases'][$sup->baseid][$sup->id]['nombre'] = $sup->nombres . ' ' . $sup->apellidos;
			}

			$this->db->select('COUNT(st.sid) AS cantidad, s.estadoid');
			$this->db->from('solicitudestecnicos st');
			$this->db->join('solicitudes s', 'st.sid = s.id', 'left');
			$this->db->where('st.supid', $sup->id);
			$this->db->group_by("s.estadoid");
			$query = $this->db->get();
			if ( $query->num_rows() > 0 ) {
				$rows['bases'][$sup->baseid][$sup->id]['sinestado'] = $rows['bases'][$sup->baseid][$sup->id]['validados'] = $rows['bases'][$sup->baseid][$sup->id]['pendientes'] = $rows['bases'][$sup->baseid][$sup->id]['reprogramados'] = $rows['bases'][$sup->baseid][$sup->id]['rechazados'] = 0;
				foreach ( $query->result() as $key => $row ) {
					if ( $row->estadoid == 1 ) {
						$rows['bases'][$sup->baseid][$sup->id]['sinestado'] = $row->cantidad;
						$rows['totalsinestado'] += $row->cantidad;
					}
					else if ( $row->upload == 2 ) {
						$rows['bases'][$sup->baseid][$sup->id]['validados'] = $row->cantidad;
						$rows['totalvalidados'] += $row->cantidad;
					}
					else if ( $row->upload == 3 ) {
						$rows['bases'][$sup->baseid][$sup->id]['pendientes'] = $row->cantidad;
						$rows['totalpendientes'] += $row->cantidad;
					}
					else if ( $row->upload == 4 ) {
						$rows['bases'][$sup->baseid][$sup->id]['reprogramados'] = $row->cantidad;
						$rows['totalreprogramados'] += $row->cantidad;
					}
					else if ( $row->upload == 5 ) {
						$rows['bases'][$sup->baseid][$sup->id]['rechazados'] = $row->cantidad;
						$rows['totalrechazados'] += $row->cantidad;
					}
				}
			}


		}
		return $rows;
	}

	public function jefes_getEficiencia($jefes) {
		$rows = array();
		foreach ( $jefes as $id => $jefe ) {
			$supervisores = $this->msupervisores->supervisores_byJefe($id);
			if ( count($supervisores) ) {
				$rows[$id] = $this->mreportes->jefes_getTotalSolicitudes($supervisores);
			}
		}
		var_dump($rows); die();
	}

}