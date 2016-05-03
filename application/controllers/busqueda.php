<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Busqueda extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('defaultdata_model');
		$this->load->model('file_model');
		$this -> load -> library('pagination');

    }

	function index() {
		$estado =$this->input->post('estado'); 
		$categoria =$this->input->post('categoria'); 
		$idioma =$this->input->post('idioma'); 
		$sexo =$this->input->post('sexo'); 
		$usuarios = $this->defaultdata_model->getBusqueda($estado,$categoria,$idioma,$sexo);
		$data['interpretes'] = $usuarios;
        $this->load->view('interpretes_view', $data);
	}

	

	
}
