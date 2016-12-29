<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter REST Class
 *
 * Make REST requests to RESTful services with simple syntax.
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Philip Sturgeon
 * @author          Chris Kacerguis
 * @created         04/06/2009
 * @license         http://philsturgeon.co.uk/code/dbad-license
 * @link            http://getsparks.org/packages/restclient/show
 */
class Billetera
{

    protected $_ci;
    Const id_tipo=1;
    Const CODIGO_RF='PEN03';
    Const CODIGO_IN='PEN04';

    private $atendidos =null;
    private $atendidosm=null;
    private $reprogramados=null;
    private $rechazados =null;
    private $pendientes=null;
    private $incidencias=null;
    private $tid=null;
            
    function __construct($config = array())
    {
        $this->_ci =& get_instance();                    
        $this->_ci->load->model('mcostosot');        
        $this->_ci->load->model('meficiencia');
        $this->_ci->load->model('msolicitudes');
        $this->_ci->load->model('mencuestas');
        $this->_ci->load->model('mtecnicos');
        $this->_ci->load->model('mpenalidades');
        $this->_ci->load->model('mincidencias');
                
    }        
    /**
     * get
     *
     * @access  public
     * @author  Phil Sturgeon
     * @version 1.0
     */
    public function getresumen($params = array())
    {
        $data=array();
        $monto=0;
        if ($params)
        {
            $datat = $this->_ci->mtecnicos->tecnicobyDNI($params['dni']);
            if ( is_object($datat) ) 
            {

        $tid = $datat->id;                                                                    
        /* calculo de la eficiencia mes*/
        $this->atendidosm =$this->_ci->msolicitudes->solicitudes_encuestas_all($tid, 2);            
        $this->reprogramados= $this->_ci->msolicitudes->solicitudes_encuestas_all($tid, 4);
        $this->rechazados = $this->_ci->msolicitudes->solicitudes_encuestas_all($tid, 5);
        $this->pendientes = $this->_ci->msolicitudes->solicitudes_encuestas_all($tid, 3);              
        
        $data['comision_dia']=$this->getComisionDia($tid);
        $data['comision_mes']=$this->getComisionMes($tid);                                            
        return $data;
    }
    
    }
}
/* calculo de la comision por dia*/
private function getComisionDia($tid=null){

/* pago por Sot validadas*/
$this->atendidos =$this->_ci->msolicitudes->solicitudes_encuestas($tid, 2, true);          
$rcosto=$this->_ci->mcostosot->getSotByType(self::id_tipo,count($this->atendidos));
if (!empty($rcosto))
    $pago_sot_validado=$rcosto[1]->monto;
else
    $pago_sot_validado=0;


/* descuento de inasistencias*/
    $desc_inasistencia=0;

/* descuento por RF no validada*/
   $c=0;
   $monto_desc_rf = $this->_ci->mpenalidades->getPenalidadesById(self::CODIGO_RF);

    foreach ($this->atendidos as $key => $value) {
        $rf=$this->_ci->msolicitudes->solicitudesByIdAndDate($key);
        if ($rf)
         $c++;
      }      
  $desc_rf_no_validada=$monto_desc_rf*$c;




  return $pago_sot_validado - $desc_inasistencia - $desc_rf_no_validada;
}

private function getComisionMes($tid=null){

$comision_mes_sot=0;
$comision_mes_eficiencia=0;
$desc_mes_inasistencia=0;
$desc_mes_rf_no_validada=0;
$desc_mes_insidencia=0;

/* comision por sot mes */
$r_sot_validadas=$this->_ci->msolicitudes->solicitudesByMonthCount($tid);
if (!empty($r_sot_validadas))
{
    foreach ($r_sot_validadas as $key => $value) {
        $rcosto=$this->_ci->mcostosot->getSotByType(self::id_tipo,$value['cantidad']);
        if(!empty($rcosto))
            $comision_mes_sot=$comision_mes_sot + intval($rcosto[1]->monto); 
    }
}

/*comision por eficiencia*/

$p=(100* count($this->atendidosm))/(count($this->pendientes)+count($this->reprogramados)+count($this->rechazados)+count($this->atendidosm));

$eficiencia=$this->_ci->meficiencia->geteficiencia($p);

if (!empty($eficiencia))
    $comision_mes_eficiencia = intval($eficiencia);


/* descuento de inasistencias*/

    $desc_mes_inasistencia=0;

/* descuento por RF no validada*/
    $c=0;    
    $sot_atendidos=$this->_ci->msolicitudes->solicitudesByMonth($tid);    
    $monto_desc_rf = $this->_ci->mpenalidades->getPenalidadesById(self::CODIGO_RF);
    foreach ($sot_atendidos as $key => $value) {
      $rf=$this->_ci->msolicitudes->solicitudesByIdAndDate($value['id'],true);
        if ($rf)
           $c++;
    }      
    $desc_mes_rf_no_validada=$monto_desc_rf*$c;
    
/* descuento por insidencias*/
    $desc_insidencia = $this->_ci->mpenalidades->getPenalidadesById(self::CODIGO_IN);
    $c_i=0;
    foreach ($sot_atendidos as $key => $value) {
    $r_insidencias=$this->_ci->mincidencias->getIncidenciasById($value['id']);
    $c_i=$c_i+count($r_insidencias);
    }
    $desc_mes_insidencia=$desc_insidencia * $c_i;

}

private function getEficiencia(){
$p=(100* count($this->atendidos))/(count($this->pendientes)+count($this->reprogramados)+count($this->rechazados)+count($this->atendidos));

print_r($p);

$eficiencia=$this->_ci->meficiencia->geteficiencia($p);
print_r($eficiencia);

if (!empty($eficiencia))
    return intval($eficiencia);
else
    return 0;
}

}
