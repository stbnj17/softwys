<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['modd_id'])) {
    $errors[] = "ID vacío";
} else if (
    !empty($_POST['modd_id'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $alergia    = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_alegia"], ENT_QUOTES)));
    $enfermedad = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_enfermedad"], ENT_QUOTES)));
    $vacuna     = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_vacuna"], ENT_QUOTES)));
    $quir       = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_quir"], ENT_QUOTES)));

    $id_paciente = intval($_POST['modd_id']);

    $sql = "UPDATE antecedentes SET alergias_ant='" . $alergia . "',
    enfermedades_ant='" . $enfermedad . "',
    vacunas_ant='" . $vacuna . "',
    quirurgico_ant='" . $quir . "'
    WHERE id_paciente='" . $id_paciente . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Antecedente ha sido actualizado con Exito.";
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