
<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}

/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
require_once 'vendor/php-excel-reader/excel_reader2.php';
require_once 'vendor/SpreadsheetReader.php';
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Miembros";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
if (isset($_POST["import"])) {

    $allowedFileType = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = 'subidas/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new SpreadsheetReader($targetPath);

        $sheetCount = count($Reader->sheets());
        for ($i = 0; $i < $sheetCount; $i++) {

            $Reader->ChangeSheet($i);

            foreach ($Reader as $Row) {

                $nombres = "";
                if (isset($Row[0])) {
                    $nombres = mysqli_real_escape_string($conexion, $Row[0]);
                }

                $apellidos = "";
                if (isset($Row[1])) {
                    $apellidos = mysqli_real_escape_string($conexion, $Row[1]);
                }

                $direccion = "";
                if (isset($Row[2])) {
                    $direccion = mysqli_real_escape_string($conexion, $Row[2]);
                }

                $telefono = "";
                if (isset($Row[3])) {
                    $telefono = mysqli_real_escape_string($conexion, $Row[3]);
                }

                $fecha = "";
                if (isset($Row[4])) {
                    $fecha = mysqli_real_escape_string($conexion, $Row[4]);
                }

                $documento = "";
                if (isset($Row[5])) {
                    $documento = mysqli_real_escape_string($conexion, $Row[5]);
                }

                $email = "";
                if (isset($Row[6])) {
                    $email = mysqli_real_escape_string($conexion, $Row[6]);
                }

                /*$estado = "";
                if (isset($Row[6])) {
                $estado = mysqli_real_escape_string($conexion, $Row[7]);
                }*/

                if (!empty($nombres) || !empty($apellido) || !empty($direccion) || !empty($telefono) || !empty($fecha) || !empty($email) || !empty($estado)) {
                    $query      = "insert into miembros(nombre_miembro, apellido_miembro, direccion_miembro, telefono_miembro, fecha_nacimiento, documento_miembro, email_miembro, estado_miembro, date_addedd) values('" . $nombres . "','" . $apellidos . "','" . $direccion . "','" . $telefono . "','" . $fecha . "','" . $documento . "','" . $email . "','" . 1 . "','" . date("Y-m-d H:i:s") . "')";
                    $resultados = mysqli_query($conexion, $query);

                    if (!empty($resultados)) {
                        $type    = "alert alert-success";
                        $message = "Excel importado correctamente";
                    } else {
                        $type    = "alert alert-danger";
                        $message = "Hubo un problema al importar registros";
                    }
                }
            }

        }
    } else {
        $type    = "alert alert-danger";
        $message = "El archivo enviado es invalido. Por favor vuelva a intentarlo";
    }
}
?>

<?php require 'includes/header_start.php';?>
<style type="text/css">
	.btn-submit{
		font-weight: bold;
		color:white;
		background:#CD6155;
		cursor: pointer;
		padding: 5px;
		margin: 0 10px 20px 0;
		border: 1px solid #ccc;
		border-radius: 5px 5px 5px 5px;
	}

	#submit:hover {
		background: #21618C;
	}
</style>
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
									Importar Miembros desde Excel
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
								<div id="bg-primary" class="panel-collapse collapse show">
									<div class="portlet-body">
										<div class="row">

											<div class="col-lg-12 col-xl-12">
												<div class="widget-bg-color-icon card-box" style="background-color: #AEB6BF;">
													<form action="" method="post"
													name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
													<label>1. Descargar la plantilla de excel para realizar el proceso</label>
													<a href="../../miembros.xlsx" class="btn btn-primary btn-sm active" role="button" aria-pressed="true">Descargar Plantilla</a>
													<br>
													<br>
													<div>
														<label>2. Elija Archivo Excel</label> <input type="file" name="file"
														id="file" accept=".xls,.xlsx">
														<button type="submit" id="submit" name="import"
														class="btn-submit">Importar Registros</button>

													</div>

												</form>
												<div id="response" class="<?php if (!empty($type)) {echo $type . " display-block";}?>"><?php if (!empty($message)) {echo $message;}?>
											</div>
											<div class="clearfix"></div>
										</div>
									</div>
									<br>
									<div class="col-lg-12">
										<div id="loader" class="text-center"> <img src="loader.gif"></div>
										<div class="outer_div"></div><!-- Datos ajax Final -->
									</div>
								</div>
								<!-- end col -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


	</div>
	<!-- end container -->
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
<script>
	$(document).ready(function(){
		load(1);
	});

	function load(page){
		var parametros = {"action":"ajax","page":page};
		$("#loader").fadeIn('slow');
		$.ajax({
			url:'../ajax/importar_ajax.php',
			data: parametros,
			beforeSend: function(objeto){
				$("#loader").html("<img src='../../img/ajax-loader.gif'>");
			},
			success:function(data){
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
</script>

<?php require 'includes/footer_end.php'?>
<?php require 'includes/footer_end.php'?>

