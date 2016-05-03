<?php
if (!defined('BASEPATH'))

	exit('No direct script access allowed');

class Recuperar extends CI_Controller {

	function __construct() {
		parent::__construct();
		/*if(is_logged()) {// checamos si existe una sesión activa
			if($this->session->userdata('tipoUsuario')==1){
            	redirect('usuario/cuenta');
            } 
            if ($this->session->userdata('tipoUsuario')==2) {
                redirect('interprete/principal');
            }

            if ($this->session->userdata('tipoUsuario')==0) {
            	redirect('admin');
			}
			redirect('principal');
		}*/
		$this->load->model('defaultdata_model');	
		$this->load->model('auth_model');	
		$this->load->model('usuario_model');
		$this->load->model('email_model');
	}

	public function index() {
		$data['SYS_metaTitle'] 			= '';
		$data['SYS_metaKeyWords'] 		= '';
		$data['SYS_metaDescription'] 	= '';
		$this -> load -> view('recuperar_view', $data);

	}	

	function sendLink(){
		$usuario = $this->input->post('correo');

		$data = array();
		if($this->usuario_model->is_there_emailUsuario($usuario)){
			$this->usuario_model->insertNewConfirmationCode($usuario, $this->usuario_model->getNewConfirmationCode($usuario));
			$CC = $this->usuario_model->getMyConfirmationCode($usuario);
			//var_dump($CC,$usuario);
			

			$mensaje = ' Hola '.$CC->nombre.': <br/>
Has solicitado un cambio de contraseña. <br/><br/>
Para efectuar el cambio, por favor, ingrese al enlace más abajo mostrado y cambie su contraseña.<br/><br/>
Este enlace tiene una validez de <strong>sólo 24 horas</strong>, después de esto, tendrá que solicitar otro cambio en caso de que no lo haya efectuado.
<br><br/>
'.base_url().'recuperar/doChange/'.$CC->codigoConfirmacion.time().'
<br><br/>En caso de que usted no haya solicitado este cambio, simplemente ignore este correo y su cuenta permancerá segura.
<br/><br/>

';
			$this->email_model->send_email(null, $CC->correo, 'Cambio de contraseña en Interpretes', $mensaje);
			$data['email'] = $CC->correo;
			$data['response'] = true;
			$data['cambioContrasena'] = true;
            $this->session->set_flashdata('cambioContrasena', 'Revisa tu correo para continuar con la recuperación');

            } else {
               $data['response'] = false;
               $data['cambioContrasena'] = false;
               $this->session->set_flashdata('cambioContrasena', 'El correo que ingresaste no es válido o no está registrado.');
            }
		  redirect('recuperar');
	}
	
	function doChange($code){
		$confirmationCode = substr($code,0,25);
		$lenCodeTime = strlen(time().'');
		$codeTime = substr($code, 25, $lenCodeTime);
		$idUsuario = substr($code,(25+$lenCodeTime));
		$codeAge = time() - $codeTime;
		if($codeAge>86400){
			$this->session->set_flashdata('cambioContrasena', 'El link que ingresaste ha expirado.');
			redirect('recuperar');
		}
		elseif($this->usuario_model->is_there_activation_code($confirmationCode) == null){
			$this->session->set_flashdata('cambioContrasena', 'El link que ingresaste ya ha sido usado, inténtalo nuevamente.');
			redirect('recuperar');
		}
		else{
			$data['response'] = 'ok';
			$this->resetPassword($confirmationCode);
		}
		
	}

	function resetPassword($activationCode) {
		switch($this->usuario_model->resetPassword($activationCode)) {
			case 1 :
				if($this->session->userdata('tipoUsuario')==1){
				  $this->session->set_flashdata('cambioContrasena', 'Ingresa tu nueva contraseña.');
                   redirect('usuario/cuenta');
                  } 
                  if ($this->session->userdata('tipoUsuario')==2) {
                   $this->session->set_flashdata('cambioContrasena', 'Ingresa tu nueva contraseña.');
                   redirect('interprete/cuenta');
                  }

                  if ($this->session->userdata('tipoUsuario')==0) {
                   redirect('admin');
                  }
				break;
			
			case -1 :
				redirect('principal');

				break;
		}
	}

}
?>