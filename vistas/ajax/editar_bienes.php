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
    $nombre      = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_nombre"], ENT_QUOTES)));
    $descripcion = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_descripcion"], ENT_QUOTES)));
    $serie       = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_serie"], ENT_QUOTES)));
    $modelo      = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_modelo"], ENT_QUOTES)));
    $color       = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_color"], ENT_QUOTES)));
    $estado      = intval($_POST['mod_estado']);
    $status      = intval($_POST['mod_status']);
    $id_bienes   = intval($_POST['mod_id']);

    $sql = "UPDATE bienes SET  nombre_bienes='" . $nombre . "',
                                descripcion_bienes='" . $descripcion . "',
                                serie_bienes='" . $serie . "',
                                modelo_bienes='" . $modelo . "',
                                color_bienes='" . $color . "',
                                estado_bienes='" . $estado . "',
                                status_bienes='" . $status . "'
                                WHERE id_bienes='" . $id_bienes . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Bienes y Muebles se ha actualizada con Exito.";
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