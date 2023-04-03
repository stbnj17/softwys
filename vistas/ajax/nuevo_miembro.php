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
    $apellido   = mysqli_real_escape_string($conexion, (strip_tags($_POST["apellido"], ENT_QUOTES)));
    $direccion  = mysqli_real_escape_string($conexion, (strip_tags($_POST["direccion"], ENT_QUOTES)));
    $ciudad     = mysqli_real_escape_string($conexion, (strip_tags($_POST["ciudad"], ENT_QUOTES)));
    $celular    = mysqli_real_escape_string($conexion, (strip_tags($_POST["celular"], ENT_QUOTES)));
    $telefono   = mysqli_real_escape_string($conexion, (strip_tags($_POST["telefono"], ENT_QUOTES)));
    $nacimiento = mysqli_real_escape_string($conexion, (strip_tags($_POST["nacimiento"], ENT_QUOTES)));
    $estudio    = intval($_POST['estudio']);
    $cargo      = intval($_POST['cargo']);
    $civil      = intval($_POST['civil']);
    $documento  = mysqli_real_escape_string($conexion, (strip_tags($_POST["documento"], ENT_QUOTES)));
    $email      = mysqli_real_escape_string($conexion, (strip_tags($_POST["email"], ENT_QUOTES)));
    $sexo       = intval($_POST['sexo']);
    $estado     = intval($_POST['estado']);
    $family     = intval($_POST['family']);
    $date_added = date("Y-m-d H:i:s");

    // check if user or email address already exists
    $sql                   = "SELECT * FROM miembros WHERE documento_miembro ='" . $documento . "';";
    $query_check_user_name = mysqli_query($conexion, $sql);
    $query_check_user      = mysqli_num_rows($query_check_user_name);
    if ($query_check_user == true) {
        $errors[] = "Lo sentimos , el documento ya está en uso.";
    } else {
        // write new user's data into database
        $sql = "INSERT INTO miembros (nombre_miembro, apellido_miembro, direccion_miembro, ciudad_miembro, celular_miembro, telefono_miembro, fecha_nacimiento, estudio_miembro, cargo_miembro, civil_miembro, documento_miembro, email_miembro, sexo_miembro, estado_miembro, date_addedd, familia_id)
    VALUES ('$nombre','$apellido','$direccion','$ciudad','$celular','$telefono','$nacimiento','$estudio','$cargo','$civil','$documento','$email','$sexo','$estado','$date_added','$family')";
        #$query_new_insert = mysqli_query($conexion, $sql);
        $paciente_id = '';
        if ($conexion->query($sql) === true) {
            $paciente_id          = $conexion->insert_id;
            $valid['id_consulta'] = $paciente_id;
        }

        $sql2          = "INSERT INTO antecedentes (id_paciente) VALUES ('$paciente_id')";
        $query_new_ant = mysqli_query($conexion, $sql2);

        if ($paciente_id) {
            $messages[] = "Miembro ha sido ingresado con Exito.";
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