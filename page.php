<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
// Procesamos el envío del formulario de consulta
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
	$lastInsertId = $dbh->lastInsertId();
	// Verificamos si se insertó correctamente
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
	<title>CQ | Sistema de Gestión Turística</title>
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
	<!-- Cabecera -->
	<div class="top-header">
		<?php include('includes/header.php'); ?>
		<!-- Banner -->
		<div class="banner-1 ">
			<div class="container">
				<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
			</div>
		</div>
		<!-- Contenido principal -->
		<div class="privacy">
			<div class="container">
				<?php
				// Obtenemos el tipo de página
				$pagetype = $_GET['type'];
				// Consultamos los detalles de la página
				$sql = "SELECT type,detail from tblpages where type=:pagetype";
				$query = $dbh->prepare($sql);
				$query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
				$query->execute();
				$results = $query->fetchAll(PDO::FETCH_OBJ);
				$cnt = 1;
				if ($query->rowCount() > 0) {
					foreach ($results as $result) {

				?>

						<!-- Título de la página -->
						<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
							<?php
							// Array con nombres amigables para las páginas
							$friendly_names = array(
								'aboutus' => 'Sobre Nosotros',
								'privacy' => 'Privacidad', 
								'terms' => 'Términos y Condiciones',
								'contact' => 'Contacto'
							);
							// Mostramos el nombre amigable si existe, sino el tipo original
							echo isset($friendly_names[$_GET['type']]) ? $friendly_names[$_GET['type']] : $_GET['type'];
							?>
						</h3>

						<!-- Contenido de la página -->
						<p>
							<?php echo $result->detail; ?>
						</p>
				<?php }
				} ?>

			</div>
		</div>
		<!-- Footer y modales -->
		<?php include('includes/footer.php'); ?>
		<!-- Modal de registro -->
		<?php include('includes/signup.php'); ?>
		<!-- Modal de inicio de sesión -->
		<?php include('includes/signin.php'); ?>
		<!-- Modal de contacto -->
		<?php include('includes/write-us.php'); ?>
</body>

</html>