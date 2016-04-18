<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interpretes extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('defaultdata_model');
		$this->load->model('file_model');
		$this -> load -> library('pagination');

    }

	function index() {
		$data = array();
		$data['interpretes'] = $this->defaultdata_model->getResult2('status', 1,'tipoUsuario',2, 'usuario');
		var_dump($data['interpretes']);
        $this->load->view('interpretes_view', $data);

	}

	function getFoto($usuarioID){
		$foto = $this->defaultdata_model->getRow('usuarioID', $usuarioID, 'fotoperfil');
		if ($foto != null) {
			echo $foto->foto;
		}
		

	}

	function getCategorias($usuarioID){
		$categorias = $this->defaultdata_model->getCategoriasUsuario($usuarioID);
		if ($categorias != null) {
			$cadena = '';
			foreach ($categorias as $c) {
				$cadena .= '*'.$c->categoria.' ';
			}
		}
		echo $cadena;

	}

	

	
}