<?php 
// Verifica si el usuario ha iniciado sesión
if ($_SESSION['login']) { ?>
	<!-- Encabezado superior para usuarios logueados -->
	<div class="top-header">
		<div class="container">
			<!-- Lista de enlaces del menú izquierdo -->
			<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
				<li class="hm"><a style="text-decoration: none;" href="index.html"><i class="fa fa-home"></i></a></li>
				<li class="prnt"><a style="text-decoration: none;" href="profile.php">Mi Perfil</a></li>
				<li class="prnt"><a style="text-decoration: none;" href="change-password.php">Cambiar la contraseña</a></li>
				<li class="prnt"><a style="text-decoration: none;" href="tour-history.php">Mi historial de reservas</a></li>
				<li class="prnt"><a style="text-decoration: none;" href="issuetickets.php">Mi historial de ayudas</a></li>
			</ul>
			<!-- Lista de enlaces del menú derecho -->
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
				<li class="tol">Bienvenido :</li>
				<li class="sig"><?php echo htmlentities($_SESSION['login']); ?></li>
				<li class="sigi"><a style="text-decoration: none;" href="logout.php">/ Salir</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } else { ?>
	<!-- Encabezado superior para usuarios no logueados -->
	<div class="top-header">
		<div class="container">
			<!-- Lista de enlaces del menú izquierdo -->
			<ul class="tp-hd-lft wow fadeInLeft animated" data-wow-delay=".5s">
				<li class="hm"><a style="text-decoration: none;" href="index.php"><i class="fa fa-home"></i></a></li>
				<li class="hm"><a style="text-decoration: none;" href="admin/index.php">Inicio administrador</a></li>
			</ul>
			<!-- Lista de enlaces del menú derecho -->
			<ul class="tp-hd-rgt wow fadeInRight animated" data-wow-delay=".5s">
				<li class="tol"></li>
				<li class="sig"><a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#myModal">Registrarse</a></li>
				<li class="sigi"><a style="text-decoration: none;" href="#" data-toggle="modal" data-target="#myModal4">/ Iniciar</a></li>
			</ul>
			<div class="clearfix"></div>
		</div>
	</div>
<?php } ?>
<!--- /top-header ---->

<!--- header ---->
<div class="header">
	<div class="container">
		<!-- Logo del sitio -->
		<div class="logo wow fadeInDown animated" data-wow-delay=".5s">
			<a href="index.php">Chompi <span>en Quibdo</span></a>
		</div>

		<!-- Contenedor de imagen del logo -->
		<div class="lock fadeInDown animated" data-wow-delay=".5s">
			<ul>
				<li>
					<a href="index.php">
						<img style="width: 90px;" class="img-fluid" src="images/logo_cq_n.png" alt="Logo Chompi en Quibdo">
					</a>
				</li>
			</ul>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!--- /header ---->

<!--- footer-btm ---->
<div class="footer-btm wow fadeInLeft animated" data-wow-delay=".5s"> 
	<div class="container">
		<!-- Navegación principal -->
		<div class="navigation">
			<nav class="navbar navbar-default">
				<!-- Botón de navegación móvil -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Navegación de palanca</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<!-- Menú de navegación -->
				<div class="collapse navbar-collapse nav-wil" id="bs-example-navbar-collapse-1">
					<nav class="cl-effect-1">
						<ul class=""></ul>>
							<!-- Enlaces del menú principal -->
							<li><a style="text-decoration: none;" href="index.php">Inicio</a></li>
							<li><a style="text-decoration: none;" href="page.php?type=aboutus">Nosotros</a></li>
							<li><a style="text-decoration: none;" href="package-list.php">Paquetes turísticos</a></li>
							<li><a style="text-decoration: none;" href="package-most-viewed.php">Paquetes más vistos</a></li>
							<li><a style="text-decoration: none;" href="compras.php">Nuestros merch</a></li>
							<li><a style="text-decoration: none;" href="page.php?type=privacy">Política de privacidad</a></li>
							<li><a style="text-decoration: none;" href="page.php?type=terms">Terminos de uso</a></li>
							<li><a style="text-decoration: none;" href="page.php?type=contact">Contactanos</a></li>
							<?php 
							// Muestra diferentes opciones según si el usuario está logueado
							if ($_SESSION['login']) { ?>
								<li>Necesitas ayuda?<a href="#" data-toggle="modal" data-target="#myModal3"> / Escribenos </a> </li>
							<?php } else { ?>
								<li><a style="text-decoration: none;" href="enquiry.php"> Consulta </a> </li>
							<?php } ?>
							<div class="clearfix"></div>

						</ul>
					</nav>
				</div><!-- /.navbar-collapse -->
			</nav>
		</div>

		<div class="clearfix"></div>
	</div>
</div>