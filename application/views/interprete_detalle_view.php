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

<link rel="stylesheet" href="<?=base_url()?>css/reset-realestate.css" type="text/css" />
<link rel="stylesheet" href="<?=base_url()?>css/style-realestate.css" type="text/css" />

<!-- font awesome icons -->
<link rel="stylesheet" href="<?=base_url()?>css/font-awesome/<?=base_url()?>css/font-awesome.min.css">
<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<!-- simple line icons -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/simpleline-icons/simple-line-icons.css" media="screen" />

<!-- animations -->
<link href="<?=base_url()?>js/animations/<?=base_url()?>css/animations.min.css" rel="stylesheet" type="text/css" media="all" />

<!-- responsive devices styles -->
<link rel="stylesheet" media="screen" href="<?=base_url()?>css/responsive-leyouts-realestate.css" type="text/css" />

<!-- shortcodes -->
<link rel="stylesheet" media="screen" href="<?=base_url()?>css/shortcodes-realestate.css" type="text/css" />

<!-- style switcher -->
<link rel = "stylesheet" media = "screen" href = "<?=base_url()?>js/style-switcher/color-switcher.css" />

<!-- MasterSlider -->
<link rel="stylesheet" href="<?=base_url()?>js/masterslider/style/masterslider.css" />
<link rel="stylesheet" href="<?=base_url()?>js/masterslider/skins/default/style.css" />
<link href='<?=base_url()?>js/masterslider/style/ms-showcase2.css' rel='stylesheet' type='text/css'>

<!-- mega menu -->
<link href="<?=base_url()?>js/mainmenu/bootstrap.min.css" rel="stylesheet">
<link href="<?=base_url()?>js/mainmenu/demo.css" rel="stylesheet">
<link href="<?=base_url()?>js/mainmenu/menu-realestate.css" rel="stylesheet">

<!-- carouselowl -->
<link href="<?=base_url()?>js/carouselowl/owl.transitions.css" rel="stylesheet">
<link href="<?=base_url()?>js/carouselowl/owl.carousel.css" rel="stylesheet">
<link href="<?=base_url()?>js/carouselowl/owl.theme.css" rel="stylesheet">

<!-- tabs -->
<link rel="stylesheet" type="text/css" href="<?=base_url()?>js/tabs/assets/<?=base_url()?>css/responsive-tabs5.css">
<!-- ######### JS FILES ######### --> 
<!-- get jQuery used for the theme --> 
<script type="text/javascript" src="<?=base_url()?>js/universal/jquery.js"></script>
<script src="<?=base_url()?>js/style-switcher/styleselector.js"></script>
<script src="<?=base_url()?>js/animations/<?=base_url()?>js/animations.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/mainmenu/bootstrap.min.js"></script> 
<script src="<?=base_url()?>js/mainmenu/customeUI.js"></script> 
<script type="text/javascript" src="<?=base_url()?>js/mainmenu/sticky.js"></script>
<script type="text/javascript" src="<?=base_url()?>js/mainmenu/modernizr.custom.75180.js"></script>
<script src="<?=base_url()?>js/masterslider/jquery.easing.min.js"></script>
<script src="<?=base_url()?>js/rating/jquery.raty-fa.js"></script>
<!-- search box --> 
<script src="<?=base_url()?>js/searchbox/overlay.js"></script>
<script>
  $(document).ready(function() {
  $('.overlay').overlay();
  });
</script>

<script src="<?=base_url()?>js/tabs/assets/<?=base_url()?>js/responsive-tabs.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?=base_url()?>js/universal/custom.js"></script>
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

</script>


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
<style>
.efit{border-radius: 100%;
margin: 0 auto;}
</style>
</header><!-- end Navigation Menu -->
<script type="text/javascript">
        $(function() {
        $('.rate').raty({
            readOnly   : false,
            size     : 3,
            click: function() {
              var puntuacion = $("input[name='score']").val();
              $('#save_rate').fadeIn();
            }
            
        });
  });                     
        </script> 

<div class="clearfix"></div>
<div class="slider"><br><br><br><br></div>
<div class="feature_section2">
<div class="container">
        <div id="save_rate" class="successmes" style="display: none">
            <div class="message-box-wrap">
        <button class="close-but" id="colosebut2" onclick="$('#save_rate').hide();">close</button><?php echo 'Su puntuación ha sido guardada, recuerde que se verá reflejada en el puntaje del intérprete'; ?></div>
        </div><!-- end box --> 


        <?php if($this->session->flashdata('mensaje')):?>
        <div id="div2" class="successmes">
            <div class="message-box-wrap">
        <button class="close-but" id="colosebut2" onclick="$('.successmes').hide();">close</button><?php echo $this->session->flashdata('mensaje'); ?></div>
        </div><!-- end box -->
        <?php endif;?>
        
        <div class="logregform two">
    
        
        <div class="title">
        
      <h3>Perfil</h3>
                      
        </div>
        <div class="margin_top3"></div><div class="clearfix"></div>
        
        
        <div class="feildcont">

            <form role="form" action="cuenta/updateMiPerfil" method="post" enctype="multipart/form-data">

          <div class="one_third last">
          <?php if($foto != null):?>
          <img class="efit" src="<?=base_url()?>docs/foto/<?=$foto->foto?>" width="146px" height="146px">
           <?php endif; ?>
          
        </div>
                <div class = "one_third">
                <label>Nombre</em></label>
                <strong><?=$usuario->nombre.' '.$usuario->apellidoPaterno.' '.$usuario->apellidoMaterno?></strong>
                </div>
                <input type="hidden" name="interpreteID" value="<?=$usuario->usuarioID?>">
                
                
                <strong><?=$usuario->correo?></strong>
                

                <div class="one_half radiobut">
                    <label><strong><?=($usuario->sexo == 1) ? 'Masculino' : 'Femenino'?></strong></label>
                </div>
                
                <p><strong>Calificación: </strong>
                <div id="rate" class="rate"></div>
                </p>


                <div class="one_half last">
                    <label>Tel&eacute;fono</label>
                    <strong></strong>
                </div>
                
                <div class="clearfix"></div>
                <div class="margin_bottom2"></div>
                
                <label>Dirección</label>
                <strong><?=$u_dato->direccion?>, <?=$u_dato->cp?></strong>

                <div class="one_half">
                    <label>Ciudad</label>
                    <strong><?=$u_dato->municipio?></strong>
                </div>

                <div class="one_half last">
                    <label>Estado</label>
                    <strong><?=$estado->nombreEstado?></strong>
                </div>

                
                <div class="one_half last">
                  <label>País</label>
                  <strong>México</strong>
                </div>
                <div class="clearfix"></div>
                <div class="margin_bottom2"></div>
                <div class="stcode_title4">
            
        <h3><span class="line"></span><span class="text"><strong>Información Profesional</strong></span></h3>
        </div>

                <label>Video</label>
                

                <div class="margin_top3"></div><div class="clearfix"></div>

                 <?php if($video != null):?>
                <iframe width="500" src="<?=$video->link?>" frameborder="0" allowfullscreen></iframe>
                <?php  endif;?>
                

                <div class="one_half">
                    <label onclick="$('#idiomas').toggle();"> <strong>Idiomas</strong></label>
                    <ul id="idiomas" style="display: ;">
                    <?php if($idiomas != null):
                        foreach ($idiomas as $i ):?>
                    <li><label><?=$i->idioma?></label></li>

                  <?php 
                        endforeach;
                  endif;?>
                    </ul>
                </div>


                <div class="one_half last">
                  <label onclick="$('#categorias').toggle();"><strong>Áreas de conocimiento</strong></label>
                  <ul id="categorias" style="display: ;">
                    <?php if($conocimientos != null):
                        foreach ($conocimientos as $i ):?>
                    <li><label><?=$i->categoria?></label></li>

                  <?php 
                        endforeach;
                  endif;?>

                    </ul>
                    
                   
                </div>
                
                
                

                    
            </form>
        
        </div>

  </div>



</div><!-- end content area -->

  </div>


</div>
</div><!-- end content area -->



<div class="clearfix"></div>



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

<a href="#" class="scrollup">Scroll</a><!-- end scroll to top of the page-->
    
</div>



</body>
</html>
