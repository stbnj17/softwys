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
    $obs_ingreso = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_obs"], ENT_QUOTES)));
    $fecha       = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_fech"], ENT_QUOTES)));
    $modo_pago   = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_modo"], ENT_QUOTES)));
    $monto       = floatval($_POST['mod_monto']);
    $id_ingreso  = intval($_POST['mod_id']);

    $sql = "UPDATE ingresos SET  obs_ingreso='" . $obs_ingreso . "',
                                monto='" . $monto . "',
                                pago_ingreso='" . $modo_pago . "',
                                fecha_added='" . $fecha . "'
                                WHERE id_ingreso='" . $id_ingreso . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Ingreso ha sido actualizado con Exito.";
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