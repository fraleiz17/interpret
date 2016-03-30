<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usuario_model extends CI_Model
{

    var $tablas = array();

    function __construct()
    {
        parent::__construct();
        $this->load->config('tables', TRUE);
        $this->tablas = $this->config->item('tablas', 'tables');
        $this->load->model('auth_model');
    }

    function getNewConfirmationCode($emailUsuario)
    {
        //obtiene un nuevo código de confirmación, para cambiar contraseña o para activar
        return substr(strtoupper(sha1(substr(md5(uniqid(rand(), true)), 0, 35) . md5($emailUsuario))), 0, 25);
    }

    function insertNewConfirmationCode($identificador, $code)
    {
        $this->db->where('idUsuario', $identificador);
        $this->db->or_where('correo', $identificador);
        $this->db->update($this->tablas['usuario'], array('codigoConfirmacion' => $code));
        return true;
    }

    function registrarUsuario($data)
    {
        //registra un usuario
        $data['authKey'] = $this->auth_model->getNewAuthKey($data['correo'], 20);
        $data['contrasena'] = $this->auth_model->hashPassword($data['contrasena'], null);
        $this->db->insert($this->tablas['usuario'], $data);
        return $this->db->insert_id();
    }

    function registrarDato($data, $tabla)
    {
        //registra un usuario Negocio o AC
        $this->db->insert($this->tablas[$tabla], $data);
        return $this->db->insert_id();
    }

    function is_there_activation_code($activationCode)
    {
        $this->db->where('codigoConfirmacion', $activationCode);
        $query = $this->db->get($this->tablas['usuario']);
        if ($query->num_rows == 1)
            return $query;
        return null;
    }

    function activar($activationCode)
    {
        //activa un usuario, devuelve 1: activado, 0:usuario ya activado, -1: codigo no existe
        //si el usuario ya esta activo y se intenta activar nuevamente, cambia el confirmation code nuevamente
        $activacion = $this->is_there_activation_code($activationCode);
        if ($activacion != null) {
            $row = $activacion->row();
            if ($row->status == '1') {
                return 0;
            } else {
                $this->db->where('idUsuario', $row->idUsuario);
                $this->db->update($this->tablas['usuario'], array('status' => 1,
                    'codigoConfirmacion' => $this->getNewConfirmationCode($row->correo)));;
                $this->load->model('auth_model');
                $this->auth_model->iniciarsesion($row, null);
                return 1;
            }
        } else {
            return -1;
        }
    }

    function resetPassword($activationCode)
    {
        //activa un usuario, devuelve 1: activado, 0:usuario ya activado, -1: codigo no existe
        //si el usuario ya esta activo y se intenta activar nuevamente, cambia el confirmation code nuevamente
        $activacion = $this->is_there_activation_code($activationCode);
        if ($activacion != null) {
            $row = $activacion->row();

            $this->db->where('idUsuario', $row->idUsuario);
            $this->db->update($this->tablas['usuario'], array('status' => 1, 'codigoConfirmacion' => $this->getNewConfirmationCode($row->correo)));;
            $this->load->model('auth_model');
            $this->auth_model->iniciarsesion($row, null);
            return 1;
        } else {
            return -1;
        }
    }

    /*
     * Información de la cuenta
     * */

    function getMyInfo($idUsuario)
    {
        $this->db->select('*');
        $this->db->where('idUsuario', $idUsuario);
        $query = $this->db->get($this->tablas['usuario']);
        if ($query->num_rows() == 1)
            return $query->row();
        return null;
    }

    function getMyConfirmationCode($usuario)
    {
        $this->db->select('idUsuario, correo, nombre, codigoConfirmacion');
        $this->db->where('correo', $usuario);
        $query = $this->db->get($this->tablas['usuario']);
        if ($query->num_rows() == 1)
            return $query->row();
        return null;
    }

    /*
     * Modificar información de la cuenta
     * */

    function passRecover($password, $idUsuario)
    {
        $password = $this->auth_model->hashPassword($password, null);
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update($this->tablas['usuario'], array('contrasena' => $password));
        return true;
    }

    function cambiarContrasena($contrasenaActual, $contrasenaUsuario, $idUsuario, $admin)
    {
        /* CHECAMOS EL NIVEL DE USUARIO / ROL */
        if ($admin) {
            $this->load->model('auth_model');
            $this->db->select('contrasena');
            $this->db->where('idUsuario', $idUsuario);
            $query = $this->db->get($this->tablas['usuario']);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                if ($this->auth_model->hashPassword($contrasenaActual, substr($row->contrasena, 0, 10)) == $row->contrasena) {
                    $arrNewPass = array('contrasena' => $this->auth_model->hashPassword($contrasenaUsuario));
                    $this->db->where('idUsuario', $idUsuario);
                    $this->db->update($this->tablas['usuario'], $arrNewPass);
                    return true;
                    // die('cambio');
                } else {
                    return false;
                    // die('no coincide pass');
                }
            } else {
                return false;
                // die('no usuario');
            }
        } else {
            /* SI NO ES ADMINISTRADOR ENTONCES... */
            $this->load->model('auth_model');
            $this->db->select('contrasena');
            $this->db->where('idUsuario', $idUsuario);
            $query = $this->db->get($this->tablas['usuario']);
            if ($query->num_rows() == 1) {
                $row = $query->row();
                $arrNewPass = array('contrasena' => $this->auth_model->hashPassword($contrasenaUsuario));
                $this->db->where('idUsuario', $idUsuario);
                $this->db->update($this->tablas['usuario'], $arrNewPass);
                return true;
                // die('cambio');
            } else {
                return false;
                // die('no usuario');
            }
        }
    }

    function updateData($idUsuario, $arrUpdate)
    {
        $this->db->where('idUsuario', $idUsuario);
        return $this->db->update($this->tablas['usuario'], $arrUpdate);
    }

    function cambiar_email($idUsuario, $emailUsuario)
    {
        if (!$this->is_there_emailUsuario($emailUsuario['correo'])) {
            $this->db->where('idUsuario', $idUsuario);
            $this->db->update($this->tablas['usuario'], $emailUsuario);
            return true;
        } else {
            return false;
        }
    }

    function pendingActivation($idUsuario)
    {
        $this->db->where('idUsuario = ' . $idUsuario . ' and tmp_email != ""');
        $query = $this->db->get($this->tablas['usuario']);
        if ($query->num_rows() != 0)
            return true;
        return false;
    }

    function get_tmp_email($idUsuario)
    {
        /* OBTENEMOS EL EMAIL QUE SE ENCUENTRA EN TEMPORAL */
        $query = $this->db->get_where($this->tablas['usuario'], array('idUsuario' => $idUsuario));
        if ($query->num_rows() > 0)
            return $query->row();
        return false;
    }

    function cancel_tmp_email($idUsuario, $arrUpdate)
    {
        /* CANCELACION DE CAMBIO DE CORREO */
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update($this->tablas['usuario'], $arrUpdate);
        return true;
    }

    function email_is_empty($newWmail)
    {
        /* EL EMAIL NO SE ENCUENTRA PREVIAMENTE REGISTRADO EN LA DB */
        $this->db->where('correo', $newWmail);
        $this->db->or_where('tmp_email', $newWmail);
        $query = $this->db->get($this->tablas['usuario']);
        if ($query->num_rows() > 0)
            return false;
        return true;
    }

    function do_tmp_email($idUsuario, $arrUpdate)
    {
        /* GUARDAMOS EL NUEVO CORREO ELECTRONICO DE LA CUENTA COMO TEMPORAL HASTA QUE LO ACTIVE */
        $this->db->where('idUsuario', $idUsuario);
        $this->db->update($this->tablas['usuario'], $arrUpdate);
        return true;
    }

    function is_there_emailUsuario($emailUsuario)
    {
        //verifica si un email ya existe antes de registrarlo
        $this->db->where('correo', $emailUsuario);
        $query = $this->db->get($this->tablas['usuario']);
        // $query = $this->db->get('usuario');
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }
    }

    function deleteUser($idUsuario)
    {
        $this->db->where('idUsuario', $idUsuario);
        $this->db->delete($this->tablas['usuario']);
        return true;
    }

    function banearUser($idUsuario, $currentStatus)
    {
        /*
         * EXISTEN 3 'STATUS' DE USUARUIO:
         * '0' -> USUARIO PENDIENTE DE ACTIVACION
         * '1' -> USUARIO ACTIVADO
         * '2' -> USUARIO BANEADO       
         */
        $status = '';
        $this->db->where('idUsuario', $idUsuario);
        if ($currentStatus == 1) {
            $this->db->update($this->tablas['usuario'], array('status' => 2));
            $status = 'bannedOK';
        } else if ($currentStatus == 2) {
            $this->db->update($this->tablas['usuario'], array('status' => 1));
            $status = 'unblockedUser';
        }
        return $status;
    }

    function myID($idUsuario)
    {

        $this->db->select($this->tablas['usuario'] . '.*,' . $this->tablas['usuariodato'] . '.*');
        $this->db->join($this->tablas['usuariodato'], $this->tablas['usuariodato'] . '.idUsuario = ' . $this->tablas['usuario'] . '.idUsuario', 'left');
        $this->db->where($this->tablas['usuario'] . '.idUsuario', $idUsuario);
        $query = $this->db->get($this->tablas['usuario']);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function myInfo( $idUsuario = null)
    {

        
        $query = $this->db->query('SELECT `usuariodato`.*, `usuariodetalle`.*, `usuario`.* from usuario LEFT JOIN `usuariodato` ON `usuariodato`.`idUsuario` = `usuario`.`idUsuario` LEFT JOIN `usuariodetalle` ON `usuariodetalle`.`idUsuario` = `usuario`.`idUsuario` WHERE `usuario`.`idUsuario` = '.$idUsuario.' limit 1');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function myInfoR($idUsuario)
    {

        $this->db->select($this->tablas['usuario'] . '.*,' . $this->tablas['usuariodato'] . '.idUsuarioDato,' . $this->tablas['usuariodetalle'] . '.idUsuarioDetalle');
        $this->db->join($this->tablas['usuariodato'], $this->tablas['usuariodato'] . '.idUsuario = ' . $this->tablas['usuario'] . '.idUsuario', 'left');
        $this->db->join($this->tablas['usuariodetalle'], $this->tablas['usuariodetalle'] . '.idUsuario = ' . $this->tablas['usuario'] . '.idUsuario', 'left');
        $this->db->where($this->tablas['usuario'] . '.idUsuario', $idUsuario);
        $this->db->limit(1);
        $query = $this->db->get($this->tablas['usuario']);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function zonaGeografica($idEstado)
    {
        $this->db->where('estadoID', $idEstado);
        $query = $this->db->get($this->tablas['zonageograficaestado']);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function miUbicacion($idUsuarioDato)
    {
        $this->db->select($this->tablas['ubicacionusuario'] . '.*,' . $this->tablas['zonageograficaestado'] . '.zonageograficaID,' . $this->tablas['zonageograficaestado'] . '.nombre,' . $this->tablas['estado'] . '.nombreEstado');
        $this->db->join($this->tablas['zonageograficaestado'], $this->tablas['zonageograficaestado'] . '.estadoID = ' . $this->tablas['ubicacionusuario'] . '.estadoID');
        $this->db->join($this->tablas['estado'], $this->tablas['estado'] . '.estadoID = ' . $this->tablas['ubicacionusuario'] . '.estadoID');
        $this->db->where('idUsuarioDato', $idUsuarioDato);
        $query = $this->db->get($this->tablas['ubicacionusuario']);
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    /* Obtiene los cupones que tiene el usuario filtrando el tipo de cupon o el cupon adquirido */

    function getCuponesUsuario($idUsuario, $tipo_cupon = null, $id_cupon_adquirido = NULL)
    {
        $this->db->from('serviciocontratado sc');
        $this->db->join('cuponadquirido ca', 'sc.servicioID=ca.servicioID AND sc.paqueteID=ca.paqueteID AND sc.detalleID=ca.detalleID');
        $this->db->join('cupondetalle cd', 'ca.cuponID=cd.cuponID AND ca.cuponDetalleID=cd.cuponDetalleID');
        $this->db->where('sc.idUsuario', $idUsuario);
        $this->db->where('ca.vigente', 1);
        $this->db->where('ca.usado', 0);

        if (!is_null($tipo_cupon)) {
            $this->db->where('cd.tipoCupon', $tipo_cupon);
        }

        if (!is_null($id_cupon_adquirido)) {
            $this->db->where('ca.idCuponAdquirido', $id_cupon_adquirido);
            return $this->db->get()->row();
        }

        return $this->db->get()->result();
    }

    function getDireccionesEnvioUsuario($idUsuario)
    {
        $this->db->from('usuariodetalle ud');
        $this->db->join('usuario u', 'ud.idUsuario=u.idUsuario');
        $this->db->where('u.idUsuario', $idUsuario);
        return $this->db->get()->result();
    }

    function getDireccionEnvio($idUsuario){
        $this->db->from('direccionenvio ud');
        $this->db->join('usuario u', 'ud.idUsuario=u.idUsuario');
        $this->db->join('estado e', 'ud.estadoID=e.estadoID');
        $this->db->where('u.idUsuario', $idUsuario);
        $query = $this->db->get();
         if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function addCompra($compra, $compra_detalle)
    {

        $this->db->insert('compra', $compra[0]);
        $compraID = $this->db->insert_id();
        foreach ($compra_detalle as $value) {
            $value['compraID'] = $compraID;
            $this->db->insert('compradetalle', $value);
        }
        return $compraID; 
    }

    function deleteCarrito($idUsuario)
    {
        $this->db->delete('carrito', array('usuarioID' => $idUsuario));
        $this->db->delete('carritototal', array('usuarioID' => $idUsuario));
    }

    /**
     * Recibe de parametro un objeto compuesto de cuponadquirido y cupondetalle
     * */
    function save_cupones($idCuponAdquirido)
    {
        $this->db->where('idCuponAdquirido', $idCuponAdquirido);
        $this->db->update('cuponadquirido', array('usado' => 1));
    }

    //PERFIL DEL USUARIO

    function getInfoCompleta($idUsuario)
    {
       
        $query = $this->db->query('SELECT * from  usuariodato 
left JOIN `usuariodetalle` ON `usuariodetalle`.`idUsuario` = `usuariodato`.`idUsuario` 
WHERE `usuariodato`.`idUsuario` = '.$idUsuario.'
limit 1');
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return null;
        }
    }

    function getGiro($idUsuarioDetalle)
    {
        $this->db->where($this->tablas['giroempresa'] . '.idUsuarioDetalle', $idUsuarioDetalle);
        $query = $this->db->get($this->tablas['giroempresa']);
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return null;
        }
    }

    function getGirosUsuario($idUsuario)
    {
        $this->db->from('giroempresa ge');
        $this->db->join('giro g', 'ge.giroID=g.giroID');

        $this->db->where('ge.idUsuarioDetalle', $idUsuario);
        return $this->db->get()->result();
    }

    /**
     *
     * @param int $tipo_usuario
     * @param int $giro
     * @param int $estado
     * @param string $palabraclave
     * @param int $id
     * @return mixed
     */
    function getDirectorios($seccion = null, $giro = null, $estado = null, $palabraclave = null, $id = null)
    {
        /*
         * 
         * Posible recomentacion para pasarlo a una vista
         $this->db->select('p.*, (select nombreGiro from `giroempresa`
LEFT JOIN `giro` g ON `giroempresa`.`giroID`=`g`.`giroID` 
LEFT JOIN `usuariodetalle` ON `usuariodetalle`.`idUsuarioDetalle`=`giroempresa`.`idUsuarioDetalle`
limit 1) as nombreGiro, (select giroempresa.giroID as giroID
from `giroempresa`
LEFT JOIN `giro` g ON `giroempresa`.`giroID`=`g`.`giroID` 
LEFT JOIN `usuariodetalle` ON `usuariodetalle`.`idUsuarioDetalle`=`giroempresa`.`idUsuarioDetalle`
limit 1) as giroID');
         */

        
        $this->db->from("publicaciones p");

        $this->db->join("serviciocontratado sc", "p.detalleID=sc.detalleID AND p.paqueteID=sc.paqueteID AND p.servicioID=sc.servicioID");
        $this->db->join("detallepaquete dp", "sc.paqueteID=dp.paqueteID AND sc.detalleID=dp.detalleID");

        $this->db->join("raza r", "p.razaID=r.razaID", 'left');
        $this->db->join("paquete pa", "dp.paqueteID=pa.paqueteID");
        $this->db->join("seccion se", "p.seccion=se.seccionID");
        $this->db->join("usuario u", "sc.idUsuario=u.idUsuario");

        $this->db->join('usuariodetalle ud', 'u.idUsuario=ud.idUsuario', 'left');
        $this->db->join('usuariodato uda', 'u.idUsuario=uda.idUsuario');
        $this->db->join('ubicacionusuario uu', 'uda.idUsuarioDato=uu.idUsuarioDato', 'left');
        $this->db->join('giroempresa ge', 'ud.idUsuarioDetalle=ge.idUsuarioDetalle', 'left');
        $this->db->join('giro g', 'ge.giroID=g.giroID', 'left');

        $this->db->join("estado es", "p.estadoID=es.estadoID");
        $this->db->join("fotospublicacion fp", "p.publicacionID=fp.publicacionID", 'left');
        $this->db->join("videos vi", "p.publicacionID=vi.publicacionID", 'left');

        $this->db->where("p.aprobada", 1);
        $this->db->where("p.vigente", 1);
        $this->db->where('u.status', 1);
        $this->db->group_by('p.publicacionID');

        if (!is_null($seccion)) {
            $this->db->where("p.seccion", $seccion);
        }

        /**
         * Se limita el uso de este campo por que no se condera que deba usarse.
         */
        /*
        if (!is_null($tipo_usuario)) {
            $this->db->where('u.tipoUsuario', $tipo_usuario);
            $this->db->where('ud.tipoUsuario', $tipo_usuario);
        }*/

        if (!is_null($giro)) {
            $this->db->where('g.giroID', $giro);
        }

        if (!is_null($estado)) {
            $this->db->where("( ud.idEstado= $estado OR uda.estadoID = $estado OR uu.estadoID = $estado )");
        }

        if (!is_null($palabraclave)) {

            $clause = "(ud.nombreNegocio like '%" . $palabraclave . "%'";
            $clause .= "OR g.nombreGiro like '%" . $palabraclave . "%'";
            $clause .= "OR u.telefono like '%" . $palabraclave . "%'";
            $clause .= "OR ud.idUsuario like '%" . $palabraclave . "%'";
            $clause .= "OR ud.calle like '%" . $palabraclave . "%'";
            $clause .= "OR ud.colonia like '%" . $palabraclave . "%'";
            $clause .= "OR ud.cp like '%" . $palabraclave . "%'";
            $clause .= "OR ud.descripcion like '%" . $palabraclave . "%')";

            /**
             * palabraclave buscar en nombre del estado, debe de hacerse?
             *
             */
            /**
             * TODO Se deben pasar los parametros NULL, FALSE al metodo where?
             */
            $this->db->where($clause);
        }

        if (!is_null($id)) {
            $this->db->where('u.idUsuario', $id);

            return $this->db->get()->row();
        }

$this->output->enable_profiler(FALSE);
        $resultSet = $this->db->get();
        return array('data' => $resultSet->result(), 'count' => $resultSet->num_rows);

    }

    /**
     *
     * @param array $data
     * @param int $key
     */
    function update_values($table, $data, $field_key = array())
    {

        foreach ($field_key as $field => $key) {
            $this->db->where($field, $key);
        }
        $this->db->update($table, $data);
    }

    function insert_values($data)
    {
        foreach ($data as $table => $rows) {
            foreach ($rows as $row) {
                $this->db->insert($table, $row);
            }
        }
    }

    function delete_values($table, $field_key = array())
    {
        foreach ($field_key as $field => $key) {
            $this->db->where($field, $key);
        }
        $this->db->delete($table);
    }

    function getCostoEnvio($estadoID){
         $query = $this->db->query('select costo from grupoenvio join destinoenvio on destinoenvio.grupoID = grupoenvio.grupoID where destinoenvio.estadoID = '.$estadoID.'
limit 1');
        if ($query->num_rows() == 1) {
            $costo = $query->row();
            return $costo = $costo->costo;
        } else {
            return null;
        }
    }

    function getFav($publicacionID){
        $this->db->where('publicacionID',$publicacionID);
        $this->db->where('idUsuario',$this->session->userdata('idUsuario'));
        $query = $this->db->get('favoritos');
        if ($query->num_rows() >= 1) {
            return true;
        } else {
            return false;
        }

    }

    function updateDireccion($data, $idUsuario){
        $query = $this -> db -> get_where('direccionenvio', array('idUsuario' => $idUsuario));
        if ($query -> num_rows() == 1) {
            $this -> db -> where('idUsuario', $idUsuario);
            $this -> db -> update('direccionenvio', $data);
            return true;
        } else {
            $this -> db -> insert('direccionenvio', $data);
            return true;
        }
    }

    function getIDDetalle($idUsuario){
        $this->db->where('idUsuario',$idUsuario);
        $query = $this->db->get('usuariodetalle');
        if ($query->num_rows() == 1) {
            $detalle = $query->row();
            return $detalle = $detalle->idusuarioDetalle;
        } else {
            return null;
        }

    }
}

?>