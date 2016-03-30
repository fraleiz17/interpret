<?php
if (!defined('BASEPATH'))
    die("No hay acceso directo a este script");

/*
 * Modelo para manejar datos defaults
 */

class Admin_model extends CI_Model
{

    var $tablas = array();

    function __construct()
    {
        parent::__construct();
        $this->load->config('tables', TRUE);
        $this->tablas = $this->config->item('tablas', 'tables');
    }


    function getZonasG()
    {
        return $this->db->get($this->tablas['zonageografica'])->result();
    }

    function insertBanner($data)
    {
        $this->db->insert($this->tablas['banner'], $data);
        $bannerID = $this->db->insert_id();
        return $bannerID;
    }

    function getBannerC($seccionID, $zonaID)
    {
        $this->db->where('seccionID', $seccionID);
        $this->db->where('zonaID', $zonaID);
        //$this->db->where('posicion', $posicion);
        $query = $this->db->get($this->tablas['banner']);
        if ($query->num_rows() > 0)
            return $query->result();
        return null;
    }

    function getBanner()
    {
        $query = $this->db->get($this->tablas['banner']);
        if ($query->num_rows() > 0)
            return $query->result();
        return null;
    }

    function deleteContent($idContent, $idZona, $idSeccion, $posicion)
    {
        if ($idContent != 0) {
            $this->db->where('bannerID', $idContent);
            $this->db->delete($this->tablas['banner']);
        } else {
            $this->db->where('zonaID', $idZona);
            $this->db->where('seccionID', $idSeccion);
            $this->db->where('posicion', $posicion);
            $this->db->delete($this->tablas['banner']);
        }


    }

    function updateBannerText($bannerID, $data)
    {
        $this->db->where('bannerID', $bannerID);
        $this->db->update($this->tablas['banner'], $data);
        return true;
    }

    // TIENDA 

    function getCatalogoProductos()
    {
        $this->db->select('c.*, (select foto from fotostienda f where f.productoID = c.productoID group by f.productoID limit 1) as foto')->from('catalogoproductos c');

        return $query = $this->db->get()->result();
    }

    function insertItem($tabla, $data)
    {
        $this->db->insert($this->tablas[$tabla], $data);
        $itemID = $this->db->insert_id();
        return $itemID;
    }

    function updateItem($itemID, $ID, $data, $tabla)
    {
        $this->db->where($itemID, $ID);
        $this->db->update($this->tablas[$tabla], $data);
        return true;
    }

    function updateProduct($data, $idUsuario, $productoID, $talla, $color)
    {
        $this->db->where('usuarioID', $idUsuario);
        $this->db->where('productoID', $productoID);
        $this->db->where('talla', $talla);
        $this->db->where('color', $color);
        $this->db->update($this->tablas['carrito'], $data);
        return true;
    }

    function deleteItem($idTabla, $id, $tabla)
    {
        $this->db->where($idTabla, $id);
        $this->db->delete($this->tablas[$tabla]);
        return true;
    }

    function getSingleItem($idTabla, $id, $tabla)
    {
        $this->db->where($idTabla, $id);
        $query = $this->db->get($this->tablas[$tabla]);
        if ($query->num_rows() == 1) {
            return $query->row();
        } elseif ($query->num_rows() > 1) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getSingleItems($idTabla, $id, $tabla)
    {
        $this->db->where($idTabla, $id);
        $query = $this->db->get($this->tablas[$tabla]);
        if ($query->num_rows() >= 1) {
            return $query->result();
        }
    }


    function getProducto($productoID)
    {
        $this->db->where('productoID', $productoID);
        $query = $this->db->get($this->tablas['catalogoproductos']);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function getCarrito($usuarioID)
    {
        $this->db->select('carrito.*, (select foto from fotostienda where fotostienda.productoID = carrito.productoID group by fotostienda.productoID limit 1) as foto');
        $this->db->where('usuarioID', $usuarioID);

        $query = $this->db->get($this->tablas['carrito']);
        return $query->result();
    }

    function getCarritoProducto($usuarioID, $productoID, $talla, $color)
    {
        $this->db->where('usuarioID', $usuarioID);
        $this->db->where('productoID', $productoID);
        $this->db->where('talla', $talla);
        $this->db->where('color', $color);
        $query = $this->db->get($this->tablas['carrito']);
        return $query->row();
    }

    function getAnuncios($aprobado, $seccion, $zona)
    {
        $this->db->select("*");
        $this->db->from("publicaciones p");
        //$this->db->join("fotospublicacion fp", "p.detalleID=fp.detalleID AND p.paqueteID=fp.paqueteID AND p.publicacionID=fp.publicacionID AND p.servicioID=fp.servicioID");
        $this->db->join("serviciocontratado sc", "p.detalleID=sc.detalleID AND p.paqueteID=sc.paqueteID AND p.servicioID=sc.servicioID");
        $this->db->join("detallepaquete dp", "sc.paqueteID=dp.paqueteID AND sc.detalleID=dp.detalleID");
        $this->db->join("raza r", "p.razaID=r.razaID");
        /*
         * No se debe relacionar porque puede traer uno a n links debe traerse por ajax
        $this->db->join("videos v", "p.detalleID=v.detalleID AND p.paqueteID=v.paqueteID AND p.publicacionID=v.publicacionID AND p.servicioID=v.servicioID");
        */
        $this->db->join("paquete pa", "dp.paqueteID=pa.paqueteID");
        $this->db->join("seccion se", "p.seccion=se.seccionID");
        $this->db->join("usuario u", "sc.idUsuario=u.idUsuario");

        if ($zona != null) {
            $this->db->join("usuariodato ud", "u.idUsuario=ud.idUsuario");
            $this->db->join("ubicacionusuario uu", 'ud.idUsuarioDato=uu.idUsuarioDato','left');
            $this->db->where("uu.zonageograficaID", $zona);
        }

       if (is_numeric($aprobado)) {
            $this->db->where("p.aprobada", $aprobado);
        }

        $this->db->where("p.vigente", 1);
        
        if ($seccion != null) {
            
                $this->db->where("p.seccion", $seccion);
            
        }

        
        $this->db->order_by("p.fechaCreacion", "asc");

        $resultSet = $this->db->get();

        return array('data' => $resultSet->result(), 'count' => $resultSet->num_rows);

    }

    public function getCountSalePets($estado)
    {
        $this->db->from("publicaciones");
        $this->db->where("seccion", 2);
        $this->db->where("aprobada", $estado);
        $this->db->where("vigente", 1);

        return $this->db->count_all_results();
    }

    public function getCountCrossPets($estado)
    {
        $this->db->from("publicaciones");
        $this->db->where("seccion", 3);
        $this->db->where("aprobada", $estado);
        $this->db->where("vigente", 1);

        return $this->db->count_all_results();
    }

    public function getCountAdoptionPets($estado)
    {
        $this->db->from("publicaciones");
        $this->db->where("seccion", 6);
        $this->db->where("aprobada", $estado);
        $this->db->where("vigente", 1);

        return $this->db->count_all_results();
    }

    public function getCountLostPets($estado)
    {
        $this->db->from("publicaciones");
        $this->db->where("seccion", 7);
        $this->db->where("aprobada", $estado);
        $this->db->where("vigente", 1);

        return $this->db->count_all_results();
    }

    public function getCountDirectory($estado)
    {
        $this->db->from("publicaciones");
        $this->db->where("aprobada", $estado);
        $this->db->where("seccion", 4);
        $this->db->where("vigente", 1);

        return $this->db->count_all_results();
    }

    public function getCountAsc($estado)
    {
        $this->db->from("publicaciones");
        $this->db->where("aprobada", $estado);
        $this->db->where("seccion", 11);
        $this->db->where("vigente", 1);

        return $this->db->count_all_results();
    }


    function deleteDetalle($id,$detalle){
        $this -> db -> where('productoID', $id);
        $this -> db -> where('detalle',$detalle);
        $this -> db -> delete($this -> tablas['productodetalle']);
        return true;
    }

    function deleteFoto($id){
        $this -> db -> where('productoID', $id);
        $this -> db -> delete($this -> tablas['fotostienda']);
        return true;
    }

    function updatePaquete($paqueteID, $data)
    {
        $this->db->where('paqueteID', $paqueteID);
        $this->db->update($this->tablas['detallepaquete'], $data);
        return true;
    }

    function deleteCupon($paquete){
        $this -> db -> where('paqueteID', $paquete);
        $this -> db -> delete($this -> tablas['cupon']);
        return true;
    }

    function getDatosAnunciante($publicacionID){
        $query = $this->db->query("SELECT * FROM (`publicaciones` p) JOIN `serviciocontratado` sc ON `p`.`detalleID`=`sc`.`detalleID` AND p.paqueteID=sc.paqueteID AND p.servicioID=sc.servicioID 
        JOIN `detallepaquete` dp ON `sc`.`paqueteID`=`dp`.`paqueteID` AND sc.detalleID=dp.detalleID 
        join seccion on seccion.seccionID = p.seccion
        JOIN `usuario` u ON `sc`.`idUsuario`=`u`.`idUsuario` 
        WHERE `p`.`publicacionID` = ".$publicacionID);
         if ($query->num_rows() == 1)
            return $query->row();
        return null;

    }

    function getMensajes()
    {
        return $this->db->get($this->tablas['mensajesadmin'])->result();
    }

    function getMensaje($mensajeID)
    {
        $this->db->where('mensajeID',$mensajeID);
        return $this->db->get($this->tablas['mensajesadmin'])->row();
    }

    function topMensaje(){
        $query = $this->db->query("select mensajeID
                                from mensajesadmin
                                limit 1");
         if ($query->num_rows() == 1){
            $query = $query->row();
            return $query->mensajeID;
         } else {
            return null;
         }
            
        
    }

    function getUsers(){
        $this->db->where('recepcionCorreo',1);
        $this->db->where('status',1);
        $this->db->order_by('nombre', 'asc');
        $query = $this->db->get('usuario');
        if ($query->num_rows() >= 1)
            return $query->result();
        return null;
    }

    function topMensajeUsuario($usuarioID){
        $query = $this->db->query("select mensajeID
                                from mensajes
                                where idUsuario = ".$usuarioID."
                                limit 1");
         if ($query->num_rows() == 1){
            $query = $query->row();
            return $query->mensajeID;
         } else {
            return null;
         }
            
        
    }

    function getMensajesUsuario($usuarioID)
    {
        $this->db->where('idUsuario',$usuarioID);
        return $this->db->get($this->tablas['mensajes'])->result();
    }

    function getPublicacion($publicacionID){
        $query = $this->db->query('SELECT * FROM publicaciones where publicacionID = '.$publicacionID);
        if ($query->num_rows() == 1){
            return $query->row();
        } else {
            return null;
        }
    }

    function getUsuarios($tipoUsuario,$zona){
        $q = 'select usuario.*, `ubicacionusuario`.`zonageograficaID`
                                   from usuario
                                   left join `usuariodato` on `usuariodato`.`idUsuario` = usuario.`idUsuario`
                                   left join `ubicacionusuario` on `ubicacionusuario`.`idUsuarioDato` = `usuariodato`.`idUsuarioDato`
                                   where `usuario`.`tipoUsuario` = '.$tipoUsuario;

        if($zona != '' && $zona != 9){
            $q .= ' and `ubicacionusuario`.`zonageograficaID` = '.$zona;
        }

        $q .= ' and status <> 0 and status <> 2 order by usuario.nombre asc';
        $query = $this->db->query($q);
        if ($query->num_rows() >= 1){
            return $query->result();
        } else {
            return null;
        }
    }

    function getContenidos($ID)
    {
        $this->db->where('seccionID',$ID);
        return $this->db->get($this->tablas['contenido'])->result();
    }

    function getContenido($ID)
    {
        $this->db->where('contenidoID',$contenidoID);
        return $this->db->get($this->tablas['contenido'])->row();
    }

    function getFotosContenido(){
        return $this->db->get($this->tablas['fotoscontenido'])->result();
    }

    function getFotoContenido(){
        $this->db->group_by('contenidoID');
        return $this->db->get($this->tablas['fotoscontenido'])->result();
    }

    function topContenido($seccionID){
        $query = $this->db->query("select contenidoID
                                from contenido
                                where seccionID = ".$seccionID."
                                limit 1");
         if ($query->num_rows() == 1){
            $query = $query->row();
            return $query->contenidoID;
         } else {
            return null;
         }
            
        
    }

    function deleteFotosContenido($contenidoID){
        $this -> db -> where('contenidoID', $contenidoID);
        $this -> db -> delete($this -> tablas['fotoscontenido']);
        return true;
    }

    function getGruposEnvio(){
        $query = $this->db->query("select * from grupoenvio ");
         if ($query->num_rows() >= 1){            
            return $query->result();
         } else {
            return null;
         }
    }

    function getDestinosEnvio(){
         $query = $this->db->query("select * from destinoenvio join estado on estado.estadoID = destinoenvio.estadoID ");
         if ($query->num_rows() >= 1){            
            return $query->result();
         } else {
            return null;
         }
    }

    function deleteDestinos($id){
        $this -> db -> where('grupoID', $id);
        $this -> db -> delete($this -> tablas['destinoenvio']);
        return true;
    }

    //
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




}

?>