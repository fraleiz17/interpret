<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interpretes extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('defaultdata_model');
		$this->load->model('usuario_model');
		$this->load->model('file_model');
		$this -> load -> library('pagination');

    }

	function index() {
		$data = array();
		$this->updateRating();
		$data['interpretes'] = $this->defaultdata_model->getResult2('status', 1,'tipoUsuario',2, 'usuario');
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

	function getBusqueda(){
		$estado =$this->input->post('estado'); 
		$categoria =$this->input->post('categoria'); 
		$idioma =$this->input->post('idioma'); 
		$sexo =$this->input->post('sexo'); 
		$usuarios = $this->defaultdata_model->getBusqueda($estado,$categoria,$idioma,$sexo);
		$data['interpretes'] = $usuarios;
        $this->load->view('interpretes_view', $data);
	}

	function guardarRating($rating,$interpreteID){//getRow2($itemID, $ID,$itemID2,$ID2, $tabla)
		$existe_rating = $this->usuario_model->getRow2('usuarioID', $this->session->userdata('usuarioID'),'interpreteID',$interpreteID,'ratinginterprete');

		$dataRating = array(
			'usuarioID'    => $this->session->userdata('usuarioID'),
			'interpreteID' => $interpreteID,
			'valor'    => $rating
		);

        if($existe_rating != null){
           $this->usuario_model->updateItem2('usuarioID', $this->session->userdata('usuarioID'),'interpreteID',$interpreteID, $dataRating, 'ratinginterprete'); 
        } else {
           $this->usuario_model->insertItem('ratinginterprete', $dataRating);
        }


       $data['registro'] = true;
       echo json_encode($data);

	}

	function getRating($interpreteID){
		$rating = $this->usuario_model->getRow2('usuarioID', $this->session->userdata('usuarioID'),'interpreteID',$interpreteID,'ratinginterprete');
		if ($rating != null) {
			echo $rating->valor;
		} else{
			echo 0;
		}
		

	}

	function updateRating(){
		$interpretes = $this->defaultdata_model->getResult2('status', 1,'tipoUsuario',2, 'usuario');

		foreach ($interpretes as $i) {
			$promedio = $this->defaultdata_model->getNUsuarios($i->usuarioID);
			$data = array(
				'rating' => $promedio
			 );
			$this->usuario_model->updateItem('usuarioID', $i->usuarioID, $data, 'usuario');

		}
	}

	
}
