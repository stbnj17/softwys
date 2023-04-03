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
    $aColumns = array('nombre_cel', 'sector_cel'); //Columnas de busqueda
    $sTable   = "celulas";
    $sWhere   = "";
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    $sWhere .= " order by id_celula";
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
    $reload      = '../html/celulas.php';
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
                    <th>NOMBRE</th>
                    <th>SECTOR</th>
                    <th>SUPERVISOR</th>
                    <th>LIDER</th>
                    <th>GRUPO</th>
                    <th>ESTADO</th>
                    <th></th>

                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
            $id_celula  = $row['id_celula'];
            $nombre     = $row['nombre_cel'];
            $sector     = $row['sector_cel'];
            $supervisor = $row['supervisor_cel'];
            $lider      = $row['lider_cel'];
            $anfitrion      = $row['anfitrion_cel'];
            $grupo      = $row['grupo_cel'];
            $estad      = $row['estado_cel'];

            $nom_supervisor = get_row('miembros', 'nombre_miembro', 'id_miembro', $supervisor) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $supervisor);
            $nom_lider      = get_row('miembros', 'nombre_miembro', 'id_miembro', $lider) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $lider);
            if ($estad == 1) {
                $estado = "<span class='badge badge-success'>Activo</span>";
            } else {
                $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }
            if ($grupo == 1) {
                $g = 'Niños';
            } elseif ($grupo == 2) {
                $g = 'Jovenes';
            } else {
                $g = "Adultos";
            }
            

            ?>

    <input type="hidden" value="<?php echo $nombre; ?>" id="nombre<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $sector; ?>" id="sector<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $supervisor; ?>" id="supervisor<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $lider; ?>" id="lider<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $anfitrion; ?>" id="anfitrion<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $grupo; ?>" id="grupo<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $estad; ?>" id="estad<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $nom_supervisor; ?>" id="nom_supervisor<?php echo $id_celula; ?>">
    <input type="hidden" value="<?php echo $nom_lider; ?>" id="nom_lider<?php echo $id_celula; ?>">

    <tr>
        <td><span class="badge badge-purple"><?php echo $id_celula; ?></span></td>
        <td><?php echo $nombre; ?></td>
        <td><?php echo $sector; ?></td>
        <td><?php echo $nom_supervisor; ?></td>
        <td><?php echo $nom_lider; ?></td>
        <td><?php echo $g; ?></td>
        <td><?php echo $estado; ?></td>
        <td >
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                <div class="dropdown-menu dropdown-menu-right">
                   <?php if ($permisos_editar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarCelula" onclick="obtener_datos('<?php echo $id_celula; ?>');"><i class='fa fa-edit'></i> Editar</a>
                   <?php }
            if ($permisos_eliminar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_celula; ?>"><i class='fa fa-trash'></i> Borrar</a>
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
      <strong>Aviso!</strong> No hay Registro de Células Familiares
  </div>
  <?php
}
// fin else
}
?>