<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mtecnicos extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function tecnicos_entrys($id = false, $publish = 1, $bnombres = '') {
		if ( $id === false ) {
			$this->db->select('t.*, CONCAT(s.nombres, " ", s.apellidos) AS snombre, b.nombre AS bnombre');
			$this->db->from('tecnicos t');
			$this->db->join('supervisores s', 's.id = t.supervisorid', 'left');
			$this->db->join('bases b', 'b.id = t.baseid', 'left');
			if ( !empty($bnombres) )
				$this->db->where('CONCAT(t.nombres, " ", t.apellidos) LIKE "%' . $bnombres . '%"', NULL, FALSE);
			$this->db->where('t.publish', $publish);
			$this->db->order_by("t.id", "desc");
		}
		else {
			$this->db->select('c.*');
			$this->db->from('tecnicos c');
			$this->db->where('c.id', $id);
		}
		$query = $this->db->get();
		if ( $query->num_rows() > 0 )
			return $query->result();
	}

	public function tecnicobyDNI($dni) {
		$query = $this->db->query("SELECT id, nombres FROM tecnicos WHERE dni = '$dni' AND publish = 1");
		if ( $query->row()->id )
			return $query->row();
		return null;
	}

	public function tecnicos_byCargo($cargo = 1, $supid = null) {
		$rows = array();
		$this->db->select('id, CONCAT(nombres, ' ', apellidos) AS tnombres');
		$this->db->from('tecnicos');

		if ( is_numeric($supid) && ( $supid != 0 ) )
			$this->db->where('supervisorid', $supid);

		$this->db->where('cargo', $cargo);
		$this->db->where('publish', 1);


		foreach ( $query->result() as $key => $row ) {
			$rows[$row->id] = $row->tnombres;
		}
		return $rows;
	}

	public function tecnicos_bySupervisor($supervisorid = 0, $cargo = 1) {
		$rows = array();
		$query = $this->db->query("SELECT id, CONCAT(nombres, ' ', apellidos) AS tnombres FROM tecnicos WHERE cargo = $cargo AND publish = 1 AND supervisorid = $supervisorid");
		foreach ($query->result() as $key=>$row) {
			$rows[$row->id] = @$row->tnombres;
		}
		return $rows;
	}

	public function tecnicos_total() {
		$query = $this->db->query("SELECT COUNT(id) AS cantidad FROM tecnicos");
		return $query->row(0);
	}
	
	public function tecnicos_create($data) {
		$this->db->insert('tecnicos', $data);
	}
   
	public function tecnicos_delete($id) {
		$this->db->where('id', $id);
		$this->db->update('tecnicos', array('publish' => 0));
	}

	public function tecnicos_update($data) {
		$this->db->where('id', $data['id']);
		$this->db->update('tecnicos', $data);
	}
}