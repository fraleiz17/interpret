<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contacto extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('defaultdata_model');
		$this->load->model('admin_model');
		$this->load->model('usuario_model');
		$this->load->model('file_model');
		$this->load->model('email_model');
		$this -> load -> library('pagination');

    }

	function index() {
		$data = array();		
        $this->load->view('contacto_view', $data);

	}

	function contactar(){
		$mensajePlano = '<div style="color: #1ea133;   border-color: #a9ecb4; background-color: #dffbe4; padding: 20px 20px; font-family:Arial, Helvetica, sans-serif;">
    <p style="margin:10px 10px 10px 0px;"></p>
<h2>Hola has recibido un mensaje desde contacto<br><br></h2>
               <strong>Nombre:</strong>'.$this->input->post('name').'<br>
               <strong>Correo:</strong>'.$this->input->post('email').'<br>
               <strong>Asunto:</strong>'.$this->input->post('subject').'<br>
               <strong>Mensaje:</strong>'.$this->input->post('message').'<br><br><br>
          

        Copyright © 2016 TuInterprete.com. All rights reserved.  <a href="http://interpretelsm.com/#">Terminos de uso</a> | <a href="http://interpretelsm.com/#">Politica de privacidad</a>

    </div>
</div>';
if($this->email_model->send_email('', 'contacto@interpretelsm.com', 'Has recibido un mensaje desde contacto', $mensajePlano)){
			$data['response'] = true;
			$data['message'] = "Éxito, favor de revisar su correo para activar su usuario";
		}
		else{
			$data['response'] = false;
			$data['message'] = "Ocurrió un error intentelo nuevamente";
		}
		echo json_encode($data);
	}

	

	
}
