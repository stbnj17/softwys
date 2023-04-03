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
    $nombre     = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre2"], ENT_QUOTES)));
    $sector     = mysqli_real_escape_string($conexion, (strip_tags($_POST["sector2"], ENT_QUOTES)));
    $supervisor = intval($_POST['id_miembro3']);
    $lider      = intval($_POST['id_miembro4']);
    $anfitrion     = mysqli_real_escape_string($conexion, (strip_tags($_POST["anfi2"], ENT_QUOTES)));
    $grupo     = intval($_POST['grupo2']);
    $estado     = intval($_POST['estado2']);
    $id_celula  = intval($_POST['mod_id']);

    $sql = "UPDATE celulas SET  nombre_cel='" . $nombre . "',
                                sector_cel='" . $sector . "',
                                supervisor_cel='" . $supervisor . "',
                                lider_cel='" . $lider . "',
                                anfitrion_cel='" . $anfitrion . "',
                                grupo_cel='" . $grupo . "',
                                estado_cel='" . $estado . "'
                                WHERE id_celula='" . $id_celula . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Células Familia se ha actualizada con Exito.";
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