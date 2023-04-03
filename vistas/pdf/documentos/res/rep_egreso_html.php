<style type="text/css">
  .formato {
   text-align: left;
   vertical-align: top;
   border: 0.3px solid #000;
   border-collapse: collapse;
   padding: 1px;
 }
 .tabla{
  width:100%;
  border-radius: 12px 12px 12px 12px;
  -moz-border-radius: 12px 12px 12px 12px;
  -webkit-border-radius: 12px 12px 12px 12px;
  border: 2px solid #000000;
}
.cabeza-blue{
  background:#85C1E9;
  padding: 4px 4px 4px;
  color:black;
  font-weight:bold;
  font-size:12px;
}
.midnight-blue{
  background:#2c3e50;
  padding: 4px 4px 4px;
  color:white;
  font-weight:bold;
  font-size:12px;
}
.silver{
  background:white;
  padding: 3px 4px 3px;
}
.clouds{
  background:#ecf0f1;
  padding: 3px 4px 3px;
}
.border-top{
  border-top: solid 1px #bdc3c7;

}
.border-left{
  border-left: solid 1px #bdc3c7;
}
.border-right{
  border-right: solid 1px #bdc3c7;
}
.border-bottom{
  border-bottom: solid 1px #bdc3c7;
}

}
</style>
<page pageset='new' backtop='10mm' backbottom='10mm' backleft='15mm' backright='15mm' style="font-size: 14px; font-family: helvetica">
  <page_header>
  <table style="width: 100%; border: solid 0px black;" cellspacing=0>
    <tr>
      <td style="text-align: left;    width: 33%"></td>
      <td style="text-align: center;    width: 34%;font-size: 14px; font-weight: bold">Reporte de Egresos</td>
      <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
    </tr>
  </table>
  </page_header>
<?php include "encabezado.php";?><br>
<br>
  <table cellpadding='4' cellspacing='0' border='0'>
    <tr>
      <?php
$sql1     = mysqli_query($conexion, "select nombre_users from users where id_users='" . $employee_id . "'");
$rw1      = mysqli_fetch_array($sql1);
$fullname = $rw1['nombre_users'];
if (empty($fullname)) {
    $nombre = "Todos";
} else {
    $nombre = $fullname;
}
?>
      <td style="width:100%;" class='midnight-blue' align="center">Usuario: <?php echo $nombre; ?>

    </td>
  </tr>
</table>
<br>
  <table  cellspacing="0" style="width: 100%; text-align: left; font-size: 10px; border: 0px solid #000000;">
    <tr class='midnight-blue'>
      <th class="formato" style="width:15%;">Referencia </th>
      <th class="formato" style="width:25%;">Tipo de Pago</th>
      <th class="formato" style="width:25%;">Fecha y Hora</th>
      <th class="formato" style="width:15%;">Monto</th>
      <th class="formato" style="width:20%;">Usuario</th>
    </tr>
    <?php
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$sumador_total  = 0;
//consulta de la anterior que manda la pagina anteior
while ($row = mysqli_fetch_array($query)) {
    $referencia = $row['referencia_egreso'];
    $tipo_pago  = $row['tipo_egreso'];
    $id_users   = $row['users'];
    //otra consulta para el nombre del paciente
    $sql          = mysqli_query($conexion, "select nombre_users, apellido_users from users where id_users='" . $id_users . "'");
    $rw           = mysqli_fetch_array($sql);
    $nombre_users = $rw['nombre_users'] . ' ' . $rw['apellido_users'];
    $nombre_gasto = get_row('tipo_gasto', 'nombre_tipo', 'id_tipo', $tipo_pago);
    // fin consulta
    $date_added = $row['fecha_added'];
    $total      = $row['monto'];
    $sumador_total += $total;
    ?>
      <tr>
        <td class="formato"><?php echo $referencia; ?></td>
        <td class="formato"><?php echo $nombre_gasto; ?></td>
        <td class="formato"><?php echo $date_added; ?></td>
        <td class="formato"><?php echo $simbolo_moneda . '' . number_format($total, 2) ?></td>
        <td class="formato"><?php echo $nombre_users; ?></td>
      </tr>
      <?php
}

?>
  </table>
  <br>
  <table cellspacing="0" style="width: 100%; font-size: 12pt; border: 1px solid #000000;">
    <tr>
      <td style="width: 70%; text-align: right;"><b>Total <?php echo $simbolo_moneda; ?></b></td>
      <td style="width: 30%; text-align: left;"><b><?php echo number_format($sumador_total, 2); ?></b></td>
    </tr>
  </table>
</page>

