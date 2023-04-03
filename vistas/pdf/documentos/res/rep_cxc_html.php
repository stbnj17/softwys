  <style type="text/css">
    <!--
    table { vertical-align: top; }
    tr    { vertical-align: top; }
    td    { vertical-align: top; }
    .midnight-blue{
      background:#2c3e50;
      padding: 4px 4px 4px;
      color:white;
      font-weight:bold;
      font-size:14px;
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
    table.page_footer {width: 100%; border: none; background-color: white; padding: 2mm;border-collapse:collapse; border: none;}
  }
-->
</style>
<page pageset='new' backtop='10mm' backbottom='10mm' backleft='20mm' backright='20mm' style="font-size: 14px; font-family: helvetica">
  <page_header>
  <table style="width: 100%; border: solid 0px black;" cellspacing=0>
    <tr>
      <td style="text-align: left;    width: 33%"></td>
      <td style="text-align: center;    width: 34%;font-size: 14px; font-weight: bold">Reporte de Diezmos</td>
      <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
    </tr>
  </table>
  </page_header>
  <?php include "encabezado.php";?>
  <br>
  <table style="width: 100%; border: solid 0px black;">
    <tr>
      <?php
$sql_hist = mysqli_query($conexion, "select * from ingresos, miembros where ingresos.ref_ingreso='$id_miembro' and ingresos.ref_ingreso=miembros.id_miembro");
$rw       = mysqli_fetch_array($sql_hist);
?>
      <td style="font-size: 18px; font-weight: bold;text-align: center;width: 100%">MIEMBRO: <?php echo $rw['apellido_miembro'] . ' ' . $rw['nombre_miembro']; ?></td>
    </tr>
  </table>
  <br>
  <br>
  <table class="table-bordered" style="width:100%;">
    <tr class="midnight-blue">
     <th style="width:10%;text-align:center">ID</th>
     <th style="width:15%;text-align:center">Fecha</th>
     <th style="width:20%;text-align:center">Modo de Pago</th>
     <th style="width:20%;text-align:center">Monto</th>
     <th style="width:35%;text-align:center">Observación</th>
   </tr>
   <?php
$sumador_total = 0;
while ($row = mysqli_fetch_array($query)) {
    $total = $row['monto'];
    $sumador_total += $total;
    ?>
    <tr>
      <td><?php echo $row['id_ingreso']; ?></td>
      <td><?php echo date("d/m/Y", strtotime($row['fecha_added'])); ?></td>
      <td><?php echo pago($row['pago_ingreso']); ?></td>
      <td><?php echo $simbolo_moneda . '' . number_format($row['monto'], 2); ?></td>
      <td><?php echo $row['obs_ingreso']; ?></td>
    </tr>
    <?php }?>
    <tr>
    <td style='text-align:right;border-top:3px solid #2874A6;padding:4px;padding-top:4px;font-size:14px' colspan="4"><?php echo $simbolo_moneda . '' . number_format($sumador_total, 2) ?></td>
    </tr>
  </table>
<br><br>
<br><br>
  <page_footer>
  <table style="width: 100%; border: solid 0px black;">
    <tr>
      <td style="text-align: left;    width: 50%"></td>
      <td style="text-align: right;    width: 50%">page [[page_cu]]/[[page_nb]]</td>
    </tr>
  </table>
  </page_footer>
</page>