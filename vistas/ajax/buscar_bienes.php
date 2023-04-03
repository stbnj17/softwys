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
    $aColumns = array('nombre_bienes', 'serie_bienes', 'modelo_bienes'); //Columnas de busqueda
    $sTable   = "bienes";
    $sWhere   = "";
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    $sWhere .= " order by id_bienes";
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
    $reload      = '../html/familias.php';
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
                    <th>ESTADO</th>
                    <th>No.SERIE</th>
                    <th>MODELO</th>
                    <th>COLOR</th>
                    <th>STATUS</th>
                    <th></th>

                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
            $id_bienes   = $row['id_bienes'];
            $nombre      = $row['nombre_bienes'];
            $descripcion = $row['descripcion_bienes'];
            $serie       = $row['serie_bienes'];
            $modelo      = $row['modelo_bienes'];
            $color       = $row['color_bienes'];
            $estado      = $row['estado_bienes'];
            $stat        = $row['status_bienes'];
            if ($stat == 1) {
                $status = "<span class='badge badge-success'>Activo</span>";
            } else {
                $status = "<span class='badge badge-danger'>Inactivo</span>";
            }
            if ($estado == 1) {
                $est = "Nuevoo";
            } else if ($estado == 2) {
                $est = "En Uso";
            } else if ($estado == 3) {
                $est = "Dañado";
            } else if ($estado == 4) {
                $est = "Reparacion";
            } else {
                $est = "Inservible";
            }
            ?>

    <input type="hidden" value="<?php echo $nombre; ?>" id="nombre<?php echo $id_bienes; ?>">
    <input type="hidden" value="<?php echo $descripcion; ?>" id="descripcion<?php echo $id_bienes; ?>">
    <input type="hidden" value="<?php echo $serie; ?>" id="serie<?php echo $id_bienes; ?>">
    <input type="hidden" value="<?php echo $modelo; ?>" id="modelo<?php echo $id_bienes; ?>">
    <input type="hidden" value="<?php echo $color; ?>" id="color<?php echo $id_bienes; ?>">
    <input type="hidden" value="<?php echo $stat; ?>" id="stat<?php echo $id_bienes; ?>">
    <input type="hidden" value="<?php echo $estado; ?>" id="estado<?php echo $id_bienes; ?>">

    <tr>
        <td><span class="badge badge-purple"><?php echo $id_bienes; ?></span></td>
        <td><?php echo $nombre; ?></td>
        <td><?php echo $est; ?></td>
        <td><?php echo $serie; ?></td>
        <td><?php echo $modelo; ?></td>
        <td><?php echo $color; ?></td>
        <td><?php echo $status; ?></td>
        <td >
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                <div class="dropdown-menu dropdown-menu-right">
                   <?php if ($permisos_editar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarBienes" onclick="obtener_datos('<?php echo $id_bienes; ?>');"><i class='fa fa-edit'></i> Editar</a>
                   <?php }
            if ($permisos_eliminar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_bienes; ?>"><i class='fa fa-trash'></i> Borrar</a>
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
      <strong>Aviso!</strong> No hay Registro de Tipo de Bienes y Muebles
  </div>
  <?php
}
// fin else
}
?>