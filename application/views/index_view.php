<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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

<!-- slider -->
<div class="slider">

    <div class="fadein">
        <img src="http://www.naveedkashif.com/wp-content/uploads/2015/08/Guide-To-Business-Setup-in-Dubai-Mainland-1920x770.jpg" alt="" />
        <img src="https://img.grouponcdn.com/seocmsimages/beyS9FSjuXqcKDWuM7ee/VX-1920x770" alt="" />
        <img src="http://insightfultax.com/wp-content/uploads/2015/03/paris.jpg" alt="" />
    </div>

    <div class="prosearch">
    <div class="container">
        <?php if($this->session->flashdata('error_login')):?>
        <div class="alertymes1">
        <div class="message-box-wrap">
            <button class="close-but" id="colosebut1" onclick="$('.alertymes1').hide()">close</button> <i class="fa fa-cog fati11 imagede"></i>
              <?=$this->session->flashdata('error_login');?>
            </div>
        
        </div>
        <?php endif;?>

        <div class="clearfix margin_bottom4"></div>
        <h1>¡Encuentra a tu interprete!</h1>
		<h2>Fácil y rápido</h2>

        <div class="clearfix margin_bottom4"></div>



        <div class="tabs-content5 fullw">

            <div id="example-5-tab-1" class="tabs-panel5">
            <form method="post" action="<?=base_url()?>busqueda">

                <select name="estado">
                <option value="">Estado</option>
                <?php if($estados != null):
                        foreach ($estados as $c): ?>
                <option value="<?=$c->estadoID?>"><?=$c->nombreEstado?></option>
                <?php endforeach;
                    endif;
                ?>
                </select>

            <select name="categoria">
                <option value="">Interés</option>
                <?php if($categorias != null):
                        foreach ($categorias as $c): ?>
                <option value="<?=$c->categoriaID?>"><?=$c->categoria?></option>
                <?php endforeach;
                    endif;
                ?>
            </select>

            <select name="idioma">
                <option value="">Idioma</option>
                <?php if($idiomas != null):
                        foreach ($idiomas as $c): ?>
                <option value="<?=$c->idiomaID?>"><?=$c->idioma?></option>
                <?php endforeach;
                    endif;
                ?>
            </select>

            <select name="sexo">
                <option value="">Género</option>
                <option value="0">Femenino</option>
                <option value="1">Masculino</option>
            </select>

            <button type="submit" class="but1"><i class="fa fa-search"></i> Buscar</button>
            <div class="clearfix margin_bottom2"></div>

            <!-- <a href="#" class="but3"><i class="fa fa-caret-right"></i>Busqueda Avanzada</a>-->

            </form>

            <div id="busqueda_av">

              
            </div>


            </div><!-- end tab 1 -->

        </div>


    </div>
    </div>


</div><!-- end slider -->
<div class="feature_section2">
<div class="container">

    <h2 class="caps medium"><strong>¿Que ofrecemos?</strong></h2>

  <div class="one_third">
    <div class="box"> <i class="fa fa-thumbs-o-up"></i>
      <h4 class="caps">Comodidad</h4>
      <p>Encuentra a tu interprete con solo unos cuantos clicks.</p>
    </div>
  </div>
  <!-- end -->

  <div class="one_third">
    <div class="box"> <i class="fa fa-star-o"></i>
      <h4 class="caps"><col>Confianza</col></h4>
      <p>Selecciona al interprete en base a su rating.<br><br></p>
    </div>
  </div>

  <div class="one_third last">
    <div class="box"> <i class="fa fa-home"></i>
      <h4 class="caps">Facilmente</h4>
      <p>Desde tu hogar.<br><br></p>
    </div>
  </div>

<!--
  <div class="one_fourth last">
    <div class="box"> <i class="fa fa-paper-plane-o"></i>
      <h4 class="caps">Expert Guidance</h4>
      <p>Many as desktop packages ands webpage editor now use search many web sites</p>
    </div>
  </div>
  <!-- end -->

</div>
</div>
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
<script src="js/masterslider/masterslider.min.js"></script>
<script type="text/javascript">
(function($) {
 "use strict";

    var slider = new MasterSlider();

    slider.control('arrows');
    slider.control('thumblist' , {autohide:false ,dir:'h',arrows:false, align:'bottom', width:160, height:100, margin:2, space:2});

    slider.setup('masterslider' , {
        width:1170,
        height:500,
        space:5,
        view:'slide'
    });

})(jQuery);
</script>

<script type="text/javascript">
(function($) {
 "use strict";

$('.fadein img:gt(0)').hide();

setInterval(function () {
    $('.fadein :first-child').fadeOut()
                             .next('img')
                             .fadeIn()
                             .end()
                             .appendTo('.fadein');
}, 3000); // 4 seconds

})(jQuery);
</script>

<!-- carousel -->
<script src="js/carouselowl/owl.carousel.js"></script>
<script type="text/javascript" src="js/universal/custom.js"></script>
<script src="js/tabs/assets/js/responsive-tabs.min.js" type="text/javascript"></script>

</body>
</html>
