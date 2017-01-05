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
		redirect('reportes/encuestas');
	}

	public function eficiencia() {
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'eficiencia' ));
		$data['jefes'] = $this->mjefes->jefes_combo();
		$data['supervisores'] = $this->msupervisores->supervisores_combo();

		$data['data'] = $this->mreportes->jefes_getEficiencia($data['jefes']);
		$this->load->view('admin/reportes/eficiencia', $data);$this
	}

	public function encuestas() {
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'encuestas' ));
		$data['jefes'] = $this->mjefes->jefes_combo();
		$data['supervisores'] = $this->msupervisores->supervisores_combo();
		$data['tecnicos'] = $this->mtecnicos->tecnicos_combo();
		$data['data'] = $this->mreportes->jefes_getEncuestas($data['jefes']);
		$this->load->view('admin/reportes/encuestas', $data);
	}

	public function tecnico_encuestas($tid = null) {
		if ( is_numeric($tid) && ( $tid != 0 ) ) {
			$data['header'] = $this->load->view('admin/menu/header', array('active' => 'encuestas' ));
			$data['data'] = $this->mreportes->tecnico_getEncuestas($tid);
			$data['tecnicos'] = $this->mtecnicos->tecnicos_combo();
			$data['tid'] = $tid;
			$this->load->view('admin/reportes/tecnico_encuestas', $data);
		}
		else
			redirect('reportes');
	}

	public function supervisor_encuestas($supid = null) {
		if ( is_numeric($supid) && ( $supid != 0 ) ) {
			$data['header'] = $this->load->view('admin/menu/header', array('active' => 'encuestas' ));
			$data['supervisores'] = $this->msupervisores->supervisores_combo();
			$data['tecnicos'] = $this->mtecnicos->tecnicos_combo();
			$data['supid'] = $supid;
			$tecnicos = $this->mtecnicos->tecnicos_bySupervisor($supid);
			$data['data'] = $this->mreportes->supervisor_getEncuestas($tecnicos, $supid);
			$this->load->view('admin/reportes/supervisor_encuestas', $data);
		}
		else
			redirect('reportes');	
	}

	public function jefe_encuestas($jefeid = null) {
		if ( is_numeric($jefeid) && ( $jefeid != 0 ) ) {
			$data['header'] = $this->load->view('admin/menu/header', array('active' => 'encuestas' ));
			$data['jefes'] = $this->mjefes->jefes_combo();
			$data['supervisores'] = $this->msupervisores->supervisores_combo();
			$supervisores = $this->msupervisores->supervisores_combo($jefeid);
			$data['data'] = $this->mreportes->jefe_getEncuestas($supervisores, $jefeid);
			$data['jefeid'] = $jefeid;
			$this->load->view('admin/reportes/jefe_encuestas', $data);
		}
		else
			redirect('reportes');	
	}

}