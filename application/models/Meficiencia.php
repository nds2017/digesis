<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Meficiencia extends CI_Model
{
	public function __construct()
	{
		parent::__construct();

	}

	public function geteficiencia($p=null){			     
	     $rows = array();
	     $query = $this->db->where('eficiencia')->get();
	     if( $query->num_rows() > 0 ) {
	     	$x=0;
		    foreach ($query->result() as $key => $row ) {
					  $rows[$row->monto] = range($x,$row->porcentaje);
					  $x=$row->porcentaje+1;
			}
			$y=0;
            foreach ($rows as $key => $value){
            	   if (in_array($p,$value))
            	   	   $y=$key;					
			}          
		}
		return $y;
	}

	
}