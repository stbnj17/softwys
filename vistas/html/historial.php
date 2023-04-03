<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Miembros";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
if (isset($_GET['id_miembro'])) {
    $id_miembro = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['id_miembro'], ENT_QUOTES)));
    $sql_abono  = mysqli_query($conexion, "select * from ingresos, miembros where ingresos.miembro_id='$id_miembro' and ingresos.miembro_id=miembros.id_miembro");
    $count      = mysqli_num_rows($sql_abono);
    if ($count > 0) {
        $rw                     = mysqli_fetch_array($sql_abono);
        $_SESSION['id_miembro'] = $id_miembro;
    } else {
        header("location: ../html/miembros.php");
        exit;
    }
} else {
    header("location: ../html/miembros.php");
    exit;
}
?>

<?php require 'includes/header_start.php';?>

<?php require 'includes/header_end.php';?>

<!-- Begin page -->
<div id="wrapper" class="forced enlarged">

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
                                    Historial de Contribuciones
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
                                    <div class="row">
                                        <div class="col-lg-4">

                                            <div class="col-lg-12 col-md-6">
                                                <div class="widget-bg-color-icon card-box">
                                                    <div class="bg-icon bg-icon-info pull-left">
                                                        <i class="ti-user text-purple"></i>
                                                    </div>
                                                    <div class="text-center">
                                                        <h5 class="text-dark"><b class="counter"><?php echo $rw['nombre_miembro'] . ' ' . $rw['apellido_miembro']; ?></b></h5>
                                                        <a class='btn btn-primary btn-rounded waves-effect waves-light btn-sm m-b-5' href="historial.php" title="Regresar a los Miembros"><i class="fa fa-reply"></i> Regresar
                                                        </a>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-calendar"></i>
                                                        </div>
                                                        <input type="text" class="form-control daterange pull-right" value="<?php echo "01" . date('/m/Y') . ' - ' . date('d/m/Y'); ?>" id="range"  readonly>
                                                    </div><!-- /input-group -->
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <select id="tipo" name="tipo" class="form-control" onchange="load(1);">
                                                            <option value="">Seleccione Tipo ingreso</option>
                                                            <option value="">Todos</option>
                                                            <option value="1">Ofrenda</option>
                                                            <option value="2">Diezmo</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="input-group">
                                                        <select id="tipoo" name="tipoo" class="form-control" onchange="load(1);">
                                                            <option value="">Seleccione Categoria</option>
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
                                                            <button class="btn btn-success btn-rounded waves-effect waves-light" type="button" onclick='load(1);'><i class='fa fa-search'></i> Buscar</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="col-lg-12 col-md-6">
                                                <?php
$orderSql     = "SELECT * FROM ingresos where miembro_id = '$id_miembro'";
    $orderQuery   = $conexion->query($orderSql);
    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['monto'];
    }
    ?>
                                                <div class="card-box widget-icon">
                                                    <div>
                                                        <i class="mdi mdi-briefcase-check text-primary"></i>
                                                        <div class="wid-icon-info text-right">
                                                            <p class="text-muted m-b-5 font-13 font-bold text-uppercase">TOTAL CONTRIBUCION</p>
                                                            <h4 class="m-t-0 m-b-5 counter font-bold text-primary"><?php echo $simbolo_moneda . '' . number_format($totalRevenue, 2); ?></h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-lg-8">
                                            <div class="panel panel-color panel-info">
                                                <div class="panel-body">
                                                    <form class="form-horizontal" role="form" id="datos_cotizacion">
                                                        <div class="form-group row">
                                                            <div class="col-xs-4">
                                                                <div id="loader" class="text-left"></div>
                                                            </div>
                                                            <div class="col-xs-4">
                                                                <div class="btn-group pull-right">
                                                                    <?php if ($permisos_ver == 1) {?>
                                                                        <button type="button"  onclick="reporte();" class="btn btn-danger btn-rounded waves-effect waves-light" title="Imprimir"><i class='fa fa-print'></i> Imprimir</button>
                                                                    <?php }?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    <div class="col-md-12" align="center">
                                                        <div id="resultados_ajax"></div>
                                                        <div class="clearfix"></div>
                                                        <div class='outer_div'></div><!-- Carga el Hisorial -->
                                                    </div>
                                                </div>
                                            </div>
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
<!-- Todo el codigo js aqui -->
<!-- ============================================================== -->
<script type="text/javascript" src="../../js/historial.js"></script>
<script type="text/javascript" src="../../js/VentanaCentrada.js"></script>
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
    $(function() {
        load(1);

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
});
</script>
<script>
    function reporte() {
        var daterange = $("#range").val();
        var tipo = $("#tipo").val();
        var tipoo = $("#tipoo").val();
        VentanaCentrada('../pdf/documentos/rep_historial.php?daterange=' + daterange+"&tipo="+tipo+"&tipoo="+tipoo, 'Reporte', '', '800', '600', 'true');
    }
</script>
<script>
    function imprimir_abono(id_ingreso) {
        VentanaCentrada('../pdf/documentos/rep_cuenta.php?id_ingreso=' + id_ingreso, 'Reporte', '', '800', '600', 'true');
    }
</script>
<?php require 'includes/footer_end.php'
?>

