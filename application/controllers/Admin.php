<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('madmin');
	}

	public function index() {
		if ( is_logged_in() ) 
			redirectUser();
		else
			$this->load->view('admin/login');
	}

	public function errorlogin() {
		if ( is_logged_in() ) 
			redirect('solicitudes');
		else {
			$data['error'] = 1;
			$this->load->view('admin/login', $data);
		}
	}

	public function olvidoclave() {
		if ( is_logged_in() ) 
			redirectUser();
		else {
			$this->load->view('admin/olvidoclave');
		}
	}

	public function set_session() {
		$formdata = (object)array('user' =>  $this->input->post('session_value'), 'pass' =>  $this->input->post('session_pass'));
		$session = $this->madmin->admin_login($formdata);
		if ( $session ) {
			$sess_array = array(
				'set_user' => $this->input->post('session_value'),
				'set_rol' => $session->rolid,
				'set_id' => $session->id
			);
			$this->session->set_userdata('session_data', $sess_array);
			redirectUser();
		}
		else
			redirect('admin/errorlogin');
	}

	public function unset_session() {
		$sess_array = array('set_value' => '');
		$this->session->unset_userdata('session_data', $sess_array);
		redirect('admin');
	}

	public function erroraccess() {
		$this->load->view('errors/html/error_404');
	}
}