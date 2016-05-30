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

                <li class="dropdown yamm-fw"> <a href="<?=base_url()?>" class="dropdown-toggle ">Inicio</a>
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

                <li class="dropdown"> <a href="<?=base_url()?>contacto" class="dropdown-toggle active">Contacto</a>
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
<div class="clearfix"></div>


<div class="content_fullwidth less2">
<div class="container">
	
    <div class="one_half">
      
        <p>Envíanos tus comentarios</p>
        <br /><br />
        
        <div class="cforms_sty3">
        
        
        <div id="form_status"></div>
    	<form id="contacto">
	        <label class="label">Nombre <em>*</em></label>
	        <label class="input">
	            <input type="text" name="name" id="name" required="required">
	        </label>
	        
	        <div class="clearfix"></div>
	        
	        <label class="label">E-mail <em>*</em></label>
	        <label class="input">
	            <input type="email" name="email" id="email" required="required">
	        </label>
	
	        <!-- <div class="clearfix"></div>
	
	
	        <label class="label">Phone <em>*</em></label>
	        <label class="input">
	            <input type="text" name="phone" id="phone">
	        </label> -->
	
	        <div class="clearfix"></div>
	
	        <label class="label">Asunto <em>*</em></label>
	        <label class="input">
	            <input type="text" name="subject" id="subject" required="required">
	        </label>
	
	        <div class="clearfix"></div>
	
	        <label class="label">Mensaje <em>*</em></label>
	        <label class="textarea">
	            <textarea rows="5" name="message" id="message" required="required"></textarea>
	        </label>
	
	        <div class="clearfix"></div>
			<input type="hidden" name="token" value="FsWga4&@f6aw" />
	        <button type="submit" class="button contactar">Contactar</button>
          <div id="div1" class="infomes" style="display: none;">
                <div class="message-box-wrap">
                    Enviando...</div>
                </div>

          <div class="successmes" style="display: none;">
            <div class="message-box-wrap">
            <i class="fa fa-check-square fa-lg"></i><span class="info"></span></div>
        </div>
	        
    	</form>	
        
        
        </div>
        
      </div>
      
      <div class="one_half last">
      
        <div class="address_info">
        
          <h4>Company <strong>Address</strong></h4>
          <ul>
            <li> <strong>Company Name</strong><br />
              2901 Marmora Road, Glassgow, Seattle, WA 98122-1090<br />
              Telephone: +1 1234-567-89000<br />
              FAX: +1 0123-4567-8900<br />
              E-mail: <a href="mailto:mail@companyname.com">mail@companyname.com</a><br />
              Website: <a href="index.html">www.yoursitename.com</a> </li>
          </ul>
        </div>
        
        <div class="clearfix"></div>
        
        <h4>Find the Address</h4>
        <iframe class="google-map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=WA,+United+States&amp;aq=0&amp;oq=WA&amp;sll=47.605288,-122.329296&amp;sspn=0.008999,0.016544&amp;ie=UTF8&amp;hq=&amp;hnear=Washington,+District+of+Columbia&amp;t=m&amp;z=7&amp;iwloc=A&amp;output=embed"></iframe>
        <br />
        <small><a href="http://maps.google.com/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=WA,+United+States&amp;aq=0&amp;oq=WA&amp;sll=47.605288,-122.329296&amp;sspn=0.008999,0.016544&amp;ie=UTF8&amp;hq=&amp;hnear=Washington,+District+of+Columbia&amp;t=m&amp;z=7&amp;iwloc=A">View Larger Map</a></small> </div>

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
<script type="text/javascript" src="js/cform/form-validate.js"></script>
<script>
 

  $('form').submit(function(e){
            e.preventDefault();
            var form = $('form');
            $(".contactar").hide(); 
            $(".infomes").fadeIn();
            $.ajax({
                url: '<?php echo base_url('contacto/contactar')?>',
                data: form.serialize(),
                dataType: 'json',
                type: 'post',
                before: function () {
                    $(".contactar").hide(); 
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

</body>
</html>
