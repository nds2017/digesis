<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asistencia extends CI_Controller {

	
	 public function __construct()
   {
           parent::__construct();
					 $this->load->model('masistencia');
   }

	 public function index()
	 {
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'perfiles' ));

		 $fecha 					= date('Y-m-d');
		 $data['result'] 	= $this->masistencia->get_records($fecha);
		 $data['date'] 		= $fecha;
		  echo '<pre>';
		  var_dump($data['result']);
		  echo '</pre>';
		 $this->load->view('admin/asistencia_view', $data);
	 }

	 public function grabar()
	 {
		 $data = $this->input->post('data');
		 parse_str($data, $output);
		 $datar['result'] = $this->masistencia->set_records($output);
		 echo json_encode($datar);
   }

	 public function buscar($fecha = null)
	 {
		 if($fecha == null){
			 $fecha = date('Y-m-d');
		 }

		//  echo '<pre>';
	 	// 	var_dump($fecha);
	 	// 	echo '</pre>';
	 	// 	die();

		$data['result'] 	= $this->masistencia->get_records($fecha);
		$data['date'] 		= $fecha;
		//  echo '<pre>';
		//  var_dump($data['result']);
		//  echo '</pre>';
		//  die();
		$output['result'] = $this->load->view('lista_view', $data, TRUE);
		echo json_encode($output);
  }
}
