<?php

/*-------------------------
Autor: Delmar Lopez
Web: softwys.com
Mail: softwysop@gmail.com
---------------------------*/
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
$session_id = $_SESSION['id_users'];
//Inicia Control de Permisos
include "../permisos.php";
get_cadena($session_id);
$modulo = "Eventos";
permisos($modulo, $cadena_permisos);
//Finaliza Control de Permisos
$fecha_actual = date('Y-m-d');
$orderSql     = "SELECT * FROM events where date(start) = '$fecha_actual' and id_users='" . $session_id . "' ";
$orderQuery   = $conexion->query($orderSql);
$countCitas   = $orderQuery->num_rows;

echo '' . $countCitas . '';
