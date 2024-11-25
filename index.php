<?php
// Iniciamos la sesión para manejar variables de sesión del usuario
session_start();
// Desactivamos el reporte de errores por seguridad
error_reporting(0);
// Incluimos el archivo de configuración con las credenciales de la base de datos
include('includes/config.php');
?><!DOCTYPE HTML>
<html>

<head>
	<!-- Título de la página -->
	<title>CQ | Inicio</title>
	<!-- Meta tags para configuración de viewport y codificación -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<!-- Script para ocultar la barra de URL en dispositivos móviles -->
	<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- Enlace a Bootstrap 5 desde CDN -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<!-- Enlaces a hojas de estilo locales -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="css/style_copy.css" rel='stylesheet' type='text/css' />
	
	<!-- Enlaces a fuentes de Google -->
	<link href='//fonts.googleapis.com/css?family=Open+Sans:400,700,600' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Roboto+Condensed:400,700,300' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
	
	<!-- Enlace a Font Awesome -->
	<link href="css/font-awesome.css" rel="stylesheet">
	
	<!-- Scripts de jQuery y Bootstrap -->
	<script src="js/jquery-1.12.0.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	
	<!-- Archivos para animaciones -->
	<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="js/wow.min.js"></script>
	<script>
		// Inicialización de la librería WOW para animaciones
		new WOW().init();
	</script>
</head>

<body>
	<?php
	// Incluimos el header del sitio
	include('includes/header.php');
	?>

	<!-- Sección Hero con el título animado -->
	<section class="hero_area">
		<div class="hero_section">
			<div class="hero_detail">
				<!-- Título principal con animación de zoom -->
				<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">
					<span>
						C
					</span>
					<span>
						h
					</span>
					<span>
						o
					</span>
					<span>
						m
					</span>
					<span>
						p
					</span>
					<span>
						i
					</span>
					<br>
					<span>
						e
					</span>
					<span>
						n
					</span>
					<br>
					<span>
						Q
					</span>
					<span>
						u
					</span>
					<span>
						i
					</span>
					<span>
						b
					</span>
					<span>
						d
					</span>
					<span>
						ó
					</span>
				</h1>
			</div>
			<div class="hero_btn-box">

			</div>
		</div>
	</section>

	<!-- Sección Acerca de con información de Quibdó -->
	<section class="about_section layout_padding">
		<div class="about_container">
			<div class="container">
				<div class="detail">
					<h2 class="mb-3 custom_heading">
						¿Que es y donde esta Quibdo?
					</h2>
					<p>
						Quibdó es un municipio colombiano, capital del departamento del Chocó y una de las poblaciones más importantes en la Región del Pacífico Colombiano. La ciudad está ubicada en una de las regiones más biodiversas de Colombia, cerca de grandes reservas ecológicas como el parque nacional natural Emberá. También es una de las regiones con mayor número de reservas indígenas.
					</p>
					<div>
						<a class="btn btn-outline-secondary" href="https://www.google.com/search?gs_ssp=eJzj4tTP1TcwLjavNDVg9GIrLM1MSskHADQ5BZ8&client=opera-gx&q=quibdo&sourceid=opera&ie=UTF-8&oe=UTF-8">
							Leer mas.
						</a>
					</div>
				</div>
				<div class="detail-2">
					<p>
						Quibdó se encuentra situado sobre la margen derecha del río Atrato, uno de los principales afluentes del país y una de las zonas con más alta pluviosidad del mundo.
					</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Sección del mapa de Quibdó -->
	<section>
		<div class="container">
			<h3 style="color: #2c3e50;" class="fw-bold">Mapa de Quibdó</h3>
			<div class="row">
				<div id="map" class="mx-auto mt-5">
				</div>
			</div>
		</div>
	</section>

	<!-- Sección de paquetes turísticos -->
	<div class="container p-3 py-5">
	<h3 style="color: #2c3e50;" class="my-5 fw-bold">Algunos de nuestros paquetes turísticos</h3>
		<div class="row">
			<!-- Tarjeta de paquete El Malecón -->
			<div class="col-lg-4 col-md-6 mt-2 mb-2">
				<div class="card wow fadeInUp animated" style="width: 20rem;">
					<img src="images/male.jpeg" class="card-img-top" alt="foto de la Catedral">
					<div class="card-body">
						<h2 class="card-title fw-bold" style="color:#2c3e50">Nombre del paquete: El Malecon</h2>
						<h4 class="my-2">Tipo de paquete: Pareja</h4>
						<h4 class="my-2">Ubicación: Centro de Quibdó</h4>
						<div class="d-flex justify-content-end">
							<h5 class="">COP: $50.000</h5>
						</div>
						<a href="package-list.php" class="btn btn-outline-secondary px-5 py-2 fw-bold">Ver mas.</a>
					</div>
				</div>
			</div>

			<!-- Tarjeta de paquete La Catedral -->
			<div class="col-lg-4 col-md-6 mt-2 mb-2">
				<div class="card wow fadeInUp animated" style="width: 20rem;">
					<img src="images/cate.jpg" class="card-img-top" alt="foto de la Catedral">
					<div class="card-body">
						<h2 class="card-title fw-bold" style="color:#2c3e50">Nombre del paquete: La Catedral</h2>
						<h4 class="my-2">Tipo de paquete: Pareja</h4>
						<h4 class="my-2">Ubicación: Centro de Quibdó</h4>
						<div class="d-flex justify-content-end">
							<h5 class="">COP: $85.000</h5>
						</div>
						<a href="package-list.php" class="btn btn-outline-secondary px-5 py-2 fw-bold">Ver mas.</a>
					</div>
				</div>
			</div>

			<!-- Tarjeta de paquete Tutunendo Familiar -->
			<div class="col-lg-4 col-md-6 mt-2 mb-2">
				<div class="card wow fadeInUp animated" style="width: 20rem;">
					<img src="images/tutu.jpg" class="card-img-top" alt="foto de la Catedral">
					<div class="card-body">
						<h2 class="card-title fw-bold" style="color:#2c3e50">Nombre del paquete: Tutunendo</h2>
						<h4 class="my-2">Tipo de paquete: Familiar</h4>
						<h4 class="my-2">Ubicación: Quibdó</h4>
						<div class="d-flex justify-content-end">
							<h5 class="">COP: $130.000</h5>
						</div>
						<a href="package-list.php" class="btn btn-outline-secondary px-5 py-2 fw-bold">Ver mas.</a>
					</div>
				</div>
			</div>

			<!-- Tarjeta de paquete Tutunendo Individual -->
			<div class="col-lg-4 col-md-6 mt-2 mb-2">
				<div class="card wow fadeInUp animated" style="width: 20rem;">
					<img src="images/tutu.jpg" class="card-img-top" alt="foto de la Catedral">
					<div class="card-body">
						<h2 class="card-title fw-bold" style="color:#2c3e50">Nombre del paquete: Tutunendo</h2>
						<h4 class="my-2">Tipo de paquete: Individual</h4>
						<h4 class="my-2">Ubicación: Quibdó, Chocó</h4>
						<div class="d-flex justify-content-end">
							<h5 class="">COP: $80.000</h5>
						</div>
						<a href="package-list.php" class="btn btn-outline-secondary px-5 py-2 fw-bold">Ver mas.</a>
					</div>
				</div>
			</div>

			<!-- Tarjeta de paquete La Troje -->
			<div class="col-lg-4 col-md-6 mt-2 mb-2">
				<div class="card wow fadeInUp animated" style="width: 20rem;">
					<img src="images/latro1.jpg" class="card-img-top" alt="foto de la Catedral">
					<div class="card-body">
						<h2 class="card-title fw-bold" style="color:#2c3e50">Nombre del paquete: La Troje</h2>
						<h4 class="my-2">Tipo de paquete: Familiar</h4>
						<h4 class="my-2">Ubicación: Quibdó, Chocó</h4>
						<div class="d-flex justify-content-end">
							<h5 class="">COP: $200.000</h5>
						</div>
						<a href="package-list.php" class="btn btn-outline-secondary px-5 py-2 fw-bold">Ver mas.</a>
					</div>
				</div>
			</div>

			<!-- Tarjeta de paquete Zona Rosa -->
			<div class="col-lg-4 col-md-6 mt-2 mb-2">
				<div class="card wow fadeInUp animated" style="width: 20rem;">
					<img src="images/zonar.jpeg" class="card-img-top" alt="foto de la Catedral">
					<div class="card-body">
						<h2 class="card-title fw-bold" style="color:#2c3e50">Nombre del paquete: Zona Rosa</h2>
						<h4 class="my-2">Tipo de paquete: Familiar</h4>
						<h4 class="my-2">Ubicación: Quibdó, Chocó</h4>
						<div class="d-flex justify-content-end">
							<h5 class="">COP: $100.000</h5>
						</div>
						<a href="package-list.php" class="btn btn-outline-secondary px-5 py-2 fw-bold">Ver mas.</a>
					</div>
				</div>
			</div>

		</div>

		<div class="clearfix"></div>
	</div>

	</div>

	<!-- Scripts para el mapa de Google -->
	<script src="js/map.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDaeWicvigtP9xPv919E-RNoxfvC-Hqik&callback=initMap"></script>

	<!-- Inclusión de componentes del sitio -->
	<?php include('includes/footer.php'); ?>
	<!-- Formulario de registro -->
	<?php include('includes/signup.php'); ?>
	<!-- Formulario de inicio de sesión -->
	<?php include('includes/signin.php'); ?>
	<!-- Formulario de contacto -->
	<?php include('includes/write-us.php'); ?>

</body>

</html>
