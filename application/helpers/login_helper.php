<?php

	function is_logged_in() {
		$CI =& get_instance();
		$user = $CI->session->all_userdata();
		if ( isset($user['session_data']) && $user['session_data']['set_user'] != NULL )
			return true;
		else
			return false;
	}

	function get_session() {
		$CI =& get_instance();
		$user = $CI->session->all_userdata();
		if ( is_logged_in() )
			return (object)array('user' => $user['session_data']['set_user'], 'rolid' => $user['session_data']['set_rol'], 'id' => $user['session_data']['set_id']);
		else
			return false;
	}

	function generate_url($title){
		$ac2=explode(',','ñ,Ñ,á,é,í,ó,ú,Á,É,Í,Ó,Ú,ä,ë,ï,ö,ü,Ä,Ë,Ï,Ö,Ü,ù');
		$xc2=explode(',','n,N,a,e,i,o,u,A,E,I,O,U,a,e,i,o,u,A,E,I,O,U,u');
		$title = strtolower(str_replace($ac2, $xc2, $title));
		$plb='/\b(a|e|i|o|u|el|en|la|las|es|tras|del|pero|para|por|de|con| ' .
			'.|sera|haber|una|un|unos|los|debe|ser)\b/';
		$title = preg_replace($plb, '', $title);
		$title = preg_replace('/[^a-z0-9 -]/', '', $title);
		$title = preg_replace('/-/', ' ', $title);
		$title = trim(preg_replace('/[ ]{2,}/', ' ', $title));
		$title = str_replace(' ', '-', $title);
		return trim($title);
	}

	function redirectUser() {
		$CI =& get_instance();
		$user = $CI->session->all_userdata();
		$rolid = $user['session_data']['set_rol'];
		if ( $rolid == 1 )
			redirect('solicitudes');
		else if ( $rolid == 2)
			redirect('perfiles');
		else if ( $rolid == 3)
			redirect('solicitudes/carga');
		else if ( $rolid == 4)
			redirect('solicitudes');
		else if ( $rolid == 6)
			redirect('solicitudes/listarf');
		else
			redirect('admin');
	}

	function securityAccess($roles = array()) {
		$CI =& get_instance();
		$user = $CI->session->all_userdata();
		$rolid = $user['session_data']['set_rol'];
		if ( !in_array($rolid, $roles) )
			redirect('admin/erroraccess');
	}

?>