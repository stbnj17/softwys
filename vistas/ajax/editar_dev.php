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
    $evento     = mysqli_real_escape_string($conexion, (strip_tags($_POST["evento2"], ENT_QUOTES)));
    $fecha     = mysqli_real_escape_string($conexion, (strip_tags($_POST["fecha2"], ENT_QUOTES)));
    $varones = intval($_POST['varones2']);
    $hembras      = intval($_POST['hembras2']);
    $ninos      = intval($_POST['ninos2']);
    $ofrenda      = floatval($_POST['ofrenda2']);
    $conv      = intval($_POST['conv2']);
    $rec      = intval($_POST['rec2']);
    $btm      = intval($_POST['btm2']);
    $total = $varones+$hembras+$ninos;
    $id_dev  = intval($_POST['mod_id']);

    $sql = "UPDATE devociones SET  evento_dev='" . $evento . "',
                                fecha_dev='" . $fecha . "',
                                varones_dev='" . $varones . "',
                                hembras_dev='" . $hembras . "',
                                ninos_dev='" . $ninos . "',
                                total_dev='" . $total . "',
                                ofrenda_dev='" . $ofrenda . "',
                                conv_dev='" . $conv . "',
                                rec_dev='" . $rec . "',
                                bautismos_dev='" . $btm . "'
                                WHERE id_dev='" . $id_dev . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Control de Devocion se ha actualizada con Exito.";
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