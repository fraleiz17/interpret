<?php
if (!defined('BASEPATH'))
	die();

class Registro extends CI_Controller {

	function __construct() {
		parent::__construct();
		/*if (is_logged() && $this->session->userdata('manuallyLogged')) 
			redirect('principal');*/
		$this->load->model('usuario_model');
		$this->load->library('user_agent');/*DATOS DEL NAVEGADOR UTILIZADO*/
		$this->load->model('email_model');
		$this->load->model('file_model');
		$this->load->model('defaultdata_model');
		$this->load->helper(array('form', 'url'));
		$this->load->model('defaultdata_model');
	}

	function index() {
		$data['SYS_metaTitle']       = '';
		$data['SYS_metaKeyWords']    = '';
		$data['SYS_metaDescription'] = '';
		//var_dump($data);

		$this->load->view('registro_view', $data);
	}

	

	function isthereemail() {
		/*EXISTE EL EMAIL EN LA DB?*/
		$validateValue=$this->input->post('fieldValue');
		$validateId= $this->input->post('fieldId');

		$emailUsuario = $this->input->post('fieldValue');
		$emailUsuario_ = $this->input->post('fieldValue');
		$emailUsuario = str_replace('_', '@', $emailUsuario);

		$arrayToJs = array();
		$arrayToJs[0] = $validateId;
		if (!$this->usuario_model->is_there_emailUsuario($emailUsuario)) {
			$arrayToJs[1] = true;
			echo json_encode($arrayToJs);
		} else {
			$arrayToJs[1] = false;
			echo json_encode($arrayToJs);
		}
	}

	function registrar() {	
			
		$emailUsuario = $this->input->get('correo');
		$tipoUsuario = $this->input->get('radiog_dark');
		if($tipoUsuario == 1){ $nivel=1; } elseif ($tipoUsuario == 2) {
			$nivel=2; } else {$nivel = 3;}

		$confirmationCode = $this->usuario_model->getNewConfirmationCode($emailUsuario);
		$recepcionCorreo = $this->input->get('recibirCorreo');
		if($recepcionCorreo != 1){$recepcionCorreo = 0;}
		$dataRegister = array(
  				'nombre' => $this->input->get('nombre'),
  				'apellido' => $this->input->get('apellido'),
  				'telefono' => $this->input->get('telefono'),
  				'correo' => $this->input->get('correo'),
  				'contrasena' => $this->input->get('contrasena'),
  				'recepcionCorreo' => $this->input->get('recibirCorreo'), //1 - recepción de correo activa\n 0 - recepción de correo inactiva',
  				'tipoUsuario' => $this->input->get('radiog_dark'), // '0 - Administrador\n1 - usuario normal\n2 - negocio\n3 - AC',
  				'status'  => 0, //'0 - no activado\n1 - activo',
  				'nivel' => $nivel,
				'fechaRegistro' => date('Y-m-d H:i:s', time()),
				'codigoConfirmacion' => $confirmationCode);

		
		$idUsuario = $this->usuario_model->registrarUsuario($dataRegister);

		$mensajePlano = 'Hola '.$this->input->get('nombre').'<br><br>
					Gracias por registrarte en QUP.<br><br>
					Activa tu cuenta con el siguiente link:<br><br><br><br>			
					<a href="'.base_url().'registro/activar/'.$confirmationCode.'">Activar cuenta QUP</a>';


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
<tr>
<td align="center"><h4 style=" font-family:Verdana, Geneva, sans-serif; font-size:14px; padding-left:15px;">¡Bienvenido a QuieroUnPerro.com!</h4></td>
</tr> 
<tr>
<td style="padding-left:15px;"> 
<font style=" font-family:Verdana, Geneva, sans-serif; margin-top:100px; font-size:13px; font-weight:bold; color:#6A2C91; " >Hola '.$this->input->get('nombre').': </font>
<br/>
<br/>

<font style="font-family:Verdana, Geneva, sans-serif; font-size:13px;">
Gracias por registrate en QuieroUnPerro.com<br/>
Tu usuario ha sido creado correctamente. Te recordamos tus datos de inicio de sesi&oacute;n:<br/><br/>
Correo: '.$this->input->get('correo').' <br/>
Contrase&ntilde;a: * Por seguridad no se muestra. En caso de olvidarla sol&iacute;citala en el portal.<br/><br/>
Para poder comenzar a disfrutar de todas las herramientas del portal, valida tu cuenta haciendo clic <a href="'.base_url().'registro/activar/'.$confirmationCode.'">aqu&iacute;</a> o copia esta direcci&oacute;n en el explorador:<br/><br/>

'.base_url().'registro/activar/'.$confirmationCode.'
<br/><br/>

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

		if($this->email_model->send_email('', $emailUsuario, 'Gracias por registrarte en QUP', $mensaje)){
			$data['response'] = true;
			$data['message'] = "Su registro se ha guardado con éxito, favor de revisar su correo para activar su usuario";
		}
		else{
			$data['response'] = false;
			$data['message'] = "Ocurrió un error intentelo nuevamente";
		}

		switch ($tipoUsuario) {
			case 1:
				$arrData = array(
					'idUsuario' => $idUsuario,
  					'razonSocial' => $this->input->get('razon'),
  					'rfc'  => $this->input->get('RFC'),
  					'calle' => $this->input->get('calle'),
  					'noInterior'  => $this->input->get('no_interior'),
  					'noExterior'  => $this->input->get('no_exterior'),
  					'cp'  => $this->input->get('cp'),
  					'municipio'  => $this->input->get('municipio'),
  					'estadoID'  => $this->input->get('estado'),
  					'idPais' => $this->input->get('pais')
				);
				$idUsuarioDato = $this->usuario_model->registrarDato($arrData,'usuariodato');
				$data['response'] = true;
			break;

			case 2:
				$arrData = array(
					'idUsuario' => $idUsuario,
  					'razonSocial' => $this->input->get('razonN'),
  					'rfc'  => $this->input->get('RFCN'),
  					'calle' => $this->input->get('calleN'),
  					'noInterior'  => $this->input->get('no_interiorN'),
  					'noExterior'  => $this->input->get('no_exteriorN'),
  					'cp'  => $this->input->get('cpN'),
  					'municipio'  => $this->input->get('municipioN'),
  					'estadoID'  => $this->input->get('estadoN'),
  					'idPais' => $this->input->get('paisN')
				);
				$idUsuarioDato = $this->usuario_model->registrarDato($arrData,'usuariodato');

				

				$arrDatoDetalle = array(
				    'idUsuario' => $idUsuario,
  					'tipoUsuario' => $tipoUsuario,
  					'nombreNegocio' => $this->input->get('nombre_negocio'),
  					'nombreContacto' => $this->input->get('nombre_contactoN'),
  					'telefono' => $this->input->get('telefonoN1'),
  					'calle' => $this->input->get('calleN1'),
  					'numero'  => $this->input->get('numN1'),
  					'idEstado' => $this->input->get('estadoN1'),
  					'colonia'  => $this->input->get('coloniaN1'),
  					'cp'  => $this->input->get('cpN1'),
  					'correo' => $this->input->get('correoN1'),
  					'paginaWeb' => $this->input->get('pagina_webN1'),
  					'logo' => '',
  					'descripcion'  => $this->input->get('descripcionN1')
  				);
  				$idUsuarioDetalle = $this->usuario_model->registrarDato($arrDatoDetalle,'usuariodetalle');
			
  				$giro = $this->input->get('CheckboxGroup1');
				if( $giro != null){
					for($i=0;$i<=count($giro)-1;$i++){
						
						if($giro[$i] != '0'){
        		        $arrGiro= array(
        		            'idUsuarioDetalle'   => $idUsuarioDetalle,
        		            'giroID' => $giro[$i]
       		        	);
        		        	$e = $this->usuario_model->registrarDato($arrGiro,'giroempresa');
        		        	//var_dump($e);
        		    	}
        		        $arrGiro = null;
        		    }
				}

				$estado = $this->input->get('estadoN1');
				if($estado != '---'){
  				$zonaGeografica = $this->usuario_model->zonaGeografica($estado);
  				$zona = $zonaGeografica->zonageograficaID;
  				} else {
  					$zona = null;
  				}

  				$casificacionGeografica = array(
  					'tipoUsuario' => $tipoUsuario,
  					'idUsuarioDato' => $idUsuarioDato,
  					'latitud' => $this->input->get('newLat'),
  					'longitud' => $this->input->get('newLng'),
  					'estadoID' => $estado,
  					'zonageograficaID' => $zona
  					);
  				$ubicacionUsuarioID = $this->usuario_model->registrarDato($casificacionGeografica,'ubicacionusuario');
  				//var_dump($ubicacionUsuarioID);

				$data['response'] = true;

			break;

			case 3:
				$arrData = array(
					'idUsuario' => $idUsuario,
  					'razonSocial' => $this->input->get('razonAC'),
  					'rfc'  => $this->input->get('RFCAC'),
  					'calle' => $this->input->get('calleAC'),
  					'noInterior'  => $this->input->get('no_interiorAC'),
  					'noExterior'  => $this->input->get('no_exteriorAC'),
  					'cp'  => $this->input->get('cpAC'),
  					'municipio'  => $this->input->get('municipioAC'),
  					'estadoID'  => $this->input->get('estadoAC'),
  					'idPais' => $this->input->get('paisAC')
				);
				$idUsuarioDato = $this->usuario_model->registrarDato($arrData,'usuariodato');

				


				$arrDatoDetalle = array(
				    'idUsuario' => $idUsuario,
  					'tipoUsuario' => $tipoUsuario,
  					'nombreNegocio' => $this->input->get('nombre_ac'),
  					'giro' => $this->input->get('giroAC1'),
  					'nombreContacto' => $this->input->get('nombre_contactoAC1'),
  					'telefono' => $this->input->get('telefonoAC1'),
  					'calle' => $this->input->get('calleAC1'),
  					'numero'  => $this->input->get('numAC1'),
  					'idEstado' => $this->input->get('estadoAC1'),
  					'colonia'  => $this->input->get('coloniaAC1'),
  					'cp'  => $this->input->get('cpAC1'),
  					'correo' => $this->input->get('correoAC1'),
  					'paginaWeb' => $this->input->get('pagina_webAC1'),
  					'logo' => '',
  					'descripcion'  => $this->input->get('descripcionAC1')
  				);
  				$idUsuarioDetalle = $this->usuario_model->registrarDato($arrDatoDetalle,'usuariodetalle');

  				$estado = $this->input->get('estadoAC1');
  				if($estado != '---'){
  				$zonaGeografica = $this->usuario_model->zonaGeografica($estado);
  				$zona = $zonaGeografica->zonageograficaID;
  				} else {
  					$zona = null;
  				}

  				$casificacionGeografica = array(
  					'tipoUsuario' => $tipoUsuario,
  					'idUsuarioDato' => $idUsuarioDato,
  					'estadoID' => $estado,
  					'zonageograficaID' => $zona
  					);
  				$ubicacionUsuarioID = $this->usuario_model->registrarDato($casificacionGeografica,'ubicacionusuario');
  				//var_dump($ubicacionUsuarioID);
  				$data['response'] = true;
				
			break;

			
		}

		$data['url'] = base_url();
		$data['registro'] = true;
		$data['cambioContrasena'] = false;
		echo json_encode($data);


     
	}

	function activacion($result) {
		$data['SYS_metaTitle'] = '';
		$data['SYS_metaKeyWords'] = '';
		$data['SYS_metaDescription'] = '';
		

		switch($result) {
			case 'usuario-activado' :
				if($this->session->userdata('tipoUsuario')==1){
				redirect('usuario/cuenta/activado');
				} 
				if ($this->session->userdata('tipoUsuario')==2) {
					redirect('negocio');
				}
				if ($this->session->userdata('tipoUsuario')==3) {
					redirect('asociacion');
				}
				if ($this->session->userdata('tipoUsuario')==0) {
					redirect('admin');
				}
				
				break;
			case 'usuario-activo' :
				$data['mensaje'] = 'Este usuario ya ha sido activado anteriormente, puedes iniciar sesión desde la página principal.';
				$data['errorActivo'] = true;
				break;
			case 'error' :
				$data['mensaje'] = 'Lamentablemente, el código de confirmación que intentas activar no existe, verifica que hayas dado
					                clic en el enlace correcto o solicita un nuevo código de confirmación.</a>';
				$data['errorActivo2'] = true;
				break;
		}
		$e = $this->usuario_model->myID($this->session->userdata('idUsuario'));
		
		$f = $this->usuario_model->myInfo($this->session->userdata('idUsuario'));
		$g = $this->usuario_model->miUbicacion($this->session->userdata('idUsuarioDato'));

		$data['SYS_metaTitle'] 			= '';
		$data['SYS_metaKeyWords'] 		= '';
		$data['SYS_metaDescription'] 	= '';  
		$data['estados'] 	= $this->defaultdata_model->getEstados();
		$data['paises'] 	= $this->defaultdata_model->getPaises();
		$data['mapaSegundo'] = 'mapa_view';
		
		// mapa
		

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
   
		// set up the marker ready for positioning 
		// once we know the users location
		$marker = array();
		$marker['draggable'] = true;
		$marker['ondragend'] = 'updateDatabase(event.latLng.lat(), event.latLng.lng());';
		//$marker['ondragend'] = 'alert(\'You just dropped me at: \' + event.latLng.lat() + \', \' + event.latLng.lng());';
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		//var_dump($data['map']);

		$this->load->view('index_view', $data);
	}     

	function activar($activationCode) {
		switch($this->usuario_model->activar($activationCode)) {
			case 1 :
				redirect('registro/activacion/usuario-activado');
				// die('Mission Success, Objective Completed ;D');
				break;
			case 0 :
				redirect('registro/activacion/usuario-activo');
				// die('Ya ha sido activado este usuario');
				break;
			case -1 :
				redirect('registro/activacion/error');
				// die('No existe ese codigo carnal :(');
				break;
		}
	}

	function nuevocodigo() {
		/*GENERAR NUEVO CODIGO DE ACTIVACION*/
		$data['SYS_metaTitle'] = '';
		$data['SYS_metaKeyWords'] = '';
		$data['SYS_metaDescription'] = '';

		//datos dinámicos
		$css = array();
		$css[] = 'Jvalidate.v03';

		$js = array();
		$js[] = 'jvalidate.v03';

		$data['total_ofertas_activas'] = $this->vacante_model->getTotalVacantes(true);
		$data['estados'] = $this->defaultdata_model->getEstados();
		$data['css'] = $css;
		$data['js'] = $js;

		$this->load->view('publico/main_view', $data);
	}

	function nuevocodigo_do() {
		/*INSERTAMOS NUEVO CODIGO EN EL USUARIO ESPECIFICADO*/
		$this->form_validation->set_rules('emailUsuario', 'Usuario', 'trim|required|xss_clean');
		$this->form_validation->set_message('required', 'El campo "%s" es requerido');
		$this->form_validation->set_message('xss_clean', 'El campo "%s" contiene un posible ataque XSS');
		$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
		if (!$this->form_validation->run()) {
			$this->session->set_flashdata('error', 'inputBadSyntax');
			redirect('registro');
			return false;
		} else {
			echo $this->getNewConfirmationCode($this->input->post('emailUsuario'));
		}
	}

	function meh(){
		$e = $this->usuario_model->myID(27);
		$e->idUsuario;
		$f = $this->usuario_model->myInfo(27);
		$ddd = $this->usuario_model->miUbicacion(34);

	}

	
	

}
?>
