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
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $daterange = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['range'], ENT_QUOTES)));
    $aColumns = array('evento_dev'); //Columnas de busqueda
    $sTable   = "devociones";
    $sWhere   = "";
    if (!empty($daterange)) {
        list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
        list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
        $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
        list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
        $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

        $sWhere = " WHERE fecha_dev between '$fecha_inicial' and '$fecha_final' ";
    }
    $sWhere .= " order by id_dev";
    include 'pagination.php'; //include pagination file
    //pagination variables
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //how much records you want to show
    $adjacents = 4; //gap between pages after number of adjacents
    $offset    = ($page - 1) * $per_page;
    //Count the total number of row in your table*/
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
    $row         = mysqli_fetch_array($count_query);
    $numrows     = $row['numrows'];
    $total_pages = ceil($numrows / $per_page);
    $reload      = '../html/bitacora_devocion.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {

        ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <tr  class="info">
                    <th>Id</th>
                    <th>EVENTO</th>
                    <th>FECHA</th>
                    <th>VARONES</th>
                    <th>HEMBRAS</th>
                    <th>NIÑOS</th>
                    <th>TOTAL</th>
                    <th>OFRENDA</th>
                    <th>CONV.</th>
                    <th>REC.</th>
                    <th>BAUTISMOS</th>
                    <th></th>

                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
            $id_dev  = $row['id_dev'];
            $evento_dev     = $row['evento_dev'];
            $fecha_dev     = $row['fecha_dev'];
            $varones_dev = $row['varones_dev'];
            $hembras_dev      = $row['hembras_dev'];
            $ninos_dev      = $row['ninos_dev'];
            $total_dev      = $row['total_dev'];
            $ofrenda_dev      = $row['ofrenda_dev'];
            $conv_dev      = $row['conv_dev'];
            $rec_dev     = $row['rec_dev'];
            $bautismos_dev     = $row['bautismos_dev'];
            list($date)      = explode(" ", $fecha_dev);
            list($Y, $m, $d) = explode("-", $date);
            $fecha           = $d . "-" . $m . "-" . $Y;

            ?>

    <input type="hidden" value="<?php echo $evento_dev; ?>" id="evento<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $fecha_dev; ?>" id="fecha<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $varones_dev; ?>" id="varones<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $hembras_dev; ?>" id="hembras<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $ninos_dev; ?>" id="ninos<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $total_dev; ?>" id="total<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $ofrenda_dev; ?>" id="ofrenda<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $conv_dev; ?>" id="conv<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $rec_dev; ?>" id="rec<?php echo $id_dev; ?>">
    <input type="hidden" value="<?php echo $bautismos_dev; ?>" id="btm<?php echo $id_dev; ?>">

    <tr>
        <td><span class="badge badge-purple"><?php echo $id_dev; ?></span></td>
        <td><?php echo $evento_dev; ?></td>
        <td><?php echo $fecha; ?></td>
        <td><?php echo $varones_dev; ?></td>
        <td><?php echo $hembras_dev; ?></td>
        <td><?php echo $ninos_dev; ?></td>
        <td><?php echo $total_dev; ?></td>
        <td><?php echo $id_moneda.' '. number_format($ofrenda_dev, 2); ?></td>
        <td><?php echo $conv_dev; ?></td>
        <td><?php echo $rec_dev; ?></td>
        <td><?php echo $bautismos_dev; ?></td>
        <td >
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                <div class="dropdown-menu dropdown-menu-right">
                   <?php if ($permisos_editar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarDev" onclick="obtener_datos('<?php echo $id_dev; ?>');"><i class='fa fa-edit'></i> Editar</a>
                   <?php }
            if ($permisos_eliminar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_dev; ?>"><i class='fa fa-trash'></i> Borrar</a>
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
    <td colspan="12">
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
      <strong>Aviso!</strong> No hay Registro de Devociones
  </div>
  <?php
}
// fin else
}
?>