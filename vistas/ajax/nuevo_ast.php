<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_cel'])) {
    $errors[] = "ID vacío";
} else if (!empty($_POST['id_cel'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code

    $id_cel  = intval($_POST['id_cel']);
    $herm    = intval($_POST['herm']);
    $amigos  = intval($_POST['amigos']);
    $ninos   = intval($_POST['ninos']);
    $ofrenda = floatval($_POST['ofrenda']);
    $conv    = intval($_POST['conv']);
    $recon   = intval($_POST['recon']);
    $baut    = intval($_POST['baut']);
    $sem     = intval($_POST['sem']);
    $ast     = intval($_POST['ast']);
    $fecha   = mysqli_real_escape_string($conexion, (strip_tags($_POST["fecha"], ENT_QUOTES)));
    $users   = intval($_SESSION['id_users']);

    // write new user's data into database

    $sql = "INSERT INTO asistencias (celula_id, hermanos, amigos, ninos, ofrenda, conv, recon, bautismos, seminarista, ast_iglesia, users, fecha_add)
                             VALUES ('$id_cel','$herm','$amigos','$ninos', '$ofrenda', '$conv','$recon','$baut','$sem','$ast','$users','$fecha')";
    $query_new_insert = mysqli_query($conexion, $sql);

    if ($query_new_insert) {
        $messages[] = "La Asistencia ha sido ingresada con Exito.";
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