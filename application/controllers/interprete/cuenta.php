<?php
if (!defined('BASEPATH'))
        die();

class Cuenta extends CI_Controller {
    
  
    var $idUsuario="";

        public function __construct(){
        parent::__construct();
        if(!is_logged()&&$this->session->userdata('tipoUsuario')!=2){
            $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $redir = str_replace('/', '-', uri_string().$query);
            redirect('principal');
        } // checamos si existe una sesión activa           
       
        $this->load->model('defaultdata_model');
        $this->load->model('usuario_model');
        $this->load->model('email_model');
        $this->load->helper(array('form', 'url'));

        if (!is_authorized(array(2), 2, $this->session->userdata('nivel'), $this->session->userdata('rol'))) {
                $this->session->set_flashdata('error', 'userNotAutorized');
                redirect('principal');
        }

        }

        //is_authorized($nivelesReq, $idPermiso, $nivelUsuario, $rolUsuario)
        
    
    
    public function index() {
        $data['SYS_metaTitle']          = '';
        $data['SYS_metaKeyWords']       = '';
        $data['SYS_metaDescription']    = '';  
        $data['SYS_metaTitle']          = '';
        $data['SYS_metaKeyWords']       = '';
        $data['SYS_metaDescription']    = '';  
        $data['idiomas']        = $this->defaultdata_model->getTable('idiomas');
        $data['conocimientos']    = $this->defaultdata_model->getTable('categorias');
        $data['estados']    = $this->defaultdata_model->getEstados();
        $data['paises']     = $this->defaultdata_model->getPaises();
        $data['usuario']    = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'usuario');
        $data['u_dato']    = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'usuariodato');
        $data['foto']    = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'fotoperfil'); 
        $data['video']    = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'videos');
       
        $conocimientos = $this->usuario_model->getResult('usuarioID', $this->session->userdata('usuarioID'),'categoriasusuario');
        if ($conocimientos != null) {
           foreach ($conocimientos as $c) {
            $this->session->set_userdata('ic'.$c->categoriaID,$c->categoriaID);

           }
        }

        $iduimas_u = $this->usuario_model->getResult('usuarioID', $this->session->userdata('usuarioID'),'idiomasusuario');
        if ($iduimas_u != null) {
           foreach ($iduimas_u as $ni) {
            $this->session->set_userdata('ni'.$ni->idiomaID,$ni->idiomaID);

           }
        }
        
        $this->load->view('interprete/index_view', $data);
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
                'width'=>357,
                'height' => 250
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

        //VIDEO
        $video = $this->input->post('video');
        if ($video != null && $video != '') {
            $existe_video = $this->usuario_model->getRow('usuarioID', $this->session->userdata('usuarioID'),'videos');

            $dataVideo = array(
                'usuarioID' => $this->session->userdata('usuarioID'),
                'link'      => $video 
            );

            if ($existe_video != null) {
                $this->usuario_model->updateItem('usuarioID', $this->session->userdata('usuarioID'), $dataVideo, 'videos'); 
            } else {
                $this->usuario_model->insertItem('videos', $dataVideo);
            }
        }

        //IDIOMAS
        $idiomas = $this->input->post('idioma');
        if ($idiomas != null && $idiomas != '') {
            $num_id = $this->usuario_model->getResult('usuarioID', $this->session->userdata('usuarioID'), 'idiomasusuario');
            if ($num_id != null) {
                foreach ($num_id as $ni) {
                 $this->session->unset_userdata('ni'.$ni->idiomaID);
                }
            }

            $this->usuario_model->deleteItem('usuarioID', $this->session->userdata('usuarioID'), 'idiomasusuario');
            $n_idiomas = count($idiomas);
            for ($i=0; $i < $n_idiomas; $i++) { 
                $existe_idiomas = $this->usuario_model->getRow2('usuarioID', $this->session->userdata('usuarioID'),'idiomaID',$idiomas[$i],'idiomasusuario');

                $dataIdioma = array(
                    'usuarioID' => $this->session->userdata('usuarioID'),
                    'idiomaID'      => $idiomas[$i] 
                );
                $this->session->set_userdata('ni'.$idiomas[$i],$idiomas[$i]);
                if ($existe_idiomas != null) {
                    $this->usuario_model->updateItem('usuarioID', $this->session->userdata('usuarioID'), $dataIdioma,'idiomaID',$idiomas[$i], 'idiomasusuario'); 
                } else {
                    $this->usuario_model->insertItem('idiomasusuario', $dataIdioma);
                }
            }

        }

        //CONOCIMIENTO
        $conocimientos = $this->input->post('conocimiento');
        if ($conocimientos != null && $conocimientos != '') {
            $num_con = $this->usuario_model->getResult('usuarioID', $this->session->userdata('usuarioID'), 'categoriasusuario');
            if ($num_con != null) {
                foreach ($num_con as $nc) {
               $this->session->unset_userdata('ic'.$nc->categoriaID);
                }
            }
            
            $this->usuario_model->deleteItem('usuarioID', $this->session->userdata('usuarioID'), 'categoriasusuario');
            $n_conocimientos = count($conocimientos);
            for ($i=0; $i < $n_conocimientos; $i++) { 
                $existe_conocimiento = $this->usuario_model->getRow2('usuarioID', $this->session->userdata('usuarioID'),'categoriaID',$conocimientos[$i],'categoriasusuario');

                $dataConocimientos = array(
                    'usuarioID' => $this->session->userdata('usuarioID'),
                    'categoriaID'      => $conocimientos[$i] 
                );
                $this->session->set_userdata('ic'.$conocimientos[$i],$conocimientos[$i]);
                if ($existe_conocimiento != null) {
                    $this->usuario_model->updateItem('usuarioID', $this->session->userdata('usuarioID'), $dataConocimientos,'categoriaID',$conocimientos[$i], 'categoriasusuario'); 
                } else {
                    $this->usuario_model->insertItem('categoriasusuario', $dataConocimientos);
                }
            }

        }

        $this->session->set_flashdata('mensaje', 'Perfil actualizado');
        redirect('interprete/cuenta');

    }

        

}
