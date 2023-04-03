<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['evento'])) {
    $errors[] = "Nombre vacío";
} else if (!empty($_POST['evento'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $evento     = mysqli_real_escape_string($conexion, (strip_tags($_POST["evento"], ENT_QUOTES)));
    $fecha     = mysqli_real_escape_string($conexion, (strip_tags($_POST["fecha"], ENT_QUOTES)));
    $varones = intval($_POST['varones']);
    $hembras      = intval($_POST['hembras']);
    $ninos      = intval($_POST['ninos']);
    $ofrenda      = floatval($_POST['ofrenda']);
    $conv      = intval($_POST['conv']);
    $rec      = intval($_POST['rec']);
    $btm      = intval($_POST['btm']);
    $users      = intval($_SESSION['id_users']);
    $total = $varones+$hembras+$ninos;
    
        // write new user's data into database
        $sql = "INSERT INTO devociones (evento_dev, fecha_dev, varones_dev, hembras_dev, ninos_dev, total_dev, ofrenda_dev,conv_dev, rec_dev, bautismos_dev)
                             VALUES ('$evento','$fecha','$varones','$hembras', '$ninos','$total', '$ofrenda','$conv', '$rec','$btm')";
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Control de Devocion ha sido ingresado con Exito.";
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