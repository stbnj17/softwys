<?php
function get_row($table, $row, $id, $equal)
{
    global $conexion;
    $query = mysqli_query($conexion, "select $row from $table where $id='$equal'");
    $rw    = mysqli_fetch_array($query);
    $value = $rw[$row];
    return $value;
}
function monto($table, $mes, $periodo)
{
    global $conexion;
    $fecha_inicial = "$periodo-$mes-1";
    if ($mes == 1 or $mes == 3 or $mes == 5 or $mes == 7 or $mes == 8 or $mes == 10 or $mes == 12) {
        $dia_fin = 31;
    } else if ($mes == 2) {
        if ($periodo % 4 == 0) {
            $dia_fin = 29;
        } else {
            $dia_fin = 28;
        }
    } else {
        $dia_fin = 30;
    }
    $fecha_final = "$periodo-$mes-$dia_fin";

    $query = mysqli_query($conexion, "select sum(monto) as monto from $table where fecha_added between '$fecha_inicial' and '$fecha_final'");
    $row   = mysqli_fetch_array($query);
    $monto = floatval($row['monto']);
    return $monto;
}
/*--------------------------------------------------------------*/
/* Funcion para obtener las Ultimas Consultas
/*--------------------------------------------------------------*/
function ver_citas_hoy()
{
    $fecha_actual = date('Y-m-d');
    global $conexion;
    $sql = mysqli_query($conexion, "select * from miembros  order by  id_miembro desc");
    while ($rw = mysqli_fetch_array($sql)) {
        $id_cita         = $rw['id'];
        $nombre_paciente = $rw['nombre_miembro'];
        ?>
        <tr>
            <td class="text-center"><a href="#" data-toggle="tooltip" title="Ver Consulta"><span class="badge badge-pill badge-info"><?php echo $id_miembro; ?></span></a></td>
            <td><?php echo $nombre_paciente; ?></td>
        </tr>
        <?php

    }
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Pacientes
/*--------------------------------------------------------------*/
function total_miembros()
{
    global $conexion;
    $orderSql       = "SELECT * FROM miembros";
    $orderQuery     = $conexion->query($orderSql);
    $countPacientes = $orderQuery->num_rows;

    echo '' . $countPacientes . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener las citas del dia
/*--------------------------------------------------------------*/
function citas_hoy()
{
    $fecha_actual = date('Y-m-d');
    global $conexion;
    $orderSql   = "SELECT * FROM events where date(start) = '$fecha_actual'";
    $orderQuery = $conexion->query($orderSql);
    $countCitas = $orderQuery->num_rows;

    echo '' . $countCitas . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Ingresos
/*--------------------------------------------------------------*/
function total_ingresos()
{
    $id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_actual = date('Y-m-d');
    global $conexion;
    $orderSql   = "SELECT * FROM ingresos where date(fecha_added) = '$fecha_actual'";
    $orderQuery = $conexion->query($orderSql);

    $totalRevenue = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalRevenue += $orderResult['monto'];
    }

    //otra consulta para sumar las ofrendas de las celulas
    $sql       = mysqli_query($conexion, "select  SUM(ofrenda) as total_ast from asistencias where fecha_add='" . $fecha_actual . "'");
    $rw        = mysqli_fetch_array($sql);
    $total_ast = $rw['total_ast'];

    echo '' . $id_moneda . '' . number_format($totalRevenue + $total_ast, 2) . '';
}
/*--------------------------------------------------------------*/
/* Funcion para obtener el total de Egresos
/*--------------------------------------------------------------*/
function total_egresos()
{
    $id_moneda    = get_row('perfil', 'moneda', 'id_perfil', 1);
    $fecha_actual = date('Y-m-d');
    global $conexion;
    $orderSql   = "SELECT * FROM egresos where date(fecha_added) = '$fecha_actual'";
    $orderQuery = $conexion->query($orderSql);

    $totalEgreso = 0;
    while ($orderResult = $orderQuery->fetch_assoc()) {
        $totalEgreso += $orderResult['monto'];
    }

    echo '' . $id_moneda . '' . number_format($totalEgreso, 2) . '';
}

function pago($pago)
{
    if ($pago == 1) {
        return '<span class="badge badge-success">EFECTIVO</span>';
    } else if ($pago == 2) {
        return '<span class="badge badge-info">CHEQUE</span>';
    } else {
        return '<span class="badge badge-primary">TRANF BANCARIA</span>';
    }
}
function pago2($pago)
{
    if ($pago == 1) {
        return 'EFECTIVO';
    } else if ($pago == 2) {
        return 'CHEQUE';
    } else {
        return 'TRANF BANCARIA';
    }
}
function tippo($pago)
{
    if ($pago == 1) {
        return "<span class='badge badge-primary'>OFRENDA</span>";
    } else if ($pago == 2) {
        return "<span class='badge badge-danger'>DIEZMO</span>";
    }
}
function cod_ingreso($pago)
{
    if ($pago == 1) {
        return "OFRENDA";
    } else if ($pago == 2) {
        return "DIEZMO";
    }
}
function tipo_excel($pago)
{
    if ($pago == 1) {
        return "DIEZMO";
    } else if ($pago == 2) {
        return "OFRENDA";
    } else if ($pago == 3) {
        return "PRO TEMPLO";
    } else {
        return 'BENEVOLENCIA';
    }
}
/*--------------------------------------------------------------*/
/* Funcion para obtener las Ultimos ingresos
/*--------------------------------------------------------------*/
function latest_ingreso()
{
    $id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
    global $conexion;
    $sql = mysqli_query($conexion, "select * from ingresos where id_ingreso >0 order by  id_ingreso desc limit 0,3");
    while ($rw = mysqli_fetch_array($sql)) {
        $tipo  = $rw['cod_ingreso'];
        $monto = $rw['monto'];
        ?>
        <tr>
            <td><?php echo cod_ingreso($tipo); ?></td>
            <td><?php echo $id_moneda . '' . number_format($monto, 2); ?></td>
            <td><?php echo date("d/m/Y", strtotime($rw['fecha_added'])); ?></td>
        </tr>
        <?php

    }
}
/*--------------------------------------------------------------*/
/* Funcion para obtener las Ultimos Gastos
/*--------------------------------------------------------------*/
function latest_egreso()
{
    $id_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
    global $conexion;
    $sql = mysqli_query($conexion, "select * from egresos where id_egreso >0 order by  id_egreso desc limit 0,3");
    while ($rw = mysqli_fetch_array($sql)) {
        $ref   = $rw['referencia_egreso'];
        $monto = $rw['monto'];
        ?>
        <tr>
            <td><span class='badge badge-info'><?php echo $ref; ?></span></td>
            <td><?php echo $id_moneda . '' . number_format($monto, 2); ?></td>
            <td><?php echo date("d/m/Y", strtotime($rw['fecha_added'])); ?></td>
        </tr>
        <?php

    }
}
/*--------------------------------------------------------------*/
/* Formato de Fechas
/*--------------------------------------------------------------*/
function fecha($fecha)
{
    $meses = array("ENE", "FEB", "MAR", "ABR", "MAY", "JUN", "JUL", "AGO", "SEP", "OCT", "NOV", "DIC");
    $a     = substr($fecha, 0, 4);
    $m     = substr($fecha, 5, 2);
    $d     = substr($fecha, 8);
    return $d . " / " . $meses[$m - 1] . " / " . $a;
}
function mes($mes)
{
    if ($mes == 1) {
        return 'ENERO';
    } elseif ($mes == 2) {
        return 'FEBRERO';
    } elseif ($mes == 3) {
        return 'MARZO';
    } elseif ($mes == 4) {
        return 'ABRIL';
    } elseif ($mes == 5) {
        return 'MAYO';
    } elseif ($mes == 6) {
        return 'JUNIO';
    } elseif ($mes == 7) {
        return 'JULIO';
    } elseif ($mes == 8) {
        return 'AGOSTO';
    } elseif ($mes == 9) {
        return 'SEPTIEMBRE';
    } elseif ($mes == 10) {
        return 'OCTUBRE';
    } elseif ($mes == 11) {
        return 'NOVIEMBRE';
    } elseif ($mes == 12) {
        return 'DICIEMBRE';
    }
}
