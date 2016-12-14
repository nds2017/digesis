<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitudes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->database('default');
		$this->load->model('msolicitudes');
		$this->load->model('mtecnicos');
		$this->load->model('mdepartamentos');
		$this->load->model('musuarios');
		is_logged_in() ? true : redirect('admin');
	}

	public function index() {
		securityAccess(array(1, 4));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'solicitudes' ));
		$data['estados'] = $this->msolicitudes->estados_entrys();
		$data['departamentos'] = $this->mdepartamentos->departamentos_entrys();
		$data['data'] = $this->msolicitudes->solicitudes_entrys();
		$data['cantidades'] = $this->msolicitudes->solicitudes_cantidades();
		$this->load->view('admin/solicitudes', $data);
	}

	public function lista($estadoid = 0) {
		securityAccess(array(1));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'solicitudes' ));
		$data['estadoid'] = $estadoid ? $estadoid : 0;
		$data['distritoid'] = isset($_POST['distritoid']) ? $_POST['distritoid'] : 0;
		$data['solicitudid'] = isset($_POST['solicitudid']) ? $_POST['solicitudid'] : '';
		if ( $data['distritoid'] ) {
			$data['provinciaid'] = $this->mdepartamentos->distrito_getProvincia($data['distritoid']);
			$data['departamentoid'] = $this->mdepartamentos->provincia_getDpto($data['provinciaid']);
		}
		$data['estados'] = $this->msolicitudes->estados_entrys();
		$data['data'] = $this->msolicitudes->solicitudes_entrys($data['estadoid'], $data['distritoid'], $data['solicitudid']);
		$data['distritos'] = $this->mdepartamentos->distritos_entrys(@$data['provinciaid']);
		$data['provincias'] = $this->mdepartamentos->provincias_entrys(@$data['departamentoid']);
		$data['departamentos'] = $this->mdepartamentos->departamentos_entrys();
		$data['cantidades'] = $this->msolicitudes->solicitudes_cantidades();
		$this->load->view('admin/solicitudes', $data);
	}


	public function form($id = false) {
		securityAccess(array(1, 4));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'solicitudesadd' ));
		$data['tecnicos1'] = $this->mtecnicos->tecnicos_byCargo(1);
		$data['tecnicos2'] = $this->mtecnicos->tecnicos_byCargo(2);
		$data['analistas'] = $this->musuarios->usuarios_entrys(false, false, 4);
		$data['tipotrabajos'] = $this->msolicitudes->tipostrabajo_entrys();
		$data['tiposervicios'] = $this->msolicitudes->tiposservicio_entrys();
		$data['distritos'] = $this->mdepartamentos->distritos_entrys();
		$data['provincias'] = $this->mdepartamentos->provincias_entrys();
		$data['departamentos'] = $this->mdepartamentos->departamentos_entrys();
		$data['regiones'] = $this->msolicitudes->regiones_entrys();
		$data['estados'] = $this->msolicitudes->estados_entrys();
		$data['admin'] = true;
		if ( is_numeric($id) && ( $id != 0 ) ) {
			$session = get_session();
			$data['data'] = $this->msolicitudes->solicitudes_byID($id);
			$data['distritos'] = $this->mdepartamentos->distritos_entrys($data['data']->provinciaid);
			$data['provincias'] = $this->mdepartamentos->provincias_entrys($data['data']->departamentoid);
			$data['admin'] = ($session->rolid==1) ? TRUE : FALSE;
		}
		$this->load->view('admin/solicitudesedit', $data);
	}

	public function listarf($estadorf = 0) {
		securityAccess(array(1, 6));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'listarf' ));
		$data['solicitudid'] = isset($_POST['solicitudid']) ? $_POST['solicitudid'] : '';
		$data['supervisorid'] = isset($_POST['supervisorid']) ? $_POST['supervisorid'] : 0;
		$data['distritoid'] = isset($_POST['distritoid']) ? $_POST['distritoid'] : 0;
		if ( $data['distritoid'] ) {
			$data['provinciaid'] = $this->mdepartamentos->distrito_getProvincia($data['distritoid']);
			$data['departamentoid'] = $this->mdepartamentos->provincia_getDpto($data['provinciaid']);
		}
		$data['estadorf'] = $estadorf ? $estadorf : 0;
		$data['data'] = $this->msolicitudes->solicitudesrf_entrys($data['estadorf'], $data['distritoid'], $data['solicitudid'], $data['supervisorid']);
		$data['estados'] = $this->msolicitudes->estadosrf_entrys();
		$data['distritos'] = $this->mdepartamentos->distritos_entrys(@$data['provinciaid']);
		$data['provincias'] = $this->mdepartamentos->provincias_entrys(@$data['departamentoid']);
		$data['departamentos'] = $this->mdepartamentos->departamentos_entrys();
		$data['cantidades'] = $this->msolicitudes->solicitudesrf_cantidades();
		$this->load->model('msupervisores');
		$data['supervisores'] = $this->msupervisores->supervisores_entrys(FALSE, 1);
		$this->load->view('admin/solicitudesrf', $data);
	}

	public function listatecnicos() {
		securityAccess(array(1, 4));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'asignartecnicos' ));
		$data['solicitudid'] = isset($_POST['solicitudid']) ? $_POST['solicitudid'] : '';
		$data['distritoid'] = isset($_POST['distritoid']) ? $_POST['distritoid'] : 0;
		if ( $data['distritoid'] ) {
			$data['provinciaid'] = $this->mdepartamentos->distrito_getProvincia($data['distritoid']);
			$data['departamentoid'] = $this->mdepartamentos->provincia_getDpto($data['provinciaid']);
		}
		$data['distritos'] = $this->mdepartamentos->distritos_entrys(@$data['provinciaid']);
		$data['provincias'] = $this->mdepartamentos->provincias_entrys(@$data['departamentoid']);
		$data['departamentos'] = $this->mdepartamentos->departamentos_entrys();
		$data['data']['pendientes'] = $this->msolicitudes->solicitudestecnicos_entrys($data['distritoid'], $data['solicitudid']);
		$data['data']['programadas'] = $this->msolicitudes->solicitudes_entrys(4);
		$data['tecnicos1'] = $this->mtecnicos->tecnicos_byCargo(1);
		$data['tecnicos2'] = $this->mtecnicos->tecnicos_byCargo(2);
		$this->load->view('admin/solicitudestecnicos', $data);
	}

	public function formtecnicos($id) {
		securityAccess(array(1, 4));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'asignartecnicos' ));
		$data['tecnicos1'] = $this->mtecnicos->tecnicos_byCargo(1);
		$data['tecnicos2'] = $this->mtecnicos->tecnicos_byCargo(2);
		$data['data'] = $this->msolicitudes->solicitudes_byID($id);
		$this->load->view('admin/solicitudestecnicosedit', $data);
	}

	public function seguimiento() {
		securityAccess(array(1, 4));
		$session = get_session();
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'asignartecnicos' ));
		$data['solicitudid'] = isset($_POST['solicitudid']) ? $_POST['solicitudid'] : '';
		$data['tecnicoid'] = isset($_POST['tecnicoid']) ? $_POST['tecnicoid'] : 0;
		$id = ( $session->rolid==1 ) ? false : $session->id;
		$data['data'] = $this->msolicitudes->solicitudesgroupbytecnicos($data['solicitudid'], $data['tecnicoid'], $id);
		$data['tecnicos1'] = $this->mtecnicos->tecnicos_byCargo(1);
		$data['tecnicos2'] = $this->mtecnicos->tecnicos_byCargo(2);
		$this->load->view('admin/listaseguimiento', $data);
	}

	public function listavalidados() {
		securityAccess(array(1, 4));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'asignartecnicos' ));
		$data['solicitudid'] = isset($_POST['solicitudid']) ? $_POST['solicitudid'] : '';
		$data['distritoid'] = isset($_POST['distritoid']) ? $_POST['distritoid'] : 0;
		if ( $data['distritoid'] ) {
			$data['provinciaid'] = $this->mdepartamentos->distrito_getProvincia($data['distritoid']);
			$data['departamentoid'] = $this->mdepartamentos->provincia_getDpto($data['provinciaid']);
		}
		$data['distritos'] = $this->mdepartamentos->distritos_entrys(@$data['provinciaid']);
		$data['provincias'] = $this->mdepartamentos->provincias_entrys(@$data['departamentoid']);
		$data['departamentos'] = $this->mdepartamentos->departamentos_entrys();
		$today = count($_POST) ? FALSE : TRUE;
		$data['data'] = $this->msolicitudes->solicitudesvalidadas_entrys($data['distritoid'], $data['solicitudid'], $today);
		$data['tecnicos1'] = $this->mtecnicos->tecnicos_byCargo(1);
		$data['tecnicos2'] = $this->mtecnicos->tecnicos_byCargo(2);
		$this->load->view('admin/listavalidados', $data);
	}

	public function formincidencia($sid) {
		securityAccess(array(1, 4));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'asignartecnicos' ));
		$data['data'] = $this->msolicitudes->solicitudes_byID($sid);
		$data['incidencias'] = $this->msolicitudes->solicitudes_incidencias($sid);
		$this->load->view('admin/solicitudesincidencia', $data);
	}

	public function ajaxDistritos() {
		if ( $_POST ) {
			$array[] = array('id' => 0, 'nombre' => '-Seleccione-');
			$data = $this->mdepartamentos->distritos_entrys($_POST['id']);
			foreach ($data as $key => $value) {
				$array[] = array('id' => $key, 'nombre' => $value);
			}
			echo json_encode($array);
		}

	}

	public function ajaxProvincias() {
		if ( $_POST ) {
			$array[] = array('id' => 0, 'nombre' => '-Seleccione-');
			$data = $this->mdepartamentos->provincias_entrys($_POST['id']);
			foreach ($data as $key => $value) {
				$array[] = array('id' => $key, 'nombre' => $value);
			}
			echo json_encode($array);
		}
	}

	public function formrf($id = false) {
		securityAccess(array(1, 6));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'listarf' ));
		$data['tecnicos1'] = $this->mtecnicos->tecnicos_byCargo(1);
		$data['tecnicos2'] = $this->mtecnicos->tecnicos_byCargo(2);
		$data['tipotrabajos'] = $this->msolicitudes->tipostrabajo_entrys();
		$data['tiposervicios'] = $this->msolicitudes->tiposservicio_entrys();
		$data['distritos'] = $this->mdepartamentos->distritos_entrys();
		$data['estadosrf'] = $this->msolicitudes->estadosrf_entrys();
		$data['departamentos'] = $this->mdepartamentos->departamentos_entrys();
		$data['provincias'] = $this->mdepartamentos->provincias_entrys();
		$data['regiones'] = $this->msolicitudes->regiones_entrys();
		if ( $id )
			$data['data'] = $this->msolicitudes->solicitudes_byID($id);
		
		$this->load->view('admin/solicitudesrfedit', $data);
	}

	public function edit($id) {
		$session = get_session();
		$formdata = array (
			'id' => $this->input->post('solicitudid'),
			'tipotrabajoid' => $this->input->post('tipotrabajoid'),
			'tiposervicioid' => $this->input->post('tiposervicioid'),
			'plano' => $this->input->post('plano'),
			'cliente' => $this->input->post('cliente'),
			'direccion' => $this->input->post('direccion'),
			'regionid' => $this->input->post('regionid'),
			'distritoid' => $this->input->post('distritoid'),
			'usuarioid' => $session->id,
			'estadoid' => $this->input->post('estadoid'),
			'fecha_instalacion' => $this->input->post('fecha_instalacion') ? strtotime($this->input->post('fecha_instalacion')) : strtotime('now')
		);
		$this->msolicitudes->solicitudes_update($formdata, $id);
		$formdata = array(
			'sid' => $this->input->post('solicitudid'),
			't1id' => $this->input->post('tecnico1id'),
			't2id' => $this->input->post('tecnico2id'),
			'aid' => $this->input->post('analistaid')
		);
		$this->msolicitudes->solicitudes_addtecnicos($formdata);
		redirect('solicitudes');
	}

	public function editrf($id) {
		$formdata = array (
			'rf' => $this->input->post('estadosrfid'),
			'motivorf' => $this->input->post('motivo')
		);
		$this->msolicitudes->solicitudes_update($formdata, $id);
		redirect('solicitudes/listarf');
	}

	public function addIncidencia($sid) {
		if ( isset($_POST) && is_array($_POST['incidencias']) ) {
			foreach ( $_POST['incidencias'] as $key => $date ) {
				$this->msolicitudes->solicitudes_addIncidencia(array('sid' => $sid, 'fecha_incidencia' => strtotime($date)));
			}
		}
		redirect('solicitudes/listavalidados');
	}

	public function edittecnicos($id) {
		$session = get_session();
		$formdata = array(
			'sid' => $id,
			't1id' => $this->input->post('tecnico1id'),
			't2id' => $this->input->post('tecnico2id'),
			'aid' => $session->id
		);
		$this->msolicitudes->solicitudes_addtecnicos($formdata);
		$formdata = array(
			'id' => $id,
			'fecha_instalacion' => strtotime("now")
		);
		$this->msolicitudes->solicitudes_update($formdata, $id);
		redirect('solicitudes/listatecnicos');
	}

	public function add() {
		$session = get_session();
		$formdata = array (
			'id' => $this->input->post('solicitudid'),
			'tipotrabajoid' => $this->input->post('tipotrabajoid'),
			'tiposervicioid' => $this->input->post('tiposervicioid'),
			'plano' => $this->input->post('plano'),
			'cliente' => $this->input->post('cliente'),
			'direccion' => $this->input->post('direccion'),
			'regionid' => $this->input->post('regionid')
,			'distritoid' => $this->input->post('distritoid'),
			'usuarioid' => $session->id,
			'fecha_instalacion' => $this->input->post('fecha_instalacion') ? strtotime($this->input->post('fecha_instalacion')) : strtotime('now')
		);
		$this->msolicitudes->solicitudes_create($formdata);
		$formdata = array(
			'sid' => $this->input->post('solicitudid'),
			't1id' => $this->input->post('tecnico1id'),
			't2id' => $this->input->post('tecnico2id'),
			'aid' => $this->input->post('analistaid')
		);
		$this->msolicitudes->solicitudes_addtecnicos($formdata);
		redirect('solicitudes');
	}

	public function delete($id) {
		$this->msolicitudes->solicitudes_delete($id);
		redirect('solicitudes');
	}

	public function carga() {
		$session = get_session();
		securityAccess(array(1, 3));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'solicitudesload' ));
		$data['bnombres'] = isset($_POST['bnombres']) ? $_POST['bnombres'] : '';
		if ( @$_POST['carga'] ) {
			$file = $_FILES['file']['tmp_name'];
			if ( !empty($file) ) {
				$handle = fopen($file, "r");
				$fila = 1;
				$datos = array();
				$i = $inserts = $updates = 0;
				while ( ($datos = fgetcsv($handle)) !== false ) {
					$numero = count($datos);
					$i++;
					if ( $i == 1 )
						continue;
					if ( !empty($datos[0]) ) {
						$fecha = str_replace('/', '-', $datos[8]);
						$formdata = array(
							'id' => $datos[0],
							'tiposervicioid' => $this->msolicitudes->solicitudes_getTipoServicio($datos[1]),
							'plano' => $datos[7],
							'cliente' => $datos[2],
							'direccion' => $datos[3],
							'distritoid' => $this->mdepartamentos->distritos_getDistrito($datos[4], $datos[5], $datos[6]),
							'usuarioid' => $session->id,
							'fecha_instalacion' => empty($datos[8]) ? strtotime(date('d-m-Y')) : strtotime($fecha)
						);
						var_dump($this->msolicitudes->solicitudes_getID($datos[0])); die();
						if ( $this->msolicitudes->solicitudes_getID($datos[0]) ) {
							$updates++;
							$this->msolicitudes->solicitudes_update($formdata, $datos[0]);
						}
						else {
							$inserts++;
							$this->msolicitudes->solicitudes_create($formdata);
							$this->msolicitudes->solicitudes_addtecnicos(array('sid' => $datos[0], 't1id' => 0, 't2id' => 0, 'aid' => 0));
						}
					}
				}
				$data['info'] = (object)array('filas' => $i-1, 'add' => $inserts, 'update' => $updates);
			}
			else
				$data['error'] = '<p style="color: red;"><b>Error de Archivo, Elija un Archivo .csv</b></p>';
		}
		else
			$data['bnombres'] = isset($_POST['bnombres']) ? $_POST['bnombres'] : '';

		$data['data'] = $this->msolicitudes->solicitudes_carga($data['bnombres']);
		$this->load->view('admin/carga-solicitudes', $data);
	}
}