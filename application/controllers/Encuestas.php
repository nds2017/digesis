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
			if ( $tid ) {
				$data['nuevos'] = $this->msolicitudes->solicitudes_encuestas($tid, 1);
				$data['atendidos'] = $this->msolicitudes->solicitudes_encuestas($tid, 2);
				$data['pendientes'] = $this->msolicitudes->solicitudes_encuestas($tid, 3);
				$data['reprogramados'] = $this->msolicitudes->solicitudes_encuestas($tid, 4);
				$data['rechazados'] = $this->msolicitudes->solicitudes_encuestas($tid, 5);
				$data['sinfotos'] = $this->msolicitudes->solicitudesrf_encuestas($tid);
				$data['estados'] = $this->msolicitudes->estados_entrys();

				$data['mreprogramados'] = $this->msolicitudes->motivos_entrys(4);
				$data['mpendientes'] = $this->msolicitudes->motivos_entrys(3);
				$data['mrechazados'] = $this->msolicitudes->motivos_entrys(5);
				$this->load->view('list-solicitudes', $data);
			}
			else
				redirect('welcome');
		}
		else
			redirect('welcome');
	}

	public function preguntas($sid = null) {
		$data = array();
		$preguntas = $this->mencuestas->encuestas_preguntas();
		if ( isset($sid) && !empty($sid) ) {
			if ( isset($_POST['npregunta']) && isset($_POST['respuesta']) ) {
				$form = array(
					'sid' => $sid,
					'preguntaid' => $_POST['npregunta'],
					'respuesta' => $_POST['respuesta']
				);
				$this->mencuestas->encuestas_setresultados($form);
				$npregunta = $_POST['npregunta'] + 1;
				$data['npregunta'] = (object)array('n' => $npregunta, 'pregunta' => $preguntas[$npregunta]);
				if ( $npregunta > count($preguntas) ) {
					$form = array(
						'id' => $sid,
						'estadoid' => 2
					);
					$this->msolicitudes->solicitudes_update($form, $sid);
					redirect('encuestas/gracias');
				}
			}
			else
				$data['npregunta'] = (object)array('n' => 1, 'pregunta' => $preguntas[1]);

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

	public function indicaciones($sid = null) {
		if ( isset($sid) && !empty($sid) ) {
			$data['sid'] = $sid;
			$this->load->view('indicaciones', $data);
		}
		else
			redirect('welcome');
	}

}