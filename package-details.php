<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
// Si se envió el formulario de reserva
if (isset($_POST['submit2'])) {
	// Obtenemos el ID del paquete de la URL
	$pid = intval($_GET['pkgid']);
	// Obtenemos el email del usuario de la sesión
	$useremail = $_SESSION['login'];
	// Obtenemos las fechas y comentario del formulario
	$fromdate = $_POST['fromdate'];
	$todate = $_POST['todate'];
	$comment = $_POST['comment'];
	// Estado inicial de la reserva
	$status = 0;
	// Preparamos la consulta SQL para insertar la reserva
	$sql = "INSERT INTO tblbooking(PackageId,UserEmail,FromDate,ToDate,Comment,status) VALUES(:pid,:useremail,:fromdate,:todate,:comment,:status)";
	$query = $dbh->prepare($sql);
	// Vinculamos los parámetros
	$query->bindParam(':pid', $pid, PDO::PARAM_STR);
	$query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
	$query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
	$query->bindParam(':todate', $todate, PDO::PARAM_STR);
	$query->bindParam(':comment', $comment, PDO::PARAM_STR);
	$query->bindParam(':status', $status, PDO::PARAM_STR);
	// Ejecutamos la consulta
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();
	// Verificamos si se insertó correctamente
	if ($lastInsertId) {
		$msg = "Reservado con éxito.";
	} else {
		$error = "Algo salió mal. Inténtalo de nuevo";
	}
}
?>
<!DOCTYPE HTML>
<html>

<head>
	<!-- Título de la página -->
	<title>CQ | Detalles del paquete</title>
	<!-- Meta tags -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
	<link rel="stylesheet" href="css/jquery-ui.css" />
	<script>
		new WOW().init();
	</script>
	<script src="js/jquery-ui.js"></script>
	<!-- Script para inicializar los datepickers -->
	<script>
		$(function() {
			$("#datepicker,#datepicker1").datepicker();
		});
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
	<!-- Incluimos el header -->
	<?php include('includes/header.php'); ?>
	<!-- Banner -->
	<div class="banner-3">
		<div class="container">
			<h1 class="wow zoomIn animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: zoomIn;">Chompi en Quibdó</h1>
		</div>
	</div>
	<!-- Sección de selección de habitación/paquete -->
	<div class="selectroom">
		<div class="container">
			<!-- Mostramos mensajes de error o éxito -->
			<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>COMPLETADO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
			<?php
			// Obtenemos el ID del paquete de la URL
			$pid = intval($_GET['pkgid']);
			// Consultamos los detalles del paquete
			$sql = "SELECT * from tbltourpackages where PackageId=:pid";
			$query = $dbh->prepare($sql);
			$query->bindParam(':pid', $pid, PDO::PARAM_STR);
			$query->execute();
			$results = $query->fetchAll(PDO::FETCH_OBJ);
			$cnt = 1;
			// Si encontramos el paquete
			if ($query->rowCount() > 0) {
				foreach ($results as $result) {	?>

					<form name="book" method="post">
						<div class="selectroom_top">
							<!-- Imagen del paquete -->
							<div class="col-md-4 selectroom_left wow fadeInLeft animated" data-wow-delay=".5s">
								<img src="admin/pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" class="img-responsive" alt="">
							</div>
							<!-- Detalles del paquete -->
							<div class="col-md-8 selectroom_right wow fadeInRight animated" data-wow-delay=".5s">
								<h2><?php echo htmlentities($result->PackageName); ?></h2>
								<p class="dow">#Paquete-<?php echo htmlentities($result->PackageId); ?></p>
								<p><b>Tipo de paquete :</b> <?php echo htmlentities($result->PackageType); ?></p>
								<p><b>Ubicación del paquete :</b> <?php echo htmlentities($result->PackageLocation); ?></p>
								<p><b>Características</b> <?php echo htmlentities($result->PackageFetures); ?></p>
								<!-- Selector de fechas -->
								<div class="ban-bottom">
									<div class="bnr-right">
										<label class="inputLabel">Salida</label>
										<input class="date" id="datepicker" type="text" placeholder="dd-mm-yyyy" name="fromdate" required="">
									</div>
									<div class="bnr-right">
										<label class="inputLabel">Vuelta</label>
										<input class="date" id="datepicker1" type="text" placeholder="dd-mm-yyyy" name="todate" required="">
									</div>
								</div>
								<div class="clearfix"></div>
								<!-- Precio total -->
								<div class="grand">
									<p>Gran Total</p>
									<h3>COP <?php echo htmlentities($result->PackagePrice); ?></h3>
								</div>
							</div>
							<!-- Detalles adicionales del paquete -->
							<h3>Detalles del paquete</h3>
							<p style="padding-top: 1%"><?php echo htmlentities($result->PackageDetails); ?> </p>
							<div class="clearfix"></div>
						</div>
						<!-- Sección de viajes -->
						<div class="selectroom_top">
							<h2>Viajes</h2>
							<div class="selectroom-info animated wow fadeInUp animated" data-wow-duration="1200ms" data-wow-delay="500ms" style="visibility: visible; animation-duration: 1200ms; animation-delay: 500ms; animation-name: fadeInUp; margin-top: -70px">
								<ul>
									<!-- Campo de comentarios -->
									<li class="spe">
										<label class="inputLabel">Comentario</label>
										<input class="special" type="text" name="comment" required="">
									</li>
									<!-- Botón de reserva según el estado de la sesión -->
									<?php if ($_SESSION['login']) { ?>
										<li class="spe" align="center">
											<button type="submit" name="submit2" class="btn-primary btn">Reservar</button>
										</li>
									<?php } else { ?>
										<li class="sigi" align="center" style="margin-top: 1%">
											<a href="#" data-toggle="modal" data-target="#myModal4" class="btn-primary btn"> Reservar</a>
										</li>
									<?php } ?>
									<div class="clearfix"></div>
								</ul>
							</div>

						</div>
					</form>
			<?php }
			} ?>


		</div>
	</div>
	<!-- Incluimos el footer y modales -->
	<?php include('includes/footer.php'); ?>
	<!-- Modal de registro -->
	<?php include('includes/signup.php'); ?>
	<!-- Modal de inicio de sesión -->
	<?php include('includes/signin.php'); ?>
	<!-- Modal de contacto -->
	<?php include('includes/write-us.php'); ?>
</body>

</html>