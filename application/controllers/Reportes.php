<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		securityAccess(array(1));
		$this->load->model('mreportes');
	}

	public function index() {
		var_dump('hola');
	}

	public function tecnico_encuestas($tid = null) {
		if ( is_numeric($tid) && ( $tid != 0 ) ) {
			$data = $this->mreportes->tecnico_getEncuestas($tid);
			//$this->load->view('admin/reportes/tecnico_encuestas', $data);
		}
		redirect('reportes'):
	}

}