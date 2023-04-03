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
<page pageset='new' backtop='10mm' backbottom='10mm' backleft='15mm' backright='15mm' footer='page' style="font-size: 14px; font-family: helvetica">
  <page_header>
  <table style="width: 100%; border: solid 0px black;" cellspacing=0>
    <tr>
      <td style="text-align: left;    width: 33%"></td>
      <td style="text-align: center;    width: 34%;font-size: 14px; font-weight: bold">Reporte de Miembros</td>
      <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
    </tr>
  </table>
  </page_header>
<?php include "encabezado_general.php";?><br>
  <table  cellspacing="0" style="width: 100%; text-align: left; font-size: 12px; border: 0px solid #000000;">
    <tr class='midnight-blue'>
      <th class="formato" style="width:3%;">ID</th>
      <th class="formato" style="width:25%;">NOMBRE</th>
      <th class="formato" style="width:15%;">DOCUMENTO</th>
      <th class="formato" style="width:10%;">TEL.CELULAR</th>
      <th class="formato" style="width:10%;">TEL.FIJO</th>
      <th class="formato" style="width:18%;">CIUDAD</th>
      <th class="formato" style="width:20%;">EMAIL</th>
    </tr>
    <?php

//consulta de la anterior que manda la pagina anteior
while ($row = mysqli_fetch_array($query)) {
    $id_miembro = $row['id_miembro'];
    $nombre     = $row['apellido_miembro'] . ', ' . $row['nombre_miembro'];
    $apellido   = $row['apellido_miembro'];
    $direccion  = $row['direccion_miembro'];
    $ciudad     = $row['ciudad_miembro'];
    $celular    = $row['celular_miembro'];
    $telefono   = $row['telefono_miembro'];
    $fecha_na   = $row['fecha_nacimiento'];
    $documento  = $row['documento_miembro'];
    $email      = $row['email_miembro'];
    $sexo       = $row['sexo_miembro'];
    $status     = $row['estado_miembro'];
    $date_added = date('d/m/Y', strtotime($row['date_addedd']));
    if ($status == 1) {
        $estado = "<span class='badge badge-success'>Activo</span>";
    } else {
        $estado = "<span class='badge badge-danger'>Inactivo</span>";
    }
    ?>

      <tr>
        <td class="formato" style="width: 3%"><?php echo $id_miembro; ?></td>
        <td class="formato" style="width: 25%"><?php echo $nombre; ?></td>
        <td class="formato" style="width: 15%"><?php echo $documento; ?></td>
        <td class="formato" style="width: 10%"><?php echo $celular; ?></td>
        <td class="formato" style="width: 10%"><?php echo $telefono; ?></td>
        <td class="formato" style="width: 18%"><?php echo $ciudad; ?></td>
        <td class="formato" style="width: 20%"><?php echo $email; ?></td>
      </tr>
      <?php
}

?>
  </table>
</page>

