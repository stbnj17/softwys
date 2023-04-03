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
    $tables    = "ingresos, miembros,  users";
    $campos    = "*";
    $sWhere    = "users.id_users=ingresos.users and ingresos.miembro_id=miembros.id_miembro and cod_ingreso=2 ";
    if ($tipoo > 0) {
        $sWhere .= " and ingresos.tipo_ingreso = '" . $tipoo . "' ";
    }
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere .= " and ingresos.fecha_added between '$fecha_inicial' and '$fecha_final'";
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
                    <th>Miembro</th>
                    <th>Categoria</th>
                    <th>Monto</th>
                    <th class='text-center'>Fecha </th>
                    <th>Modo Pago</th>
                    <th></th>
                </tr>
                <?php
$finales = 0;
        while ($row = mysqli_fetch_array($query)) {
            $id_ingreso    = $row['id_ingreso'];
            $tipoo         = get_row('tipo_ingreso', 'nombre_tipoi', 'id_tipoi', $row['tipo_ingreso']);
            $modo_pago     = $row['pago_ingreso'];
            $cat_ingreso   = $row['tipo_ingreso'];
            $obs           = $row['obs_ingreso'];
            $ref           = $row['ref_ingreso'];
            $date_added    = $row['fecha_added'];
            $id_users      = $row['users'];
            $user_fullname = $row['nombre_users'] . ' ' . $row['apellido_users'];
            $monto         = $row['monto'];
            $nombre        = $row['nombre_miembro'] . ' ' . $row['apellido_miembro'];

            list($date)      = explode(" ", $date_added);
            list($Y, $m, $d) = explode("-", $date);
            $fecha           = $d . "-" . $m . "-" . $Y;
            $finales++;
            if ($tipoo == 1) {
                $tipo = "<span class='badge badge-primary'>DIEZMO</span>";
            } else {
                $tipo = "<span class='badge badge-danger'>OFRENDA</span>";
            }
            if ($tipoo == 1) {
                $reff = get_row('miembros', 'nombre_miembro', 'id_miembro', $ref) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $ref);
            } else {
                $reff = $ref;
            }
            ?>
                    <input type="hidden" value="<?php echo $nombre; ?>" id="nombre<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $cat_ingreso; ?>" id="cat_ingreso<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $ref; ?>" id="ref<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $modo_pago; ?>" id="modo_pago<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $monto; ?>" id="monto<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $obs; ?>" id="obs<?php echo $id_ingreso; ?>">
                    <input type="hidden" value="<?php echo $date_added; ?>" id="date_added<?php echo $id_ingreso; ?>">

                    <tr>
                        <td><span class="badge badge-pill badge-primary"><?php echo $id_ingreso; ?></span></td>
                        <td><?php echo $reff; ?></td>
                        <td><?php echo $nombre; ?></td>
                        <td><?php echo $tipoo; ?></td>
                        <td><?php echo $id_moneda . '' . number_format($monto, 2); ?></td>
                        <td class='text-center'><?php echo $fecha; ?></td>
                        <td><?php echo pago($modo_pago); ?></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                   <?php if ($permisos_editar == 1) {?>
                                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarIngreso" onclick="obtener_datos('<?php echo $id_ingreso; ?>');"><i class='fa fa-edit'></i> Editar</a>
                                   <?php }
            if ($permisos_eliminar == 1) {?>
                                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_ingreso; ?>"><i class='fa fa-trash'></i> Borrar</a>
                                   <?php }?>


                               </div>
                           </div>
                       </td>
                   </tr>
                   <?php }?>
              <tr>
    <td colspan="8">
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
      <strong>Aviso!</strong> No hay Registro de Diezmos
  </div>
  <?php
}
// fin else
}
?>



