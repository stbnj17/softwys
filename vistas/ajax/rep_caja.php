<?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
include "../permisos.php";
//Archivo de funciones PHP
require_once "../funciones.php";
$user_id = $_SESSION['id_users'];
$action  = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $daterange   = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    $employee_id = intval($_REQUEST['employee_id']);
    $tables      = "ingresos,  users";
    $campos      = "*";
    $sWhere      = "users.id_users=ingresos.users";
    if ($employee_id > 0) {
        $sWhere .= " and ingresos.users = '" . $employee_id . "' ";
    }
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and ingresos.fecha between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by ingresos.id_ingreso desc";

    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 100; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $tables where $sWhere ");
    if ($row = mysqli_fetch_array($count_query)) {$numrows = $row['numrows'];} else {echo mysqli_error($conexion);}
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../ventas_users.php';
    //main query to fetch the data
    $query = mysqli_query($conexion, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
    //loop through fetched data

    if ($numrows > 0) {
        ?>

        <div class="table-responsive">
                <?php
$finales = 0;

        $totalOfrenda   = 0;
        $totalDiezmo    = 0;
        $totalIngreso   = 0;
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
        while ($row = mysqli_fetch_array($query)) {
            if ($row['cod_ingreso'] == 1) {
                $totalOfrenda += $row['monto'];
            } elseif ($row['cod_ingreso'] == 2) {
                $totalDiezmo += $row['monto'];
            }
            $totalIngreso += $row['monto'];
            ?>

                    <?php }

//otra consulta para sumar las ofrendas de las celulas
        $sql       = mysqli_query($conexion, "select  SUM(ofrenda) as total_ast from asistencias WHERE fecha_add between '$fecha_inicial' and '$fecha_final'");
        $rw        = mysqli_fetch_array($sql);
        $total_ast = $rw['total_ast'];
        ?>
                      <div class="col-sm-6">
          <table class="table table-bordered" cellspacing="0" style="width: 100%;font-size: 12pt;">
            <tr class="success" style="background-color: #7DCEA0;">
              <td style="width:100%; text-align: center;" colspan="2">INGRESOS</td>
            </tr>
            <tr>
             <td style="width:50%;text-align: left;">OFRENDAS:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalOfrenda, 2); ?></td>
           </tr>
           <tr>
             <td style="width:50%;text-align: left;">DIEZMOS:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalDiezmo, 2); ?></td>
           </tr>
           <tr>
             <td style="width:50%;text-align: left;">CÉLULAS  FAMILIARES:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($total_ast, 2); ?></td>
           </tr>
           <tr>
             <td style="width:50%;text-align: right;font-weight:bold;">TOTAL INGRESOS:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalIngreso + $total_ast, 2); ?></td>
           </tr>
         </table>
         <?php
$totalEntrada   = 0;
        $totalSalida    = 0;
        $total_efectivo = 0;
        $totalEngreso   = 0;
        if ($employee_id > 0) {
            $caja = mysqli_query($conexion, "select * from egresos where users='" . $employee_id . "' and fecha_added between '$fecha_inicial' and '$fecha_final'");
        } else {
            $caja = mysqli_query($conexion, "select * from egresos where fecha_added between '$fecha_inicial' and '$fecha_final'");
        }
        while ($rw = mysqli_fetch_array($caja)) {
            $totalSalida += $rw['monto'];
            $totalEngreso += $row['monto'];
            $total_efectivo = $totalIngreso - $totalSalida;
        }
        ?>

       </div>
        <div class="col-sm-6">
       <table class="table table-bordered" cellspacing="0" style="width: 100%;font-size: 12pt;">
        <tr class="success" style="background-color: #D98880;">
         <td style="width:100%; text-align: center;" colspan="2">EGRESOS</td>
       </tr>

       <tr>
         <td style="width:50%;text-align: left;">TOTAL GASTOS:</td>
         <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalSalida, 2); ?></td>
       </tr>
       <tr>
         <td style="width:50%;text-align: right;font-weight:bold;">TOTAL EGRESOS:</td>
         <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalSalida, 2); ?></td>
       </tr>
       <tr>
         <td style="width:50%;text-align: right;font-weight:bold;">TOTAL:</td>
         <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format(($totalIngreso + $total_ast) - $totalSalida, 2); ?></td>
       </tr>
     </table>
   </div>


           </div>
        <?php
}
//Este else Fue agregado de Prueba de prodria Quitar
    else {
        ?>
    <div class="alert alert-warning alert-dismissible" role="alert" align="center">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Aviso!</strong> Selecciona un rango de fecha y Usuario para mostrar los datos
  </div>
  <?php
}
// fin else
}
?>
