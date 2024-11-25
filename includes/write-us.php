<?php
// Desactivamos el reporte de errores
error_reporting(0);

// Si se envió el formulario
if(isset($_POST['submit']))
{
    // Obtenemos los datos del formulario
    $issue=$_POST['issue'];
    $description=$_POST['description'];
    $email=$_SESSION['login'];

    // Preparamos la consulta SQL para insertar los datos
    $sql="INSERT INTO  tblissues(UserEmail,Issue,Description) VALUES(:email,:issue,:description)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':issue',$issue,PDO::PARAM_STR);
    $query->bindParam(':description',$description,PDO::PARAM_STR);
    $query->bindParam(':email',$email,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();

    // Verificamos si se insertó correctamente
    if($lastInsertId)
    {
        // Si fue exitoso, mostramos mensaje y redirigimos
        $_SESSION['msg']="Información enviada correctamente ";
        echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
    }
    else 
    {
        // Si hubo error, mostramos mensaje y redirigimos
        $_SESSION['msg']="Algo salió mal. Inténtalo de nuevo.";
        echo "<script type='text/javascript'> document.location = 'thankyou.php'; </script>";
    }
}
?>	

	<!-- Modal para el formulario de ayuda -->
	<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<!-- Botón para cerrar el modal -->
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
							<section>
							<!-- Formulario de ayuda -->
							<form name="help" method="post">
								<div class="modal-body modal-spa">
									<div class="writ">
										<h4>COMO PODEMOS AYUDARTE</h4>
											<ul>
												<!-- Select para elegir el tipo de problema -->
												<li class="na-me">
													<select id="country" name="issue" class="frm-field required sect" required="">
														<option value="">Seleccionar problema</option> 		
														<option value="Booking Issues">Problemas de reserva</option>
														<option value="Cancellation"> Cancelaciones</option>
														<option value="Refund">Reembolso</option>
														<option value="Other">Otros</option>														
													</select>
												</li>
												
												<!-- Campo para la descripción del problema -->
												<li class="descrip">
									<input class="special" type="text" placeholder="descripción"  name="description" required="">
												</li>
													<div class="clearfix"></div>
											</ul>
											<!-- Botón de envío -->
											<div class="sub-bn">
												<form>
													<button type="submit" name="submit" class="subbtn">Enviar</button>
												</form>
											</div>
									</div>
								</div>
								</form>
							</section>
					</div>
				</div>
			</div>