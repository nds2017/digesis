<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		securityAccess(array(1));
		$this->load->model('mreportes');
		$this->load->model('mtecnicos');
		$this->load->model('msupervisores');
		$this->load->model('mjefes');
	}

	public function index() {
		var_dump('hola');
	}

	public function encuestas() {
		$data['supervisores'] = $this->msupervisores->supervisores_combo();
		$data['tecnicos'] = $this->mtecnicos->tecnicos_combo();
		$data['jefes'] = $this->mjefes->jefes_combo();

		$data['data'] = $this->mreportes->jefes_getEncuestas($data['jefes']);

		$this->load->view('admin/reportes/encuestas', $data);
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
			$tecnicos = $this->mtecnicos->tecnicos_bySupervisor($supid);
			$data = $this->mreportes->supervisor_getEncuestas($tecnicos, $supid);
			print '<pre>';
			print_r($data);
			print '</pre>';
			//$this->load->view('admin/reportes/tecnico_encuestas', $data);
		}
		else
			redirect('reportes');	
	}

	public function jefe_encuestas($jefeid = null) {
		$rows = array();
		$rows['promedio'] = 0;
		if ( is_numeric($jefeid) && ( $jefeid != 0 ) ) {
			$supervisores = $this->msupervisores->supervisores_combo($jefeid);
			$data = $this->mreportes->jefe_getEncuestas($supervisores, $jefeid);
			print '<pre>';
			print_r($data);
			print '</pre>';
			//$this->load->view('admin/reportes/tecnico_encuestas', $data);
		}
		else
			redirect('reportes');	
	}

}