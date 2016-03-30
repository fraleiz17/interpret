<?php
if (!defined('BASEPATH'))
	die("No hay acceso directo a este script");

/*
 * Modelo para manejar datos defaults
 */

class Defaultdata_model extends CI_Model {

	var $tablas = array();

	function __construct() {
		parent::__construct();
		$this -> load -> config('tables', TRUE);
		$this -> tablas = $this -> config -> item('tablas', 'tables');
	}
  

	function getEstados() {
		return $this -> db -> get($this -> tablas['estado']) -> result();
	}
    
    
	
    function getPaises(){
        $this -> db -> order_by('nombrePais', 'asc');
        $query = $this -> db -> get($this-> tablas['pais']);
        if($query -> num_rows() > 0)
            return $query -> result();
        return null;
    }

    function getVisitas(){
    	$query = $this->db->get($this-> tablas['visita']);
    	$visitas = $query->row();
    	return $visita = $visitas->numeroVisitas;
    	
    }

    function registroVisita($data){
    	$this -> db -> where('idVisita', 1);
        $this -> db -> update($this -> tablas['visita'], $data);
        return true;
    }
	
    function getUsers(){
        $query = $this -> db -> get($this -> tablas['usuario']);
        return $query -> result();

    }

    function getAnnounces(){
        $query = $this -> db -> get($this -> tablas['publicaciones']);
        return $query -> result();
    }

    function getTable($tabla) {
        return $this -> db -> get($this -> tablas[$tabla]) -> result();
    }

    function getTablaDetalle($tabla, $tablaDetalle,$id1, $id2){
        
        $this->db->join($this -> tablas[$tablaDetalle],$this -> tablas[$tablaDetalle].'.'.$id1.' = '.$this -> tablas[$tabla].'.'.$id2,'left');
        $query = $this -> db -> get($this -> tablas[$tabla]);
        return $query -> result();

    }

    function getPaquetes($tipopaquete = NULL) {
        /**
         * Se realiza asi el select por que en detallepaquete y detallecupon exite la columna vigencia y se reemplaza 
         * la columna vigencia de detallepaquete por la columna vigencia de detallecupon
         */
        $this->db->select('p.paqueteID,
      p.nombrePaquete,
       dp.detalleID,
       dp.cantFotos,
       dp.caracteres, 
       dp.vigencia,
       dp.cupones,
       dp.videos,
       dp.precio,
       dp.tipoPaquete');

        /*
        ,
       c.cuponID,
       c.nombreCupon,
       cd.cuponDetalleID,
       cd.descripcion,
       cd.valor,
       cd.vigencia as vigenciaCupon,
       cd.tipoCupon
        */
        
        $this->db->from('paquete p');
        $this->db->join('detallepaquete dp', 'p.paqueteID=dp.paqueteID');
        //$this->db->join('cupon c', 'p.paqueteID=c.paqueteID');
        //$this->db->join('cupondetalle cd', 'c.cuponID=cd.cuponID');
        
        if(!is_null($tipopaquete)){
            $this->db->where('dp.tipoPaquete', $tipopaquete);
        }

        $resultSet = $this->db->get();

        return $resultSet->result();
    }

    function getRazas(){
        return $this->db->get($this->tablas['raza'])->result();
    }

    function getCupones(){
        $this->db->from('cupon c');
        $this->db->join('cupondetalle cd', 'c.cuponID=cd.cuponID');
        return $this->db->get()->result();
    }

    function getBanner(){
       return $this->db->get('banner')->result(); 
    }
    
    function getGiros(){
        return $this->db->get('giro')->result();
    }
    
    function getPaquetesCupon($tipopaquete = NULL, $idpaquete = NULL) {
        /**
         * Se realiza asi el select por que en detallepaquete y detallecupon exite la columna vigencia y se reemplaza 
         * la columna vigencia de detallepaquete por la columna vigencia de detallecupon
         */
        $this->db->select('p.paqueteID,
      p.nombrePaquete,
       dp.detalleID,
       dp.cantFotos,
       dp.caracteres, 
       dp.vigencia,
       dp.cupones,
       dp.videos,
       dp.precio,
       dp.tipoPaquete,
        
       c.cuponID,
       c.nombreCupon,
       cd.cuponDetalleID,
       cd.descripcion,
       cd.valor,
       cd.vigencia as vigenciaCupon,
       cd.tipoCupon'
        );
        
        $this->db->from('paquete p');
        $this->db->join('detallepaquete dp', 'p.paqueteID=dp.paqueteID');
        $this->db->join('cupon c', 'p.paqueteID=c.paqueteID', 'left');
        $this->db->join('cupondetalle cd', 'c.cuponID=cd.cuponID', 'left');
        
        if(!is_null($tipopaquete)){
            $this->db->where('dp.tipoPaquete', $tipopaquete);
        }
        
        if(!is_null($idpaquete)){
            $this->db->where('p.paqueteID', $idpaquete);
            
            return $this->db->get()->row();
        }

        $resultSet = $this->db->get();

        return $resultSet->result();
    }

    function getPaquete($paqueteID){
      $this->db->where('paquete.paqueteID',$paqueteID);
      $this->db->join('detallepaquete','detallepaquete.paqueteID = paquete.paqueteID');
      return $this->db->get($this->tablas['paquete'])->row();
    }

    function getCuponesPaquete($paqueteID){
      $this->db->where('cupon.paqueteID',$paqueteID);
      $this->db->join('cupondetalle','cupondetalle.cuponID = cupon.cuponID');
      return $this->db->get($this->tablas['cupon'])->result();
    }

   function insertItem($tabla, $data)
    {
        $this->db->insert($this->tablas[$tabla], $data);
        $itemID = $this->db->insert_id();
        return $itemID;
    }
    
    public function get_zona_geografica($id_estado){
        $this->db->from('zonageograficaestado');
        $this->db->where('estadoID', $id_estado);
        return $this->db->get()->row();
    }

    function updateItem($itemID, $ID, $data, $tabla)
    {
        $this->db->where($itemID, $ID);
        $this->db->update($this->tablas[$tabla], $data);
        return true;
    }


    function getTiendas(){
      $this->db->where('tipoUsuario',2);
      return $this->db->get($this->tablas['usuariodetalle'])->result();
    }

    function getVisitasP($publicacionID){
      $this->db->where('publicacionID',$publicacionID);
      return $this->db->get($this->tablas['publicaciones'])->row();
    }


    function recordatorio(){
      $query = $this->db->query('select usuario.*,`publicaciones`.`titulo`, publicaciones.`fechaVencimiento`,`publicaciones`.`servicioID` 
from `publicaciones` 
join `serviciocontratado` on `serviciocontratado`.`servicioID` = `publicaciones`.`servicioID` 
left join usuario on usuario.`idUsuario` = `serviciocontratado`.`idUsuario`
where `publicaciones`.`fechaVencimiento` = date_add(CURRENT_DATE(), INTERVAL 7 DAY)');
      if ($query->num_rows() >= 1){
            
            return $query->result();
         } else {
            return null;
         }
    }

    function getPerroPerdido(){
      $query = $this->db->query('select publicaciones.*, raza.raza, (select foto from fotospublicacion where fotospublicacion.publicacionID = publicaciones.publicacionID group by fotospublicacion.publicacionID limit 1) as foto
                                from `publicaciones`
                                join raza on raza.razaID = publicaciones.razaID
                                where `publicaciones`.`seccion` = 7
                                and vigente = 1
                                and aprobada = 1
                                limit 1');
      if ($query->num_rows() == 1){
            return $query->row();
         } else {
            return null;
         }
    }

    function getTexto($seccionID){
       $query = $this->db->query('select distinct texto
        from banner
        where posicion = 2
        and (seccionID = '.$seccionID.' )');
      
      if ($query->num_rows() == 1){
          $e = $query->row();
            return $e->texto;
         } else {
            return null;
         }
    }

    function getVencidos(){
      $query = $this->db->query('select *
        from publicaciones
        where fechaVencimiento < CURRENT_DATE()');
      
      if ($query->num_rows() >= 1){
          return $query->result();
         } else {
            return null;
         }
    }

     function deleteItem($idTabla, $id, $tabla)
    {
        $this->db->where($idTabla, $id);
        $this->db->delete($this->tablas[$tabla]);
        return true;
    }

    function comprasFallidas(){
         $query = $this->db->query("SELECT compraID FROM compradetalle
where compraID in (SELECT compraID FROM `compra` WHERE pagado = 0)
and (nombre = 'Lite' or nombre = 'Regular' or nombre = 'Premium' or nombre = 'Asociacion' or nombre = 'Directorio 1' or nombre = 'Directorio 2' or nombre = 'Directorio 3') ");
         if ($query->num_rows() >= 1){            
            return $query->result();
         } else {
            return null;
         }
    }

    function publicacionesFallidas(){
    $query = $this->db->query("select servicioID
from publicaciones where servicioID in 
(select servicioID
from serviciocontratado
where pagado = 0)");
    if ($query->num_rows() >= 1){            
            return $query->result();
         } else {
            return null;
         }
    }

    function getBannerS($seccionID) {
               $this->db->where('seccionID', $seccionID);
        return $this -> db -> get('banner') -> result();
    }

    



}
?>
