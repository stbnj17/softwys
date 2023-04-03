<?php
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
$modulo = "Tesorerias";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
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
								Bitacora de Devoción
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

<?php
if ($permisos_editar == 1) {
        include '../modal/registro_dev.php';
        include "../modal/editar_dev.php";
        include "../modal/eliminar_dev.php";
    }
    ?>

								<form class="form-horizontal" role="form" id="datos_cotizacion">
									<div class="form-group row">
									
											<div class="col-md-4">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control daterange pull-right" value="<?php echo "01" . date('/m/Y') . ' - ' . date('d/m/Y'); ?>" id="range" readonly>
												<span class="input-group-btn">
													<button type="button" class="btn btn-outline-info btn-rounded waves-effect waves-light" onclick='load(1);'>
														<span class="fa fa-search" ></span></button>
													</span>
											</div><!-- /input-group -->
										</div>
											<div class="col-md-1">
												<span id="loader"></span>
											</div>
											<div class="col-md-2">
												<div class="btn-group pull-center">
												<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#nuevoDev"><i class="fa fa-plus"></i> Agregar</button>
												</div>

											</div>
											<div class="col-md-2">
													<div class="btn-group pull-left">
															<button type="button"  onclick="reporte();" class="btn btn-outline-secondary btn-rounded waves-effect waves-light"><i class='fa fa-print'></i> Imprimir</button>

													</div>
												</div>

										</div>
									</form>
									<div class="datos_ajax_delete"></div><!-- Datos ajax Final -->
									<div class='outer_div'></div><!-- Carga los datos ajax -->



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
	<!-- Todo el codigo js aqui -->
	<!-- ============================================================== -->
	<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
	<script type="text/javascript" src="../../js/bitacora_devocion.js"></script>
	<script>
//Date range picker
$('.daterange').daterangepicker({
	buttonClasses: ['btn', 'btn-sm'],
	applyClass: 'btn-success',
	cancelClass: 'btn-default',
	locale: {
		format: "DD/MM/YYYY",
		separator: " - ",
		applyLabel: "Aplicar",
		cancelLabel: "Cancelar",
		fromLabel: "Desde",
		toLabel: "Hasta",
		customRangeLabel: "Custom",
		daysOfWeek: [
		"Do",
		"Lu",
		"Ma",
		"Mi",
		"Ju",
		"Vi",
		"Sa"
		],
		monthNames: [
		"Enero",
		"Febrero",
		"Marzo",
		"Abril",
		"Mayo",
		"Junio",
		"Julio",
		"Agosto",
		"Septiembre",
		"Octubre",
		"Noviembre",
		"Diciembre"
		],
		firstDay: 1
	},
	opens: "right"

});
</script>
	
<script>
       $(document).ready( function () {
        $(".UpperCase").on("keypress", function () {
         $input=$(this);
         setTimeout(function () {
          $input.val($input.val().toUpperCase());
         },50);
        })
       })
      </script>
      <script>
		function reporte(){
			var q=$("#q").val();
			VentanaCentrada('../pdf/documentos/rep_celulas.php?q='+q,'Reporte','','800','600','true');
			
		}
	</script>

	<?php require 'includes/footer_end.php'
?>

