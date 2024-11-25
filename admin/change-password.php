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
	// Código para cambiar contraseña	
	if (isset($_POST['submit'])) {
		// Obtener contraseñas y usuario
		$password = md5($_POST['password']);
		$newpassword = md5($_POST['newpassword']);
		$username = $_SESSION['alogin'];
		// Consulta SQL para verificar contraseña actual
		$sql = "SELECT Password FROM admin WHERE UserName=:username and Password=:password";
		$query = $dbh->prepare($sql);
		$query->bindParam(':username', $username, PDO::PARAM_STR);
		$query->bindParam(':password', $password, PDO::PARAM_STR);
		$query->execute();
		$results = $query->fetchAll(PDO::FETCH_OBJ);
		// Si la contraseña actual es correcta
		if ($query->rowCount() > 0) {
			// Actualizar contraseña
			$con = "update admin set Password=:newpassword where UserName=:username";
			$chngpwd1 = $dbh->prepare($con);
			$chngpwd1->bindParam(':username', $username, PDO::PARAM_STR);
			$chngpwd1->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
			$chngpwd1->execute();
			$msg = "Cambio de contraseña exitoso";
		} else {
			$error = "Tu contraseña actual es incorrecta";
		}
	}
?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<!-- Título de la página -->
		<title>CQ | Administrador Cambiar Contraseña</title>

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
		<!-- Script para validar contraseñas -->
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
					<li class="breadcrumb-item"><a href="dashboard.php">Inicio</a><i class="fa fa-angle-right"></i>Cambiar la contraseña</li>
				</ol>
				<!--grid-->
				<div class="grid-form">

					<div class="grid-form1">
						<!-- Mostrar mensajes de error/éxito -->
						<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>EXITOSO</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

						<div class="panel-body">
							<!-- Formulario para cambiar contraseña -->
							<form name="chngpwd" method="post" class="form-horizontal" onSubmit="return valid();">

								<div class="form-group">
									<label class="col-md-2 control-label">Contraseña actual</label>
									<div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input type="password" name="password" class="form-control1" id="exampleInputPassword1" placeholder="Contraseña actual" required="">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">Nueva contraseña</label>
									<div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input type="password" class="form-control1" name="newpassword" id="newpassword" placeholder="Nueva contraseña" required="">
										</div>
									</div>
								</div>

								<div class="form-group">
									<label class="col-md-2 control-label">Confirmar Contraseña</label>
									<div class="col-md-8">
										<div class="input-group">
											<span class="input-group-addon">
												<i class="fa fa-key"></i>
											</span>
											<input type="password" class="form-control1" name="confirmpassword" id="confirmpassword" placeholder="Confirmar Contraseña" required="">
										</div>
									</div>
								</div>

								<div class="col-sm-8 col-sm-offset-2">
									<button type="submit" name="submit" class="btn-primary btn">Enviar</button>
									<button type="reset" class="btn-inverse btn">Restablecer</button>
								</div>
						</div>

						</form>
					</div>
				</div>
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
		<!-- /script para navegación sticky -->
		<!--inner block start here-->
		<div class="inner-block">

		</div>
		<!--inner block end here-->
		<!-- Incluir footer -->
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
		<script src="js/bootstrap.min.js"></script>

	</body>

	</html>
<?php } ?>