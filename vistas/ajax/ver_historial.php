<?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
$id_miembro = $_SESSION['id_miembro'];
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
include "../permisos.php";
//Archivo de funciones PHP
require_once "../funciones.php";
$user_id        = $_SESSION['id_users'];
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$action         = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $daterange = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    $tipo      = intval($_REQUEST['tipo']);
    $tipoo     = intval($_REQUEST['tipoo']);
    $tables    = "ingresos";
    $campos    = "*";
    $sWhere    = "miembro_id='" . $id_miembro . "'";
    if ($tipo > 0) {
        $sWhere .= " and ingresos.cod_ingreso = '" . $tipo . "' ";
    }
    if ($tipoo > 0) {
        $sWhere .= " and ingresos.tipo_ingreso = '" . $tipoo . "' ";
    }
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and fecha_added between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by id_ingreso";

    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $tables where $sWhere ");
    if ($row = mysqli_fetch_array($count_query)) {$numrows = $row['numrows'];} else {echo mysqli_error($conexion);}
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../ver_historial.php';
    //main query to fetch the data
    $query = mysqli_query($conexion, "SELECT $campos FROM  $tables where $sWhere LIMIT $offset,$per_page");
    //loop through fetched data

    if ($numrows > 0) {
        ?>

        <div class="table-responsive">
            <table class="table table-sm table table-condensed table-hover table-striped ">
                <tr>
                    <th>ID</th>
                    <th>Tipo Ingreso</th>
                    <th>Categoria</th>
                    <th>Fecha</th>
                    <th>Monto</th>
                    <th>Modo de Pago</th>
                    <th></th>
                </tr>
                <?php
$finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $id_users    = $row['users'];
            $cod_ingreso = $row['cod_ingreso'];
            $tipoo       = get_row('tipo_ingreso', 'nombre_tipoi', 'id_tipoi', $row['tipo_ingreso']);
            $sql         = mysqli_query($conexion, "select usuario_users from users where id_users='" . $id_users . "'");
            $rw          = mysqli_fetch_array($sql);
            $usuario     = $rw['usuario_users'];
            if ($cod_ingreso == 1) {
                $tip = "<span class='badge badge-primary'>OFRENDA</span>";
            } else {
                $tip = "<span class='badge badge-danger'>DIEZMO</span>";
            }
            ?>
                    <tr>
                        <td><label class='badge badge-purple'><?php echo $row['id_ingreso']; ?></label></td>
                        <td><?php echo $tip; ?></td>
                        <td><?php echo $tipoo; ?></td>
                        <td><?php echo date("d/m/Y", strtotime($row['fecha_added'])); ?></td>
                        <td><?php echo $simbolo_moneda . '' . number_format($row['monto'], 2); ?></td>
                        <td><?php echo pago($row['pago_ingreso']); ?></td>
                        <td><a class='btn btn-info btn-rounded waves-effect waves-light' href="#" title="Imprimir Resibo" onclick="imprimir_abono('<?php echo $row['id_ingreso']; ?>');"><i class="fa fa-print"></i>
                        </a>
                    </td>
                </tr>
            <?php }?>
        </table>
    </div>

    <div class="box-footer clearfix" align="right">

        <?php
$inicios = $offset + 1;
        $finales += $inicios - 1;
        echo "Mostrando $inicios al $finales de $numrows registros";
        echo paginate($reload, $page, $total_pages, $adjacents);?>

    </div>

    <?php
}
}
?>

