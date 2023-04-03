<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
if (empty($_POST['titulo'])) {
    $errors[] = "Titulo vacío";
} else if (!empty($_POST['titulo'])) {
    /* Connect To Database*/
    require_once "../db.php";
    require_once "../php_conexion.php";
    // escaping, additionally removing everything that could be (html/javascript-) code
    $titulo      = mysqli_real_escape_string($conexion, (strip_tags($_POST["titulo"], ENT_QUOTES)));
    $fecha      = mysqli_real_escape_string($conexion, (strip_tags($_POST["fecha"], ENT_QUOTES)));
    $autor      = intval($_POST['autor']);
    $cat      = intval($_POST['cat']);
    $editorial      = intval($_POST['editorial']);
    $idioma = mysqli_real_escape_string($conexion, (strip_tags($_POST["idioma"], ENT_QUOTES)));
    $paginas      = intval($_POST['paginas']);
    $descripcion = mysqli_real_escape_string($conexion, (strip_tags($_POST["descripcion"], ENT_QUOTES)));
    $estado      = intval($_POST['estado']);
    $users       = intval($_SESSION['id_users']);
    // check if user or email address already exists
    $sql                   = "SELECT titulo FROM libros WHERE titulo ='" . $titulo . "';";
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "Titulo del libro ya está en uso.";
    } else {
        // write new user's data into database

        $sql = "INSERT INTO libros (titulo, fecha_lanzamiento, autor_id, cat_id, editorial_id, idioma, paginas, descripcion, estado)
    VALUES ('$titulo','$fecha','$autor','$cat','$editorial','$idioma','$paginas','$descripcion','$estado')";
        $query_new_insert = mysqli_query($conexion, $sql);

        if ($query_new_insert) {
            $messages[] = "Libro ha sido ingresado con Exito.";
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