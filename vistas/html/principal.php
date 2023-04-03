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
$modulo = "Inicio";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$title  = "Inicio";
$Inicio = 1;
//Archivo de funciones PHP
require_once "../funciones.php";
$usu            = $_SESSION['id_users'];
$users_users    = get_row('users', 'usuario_users', 'id_users', $usu);
$cargo_users    = get_row('users', 'cargo_users', 'id_users', $usu);
$nombre_users   = get_row('users', 'nombre_users', 'id_users', $usu);
$apellido_users = get_row('users', 'apellido_users', 'id_users', $usu);
$email_users    = get_row('users', 'email_users', 'id_users', $usu);
?>
<?php require 'includes/header_start.php';?>
<!-- grafico -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>

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
                    <div class="row">
                        <div class="col-lg-6 col-xl-4">
                            <div class="widget-bg-color-icon card-box">
                                <div class="bg-icon bg-icon-success pull-left">
                                    <i class="ti-user text-success"></i>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-dark text-center"><b class="counter text-success"><?php total_miembros();?></b></h3>
                                    <p class="text-muted mb-0">Total Miembros</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-4">
                            <div class="widget-bg-color-icon card-box">
                                <div class="bg-icon bg-icon-danger pull-left">
                                    <i class="ti-export text-pink"></i>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-dark text-center"><b class="counter text-pink"><?php total_egresos();?></b></h3>
                                    <p class="text-muted mb-0">Total Egresos</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                        <div class="col-lg-6 col-xl-4">
                            <div class="widget-bg-color-icon card-box fadeInDown animated">
                                <div class="bg-icon bg-icon-primary pull-left">
                                    <i class="ti-import text-info"></i>
                                </div>
                                <div class="text-right">
                                    <h3 class="text-dark"><b class="counter text-info"><?php total_ingresos();?></b></h3>
                                    <p class="text-muted mb-0">Total Ingresos</p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>

                    </div>
                    <!-- end row -->

                    <div class="row">


            <div class="col-lg-8">
                <div class="card-box">
                    <h4 class="text-dark  header-title m-t-0 m-b-30">Estadisticas</h4>

                    <div class="widget-chart text-center">
                    <div class='row'>
                                      <div class='col-md-4'>
                                        <select class="form-control" id="periodo" onchange="drawVisualization();">
                                          <?php
for ($anio = (date("Y")); 2016 <= $anio; $anio--) {
        echo "<option value=" . $anio . ">Período:" . $anio . "</option>";
    }
    ?>
                                    </select>
                                </div>
                            </div>
                    <div id="chart_div" style="height: 300px;"></div>

                    </div>
                </div>

            </div>
            <div class="col-lg-4">
                <div class="portlet">
                    <div class="portlet-heading bg-purple">
                        <h3 class="portlet-title">
                            Ultimos Ingresos
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div id="bg-primary" class="panel-collapse collapse show">
                        <div class="portlet-body">
                            <div class="table-responsive">
                              <table class="table table-sm no-margin table-striped">
                                <thead>
                                  <tr>
                                    <th class="text-center">Tipo</th>
                                    <th class="text-center">Monto</th>
                                    <th class="text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php
latest_ingreso();

    ?>
                          </tbody>
                      </table>
                  </div><!-- /.table-responsive -->
              </div>
          </div>
      </div>
                 <div class="portlet">
                    <div class="portlet-heading bg-danger">
                        <h3 class="portlet-title">
                            Ultimos Egresos
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div id="bg-primary" class="panel-collapse collapse show">
                        <div class="portlet-body">
                            <div class="table-responsive">
                              <table class="table table-sm no-margin table-striped">
                                <thead>
                                  <tr>
                                   <th class="text-center">Referencia</th>
                                    <th class="text-center">Monto</th>
                                    <th class="text-center">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
  <?php
latest_egreso();

    ?>
                          </tbody>
                      </table>
                  </div><!-- /.table-responsive -->
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
    <script type="text/javascript">
        $(document).ready(function() {
            $("#resultados_citas").load("../ajax/carga_citas.php");
            $("#resultados_citas_total").load("../ajax/carga_citas_total.php");
            load(1);
        });
    </script>
    <script>
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawVisualization);

  function errorHandler(errorMessage) {
            //curisosity, check out the error in the console
            console.log(errorMessage);
            //simply remove the error, the user never see it
            google.visualization.errors.removeError(errorMessage.id);
        }

        function drawVisualization() {
        // Some raw data (not necessarily accurate)
    var periodo=$("#periodo").val();//Datos que enviaremos para generar una consulta en la base de datos
    var jsonData= $.ajax({
      url: 'chart.php',
      data: {'periodo':periodo,'action':'ajax'},
      dataType: 'json',
      async: false
  }).responseText;

    var obj = jQuery.parseJSON(jsonData);
    var data = google.visualization.arrayToDataTable(obj);



    var options = {
      title : 'Ingresos vs Egresos '+periodo,
      vAxis: {title: 'Monto'},
      hAxis: {title: 'Meses'},
      seriesType: 'bars',
      series: {5: {type: 'line'}}
  };

  var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
  google.visualization.events.addListener(chart, 'error', errorHandler);
  chart.draw(data, options);
}

  // Haciendo los graficos responsivos
  jQuery(document).ready(function(){
    jQuery(window).resize(function(){
     drawVisualization();
 });
});

</script>

    <?php require 'includes/footer_end.php'
?>