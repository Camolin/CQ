<?php
// Desactivamos el reporte de errores
error_reporting(0);

// Si se envió el formulario de registro
if (isset($_POST['submit'])) {
	// Obtenemos los datos del formulario
	$fname = $_POST['fname'];
	$mnumber = $_POST['mobilenumber'];
	$email = $_POST['email'];
	$password = md5($_POST['password']);

	// Preparamos la consulta SQL para insertar el nuevo usuario
	$sql = "INSERT INTO  tblusers(FullName,MobileNumber,EmailId,Password) VALUES(:fname,:mnumber,:email,:password)";
	$query = $dbh->prepare($sql);
	$query->bindParam(':fname', $fname, PDO::PARAM_STR);
	$query->bindParam(':mnumber', $mnumber, PDO::PARAM_STR);
	$query->bindParam(':email', $email, PDO::PARAM_STR);
	$query->bindParam(':password', $password, PDO::PARAM_STR);
	$query->execute();
	$lastInsertId = $dbh->lastInsertId();

	// Verificamos si se insertó correctamente
	if ($lastInsertId) {
		// Si fue exitoso, mostramos mensaje y redirigimos
		$_SESSION['msg'] = "Estás registrado exitosamente. Ahora puedes iniciar sesión ";
		header('location:thankyou.php');
	} else {
		// Si hubo error, mostramos mensaje y redirigimos
		$_SESSION['msg'] = "Algo salió mal. Inténtalo de nuevo.";
		header('location:thankyou.php');
	}
}
?>

<!--Javascript para verificar disponibilidad del email-->
<script>
	function checkAvailability() {
		// Mostramos el icono de carga
		$("#loaderIcon").show();
		// Realizamos la petición AJAX
		jQuery.ajax({
			url: "check_availability.php",
			data: 'emailid=' + $("#email").val(),
			type: "POST",
			success: function(data) {
				// Mostramos el resultado y ocultamos el icono
				$("#user-availability-status").html(data);
				$("#loaderIcon").hide();
			},
			error: function() {}
		});
	}
</script>

<!-- Modal para el formulario de registro -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content bg-light">
			<!-- Encabezado del modal -->
			<div class="modal-header border-0">
				<h5 class="modal-title text-success">Crear Nueva Cuenta</h5>
				<button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
			</div>
			<!-- Cuerpo del modal -->
			<div class="modal-body p-4">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-12">
							<!-- Formulario de registro -->
							<form name="signup" method="post" class="needs-validation" style="max-width: 420px;">
								<!-- Logo -->
								<div class="mb-4 text-center">
									<img src="images/logo_cq_n.png" alt="Logo" class="img-fluid">
								</div>
								
								<!-- Campo nombre completo -->
								<div class="form-floating mb-3">
									<input type="text" class="form-control" name="fname" id="fname" placeholder="Nombre completo" autocomplete="off" required>
									<label for="fname">Nombre completo</label>
								</div>

								<!-- Campo número celular -->
								<div class="form-floating mb-3">
									<input type="text" class="form-control" name="mobilenumber" id="mobilenumber" placeholder="Número celular" maxlength="10" autocomplete="off" required>
									<label for="mobilenumber">Número celular</label>
								</div>

								<!-- Campo correo electrónico -->
								<div class="form-floating mb-3">
									<input type="email" class="form-control" name="email" id="email" placeholder="correo@ejemplo.com" onBlur="checkAvailability()" autocomplete="off" required>
									<label for="email">Correo electrónico</label>
									<span id="user-availability-status" class="form-text"></span>
								</div>

								<!-- Campo contraseña -->
								<div class="form-floating mb-3">
									<input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
									<label for="password">Contraseña</label>
								</div>

								<!-- Botón de envío -->
								<div class="d-grid">
									<button type="submit" name="submit" id="submit" class="btn btn-success btn-lg">Crear Cuenta</button>
								</div>
							</form>
							<!-- Texto de términos y condiciones -->
							<div class="text-center mt-4" style="max-width: 420px;">
								<small class="text-muted">
									Al crear una cuenta, aceptas nuestros <a href="page.php?type=terms" class="text-success">Términos y Condiciones</a> y 
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