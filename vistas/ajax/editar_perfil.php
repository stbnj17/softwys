<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['nombre_empresa'])) {
    $errors[] = "Nombre de empresa esta vacío";
} else if (empty($_POST['telefono'])) {
    $errors[] = "Teléfono esta vacío";
} else if (empty($_POST['email'])) {
    $errors[] = "E-mail esta vacío";
} else if (empty($_POST['impuesto'])) {
    $errors[] = "IVA esta vacío";
} else if (empty($_POST['moneda'])) {
    $errors[] = "Moneda esta vacío";
} else if (empty($_POST['direccion'])) {
    $errors[] = "Dirección esta vacío";
} else if (empty($_POST['ciudad'])) {
    $errors[] = "Dirección esta vacío";
} else if (
    !empty($_POST['nombre_empresa']) &&
    !empty($_POST['telefono']) &&
    !empty($_POST['email']) &&
    !empty($_POST['impuesto']) &&
    !empty($_POST['moneda']) &&
    !empty($_POST['direccion']) &&
    !empty($_POST['ciudad'])
) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre_empresa = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre_empresa"], ENT_QUOTES)));
    $ruc            = mysqli_real_escape_string($conexion, (strip_tags($_POST["ruc"], ENT_QUOTES)));
    $acuerdo        = mysqli_real_escape_string($conexion, (strip_tags($_POST["acuerdo"], ENT_QUOTES)));
    $telefono       = mysqli_real_escape_string($conexion, (strip_tags($_POST["telefono"], ENT_QUOTES)));
    $email          = mysqli_real_escape_string($conexion, (strip_tags($_POST["email"], ENT_QUOTES)));
    $impuesto       = mysqli_real_escape_string($conexion, (strip_tags($_POST["impuesto"], ENT_QUOTES)));
    $moneda         = mysqli_real_escape_string($conexion, (strip_tags($_POST["moneda"], ENT_QUOTES)));
    $direccion      = mysqli_real_escape_string($conexion, (strip_tags($_POST["direccion"], ENT_QUOTES)));
    $ciudad         = mysqli_real_escape_string($conexion, (strip_tags($_POST["ciudad"], ENT_QUOTES)));
    $estado         = mysqli_real_escape_string($conexion, (strip_tags($_POST["estado"], ENT_QUOTES)));
    $country        = mysqli_real_escape_string($conexion, (strip_tags($_POST["country"], ENT_QUOTES)));
    $codigo_postal  = mysqli_real_escape_string($conexion, (strip_tags($_POST["codigo_postal"], ENT_QUOTES)));
    $id_miembro     = intval($_POST['id_miembro']);

    $sql = "UPDATE perfil SET nombre_empresa='" . $nombre_empresa . "',
                                        ruc='" . $ruc . "',
                                        acuerdo='" . $acuerdo . "',
                                        telefono='" . $telefono . "',
                                        email='" . $email . "',
                                        impuesto='" . $impuesto . "',
                                        moneda='" . $moneda . "',
                                        direccion='" . $direccion . "',
                                        ciudad='" . $ciudad . "',
                                        estado='" . $estado . "',
                                        country='$country',
                                        codigo_postal='$codigo_postal',
                                        default_miembro_id='$id_miembro'
                                        WHERE id_perfil='1'";
    $query_update = mysqli_query($conexion, $sql);
    if ($query_update) {
        $messages[] = "Datos han sido actualizados satisfactoriamente.";
    } else {
        $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
    }
} else {
    $errors[] = "Error desconocido.";
}

if (isset($errors)) {

    ?>
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
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
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
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