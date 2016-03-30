<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rol_model extends CI_Model {
	var $tablas = array();
	
	function __construct(){
		parent::__construct();
		$this->load->config('tables', TRUE);
		$this->tablas = $this->config->item('tablas', 'tables');	
	}
	
	function getRoles(){
		$query = $this->db->get_where($this->tablas['rol'], array('borrado'=>0));
		if($query->num_rows()>=1)
			return $query->result();
		return null;
	}
	
	function getNombreRol($idRol){
		$query = $this->db->get_where($this->tablas['rol'], array('idRol'=>$idRol));
		$row = $query->row();
		return $row->nombreRol;
	}
	
	function listPermisos(){
		$query=$this->db->get($this->tablas['permiso']);
		$return = '';
		foreach($query->result() as $row){
			$return.="<input type=\"checkbox\" name=\"permisos[]\" value=\"" . ($row->idPermiso) . "\"> " . ($row->nombrePermiso) . "<br>\n";
			$return.="<br/>";
		}
		return $return;
	}
	
	function verPermisos($idRol){
		$roltienepermiso = array();
		$return = '';
		$query=$this->db->get_where($this->tablas['roltienepermiso'], array('idRol'=>$idRol));
		foreach($query->result() as $row){
			$roltienepermiso[$row->idPermiso] = $row->idRol;
		}
		unset($query);
		$query=$this->db->get($this->tablas['permiso']);
		foreach($query->result() as $row){
			if(array_key_exists($row->idPermiso, $roltienepermiso)){
				$return.="<input type=\"checkbox\" name=\"permisos[]\" value=\"" . ($row->idPermiso) . "\" checked> " . ($row->nombrePermiso) . "<br>\n";
				$return.="<br/>";
			}
			else{
				$return.="<input type=\"checkbox\" name=\"permisos[]\" value=\"" . ($row->idPermiso) . "\"> " . ($row->nombrePermiso) . "<br>\n";
				$return.="<br/>";
			}
		}
		return $return;
	}
	
	function guardarPermisos($arrPermisos, $idRol){
		$this->db->where('idRol', $idRol);
		$this->db->delete($this->tablas['roltienepermiso']);
		foreach($arrPermisos as $row=>$key){
			$this->db->insert($this->tablas['roltienepermiso'], array('idRol'=>$idRol, 'idPermiso'=>$key));
		}
		return true;
	}
	
	function addRol($arrPermisos, $arrRol){
		$this->db->insert($this->tablas['rol'], $arrRol);
		$idRol = $this->db->insert_id();
		foreach($arrPermisos as $row=>$key){
			$this->db->insert($this->tablas['roltienepermiso'], array('idRol'=>$idRol, 'idPermiso'=>$key));
		}
		return true;
	}
	
	function deleteRol($idRol){
		$this->db->where('idRol',$idRol);
		$this->db->update($this->tablas['rol'], array('borrado'=>1));
		return true;
	}
	function rol_tiene_permiso($idPermiso,$idRol) {
		$query = $this->db->get_where($this->tablas['roltienepermiso'], array('idRol'=>$idRol,'idPermiso'=>$idPermiso));
		if($query->num_rows()>=1)
			return true;
		return false;
	}
}