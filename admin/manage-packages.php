<?php
// Iniciar sesión
session_start();
// Desactivar reporte de errores
error_reporting(0);
// Incluir archivo de configuración
include('includes/config.php');
// Verificar si el usuario está logueado
if (strlen($_SESSION['alogin']) == 0) {
	// Redireccionar a página de login si no está logueado
	header('location:index.php');
} else {
?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<!-- Título de la página -->
		<title>CQ | Admin administrar paquetes</title>
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
		<!-- Archivos CSS para tablas -->
		<link rel="stylesheet" type="text/css" href="css/table-style.css" />
		<link rel="stylesheet" type="text/css" href="css/basictable.css" />
		<script type="text/javascript" src="js/jquery.basictable.min.js"></script>
		<!-- Script para inicializar tablas -->
		<script type="text/javascript">
			$(document).ready(function() {
				// Tabla básica
				$('#table').basictable();

				// Tabla con punto de quiebre
				$('#table-breakpoint').basictable({
					breakpoint: 768
				});

				// Tabla con ejes intercambiados
				$('#table-swap-axis').basictable({
					swapAxis: true
				});

				// Tabla sin forzar responsividad
				$('#table-force-off').basictable({
					forceResponsive: false
				});

				// Tabla sin redimensionamiento
				$('#table-no-resize').basictable({
					noResize: true
				});

				// Tabla de dos ejes
				$('#table-two-axis').basictable();

				// Tabla con altura máxima
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
	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="mother-grid-inner">
					<!-- Incluir header -->
					<?php include('includes/header.php'); ?>
					<div class="clearfix"> </div>
				</div>
				<!-- Breadcrumb -->
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index.html">Inicio</a><i class="fa fa-angle-right"></i>Administrar paquetes</li>
				</ol>
				<div class="agile-grids">
					<!-- Sección de tablas -->
					<div class="agile-tables">
						<div class="w3l-table-info">
							<h2>Administrar paquetes</h2>
							<!-- Tabla de paquetes -->
							<table id="table">
								<thead>
									<tr>
										<th>#</th>
										<th>Nombre</th>
										<th>Tipo</th>
										<th>Ubicación</th>
										<th>Precio</th>
										<th>Fecha de creación</th>
										<th>Acción</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									// Consulta para obtener paquetes
									$sql = "SELECT * from TblTourPackages";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									// Mostrar resultados si hay registros
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {				?>
											<tr>
												<td><?php echo htmlentities($cnt); ?></td>
												<td><?php echo htmlentities($result->PackageName); ?></td>
												<td><?php echo htmlentities($result->PackageType); ?></td>
												<td><?php echo htmlentities($result->PackageLocation); ?></td>
												<td>$<?php echo htmlentities($result->PackagePrice); ?></td>
												<td><?php echo htmlentities($result->Creationdate); ?></td>
												<td><a href="update-package.php?pid=<?php echo htmlentities($result->PackageId); ?>"><button type="button" class="btn btn-primary btn-block">Ver detalles</button></a></td>
											</tr>
									<?php $cnt = $cnt + 1;
										}
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
					<!-- Bloque interno -->
					<div class="inner-block">
					</div>
					<!-- Footer -->
					<?php include('includes/footer.php'); ?>
				</div>
			</div>
			<!-- Menú lateral -->
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
		<script src="js/bootstrap.min.js"></script>
	</body>
	</html>
<?php } ?>