<?php
//include our function
include 'function.php';

if (isset($_POST['backup'])) {
    //get credentails via post
    $server   = $_POST['server'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dbname   = $_POST['dbname'];

    //backup and dl using our function
    $backup = backDb($server, $username, $password, $dbname);

    if ($backup['error']) {
        $_SESSION['error'] = $backup['message'];
    } else {
        $_SESSION['success'] = $backup['message'];
    }

    exit();

} else {
    //echo 'Rellena las credenciales de la base de datos';
    $_SESSION['error'] = 'Rellena las credenciales de la base de datos';
}
header('location:../backup.php');
