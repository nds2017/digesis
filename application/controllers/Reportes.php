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
			print '<pre>';
			print_r($data);
			print '</pre>';
			//$this->load->view('admin/reportes/tecnico_encuestas', $data);
		}
		else
			redirect('reportes');
	}

	public function supervisor_encuestas($supid = null) {
		if ( is_numeric($supid) && ( $supid != 0 ) ) {
			$data = $this->mreportes->supervisor_getEncuestas($supid);
			print '<pre>';
			print_r($data);
			print '</pre>';
			//$this->load->view('admin/reportes/tecnico_encuestas', $data);
		}
		else
			redirect('reportes');	
	}

}