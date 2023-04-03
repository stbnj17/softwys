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
$modulo = "Miembros";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos

$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != null) ? $_REQUEST['action'] : '';
if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    $q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
    $aColumns = array('nombre_miembro', 'apellido_miembro', 'documento_miembro', 'ciudad_miembro'); //Columnas de busqueda
    $sTable   = "miembros";
    $sWhere   = "";
    if ($_GET['q'] != "") {
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
    }
    $sWhere .= " order by apellido_miembro ASC";
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
    $reload      = '../html/pacientes.php';
    //main query to fetch the data
    $sql   = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
    $query = mysqli_query($conexion, $sql);
    //loop through fetched data
    if ($numrows > 0) {

        ?>
        <div class="table-responsive">
            <table class="table table-sm table-striped">
                <tr  class="info">
                    <th>NOMBRE</th>
                    <th>TEL.CELULAR</th>
                    <th>TEL.FIJO</th>
                    <th>CIUDAD</th>
                    <th>EMAIL</th>
                    <th>ESTADO</th>
                    <th>AGREGADO</th>
                    <th class='text-right'>ACCIONES</th>

                </tr>
                <?php
while ($row = mysqli_fetch_array($query)) {
            $id_miembro        = $row['id_miembro'];
            $nombre_miembro    = $row['nombre_miembro'];
            $apellido_miembro  = $row['apellido_miembro'];
            $direccion_miembro = $row['direccion_miembro'];
            $ciudad_miembro    = $row['ciudad_miembro'];
            $celular_miembro   = $row['celular_miembro'];
            $telefono_miembro  = $row['telefono_miembro'];
            $fecha_nacimiento  = $row['fecha_nacimiento'];
            $estudio_miembro   = $row['estudio_miembro'];
            $cargo_miembro     = $row['cargo_miembro'];
            $civil_miembro     = $row['civil_miembro'];
            $email_miembro     = $row['email_miembro'];
            $sexo_miembro      = $row['sexo_miembro'];
            $documento_miembro = $row['documento_miembro'];
            $status_miembro    = $row['estado_miembro'];
            $familia_id        = $row['familia_id'];
            $date_added        = date('d/m/Y', strtotime($row['date_addedd']));
            if ($status_miembro == 1) {
                $estado = "<span class='badge badge-success'>Activo</span>";
            } else {
                $estado = "<span class='badge badge-danger'>Inactivo</span>";
            }
            ?>

    <input type="hidden" value="<?php echo $nombre_miembro; ?>" id="nombre_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $apellido_miembro; ?>" id="apellido_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $direccion_miembro; ?>" id="direccion_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $ciudad_miembro; ?>" id="ciudad_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $celular_miembro; ?>" id="celular_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $telefono_miembro; ?>" id="telefono_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $encargado_miembro; ?>" id="encargado_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $fecha_nacimiento; ?>" id="fecha_nacimiento<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $estudio_miembro; ?>" id="estudio_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $cargo_miembro; ?>" id="cargo_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $civil_miembro; ?>" id="civil_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $documento_miembro; ?>" id="documento_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $email_miembro; ?>" id="email_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $sexo_miembro; ?>" id="sexo_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $status_miembro; ?>" id="status_miembro<?php echo $id_miembro; ?>">
    <input type="hidden" value="<?php echo $familia_id; ?>" id="familia_id<?php echo $id_miembro; ?>">

    <tr>
        <td><?php echo $apellido_miembro . ' ' . $nombre_miembro; ?></td>
        <td ><?php echo $celular_miembro; ?></td>
        <td ><?php echo $telefono_miembro; ?></td>
        <td ><?php echo $ciudad_miembro; ?></td>
        <td><?php echo $email_miembro; ?></td>
        <td><?php echo $estado; ?></td>
        <td><?php echo $date_added; ?></td>

        <td >
            <div class="btn-group dropdown">
                <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                <div class="dropdown-menu dropdown-menu-right">
                   <?php if ($permisos_editar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarPaciente" onclick="obtener_datos('<?php echo $id_miembro; ?>');"><i class='fa fa-edit'></i> Editar</a>
                        <a class="dropdown-item" href="historial.php?id_miembro=<?php echo $id_miembro; ?>"><i class='fa fa-address-book-o'></i> Contribuciones</a>
                   <?php }
            if ($permisos_eliminar == 1) {?>
                   <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_miembro; ?>"><i class='fa fa-trash'></i> Borrar</a>
                   <?php }?>


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
      <strong>Aviso!</strong> No hay Registro de Miembro
  </div>
  <?php
}
// fin else
}
?>