<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}

/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Eventos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos

$sql = "SELECT id, title, start, end, color FROM seminarios ";

$req = $conexion2->prepare($sql);
$req->execute();

$events = $req->fetchAll();

?>

<?php require 'includes/header_start.php'; ?>

<!-- FullCalendar -->
<link href='css/fullcalendar.css' rel='stylesheet' />
<!-- Custom CSS -->
<style>
    body {
        padding-top: 25px;

    }

    #calendar {
        max-width: 900px;
    }

    .col-centered {
        float: none;
        margin: 0 auto;
    }
</style>

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
                    <?php
                    if ($permisos_editar == 1) {
                        include "../modal/agregar_seminario.php";
                        include "../modal/editar_seminario.php";
                    }
                    ?>
                    <div class="col-lg-12">
                        <div class="portlet">
                            <div class="portlet-heading bg-purple">
                                <h3 class="portlet-title">
                                    Seminarios
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
                                <div id="resultados_ajax"></div><!-- Carga los datos ajax --><br>
                                <div id="calendar" class="col-centered"></div><br>
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
<!-- FullCalendar -->
<script src='js/moment.min.js'></script>
<script src='js/fullcalendar/fullcalendar.min.js'></script>
<script src='js/fullcalendar/fullcalendar.js'></script>
<script src='js/fullcalendar/locale/es.js'></script>
<script>
    $(document).ready(function() {

        var date = new Date();
        var yyyy = date.getFullYear().toString();
        var mm = (date.getMonth() + 1).toString().length == 1 ? "0" + (date.getMonth() + 1).toString() : (date.getMonth() + 1).toString();
        var dd = (date.getDate()).toString().length == 1 ? "0" + (date.getDate()).toString() : (date.getDate()).toString();

        $('#calendar').fullCalendar({
            header: {
                language: 'es',
                left: 'prev,next today',
                center: 'title',
                right: 'month,basicWeek,basicDay',

            },
            defaultDate: yyyy + "-" + mm + "-" + dd,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            select: function(start, end) {

                $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD'));
                $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD'));
                $('#ModalAdd').modal('show');
            },
            eventRender: function(event, element) {
                element.bind('dblclick', function() {
                    $('#ModalEdit #id').val(event.id);
                    $('#ModalEdit #title').val(event.title);
                    $('#ModalEdit #color').val(event.color);
                    $('#ModalEdit').modal('show');
                });
            },
            eventDrop: function(event, delta, revertFunc) { // si changement de position

                edit(event);

            },
            eventResize: function(event, dayDelta, minuteDelta, revertFunc) { // si changement de longueur

                edit(event);

            },
            events: [
                <?php foreach ($events as $event) :

                    $start = explode(" ", $event['start']);
                    $end   = explode(" ", $event['end']);
                    if ($start[1] == '00:00:00') {
                        $start = $start[0];
                    } else {
                        $start = $event['start'];
                    }
                    if ($end[1] == '00:00:00') {
                        $end = $end[0];
                    } else {
                        $end = $event['end'];
                    }
                ?> {
                        id: '<?php echo $event['id']; ?>',
                        title: '<?php echo $event['title']; ?>',
                        start: '<?php echo $start; ?>',
                        end: '<?php echo $end; ?>',
                        color: '<?php echo $event['color']; ?>',
                    },
                <?php endforeach; ?>
            ]
        });

        function edit(event) {
            start = event.start.format('YYYY-MM-DD HH:mm:ss');
            if (event.end) {
                end = event.end.format('YYYY-MM-DD HH:mm:ss');
            } else {
                end = start;
            }

            id = event.id;

            Event = [];
            Event[0] = id;
            Event[1] = start;
            Event[2] = end;

            $.ajax({
                url: '../ajax/editSeminarioDate.php',
                type: "POST",
                data: {
                    Event: Event
                },
                success: function(rep) {
                    if (rep == 'OK') {
                        swal("SEMINARIO GUARDADO CON EXITO", "", "success")
                        $("#resultados_citas").load("../ajax/carga_citas.php");
                        $("#resultados_citas_total").load("../ajax/carga_citas_total.php");
                    } else {
                        swal('NO SE PUEDE GUARDAR', 'INTENTELO DE NUEVO!', 'error')
                    }
                }
            });
        }

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#resultados_citas").load("../ajax/carga_citas.php");
        $("#resultados_citas_total").load("../ajax/carga_citas_total.php");
        load(1);
    });
</script>
<?php require 'includes/footer_end.php'
?>
<!--<script type="text/javascript" src="../../js/citas_medicas.js"></script>-->

<?php require 'includes/footer_end.php'
?>