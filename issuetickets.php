<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
// Verificamos si el usuario está logueado
if (strlen($_SESSION['login']) == 0) {
	// Si no está logueado, redirigimos al index
	header('location:index.php');
} else {
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
		<!-- Header -->
		<div class="top-header">
			<?php include('includes/header.php'); ?>
			<!-- Banner -->
			<div class="banner-1 ">
				<div class="container">
					<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
				</div>
			</div>
			<!-- Sección de privacidad/quejas -->
			<div class="privacy">
				<div class="container">
					<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Historial de quejas</h3>
					<form name="chngpwd" method="post" onSubmit="return valid();">
						<!-- Mensajes de error o éxito -->
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>EXITOSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<p>
						<!-- Tabla de quejas -->
						<table border="1" width="100%">
							<tr align="center">
								<th>#</th>
								<th>Id de entradas</th>
								<th>Asunto</th>
								<th>Descripción</th>
								<th>Observación del administrador</th>
								<th>Fecha de registro</th>
								<th>Fecha de observación</th>
							</tr>
							<?php
							// Obtenemos el email del usuario
							$uemail = $_SESSION['login'];;
							// Consultamos las quejas del usuario
							$sql = "SELECT * from tblissues where UserEmail=:uemail";
							$query = $dbh->prepare($sql);
							$query->bindParam(':uemail', $uemail, PDO::PARAM_STR);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);
							$cnt = 1;
							// Si hay quejas, las mostramos
							if ($query->rowCount() > 0) {
								foreach ($results as $result) {	?>
									<tr align="center">
										<td><?php echo htmlentities($cnt); ?></td>
										<td width="100">#TKT-<?php echo htmlentities($result->id); ?></td>
										<td><?php echo htmlentities($result->Issue); ?></td>
										<td width="300"><?php echo htmlentities($result->Description); ?></td>
										<td><?php echo htmlentities($result->AdminRemark); ?></td>
										<td width="100"><?php echo htmlentities($result->PostingDate); ?></td>
										<td width="100"><?php echo htmlentities($result->AdminremarkDate); ?></td>
									</tr>
							<?php $cnt = $cnt + 1;
								}
							} ?>
						</table>
						</p>
					</form>
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
<?php } ?>