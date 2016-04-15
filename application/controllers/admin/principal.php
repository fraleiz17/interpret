<?php
if (!defined('BASEPATH'))
        die();

class Principal extends CI_Controller {
    
    

        public function __construct(){
        parent::__construct();
        if(!is_logged()){
            $query = $_SERVER['QUERY_STRING'] ? '?'.$_SERVER['QUERY_STRING'] : '';
            $redir = str_replace('/', '-', uri_string().$query);
            redirect('principal');
        } // checamos si existe una sesión activa
            
       
        $this->load->helper(array('form', 'url'));
        $this->load->model('defaultdata_model');
        $this->load->model('admin_model');

        //is_authorized($nivelesReq, $idPermiso, $nivelUsuario, $rolUsuario)
        if (!is_authorized(array(0), 0, $this->session->userdata('nivel'), $this->session->userdata('rol'))) {
                $this->session->set_flashdata('error', 'userNotAutorized');
                redirect('principal');
        }

        }

        
    
    
    public function index() {
        $data['SYS_metaTitle']           = '';
        $data['SYS_metaKeyWords']       = '';
        $data['SYS_metaDescription']    = '';  

        $usuarios    = $this->admin_model->getSingleItems('tipoUsuario', 1, 'usuario');
        $interpretes = $this->admin_model->getSingleItems('tipoUsuario', 2, 'usuario');
        $data['usuarios']    = $usuarios;
        $data['n_usuarios']  = count($usuarios);
        $data['interpretes'] = $interpretes;
        $data['n_interpretes']  = count($interpretes); 

       
        $this->load->view('admin/index_view', $data);
    }


    function borrarUsuario($usuarioID){
        $this->admin_model->deleteItem('usuarioID', $usuarioID, 'usuario');
        redirect('admin');
    }


    


}
