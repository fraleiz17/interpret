<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Sesion extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('auth_model');
	}

	function login($redir, $failredir) {
		$query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
		$redir = str_replace('-', '/', $redir);
		// $redir = str_replace('/admin-login','',$redir);	
		$failredir = str_replace('-', '/', $failredir);
		
			
			$correo = $this->input->get('correo');
			$contrasena = $this->input->get('contrasena');
			$recordarme = '';


			switch($this->auth_model->login($correo, $contrasena, $recordarme)) {
				case 1:
					/*if($query!=""){
						$redirect = $redir.$query;
						$redirect = substr($redirect, 0,(strlen($redirect)-12));
						$data['url'] = 'http://localhost:82/qup/'.$redirect;
						$data['response'] = true;
					}
					else{*/

						if($this->session->userdata('tipoUsuario')==1){
                			//$data['url'] = 'http://localhost:82/qup/usuario/cuenta/myProfile';
                			$data['url'] = base_url().'usuario/cuenta/myProfile';
                		} 
                		if ($this->session->userdata('tipoUsuario')==2) {
                		    //$data['url'] = 'http://localhost:82/qup/negocio/principal/myProfile';
                		    $data['url'] = base_url().'negocio/principal/myProfile';
                		}
               			if ($this->session->userdata('tipoUsuario')==3) {
                		    //$data['url'] = 'http://localhost:82/qup/asociaciones/principal/myProfile';
                		    $data['url'] = base_url().'asociaciones/principal/myProfile';
                		}
                		if ($this->session->userdata('tipoUsuario')==0) {
                		    $data['url'] = base_url().'admin';
						}

						//redirect($redirect);
						$data['response'] = true;
					//}
					
					
				break;
				case 9 :

					//$this->session->set_flashdata('error', 'infoIncorrect');
					$data['url'] = base_url();
					$data['response'] = false;
				break;
				case 0 :

					//$this->session->set_flashdata('error', 'inactiveUser');
					$data['url'] = base_url();
					$data['response'] = false;
				break;
				case -2 :

					//$this->session->set_flashdata('error', 'bannedUser');
					$data['url'] = base_url();
					$data['response'] = false;
				break;

				case 3 :

					/*if($query!=""){
						$redirect = $redir.$query;
						$redirect = substr($redirect, 0,(strlen($redirect)-12));
					}
					else{
						$redirect = $redir;
					}*/
					$data['url'] = base_url();
					$data['registro'] = false;
					$data['response'] = false;

				break;
			}
			
			$data['cambioContrasena'] = false;
		echo json_encode($data);
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
