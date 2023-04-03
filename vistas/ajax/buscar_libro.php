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
    $sTable = "libros, autores, editoriales";
    $sWhere = "";
    $sWhere .= " WHERE libros.autor_id=autores.id_autor and libros.editorial_id=editoriales.id_editorial";

    if ($_GET['q'] != "") {
        $sWhere .= " and  (libros.titulo like '%$q%' or autores.autor like '%$q%' or editoriales.editorial like '%$q%')";
    }
    $sWhere .= " order by id_libros";
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
                <tr class="info">
                    <th>Id</th>
                    <th>TITULO</th>
                    <th>AUTOR</th>
                    <th>CATEGORIA</th>
                    <th>EDITORIAL</th>
                    <th>ESTADO</th>
                    <th></th>

                </tr>
                <?php
                while ($row = mysqli_fetch_array($query)) {
                    $id_libro  = $row['id_libros'];
                    $titulo      = $row['titulo'];
                    $fecha_lanzamiento      = $row['fecha_lanzamiento'];
                    $autor_id      = $row['autor_id'];
                    $cat_id      = $row['cat_id'];
                    $editorial_id      = $row['editorial_id'];
                    $idioma      = $row['idioma'];
                    $paginas      = $row['paginas'];
                    $descripcion = $row['descripcion'];
                    $estad       = $row['estado'];
                    if ($estad == 1) {
                        $estado = "<span class='badge badge-success'>Activo</span>";
                    } else {
                        $estado = "<span class='badge badge-danger'>Inactivo</span>";
                    }
                    //$autor = get_row('autores', 'autor', 'id_autor', $autor_id);
                    $categoria = get_row('cat_libro', 'categoria', 'id_cat', $cat_id);
                    //$editorial = get_row('editoriales', 'editorial', 'id_editorial', $editorial_id);

                ?>

                    <input type="hidden" value="<?php echo $titulo; ?>" id="titulo<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $fecha_lanzamiento; ?>" id="fecha_lanzamiento<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $autor_id; ?>" id="autor_id<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $cat_id; ?>" id="cat_id<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $editorial_id; ?>" id="editorial_id<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $idioma; ?>" id="idioma<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $paginas; ?>" id="paginas<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $descripcion; ?>" id="descripcion<?php echo $id_libro; ?>">
                    <input type="hidden" value="<?php echo $estad; ?>" id="estad<?php echo $id_libro; ?>">

                    <tr>
                        <td><span class="badge badge-purple"><?php echo $id_libro; ?></span></td>
                        <td><?php echo $titulo; ?></td>
                        <td><?php echo $row['autor']; ?></td>
                        <td><?php echo $categoria; ?></td>
                        <td><?php echo $row['editorial']; ?></td>
                        <td><?php echo $estado; ?></td>
                        <td>
                            <div class="btn-group dropdown">
                                <button type="button" class="btn btn-warning btn-rounded dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false"> <i class='fa fa-cog'></i> <i class="caret"></i> </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php if ($permisos_editar == 1) { ?>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editarLibro" onclick="obtener_datos('<?php echo $id_libro; ?>');"><i class='fa fa-edit'></i> Editar</a>
                                    <?php }
                                    if ($permisos_eliminar == 1) { ?>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#dataDelete" data-id="<?php echo $id_libro; ?>"><i class='fa fa-trash'></i> Borrar</a>
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
            <strong>Aviso!</strong> No hay Registro de Libros
        </div>
<?php
    }
    // fin else
}
?>