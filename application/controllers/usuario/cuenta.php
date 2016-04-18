<?php
if (!defined('BASEPATH'))
        die();

class Cuenta extends CI_Controller {
    
  
    var $idUsuario="";

        public function __construct(){
        parent::__construct();
        if(!is_logged()&&$this->session->userdata('tipoUsuario')!=1){
            $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $redir = str_replace('/', '-', uri_string().$query);
            redirect('principal');
        } // checamos si existe una sesión activa           
       
        $this->load->model('defaultdata_model');
		$this->load->model('usuario_model');
        $this->load->model('email_model');
        $this->load->helper(array('form', 'url'));

        if (!is_authorized(array(1), 1, $this->session->userdata('nivel'), $this->session->userdata('rol'))) {
                $this->session->set_flashdata('error', 'userNotAutorized');
                redirect('principal');
        }

        }

        //is_authorized($nivelesReq, $idPermiso, $nivelUsuario, $rolUsuario)
        
    
    
    public function index() {
        $data['SYS_metaTitle']          = '';
        $data['SYS_metaKeyWords']       = '';
        $data['SYS_metaDescription']    = '';  
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['paises']     = $this->defaultdata_model->getPaises();
        $data['usuario']    = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'usuario');
        $data['u_dato']    = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'usuariodato');
        $data['foto']    = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'fotoperfil');

        $this->load->view('usuario/index_view', $data);
    }


   
    function updateMiPerfil(){
         $dataUsuario = array(
            'nombre' => $this->input->post('nombre'), 
            'apellidoPaterno' => $this->input->post('apellidoPaterno'), 
            'apellidoMaterno' => $this->input->post('apellidoMaterno'), 
            'correo' => $this->input->post('correo'), 
            'telefono' => $this->input->post('telefono'),
            'sexo' => $this->input->post('sexo')
        );
        $this->usuario_model->updateItem('usuarioID', $this->session->userdata('usuarioID'), $dataUsuario, 'usuario');

         $dataUsuariodato = array(
            'usuarioID' => $this->session->userdata('usuarioID'),
            'direccion' => $this->input->post('direccion'),
            'municipio' => $this->input->post('municipio'),
            'estadoID' => $this->input->post('estadoID'),
            'cp'       => $this->input->post('cp'),
            'idPais'   => $this->input->post('idPais')
        );
        $existe_usuario = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'usuariodato');

        if($existe_usuario != null){
           $this->usuario_model->updateItem('usuarioID', $this->session->userdata('usuarioID'), $dataUsuariodato, 'usuariodato'); 
       } else {
           $this->usuario_model->insertItem('usuariodato', $dataUsuariodato);
       }
        
        $contrasena = $this->input->post('contrasena');
        if($contrasena != null && $contrasena != ''){
            $this -> usuario_model -> passRecover($this -> input -> post('contrasena'), $this -> session -> userdata('usuarioID'));
        }

        //FOTO
        if(!empty($_FILES)){
            $this->load->model('file_model');
            $file_data = array(
                'date'=>false,
                'random' => true,
                'user_id' => null,
                'width'=>146,
                'height' => 146
            );
            $imagen = $this->file_model->uploadItem('foto', $file_data, 'foto', true);

            if (!is_array($imagen)) {
                $existe_foto = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'fotoperfil');

            $dataFoto = array(
                'usuarioID' => $this->session->userdata('usuarioID'),
                'foto'      => $imagen 
            );

            if ($existe_foto != null) {
                $this->usuario_model->updateItem('usuarioID', $this->session->userdata('usuarioID'), $dataFoto, 'fotoperfil'); 
            } else {
                $this->usuario_model->insertItem('fotoperfil', $dataFoto);
            }
            }
            

        }
        

        $this->session->set_flashdata('mensaje', 'Perfil actualizado');
        redirect('usuario/cuenta');

    }

    

}
