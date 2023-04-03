<?php
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

if (isset($_POST['delete']) && isset($_POST['id'])) {

    $id = $_POST['id'];

    $sql   = "DELETE FROM seminarios WHERE id = $id";
    $query = $conexion2->prepare($sql);
    if ($query == false) {
        print_r($conexion2->errorInfo());
        die('Erreur prepare');
    }
    $res = $query->execute();
    if ($res == false) {
        print_r($query->errorInfo());
        die('Erreur execute');
    }
} elseif (isset($_POST['title']) && isset($_POST['color']) && isset($_POST['id'])) {

    $id    = $_POST['id'];
    $title = $_POST['title'];
    $color = $_POST['color'];

    $sql = "UPDATE seminarios SET  title = '$title', color = '$color' WHERE id = $id ";

    $query = $conexion2->prepare($sql);
    if ($query == false) {
        print_r($conexion2->errorInfo());
        die('Erreur prepare');
    }
    $sth = $query->execute();
    if ($sth == false) {
        print_r($query->errorInfo());
        die('Erreur execute');
    }
}
header('Location: ../html/seminarios.php');
