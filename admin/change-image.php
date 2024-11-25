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
	// Obtener ID de imagen de la URL
	$imgid = intval($_GET['imgid']);
	// Verificar si se envió el formulario
	if (isset($_POST['submit'])) {
		// Obtener datos de la imagen
		$pimage = $_FILES["packageimage"]["name"];
		// Mover imagen subida a carpeta de destino
		move_uploaded_file($_FILES["packageimage"]["tmp_name"], "pacakgeimages/" . $_FILES["packageimage"]["name"]);
		// Consulta SQL para actualizar imagen
		$sql = "update TblTourPackages set PackageImage=:pimage where PackageId=:imgid";
		$query = $dbh->prepare($sql);
		// Vincular parámetros
		$query->bindParam(':imgid', $imgid, PDO::PARAM_STR);
		$query->bindParam(':pimage', $pimage, PDO::PARAM_STR);
		// Ejecutar consulta
		$query->execute();
		// Mensaje de éxito
		$msg = "Paquete creado exitosamente";
	}

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>CQ | Creación del paquete de administración</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="Pooled Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="js/jquery-2.1.4.min.js"></script>
		<!-- Fuentes de Google -->
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- Iconos -->
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
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
		<!-- Contenedor principal -->
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
					<li class="breadcrumb-item"><a href="index.html">Inicio</a><i class="fa fa-angle-right"></i>Actualizar imagen del paquete</li>
				</ol>
				<!-- Grid -->
				<div class="grid-form">

					<!---->
					<div class="grid-form1">
						<h3>Actualizar imagen del paquete </h3>
						<!-- Mostrar mensajes de error/éxito -->
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>COMPLETADO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
						<div class="tab-content">
							<div class="tab-pane active" id="horizontal-form">
								<!-- Formulario para actualizar imagen -->
								<form class="form-horizontal" name="package" method="post" enctype="multipart/form-data">
									<?php
									// Obtener imagen actual del paquete
									$imgid = intval($_GET['imgid']);
									$sql = "SELECT PackageImage from TblTourPackages where PackageId=:imgid";
									$query = $dbh->prepare($sql);
									$query->bindParam(':imgid', $imgid, PDO::PARAM_STR);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = 1;
									if ($query->rowCount() > 0) {
										foreach ($results as $result) {	?>
											<!-- Mostrar imagen actual -->
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label"> Imagen del paquete </label>
												<div class="col-sm-8">
													<img src="pacakgeimages/<?php echo htmlentities($result->PackageImage); ?>" width="200">
												</div>
											</div>
											<!-- Campo para nueva imagen -->
											<div class="form-group">
												<label for="focusedinput" class="col-sm-2 control-label">Nueva imagen</label>
												<div class="col-sm-8">
													<input type="file" name="packageimage" id="packageimage" required>
												</div>
											</div>
									<?php }
									} ?>
									<!-- Botón de actualizar -->
									<div class="row">
										<div class="col-sm-8 col-sm-offset-2">
											<button type="submit" name="submit" class="btn-primary btn">Actualizar</button>

										</div>
									</div>





							</div>

							</form>





							<div class="panel-footer">

							</div>
							</form>
						</div>
					</div>
					<!--//grid-->

					<!-- Script para navegación sticky -->
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
					<!-- /script-for sticky-nav -->
					<!--inner block start here-->
					<div class="inner-block">

					</div>
					<!--inner block end here-->
					<!-- Footer -->
					<?php include('includes/footer.php'); ?>
					<!--COPY rights end here-->
				</div>
			</div>
			<!--//content-inner-->
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
		<!-- Scripts JS -->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- /Bootstrap Core JavaScript -->

	</body>

	</html>
<?php } ?>