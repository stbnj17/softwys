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
    $id_cel  = intval($_POST['id_cel2']);
    $herm    = intval($_POST['herm2']);
    $amigos  = intval($_POST['amigos2']);
    $ninos   = intval($_POST['ninos2']);
    $ofrenda = intval($_POST['ofrenda2']);
    $conv    = intval($_POST['conv2']);
    $recon   = intval($_POST['recon2']);
    $baut    = intval($_POST['baut2']);
    $sem     = intval($_POST['sem2']);
    $ast     = intval($_POST['ast2']);
    $fecha   = mysqli_real_escape_string($conexion, (strip_tags($_POST["fecha2"], ENT_QUOTES)));
    $id_ast  = intval($_POST['mod_id']);
    $sql     = "UPDATE asistencias SET celula_id='" . $id_cel . "',
                                hermanos='" . $herm . "',
                                amigos='" . $amigos . "',
                                ninos='" . $ninos . "',
                                ofrenda='" . $ofrenda . "',
                                conv='" . $conv . "',
                                recon='" . $recon . "',
                                bautismos='" . $baut . "',
                                seminarista='" . $sem . "',
                                ast_iglesia='" . $ast . "',
                                fecha_add='" . $fecha . "'
                                WHERE id_asistencia='" . $id_ast . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "La Asistencia se ha actualizada con Exito.";
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