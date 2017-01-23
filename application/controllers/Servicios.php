<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {

	
	 public function __construct()
   {

 	   parent::__construct();
		$this->load->model('mservicios');
		is_logged_in() ? true : redirect('admin');
	}
			  
	 public function index()
	 {	 	
	 	securityAccess(array(1));
	 	$data['header'] = $this->load->view('admin/menu/header', array('active' => 'solicitudesload' ));
		   		
		if ($this->input->server('REQUEST_METHOD') == 'POST'):
   		
			$file = $_FILES['file']['tmp_name'];
			$type = $_FILES['file']['type'];
			if ( !empty($file) && ( $type == 'application/vnd.ms-excel' ) ) {

			print_r($file);

			}

   		endif;

	 	$this->load->view('admin/carga-servicios',$data);
	 }



public function carga() {
		date_default_timezone_set('America/Lima');
		$session = get_session();
		securityAccess(array(1, 3));
		$data['header'] = $this->load->view('admin/menu/header', array('active' => 'solicitudesload' ));
		$data['bnombres'] = isset($_POST['bnombres']) ? $_POST['bnombres'] : '';
		if ( @$_POST['carga'] ) {
			$file = $_FILES['file']['tmp_name'];
			$type = $_FILES['file']['type'];
			if ( !empty($file) && ( $type == 'application/vnd.ms-excel' ) ) {
				$handle = fopen($file, "r");
				$fila = 1;
				$datos = array();
				$i = $inserts = $updates = 0;
				while ( ($datos = fgetcsv($handle)) !== false ) {
					if ( count($datos) > 8 ) {
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
								'fecha_instalacion' => empty($datos[8]) ? strtotime(date('d-m-Y')) : strtotime($fecha),
								'upload' => 1,
								'horario' => 1,
								'modtime' => strtotime("now")
							);
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
					else {
						$data['error'] = '<p style="color: red;"><b>Error en el Archivo, El archivo CSV debe tener 9 Columnas</b></p>';
						break;
					}
				}
				$data['info'] = (object)array('filas' => $i-1, 'add' => $inserts, 'update' => $updates);
				$this->msolicitudes->solicitudes_cargalog(array(
					'fecha_upload' => strtotime("now"),
					'usuarioid' => $session->id,
					'agregados' => $inserts,
					'archivo' => $_FILES['file']['name']
				));
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