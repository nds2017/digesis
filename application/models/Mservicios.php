<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mservicios extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdepartamentos');
	}


	public function insert($data=array()){
		$this->db->insert('servicios', $data);
	}

	public function get(){
	$this->db->select('s.*');
	$this->db->from('servicios s');	
	$query = $this->db->get();
	if ( $query->num_rows() > 0 )
		return $query->result();
	}

}
