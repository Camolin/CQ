<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
// Si se envió el formulario de consulta
if (isset($_POST['submit1'])) {
	// Obtenemos los datos del formulario
	$fname = $_POST['fname'];
	$email = $_POST['email'];
	$mobile = $_POST['mobileno'];
	$subject = $_POST['subject'];
	$description = $_POST['description'];
	// Preparamos la consulta SQL para insertar los datos
	$sql = "INSERT INTO  tblenquiry(FullName,EmailId,MobileNumber,Subject,Description) VALUES(:fname,:email,:mobile,:subject,:description)";
	$query = $dbh->prepare($sql);
	// Vinculamos los parámetros
	$query->bindParam(':fname', $fname, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
	$query->bindParam(':subject', $subject, PDO::PARAM_STR);
	$query->bindParam(':description', $description, PDO::PARAM_STR);
	// Ejecutamos la consulta
	$query->execute();
	// Obtenemos el ID del último registro insertado
	$lastInsertId = $dbh->lastInsertId();
	// Si se insertó correctamente
	if ($lastInsertId) {
		$msg = "Consulta enviada con éxito";
	} else {
		$error = "Algo salió mal. Inténtalo de nuevo";
	}
}

?>
<!DOCTYPE HTML>
<html>

<head>
	<!-- Título de la página -->
	<title>TMS | Sistema de Gestión Turística</title>
	<!-- Meta tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Tourism Management System In PHP" />
	<!-- Script para ocultar URL en móviles -->
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
	<!-- Estilos para mensajes de error y éxito -->
	<style>
		.errorWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #dd3d36;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}

		.succWrap {
			padding: 10px;
			margin: 0 0 20px 0;
			background: #fff;
			border-left: 4px solid #5cb85c;
			-webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
			box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
		}
	</style>
</head>

<body>
	<!-- Cabecera superior -->
	<div class="top-header">
		<?php include('includes/header.php'); ?>
		<!-- Banner -->
		<div class="banner-1 ">
			<div class="container">
				<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
			</div>
		</div>
		<!-- Sección de privacidad -->
		<div class="privacy">
			<div class="container">
				<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Formulario de consulta</h3>
				<!-- Formulario de consulta -->
				<form name="enquiry" method="post">
					<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>EXITOSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
					<p style="width: 350px;">
						<!-- Campo nombre completo -->
						<b>Nombre completo</b> <input type="text" name="fname" class="form-control" id="fname" placeholder="Nombre completo" required="">
					</p>
					<p style="width: 350px;">
						<!-- Campo correo -->
						<b>Correo</b> <input type="email" name="email" class="form-control" id="email" placeholder="Validar Id correo" required="">
					</p>

					<p style="width: 350px;">
						<!-- Campo número celular -->
						<b>No. Celular</b> <input type="text" name="mobileno" class="form-control" id="mobileno" maxlength="10" placeholder="N. de diez digitos" required="">
					</p>

					<p style="width: 350px;">
						<!-- Campo asunto -->
						<b>Asunto</b> <input type="text" name="subject" class="form-control" id="subject" placeholder="Asunto" required="">
					</p>
					<p style="width: 350px;">
						<!-- Campo descripción -->
						<b>Descripción</b> <textarea name="description" class="form-control" rows="6" cols="50" id="description" placeholder="Descripción" required=""></textarea>
					</p>

					<p style="width: 350px;">
						<!-- Botón enviar -->
						<button type="submit" name="submit1" class="btn-primary btn">Enviar</button>
					</p>
				</form>


			</div>
		</div>
		<!-- Incluimos el pie de página -->
		<?php include('includes/footer.php'); ?>
		<!-- Incluimos el formulario de registro -->
		<?php include('includes/signup.php'); ?>
		<!-- Incluimos el formulario de inicio de sesión -->
		<?php include('includes/signin.php'); ?>
		<!-- Incluimos el formulario de contacto -->
		<?php include('includes/write-us.php'); ?>
</body>

</html>