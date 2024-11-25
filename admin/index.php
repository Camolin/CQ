<?php
// Iniciar sesión
session_start();
// Incluir archivo de configuración
include('includes/config.php');
// Verificar si se envió el formulario de login
if (isset($_POST['login'])) {
	// Obtener usuario y contraseña del formulario
	$uname = $_POST['username'];
	$password = md5($_POST['password']); // Encriptar contraseña
	// Consulta SQL para verificar credenciales
	$sql = "SELECT UserName,Password FROM admin WHERE UserName=:uname and Password=:password";
	$query = $dbh->prepare($sql);
	$query->bindParam(':uname', $uname, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	// Si hay resultados, login exitoso
	if ($query->rowCount() > 0) {
		$_SESSION['alogin'] = $_POST['username'];
		echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
	} else {
		// Si no hay resultados, credenciales inválidas
		echo "<script>alert('Detalles no válidos');</script>";
	}
}

?>

<!DOCTYPE HTML>
<html>

<head>
	<!-- Título de la página -->
	<title>CQ | Iniciar sesión de administrador</title>
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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
	<!-- Custom CSS -->
	<link href="css/stylea.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/morris.css" type="text/css" />
	<!-- Graph CSS -->
	<link href="css/font-awesome.css" rel="stylesheet">
	<link rel="stylesheet" href="css/jquery-ui.css">
	<!-- jQuery -->
	<script src="js/jquery-2.1.4.min.js"></script>
	<!-- Fuentes de Google -->
	<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css' />
	<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<!-- Iconos -->
	<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
</head>

<body>
	<!-- Contenedor principal centrado -->
	<div class="container d-flex align-items-center justify-content-center min-vh-100">
		<div class="form-body col-lg-4">
			<div class="form-holder">
				<div class="form-content">
					<div class="form-items">
						<!-- Título y subtítulo -->
						<h3>Iniciar Sesion como administrador</h3>
						<p>Bienvenido de nuevo</p>
						<!-- Formulario de login -->
						<form class="requires-validation" method="POST" novalidate>
							<!-- Campo de usuario -->
							<div class="col-md-12 my-2">
								<input type="text" name="username" class="name" placeholder="Usuario" required="">
								<div class="valid-feedback">Username field is valid!</div>
								<div class="invalid-feedback">Username field cannot be blank!</div>
							</div>
							<!-- Campo de contraseña -->
							<div class="col-md-12 my-2">
								<input type="password" name="password" class="password" placeholder="Contraseña" required="">
								<div class="valid-feedback">Password field is valid!</div>
								<div class="invalid-feedback">Password field cannot be blank!</div>
							</div>
							<!-- Botón de submit -->
							<div class="form-button">
								<button id="submit" type="submit" name="login" class="btn btn-primary mx-4 mt-3">Iniciar Sesión</button>
							</div>
							<!-- Link a página principal -->
							<div class="mt-3">
								<a href="../index.php" class="text-decoration-none">Volver a la página principal</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>