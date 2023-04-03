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
    include 'pagination.php'; //incluir el archivo de paginación
    //las variables de paginación
    $page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
    $per_page  = 10; //la cantidad de registros que desea mostrar
    $adjacents = 4; //brecha entre páginas después de varios adyacentes
    $offset    = ($page - 1) * $per_page;
    //Cuenta el número total de filas de la tabla*/
    $count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM miembros ");
    if ($row = mysqli_fetch_array($count_query)) {$numrows = $row['numrows'];}
    $total_pages = ceil($numrows / $per_page);
    $reload      = 'index.php';
    //consulta principal para recuperar los datos
    $query = mysqli_query($conexion, "SELECT * FROM miembros  order by nombre_miembro LIMIT $offset,$per_page");

    if ($numrows > 0) {
        ?>
        <table class="table table-sm table-hover table-striped ">
          <thead>
            <tr>
             <th>Nombres</th>
             <th>Apellidos</th>
             <th>Direccion</th>
             <th>Telefono</th>
             <th>Nacimiento</th>
             <th>Documento</th>
             <th>Email</th>
         </tr>
     </thead>
     <tbody>
        <?php
while ($row = mysqli_fetch_array($query)) {
            ?>
            <tr>
                <td><?php echo $row['nombre_miembro']; ?></td>
                <td><?php echo $row['apellido_miembro']; ?></td>
                <td><?php echo $row['direccion_miembro']; ?></td>
                <td><?php echo $row['telefono_miembro']; ?></td>
                <td><?php echo $row['fecha_nacimiento']; ?></td>
                <td><?php echo $row['documento_miembro']; ?></td>
                <td><?php echo $row['email_miembro']; ?></td>
            </tr>
            <?php
}
        ?>
    </tbody>
</table>
<div class="table-pagination pull-right">
    <?php echo paginate($reload, $page, $total_pages, $adjacents); ?>
</div>

<?php

    } else {
        ?>
    <div class="alert alert-warning alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4>Aviso!!!</h4> No hay datos para mostrar
  </div>
  <?php
}
}
?>
