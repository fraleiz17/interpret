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
<link rel="shortcut icon" href="images/favicon.png">

<!-- this styles only adds some repairs on idevices  -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Google fonts - witch you want to use - (rest you can just remove) -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<!-- ######### CSS STYLES ######### -->

<link rel="stylesheet" href="css/reset-realestate.css" type="text/css" />
<link rel="stylesheet" href="css/style-realestate.css" type="text/css" />

<!-- font awesome icons -->
<link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">

<!-- simple line icons -->
<link rel="stylesheet" type="text/css" href="css/simpleline-icons/simple-line-icons.css" media="screen" />

<!-- animations -->
<link href="js/animations/css/animations.min.css" rel="stylesheet" type="text/css" media="all" />

<!-- responsive devices styles -->
<link rel="stylesheet" media="screen" href="css/responsive-leyouts-realestate.css" type="text/css" />

<!-- shortcodes -->
<link rel="stylesheet" media="screen" href="css/shortcodes-realestate.css" type="text/css" />

<!-- style switcher -->
<link rel = "stylesheet" media = "screen" href = "js/style-switcher/color-switcher.css" />

<!-- MasterSlider -->
<link rel="stylesheet" href="js/masterslider/style/masterslider.css" />
<link rel="stylesheet" href="js/masterslider/skins/default/style.css" />
<link href='js/masterslider/style/ms-showcase2.css' rel='stylesheet' type='text/css'>

<!-- mega menu -->
<link href="js/mainmenu/bootstrap.min.css" rel="stylesheet">
<link href="js/mainmenu/demo.css" rel="stylesheet">
<link href="js/mainmenu/menu-realestate.css" rel="stylesheet">

<!-- carouselowl -->
<link href="js/carouselowl/owl.transitions.css" rel="stylesheet">
<link href="js/carouselowl/owl.carousel.css" rel="stylesheet">
<link href="js/carouselowl/owl.theme.css" rel="stylesheet">

<!-- tabs -->
<link rel="stylesheet" type="text/css" href="js/tabs/assets/css/responsive-tabs5.css">


</head>

<style>


.copyright_info {
  
  bottom: 0;
    /* Set the fixed height of the footer here */
}
.feature_section2
{padding:80px 0px 285px 0px;}
</style>
<body>
<div class="site_wrapper">
<header class="header">

  <div class="container_full_menu">

    <!-- Logo -->
    <div class="logo"><a href="<?=base_url()?>" id="logo"></a></div>

  <!-- Navigation Menu -->
    <div class="menu_main">

      <div class="navbar yamm navbar-default">

          <div class="navbar-header">
            <div class="navbar-toggle .navbar-collapse .pull-right " data-toggle="collapse" data-target="#navbar-collapse-1" > <span></span>
              <button type="button" > <i class="fa fa-bars"></i></button>
            </div>
          </div>

          <div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">

            <nav>

              <ul class="nav navbar-nav">

                <li class="dropdown yamm-fw"> <a href="<?=base_url()?>" class="dropdown-toggle">Inicio</a>
                </li>

                <li class="dropdown"><a href="<?=base_url()?>interpretes" class="dropdown-toggle">Nuestros Interpretes</a>
                </li>

                <?php if(!is_logged()) { ?>
                <li class="dropdown"><a href="<?=base_url()?>login" class="dropdown-toggle">Inicia sesión</a>
                </li>
                <?php } else { 
                  if($this->session->userdata('tipoUsuario')==1){
                   $a = 'usuario/cuenta';
                  } 
                  if ($this->session->userdata('tipoUsuario')==2) {
                      $a = 'interprete/cuenta';
                  }

                  if ($this->session->userdata('tipoUsuario')==0) {
                      $a = 'admin';
                  }
                  ?>
                <li class="dropdown"><a href="<?=base_url().$a?>" class="dropdown-toggle">Mi Cuenta</a>
                </li>
                <?php } ?>

                <li class="dropdown yamm-fw"> <a href="<?=base_url()?>nosotros" class="dropdown-toggle">Sobre nosotros</a>
                </li>

                <li class="dropdown"> <a href="<?=base_url()?>contacto" class="dropdown-toggle">Contacto</a>
                </li>

                <?php if(is_logged()) { ?>
                <li class="dropdown"><a href="<?=base_url()?>login/logout/principal" class="dropdown-toggle">Cerrar sesión</a>
                </li>
                <?php } else { ?>
                <li class="dropdown"><a href="<?=base_url()?>registro" class="dropdown-toggle active">Regístrate</a>
                <?php  } ?>
              </ul>

            </nav>

          </div>

      </div>
    </div>

  </div>

</header><!-- end Navigation Menu -->


<div class="clearfix"></div>
<div class="slider"><br><br><br><br></div>
<div class="feature_section">
</div>
<div class="feature_section2">
<div class="container">

	<div class="logregform two">
    <form id="registro" >
        
        <div class="title">
        
			<h3>Registro</h3>
        		
			<p>¿Ya estas registrado? &nbsp;<a href="<?=base_url()?>login">Inicia sesión..</a></p>
            
        </div>
        
        <div class="feildcont">
        
            <form role="form">
                <div class = "one_third">
                <label>Nombre(s) <em>*</em></label>
                <input type="text" name="nombre" required="required" minlength="3" pattern="[a-zA-ZÑñáéíóúÁÉÍÓÚ/\s/]{1,30}"
        title="No se admiten caracteres especiales">
                </div>
                <div class = "one_third">
                <label>Apellido Paterno<em>*</em></label>
                <input type="text" name="apellido" required="required" minlength="3" pattern="[a-zA-ZÑñáéíóúÁÉÍÓÚ/\s/]{1,30}"
        title="No se admiten caracteres especiales">
                </div>
                <div class = "one_third last">
                <label>Apellido Materno <em>*</em></label>
                <input type="text" name="apellidoMaterno" required="required" pattern="[a-zA-ZÑñáéíóúÁÉÍÓÚ/\s/]{1,30}"
        title="No se admiten caracteres especiales">
                </div>
                <label>Email <em>*</em></label>
                <input type="email" name="correo" id="correo" required>
                <label id="error_e" style="display: none; color: red;">* Correo ya registrado</label>
                <div class="one_half">
                    <label>Contraseña <em>*</em></label>
                    <input type="password" name="contrasena" id="contrasena" minlength="4" maxlength="8" class="contrasena_" pattern="[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ/\s/]{1,8}"
        title="No se admiten caracteres especiales">
                </div>
                
                <div class="one_half last">
                    <label>Confirma Contraseña <em>*</em></label>
                    <input type="password" name="contrasenaConfirm" id="contrasenaConfirm" minlength="4" maxlength="8" class="contrasena_" pattern="[a-zA-Z0-9ÑñáéíóúÁÉÍÓÚ/\s/]{1,8}"
        title="No se admiten caracteres especiales">
                </div>
                <label id="error_c" style="display: none; color: red;">* Las contraseñas no coinciden</label>
                 <div class="one_half radiobut">
                    <label>Sexo</label>
                    <input class="one" type="radio" name="sexo" value="1" checked>
                    <span class="onelb">M</span>
                    <input class="two" type="radio" name="sexo" value="0">
                    <span class="onelb">F</span>
                </div>

                <div class="one_half radiobut">
                    <label>Soy</label>
                    <input class="one" type="radio" name="tipoUsuario" value="1" checked>
                    <span class="onelb">Usuario</span>
                    <input class="two" type="radio" name="tipoUsuario" value="2">
                    <span class="onelb">Int&eacute;prete</span>
                </div>
                
              
                
                <button type="submit" class="fbut registrar">Crear Cuenta</button>
                <div class="margin_top3"></div><div class="clearfix"></div>
        
                <div id="div1" class="infomes" style="display: none;">
                <div class="message-box-wrap">
                    Registrando...</div>
                </div>

                <div id="div1" class="errormes" style="display: none;">
                <div class="message-box-wrap">
                    Revisa tus datos</div>
                </div>
        
        <div class="successmes" style="display: none;">
            <div class="message-box-wrap">
            <i class="fa fa-check-square fa-lg"></i><span class="info"></span></div>
        </div>
                
                    
            </form>
        
        </div>

	</div>


</div>
</div><!-- end content area -->
<div class="clearfix"></div>
<div class="copyright_info">
<div class="container">
    <div class="clearfix"></div>
    <div class="one_half">

        Copyright © 2016 TuInterprete.com. All rights reserved.  <a href="#">Terminos de uso</a> | <a href="#">Politica de privacidad</a>

    </div>

    <div class="one_half last">

        <ul class="footer_social_links">
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-facebook"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-twitter"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-google-plus"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-linkedin"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-skype"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-flickr"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-html5"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-youtube"></i></a></li>
            <li class="animate" data-anim-type="zoomIn"><a href="#"><i class="fa fa-rss"></i></a></li>
        </ul>

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
<script src="js/masterslider/jquery.easing.min.js"></script>

<!-- search box --> 
<script src="js/searchbox/overlay.js"></script>
<script>
  $(document).ready(function() {
	$('.overlay').overlay();
  });

  $('form').submit(function(e){
            e.preventDefault();
            
            var pass = revisar_contrasena();
            var mail = revisar_correo();
            console.log(pass,mail);
            if(pass == true && mail == true){

            var form = $('form');
            $(".errormes").fadeOut();
            $(".registrar").hide(); 
            $(".infomes").fadeIn();

            $.ajax({
                url: '<?php echo base_url('registro/registrar')?>',
                data: form.serialize(),
                dataType: 'json',
                type: 'post',
                before: function () {
                    $(".registrar").hide(); 
                    $(".successmes").fadeOut();
                },
                success: function (data) {
                    $(".infomes").fadeOut();
                    $(".successmes").fadeIn();
                    $('.info').html(data.message);
                }
            });
            } else {
                $(".errormes").fadeIn();
            }
        });
</script>

<script src="js/tabs/assets/js/responsive-tabs.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/universal/custom.js"></script>

<script type="text/javascript">
function revisar_contrasena(){
        console.log('miau');
        var contrasena = $("#contrasena").val();
        var contrasena2 = $("#contrasenaConfirm").val();      

        if(contrasena != "" && contrasena == contrasena2) {
          $("#error_c").fadeOut();
          $(".errormes").fadeOut();
          $(".registrar").show(); 
          return true;
        } else {
          $("#error_c").fadeIn();
          $(".registrar").hide(); 
          return false;
        }                          
  
}

function revisar_correo(){
     var form = $('form');
        $.ajax({
                url: '<?php echo base_url('registro/isthereemail')?>',
                data: form.serialize(),
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    if(data.existe == false){
                        $("#error_e").fadeIn();
                        $(".registrar").hide(); 
                        return v = false; 
                    } else{
                        $("#error_e").fadeOut();
                        $(".errormes").fadeOut();
                        $(".registrar").show(); 
                        return v = true;
                    }
                },
                async: false
        });      
    return v;                    
}

$(".contrasena_").blur(
    function(){
        console.log('miau');
        var contrasena = $("#contrasena").val();
        var contrasena2 = $("#contrasenaConfirm").val();      

        if(contrasena != "" && contrasena == contrasena2) {
          $("#error_c").fadeOut();
          $(".errormes").fadeOut();
          $(".registrar").show(); 
          return true;
        } else {
          $("#error_c").fadeIn();
          $(".registrar").hide(); 
          return false;
        }                          
    }
); 

$("#correo").blur(
    function(){
        var form = $('form');
        $.ajax({
                url: '<?php echo base_url('registro/isthereemail')?>',
                data: form.serialize(),
                dataType: 'json',
                type: 'post',
                success: function (data) {
                    if(data.existe == false){
                        $("#error_e").fadeIn();
                        $(".registrar").hide(); 
                        return false; 
                    } else{
                        $("#error_e").fadeOut();
                        $(".errormes").fadeOut();
                        $(".registrar").show(); 
                        return true;
                    }
                }
        });                          
    }
);        
 
</script>

</body>
</html>
