<?php
if (!defined('BASEPATH'))
        die();

class Cuenta extends CI_Controller {
    
  
    var $idUsuario="";

        public function __construct(){
        parent::__construct();
        if(!is_logged()&&$this->session->userdata('tipoUsuario')!=2){
            $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $redir = str_replace('/', '-', uri_string().$query);
            redirect('principal');
        } // checamos si existe una sesión activa           
       
        $this->load->model('defaultdata_model');
        $this->load->model('usuario_model');
        $this->load->model('email_model');
        $this->load->helper(array('form', 'url'));

        if (!is_authorized(array(2), 2, $this->session->userdata('nivel'), $this->session->userdata('rol'))) {
                $this->session->set_flashdata('error', 'userNotAutorized');
                redirect('principal');
        }

        }

        //is_authorized($nivelesReq, $idPermiso, $nivelUsuario, $rolUsuario)
        
    
    
    public function index() {
        $data['SYS_metaTitle']          = '';
        $data['SYS_metaKeyWords']       = '';
        $data['SYS_metaDescription']    = '';  
        

        $this->load->view('interprete/index_view', $data);
    }


   

    
    function myProfile(){
        $data['SYS_metaTitle']          = '';
        $data['SYS_metaKeyWords']       = '';
        $data['SYS_metaDescription']    = '';  
        $data['myInfo']    = $this->usuario_model->getMyInfo($this->session->userdata('idUsuario'));
        $data['banner'] = $this->defaultdata_model->getBannerS(5);
        $data['info']     = $this->usuario_model->getInfoCompleta($this->session->userdata('idUsuario'));
        $data['seccion'] = 5;
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['paquetes'] = $this->defaultdata_model->getPaquetes();
        $data['razas'] = $this->defaultdata_model->getRazas();
        if(is_logged()){
            $cupones = $this->usuario_model->getCuponesUsuario($this->session->userdata('idUsuario'));
            $data['cupones'] = $cupones;
        }
        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $data['seccion'] = 5;
        $data['banner'] = $this->defaultdata_model->getBannerS(5);
        $data['carritoT'] = count ($this->admin_model->getCarrito($this->session->userdata('idUsuario')));
        $this->borrarFallidos();
        $this->load->view('usuario/myprofile_view',$data);
    }

    function miPerfil(){
        $data['myInfo']    = $this->usuario_model->getMyInfo($this->session->userdata('idUsuario'));
        $data['info']     = $this->usuario_model->getInfoCompleta($this->session->userdata('idUsuario'));
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['fiscData'] = $this->perfil_model->infoFiscal($this->session->userdata('idUsuario'));
        $data['paises']     = $this->defaultdata_model->getPaises();

        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $this->load->view('usuario/perfil/mi_perfil_view',$data);
    }

    function updateMiPerfilB(){
        //var_dump($_POST);
         $data = array(
            'nombre' => $this->input->post('nombre'), 
            'apellido' => $this->input->post('apellido'), 
            'correo' => $this->input->post('correo'), 
            'telefono' => $this->input->post('telefono')
        );

         $this->perfil_model->updateItem('idUsuario', $this->session->userdata('idUsuario'), $data, 'usuario');

        $dataD = array(
            'estadoID' => $this->input->post('estadoID'), 
        );
        $this->perfil_model->updateItem('idUsuario', $this->session->userdata('idUsuario'), $dataD, 'usuariodato');
        redirect('usuario/cuenta/myProfile');
        //$this->perfil_model->updateItem($itemID, $ID, $data, $tabla)
    }

    function updateMiPerfilF(){
        $data= array(
            'razonSocial'=> $this->input->post('razon'),
            'rfc'=> $this->input->post('RFC'),
            'calle'=> $this->input->post('calle'),
            'noExterior'=> $this->input->post('no_exterior'),
            'cp'=> $this->input->post('cp'),
            'municipio'=> $this->input->post('municipio'),
            'estadoID'=> $this->input->post('estadoID'),
            'idPais'=> $this->input->post('paisID')
        );
        $this->perfil_model->updateItem('idUsuario', $this->session->userdata('idUsuario'), $data, 'usuariodato');
        redirect('usuario/cuenta/myProfile');

    }


    function anuncios(){
        $data['myInfo']    = $this->usuario_model->getMyInfo($this->session->userdata('idUsuario'));
        $data['info']     = $this->usuario_model->getInfoCompleta($this->session->userdata('idUsuario'));
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['anuncios'] = $this->perfil_model->getAnuncios($this->session->userdata('idUsuario'));
        $data['anunciosAct'] = $this->perfil_model->getAnunciosAct($this->session->userdata('idUsuario'));
        $data['anunciosInAct'] = $this->perfil_model->getAnunciosInAct($this->session->userdata('idUsuario'));
        //$data['estados']    = $this->defaultdata_model->getEstados();
        $data['paquetes'] = $this->defaultdata_model->getPaquetes();
        $data['razas'] = $this->defaultdata_model->getRazas();
        $data['seccion'] = 5;
        $data['banner'] = $this->defaultdata_model->getBannerS(5);
        if(is_logged()){
            $cupones = $this->usuario_model->getCuponesUsuario($this->session->userdata('idUsuario'));
            $data['cupones'] = $cupones;
        }


        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $this->load->view('usuario/perfil/anuncios_view',$data);
    }

    function mensajes(){
        $data['myInfo']    = $this->usuario_model->getMyInfo($this->session->userdata('idUsuario'));
        $data['info']     = $this->usuario_model->getInfoCompleta($this->session->userdata('idUsuario'));
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['mensajes'] = $this->perfil_model->getMensajes($this->session->userdata('idUsuario'));

        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $this->load->view('usuario/perfil/mensajes_view',$data);
    }

    function cupones(){
        $data['myInfo']    = $this->usuario_model->getMyInfo($this->session->userdata('idUsuario'));
        $data['info']     = $this->usuario_model->getInfoCompleta($this->session->userdata('idUsuario'));
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['cupones'] = $this->perfil_model->getCupones($this->session->userdata('idUsuario'));

        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $this->load->view('usuario/perfil/cupones_view',$data);
    }

    function favoritos(){
        $data['myInfo']    = $this->usuario_model->getMyInfo($this->session->userdata('idUsuario'));
        $data['info']     = $this->usuario_model->getInfoCompleta($this->session->userdata('idUsuario'));
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['razas'] = $this->perfil_model->getRazas();
        $data['favoritos'] = $this->perfil_model->getFavoritos($this->session->userdata('idUsuario'));
        
        $data['seccion'] = 5;

        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $this->load->view('usuario/perfil/favoritos_view',$data);
    }

    function soporte(){
        $data['banner'] = $this->defaultdata_model->getBannerS(5);
        $data['seccion'] = 5;
        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $this->load->view('usuario/perfil/soporte_view',$data);
    }

    function correoSoporte(){
        $correo = $this->session->userdata('correo');
        $asunto = $this->input->post('asunto');
        $descripcion = $this->input->post('descripcion');
        $destino = 'soporte@quierounperro.com';//'administrador.soporte@quierounperro.com';
        $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <title>Bienvenido-QuieroUnPerro.com</title>
            <link rel="stylesheet" href="http://quierounperro.com/quiero_un_perro/css/general.css" type="text/css" media="screen" />
        </head>

        <body>
            <table width="647" align="center">
                <tr>
                    <td width="231" rowspan="2">
                        <img src="http://quierounperro.com/psk/images/logo_mail.jpg"/>
                    </td>
                    <td height="48" colspan="6" style="font-family: \'titulos\'; font-size:50px; color:#72A937; margin:0px; padding:0px; margin-bottom:-10px;">
                        QUP Contacto
                    </td>
                </tr>
                <tr>
                    <td colspan="7" >
                        <p>&nbsp;  </p>
                        <font style="margin-top:100px; font-size:19px; font-weight:bold; color:#72A937;" >Hola!! </font>
                    </br>
                </br>

                <font> El usuario ' . $this->session->userdata('nombre') . ' ' . $this->session->userdata('apellido') . ' ha enviado el siguiente correo:</font>
            </br>
        </br>

        <font color="#000066"><strong> Asunto: ' . $asunto . '</strong></font><br>
        <font color="#000066"><strong>Mensaje: </strong><br/>' . $descripcion . '</font>
        <br/>
        <p> </p>
    </td>
</tr>

<tr bgcolor="#6A2C91" >
    <td colspan="7" >
        <font style=" font-size:14px; padding-left:15px; color:#FFFFFF;">Gracias por tu preferencia </font>
        <br/>
        <font style=" font-size:12px; padding-left:15px; color:#FFFFFF;"> Equipo QUP </font>
    </td>
</tr>
</table>
</body>
</html>';
    
    if($this->email_model->send_email($correo, $destino, $asunto,$mensaje)){
        $data['response'] = true;
    } else {
        $data['response'] = false;
    }
         echo json_encode($data);

    }

    function facturas(){
        $data['myInfo']    = $this->usuario_model->getMyInfo($this->session->userdata('idUsuario'));
        $data['info']     = $this->usuario_model->getInfoCompleta($this->session->userdata('idUsuario'));
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['facturas'] = $this->perfil_model->getFacturas($this->session->userdata('idUsuario'));
        $data['compras'] = $this->perfil_model->getCompras($this->session->userdata('idUsuario'));

        if($this->session->userdata('tipoUsuario') == 2 || $this->session->userdata('tipoUsuario') == 3){
            $data['ubicacion'] = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));
            $data['giro'] = $this->usuario_model->getGiro($this->session->userdata('idUsuarioDetalle'));
        }
        $this->load->view('usuario/perfil/facturas_view',$data);
    }



    
    function editar_contrasena() {       
            if ($this -> usuario_model -> passRecover($this -> input -> post('contrasena1'), $this -> session -> userdata('idUsuario'))) {
               
                $mensaje = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notificacion-QuieroUnPerro.com</title>

</head>

<body>
<table width="647" align="center">
<tr>
<td width="231" height="129" colspan="2" valign="top">
<img src="http://quierounperro.com/psk/images/logo_mail.jpg"/>
</td>
</tr>
<!-- <tr>
<td align="center"><h4 style=" font-family:Verdana, Geneva, sans-serif; font-size:14px; padding-left:15px;">¡Bienvenido a QuieroUnPerro.com!</h4></td>
</tr> -->
<tr>
<td style="padding-left:15px;"> 
<font style=" font-family:Verdana, Geneva, sans-serif; margin-top:100px; font-size:13px; font-weight:bold; color:#6A2C91; " >Hola '.$this->session->userdata('nombre').': </font>
<br/>
<br/>

<font style="font-family:Verdana, Geneva, sans-serif; font-size:13px;">
Te informamos que ha cambiado la contraseña de tu cuenta en QUP<br/><br/>
Cualquier duda, escr&iacute;benos a contacto@quierounperro.com
</font>
<p> </p>
</td>
</tr>

<tr>
<td colspan="7" >
<font style=" font-family:Verdana, Geneva, sans-serif; font-size:14px; padding-left:15px;"> ¡Muchas Gracias! </font>
<br/>
<font style=" font-family:Verdana, Geneva, sans-serif; font-size:12px; padding-left:15px;"> El Equipo de QuieroUnPerro.com </font>
<br/>
<font style=" font-family:Verdana, Geneva, sans-serif; font-size:10px; padding-left:15px;"> Todos los derechos reservados '.date('Y').' </font>
</td>
</tr>
</table>



</body>
</html>
';

        $this->email_model->send_email('', $this->session->userdata('correo'), 'Has cambiado tu contraseña en QUP', $mensaje);
                $data['response'] = true;
                $this->session->set_userdata('recuperarusuario',false);
            } else {
               $data['response'] = false;
            }
        echo json_encode($data);

    }

    function publicacion(){
        $publicacionID = $this->input->post('publicacionID');
        $data['response'] ='true';
        $data = array();
        $publicacion = $this->perfil_model->getPublicacion($publicacionID);
        if($publicacion != null){
        foreach($publicacion as $k => $v){
            $data[$k] = $v;
        }
        $data['response'] ='true';
        }
        echo json_encode($data);
    }

    function imagenes(){
        $publicacionID = $this->input->post('publicacionID');
        $data['response'] ='true';
        $data = array();
        $publicacion = $this->perfil_model->getImagenes($publicacionID);
        if($publicacion != null){
        foreach($publicacion as $k => $v){
            $data[$k] = $v;
        }
        $data['response'] ='true';
        }
        echo json_encode($data);
    }

    function cancelarAnuncio(){
        $publicacionID = $this->input->post('publicacionID');
        $cancelar = $this->perfil_model->updateItem('publicacionID', $publicacionID,array('vigente' => 0, ),'publicaciones');
        if($cancelar){
            $data['response'] ='true';
        } else {
            $data['response'] ='false';
        }

            echo json_encode($data);
        
        }

        function borrarFallidos(){
        $compras = $this->defaultdata_model->comprasFallidas();
        if($compras != null){
            foreach ($compras as $c) {
                
                $this->defaultdata_model->deleteItem('compraID', $c->compraID, 'compradetalle');
                $this->defaultdata_model->deleteItem('compraID', $c->compraID, 'compra');
                
            }
        }

        $servicios = $this->defaultdata_model->publicacionesFallidas();
        if($servicios != null){
            foreach ($servicios as $s) {
                $this->defaultdata_model->deleteItem('servicioID', $s->servicioID, 'cuponadquirido');
                $this->defaultdata_model->deleteItem('servicioID', $s->servicioID, 'publicaciones');
                $this->defaultdata_model->deleteItem('servicioID', $s->servicioID, 'serviciocontratado');
            }
        }
    }


    function getAnuncioRenovar($id){
       $data['SYS_metaTitle'] = '';
        $data['SYS_metaKeyWords'] = '';
        $data['SYS_metaDescription'] = '';
        $data['estados'] = $this->defaultdata_model->getEstados();
        $data['paises'] = $this->defaultdata_model->getPaises();
        $data['paquetes'] = $this->defaultdata_model->getPaquetes();
        $data['razas'] = $this->defaultdata_model->getRazas();
        $data['giros'] = $this->defaultdata_model->getGiros();
        $data['publicaciones'] = $this->venta_model->getAnuncios(4);
        $data['seccion'] = 4;
        $data['estados']  = $this->defaultdata_model->getEstados();
        $data['paquetes'] = $this->defaultdata_model->getPaquetes();
        //$data['razas'] = $this->defaultdata_model->getRazas();
        $data['carritoT'] = count ($this->admin_model->getCarrito($this->session->userdata('idUsuario')));
        $config = array();
$config['center'] = '19.433463102009004,-99.13711169501954';
$config['zoom'] = 'auto';
$config['onboundschanged'] = 'if (!centreGot) {
var mapCentre = map.getCenter();
marker_0.setOptions({
position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
});
} 
centreGot = true;';
$config['map_name'] = 'map';
$config['map_div_id'] = 'map_canvas';
$this->googlemaps->initialize($config);
$data['map'] = $this->googlemaps->create_map();

// set up the marker ready for positioning 
// once we know the users location
$marker = array();
$marker['draggable'] = true;
$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
//$marker['ondragend'] = 'alert(\'You just dropped me at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';
$this->googlemaps->add_marker($marker);

// mapa


$data['mapaSegundo'] = 'mapa_view'; 
$data['banner'] = $this->defaultdata_model->getBannerS(5);
$data['estados'] = $this->defaultdata_model->getEstados();
$data['paquetes'] = $this->defaultdata_model->getPaquetes();
$data['razas'] = $this->defaultdata_model->getRazas();
$data['zona'] = 9;
$data['carritoT'] = count ($this->admin_model->getCarrito($this->session->userdata('idUsuario')));
$data['carritoT'] = count ($this->admin_model->getCarrito($this->session->userdata('idUsuario')));
$data['paises'] = $this->defaultdata_model->getPaises();


        if(is_logged()){
         $cupones = $this->usuario_model->getCuponesUsuario($this->session->userdata('idUsuario'));
         $data['cupones'] = $cupones;
        } else {
            $data['cupones'] = null;
        }

        
        $id_anuncio = $id;
        $data['publicacion'] = $this->venta_model->getPublicacionR($id_anuncio);
        $this->load->view('renovar_view', $data);
        
        
        
    }

        

}
