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
    $tables      = "consultas,  pacientes";
    $campos      = "*";
    $sWhere      = "pacientes.id_paciente=consultas.id_paciente";
    if ($employee_id > 0) {
        $sWhere .= " and consultas.id_paciente = '" . $employee_id . "' ";
    }
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and consultas.date_added between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by consultas.id_consulta";

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
                    <th class='text-center'>Nº Consulta</th>
                    <th>Paciente</th>
                    <th class='text-center'>Fecha </th>
                    <th>Usuario </th>
                    <th>Ver </th>
                </tr>
                <?php
$finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $consulta          = $row['id_consulta'];
            $date_added        = $row['date_added'];
            $id_users          = $row['users'];
            $sql               = mysqli_query($conexion, "select nombre_users, apellido_users from users where id_users='" . $id_users . "'");
            $rw                = mysqli_fetch_array($sql);
            $user_fullname     = $rw['nombre_users'] . ' ' . $rw['apellido_users'];
            $nombre_paciente   = $row['nombre_paciente'];
            $motivo            = $row['motivo_consul'];
            list($date, $hora) = explode(" ", $date_added);
            list($Y, $m, $d)   = explode("-", $date);
            $fecha             = $d . "-" . $m . "-" . $Y;
            $finales++;
            ?>
                    <tr>
                        <td class='text-center'><span class="badge badge-pill badge-primary"><?php echo $consulta; ?></span></td>
                        <td><?php echo $nombre_paciente; ?></td>
                        <td class='text-center'><?php echo $fecha; ?></td>
                        <td><?php echo $user_fullname; ?></td>
                        <td><a class='btn btn-info btn-sm waves-effect waves-light' href="#" title="Ven Consulta" onclick="imprimir_receta('<?php echo $consulta; ?>');"><i class="fa fa-print"></i>
                        </a></td>
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

