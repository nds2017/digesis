<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mencuestas extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function encuestas_getPregunta($preguntaid = false) {
		$query = $this->db->query("SELECT dptoid FROM provincias WHERE id = $preguntaid");
		foreach ( $query->result() as $row ) {
			return $row->dptoid;
		}
	}

}