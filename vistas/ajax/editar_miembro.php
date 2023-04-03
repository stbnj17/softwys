<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['mod_id'])) {
    $errors[] = "ID vacío";
} else if (empty($_POST['mod_nombre'])) {
    $errors[] = "Nombre vacío";
} else if ($_POST['mod_sexo'] == "") {
    $errors[] = "Selecciona el sexo del Miembro";
} else if ($_POST['mod_estado'] == "") {
    $errors[] = "Selecciona el estado del Miembro";
} else if (
    !empty($_POST['mod_id']) &&
    !empty($_POST['mod_nombre']) &&
    $_POST['mod_sexo'] != "" &&
    $_POST['mod_estado'] != ""
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre     = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_nombre"], ENT_QUOTES)));
    $apellido   = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_apellido"], ENT_QUOTES)));
    $direccion  = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_direccion"], ENT_QUOTES)));
    $ciudad     = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_ciudad"], ENT_QUOTES)));
    $celular    = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_celular"], ENT_QUOTES)));
    $telefono   = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_telefono"], ENT_QUOTES)));
    $nacimiento = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_nacimiento"], ENT_QUOTES)));
    $estudio    = intval($_POST['mod_estudio']);
    $cargo      = intval($_POST['mod_cargo']);
    $civil      = intval($_POST['mod_civil']);
    $documento  = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_documento"], ENT_QUOTES)));
    $email      = mysqli_real_escape_string($conexion, (strip_tags($_POST["mod_email"], ENT_QUOTES)));
    $sexo       = intval($_POST['mod_sexo']);
    $estado     = intval($_POST['mod_estado']);
    $family     = intval($_POST['mod_family']);
    $id_miembro = intval($_POST['mod_id']);

    $sql = "UPDATE miembros SET nombre_miembro='" . $nombre . "',
                                        apellido_miembro='" . $apellido . "',
                                        direccion_miembro='" . $direccion . "',
                                        ciudad_miembro='" . $ciudad . "',
                                        celular_miembro='" . $celular . "',
                                        telefono_miembro='" . $telefono . "',
                                        fecha_nacimiento='" . $nacimiento . "',
                                        estudio_miembro='" . $estudio . "',
                                        cargo_miembro='" . $cargo . "',
                                        civil_miembro='" . $civil . "',
                                        documento_miembro='" . $documento . "',
                                        email_miembro='" . $email . "',
                                        sexo_miembro='" . $sexo . "',
                                        estado_miembro='" . $estado . "',
                                        familia_id='" . $family . "'
                                        WHERE id_miembro='" . $id_miembro . "'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Miembro ha sido actualizado con Exito.";
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