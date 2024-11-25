<?php
// Iniciamos la sesión
session_start();

// Verificamos si se envió el formulario de inicio de sesión
if (isset($_POST['signin'])) {
	// Obtenemos el email y contraseña del formulario
	$email = $_POST['email'];
	$password = md5($_POST['password']);
	
	// Preparamos la consulta SQL para verificar las credenciales
	$sql = "SELECT EmailId,Password FROM tblusers WHERE EmailId=:email and Password=:password";
	$query = $dbh->prepare($sql);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);
	
	// Verificamos si se encontró el usuario
	if ($query->rowCount() > 0) {
		// Si las credenciales son correctas, guardamos el email en sesión y redirigimos
		$_SESSION['login'] = $_POST['email'];
		echo "<script type='text/javascript'> document.location = 'package-list.php'; </script>";
	} else {
		// Si las credenciales son incorrectas, mostramos mensaje de error
		echo "<script>alert('Detalles no válidos');</script>";
	}
}
?>

<!-- Modal para el formulario de inicio de sesión -->
<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content bg-light">
			<!-- Encabezado del modal -->
			<div class="modal-header border-0">
				<h5 class="modal-title text-success">Bienvenido de Vuelta</h5>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<!-- Cuerpo del modal -->
			<div class="modal-body p-4">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12">
							<!-- Formulario de inicio de sesión -->
							<form method="post" class="needs-validation" style="max-width: 420px;">
								<!-- Logo -->
								<div class="mb-4 text-center">
									<img src="images/logo_cq_n.png" alt="Logo" class="img-fluid">
								</div>
								<!-- Campo correo electrónico -->
								<div class="form-floating mb-3">
									<input type="email" class="form-control" name="email" id="email" placeholder="correo@ejemplo.com" required >
									<label for="email">Correo electrónico</label>
								</div>
								<!-- Campo contraseña -->
								<div class="form-floating mb-3">
									<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required >
									<label for="password">Contraseña</label>
								</div>
								<!-- Enlace recuperar contraseña -->
								<div class="text-end mb-3">
									<a href="forgot-password.php" class="text-success text-decoration-none">¿Olvidaste tu contraseña?</a>
								</div>
								<!-- Botón de envío -->
								<div class="d-grid">
									<button type="submit" name="signin" class="btn btn-success btn-lg">Iniciar Sesión</button>
								</div>
							</form>
							<!-- Texto de términos y condiciones -->
							<div class="text-center mt-4" style="max-width: 420px;">
								<small class="text-muted">
									Al iniciar sesión, aceptas nuestros <a href="page.php?type=terms" class="text-success">Términos y Condiciones</a> y 
									<a href="page.php?type=privacy" class="text-success">Política de Privacidad</a>
								</small>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>