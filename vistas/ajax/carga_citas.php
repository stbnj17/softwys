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
$sql          = mysqli_query($conexion, "select * from events where start = '$fecha_actual' and id_users='" . $session_id . "'  order by id desc");
while ($rw = mysqli_fetch_array($sql)) {
    $id_cita           = $rw['id'];
    $titulo            = $rw['title'];
    $date_added        = $rw['start'];
    list($date, $hora) = explode(" ", $date_added);
    list($Y, $m, $d)   = explode("-", $date);
    $fecha             = $d . "-" . $m . "-" . $Y;
    ?>
        <a href="javascript:void(0);" class="dropdown-item notify-item">
            <div class="notify-icon bg-info"><i class="mdi mdi-calendar"></i></div>
            <p class="notify-details"><?php echo $titulo; ?><small class="text-muted"><?php echo $fecha; ?></small></p>
        </a>

        <?php

}

?>