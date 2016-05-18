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

	function detalle($usuarioID) {
		$data = array();	
		$data['idiomas'] = $this->defaultdata_model->getTable('idiomas');	
		$data['usuario'] = $this->usuario_model->getRow('usuarioID', $usuarioID,'usuario');
		$u_dato =  $this->usuario_model->getRow('usuarioID', $usuarioID,'usuariodato');
		$idEstado = $u_dato->estadoID;
		$estado = $this->usuario_model->estado($idEstado);
        $data['u_dato']  = $this->usuario_model->getRow('usuarioID', $usuarioID,'usuariodato');
        $data['estado']  = $estado;
        $data['foto']    = $this->usuario_model->getRow('usuarioID', $usuarioID,'fotoperfil'); 
        $data['video']   = $this->usuario_model->getRow('usuarioID', $usuarioID,'videos');
       
        $data['conocimientos'] = $this->usuario_model->getExpUsuario($usuarioID);
		$data['idiomas']     = $this->usuario_model->getIdiomasUsuario($usuarioID);
		$data['lenguajes']     = $this->usuario_model->getLenguajesUsuario($usuarioID);

		if(is_logged()) {
			$valor = $this->getRating($usuarioID);
		} else{
			$valor = 0;
		}

		$data['rating']     = $valor;
        $this->load->view('interprete_detalle_view', $data);

	}

	function getRating($interpreteID){
		$rating = $this->usuario_model->getRow2('usuarioID', $this->session->userdata('usuarioID'),'interpreteID',$interpreteID,'ratinginterprete');
		if ($rating != null) {
			return $rating->valor;
		} else{
			return 0;
		}
		

	}

	

	
}
