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
$id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$user_id   = $_SESSION['id_users'];
$action    = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $daterange   = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    $employee_id = intval($_REQUEST['employee_id']);
    $tables      = "egresos,  users";
    $campos      = "*";
    $sWhere      = "users.id_users=egresos.users";
    if ($employee_id > 0) {
        $sWhere .= " and egresos.users = '" . $employee_id . "' ";
    }
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and egresos.fecha_added between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by egresos.id_egreso";

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
            <table class="table table-sm table-hover table-striped ">
                <tr>
                    <th>Referencia</th>
                    <th>Tipo de Pago</th>
                    <th>Monto</th>
                    <th class='text-center'>Fecha y Hora </th>
                    <th>Usuario </th>
                </tr>
                <?php
$finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $id_egreso     = $row['id_egreso'];
            $referencia    = $row['referencia_egreso'];
            $tipo_pago     = $row['tipo_egreso'];
            $date_added    = $row['fecha_added'];
            $id_users      = $row['users'];
            $user_fullname = $row['nombre_users'] . ' ' . $row['apellido_users'];
            $monto         = $row['monto'];
            $nombre_gasto  = get_row('tipo_gasto', 'nombre_tipo', 'id_tipo', $tipo_pago);
            $finales++;
            ?>
                    <tr>
                        <td><span class="badge badge-pill badge-purple"><?php echo $referencia; ?></span></td>
                        <td><?php echo $nombre_gasto; ?></td>
                        <td><?php echo $id_moneda . '' . number_format($monto, 2); ?></td>
                        <td class='text-center'><?php echo $date_added; ?></td>
                        <td><?php echo $user_fullname; ?></td>
                    </tr>
                    <?php }?>
               <td colspan="5">
        <span class="pull-right">
            <?php
echo paginate($reload, $page, $total_pages, $adjacents);
        ?></span>
        </td>
    </tr>
               </table>
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
