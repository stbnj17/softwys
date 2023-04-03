<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['cat2'])) {
    $errors[] = "Nombre vacío";
} else if (!empty($_POST['cat2'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $cat      = mysqli_real_escape_string($conexion, (strip_tags($_POST["cat2"], ENT_QUOTES)));
    // check if user or email address already exists
    $sql                   = "SELECT * FROM cat_libro WHERE categoria ='" . $cat . "';";
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "Nombre de Categoria ya está en uso.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO cat_libro (categoria)
    VALUES ('$cat')";
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Categoria ha sido ingresada con Exito.";
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