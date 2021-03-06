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

<div class="slider"><br><br><br><br></div>
<div class="feature_section81">
<div class="container">
    <div class="clearfix margin_bottom2"></div>
    <h2>Conócelos:</h2>
    <div class="clearfix margin_bottom2"></div>
    
    <div class="one_third_less">
        <img src="<?=base_url()?>docs/foto/1.jpg" class="rimg" alt="" width="357px" heigth="250px"/>
        <h3>Andrea Martínez</h3>
        <p class="less6">Educación, Creavtividad</p>
        <img class="efit" src="<?=base_url()?>docs/foto/5s.png?>" width="80px" ><br>
        <a href="<?=base_url()?>nosotros/detalle" class="button eleven" style="color: #71c135; font-weight:bolder;">Ver perfil</a>
    </div>
    
    <div class="one_third_less">
        <img src="<?=base_url()?>docs/foto/2.jpg" class="rimg" alt="" width="357px" heigth="250px"/>
        <h3>Jorge Villaseñor</h3>
        <p class="less6">Derecho y Leyes</p>
        <img class="efit" src="<?=base_url()?>docs/foto/5s.png?>" width="80px" ><br>
        <a href="<?=base_url()?>nosotros/detalle" class="button eleven" style="color: #71c135; font-weight:bolder;">Ver perfil</a>
    </div>
    
    <div class="one_third_less last">
        <img src="<?=base_url()?>docs/foto/5.jpg" class="rimg" alt="" width="357px" heigth="250px"/>
        <h3>Hugo Cuellar</h3>
        <p class="less6">Recursos Humanos</p>
        <p><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><p>
        <a href="<?=base_url()?>nosotros/detalle" class="button eleven" style="color: #71c135; font-weight:bolder;">Ver perfil</a>
    </div>
    
  <div class="clearfix margin_bottom3"></div>
    
    <div class="one_third_less">
        <img src="<?=base_url()?>docs/foto/3.jpg" class="rimg" alt=""/>
        <h3>Pablo Yañez</h3><p class="less6">Sector Salud</p>
        <p><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><p>
        <a href="<?=base_url()?>nosotros/detalle" class="button eleven" style="color: #71c135; font-weight:bolder;">Ver perfil</a>
    </div>
    
    <div class="one_third_less">
        <img src="<?=base_url()?>docs/foto/4.jpg" class="rimg" alt=""/>
        <h3>Daniel Monroy</h3><p class="less6">Contabilidad</p>
        <img class="efit" src="<?=base_url()?>docs/foto/5s.png?>" width="80px" ><br>
        <a href="<?=base_url()?>nosotros/detalle" class="button eleven" style="color: #71c135; font-weight:bolder;">Ver perfil</a>
    </div>
    
    <div class="one_third_less last">
      <img src="<?=base_url()?>docs/foto/6.jpg" class="rimg" alt=""/>
        <h3>Silvia Montalvo</h3><p class="less6">Administración</p>
        <p><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><p>
        <a href="<?=base_url()?>nosotros/detalle" class="button eleven" style="color: #71c135; font-weight:bolder;">Ver perfil</a>
    </div>
    
</div>
</div><!-- end feature_section 81 -->

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

<script src="js/scrolltotop/totop.js" type="text/javascript"></script>

<!-- cubeportfolio --> 
<script type="text/javascript" src="js/cubeportfolio/js/jquery.cubeportfolio.min.js"></script> 
<script type="text/javascript" src="js/cubeportfolio/main.js"></script>

<!-- aninum --> 
<script src="js/aninum/jquery.animateNumber.min.js"></script>

<!-- tabs --> 
<script type="text/javascript" src="js/tabs3/tabulous.js"></script>
<script type="text/javascript" src="js/tabs3/js.js"></script>

<!-- carouselowl --> 
<script src="js/carouselowl/owl.carousel.js"></script> 
<script type="text/javascript" src="js/universal/custom.js"></script>
<script type="text/javascript" src="js/carouselowl/custom.js"></script> 

<!-- search box --> 
<script src="js/searchbox/overlay.js"></script>
<script>
  $(document).ready(function() {
    $('.overlay').overlay();
  });
</script>



</body>
</html>
