<style type="text/css">
  .formato {
    text-align: left;
    vertical-align: top;
    border: 0.3px solid #000;
    border-collapse: collapse;
    padding: 1px;
  }

  .tabla {
    width: 100%;
    border-radius: 12px 12px 12px 12px;
    -moz-border-radius: 12px 12px 12px 12px;
    -webkit-border-radius: 12px 12px 12px 12px;
    border: 2px solid #000000;
  }

  .cabeza-blue {
    background: #85C1E9;
    padding: 4px 4px 4px;
    color: black;
    font-weight: bold;
    font-size: 12px;
  }

  .midnight-blue {
    background: #2c3e50;
    padding: 4px 4px 4px;
    color: white;
    font-weight: bold;
    font-size: 12px;
  }

  .silver {
    background: white;
    padding: 3px 4px 3px;
  }

  .clouds {
    background: #ecf0f1;
    padding: 3px 4px 3px;
  }

  .border-top {
    border-top: solid 1px #bdc3c7;

  }

  .border-left {
    border-left: solid 1px #bdc3c7;
  }

  .border-right {
    border-right: solid 1px #bdc3c7;
  }

  .border-bottom {
    border-bottom: solid 1px #bdc3c7;
  }
</style>
<page pageset='new' backtop='10mm' backbottom='10mm' backleft='15mm' backright='15mm' footer='page' style="font-size: 14px; font-family: helvetica">
  <page_header>
    <table style="width: 100%; border: solid 0px black;" cellspacing=0>
      <tr>
        <td style="text-align: left;    width: 33%"></td>
        <td style="text-align: center;    width: 34%;font-size: 14px; font-weight: bold">Reporte de Células</td>
        <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
      </tr>
    </table>
  </page_header>
  <?php include "encabezado_general.php"; ?><br>
  <table cellspacing="0" style="width: 100%; text-align: left; font-size: 12px; border: 0px solid #000000;">
    <tr class='midnight-blue'>
      <th class="formato" style="width:3%;">ID</th>
      <th class="formato" style="width:10%;">NOMBRE</th>
      <th class="formato" style="width:10%;">SECTOR</th>
      <th class="formato" style="width:25%;">SUPERVISOR</th>
      <th class="formato" style="width:25%;">LIDER</th>
      <th class="formato" style="width:17%;">ESTADO</th>
      <th class="formato" style="width:10%;">FECHA ADD.</th>
    </tr>
    <?php

    //consulta de la anterior que manda la pagina anteior
    while ($row = mysqli_fetch_array($query)) {
      $id_celula       = $row['id_celula'];
      $nombre          = $row['nombre_cel'];
      $sector          = $row['sector_cel'];
      $supervisor      = $row['supervisor_cel'];
      $lider           = $row['lider_cel'];
      $estad           = $row['estado_cel'];
      $date_added      = $row['fecha_added'];
      list($date)      = explode(" ", $date_added);
      list($Y, $m, $d) = explode("-", $date);
      $fecha           = $d . "-" . $m . "-" . $Y;

      $nom_supervisor = get_row('miembros', 'nombre_miembro', 'id_miembro', $supervisor) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $supervisor);
      $nom_lider      = get_row('miembros', 'nombre_miembro', 'id_miembro', $lider) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $lider);
      if ($estad == 1) {
        $estado = "<span class='badge badge-success'>Activo</span>";
      } else {
        $estado = "<span class='badge badge-danger'>Inactivo</span>";
      }
    ?>

      <tr>
        <td class="formato" style="width: 3%"><?php echo $id_celula; ?></td>
        <td class="formato" style="width: 10%"><?php echo $nombre; ?></td>
        <td class="formato" style="width: 10%"><?php echo $sector; ?></td>
        <td class="formato" style="width: 25%"><?php echo $nom_supervisor; ?></td>
        <td class="formato" style="width: 25%"><?php echo $nom_lider; ?></td>
        <td class="formato" style="width: 17%"><?php echo $estado; ?></td>
        <td class="formato" style="width: 10%"><?php echo $fecha; ?></td>
      </tr>
    <?php
    }

    ?>
  </table>
</page>