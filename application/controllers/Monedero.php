<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monedero extends CI_Controller {

	
	 public function __construct()
   {
           parent::__construct();
		   $this->load->library('billetera');		   
		   $this->load->model('mtecnicos');
   }

	 public function index()
	 {
	 	date_default_timezone_set('America/Lima');
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'monedero' ));
		$fecha = $this->input->get('fecha');
	    $data['tecnicos'] = $this->mtecnicos->tecnicos_combo2();

   	  if (isset($_GET['dni']) && ( !empty($_GET['dni']) ) ) {
   	  		$dni=$_GET['dni'];
			$params=array('dni'=>$dni,'fecha'=>(!empty($fecha)? $fecha:false));
			$resumen=$this->billetera->getresumen($params);
			$detalle=$this->billetera->getdetalle_comision($params);						
			$data['dni'] = $dni;			
			$data['resumen'] = $resumen;
			$data['detalle'] = $detalle;	
		}
	 $data['fecha'] = !empty($fecha)? $fecha:date('Y-m-d');	 
	 $this->load->view('admin/monedero_view', $data);
	 }

	}