<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		securityAccess(array(1));
		//$this->load->model('mreportes');
	}

	public function index() {
		var_dump('hola');
	}

}