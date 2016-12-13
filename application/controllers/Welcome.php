<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('madmin');
	}

	public function index() {
		if ( isset($_GET['dni']) && !empty($_GET['dni']) && ( $_GET['dni'] != 'DNI' ) ) {
			if ( $this->madmin->tecnicos_login($_GET['dni']) )
				redirect('encuestas?dni=' . $_GET['dni']);
			else
				$this->load->view('index', array('error' => 1));
		}
		else
			$this->load->view('index');
	}

}