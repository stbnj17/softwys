<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['mod_id'])) {
    $errors[] = "ID vacío";
} else if (
    !empty($_POST['mod_id'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $titulo      = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_titulo"], ENT_QUOTES)));
    $fecha      = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_fecha"], ENT_QUOTES)));
    $autor      = intval($_POST['mod_autor']);
    $cat      = intval($_POST['mod_cat']);
    $editorial      = intval($_POST['mod_editorial']);
    $idioma = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_idioma"], ENT_QUOTES)));
    $paginas      = intval($_POST['mod_paginas']);
    $descripcion = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_descripcion"], ENT_QUOTES)));
    $estado      = intval($_POST['mod_estado']);
    $id_libro  = intval($_POST['mod_id']);

    $sql = "UPDATE libros SET  titulo='" . $titulo . "',
                                fecha_lanzamiento='" . $fecha . "',
                                autor_id='" . $autor . "',
                                cat_id='" . $cat . "',
                                editorial_id='" . $editorial . "',
                                idioma='" . $idioma . "',
                                paginas='" . $paginas . "',
                                descripcion='" . $descripcion . "',
                                estado='" . $estado . "'
                                WHERE id_libros='" . $id_libro . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Libro se ha actualizada con Exito.";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
    }
} else {
    $errors[] = "Error desconocido.";
}

if (isset($errors)) {

?>
    <div class="alert alert-danger" role="alert">
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
            echo $error;
        }
        ?>
    </div>
<?php
}
if (isset($messages)) {

?>
    <div class="alert alert-success" role="alert">
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
            echo $message;
        }
        ?>
    </div>
<?php
}

?>