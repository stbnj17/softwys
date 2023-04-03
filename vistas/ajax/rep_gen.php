<?php
include "is_logged.php"; //Archivo comprueba si el usuario esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
require_once "../funciones.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Tesorerias";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$user_id   = $_SESSION['id_users'];
$action    = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    $daterange = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    $tipoo     = intval($_REQUEST['tipoo']);
    $tables    = "ingresos,  users";
    $campos    = "*";
    $sWhere    = "users.id_users=ingresos.users";
    if ($tipoo > 0) {
        $sWhere .= " and ingresos.tipo_ingreso = '" . $tipoo . "' ";
    }
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and ingresos.fecha_added between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by ingresos.id_ingreso";

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

    if ($numrows > 0) {
        ?>

        <div class="table-responsive">
            <table class="table table-sm table-hover table-striped ">
                <tr>
                    <th>ID</th>
                    <th>Referancia</th>
                    <th>Tipo</th>
                    <th>Categoria</th>
                    <th>Monto</th>
                    <th class='text-center'>Fecha </th>
                    <th>Modo Pago</th>
                </tr>
                <?php
$finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $id_ingreso    = $row['id_ingreso'];
            $tipoo         = $row['tipo_ingreso'];
            $cat           = $row['cod_ingreso'];
            $modo_pago     = $row['pago_ingreso'];
            $obs           = $row['obs_ingreso'];
            $ref           = $row['ref_ingreso'];
            $date_added    = $row['fecha_added'];
            $id_users      = $row['users'];
            $user_fullname = $row['nombre_users'] . ' ' . $row['apellido_users'];
            $monto         = $row['monto'];
            $nombre_cat    = get_row('tipo_ingreso', 'nombre_tipoi', 'id_tipoi', $tipoo);

            list($date)      = explode(" ", $date_added);
            list($Y, $m, $d) = explode("-", $date);
            $fecha           = $d . "-" . $m . "-" . $Y;
            $finales++;

            if ($tipoo == 1) {
                $reff = get_row('miembros', 'nombre_miembro', 'id_miembro', $ref) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $ref);
            } else {
                $reff = $ref;
            }
            ?>
                    <input type="hidden" value="<?php echo $tipoo; ?>" id="tipoo<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $ref; ?>" id="ref<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $modo_pago; ?>" id="modo_pago<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $monto; ?>" id="monto<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $obs; ?>" id="obs<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $date_added; ?>" id="date_added<?php echo $id_ingreso; ?>">

                    <tr>
                        <td><span class="badge badge-pill badge-primary"><?php echo $id_ingreso; ?></span></td>
                        <td><?php echo $reff; ?></td>
                        <td><?php echo tippo($cat); ?></td>
                        <td><?php echo $nombre_cat; ?></td>
                        <td><?php echo $id_moneda . '' . number_format($monto, 2); ?></td>
                        <td class='text-center'><?php echo $fecha; ?></td>
                        <td><?php echo pago($modo_pago); ?></td>

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

