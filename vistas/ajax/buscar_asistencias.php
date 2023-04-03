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
    //$tipo      = intval($_REQUEST['tipo']);
    $cel    = intval($_REQUEST['cel']);
    $tables = "asistencias, celulas,  users";
    $campos = "*";
    $sWhere = "users.id_users=asistencias.users and asistencias.celula_id=celulas.id_celula";
    if ($cel > 0) {
        $sWhere .= " and asistencias.celula_id = '" . $cel . "' ";
    }
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and asistencias.fecha_add between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by asistencias.id_asistencia";

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
            <table class="table table-sm table-hover table-striped table-bordered">
                <tr>
                    <th>ID</th>
                    <th>CELULA</th>
                    <th>HERMANOS</th>
                    <th>AMIGOS</th>
                    <th>NIÑOS</th>
                    <th>OFRENDA</th>
                    <th>CONV.</th>
                    <th>RECON.</th>
                    <th>BAUTISMOS</th>
                    <th>SEMINARISTA</th>
                    <th>AST.IGLESIA</th>
                    <th class='text-center'>FECHA </th>
                    <th>ACCIONES</th>
                </tr>
                <?php
$finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $id_ast        = $row['id_asistencia'];
            $nom_celula    = get_row('celulas', 'nombre_cel', 'id_celula', $row['celula_id']);
            $celula_id     = $row['celula_id'];
            $hermanos      = $row['hermanos'];
            $amigos        = $row['amigos'];
            $ninos         = $row['ninos'];
            $ofrenda       = $row['ofrenda'];
            $conv          = $row['conv'];
            $recon         = $row['recon'];
            $bautismos     = $row['bautismos'];
            $seminarista   = $row['seminarista'];
            $ast_iglesia   = $row['ast_iglesia'];
            $estado_ast    = $row['estado_ast'];
            $date_added    = $row['fecha_add'];
            $id_users      = $row['users'];
            $user_fullname = $row['nombre_users'] . ' ' . $row['apellido_users'];

            list($date)      = explode(" ", $date_added);
            list($Y, $m, $d) = explode("-", $date);
            $fecha           = $d . "-" . $m . "-" . $Y;
            $finales++;

            if ($estado_ast == 1) {
                $estado = "<span class='badge badge-success'>Activo</span>";
            } else {
                $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }

            ?>
                    <input type="hidden" value="<?php echo $celula_id; ?>" id="celula_id<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $hermanos; ?>" id="hermanos<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $amigos; ?>" id="amigos<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $ninos; ?>" id="ninos<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $ofrenda; ?>" id="ofrenda<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $conv; ?>" id="conv<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $recon; ?>" id="recon<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $bautismos; ?>" id="bautismos<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $seminarista; ?>" id="seminarista<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $ast_iglesia; ?>" id="ast_iglesia<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $estado_ast; ?>" id="estado_ast<?php echo $id_ast ?>">
                    <input type="hidden" value="<?php echo $date_added; ?>" id="date_added<?php echo $id_ast ?>">

                    <tr>
                        <td><span class="badge badge-pill badge-primary"><?php echo $id_ast; ?></span></td>
                        <td><?php echo $nom_celula; ?></td>
                        <td align="center"><?php echo $hermanos; ?></td>
                        <td align="center"><?php echo $amigos; ?></td>
                        <td align="center"><?php echo $ninos; ?></td>
                        <td align="center"><?php echo $id_moneda . ' ' . number_format($ofrenda, 2); ?></td>
                        <td align="center"><?php echo $conv; ?></td>
                        <td align="center"><?php echo $recon; ?></td>
                        <td align="center"><?php echo $bautismos; ?></td>
                        <td align="center"><?php echo $seminarista; ?></td>
                        <td align="center"><?php echo $ast_iglesia; ?></td>
                        <td class='text-center'><?php echo $fecha; ?></td>
                        <td>
                            <div class="btn-group dropdown">
                <button type="button" class="btn btn-warning btn-md btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                <div class="dropdown-menu dropdown-menu-right">
                   <?php if ($permisos_editar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarAst" onclick="obtener_datos('<?php echo $id_ast; ?>');"><i class='fa fa-edit'></i> Editar</a>
                   <?php }
            if ($permisos_eliminar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_ast; ?>"><i class='fa fa-trash'></i> Borrar</a>
                   <?php }
            ?>


               </div>
           </div>
                       </td>
                   </tr>
                   <?php }?>
                <tr>
    <td colspan="13">
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
      <strong>Aviso!</strong> Selecciona un rango de fecha, Tipo de ingreso y categoria para mostrar los datos
  </div>
  <?php
}
// fin else
}
?>

