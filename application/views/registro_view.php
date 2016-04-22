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

             <div id="navbar-collapse-1" class="navbar-collapse collapse pull-right">

            <nav>

              <ul class="nav navbar-nav">

                <li class="dropdown yamm-fw"> <a href="<?=base_url()?>" class="dropdown-toggle active">Inicio</a>
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
                      $a = 'interprete/principal';
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
                <li class="dropdown"><a href="<?=base_url()?>registro" class="dropdown-toggle">Regístrate</a>
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
<div class="content_fullwidth less2">
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
                <input type="text" name="nombre" required="required" minlength="3">
                </div>
                <div class = "one_third">
                <label>Apellido Paterno<em>*</em></label>
                <input type="text" name="apellido" required="required" minlength="3">
                </div>
                <div class = "one_third last">
                <label>Apellido Materno <em>*</em></label>
                <input type="text" name="apellidoMaterno" required="required">
                </div>
                <label>Email <em>*</em></label>
                <input type="email" name="correo" id="correo" required>
                <label id="error_e" style="display: none; color: red;">* Correo ya registrado</label>
                <div class="one_half">
                    <label>Contraseña <em>*</em></label>
                    <input type="password" name="contrasena" id="contrasena" minlength="4" maxlength="8" class="contrasena_">
                </div>
                
                <div class="one_half last">
                    <label>Confirma Contraseña <em>*</em></label>
                    <input type="password" name="contrasenaConfirm" id="contrasenaConfirm" minlength="4" maxlength="8" class="contrasena_">
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
                
                <!-- <div class="two_third last">
                	<label>Fecha de nacimiento</label>
                    
                	<div class="one_third">
                        <select>
                            <option value="0">Dia</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                            <option value="31">31</option>
                        </select>
                    </div>
                    
                    <div class="one_third">
                        <select>
                            <option value="0">Mes</option>
                            <option value="1">January</option>
                            <option value="2">February</option>
                            <option value="3">March</option>
                            <option value="4">April</option>
                            <option value="5">May</option>
                            <option value="6">June</option>
                            <option value="7">July</option>
                            <option value="8">August</option>
                            <option value="9">September</option>
                            <option value="10">October</option>
                            <option value="11">November</option>
                            <option value="12">December</option>
                        </select>
                    </div>
                    
                    <div class="one_third last">
                        <select>
                            <option value="0">Año</option>
                            <option value="2000">2001</option>
                            <option value="2000">2000</option>
                            <option value="1999">1999</option>
                            <option value="1998">1998</option>
                            <option value="1997">1997</option>
                            <option value="1996">1996</option>
                            <option value="1995">1995</option>
                            <option value="1994">1994</option>
                            <option value="1993">1993</option>
                            <option value="1992">1992</option>
                            <option value="1991">1991</option>
                            <option value="1990">1990</option>
                            <option value="1989">1989</option>
                            <option value="1988">1988</option>
                            <option value="1987">1987</option>
                            <option value="1986">1986</option>
                            <option value="1985">1985</option>
                            <option value="1984">1984</option>
                            <option value="1983">1983</option>
                            <option value="1982">1982</option>
                            <option value="1981">1981</option>
                            <option value="1980">1980</option>
                        </select>
                    </div>
                    
				</div>
                
                <div class="clearfix"></div>
                <div class="margin_bottom2"></div>
                
                <div class="one_half">
                    <label>Ciudad</label>
                    <input type="text" name="estado">
                </div>
                
                <div class="one_half last">
                	<label>País</label>
                    
                    <select>
                            <option value="0">- Select -</option>
                            <option value="usa">USA</option>
                            <option value="india">India</option>
                            <option value="china">China</option>
                            <option value="uk">UK</option>
                            <option value="australia">Australia</option>
                            <option value="germany">Germany</option>
                            <option value="canada">Canada</option>
 
                        </select>
                </div>
                
                <label>Dirección</label>
                <input type="text" name="direccion">
                
                <div class="checkbox">
                    <label>
                        <input type="checkbox">
                    </label>
                    <label>Estoy de acuerdo con los <a href="#">Terminos y condiciones.</a></label>
                </div> -->
                
                <button type="submit" class="fbut registrar">Crear Cuenta</button>
                <div class="margin_top3"></div><div class="clearfix"></div>
        
                <div id="div1" class="infomes" style="display: none;">
                <div class="message-box-wrap">
                    Registrando...</div>
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
            var form = $('form');
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
        });
</script>

<script src="js/tabs/assets/js/responsive-tabs.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/universal/custom.js"></script>

<script type="text/javascript">
$(".contrasena_").blur(
    function(){
        console.log('miau');
        var contrasena = $("#contrasena").val();
        var contrasena2 = $("#contrasenaConfirm").val();      

        if(contrasena != "" && contrasena == contrasena2) {
          $("#error_c").fadeOut();
          return true;
        } else {
          $("#error_c").fadeIn();
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
                        return false; 
                    } else{
                        $("#error_e").fadeOut();
                        return true;
                    }
                }
        });                          
    }
);        
 
</script>

</body>
</html>
