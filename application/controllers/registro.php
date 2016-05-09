<?php
if (!defined('BASEPATH'))
	die();

class Registro extends CI_Controller {

	function __construct() {
		parent::__construct();
		/*if (is_logged() && $this->session->userdata('manuallyLogged')) 
			redirect('principal');*/
		$this->load->model('usuario_model');
		$this->load->library('user_agent');/*DATOS DEL NAVEGADOR UTILIZADO*/
		$this->load->model('email_model');
		$this->load->model('file_model');
		$this->load->model('defaultdata_model');
		$this->load->helper(array('form', 'url'));
		$this->load->model('defaultdata_model');
	}

	function index() {
		$data['SYS_metaTitle']       = '';
		$data['SYS_metaKeyWords']    = '';
		$data['SYS_metaDescription'] = '';
		//var_dump($data);

		$this->load->view('registro_view', $data);
	}

	

	function isthereemail() {
		/*EXISTE EL EMAIL EN LA DB?*/
		
		$emailUsuario = $this->input->post('correo');
		$emailUsuario = str_replace('_', '@', $emailUsuario);

		
		if (!$this->usuario_model->is_there_emailUsuario($emailUsuario)) {
			$data['existe'] = true;
		} else {
			$data['existe'] = false;
			
		}

		echo json_encode($data);
	}

	function registrar() {	
		$emailUsuario = $this->input->post('correo');
		$tipoUsuario = $this->input->post('tipoUsuario');
		if($tipoUsuario == 1){ $nivel= 1; } elseif ($tipoUsuario == 2) {
			$nivel=2; } else { $nivel = 1;}

		$confirmationCode = $this->usuario_model->getNewConfirmationCode($emailUsuario);
		
		$dataRegister = array(
  				'nombre' => $this->input->post('nombre'),
  				'apellidoPaterno' => $this->input->post('apellido'),
  				'apellidoMaterno' => $this->input->post('apellidoMaterno'),
  				'correo' => $this->input->post('correo'),
  				'sexo' => $this->input->post('sexo'),
  				'contrasena' => $this->input->post('contrasena'),
  				'tipoUsuario' => $this->input->post('tipoUsuario'), // '0 - Administrador\n1 - usuario normal\n2 - interprete',
  				'status'  => 0, //'0 - no activado\n1 - activo',
  				'nivel' => $nivel,
				'fechaRegistro' => date('Y-m-d H:i:s', time()),
				'codigoConfirmacion' => $confirmationCode);

		
		$idUsuario = $this->usuario_model->registrarUsuario($dataRegister);


		$mensajePlano = 'Hola '.$this->input->post('nombre').'<br><br>
					Gracias por registrarte en Interpretes.<br><br>
					Activa tu cuenta con el siguiente link:<br><br><br><br>			
					<a href="'.base_url().'registro/activar/'.$confirmationCode.'">Activar cuenta Interpretes</a>';

	    $mensaje1 = '<html>
   <head>
      <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
   </head>
   <body style="margin:0px;" bgcolor="#eeeeee">
      <table border="0" cellspacing="0" width="100%">
         <tbody>
            <tr>
               <td align="center" bgcolor="#eeeeee">
                  <table border="0" cellpadding="0" cellspacing="0" width="610">
                     <tbody>
                        <tr>
                           <td height="15">&nbsp;</td>
                        </tr>
                        <tr></tr>
                        <tr>
                           <td bgcolor="#FFFFFF">
                              <table border="0" cellpadding="0" cellspacing="0" width="610" height="610">
                                 <tbody>
                                    <tr>
                                       <td width="30">&nbsp;</td>
                                       <td valign="top">
                                        <br><br><br>
                                          <p style="font-size:30px;font-family:Arial, Helvetica, sans-serif;color:#009ddc;font-weight:normal; text-decoration:none; line-height:20px; margin-bottom:10px; margin-top:20px">Bienvenido '.$this->input->post('nombre').'</b>:<br><br></p>
                                          <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 0px" width="100%">
                                             <tbody>
                                                <tr>
                                                   <td valign="bottom">
                                                      <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:20px; line-height:17px; text-align: justify;">¡Gracias por crear una cuenta con nosotros!</p>

                                                    <br>
                                                    <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:20px; line-height:17px; text-align: justify;">El proceso de activaci&oacute;n de tu cuenta concluye haciendo clic en &ldquo;Activar Cuenta&rdquo;.</p>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                          <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px; line-height:15px;">&nbsp;</p>
                                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                             <tbody>
                                                <tr>
                                                   <td align="center">
                                                      <style>
                                                         .btn {
                                                            width: 150px;
                                                            background: #85ed9f;
                                                            background-image: -webkit-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: -moz-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: -ms-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: -o-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: linear-gradient(to bottom, #85ed9f, #439445);
                                                            -webkit-border-radius: 5;
                                                            -moz-border-radius: 5;
                                                            border-radius: 5px;
                                                            -webkit-box-shadow: 0px 1px 3px #666666;
                                                            -moz-box-shadow: 0px 1px 3px #666666;
                                                            box-shadow: 0px 1px 3px #666666;
                                                            font-family: Arial;
                                                            color: #ffffff;
                                                            font-size: 20px;
                                                            padding: 10px 35px 10px 35px;
                                                            text-decoration: none !important;
                                                         }

                                                         .btn:hover {
                                                            background: #60f788;
                                                            background-image: -webkit-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: -moz-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: -ms-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: -o-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: linear-gradient(to bottom, #60f788, #00b06f);
                                                            text-decoration: none;
                                                         }
                                                         .btn a {
                                                            text-decoration:none;
                                                            text-align: justify;
                                                            font-family: Arial; 
                                                            font-size: 14px; 
                                                            color: #FFF;
                                                         }
                                                      </style>
                                                      <p style="margin:10px 0px 10px 0px;">
                                                         <a href="'.base_url().'registro/activar/'.$confirmationCode.'" target="_blank" style="text-decoration:none;">
                                                            <div class="btn"> Activar Cuenta </div>
                                                         </a></p>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                          <p style="font-family: Arial; font-size: 12px; color: #666; font-weight: bold; text-align: left;"></p>
                                          <p><span style="font-size: 12px; font-family: Arial; color: #666; font-weight: bold;"></span></p>
                                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                             <tbody>
                                                <tr></tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td width="30">&nbsp;</td>
                                       
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        
                        <tr>
                           <td bgcolor="#424242" height="5" style="line-height:0px;">&nbsp;</td>
                        </tr>
                        <tr>
                           <td style="padding-top:10px; padding-bottom:0px;">
                              <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:15px;" width="610">
                                 <tbody>
                                    <tr>
                                       <td width="20">&nbsp;</td>
                                       <td valign="top" width="280">
                                          <p style="margin-top:0; margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Este correo es enviado de forma autom&aacute;tica con fines informativos, por favor no respondas a esta direcci&oacute;n. Si deseas contactarnos puedes hacerlo a trav&eacute;s de <a href="mailto:ayuda@interprete.com" style="color:#009ddc; text-decoration:underline" title="Email a ventas@interprete.com">ayuda@interprete.com</a></p>
                                       </td>
                                       <td width="20">&nbsp;</td>
                                       <td valign="top" width="280">
                                          <p style="margin-top:0; margin-bottom:10px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Este mensaje fue enviado a <span style="color:#009ddc;" title="">&lt;|correo|&gt;</span></p>
                                          <p style="margin-top:0; margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Si no eres el usuario o si deseas cancelar tu suscripci&oacute;n a este bolet&iacute;n <a href="|unsuscribe|" style="color:#009ddc; text-decoration:underline" target="_blank">haz clic aqu&iacute;</a>.</p>
                                       </td>
                                       <td width="20"><img height="1" src="|pixel|" width="1" /></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
      <p>&nbsp;</p>
   </body>
</html>
';


		

		if($this->email_model->send_email('', $emailUsuario, 'Gracias por registrarte en Interpretes', $mensaje1)){
			$data['response'] = true;
			$data['message'] = "Éxito, favor de revisar su correo para activar su usuario";
		}
		else{
			$data['response'] = false;
			$data['message'] = "Ocurrió un error intentelo nuevamente";
		}

		$this->usuario_model->insertItem('usuariodato', $dataUsuariodato  = array('usuarioID' => $idUsuario));

		$data['url'] = base_url();
		$data['registro'] = true;
		$data['cambioContrasena'] = false;
		echo json_encode($data);
	}

	
	function activacion($result) {
		$data['SYS_metaTitle'] = '';
		$data['SYS_metaKeyWords'] = '';
		$data['SYS_metaDescription'] = '';
		

		switch($result) {
			case 'usuario-activado' :
				if($this->session->userdata('tipoUsuario')==1){
				redirect('usuario/cuenta');
				} 
				if ($this->session->userdata('tipoUsuario')==2) {
					redirect('interprete/cuenta');
				}
				if ($this->session->userdata('tipoUsuario')==0) {
					redirect('admin');
				}
				
				break;
			case 'usuario-activo' :
				$this->session->set_flashdata('error_login', 'Este usuario ya ha sido activado anteriormente, puedes iniciar sesión desde la página principal.');
				redirect('principal');
				break;
			case 'error' :
				$this->session->set_flashdata('error_login', 'Tu registro ha fallado, inténtalo nuevamente');
				redirect('principal');
				break;
		}
		

	
		redirect('principal');
		//$this->load->view('index_view', $data);
	}     

	function activar($activationCode) {
		//echo $activationCode;
		//var_dump($this->usuario_model->is_there_activation_code($activationCode));

		switch($this->usuario_model->activar($activationCode)) {
			case 1 :
				redirect('registro/activacion/usuario-activado');
				// die('Mission Success, Objective Completed ;D');
				break;
			case 0 :
				redirect('registro/activacion/usuario-activo');
				// die('Ya ha sido activado este usuario');
				break;
			case -1 :
				redirect('registro/activacion/error');
				// die('No existe ese codigo carnal :(');
				break;
		}
		
	}

	
	

	function meh(){

		$mensaje1 =  '<html>
   <head>
      <meta content="text/html; charset=UTF-8" http-equiv="Content-Type" />
   </head>
   <body style="margin:0px;" bgcolor="#eeeeee">
      <table border="0" cellspacing="0" width="100%">
         <tbody>
            <tr>
               <td align="center" bgcolor="#eeeeee">
                  <table border="0" cellpadding="0" cellspacing="0" width="610">
                     <tbody>
                        <tr>
                           <td height="15">&nbsp;</td>
                        </tr>
                        <tr></tr>
                        <tr>
                           <td bgcolor="#FFFFFF">
                              <table border="0" cellpadding="0" cellspacing="0" width="610" height="610">
                                 <tbody>
                                    <tr>
                                       <td width="30">&nbsp;</td>
                                       <td valign="top">
                                        <br><br><br>
                                          <p style="font-size:30px;font-family:Arial, Helvetica, sans-serif;color:#009ddc;font-weight:normal; text-decoration:none; line-height:20px; margin-bottom:10px; margin-top:20px">Bienvenido Martha</b>:<br><br></p>
                                          <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom: 0px" width="100%">
                                             <tbody>
                                                <tr>
                                                   <td valign="bottom">
                                                      <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:20px; line-height:17px; text-align: justify;">¡Gracias por crear una cuenta con nosotros!</p>

                                                    <br>
                                                    <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:20px; line-height:17px; text-align: justify;">El proceso de activaci&oacute;n de tu cuenta concluye haciendo clic en &ldquo;Activar Cuenta&rdquo;.</p>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                          <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px; line-height:15px;">&nbsp;</p>
                                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                             <tbody>
                                                <tr>
                                                   <td align="center">
                                                      <style>
                                                         .btn {
                                                            width: 150px;
                                                            background: #85ed9f;
                                                            background-image: -webkit-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: -moz-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: -ms-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: -o-linear-gradient(top, #85ed9f, #439445);
                                                            background-image: linear-gradient(to bottom, #85ed9f, #439445);
                                                            -webkit-border-radius: 5;
                                                            -moz-border-radius: 5;
                                                            border-radius: 5px;
                                                            -webkit-box-shadow: 0px 1px 3px #666666;
                                                            -moz-box-shadow: 0px 1px 3px #666666;
                                                            box-shadow: 0px 1px 3px #666666;
                                                            font-family: Arial;
                                                            color: #ffffff;
                                                            font-size: 20px;
                                                            padding: 10px 35px 10px 35px;
                                                            text-decoration: none !important;
                                                         }

                                                         .btn:hover {
                                                            background: #60f788;
                                                            background-image: -webkit-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: -moz-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: -ms-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: -o-linear-gradient(top, #60f788, #00b06f);
                                                            background-image: linear-gradient(to bottom, #60f788, #00b06f);
                                                            text-decoration: none;
                                                         }
                                                         .btn a {
                                                            text-decoration:none;
                                                            text-align: justify;
                                                            font-family: Arial; 
                                                            font-size: 14px; 
                                                            color: #FFF;
                                                         }
                                                      </style>
                                                      <p style="margin:10px 0px 10px 0px;">
                                                         <a href="raw" target="_blank" style="text-decoration:none;">
                                                            <div class="btn"> Activar Cuenta </div>
                                                         </a></p>
                                                   </td>
                                                </tr>
                                             </tbody>
                                          </table>
                                          <p style="font-family: Arial; font-size: 12px; color: #666; font-weight: bold; text-align: left;"></p>
                                          <p><span style="font-size: 12px; font-family: Arial; color: #666; font-weight: bold;"></span></p>
                                          <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                             <tbody>
                                                <tr></tr>
                                             </tbody>
                                          </table>
                                       </td>
                                       <td width="30">&nbsp;</td>
                                       
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                        
                        <tr>
                           <td bgcolor="#424242" height="5" style="line-height:0px;">&nbsp;</td>
                        </tr>
                        <tr>
                           <td style="padding-top:10px; padding-bottom:0px;">
                              <table border="0" cellpadding="0" cellspacing="0" style="margin-bottom:15px;" width="610">
                                 <tbody>
                                    <tr>
                                       <td width="20">&nbsp;</td>
                                       <td valign="top" width="280">
                                          <p style="margin-top:0; margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Este correo es enviado de forma autom&aacute;tica con fines informativos, por favor no respondas a esta direcci&oacute;n. Si deseas contactarnos puedes hacerlo a trav&eacute;s de <a href="mailto:ayuda@interprete.com" style="color:#009ddc; text-decoration:underline" title="Email a ventas@interprete.com">ayuda@interprete.com</a></p>
                                       </td>
                                       <td width="20">&nbsp;</td>
                                       <td valign="top" width="280">
                                          <p style="margin-top:0; margin-bottom:10px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Este mensaje fue enviado a <span style="color:#009ddc;" title="">&lt;|correo|&gt;</span></p>
                                          <p style="margin-top:0; margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Si no eres el usuario o si deseas cancelar tu suscripci&oacute;n a este bolet&iacute;n <a href="|unsuscribe|" style="color:#009ddc; text-decoration:underline" target="_blank">haz clic aqu&iacute;</a>.</p>
                                       </td>
                                       <td width="20"><img height="1" src="|pixel|" width="1" /></td>
                                    </tr>
                                 </tbody>
                              </table>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </td>
            </tr>
         </tbody>
      </table>
      <p>&nbsp;</p>
   </body>
</html>
';
		var_dump($this->email_model->send_email('', 'ntest111@mailinator.com', 'Gracias por registrarte en Interpretes_ beta', $mensaje1));

	}

	
	

}
?>
