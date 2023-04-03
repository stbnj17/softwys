<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/*Inicia validacion del lado del servidor*/
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos

if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])) {

    $title = $_POST['title'];
    $start = $_POST['start'];
    $end   = $_POST['end'];
    $color = $_POST['color'];
    $users = intval($_SESSION['id_users']);

    $sql = "INSERT INTO seminarios (title, start, end, color, id_users) values ('$title', '$start', '$end', '$color','$users')";
    //header('Location: ../html/eventos.php');
    echo $sql;

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
header('Location: ' . $_SERVER['HTTP_REFERER']);
