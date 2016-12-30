<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuestas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('msolicitudes');
		$this->load->model('mencuestas');
		$this->load->library('billetera');
	}

	public function index() {
		if ( isset($_GET['dni']) && ( !empty($_GET['dni']) ) ) {
			$this->load->model('mtecnicos');
			$datat = $this->mtecnicos->tecnicobyDNI($_GET['dni']);
			if ( is_object($datat) ) {
				$tid = $datat->id;
				//$data['nuevos'] = $this->msolicitudes->solicitudes_encuestas($tid, 1, true);
				$data['atendidos'] = $this->msolicitudes->solicitudes_encuestas($tid, 2, true);				
				$data['pendientes'] = $this->msolicitudes->solicitudes_encuestas($tid, 3);
				$data['reprogramados'] = $this->msolicitudes->solicitudes_encuestas($tid, 4, true);
				$data['rechazados'] = $this->msolicitudes->solicitudes_encuestas($tid, 5, true);
				$data['sinfotos'] = $this->msolicitudes->solicitudesrf_encuestas($tid);
				$data['estados'] = $this->msolicitudes->estados_entrys();

				$data['mreprogramados'] = $this->msolicitudes->motivos_entrys(4);
				$data['mpendientes'] = $this->msolicitudes->motivos_entrys(3);
				$data['mrechazados'] = $this->msolicitudes->motivos_entrys(5);

				$data['tecnico'] = $datat->nombres;
				$monto=$this->billetera_resumen($_GET['dni']);
				var_dump($monto);
				//$data['resumen_billetera']=$monto;
				$this->load->view('list-solicitudes', $data);
			}
			else
				redirect('welcome');
		}
		else
			redirect('welcome');
	}

	public function billetera_resumen($dni=null){
			$params=array('dni'=>$dni);
			return $this->billetera->getresumen($params);

	}
	public function pendiente() {
		if ( isset($_POST) && count($_POST) ) {
			$form = array('id' => $_POST['sid'], 'motivoid' => $_POST['motivoid'], 'estadoid' => 3);
			$this->msolicitudes->solicitudes_update($form, $_POST['sid']);
			echo json_encode(array('status' => true));
		}
		else
			redirect('welcome');
	}

	public function reprogramar() {
		if ( isset($_POST) && count($_POST) ) {
			if ( strtotime(date('Y-m-d')) < strtotime($_POST['fecha']) ) {
				$form = array('id' => $_POST['sid'], 'fecha_instalacion' => $_POST['fecha'], 'motivoid' => $_POST['motivoid'], 'estadoid' => 4);
				$this->msolicitudes->solicitudes_update($form, $_POST['sid']);
				echo json_encode(array('status' => true));
			}
			else
				echo json_encode(array('status' => false));
		}
		else
			redirect('welcome');

	}

	public function rechazar() {
		if ( isset($_POST) && count($_POST) ) {
			$form = array('id' => $_POST['sid'], 'motivoid' => $_POST['motivoid'], 'estadoid' => 5);
			$this->msolicitudes->solicitudes_update($form, $_POST['sid']);
			echo json_encode(array('status' => true));
				
		}
		else
			redirect('welcome');
	}

	public function denegar() {
		if ( isset($_POST) && count($_POST) ) {
			$form = array('id' => $_POST['sid'], 'estadoid' => 3);
			$this->msolicitudes->solicitudes_update($form, $_POST['sid']);
			echo json_encode(array('status' => true));	
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
					redirect('encuestas/gracias/' . $sid . '?dni=' . $_GET['dni']);
				}
			}
			else
				$data['npregunta'] = (object)array('n' => 1, 'pregunta' => $preguntas[1]);

			$this->load->view('preguntas', $data);
		}
		else
			redirect('welcome');
	}

	public function gracias($sid = null) {
		if ( isset($sid) && !empty($sid) )
			$this->load->view('gracias');
		else
			redirect('welcome');
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