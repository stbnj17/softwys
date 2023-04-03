<style type="text/css">
    /*table {
   width: 100%;
   border: 1px solid #999;
   text-align: left;
   border-collapse: collapse;
   margin: 0 0 1em 0;
   caption-side: top;
}
caption, td, th {
   padding: 0.3em;
}
th, td {
   border-bottom: 1px solid #999;
   width: 25%;
}
caption {
   font-weight: bold;
   font-style: italic;
   }*/
   /* .td{
       border-bottom: 1px solid #999;
   width: 25%;
    }
    .td {

   text-align: left;
   vertical-align: top;
   border: 1px solid #000;
   border-collapse: collapse;
    }
    .td {
      border-color:#666666; border-style:dashed; border-width:2px;
      }*/
      .formato {
       text-align: left;
       vertical-align: top;
       border: 0.3px solid #000;
       border-collapse: collapse;
       padding: 5px;
     }
     .tabla{
      width:100%;
      border-radius: 12px 12px 12px 12px;
      -moz-border-radius: 12px 12px 12px 12px;
      -webkit-border-radius: 12px 12px 12px 12px;
      border: 2px solid #000000;
    }
    .cabeza-blue{
      background:#E6E6E6;
      padding: 4px 4px 4px;
      color:black;
      font-weight:bold;
      font-size:14px;
      text-align: center;
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
    .prueba{
      width: 300px;
      margin: 10px auto;
      padding: 5px;
      font: normal 13px arial, helvetica, sans-serif;
      white-space: normal;
    }
  }
</style>
<page pageset='new' backtop='10mm' backbottom='10mm' backleft='20mm' backright='20mm' footer='page'>
   <?php require_once "../../funciones.php";?>
   <?php require_once "../../convertidor.php";?>
<?php include "encabezado_general.php";?><br>
  <!-- consulta Generalizada -->
<?php
$tySql  = "SELECT * FROM ingresos, miembros, users WHERE ingresos.miembro_id = miembros.id_miembro and ingresos.users= users.id_users and ingresos.id_ingreso ='$id_ingreso'";
$tyData = $conexion->query($tySql);

while ($tyResult = $tyData->fetch_array()) {
    $id_ingreso   = $tyResult['id_ingreso'];
    $ref_ingreso  = $tyResult['ref_ingreso'];
    $monto        = $tyResult['monto'];
    $nombre_users = $tyResult['nombre_users'] . ' ' . $tyResult['apellido_users'];
    $date_added   = $tyResult['fecha_added'];
    $cod_ingreso  = $tyResult['cod_ingreso'];
    // datos del Miembro
    $fullname   = $tyResult['nombre_miembro'] . ' ' . $tyResult['apellido_miembro'];
    $direccion  = $tyResult['direccion_miembro'];
    $telefono   = $tyResult['telefono_miembro'];
    $email      = $tyResult['email_miembro'];
    $cumpleanos = new DateTime($tyResult['fecha_nacimiento']);
    $hoy        = new DateTime();
    $annos      = $hoy->diff($cumpleanos);
    $edad       = $annos->y;
    #$total      = $row['monto'];
    #$sumador_total += $total;

    // calculos
    $impuesto       = get_row('perfil', 'impuesto', 'id_perfil', 1);
    $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
    if ($cod_ingreso == 1) {
        $tip = "OFRENDA";
    } else {
        $tip = "DIEZMO";
    }
}
?>
    <table style="width:50%; font-size: 12pt;  padding: 5px;"> <!-- Lo cambiaremos por CSS -->
    <tr>
      <td style="width:50%;" class='midnight-blue' colspan="3">MIEMBRO</td>
    </tr>
    <tr>
      <td rowspan="5" >

    </td>
    <td style="width: 30%; text-align: left; font-weight: bold;">Nombre:</td>
    <td><?php echo $fullname; ?></td>
  </tr>
  <tr>
    <td style="width: 30%; text-align: left; font-weight: bold;">Direccion:</td>
    <td><?php echo $direccion; ?></td>
  </tr>
  <tr>
    <td style="width: 30%; text-align: left; font-weight: bold;">Telefono:</td>
    <td><?php echo $telefono; ?></td>
  </tr>
  <tr>
    <td style="width: 30%; text-align: left; font-weight: bold;">Email:</td>
    <td><?php echo $email; ?></td>
  </tr>
  <tr>
    <td style="width: 30%; text-align: left; font-weight: bold;">Edad:</td>
    <td><?php echo $edad; ?> Años</td>
  </tr>
</table><br>
  <table cellspacing="0" style="width: 100%; text-align: left; font-size: 12pt; border: 2px solid #000000;">
    <tr>
      <td class="cabeza-blue" colspan="2">DETALLE DE CONTRIBUCION</td>
    </tr>
    <tr>
      <td class="formato" style="width: 30%; text-align: right;">ID Ingreso:</td>
      <td class="formato" style="width: 70%; text-align: left"><?php echo $id_ingreso; ?></td>
    </tr>
    <tr>
      <td class="formato" style="width: 30%; text-align: right;">Factura No:</td>
      <td class="formato" style="width: 70%; text-align: left"><?php echo $ref_ingreso; ?></td>
    </tr>
    <tr>
      <td class="formato" style="width: 30%; text-align: right;">Fecha:</td>
      <td class="formato" style="width: 70%; text-align: left"><?php echo fecha($date_added); ?></td>
    </tr>
    <tr>
      <td class="formato" style="width: 30%; text-align: right;">Concepto:</td>
      <td class="formato" style="width: 70%; text-align: left"><?php echo $tip; ?></td>
    </tr>
    <tr>
      <td class="formato" style="width: 30%; text-align: right;">SUBTOTAL <?php echo $simbolo_moneda; ?>:</td>
      <td class="formato" style="width: 70%; text-align: left"><?php echo number_format($monto, 2); ?></td>
    </tr>
    <tr>
      <td class="formato" style="width: 30%; text-align: right;">IVA (<?php echo $impuesto; ?>)% <?php echo $simbolo_moneda; ?>:</td>
      <td class="formato" style="width: 70%; text-align: left">0.00</td>
    </tr>
    <tr>
      <td class="formato" style="width: 30%; text-align: right;">TOTAL <?php echo $simbolo_moneda; ?>:</td>
      <td class="formato" style="width: 70%; text-align: left"><?php echo number_format($monto, 2); ?></td>
    </tr>
    <tr>
      <td class="formato" colspan="2" style="width: 100%; text-align: center;"><?php echo convertir($monto); ?></td>
    </tr>

  </table><br>
<br><br>
<div style='width:32%;font-size: 12pt; border-bottom: 1px solid #2c3e50;padding-bottom:10px'>F:</div>
<div style='width:30%;font-size: 12pt; border-bottom: 0px solid #2c3e50;padding-bottom:10px'><?php echo $nombre_users; ?></div>



</page>

