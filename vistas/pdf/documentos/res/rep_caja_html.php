<page pageset='new' backtop='10mm' backbottom='10mm' backleft='20mm' backright='20mm' footer='page'>
<?php include "encabezado.php";?><br>
  <div style='border-bottom: 3px solid #2874A6;padding-bottom:10px'>
    USUARIO:
    <?php
$sql1     = mysqli_query($conexion, "select nombre_users, apellido_users  from users where id_users='" . $employee_id . "'");
$rw1      = mysqli_fetch_array($sql1);
$fullname = $rw1['nombre_users'] . ' ' . $rw1['apellido_users'];
if (empty($fullname)) {
    echo "Todos";
} else {
    echo $fullname;
}
$finales = 0;

$totalOfrenda   = 0;
$totalDiezmo    = 0;
$totalIngreso   = 0;
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
while ($row = mysqli_fetch_array($query)) {
    if ($row['cod_ingreso'] == 1) {
        $totalOfrenda += $row['monto'];
    } elseif ($row['cod_ingreso'] == 2) {
        $totalDiezmo += $row['monto'];
    }
    $totalIngreso += $row['monto'];
    ?>
    <?php }

//otra consulta para sumar las ofrendas de las celulas
$sql       = mysqli_query($conexion, "select  SUM(ofrenda) as total_ast from asistencias WHERE fecha_add between '$fecha_inicial' and '$fecha_final'");
$rw        = mysqli_fetch_array($sql);
$total_ast = $rw['total_ast'];
?>
  </div>

  <table  cellspacing="0" style="width: 100%;font-size: 12pt;">
            <tr  style="background-color: #7DCEA0;">
              <td style="width:100%; text-align: center;" colspan="2">INGRESOS</td>
            </tr>
            <tr>
             <td style="width:50%;text-align: left;">OFRENDAS:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalOfrenda, 2); ?></td>
           </tr>
           <tr>
             <td style="width:50%;text-align: left;">DIEZMOS:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalDiezmo, 2); ?></td>
           </tr>
           <tr>
             <td style="width:50%;text-align: left;">CÉLULAS  FAMILIARES:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($total_ast, 2); ?></td>
           </tr>
           <tr>
             <td style="width:50%;text-align: right;font-weight:bold;">TOTAL INGRESOS:</td>
             <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalIngreso + $total_ast, 2); ?></td>
           </tr>
         </table>
         <?php
$totalEntrada   = 0;
$totalSalida    = 0;
$total_efectivo = 0;
$totalEngreso   = 0;
if ($employee_id > 0) {
    $caja = mysqli_query($conexion, "select * from egresos where users='" . $employee_id . "' and fecha_added between '$fecha_inicial' and '$fecha_final'");
} else {
    $caja = mysqli_query($conexion, "select * from egresos where fecha_added between '$fecha_inicial' and '$fecha_final'");
}
while ($rw = mysqli_fetch_array($caja)) {
    $totalSalida += $rw['monto'];
    $totalEngreso += $row['monto'];
    $total_efectivo = $totalIngreso - $totalSalida;
}
?>
        <table class="table table-bordered" cellspacing="0" style="width: 100%;font-size: 12pt;">
        <tr class="success" style="background-color: #D98880;">
         <td style="width:100%; text-align: center;" colspan="2">EGRESOS</td>
       </tr>

       <tr>
         <td style="width:50%;text-align: left;">TOTAL GASTOS:</td>
         <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalSalida, 2); ?></td>
       </tr>
       <tr>
         <td style="width:50%;text-align: right;font-weight:bold;">TOTAL EGRESOS:</td>
         <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format($totalSalida, 2); ?></td>
       </tr>
       <tr>
         <td style="width:50%;text-align: right;font-weight:bold;">TOTAL:</td>
         <td style="width:50%; text-align: left;"><?php echo $simbolo_moneda . '' . number_format(($totalIngreso + $total_ast) - $totalSalida, 2); ?></td>
       </tr>
     </table>
  <div style='border-bottom: 3px solid #2874A6;padding-bottom:10px'></div>
</page>

