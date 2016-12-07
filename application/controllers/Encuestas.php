<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('msolicitudes');
		$this->load->model('mencuestas');
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
			$data['sinfotos'] = $this->msolicitudes->solicitudesrf_encuestas($tid);
			$this->load->view('list-solicitudes', $data);
		}
		else
			redirect('welcome');
	}

	public function preguntas($sid = null) {
		$data = array();
		$preguntas = $this->mencuestas->encuestas_preguntas();
		if ( isset($sid) && !empty($sid) ) {
			if ( isset($_POST['npregunta']) && isset($_POST['respuesta']) ) {
				$npregunta = $_POST['npregunta'] + 1;
				$data['npregunta'] = (object)array('n' => $npregunta, 'pregunta' => $preguntas[$npregunta]);
				if ( $npregunta > count($preguntas) )
					redirect('encuestas/gracias');
			}
			else {
				$data['npregunta'] = (object)array('n' => 1, 'pregunta' => $preguntas[1]);
			}
			$this->load->view('preguntas', $data);
		}
		else
			redirect('welcome');
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