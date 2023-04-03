<style type="text/css">
  <!--
  table { vertical-align: top; }
  tr    { vertical-align: top; }
  td    { vertical-align: top; }
  th    { vertical-align: top; }
  .midnight-blue{
    background:#2c3e50;
    padding: 4px 4px 4px;
    color:white;
    font-weight:bold;
    font-size:13px;
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
<page pageset='new' backtop='10mm' backbottom='10mm' backleft='20mm' backright='20mm' footer='page'>
  <?php include "encabezado_general.php";?><br><br>
  <!--  Generalizada -->
  <?php
$tySql  = "SELECT * FROM ingresos, miembros, users WHERE ingresos.ref_ingreso = miembros.id_miembro and ingresos.users= users.id_users and ingresos.id_ingreso ='$id_abono'";
$tyData = $conexion->query($tySql);

while ($tyResult = $tyData->fetch_array()) {
    $id_ingreso   = $tyResult['id_ingreso'];
    $abono        = $tyResult['monto'];
    $nombre_users = $tyResult['nombre_users'] . ' ' . $tyResult['apellido_users'];
    $date_added   = date('d/m/Y', strtotime($tyResult['fecha_added']));
    $concepto     = 'PAGO DE DIEZMO';
    // datos del Cliente
    $nombre_cliente    = $tyResult['nombre_miembro'];
    $direccion_cliente = $tyResult['direccion_miembro'];
    $telefono_cliente  = $tyResult['telefono_miembro'];
    $email_cliente     = $tyResult['email_miembro'];
    // calculos
    $impuesto       = get_row('perfil', 'impuesto', 'id_perfil', 1);
    $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
}
?>
  <table cellpadding='4' cellspacing='0' border='0'>
    <tr>
      <td style="width:50%;" class='midnight-blue'>MIEMBRO</td>
    </tr>
    <tr>
      <td style="width:50%;" >
        <?php
echo "<b>Nombre:</b>";
echo $nombre_cliente;
echo "<br> <b>Dirección:</b>";
echo $direccion_cliente;
echo "<br> <b>Teléfono: </b>";
echo $telefono_cliente;
echo "<br> <b>Email:</b> ";
echo $email_cliente;
?>
      </td>
    </tr>
  </table><br><br><br><br>
  <table cellpadding='4' cellspacing='0' border='0'>
    <tr>
      <th style="width: 20%" class='midnight-blue'>ID</th>
      <th style="width: 35%" class='midnight-blue'>Concepto</th>
      <th style="width: 20%" class='midnight-blue'>Fecha</th>
      <th style="width: 15%;text-align: right" class='midnight-blue'>Valor Unit.</th>
    </tr>

    <tr>
      <td style="height:3%;text-align: center;"><?php echo $id_ingreso; ?></td>
      <td style="height:3%;text-align: left"><?php echo $concepto; ?></td>
      <td style="height:3%;text-align: left"><?php echo $date_added; ?></td>
      <td style="height:3%;text-align: right"><?php echo $simbolo_moneda . '' . $abono; ?></td>
    </tr>

    <tr>
      <td colspan="3" style="text-align: right;">SUBTOTAL <?php echo $simbolo_moneda; ?> </td>
      <td style="text-align: right;"> <?php echo number_format($abono, 2); ?></td>
    </tr>

    <tr>
      <td colspan="3" style="text-align: right;">IVA (<?php echo $impuesto; ?>)% <?php echo $simbolo_moneda; ?> </td>
      <td style="text-align: right;">0.0</td>
    </tr>

    <tr>
      <td colspan="3" style="text-align: right;">TOTAL <?php echo $simbolo_moneda; ?> </td>
      <td style="text-align: right;"> <?php echo number_format($abono, 2); ?></td>
    </tr>
  </table>
<br><br>


<br><br>
<div style='width:45%;font-size: 12pt; border-bottom: 1px solid #2c3e50;padding-bottom:10px'>F:</div>
<div style='width:45%;font-size: 12pt; border-bottom: 0px solid #2c3e50;padding-bottom:10px'><?php echo $nombre_users; ?></div>



</page>

