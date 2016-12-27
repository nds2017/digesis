<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mcostosot extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

	public function getSotByType($id_tipo=null,$num=null){		
	     $query = $this->db->get_where('monto_sot', array('tipo_id' => $id_tipo,'nsot'=>$num));
	     return $query->result();
	}


}