<?php

/*-------------------------
Autor: Delmar Lopez
Web: softwys.com
Mail: softwysop@gmail.com
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Tesorerias";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
//Archivo de funciones PHP
require_once "../funciones.php";
$id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $daterange = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    $tipoo     = intval($_REQUEST['tipoo']);
    $tables    = "egresos,  users";
    $campos    = "*";
    $sWhere    = "users.id_users=egresos.users";
    if ($tipoo > 0) {
        $sWhere .= " and egresos.tipo_egreso = '" . $tipoo . "' ";
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
    $reload      = '../ingresos.php';
    //main query to fetch the data
    $query = mysqli_query($conexion, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
    //loop through fetched data
    //loop through fetched data
    if ($numrows > 0) {

        ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <tr  class="info">
                    <th>Id</th>
                    <th>Referencia</th>
                    <th>Monto</th>
                    <th>Gasto</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th></th>

                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
            $id_egreso          = $row['id_egreso'];
            $referencia_egreso  = $row['referencia_egreso'];
            $descripcion_egreso = $row['descripcion_egreso'];
            $id_tipo            = $row['tipo_egreso'];
            $monto              = $row['monto'];
            $date               = date('d/m/Y', strtotime($row['fecha_added']));
            $date_added         = $row['fecha_added'];
            /*--------------------------------------------------------------*/
            /* Busca el nombre del Gasto en la tabla tipo_gasto
            /*--------------------------------------------------------------*/
            $sql         = mysqli_query($conexion, "select * from tipo_gasto where id_tipo='" . $id_tipo . "'");
            $rw          = mysqli_fetch_array($sql);
            $nombre_tipo = $rw['nombre_tipo'];

            ?>

    <input type="hidden" value="<?php echo $referencia_egreso; ?>" id="referencia_egreso<?php echo $id_egreso; ?>">
    <input type="hidden" value="<?php echo $date_added; ?>" id="date_added<?php echo $id_egreso; ?>">
    <input type="hidden" value="<?php echo $descripcion_egreso; ?>" id="descripcion_egreso<?php echo $id_egreso; ?>">
    <input type="hidden" value="<?php echo $monto; ?>" id="monto<?php echo $id_egreso; ?>">
    <input type="hidden" value="<?php echo $id_tipo; ?>" id="tipo<?php echo $id_egreso; ?>">

    <tr>
        <td><span class="badge badge-purple"><?php echo $id_egreso; ?></span></td>
        <td><?php echo $referencia_egreso; ?></td>
        <td><?php echo $id_moneda . '' . number_format($monto, 2); ?></td>
        <td><?php echo $nombre_tipo; ?></td>
        <td><?php echo $descripcion_egreso; ?></td>
        <td><?php echo $date; ?></td>

        <td >
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                <div class="dropdown-menu dropdown-menu-right">
                   <?php if ($permisos_editar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarGasto" onclick="obtener_datos('<?php echo $id_egreso; ?>');"><i class='fa fa-edit'></i> Editar</a>
                   <?php }
            if ($permisos_eliminar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_egreso; ?>"><i class='fa fa-trash'></i> Borrar</a>
                   <?php }
            ?>


               </div>
           </div>

       </td>

   </tr>
   <?php
}
        ?>
<tr>
    <td colspan="7">
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
      <strong>Aviso!</strong> No hay Registro de Gastos
  </div>
  <?php
}
// fin else
}
?>