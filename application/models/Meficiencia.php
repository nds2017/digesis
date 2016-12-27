<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Meficiencia extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

	public function geteficiencia(){		
	     $query = $this->db->where('eficiencia');
	     return $query->result();
	}

	
}