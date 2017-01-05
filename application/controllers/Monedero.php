<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monedero extends CI_Controller {

	
	 public function __construct()
   {
           parent::__construct();
		   $this->load->library('billetera');		   
   }

	 public function index()
	 {
	 	date_default_timezone_set('America/Lima');
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'monedero' ));
		$fecha = $this->input->get('fecha');

   	  if (isset($_GET['dni']) && ( !empty($_GET['dni']) ) ) {
			$params=array('dni'=>$dni,'fecha'=>(!empty($fecha)? $fecha:false));
			$detalle=$this->billetera->getresumen($params);
			$this->billetera->getdetalle_comision($params);			
			$fecha=strftime("%A %d de %B del %Y");
			$data['resumen'] = $resumen;
			$data['detalle'] = $detalle;	
		}
	 $data['date'] = $fecha;			
	 $this->load->view('admin/monedero_view', $data);
	 }

	}