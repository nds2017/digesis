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

	public function errorlogin($user = null) {
		if ( is_logged_in() ) 
			redirect('solicitudes');
		else {
			$data['inactivo'] = $this->madmin->admin_inactivo($user) ? $this->madmin->admin_inactivo($user) : 0;
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

	public function validateEmail() {
		$user = $this->madmin->admin_email($_POST['search']);
		if ( $user ) {
			/*$cadena = $user->id . $user->user . rand(1,9999999) . date('Y-m-d');
			$token = sha1($cadena);
			$data = array(
				'userid' => $user->id,
				'username' => $user->user,
				'token' => $token,
				'fecha' => strtotime("now")
			);
			$this->madmin->generarLink($data);
			$enlace = base_url() . 'index.php/admin/restablecer?idusuario=' . sha1($user->id) . '&token=' . $token;

$mensaje = '<html>
     <head>
        <title>Restablece tu contraseña</title>
     </head>
     <body>
       <p>Hemos recibido una petición para restablecer la contraseña de tu cuenta.</p>
       <p>Si hiciste esta petición, haz clic en el siguiente enlace, si no hiciste esta petición puedes ignorar este correo.</p>
       <p>
         <strong>Enlace para restablecer tu contraseña</strong><br>
         <a href="'.$enlace.'"> Restablecer contraseña </a>
       </p>
     </body>
    </html>';
 
   $cabeceras = 'MIME-Version: 1.0' . "\r\n";
   $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
   $cabeceras .= 'From: Digetel <digetelservicio@digetel.pe>' . "\r\n";
   var_dump(mail($_POST['search'], "Recuperar contraseña", $mensaje, $cabeceras));

			echo '¡Revisa Tu Correo!';*/
			$ci = get_instance();
$ci->load->library('email');
$config['protocol'] = "smtp";
$config['smtp_host'] = "ssl://smtp.gmail.com";
$config['smtp_port'] = "465";
$config['smtp_user'] = "digesis2017@gmail.com"; 
$config['smtp_pass'] = "Digesis2017@";
$config['charset'] = "utf-8";
$config['mailtype'] = "html";
$config['newline'] = "\r\n";

$ci->email->initialize($config);

$ci->email->from('fk.franko.soto@gmail.com', 'Restablecer Contraseña - Digitel');
$list = array('fk.franko.soto@gmail.com');
$ci->email->to($list);
$this->email->reply_to('digesis2017@gmail.com', 'Digetel Service');
$ci->email->subject('Restablecer Contraseña');
$ci->email->message('It is working. Great!');
var_dump($ci->email->send());
			echo '¡Revisa Tu Correo!';
		}
		else
			echo 'Correo Inválido';
	}

	public function set_session() {
		$user = $this->input->post('session_value');
		$formdata = (object)array('user' => $user, 'pass' => $this->input->post('session_pass'));
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
			redirect('admin/errorlogin/' . $user);
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