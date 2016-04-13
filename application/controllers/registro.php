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
		
		$emailUsuario = $this->input->post('correo');
		$emailUsuario = str_replace('_', '@', $emailUsuario);

		
		if (!$this->usuario_model->is_there_emailUsuario($emailUsuario)) {
			$data['existe'] = true;
		} else {
			$data['existe'] = false;
			
		}

		echo json_encode($data);
	}

	function registrar() {	
		$emailUsuario = $this->input->post('correo');
		$tipoUsuario = $this->input->post('tipoUsuario');
		if($tipoUsuario == 1){ $nivel= 1; } elseif ($tipoUsuario == 2) {
			$nivel=2; } else { $nivel = 1;}

		$confirmationCode = $this->usuario_model->getNewConfirmationCode($emailUsuario);
		
		$dataRegister = array(
  				'nombre' => $this->input->post('nombre'),
  				'apellidoPaterno' => $this->input->post('apellido'),
  				'apellidoMaterno' => $this->input->post('apellidoMaterno'),
  				'correo' => $this->input->post('correo'),
  				'contrasena' => $this->input->post('contrasena'),
  				'tipoUsuario' => $this->input->post('tipoUsuario'), // '0 - Administrador\n1 - usuario normal\n2 - interprete',
  				'status'  => 0, //'0 - no activado\n1 - activo',
  				'nivel' => $nivel,
				'fechaRegistro' => date('Y-m-d H:i:s', time()),
				'codigoConfirmacion' => $confirmationCode);

		
		$idUsuario = $this->usuario_model->registrarUsuario($dataRegister);

		$mensajePlano = 'Hola '.$this->input->get('nombre').'<br><br>
					Gracias por registrarte en Interpretes.<br><br>
					Activa tu cuenta con el siguiente link:<br><br><br><br>			
					<a href="'.base_url().'registro/activar/'.$confirmationCode.'">Activar cuenta Interpretes</a>';


		

		if($this->email_model->send_email('', $emailUsuario, 'Gracias por registrarte en Interpretes', $mensajePlano)){
			$data['response'] = true;
			$data['message'] = "Éxito, favor de revisar su correo para activar su usuario";
		}
		else{
			$data['response'] = false;
			$data['message'] = "Ocurrió un error intentelo nuevamente";
		}

		$data['url'] = base_url();
		$data['registro'] = true;
		$data['cambioContrasena'] = false;
		echo json_encode($data);
	}

	function registrar_() {	
			
		
		$emailUsuario = $this->input->post('correo');
		$tipoUsuario = $this->input->post('tipoUsuario');
		if($tipoUsuario == 1){ $nivel= 1; } elseif ($tipoUsuario == 2) {
			$nivel=2; } else { $nivel = 1;}

		$confirmationCode = $this->usuario_model->getNewConfirmationCode($emailUsuario);
		
		$dataRegister = array(
  				'nombre' => $this->input->post('nombre'),
  				'apellido' => $this->input->post('apellido'),
  				'apellidoMaterno' => $this->input->post('apellido'),
  				'telefono' => $this->input->post('telefono'),
  				'correo' => $this->input->post('correo'),
  				'contrasena' => $this->input->post('contrasena'),
  				'tipoUsuario' => $this->input->post('tipoUsuario'), // '0 - Administrador\n1 - usuario normal\n2 - interprete',
  				'status'  => 0, //'0 - no activado\n1 - activo',
  				'nivel' => $nivel,
				'fechaRegistro' => date('Y-m-d H:i:s', time()),
				'codigoConfirmacion' => $confirmationCode);

		
		$idUsuario = $this->usuario_model->registrarUsuario($dataRegister);

		$mensajePlano = 'Hola '.$this->input->get('nombre').'<br><br>
					Gracias por registrarte en Interpretes.<br><br>
					Activa tu cuenta con el siguiente link:<br><br><br><br>			
					<a href="'.base_url().'registro/activar/'.$confirmationCode.'">Activar cuenta Interpretes</a>';


		

		if($this->email_model->send_email('', $emailUsuario, 'Gracias por registrarte en Interpretes', $mensajePlano)){
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
				redirect('usuario/cuenta');
				} 
				if ($this->session->userdata('tipoUsuario')==2) {
					redirect('interprete/cuenta');
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
		

	

		$this->load->view('index_view', $data);
	}     

	function activar($activationCode) {
		echo $activationCode;
		var_dump($this->usuario_model->is_there_activation_code($activationCode));

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
		var_dump($this->email_model->send_email('', 'ntest111@mailinator.com', 'Gracias por registrarte en Interpretes_ beta', 'Mensaje'));

	}

	
	

}
?>
