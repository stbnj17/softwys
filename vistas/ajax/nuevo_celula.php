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
    $nombre     = mysqli_real_escape_string($conexion, (strip_tags($_POST["nombre"], ENT_QUOTES)));
    $sector     = mysqli_real_escape_string($conexion, (strip_tags($_POST["sector"], ENT_QUOTES)));
    $supervisor = intval($_POST['id_miembro1']);
    $lider      = intval($_POST['id_miembro2']);
    $anfitrion  = mysqli_real_escape_string($conexion, (strip_tags($_POST["anfi"], ENT_QUOTES)));
    $grupo     = intval($_POST['grupo']);
    $estado     = intval($_POST['estado']);
    $date_added = date("Y-m-d H:i:s");
    $users      = intval($_SESSION['id_users']);
    // check if user or email address already exists
    $sql                   = "SELECT * FROM celulas WHERE nombre_cel ='" . $nombre . "';";
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "Nombre de la Célula Familar ya está en uso.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO celulas (nombre_cel, sector_cel, supervisor_cel, lider_cel, anfitrion_cel, grupo_cel, estado_cel, fecha_added)
                             VALUES ('$nombre','$sector','$supervisor','$lider', '$anfitrion', '$grupo','$estado', '$date_added')";
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Célula Familiar ha sido ingresado con Exito.";
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