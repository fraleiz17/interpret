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


		$mensajePlano = '<div style="color: #1ea133;   border-color: #a9ecb4; background-color: #dffbe4; padding: 20px 20px; font-family:Arial, Helvetica, sans-serif;">
    <p style="margin:10px 10px 10px 0px;"></p>
<h2>Hola '.$this->input->post('nombre').'<br><br></h2>
               Gracias por registrarte en Interpretes.<br><br>
               Activa tu cuenta con el siguiente link:<br><br><br><br>        
               <strong><a style="color: black;" href="'.base_url().'registro/activar/'.$confirmationCode.'">Activar cuenta Interpretes</a></strong><br><br>
          

        Copyright © 2016 TuInterprete.com. All rights reserved.  <a href="http://interpretelsm.com/#">Terminos de uso</a> | <a href="http://interpretelsm.com/#">Politica de privacidad</a>

    </div>
</div>';
      $message = '
<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="es" xml:lang="es" class="no-js">
<!--<![endif]-->
<head>
<title>Intérpretes</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<!-- Favicon -->
<link rel="shortcut icon" href="http://interpretelsm.com/images/favicon.png">

<!-- this styles only adds some repairs on idevices  -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google fonts - witch you want to use - (rest you can just remove) -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- ######### CSS STYLES ######### -->

<link rel="stylesheet" href="http://interpretelsm.com/css/reset-realestate.css" type="text/css" />
<link rel="stylesheet" href="http://interpretelsm.com/css/style-realestate.css" type="text/css" />

<!-- font awesome icons -->
<link rel="stylesheet" href="http://interpretelsm.com/css/font-awesome/css/font-awesome.min.css">

<!-- simple line icons -->
<link rel="stylesheet" type="text/css" href="http://interpretelsm.com/css/simpleline-icons/simple-line-icons.css" media="screen" />

<!-- animations -->
<link href="http://interpretelsm.com/js/animations/css/animations.min.css" rel="stylesheet" type="text/css" media="all" />

<!-- responsive devices styles -->
<link rel="stylesheet" media="screen" href="http://interpretelsm.com/css/responsive-leyouts-realestate.css" type="text/css" />

<!-- shortcodes -->
<link rel="stylesheet" media="screen" href="http://interpretelsm.com/http://interpretelsm.com/css/shortcodes-realestate.css" type="text/css" />

<!-- style switcher -->
<link rel = "stylesheet" media = "screen" href = "js/style-switcher/color-switcher.css" />

<!-- MasterSlider -->
<link rel="stylesheet" href="http://interpretelsm.com/http://interpretelsm.com/js/masterslider/style/masterslider.css" />
<link rel="stylesheet" href="http://interpretelsm.com/js/masterslider/skins/default/style.css" />
<link href="js/masterslider/style/ms-showcase2.css" rel="stylesheet" type="text/css">

<!-- mega menu -->
<link href="http://interpretelsm.com/js/mainmenu/bootstrap.min.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/mainmenu/demo.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/mainmenu/menu-realestate.css" rel="stylesheet">

<!-- carouselowl -->
<link href="http://interpretelsm.com/js/carouselowl/owl.transitions.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/carouselowl/owl.carousel.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/carouselowl/owl.theme.css" rel="stylesheet">

<!-- tabs -->
<link rel="stylesheet" type="text/css" href="http://interpretelsm.com/js/tabs/assets/css/responsive-tabs5.css">


</head>

<body>

<div class="site_wrapper">

<header class="header">

    <div class="container_full_menu">

    <!-- Logo -->
    <div class="logo"><a href="http://interpretelsm.com/http://interpretelsm.com/" id="logo"></a></div>

    </div>

</header><!-- end Navigation Menu -->


<div class="clearfix"></div>
<div class="slider"><br><br><br><br></div>
<div class="clearfix"></div>


<div class="content_fullwidth less2">
<div class="container">
   <p>Bienvenido '.$this->input->post('nombre').'</br>:</p><br><br>
    <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:20px; line-height:17px; text-align: justify;">¡Gracias por crear una cuenta con nosotros!</p>

   <br>
   <p style="margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:20px; line-height:17px; text-align: justify;">El proceso de activaci&oacute;n de tu cuenta concluye haciendo clic en &ldquo;Activar Cuenta&rdquo;.</p>

   <p style="margin:10px 0px 10px 0px;">
                                                         <a href="'.base_url().'registro/activar/'.$confirmationCode.'" target="_blank" style="text-decoration:none;">
                                                            <div class="btn"> Activar Cuenta </div>
                                                         </a></p>
    <p style="margin-top:0; margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Este correo es enviado de forma autom&aacute;tica con fines informativos, por favor no respondas a esta direcci&oacute;n. Si deseas contactarnos puedes hacerlo a trav&eacute;s de <a href="mailto:ayuda@interprete.com" style="color:#009ddc; text-decoration:underline" title="Email a ventas@interprete.com">ayuda@interprete.com</a></p>
 
<p style="margin-top:0; margin-bottom:0px; font-family:Arial, Helvetica, sans-serif; color:#666666; font-size:12px;line-height:15px;">Si no eres el usuario o si deseas cancelar tu suscripci&oacute;n a este bolet&iacute;n <a href="|unsuscribe|" style="color:#009ddc; text-decoration:underline" target="_blank">haz clic aqu&iacute;</a>.</p>
</div><!-- end content area -->

    </div>

<div class="clearfix"></div>
<div class="copyright_info">
<div class="container">
    <div class="clearfix"></div>
    <div class="one_half">

        Copyright © 2016 TuInterprete.com. All rights reserved.  <a href="http://interpretelsm.com/#">Terminos de uso</a> | <a href="http://interpretelsm.com/#">Politica de privacidad</a>

    </div>

    <div class="one_half last">


    </div>

</div>
</div><!-- end copyright info -->


    
</div>


<!-- ######### JS FILES ######### --> 
<!-- get jQuery used for the theme --> 
<script type="text/javascript" src="js/universal/jquery.js"></script>
<script src="js/style-switcher/styleselector.js"></script>
<script src="js/animations/js/animations.min.js" type="text/javascript"></script>
<script src="js/mainmenu/bootstrap.min.js"></script> 
<script src="js/mainmenu/customeUI.js"></script> 
<script type="text/javascript" src="js/mainmenu/sticky.js"></script>
<script type="text/javascript" src="js/mainmenu/modernizr.custom.75180.js"></script>
<script type="text/javascript" src="js/cform/form-validate.js"></script>

</body>
</html>';

	   
		

		if($this->email_model->send_email('', $emailUsuario, 'Gracias por registrarte en Interpretes', $mensajePlano)){
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

		$mensaje1 =  '
<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="es" xml:lang="es" class="no-js">
<!--<![endif]-->
<head>
<title>Intérpretes</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="keywords" content="" />
<meta name="description" content="" />

<!-- Favicon -->
<link rel="shortcut icon" href="http://interpretelsm.com/images/favicon.png">

<!-- this styles only adds some repairs on idevices  -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google fonts - witch you want to use - (rest you can just remove) -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- ######### CSS STYLES ######### -->

<link rel="stylesheet" href="http://interpretelsm.com/css/reset-realestate.css" type="text/css" />
<link rel="stylesheet" href="http://interpretelsm.com/css/style-realestate.css" type="text/css" />

<!-- font awesome icons -->
<link rel="stylesheet" href="http://interpretelsm.com/css/font-awesome/css/font-awesome.min.css">

<!-- simple line icons -->
<link rel="stylesheet" type="text/css" href="http://interpretelsm.com/css/simpleline-icons/simple-line-icons.css" media="screen" />

<!-- animations -->
<link href="http://interpretelsm.com/js/animations/css/animations.min.css" rel="stylesheet" type="text/css" media="all" />

<!-- responsive devices styles -->
<link rel="stylesheet" media="screen" href="http://interpretelsm.com/css/responsive-leyouts-realestate.css" type="text/css" />

<!-- shortcodes -->
<link rel="stylesheet" media="screen" href="http://interpretelsm.com/http://interpretelsm.com/css/shortcodes-realestate.css" type="text/css" />

<!-- style switcher -->
<link rel = "stylesheet" media = "screen" href = "js/style-switcher/color-switcher.css" />

<!-- MasterSlider -->
<link rel="stylesheet" href="http://interpretelsm.com/http://interpretelsm.com/js/masterslider/style/masterslider.css" />
<link rel="stylesheet" href="http://interpretelsm.com/js/masterslider/skins/default/style.css" />
<link href="js/masterslider/style/ms-showcase2.css" rel="stylesheet" type="text/css">

<!-- mega menu -->
<link href="http://interpretelsm.com/js/mainmenu/bootstrap.min.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/mainmenu/demo.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/mainmenu/menu-realestate.css" rel="stylesheet">

<!-- carouselowl -->
<link href="http://interpretelsm.com/js/carouselowl/owl.transitions.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/carouselowl/owl.carousel.css" rel="stylesheet">
<link href="http://interpretelsm.com/js/carouselowl/owl.theme.css" rel="stylesheet">

<!-- tabs -->
<link rel="stylesheet" type="text/css" href="http://interpretelsm.com/js/tabs/assets/css/responsive-tabs5.css">


</head>

<body>

<div class="site_wrapper">

<header class="header">

    <div class="container_full_menu">

    <!-- Logo -->
    <div class="logo"><a href="http://interpretelsm.com/http://interpretelsm.com/" id="logo"></a></div>

    </div>

</header><!-- end Navigation Menu -->


<div class="clearfix"></div>
<div class="slider"><br><br><br><br></div>
<div class="clearfix"></div>


<div class="content_fullwidth less2">
<div class="container">
   miau
    
</div><!-- end content area -->

    </div>

<div class="clearfix"></div>
<div class="copyright_info">
<div class="container">
    <div class="clearfix"></div>
    <div class="one_half">

        Copyright © 2016 TuInterprete.com. All rights reserved.  <a href="http://interpretelsm.com/#">Terminos de uso</a> | <a href="http://interpretelsm.com/#">Politica de privacidad</a>

    </div>

    <div class="one_half last">


    </div>

</div>
</div><!-- end copyright info -->


    
</div>


<!-- ######### JS FILES ######### --> 
<!-- get jQuery used for the theme --> 
<script type="text/javascript" src="js/universal/jquery.js"></script>
<script src="js/style-switcher/styleselector.js"></script>
<script src="js/animations/js/animations.min.js" type="text/javascript"></script>
<script src="js/mainmenu/bootstrap.min.js"></script> 
<script src="js/mainmenu/customeUI.js"></script> 
<script type="text/javascript" src="js/mainmenu/sticky.js"></script>
<script type="text/javascript" src="js/mainmenu/modernizr.custom.75180.js"></script>
<script type="text/javascript" src="js/cform/form-validate.js"></script>

</body>
</html>

';
		var_dump($this->email_model->send_email('', 'lsm_test@mailinator.com', 'Gracias por registrarte en Interpretes_ beta', $mensaje1));
      echo $mensaje1;

	}

	
	

}
?>
