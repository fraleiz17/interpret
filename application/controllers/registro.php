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
  				'sexo' => $this->input->post('sexo'),
  				'contrasena' => $this->input->post('contrasena'),
  				'tipoUsuario' => $this->input->post('tipoUsuario'), // '0 - Administrador\n1 - usuario normal\n2 - interprete',
  				'status'  => 0, //'0 - no activado\n1 - activo',
  				'nivel' => $nivel,
				'fechaRegistro' => date('Y-m-d H:i:s', time()),
				'codigoConfirmacion' => $confirmationCode);

		
		$idUsuario = $this->usuario_model->registrarUsuario($dataRegister);


		$mensajePlano = 'Hola '.$this->input->post('nombre').'<br><br>
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

		$this->usuario_model->insertItem('usuariodato', $dataUsuariodato  = array('usuarioID' => $idUsuario));

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
				$this->session->set_flashdata('error_login', 'Este usuario ya ha sido activado anteriormente, puedes iniciar sesión desde la página principal.');
				redirect('principal');
				break;
			case 'error' :
				$this->session->set_flashdata('error_login', 'Tu registro ha fallado, inténtalo nuevamente');
				redirect('principal');
				break;
		}
		

	
		redirect('principal');
		//$this->load->view('index_view', $data);
	}     

	function activar($activationCode) {
		//echo $activationCode;
		//var_dump($this->usuario_model->is_there_activation_code($activationCode));

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

	
	

	function meh(){
		var_dump($this->email_model->send_email('', 'ntest111@mailinator.com', 'Gracias por registrarte en Interpretes_ beta', 'Mensaje'));

	}

	
	

}
?>
