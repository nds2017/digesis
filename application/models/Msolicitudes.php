<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Msolicitudes extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdepartamentos');
	}

	public function solicitudes_entrys($estadoid = false, $distritoid = false, $solicitudid = '') {
		$this->db->select('s.*, ts.nombre AS tsnombre, dist.nombre AS distrito, dpto.nombre AS dpto, e.nombre AS enombre');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('estados e', 'e.id = s.estadoid', 'left');
		$this->db->join('distritos dist', 'dist.id = s.distritoid', 'left');
		$this->db->join('provincias prov', 'prov.id = dist.provinciaid', 'left');
		$this->db->join('departamentos dpto', 'dpto.id = prov.dptoid', 'left');
		if ( is_numeric($estadoid) && ( $estadoid != 0 ) )
			$this->db->where('s.estadoid', $estadoid);
		if ( is_numeric($distritoid) && ( $distritoid != 0 ) )
			$this->db->where('s.distritoid', $distritoid);
		if ( !empty($solicitudid) )
			$this->db->where('s.id LIKE "%' . $solicitudid . '%"', NULL, FALSE);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result();
		}
	}

	public function solicitudes_encuestas($tid = false, $estado = false) {
		$rows = array();
		$this->db->select('s.*, ts.nombre AS tsnombre, e.nombre AS enombre');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('solicitudestecnicos st', 'st.sid = s.id', 'left');
		$this->db->join('estados e', 'e.id = s.estadoid', 'left');
		if ( is_numeric($estado) && ( $estado != 0 ) )
			$this->db->where('s.estadoid', $estado);
		if ( is_numeric($tid) && ( $tid != 0 ) ) {
			$where = "(st.t1id = $tid OR st.t2id = $tid)";
			$this->db->where($where);
		}
		$this->db->order_by("s.fecha_instalacion");
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			foreach ( $query->result() as $key => $row ) {
				$rows[$row->id] = $row;
			}
		}
		return $rows;
	}

	public function solicitudes_cantidades() {
		$rows = array();
		$total = 0;
		$query = $this->db->query("SELECT estadoid, COUNT(id) AS cantidad FROM solicitudes GROUP BY estadoid");
		foreach ( $query->result() as $key => $row ) {
			$total += $row->cantidad;
			$rows[$row->estadoid] = $row->cantidad;
		}
		$rows[0] = $total;
		return $rows;
	}

	public function solicitudesrf_cantidades() {
		$rows = array();
		$total = 0;
		$query = $this->db->query("SELECT rf, COUNT(id) AS cantidad FROM solicitudes GROUP BY rf");
		foreach ( $query->result() as $key => $row ) {
			$total += $row->cantidad;
			$rows[$row->rf] = $row->cantidad;
		}
		$rows[0] = $total;
		return $rows;
	}

	public function solicitudestecnicos_entrys($distritoid = false, $solicitudid = '') {
		$this->db->select('s.*, st.t1id, st.t2id, ts.nombre AS tsnombre, dist.nombre AS distrito, dpto.nombre AS dpto, e.nombre AS enombre');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('solicitudestecnicos st', 'st.sid = s.id', 'left');
		$this->db->join('estados e', 'e.id = s.estadoid', 'left');
		$this->db->join('distritos dist', 'dist.id = s.distritoid', 'left');
		$this->db->join('provincias prov', 'prov.id = dist.provinciaid', 'left');
		$this->db->join('departamentos dpto', 'dpto.id = prov.dptoid', 'left');
		$this->db->where('s.estadoid !=', 2);
		$this->db->where('s.estadoid !=', 3);
		$this->db->where('s.estadoid !=', 5);
		$where = "(st.t1id = 0 OR st.t2id = 0)";
		$this->db->where($where);

		if ( is_numeric($distritoid) && ( $distritoid != 0 ) )
			$this->db->where('s.distritoid', $distritoid);
		if ( !empty($solicitudid) )
			$this->db->where('s.id LIKE "%' . $solicitudid . '%"', NULL, FALSE);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result();
		}
	}


	public function solicitudesvalidadas_entrys($distritoid = false, $solicitudid = '', $today = false) {
		$rows = array();
		$this->db->select('s.*, ts.nombre AS tsnombre, dist.nombre AS distrito, dpto.nombre AS dpto');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('distritos dist', 'dist.id = s.distritoid', 'left');
		$this->db->join('provincias prov', 'prov.id = dist.provinciaid', 'left');
		$this->db->join('departamentos dpto', 'dpto.id = prov.dptoid', 'left');
		if ( !$today ) {
			if ( is_numeric($distritoid) && ( $distritoid != 0 ) )
				$this->db->where('s.distritoid', $distritoid);
			if ( !empty($solicitudid) )
				$this->db->where('s.id LIKE "%' . $solicitudid . '%"', NULL, FALSE);
		}
		else {
			$this->db->join('incidencias i', 'i.sid = s.id', 'inner');
			$this->db->where('i.fecha_incidencia', strtotime(date('d-m-Y')));
		}
		$this->db->where('s.estadoid', 2);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {

			foreach ( $query->result() as $key => $row ) {
				$row->incidencias = $this->msolicitudes->solicitudes_incidencias($row->id, TRUE);
				$rows[] = $row;
			}

		}
		return $rows;
	}

	public function solicitudesseguimiento_entrys($t1id = false, $t2id = false, $solicitudid = '') {
		$this->db->select('s.id, s.cliente, dist.nombre AS distrito, dpto.nombre AS dpto, ts.nombre AS tsnombre, e.nombre AS enombre');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('solicitudestecnicos st', 'st.sid = s.id', 'left');
		$this->db->join('estados e', 'e.id = s.estadoid', 'left');
		$this->db->join('distritos dist', 'dist.id = s.distritoid', 'left');
		$this->db->join('provincias prov', 'prov.id = dist.provinciaid', 'left');
		$this->db->join('departamentos dpto', 'dpto.id = prov.dptoid', 'left');
		$this->db->where('st.t1id', $t1id);
		$this->db->where('st.t2id', $t2id);

		if ( !empty($solicitudid) )
			$this->db->where('s.id LIKE "%' . $solicitudid . '%"', NULL, FALSE);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result();
		}
		else
			return array();
	}

	public function solicitudesgroupbytecnicos($solicitudid = '', $tecnicoid = false) {
		$rows = array();
		$this->db->select('t1id, t2id');
		$this->db->from('solicitudestecnicos s');
		$this->db->where('t1id !=', 0);
		$this->db->where('t2id !=', 0);
		//$this->db->where('aid =', $aid);

		if ( is_numeric($tecnicoid) && ( $tecnicoid != 0 ) )
			$this->db->where('t1id', $tecnicoid);

		$this->db->group_by("t1id");

		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			foreach ( $query->result() as $key => $row ) {
				$row->solicitudes = $this->msolicitudes->solicitudesseguimiento_entrys($row->t1id, $row->t2id, $solicitudid);
				$rows[] = $row;
			}
		}
		return $rows;
	}

	public function solicitudes_carga($id = '') {
		$this->db->select('s.*, ts.nombre AS tsnombre, dist.nombre AS distrito, dpto.nombre AS dpto');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('distritos dist', 'dist.id = s.distritoid', 'left');
		$this->db->join('provincias prov', 'prov.id = dist.provinciaid', 'left');
		$this->db->join('departamentos dpto', 'dpto.id = prov.dptoid', 'left');
		$this->db->where('s.estadoid', 1);
		if ( !empty($id) )
			$this->db->where('s.id LIKE "%' . $id . '%"', NULL, FALSE);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result();
		}
	}

	public function solicitudesrf_entrys($estadorfid = false, $distritoid = false, $solicitudid = '') {
		$this->db->select('s.*, ts.nombre AS tsnombre, dist.nombre AS distrito, dpto.nombre AS dpto, rf.nombre AS rfnombre');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('estadosrf rf', 'rf.id = s.rf', 'left');
		$this->db->join('distritos dist', 'dist.id = s.distritoid', 'left');
		$this->db->join('provincias prov', 'prov.id = dist.provinciaid', 'left');
		$this->db->join('departamentos dpto', 'dpto.id = prov.dptoid', 'left');
		
		if ( is_numeric($estadorfid) && ( $estadorfid != 0 ) )
			$this->db->where('s.rf', $estadorfid);
		if ( is_numeric($distritoid) && ( $distritoid != 0 ) )
			$this->db->where('s.distritoid', $distritoid);
		if ( strlen($solicitudid) )
			$this->db->where('s.id LIKE "%' . $solicitudid . '%"', NULL, FALSE);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result();
		}
	}

	public function solicitudesrf_encuestas($tid = false) {
		$this->db->select('s.*, ts.nombre AS tsnombre, rf.nombre AS rfnombre');
		$this->db->from('solicitudes s');
		$this->db->join('tiposervicios ts', 'ts.id = s.tiposervicioid', 'left');
		$this->db->join('solicitudestecnicos st', 'st.sid = s.id', 'left');
		$this->db->join('estadosrf rf', 'rf.id = s.rf', 'left');
		$this->db->where('s.estadoid', 2);
		$this->db->where_in('s.rf', array(1, 2));
		if ( is_numeric($tid) && ( $tid != 0 ) ) {
			$where = "(st.t1id = $tid OR st.t2id = $tid)";
			$this->db->where($where);
		}
		$this->db->order_by("s.fecha_instalacion");
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			return $query->result();
		}
	}

	public function solicitudes_byID($id) {
		$rows = array();
		$query = $this->db->query("SELECT s.*, st.* FROM solicitudes s LEFT JOIN solicitudestecnicos st ON st.sid = s.id WHERE id = '$id'");
		foreach ($query->result() as $key=>$row) {
			$row->provinciaid = $this->mdepartamentos->distrito_getProvincia($row->distritoid);
			$row->departamentoid = $this->mdepartamentos->provincia_getDpto($row->provinciaid);
			$rows[$key] = $row;
		}
		$rows = $rows[0];
		return $rows;
	}

	public function solicitudes_incidencias($sid, $count = false) {
		$rows = array();
		$query = $this->db->query("SELECT id, fecha_incidencia FROM incidencias WHERE sid = '$sid'");
		foreach ($query->result() as $key=>$row) {
			$rows[$key + 1] = $row->fecha_incidencia;
		}
		if ( $count )
			return count($rows);
		else
			return $rows;
	}

	public function tipostrabajo_entrys() {
		$rows = array();
		$query = $this->db->query("SELECT * FROM tipotrabajos");
		foreach ($query->result() as $key=>$row) {
			$rows[$row->id] = $row->nombre;
		}
		return $rows;
	}

	public function estados_entrys() {
		$rows = array();
		$query = $this->db->query("SELECT * FROM estados");
		foreach ($query->result() as $key=>$row) {
			$rows[$row->id] = $row->nombre;
		}
		return $rows;
	}

	public function estadosrf_entrys() {
		$rows = array();
		$query = $this->db->query("SELECT * FROM estadosrf");
		foreach ($query->result() as $key=>$row) {
			$rows[$row->id] = $row->nombre;
		}
		return $rows;
	}

	public function regiones_entrys() {
		$rows = array();
		$query = $this->db->query("SELECT * FROM regiones");
		foreach ($query->result() as $key=>$row) {
			$rows[$row->id] = $row->nombre;
		}
		return $rows;
	}

	public function tiposservicio_entrys() {
		$rows = array();
		$query = $this->db->query("SELECT * FROM tiposervicios");
		foreach ($query->result() as $key=>$row) {
			$rows[$row->id] = $row->nombre;
		}
		return $rows;
	}

	public function solicitudess_get_ndestacadas($provid) {
		$query = $this->db->query("SELECT ndestacadas FROM solicitudes WHERE id = $provid");
		foreach ($query->result() as $row) {
			return $row->ndestacadas;
		}
	}

	public function solicitudess_promo($id) {
		$rows = array();
		$this->db->select('pp.provid, p.nombre');
		$this->db->from('promociones_solicitudess pp');
		$this->db->join('solicitudes p', 'pp.provid = p.id', 'left');
		$this->db->where('pp.promoid', $id);
		$query = $this->db->get();
		if ( $query->num_rows() > 0 ) {
			foreach ( $query->result() as $row ) {
				 $rows[$row->provid] = $row->nombre;
			 }
		}
		return $rows;
	}

	public function solicitudes_update($data, $id) {
		$this->db->where('id', $id);
		$this->db->update('solicitudes', $data);
	}

	public function solicitudes_create($data) {
		$this->db->insert('solicitudes', $data);
	}

	public function solicitudes_addIncidencia($data) {
		$this->db->insert('incidencias', $data);
	}

	public function solicitudes_addtecnicos($data) {
		$this->db->replace('solicitudestecnicos', $data);
	}

	public function solicitudes_getTipoTrabajo($nombre = '') {
		if ( empty($nombre) )
			return 1;
		else {
			$query = $this->db->query("SELECT id FROM tipotrabajos WHERE nombre = '$nombre';");
			if ( $query->row('id') )
				return $query->row('id');
			else
				return 1;
		}
	}

	public function solicitudes_getTipoServicio($nombre = '') {
		if ( empty($nombre) )
			return 1;
		else {
			$query = $this->db->query("SELECT id FROM tiposervicios WHERE nombre = '$nombre';");
			if ( $query->row('id') )
				return $query->row('id');
			else
				return 1;
		}
	}

	public function solicitudes_replace($data) {
		$this->db->replace('solicitudes', $data);
		return $this->db->affected_rows();
	}

	public function solicitudes_delete($id) {
		$this->db->where('id', $id);
		$this->db->update('solicitudes', array('publish' => 0));
	}
}