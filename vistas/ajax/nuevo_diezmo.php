<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_miembro'])) {
    $errors[] = "Referencia vacío";
} else if (!empty($_POST['id_miembro'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $tipo       = intval($_POST['tipo']);
    $id_miembro = intval($_POST['id_miembro']);
    $ref        = mysqli_real_escape_string($conexion, (strip_tags($_POST["ref"], ENT_QUOTES)));
    $modo_pago  = intval($_POST['modo']);
    $obs        = mysqli_real_escape_string($conexion, (strip_tags($_POST["obs"], ENT_QUOTES)));
    $fecha      = mysqli_real_escape_string($conexion, (strip_tags($_POST["fech"], ENT_QUOTES)));
    $monto      = floatval($_POST['monto']);
    $date_added = date("Y-m-d H:i:s");
    $users      = intval($_SESSION['id_users']);

    $sql = "INSERT INTO ingresos (ref_ingreso, obs_ingreso, miembro_id, monto,  tipo_ingreso, pago_ingreso, fecha_added, fecha, users, cod_ingreso)
                            VALUES ('$ref','$obs','$id_miembro','$monto','$tipo','$modo_pago','$fecha','$date_added','$users','2')";
    $query_new_insert = mysqli_query($conexion, $sql);

    if ($query_new_insert) {
        $messages[] = "Ingreso ha sido guardado con Exito.";
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