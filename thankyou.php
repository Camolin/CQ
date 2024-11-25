<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
?>
<!DOCTYPE HTML>
<html>
<head>
<!-- Título de la página -->
<title>CQ | Confirmación </title>
<!-- Meta tags para configuración de viewport y codificación -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Script para ocultar la barra de URL en móviles -->
<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Hojas de estilo -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link href="css/style_copy.css" rel='stylesheet' type='text/css' />
<!-- Fuentes de Google -->
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
<link href="css/font-awesome.css" rel="stylesheet">
<!-- Scripts -->
<script src="js/jquery-1.12.0.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!-- Animaciones -->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
</head>
<body>
<!-- Incluimos el header -->
<?php include('includes/header.php');?>
<!-- Banner -->
<div class="banner-1 ">
	<div class="container">
		<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
	</div>
</div>
<!-- Sección de contacto -->
<div class="contact">
	<div class="container">
	<h3> Confirmación</h3>
		<div class="col-md-10 contact-left">
			<div class="con-top animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp;">
	
              <!-- Mostramos el mensaje de confirmación -->
              <h4>  <?php echo htmlentities($_SESSION['msg']);?></h4>
            
			</div>
		
			<div class="clearfix"></div>
	</div>
</div>
<!-- Incluimos el footer y modales -->
<?php include('includes/footer.php');?>
<!-- Modal de registro -->
<?php include('includes/signup.php');?>	
<!-- Modal de inicio de sesión -->
<?php include('includes/signin.php');?>	
<!-- Modal de contacto -->
<?php include('includes/write-us.php');?>	
</body>
</html>