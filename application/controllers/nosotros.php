<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nosotros extends CI_Controller {
	
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
        $this->load->view('nosotros_view', $data);

	}

	function detalle() {
		$data = array();	
		$data['idiomas']        = $this->defaultdata_model->getTable('idiomas');	
        $this->load->view('interprete_detalle_view', $data);

	}

	

	
}
