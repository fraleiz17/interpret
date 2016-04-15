<!doctype html>
<!--[if IE 7 ]>    <html lang="en-gb" class="isie ie7 oldie no-js"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en-gb" class="isie ie8 oldie no-js"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en-gb" class="isie ie9 no-js"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="es" xml:lang="es" class="no-js">
<!--<![endif]-->
<head>
<title>Interpretes LSM</title>
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
    <div class="logo"><a href="index.html" id="logo"></a></div>

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

                <li class="dropdown yamm-fw"> <a href="index.html" class="dropdown-toggle">Inicio</a>
                </li>

                <li class="dropdown"><a href="nuestros.html" class="dropdown-toggle">Nuestros Interpretes</a>
                </li>

                <li class="dropdown"><a href="login.html" class="dropdown-toggle active">Inicia sesión</a>
                </li>

                <li class="dropdown yamm-fw"> <a href="nosotros.html" class="dropdown-toggle">Sobre nosotros</a>
                </li>

                <li class="dropdown"> <a href="contact.html" class="dropdown-toggle">Contacto</a>
                </li>
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
        
			<h3>Usuarios (<?=$n_usuarios?>)</h3>
        		
			
        </div>
        
        <div class="feildcont">
        
            <form role="form">
                
                <div class="one_third">
                	<label><strong>Usuario</strong></label>
                </div>

                <div class="one_third">
                	<label><strong>Estatus</strong></label>
                </div>

                <div class="one_third last">
                	<label><strong>Borrar</strong></label>
                </div>

                 <?php if($n_usuarios > 0){ 
                 	foreach ($usuarios as $usr) { ?>

                <div class="one_third">
                		<label><?=$usr->nombre.' '.$usr->apellidoPaterno.' '.$usr->apellidoMaterno?> / <br><?=$usr->correo?></label>
                </div>

                <div class="one_third">
                	<label><?=($usr->status == 1) ? 'Activo' : 'Inactivo'?></label>
                </div>

                <div class="one_third last">
                	<a href="#" class="borrar" id="<?=$usr->usuarioID?>"><label><i class="fa fa-trash"></i> Borrar</label></a>
                </div>

                <div class="margin_top3"></div><div class="clearfix"></div>

                 <?php } 
                 }?>
        
                 <!-- USUARIOS INTERPRETES -->  
                 <div class="title">
        
			<h3>Interpretes (<?=$n_interpretes?>)</h3>
        		
			
        </div>
        
        <div class="feildcont">
        
            <form role="form">
                
                <div class="one_third">
                	<label><strong>Usuario</strong></label>
                </div>

                <div class="one_third">
                	<label><strong>Estatus</strong></label>
                </div>

                <div class="one_third last">
                	<label><strong>Borrar</strong></label>
                </div>

                 <?php if($n_interpretes > 0){ 
                 	foreach ($interpretes as $usr) { ?>

                <div class="one_third">
                		<label><?=$usr->nombre.' '.$usr->apellidoPaterno.' '.$usr->apellidoMaterno?> / <br><?=$usr->correo?></label>
                </div>

                <div class="one_third">
                	<label><?=($usr->status == 1) ? 'Activo' : 'Inactivo'?></label>
                </div>

                <div class="one_third last">
                	<a href="#" class="borrar" id="<?=$usr->usuarioID?>"><label><i class="fa fa-trash"></i> Borrar</label></a>
                </div>

                <div class="margin_top3"></div><div class="clearfix"></div>
                
                 <?php } 
                 }?>  
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
 
 $(".borrar").click(
    function(){
        var confirmar = confirm('¿Estas seguro de querer borrar este usuario?');
        var usuarioID = $(this).attr('id');
	
	if (confirmar) {

		window.location.href = "<?=base_url()?>admin/principal/borrarUsuario/"+usuarioID;
	} else {
		return false;
	}
                                  
    }
);
</script>

<script src="js/tabs/assets/js/responsive-tabs.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/universal/custom.js"></script>


</body>
</html>
