<?php
/*-----------------------
Autor: Delmar Ramon Lopez
http://www.softwys.com
Fecha: 24-01-2018
Version de PHP: 5.6.3
----------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
//Inicia Control de Permisos
include "../permisos.php";
$user_id = $_SESSION['id_users'];
get_cadena($user_id);
$modulo = "Tesorerias";
permisos($modulo, $cadena_permisos);
/*Inicia validacion del lado del servidor*/
if (empty($_POST['id_ingreso'])) {
    $errors[] = "ID vacío";
} else if (
    !empty($_POST['id_ingreso'])

) {
    $id_ingreso = intval($_POST['id_ingreso']);
    if ($delete1 = mysqli_query($conexion, "DELETE FROM ingresos WHERE id_ingreso='" . $id_ingreso . "'")) {
        ?>
            <div class="alert alert-success alert-dismissible" role="alert">
              <strong>Aviso!</strong> Datos eliminados exitosamente.
          </div>
          <?php
} else {
        ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
      </div>
      <?php

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

?>