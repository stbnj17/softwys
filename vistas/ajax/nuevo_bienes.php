<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['nombre'])) {
    $errors[] = "Nombre vacío";
} else if (!empty($_POST['nombre'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $nombre      = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
    $descripcion = mysqli_real_escape_string($conexion, (strip_tags($_POST["descripcion"], ENT_QUOTES)));
    $serie       = mysqli_real_escape_string($conexion, (strip_tags($_POST["serie"], ENT_QUOTES)));
    $modelo      = mysqli_real_escape_string($conexion, (strip_tags($_POST["modelo"], ENT_QUOTES)));
    $color       = mysqli_real_escape_string($conexion, (strip_tags($_POST["color"], ENT_QUOTES)));
    $estado      = intval($_POST['estado']);
    $status      = intval($_POST['status']);
    $date_added  = date("Y-m-d H:i:s");
    $users       = intval($_SESSION['id_users']);
    // check if user or email address already exists
    $sql                   = "SELECT * FROM bienes WHERE serie_bienes ='" . $serie . "';";
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "El numero de serie ya está en uso.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO bienes (nombre_bienes, descripcion_bienes, serie_bienes, modelo_bienes, color_bienes, estado_bienes, status_bienes, date_added)
    VALUES ('$nombre','$descripcion','$serie','$modelo','$color','$estado','$status','$date_added')";
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Bienes y Mubles ha sido ingresado con Exito.";
        } else {
            $errors[] = "Lo siento algo ha salido mal intenta nuevamente." . mysqli_error($conexion);
        }
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