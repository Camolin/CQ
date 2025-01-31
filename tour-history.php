<?php
// Iniciamos la sesión
session_start();
// Desactivamos el reporte de errores
error_reporting(0);
// Incluimos el archivo de configuración
include('includes/config.php');
// Verificamos si el usuario está logueado
if (strlen($_SESSION['login']) == 0) {
	header('location:index.php');
} else {
	// Procesamos la cancelación de reserva si se recibe un ID
	if (isset($_REQUEST['bkid'])) {
		$bid = intval($_GET['bkid']);
		$email = $_SESSION['login'];
		// Consultamos la fecha de la reserva
		$sql = "SELECT FromDate FROM tblbooking WHERE UserEmail=:email and BookingId=:bid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':bid', $bid, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		if ($query->rowCount() > 0) {
			foreach ($results as $result) {
				$fdate = $result->FromDate;

				// Convertimos y comparamos las fechas
				$a = explode("/", $fdate);
				$val = array_reverse($a);
				$mydate = implode("/", $val);
				$cdate = date('Y/m/d');
				$date1 = date_create("$cdate");
				$date2 = date_create("$fdate");
				$diff = date_diff($date1, $date2);
				echo $df = $diff->format("%a");
				// Si faltan más de 24h permitimos cancelar
				if ($df > 1) {
					$status = 2;
					$cancelby = 'u';
					$sql = "UPDATE tblbooking SET status=:status,CancelledBy=:cancelby WHERE UserEmail=:email and BookingId=:bid";
					$query = $dbh->prepare($sql);
					$query->bindParam(':status', $status, PDO::PARAM_STR);
					$query->bindParam(':cancelby', $cancelby, PDO::PARAM_STR);
					$query->bindParam(':email', $email, PDO::PARAM_STR);
					$query->bindParam(':bid', $bid, PDO::PARAM_STR);
					$query->execute();

					$msg = "Reserva cancelada con éxito";
				} else {
					$error = "No se puede cancelar la reserva antes de las 24 horas.";
				}
			}
		}
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>CQ | Sistema de Gestión Turística</title>
		<!-- Meta tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Tourism Management System In PHP" />
		<!-- Script para ocultar la barra de URL en móviles -->
		<script type="applijewelleryion/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Hojas de estilo -->
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<link href="css/style_copy.css" rel='stylesheet' type='text/css' />
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
					<h3 class="wow fadeInDown animated animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">Mi historial de reservas</h3>
					<form name="chngpwd" method="post" onSubmit="return valid();">
						<!-- Mensajes de error y éxito -->
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>ÉXITOSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<p>
						<!-- Tabla de reservas -->
						<table border="1" width="100%">
							<tr align="center">
								<th>#</th>
								<th>ID de reserva</th>
								<th>Nombre del paquete</th>
								<th>Desde</th>
								<th>Hacia</th>
								<th>Comentario</th>
								<th>Estado</th>
								<th>Fecha para registrarse</th>
								<th>Acción</th>
							</tr>
							<?php
							// Consultamos las reservas del usuario
							$uemail = $_SESSION['login'];;
							$sql = "SELECT tblbooking.BookingId as bookid,tblbooking.PackageId as pkgid,tbltourpackages.PackageName as packagename,tblbooking.FromDate as fromdate,tblbooking.ToDate as todate,tblbooking.Comment as comment,tblbooking.status as status,tblbooking.RegDate as regdate,tblbooking.CancelledBy as cancelby,tblbooking.UpdationDate as upddate from tblbooking join tbltourpackages on tbltourpackages.PackageId=tblbooking.PackageId where UserEmail=:uemail";
							$query = $dbh->prepare($sql);
							$query->bindParam(':uemail', $uemail, PDO::PARAM_STR);
							$query->execute();
							$results = $query->fetchAll(PDO::FETCH_OBJ);
							$cnt = 1;
							if ($query->rowCount() > 0) {
								foreach ($results as $result) {	?>
									<tr align="center">
										<td><?php echo htmlentities($cnt); ?></td>
										<td>#BK<?php echo htmlentities($result->bookid); ?></td>
										<td><a href="package-details.php?pkgid=<?php echo htmlentities($result->pkgid); ?>"><?php echo htmlentities($result->packagename); ?></a></td>
										<td><?php echo htmlentities($result->fromdate); ?></td>
										<td><?php echo htmlentities($result->todate); ?></td>
										<td><?php echo htmlentities($result->comment); ?></td>
										<td><?php if ($result->status == 0) {
												echo "Pendiente";
											}
											if ($result->status == 1) {
												echo "Confirmado";
											}
											if ($result->status == 2 and  $result->cancelby == 'u') {
												echo "Cancelado por usted en " . $result->upddate;
											}
											if ($result->status == 2 and $result->cancelby == 'a') {
												echo "Cancelado por el administrador en " . $result->upddate;
											}
											?></td>
										<td><?php echo htmlentities($result->regdate); ?></td>
										<?php if ($result->status == 2) {
										?><td>Cancelado</td>
										<?php } else { ?>
											<td><a href="tour-history.php?bkid=<?php echo htmlentities($result->bookid); ?>" onclick="return confirm('¿Realmente quieres cancelar la reserva?')">Cancelar</a></td>
										<?php } ?>
									</tr>
							<?php $cnt = $cnt + 1;
								}
							} ?>
						</table>

						</p>
					</form>


				</div>
			</div>
			<!-- Pie de página y modales -->
			<?php include('includes/footer.php'); ?>
			<!-- Signup modal -->
			<?php include('includes/signup.php'); ?>
			<!-- Signin modal -->
			<?php include('includes/signin.php'); ?>
			<!-- Write us modal -->
			<?php include('includes/write-us.php'); ?>
	</body>

	</html>
<?php } ?>