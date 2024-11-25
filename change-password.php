<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
// Verificamos si el usuario está logueado
if (strlen($_SESSION['login']) == 0) {
	// Si no está logueado redirigimos al index
	header('location:index.php');
} else {
	// Si se envió el formulario de cambio de contraseña
	if (isset($_POST['submit5'])) {
		// Encriptamos la contraseña actual
		$password = md5($_POST['password']);
		// Encriptamos la nueva contraseña
		$newpassword = md5($_POST['newpassword']);
		// Obtenemos el email de la sesión
		$email = $_SESSION['login'];
		// Consulta SQL para verificar la contraseña actual
		$sql = "SELECT Password FROM tblusers WHERE EmailId=:email and Password=:password";
		$query = $dbh->prepare($sql);
		// Vinculamos los parámetros
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		// Ejecutamos la consulta
		$query->execute();
		// Obtenemos los resultados
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		// Si encontramos resultados
		if ($query->rowCount() > 0) {
			// Actualizamos la contraseña
			$con = "update tblusers set Password=:newpassword where EmailId=:email";
			$chngpwd1 = $dbh->prepare($con);
			$chngpwd1->bindParam(':email', $email, PDO::PARAM_STR);
			$chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
			$chngpwd1->execute();
			// Mensaje de éxito
			$msg = "Su Contraseña cambió exitosamente";
		} else {
			// Mensaje de error
			$error = "Tu contraseña actual es incorrecta";
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
		<!-- Validación de contraseñas -->
		<script type="text/javascript">
			function valid() {
				if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
					alert("Los campos Nueva contraseña y Confirmar contraseña no coinciden  !!");
					document.chngpwd.confirmpassword.focus();
					return false;
				}
				return true;
			}
		</script>
		<!-- Estilos para mensajes -->
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
		<!-- Header -->
		<div class="top-header">
			<?php include('includes/header.php'); ?>
			<!-- Banner -->
			<div class="banner-1 ">
				<div class="container">
					<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
				</div>
			</div>
			<!-- Sección de cambio de contraseña -->
			<div class="privacy">
				<div class="container">
					<h3 class="wow fadeInDown animated animated text-center" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Cambiar la contraseña</h3>
					<!-- Formulario de cambio de contraseña -->
					<form name="chngpwd" method="post" onSubmit="return valid();" style="max-width: 350px; margin: 0 auto;">
						<!-- Mensajes de error/éxito -->
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>EXITOSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<!-- Campo contraseña actual -->
						<p>
							<b>Contraseña actual</b> 
							<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña actual" required="">
						</p>
						<!-- Campo nueva contraseña -->
						<p>
							<b>Nueva contraseña</b>
							<input type="password" class="form-control" name="newpassword" id="newpassword" placeholder="Nueva contraseña" required="">
						</p>
						<!-- Campo confirmar contraseña -->
						<p>
							<b>Confirmar Contraseña</b>
							<input type="password" class="form-control" name="confirmpassword" id="confirmpassword" placeholder="confirmar Contraseña" required="">
						</p>
						<!-- Botón de envío -->
						<p class="text-center">
							<button type="submit" name="submit5" class="btn-primary btn">Cambiar</button>
						</p>
					</form>

				</div>
			</div>
			<!-- Inclusión de archivos de pie de página -->
			<?php include('includes/footer.php'); ?>
			<!-- Modales de registro/inicio de sesión -->
			<?php include('includes/signup.php'); ?>
			<?php include('includes/signin.php'); ?>
			<!-- Modal de contacto -->
			<?php include('includes/write-us.php'); ?>
	</body>

	</html>
<?php } ?>