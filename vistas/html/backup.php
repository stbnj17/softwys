<?php
/*-------------------------
Autor: Delmar Lopez
Web: softwys.com
Mail: softwysop@gmail.com
---------------------------*/
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Configuracion";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title         = "Backup";
$Configuracion = 1;
?>
<?php require 'includes/header_start.php';?>

<?php require 'includes/header_end.php';?>

<!-- Begin page -->
<div id="wrapper">

	<?php require 'includes/menu.php';?>

	<!-- ============================================================== -->
	<!-- Start right Content here -->
	<!-- ============================================================== -->
	<div class="content-page">
		<!-- Start content -->
		<div class="content">
			<div class="container">
				<?php if ($permisos_ver == 1) {
    ?>
					<div class="col-lg-12">
						<div class="portlet">
							<div class="portlet-heading bg-purple">
								<h3 class="portlet-title">
									Respaldo de datos
								</h3>
								<div class="portlet-widgets">
									<a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
									<span class="divider"></span>
									<a data-toggle="collapse" data-parent="#accordion1" href="#bg-primary"><i class="ion-minus-round"></i></a>
									<span class="divider"></span>
									<a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
								</div>
								<div class="clearfix"></div>
							</div>
							<div id="bg-primary" class="panel-collapse collapse show">
								<div class="portlet-body">
									<div class="row justify-content-center">
										<div class="col-sm-6">
 <?php
if (isset($_SESSION['error'])) {
        ?>
                                                    <div class="alert alert-danger text-center">
                                                        <?php echo $_SESSION['error']; ?>
                                                    </div>
                                                    <?php

        unset($_SESSION['error']);
    }

    if (isset($_SESSION['success'])) {
        ?>
                                                    <div class="alert alert-success text-center">
                                                        <?php echo $_SESSION['success']; ?>
                                                    </div>
                                                    <?php

        unset($_SESSION['success']);
    }
    ?>

													<h3>Credenciales de la base de datos</h3>
													<br>
													<form method="POST" action="backup/backup.php">
														<div class="form-group row">
															<label for="server" class="col-sm-3 col-form-label">Servidor</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="server" name="server" placeholder="Ejemplo: 'localhost'" required autocomplete="off">
															</div>
														</div>
														<div class="form-group row">
															<label for="username" class="col-sm-3 col-form-label">Usuario</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="username" name="username" placeholder="Ejemplo: 'root'" required autocomplete="off">
															</div>
														</div>
														<div class="form-group row">
															<label for="password" class="col-sm-3 col-form-label">Contraseña</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="password" name="password" placeholder="db password" autocomplete="off">
															</div>
														</div>
														<div class="form-group row">
															<label for="dbname" class="col-sm-3 col-form-label">Base de datos</label>
															<div class="col-sm-9">
																<input type="text" class="form-control" id="dbname" name="dbname" placeholder="Nombre de la base de datos a respaldar" required autocomplete="off">
															</div>
														</div>
														<button type="submit" class="btn btn-primary" name="backup">Respaldo</button>
													</form>

										</div>
									</div>

								</div>
							</div>
						</div>
					</div>

					<?php
} else {
    ?>
					<section class="content">
						<div class="alert alert-danger" align="center">
							<h3>Acceso denegado! </h3>
							<p>No cuentas con los permisos necesario para acceder a este módulo.</p>
						</div>
					</section>
					<?php
}
?>


			</div>
			<!-- end container -->
		</div>
		<!-- end content -->

		<?php require 'includes/pie.php';?>

	</div>
	<!-- ============================================================== -->
	<!-- End Right content here -->
	<!-- ============================================================== -->


</div>
<!-- END wrapper -->

<?php require 'includes/footer_start.php'
?>
<!-- ============================================================== -->
<!-- Todo el codigo js aqui-->
<!-- ============================================================== -->
<script>
	$(document).ready(function() {
		$("#resultados_citas").load("../ajax/carga_citas.php");
		$("#resultados_citas_total").load("../ajax/carga_citas_total.php");
		load(1);
	});
	function load(page){
		var q= $("#q").val();
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'../ajax/buscar_backup.php?action=ajax&page='+page+'&q='+q,
			beforeSend: function(objeto){
				$('#loader').html('<img src="../../img/ajax-loader.gif"> Cargando...');
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$('#loader').html('');

			}
		})
	}

</script>

<?php require 'includes/footer_end.php'
?>

