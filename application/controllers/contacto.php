<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('defaultdata_model');
		$this->load->model('admin_model');
		$this->load->model('usuario_model');
		$this->load->model('file_model');
		$this -> load -> library('pagination');

    }

	function index() {
		$data = array();		
        $this->load->view('contacto_view', $data);

	}

	

	
}
