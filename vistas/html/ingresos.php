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
$title         = "Pagos";
$pacientes     = 1;
$query_empresa = mysqli_query($conexion, "select * from perfil, miembros where perfil.default_miembro_id= miembros.id_miembro  and perfil.id_perfil=1");
$row           = mysqli_fetch_array($query_empresa);
?>
<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>

<!-- Begin page -->
<div id="wrapper" class="forced enlarged">

	<?php require 'includes/menu.php'; ?>

	<!-- ============================================================== -->
	<!-- Start right Content here -->
	<!-- ============================================================== -->
	<div class="content-page">
		<!-- Start content -->
		<div class="content">
			<div class="container">

				<div class="col-lg-12">
					<div class="portlet">
						<div class="portlet-heading bg-purple">
							<h3 class="portlet-title">
								Ofrendas
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
									include '../modal/registro_ingreso.php';
									include "../modal/editar_ingreso.php";
									include "../modal/eliminar_ingreso.php";
								}
								?>
								<form class="form-horizontal" role="form" id="datos_cotizacion">
									<div class="form-group row">
										<div class="col-md-3">
											<div class="input-group">
												<div class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</div>
												<input type="text" class="form-control daterange pull-right" value="<?php echo "01" . date('/m/Y') . ' - ' . date('d/m/Y'); ?>" id="range" readonly>

											</div><!-- /input-group -->
										</div>
										<div class="col-md-3">
											<div class="input-group">
												<select id="tipoo" name="tipoo" class="form-control" onchange="load(1);">
													<option value="">Categoria</option>
													<option value="">Todos</option>
													<?php

													$query_tipoi = mysqli_query($conexion, "select * from tipo_ingreso order by nombre_tipoi");
													while ($rw = mysqli_fetch_array($query_tipoi)) {
													?>
														<option value="<?php echo $rw['id_tipoi']; ?>"><?php echo $rw['nombre_tipoi']; ?></option>
													<?php
													}
													?>
												</select>
												<span class="input-group-btn">
													<button class="btn btn-outline-info btn-rounded waves-effect waves-light" type="button" onclick='load(1);'><i class='fa fa-search'></i></button>
												</span>
											</div>
										</div>
										<div class="col-md-2">
											<div id="loader" class="text-center"></div>
										</div>
										<div class="col-md-2">
											<div class="btn-group pull-center">
												<?php if ($permisos_editar == 1) { ?>
													<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#nuevoIngreso"><i class="fa fa-plus"></i> Agregar</button>
												<?php } ?>
											</div>
										</div>
										<div class="col-md-2">
											<div class="btn-group pull-left">
												<?php if ($permisos_editar == 1) { ?>
													<div class="btn-group dropup">
														<button aria-expanded="false" class="btn btn-outline-secondary btn-rounded waves-effect waves-light" data-toggle="dropdown" type="button">
															<i class='fa fa-file-text'></i> Reporte
															<span class="caret">
															</span>
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="#" onclick="reporte();">
																<i class='fa fa-file-pdf-o'></i> Reporte General
															</a>
															<a class="dropdown-item" href="#" onclick="reporte2();">
																<i class='fa fa-file-pdf-o'></i> Reporte Anual
															</a>
															<a class="dropdown-item" href="#" onclick="reporte_excel();">
																<i class='fa fa-file-excel-o'></i> Excel
															</a>
														</div>
													</div>
												<?php } ?>
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


			</div>
			<!-- end container -->
		</div>
		<!-- end content -->

		<?php require 'includes/pie.php'; ?>

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
<script type="text/javascript" src="../../js/ingresos.js"></script>
<script>
	$(function() {
		$("#nombre_miembro").autocomplete({
			source: "../ajax/autocomplete/miembros.php",
			minLength: 2,
			appendTo: "#nuevoIngreso",
			select: function(event, ui) {
				event.preventDefault();
				$('#id_miembro').val(ui.item.id_miembro);
				$('#nombre_miembro').val(ui.item.nombre_miembro);
				$.Notification.notify('success', 'bottom center', 'NOTIFICACIÓN', 'MIEMBRO AGREGADO CORRECTAMENTE')
			}
		});

	});

	$("#nombre_miembro").on("keydown", function(event) {
		if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
			$("#id_miembro").val("");
		}
		if (event.keyCode == $.ui.keyCode.DELETE) {
			$("#nombre_miembro").val("");
			$("#id_miembro").val("");
		}
	});
</script>

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
	function reporte() {
		var daterange = $("#range").val();
		var tipoo = $("#tipoo").val();
		VentanaCentrada('../reportes/rep_ofrendas.php?daterange=' + daterange + "&tipoo=" + tipoo, 'Reporte', '', '800', '600', 'true');
	}

	function reporte2() {
		var daterange = $("#range").val();
		var tipoo = $("#tipoo").val();
		VentanaCentrada('../reportes/rep_ofrendas2.php?daterange=' + daterange + "&tipoo=" + tipoo, 'Reporte', '', '800', '600', 'true');
	}
</script>
<script>
	function reporte_excel() {
		var daterange = $("#range").val();
		var tipoo = $("#tipoo").val();
		window.location.replace("../excel/rep_ofrendas.php?daterange=" + daterange + "&tipoo=" + tipoo);
		//VentanaCentrada('../excel/rep_pagos.php?daterange='+daterange+"&employee_id="+employee_id,'Reporte','','500','25','true');
	}
</script>
<script>
	$(document).ready(function() {
		$(".UpperCase").on("keypress", function() {
			$input = $(this);
			setTimeout(function() {
				$input.val($input.val().toUpperCase());
			}, 50);
		})
	})
</script>

<?php require 'includes/footer_end.php'
?>