<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mservicios extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('mdepartamentos');
	}


	public function delete(){		
		$this->db->query("delete from servicios");
	}

	public function delete_row($id=null){

	  $this->db->where('id', $id);
      return $this->db->delete('servicios'); 	 	  
	}
	public function insert($data=array()){
			
		$this->db->insert('servicios', $data);
	}

	public function get()
	{

	$this->db->select('s.*');
	$this->db->from('servicios s');	
	$query = $this->db->get();
	if ( $query->num_rows() > 0 )
		return $query->result();

	}

	public function getByCategoria($categoria=null)
	{

	$this->db->select('s.id,s.categoria,s.descripcion');
	$this->db->from('servicios s');	
	$this->db->where('categoria',$categoria);
	$query = $this->db->get();
	if( $query->num_rows() > 0 ) {
		foreach ($query->result() as $key => $row ) {
					  $rows[] = $row;
				}
			print_r($rows);	
			}
		return $rows;
	}





}
