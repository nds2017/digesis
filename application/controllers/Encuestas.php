<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('msolicitudes');
	}

	public function index() {
		if ( isset($_GET['dni']) && (!empty($_GET['dni'])) ) {
			$this->load->model('mtecnicos');
			$tid = $this->mtecnicos->tecnicobyDNI($_GET['dni']);
			$data['nuevos'] = $this->msolicitudes->solicitudes_encuestas($tid, 1);
			$data['atendidos'] = $this->msolicitudes->solicitudes_encuestas($tid, 2);
			$data['pendientes'] = $this->msolicitudes->solicitudes_encuestas($tid, 3);
			$data['reprogramados'] = $this->msolicitudes->solicitudes_encuestas($tid, 4);
			$data['rechazados'] = $this->msolicitudes->solicitudes_encuestas($tid, 5);
			$data['sinfotos'] = @array_merge($this->msolicitudes->solicitudesrf_encuestas($tid, 1), $this->msolicitudes->solicitudesrf_encuestas($tid, 2));
			$this->load->view('list-solicitudes', $data);
		}
		else
			redirect('welcome');
	}

	public function preguntas($npregunta) {
		$this->load->view('preguntas');
	}

	public function preguntafinal() {
		$this->load->view('preguntas-final');
	}

	public function gracias() {
		$this->load->view('gracias');
	}

	public function listaencuestas() {
		$this->load->view('list-solicitudes');
	}

	public function indicaciones() {
		$this->load->view('indicaciones');
	}

}