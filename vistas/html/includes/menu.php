<!-- Top Bar Start -->
<div class="topbar">

	<!-- LOGO -->
	<div class="topbar-left">
		<div class="text-center">
			<a href="#" class="logo"><i class="mdi mdi-radar"></i> <span>IEANJESUS</span></a>
		</div>
	</div>

	<!-- Button mobile view to collapse sidebar menu -->
	<nav class="navbar-custom">

		<ul class="list-inline float-right mb-0">
			<li class="list-inline-item notification-list hide-phone">
				<a class="nav-link waves-light waves-effect" href="#" id="btn-fullscreen">
					<i class="mdi mdi-crop-free noti-icon"></i>
				</a>
			</li>
			<li class="list-inline-item dropdown notification-list">
				<a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
					<i class="mdi mdi-bell noti-icon"></i>
					<span class="badge badge-pink noti-icon-badge" id="resultados_citas_total">
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-menu-lg" aria-labelledby="Preview">
					<!-- item-->
					<div class="dropdown-item noti-title">
						<h5 class="font-16"><span class="badge badge-danger float-right"></span>Mis Eventos</h5>
					</div>

					<!-- item-->
					<div id="resultados_citas"></div><!-- Carga los datos ajax -->

					<!-- All-->
					<a href="javascript:void(0);" class="dropdown-item notify-item notify-all">
						Eventos del Día
					</a>

				</div>
			</li>

			<li class="list-inline-item dropdown notification-list">
				<a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
					<img src="../../assets/images/users/avatar-1.jpg" alt="user" class="rounded-circle">
				</a>
				<div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">

					<!-- item-->
					<a href="javascript:void(0);" class="dropdown-item notify-item">
						<i class="mdi mdi-account-star-variant"></i> <span>Perfil</span>
					</a>

					<!-- item-->
					<a href="../../login.php?logout" class="dropdown-item notify-item">
						<i class="mdi mdi-logout"></i> <span>Salir</span>
					</a>

				</div>
			</li>

		</ul>

		<ul class="list-inline menu-left mb-0">
			<li class="float-left">
				<button class="button-menu-mobile open-left waves-light waves-effect">
					<i class="mdi mdi-menu"></i>
				</button>
			</li>
		</ul>

	</nav>

</div>
<!-- Top Bar End -->
<!-- ========== Left Sidebar Start ========== -->

<div class="left side-menu">
	<div class="sidebar-inner slimscrollleft">
		<!--- Divider -->
		<div id="sidebar-menu">
			<ul>
				<li class="menu-title">Menu</li>

				<li>
					<a href="principal.php" class="waves-effect waves-primary"><i class="ti-home"></i><span> Inicio </span></a>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-user"></i><span> Miembros </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/family.php">Familias</a></li>
						<li><a href="../html/miembros.php">Miembros</a></li>
						<li><a href="../html/importar.php">Importar Miembros</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-map-alt"></i><span> Células Familiares</span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/bitacora_celulas.php">Bitácora de Células</a></li>
						<li><a href="../html/asistencias.php">Control Asistencias</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-bar-chart"></i><span> Tesoreria </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/tipos_ingresos.php">Categoria de Igresos</a></li>
						<li><a href="../html/ingresos.php">Ofrendas</a></li>
						<li><a href="../html/diezmos.php">Diezmos</a></li>
						<li><a href="../html/tipos.php">Tipos de Gastos</a></li>
						<li><a href="../html/gastos.php">Control de Gastos</a></li>
						<li><a href="../html/libreria.php">Libreria</a></li>
						<!--<li><a href="../html/seminarios.php">Seminarios</a></li>-->
					</ul>
				</li>
				<li>
					<!--<a href="../html/bitacora_devocion.php" class="waves-effect waves-primary"><i
							class="ti-harddrives"></i><span> Control de Devoción </span></a>
						</li>-->
				<li>
					<a href="../html/seminarios.php" class="waves-effect waves-primary"><i class="ti-agenda"></i><span> Eventos y Seminarios </span></a>
				</li>
				<li>
					<a href="../html/bienes.php" class="waves-effect waves-primary"><i class="ti-harddrives"></i><span> Bienes y Muebles </span></a>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-files"></i><span> Reportes </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/rep_ingresos.php">Reporte de Ingresos</a></li>
						<!--<li><a href="../html/rep_general.php">Reporte General</a></li>-->
						<li><a href="../html/rep_caja.php">Reporte General</a></li>
						<li><a href="../html/rep_eventos.php">Reporte de Eventos</a></li>
						<li><a href="../html/rep_gastos.php">Gastos por Usuarios</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-key"></i><span> Usuarios </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/grupos.php">Permisos</a></li>
						<li><a href="../html/usuarios.php">Usuario</a></li>
					</ul>
				</li>
				<li class="has_sub">
					<a href="javascript:void(0);" class="waves-effect waves-primary"><i class="ti-settings"></i><span> Configuración </span> <span class="menu-arrow"></span></a>
					<ul class="list-unstyled">
						<li><a href="../html/empresa.php">Iglesia</a></li>
						<li><a href="../html/backup.php">Backup</a></li>
						<li><a href="../html/restore.php">Restore</a></li>
					</ul>
				</li>

			</ul>

			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- Left Sidebar End -->