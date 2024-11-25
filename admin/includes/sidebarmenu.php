<!-- Menú lateral -->
<div class="sidebar-menu">
	<!-- Encabezado del menú con logo -->
	<header class="logo1">
		<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a>
	</header>
	<!-- Línea divisoria -->
	<div style="border-top:1px ridge rgba(255, 255, 255, 0.15)"></div>
	<!-- Contenedor del menú -->
	<div class="menu">
		<ul id="menu">
			<!-- Elemento Panel de Inicio -->
			<li><a href="dashboard.php"><i class="fa fa-tachometer"></i> <span>Panel de Inicio</span>
					<div class="clearfix"></div>
				</a></li>

			<!-- Menú desplegable de Paquetes turísticos -->
			<li id="menu-academico"><a href="#"><i class="fa fa-list-ul" aria-hidden="true"></i><span>Paquetes turísticos</span> <span class="fa fa-angle-right" style="float: right"></span>
					<div class="clearfix"></div>
				</a>
				<!-- Submenú de Paquetes turísticos -->
				<ul id="menu-academico-sub">
					<li id="menu-academico-avaliacoes"><a href="create-package.php">Crear</a></li>
					<li id="menu-academico-avaliacoes"><a href="manage-packages.php">Administrar</a></li>
				</ul>
			</li>
			<!-- Elemento Administrar usuarios -->
			<li id="menu-academico">
				<a href="manage-users.php"><i class="fa fa-users" aria-hidden="true"></i><span>Administrar usuarios</span>
					<div class="clearfix"></div>
				</a>
			</li>

			<!-- Elemento Gestionar reserva -->
			<li><a href="manage-bookings.php"><i class="fa fa-list" aria-hidden="true"></i> <span>Gestionar reserva</span>
					<div class="clearfix"></div>
				</a></li>
			<!-- Elemento Administrar problemas -->
			<li><a href="manageissues.php"><i class="fa fa-table"></i> <span>Administrar problemas</span>
					<div class="clearfix"></div>
				</a></li>
			<!-- Elemento Gestionar consultas -->
			<li><a href="manage-enquires.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Gestionar consultas</span>
					<div class="clearfix"></div>
				</a></li>
			<!-- Elemento Administrar páginas -->
			<li><a href="manage-pages.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Administrar páginas</span>
					<div class="clearfix"></div>
				</a></li>

			<!-- Elemento Visualizar Gráficas -->
			<li><a href="grafics.php"><i class="fa fa-file-text-o" aria-hidden="true"></i> <span>Visualizar Graficas</span>
					<div class="clearfix"></div>
				</a></li>

		</ul>
	</div>
</div>