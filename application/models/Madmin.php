<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Madmin extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function admin_login($formdata) {
		$user = $formdata->user;
		$pass = $formdata->pass;
		$data = array();
		$query = $this->db->query("SELECT id, rolid FROM usuarios WHERE user = '$user' AND password = '$pass' AND publish = 1;");

		if ( $query->result() ) {
			foreach ( $query->result() as $row ) {
				$data['id'] = $row->id;
				$data['rolid'] = $row->rolid;
			}
			return (object)$data;
		}
		else
			return false;
	}

	public function tecnicos_login($dni) {
		return $this->db->get_where('tecnicos', array('dni' => $dni))->row();
	}

}