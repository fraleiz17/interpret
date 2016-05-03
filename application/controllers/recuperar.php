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
	}

	public function index() {
		$data['SYS_metaTitle'] 			= '';
		$data['SYS_metaKeyWords'] 		= '';
		$data['SYS_metaDescription'] 	= '';
		$this -> load -> view('recuperar_view', $data);

	}	


	
	

}
?>