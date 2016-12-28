<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		securityAccess(array(1));
		$this->load->model('mreportes');
		$this->load->model('mtecnicos');
		$this->load->model('msupervisores');
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
			$tecnicos = $this->mtecnicos->tecnicos_bySupervisor($supid);
			$data = $this->mreportes->supervisor_getEncuestas($tecnicos);
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
		if ( is_numeric($jefeid) && ( $jefeid != 0 ) ) {
			$supervisores = $this->msupervisores->supervisores_combo($jefeid);
			foreach ( $supervisores as $id => $supervisor ) {
				$tecnicos = $this->mtecnicos->tecnicos_bySupervisor($supid);
				$data_sup = $this->mreportes->supervisor_getEncuestas($tecnicos);
				$rows['supervisores'][] = $data_sup;
			}
			print '<pre>';
			print_r($rows);
			print '</pre>';
			//$this->load->view('admin/reportes/tecnico_encuestas', $data);
		}
		else
			redirect('reportes');	
	}

}