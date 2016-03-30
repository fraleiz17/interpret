<?php
if (!defined('BASEPATH'))

	exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		if(is_logged()) // checamos si existe una sesión activa
			redirect('principal');
		$this->load->model('defaultdata_model');		
	}

	public function index($redir = null) {
		$data['SYS_metaTitle'] 			= '';
		$data['SYS_metaKeyWords'] 		= '';
		$data['SYS_metaDescription'] 	= '';
		$this -> load -> view('registro_view', $data);

	}	

}
?>