<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Principal extends CI_Controller {
	
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
		$data['estados']    = $this->defaultdata_model->getEstados();
		$data['categorias'] = $this->defaultdata_model->getTable('categorias');
		$data['idiomas']        = $this->defaultdata_model->getTable('idiomas');
		$data['lenguaje']        = $this->defaultdata_model->getTable('lenguaje');
        $this->load->view('index_view', $data);

	}

	

	
}
