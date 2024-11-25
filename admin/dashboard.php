<?php
// Iniciar sesión
session_start();
// Incluir archivo de configuración
include('includes/config.php');
// Verificar si el usuario está logueado
if (strlen($_SESSION['alogin']) == 0) {
	// Redireccionar si no está logueado
	header('location:index.php');
} else {
?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<!-- Título de la página -->
		<title>CQ | Panel de administración</title>
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
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="css/style_copy.css " rel='stylesheet' type='text/css' />
		<link rel="stylesheet" href="css/morris.css" type="text/css" />
		<!-- Graph CSS -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- jQuery -->
		<script src="js/jquery-2.1.4.min.js"></script>
		<!-- //jQuery -->
		<!-- Fuentes de Google -->
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
		<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
		<!-- Iconos -->
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
	</head>

	<body>
		<!-- Contenedor principal -->
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="mother-grid-inner">
					<!-- Incluir header -->
					<?php include('includes/header.php'); ?>
					<!-- Breadcrumb -->
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="index.html">Inicio</a> <i class="fa fa-angle-right"></i></li>
					</ol>
					<!-- Cuatro grids -->
					<div class="four-grids">
						<!-- Grid de usuarios -->
						<div class="col-md-3 four-grid">
							<div class="four-agileits">
								<div class="icon">
									<i class="glyphicon glyphicon-user" aria-hidden="true"></i>
								</div>
								<div class="four-text">
									<h3>User</h3>
									<!-- Consulta total usuarios -->
									<?php $sql = "SELECT id from tblusers";
									$query = $dbh->prepare($sql);
									$query->execute();
									$results = $query->fetchAll(PDO::FETCH_OBJ);
									$cnt = $query->rowCount();
									?> <h4> <?php echo htmlentities($cnt); ?> </h4>
								</div>
							</div>
						</div>
						<!-- Grid de reservaciones -->
						<div class="col-md-3 four-grid">
							<div class="four-agileinfo">
								<div class="icon">
									<i class="glyphicon glyphicon-list-alt" aria-hidden="true"></i>
								</div>
								<div class="four-text">
									<h3>Reservaciones</h3>
									<!-- Consulta total reservaciones -->
									<?php $sql1 = "SELECT BookingId from tblbooking";
									$query1 = $dbh->prepare($sql1);
									$query1->execute();
									$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
									$cnt1 = $query1->rowCount();
									?>
									<h4><?php echo htmlentities($cnt1); ?></h4>
								</div>
							</div>
						</div>
						<!-- Grid de consultas -->
						<div class="col-md-3 four-grid">
							<div class="four-w3ls">
								<div class="icon">
									<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
								</div>
								<div class="four-text">
									<h3>Consultas</h3>
									<!-- Consulta total consultas -->
									<?php $sql2 = "SELECT id from tblenquiry";
									$query2 = $dbh->prepare($sql2);
									$query2->execute();
									$results2 = $query2->fetchAll(PDO::FETCH_OBJ);
									$cnt2 = $query2->rowCount();
									?>
									<h4><?php echo htmlentities($cnt2); ?></h4>
								</div>
							</div>
						</div>
						<!-- Grid de paquetes -->
						<div class="col-md-3 four-grid">
							<div class="four-wthree">
								<div class="icon">
									<i class="glyphicon glyphicon-briefcase" aria-hidden="true"></i>
								</div>
								<div class="four-text">
									<h3>Paquetes totales</h3>
									<!-- Consulta total paquetes -->
									<?php $sql3 = "SELECT PackageId from tbltourpackages";
									$query3 = $dbh->prepare($sql3);
									$query3->execute();
									$results3 = $query3->fetchAll(PDO::FETCH_OBJ);
									$cnt3 = $query3->rowCount();
									?>
									<h4><?php echo htmlentities($cnt3); ?></h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

					<!-- Segundo grupo de grids -->
					<div class="four-grids">
						<!-- Grid de problemas -->
						<div class="col-md-3 four-grid">
							<div class="four-w3ls">
								<div class="icon">
									<i class="glyphicon glyphicon-folder-open" aria-hidden="true"></i>
								</div>
								<div class="four-text">
									<h3>Problemas planteados</h3>
									<!-- Consulta total problemas -->
									<?php $sql5 = "SELECT id from tblissues";
									$query5 = $dbh->prepare($sql5);
									$query5->execute();
									$results5 = $query5->fetchAll(PDO::FETCH_OBJ);
									$cnt5 = $query5->rowCount();
									?>
									<h4><?php echo htmlentities($cnt5); ?></h4>
								</div>
							</div>
						</div>
						<div class="clearfix"></div>
					</div>

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
		<!-- Scripts JS -->
		<script src="js/jquery.nicescroll.js"></script>
		<script src="js/scripts.js"></script>
		<!-- Bootstrap Core JavaScript -->
		<script src="js/bootstrap.min.js"></script>
		<!-- Morris JavaScript -->
		<script src="js/raphael-min.js"></script>
		<script src="js/morris.js"></script>
		<!-- Script para gráficos -->
		<script>
			$(document).ready(function() {
				//BOX BUTTON SHOW AND CLOSE
				jQuery('.small-graph-box').hover(function() {
					jQuery(this).find('.box-button').fadeIn('fast');
				}, function() {
					jQuery(this).find('.box-button').fadeOut('fast');
				});
				jQuery('.small-graph-box .box-close').click(function() {
					jQuery(this).closest('.small-graph-box').fadeOut(200);
					return false;
				});

				//CHARTS
				function gd(year, day, month) {
					return new Date(year, month - 1, day).getTime();
				}

				graphArea2 = Morris.Area({
					element: 'hero-area',
					padding: 10,
					behaveLikeLine: true,
					gridEnabled: false,
					gridLineColor: '#dddddd',
					axes: true,
					resize: true,
					smooth: true,
					pointSize: 0,
					lineWidth: 0,
					fillOpacity: 0.85,
					data: [{
							period: '2014 Q1',
							iphone: 2668,
							ipad: null,
							itouch: 2649
						},
						{
							period: '2014 Q2',
							iphone: 15780,
							ipad: 13799,
							itouch: 12051
						},
						{
							period: '2014 Q3',
							iphone: 12920,
							ipad: 10975,
							itouch: 9910
						},
						{
							period: '2014 Q4',
							iphone: 8770,
							ipad: 6600,
							itouch: 6695
						},
						{
							period: '2015 Q1',
							iphone: 10820,
							ipad: 10924,
							itouch: 12300
						},
						{
							period: '2015 Q2',
							iphone: 9680,
							ipad: 9010,
							itouch: 7891
						},
						{
							period: '2015 Q3',
							iphone: 4830,
							ipad: 3805,
							itouch: 1598
						},
						{
							period: '2015 Q4',
							iphone: 15083,
							ipad: 8977,
							itouch: 5185
						},
						{
							period: '2016 Q1',
							iphone: 10697,
							ipad: 4470,
							itouch: 2038
						},
						{
							period: '2016 Q2',
							iphone: 8442,
							ipad: 5723,
							itouch: 1801
						}
					],
					lineColors: ['#ff4a43', '#a2d200', '#22beef'],
					xkey: 'period',
					redraw: true,
					ykeys: ['iphone', 'ipad', 'itouch'],
					labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
					pointSize: 2,
					hideHover: 'auto',
					resize: true
				});
			});
		</script>
	</body>

	</html>
<?php } ?>