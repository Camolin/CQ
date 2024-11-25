<?php
// Iniciar sesión
session_start();
// Desactivar reporte de errores
error_reporting(0);
// Incluir archivo de configuración
include('includes/config.php');
// Verificar si el usuario está logueado
if (strlen($_SESSION['alogin']) == 0) {
	// Redireccionar si no está logueado
	header('location:index.php');
} else {
	// Código para marcar consulta como leída
	if (isset($_REQUEST['eid'])) {
		// Obtener ID de consulta
		$eid = intval($_GET['eid']);
		// Estado 1 = leído
		$status = 1;

		// Actualizar estado en base de datos
		$sql = "UPDATE tblenquiry SET Status=:status WHERE  id=:eid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':eid', $eid, PDO::PARAM_STR);
		$query->execute();

		// Mensaje de éxito
		$msg = "Consulta leída exitosamente";
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<!-- Título de la página -->
		<title>CQ | Administrador gestionar reservas</title>
		<!-- Meta tags -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<!-- Script para ocultar barra URL -->
		<script type="application/x-javascript">
			addEventListener("load", function() {
				setTimeout(hideURLbar, 0);
			}, false);

			function hideURLbar() {
				window.scrollTo(0, 1);
			}
		</script>
		<!-- Archivos CSS -->
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<link href="css/style_copy.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="js/jquery-2.1.4.min.js"></script>
		<!-- CSS para tablas -->
		<link rel="stylesheet" type="text/css" href="css/table-style.css" />
		<link rel="stylesheet" type="text/css" href="css/basictable.css" />
		<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
		<!-- Script para inicializar tablas -->
		<script type="text/javascript">
			$(document).ready(function() {
				$('#table').basictable();

				$('#table-breakpoint').basictable({
					breakpoint: 768
				});

				$('#table-swap-axis').basictable({
					swapAxis: true
				});

				$('#table-force-off').basictable({
					forceResponsive: false
				});

				$('#table-no-resize').basictable({
					noResize: true
				});

				$('#table-two-axis').basictable();

				$('#table-max-height').basictable({
					tableWrapper: true
				});
			});
		</script>
		<!-- Fuentes de Google -->
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- Iconos -->
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
		<!-- Estilos para mensajes de error/éxito -->
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
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="mother-grid-inner">
					<!--header start here-->
					<?php include('includes/header.php'); ?>
					<div class="clearfix"> </div>
				</div>
				<!--heder end here-->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Inicio</a><i class="fa fa-angle-right"></i>Gestionar consultas</li>
				</ol>
				<div class="agile-grids">
					<!-- Mostrar mensajes de error/éxito -->
					<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>EXITOSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
					<div class="agile-tables">
						<div class="w3l-table-info">
							<h2>Gestionar consultas</h2>
							<!-- Tabla de consultas -->
							<table id="table">
								<thead>
									<tr>
										<th>Ticket id</th>
										<th>Nombre</th>
										<th>No. Celular/ Correo</th>
										<th>Asunto </th>
										<th>Descripción </th>
										<th>Fecha de publicación </th>
										<th>Acción </th>
									</tr>
								</thead>
								<tbody>
									<?php 
									// Consulta para obtener todas las consultas
									$sql = "SELECT * from tblenquiry";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);

									// Mostrar resultados si hay registros
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td width="120">#TCKT-<?php echo htmlentities($result->id); ?></td>
												<td width="50"><?php echo htmlentities($result->FullName); ?></td>
												<td width="50"><?php echo htmlentities($result->MobileNumber); ?> /<br />
													<?php echo $result->EmailId; ?></td>
												<td width="200"><?php echo htmlentities($result->Subject); ?></a></td>
												<td width="400"><?php echo htmlentities($result->Description); ?></td>
												<td width="50"><?php echo htmlentities($result->PostingDate); ?></td>
												<?php if ($result->Status == 1) {
												?><td>Leer</td>
												<?php } else { ?>
													<td><a href="manage-enquires.php?eid=<?php echo htmlentities($result->id); ?>" onclick="return confirm('¿De verdad quieres leer?')">Pendiente</a>
													</td>
												<?php } ?>
											</tr>
									<?php }
									} ?>
								</tbody>
							</table>
						</div>
						</table>
					</div>
					<!-- Script para navegación fija -->
					<script>
						$(document).ready(function() {
							var navoffeset = $(".header-main").offset().top;
							$(window).scroll(function() {
								var scrollpos = $(window).scrollTop();
								if (scrollpos >= navoffeset) {
									$(".header-main").addClass("fixed");
								} else {
									$(".header-main").removeClass("fixed");
								}
							});

						});
					</script>
					<!--inner block start here-->
					<div class="inner-block">

					</div>
					<!--inner block end here-->
					<!--copy rights start here-->
					<?php include('includes/footer.php'); ?>
					<!--COPY rights end here-->
				</div>
			</div>
			<!--//content-inner-->
			<!--/sidebar-menu-->
			<?php include('includes/sidebarmenu.php'); ?>
			<div class="clearfix"></div>
		</div>
		<!-- Script para toggle del sidebar -->
		<script>
			var toggle = true;

			$(".sidebar-icon").click(function() {
				if (toggle) {
					$(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
					$("#menu span").css({
						"position": "absolute"
					});
				} else {
					$(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
					setTimeout(function() {
						$("#menu span").css({
							"position": "relative"
						});
					}, 400);
				}

				toggle = !toggle;
			});
		</script>
		<!-- Scripts adicionales -->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
	</body>

	</html>
<?php } ?>