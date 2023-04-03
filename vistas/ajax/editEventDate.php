<?php

/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

if (isset($_POST['Event'][0]) && isset($_POST['Event'][1]) && isset($_POST['Event'][2])) {

    $id    = $_POST['Event'][0];
    $start = $_POST['Event'][1];
    $end   = $_POST['Event'][2];

    $sql = "UPDATE events SET  start = '$start', end = '$end' WHERE id = $id ";

    $query = $conexion2->prepare($sql);
    if ($query == false) {
        print_r($conexion2->errorInfo());
        die('Error');
    }
    $sth = $query->execute();
    if ($sth == false) {
        print_r($query->errorInfo());
        die('Error');
    } else {
        die('OK');
    }

}
header('Location: ' . $_SERVER['HTTP_REFERER']);
