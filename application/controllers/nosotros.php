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
		$usuarioID = 29;	
		$data['idiomas'] = $this->defaultdata_model->getTable('idiomas');	
		$data['usuario'] = $this->usuario_model->getRow('usuarioID', $usuarioID,'usuario');
        $data['u_dato']  = $this->usuario_model->getRow('usuarioID', $usuarioID,'usuariodato');
        $data['foto']    = $this->usuario_model->getRow('usuarioID', $usuarioID,'fotoperfil'); 
        $data['video']   = $this->usuario_model->getRow('usuarioID', $usuarioID,'videos');
       
        $data['conocimientos'] = $this->usuario_model->getResult('usuarioID', $usuarioID,'categoriasusuario');
		$data['iduimas_u']     = $this->usuario_model->getResult('usuarioID', $usuarioID,'idiomasusuario');
		var_dump($data);
        $this->load->view('interprete_detalle_view', $data);

	}

	

	
}
