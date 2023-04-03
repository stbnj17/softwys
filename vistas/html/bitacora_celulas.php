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

<?php require 'includes/header_start.php'; ?>

<?php require 'includes/header_end.php'; ?>

<!-- Begin page -->
<div id="wrapper">

	<?php require 'includes/menu.php'; ?>

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
									Células Familias
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
										include '../modal/registro_celula.php';
										include "../modal/editar_celula.php";
										include "../modal/eliminar_celula.php";
									}
									?>

									<form class="form-horizontal" role="form" id="datos_cotizacion">
										<div class="form-group row">
											<div class="col-md-4">
												<div class="input-group">
													<input type="text" class="form-control" id="q" placeholder="Buscar por Nombre" onkeyup='load(1);'>
													<span class="input-group-btn">
														<button type="button" class="btn btn-outline-info btn-rounded waves-effect waves-light" onclick='load(1);'>
															<span class="fa fa-search"></span></button>
													</span>
												</div>
											</div>
											<div class="col-md-2">
												<span id="loader"></span>
											</div>
											<div class="col-md-2">
												<div class="btn-group pull-center">
													<button type="button" class="btn btn-primary btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#nuevoCelula"><i class="fa fa-plus"></i> Agregar</button>
												</div>

											</div>
											<div class="col-md-3">
												<div class="btn-group pull-left">
													<button type="button" onclick="reporte();" class="btn btn-outline-secondary btn-rounded waves-effect waves-light"><i class='fa fa-print'></i> Imprimir</button>

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
<script type="text/javascript" src="../../js/bitacora_celulas.js"></script>
<script>
	$(function() {
		$("#nombre_miembro1").autocomplete({
			source: "../ajax/autocomplete/miembros.php",
			minLength: 2,
			appendTo: "#nuevoCelula",
			select: function(event, ui) {
				event.preventDefault();
				$('#id_miembro1').val(ui.item.id_miembro);
				$('#nombre_miembro1').val(ui.item.nombre_miembro);
				$.Notification.notify('success', 'bottom center', 'NOTIFICACIÓN', 'SUPERVISOR AGREGADO CORRECTAMENTE')
			}
		});

	});

	$("#nombre_miembro1").on("keydown", function(event) {
		if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
			$("#id_miembro1").val("");
		}
		if (event.keyCode == $.ui.keyCode.DELETE) {
			$("#nombre_miembro1").val("");
			$("#id_miembro1").val("");
		}
	});
</script>
<script>
	$(function() {
		$("#nombre_miembro2").autocomplete({
			source: "../ajax/autocomplete/miembros.php",
			minLength: 2,
			appendTo: "#nuevoCelula",
			select: function(event, ui) {
				event.preventDefault();
				$('#id_miembro2').val(ui.item.id_miembro);
				$('#nombre_miembro2').val(ui.item.nombre_miembro);
				$.Notification.notify('success', 'bottom center', 'NOTIFICACIÓN', 'LIDER AGREGADO CORRECTAMENTE')
			}
		});

	});

	$("#nombre_miembro2").on("keydown", function(event) {
		if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
			$("#id_miembro2").val("");
		}
		if (event.keyCode == $.ui.keyCode.DELETE) {
			$("#nombre_miembro2").val("");
			$("#id_miembro2").val("");
		}
	});
</script>
<script>
	$(function() {
		$("#nombre_miembro3").autocomplete({
			source: "../ajax/autocomplete/miembros.php",
			minLength: 2,
			appendTo: "#editarCelula",
			select: function(event, ui) {
				event.preventDefault();
				$('#id_miembro3').val(ui.item.id_miembro);
				$('#nombre_miembro3').val(ui.item.nombre_miembro);
				$.Notification.notify('success', 'bottom center', 'NOTIFICACIÓN', 'SUPERVISOR AGREGADO CORRECTAMENTE')
			}
		});

	});

	$("#nombre_miembro3").on("keydown", function(event) {
		if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
			$("#id_miembro3").val("");
		}
		if (event.keyCode == $.ui.keyCode.DELETE) {
			$("#nombre_miembro3").val("");
			$("#id_miembro3").val("");
		}
	});
</script>
<script>
	$(function() {
		$("#nombre_miembro4").autocomplete({
			source: "../ajax/autocomplete/miembros.php",
			minLength: 2,
			appendTo: "#editarCelula",
			select: function(event, ui) {
				event.preventDefault();
				$('#id_miembro4').val(ui.item.id_miembro);
				$('#nombre_miembro4').val(ui.item.nombre_miembro);
				$.Notification.notify('success', 'bottom center', 'NOTIFICACIÓN', 'LIDER AGREGADO CORRECTAMENTE')
			}
		});

	});

	$("#nombre_miembro4").on("keydown", function(event) {
		if (event.keyCode == $.ui.keyCode.LEFT || event.keyCode == $.ui.keyCode.RIGHT || event.keyCode == $.ui.keyCode.UP || event.keyCode == $.ui.keyCode.DOWN || event.keyCode == $.ui.keyCode.DELETE || event.keyCode == $.ui.keyCode.BACKSPACE) {
			$("#id_miembro4").val("");
		}
		if (event.keyCode == $.ui.keyCode.DELETE) {
			$("#nombre_miembro4").val("");
			$("#id_miembro4").val("");
		}
	});
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
<script>
	function reporte() {
		var q = $("#q").val();
		VentanaCentrada('../reportes/rep_bitacora_celulas.php?q=' + q, 'Reporte', '', '800', '600', 'true');
	}

	function reporte_excel() {
		var q = $("#q").val();
		window.location.replace("../excel/rep_bitacora_celulas.php?q=" + q);
	}
</script>
<?php require 'includes/footer_end.php'
?>