<?php
if (!defined('BASEPATH'))

	exit('No direct script access allowed');

class Login extends CI_Controller {

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
	}

	public function index($redir = null) {
		$data['SYS_metaTitle'] 			= '';
		$data['SYS_metaKeyWords'] 		= '';
		$data['SYS_metaDescription'] 	= '';
		$this -> load -> view('login_view', $data);

	}	


	function login($redir, $failredir) {
		$query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
		$redir = str_replace('-', '/', $redir);
		// $redir = str_replace('/admin-login','',$redir);	
		$failredir = str_replace('-', '/', $failredir);
		
			
			$correo = $this->input->post('correo');
			$contrasena = $this->input->post('contrasena');
			$recordarme = '';


			switch($this->auth_model->login($correo, $contrasena, $recordarme)) {
				case 1:

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

				case 0:
					$this->session->set_flashdata('error_login', 'Activa tu usuario para entrar a tu cuenta.');
					redirect('login');	
					
				break;

				case 9:
					$this->session->set_flashdata('error_login', 'Los datos ingresados son incorrectos, inténtalo nuevamente.');
					redirect('login');	
					
				break;

				default:
					$this->session->set_flashdata('error_login', 'Tu registro ha fallado, inténtalo nuevamente');
					redirect('login');

				break;
			}
			
	}

	function logout($redir, $error = null) {
		// $this->auth_model->setAuthKey($this->session->userdata('emailUsuario'));
		//generamos un nuevo authkey antes de salir
		$this->session->sess_destroy();
		//adiós sesión
		$this->auth_model->deleteCookies();
		//borramos cookies
		if($error!=null){
			$this->session->sess_create();
			$this->session->set_flashdata('error', $error);
		}
		redirect($redir);
		//have a nice day
	}

}
?>