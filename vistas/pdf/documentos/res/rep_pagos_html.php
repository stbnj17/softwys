<page pageset='new' backtop='10mm' backbottom='10mm' backleft='20mm' backright='20mm' footer='page'>
<?php include "encabezado.php";?><br>
  <div style='border-bottom: 3px solid #2874A6;padding-bottom:10px'>
    Paciente:
    <?php
$sql1     = mysqli_query($conexion, "select nombre_paciente from pacientes where id_paciente='" . $employee_id . "'");
$rw1      = mysqli_fetch_array($sql1);
$fullname = $rw1['nombre_paciente'];
if (empty($fullname)) {
    echo "Todos";
} else {
    echo $fullname;
}
?>
  </div>

  <table cellpadding='4' cellspacing='0' border='0'>
    <tr class='midnight-blue'>
      <th style="width:15%;">No. Consulta </th>
      <th style="width:40%;">Paciente</th>
      <th style="width:30%;">Fecha</th>
      <th style="width:15%;">Monto</th>
    </tr>
    <?php
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$sumador_total  = 0;
//consulta de la anterior que manda la pagina anteior
while ($row = mysqli_fetch_array($query)) {
    $id_consulta = $row['id_consulta'];
    $id_paciente = $row['id_paciente'];
    //otra consulta para el nombre del paciente
    $sql             = mysqli_query($conexion, "select nombre_paciente from pacientes where id_paciente='" . $id_paciente . "'");
    $rw              = mysqli_fetch_array($sql);
    $nombre_paciente = $rw['nombre_paciente'];
    // fin consulta
    $date_added = $row['fecha_added'];
    $total      = $row['monto'];

    $sumador_total += $total;

    list($date, $hora) = explode(" ", $date_added);
    list($Y, $m, $d)   = explode("-", $date);
    $fecha             = $d . "-" . $m . "-" . $Y;

    ?>
      <tr>
        <td><?php echo $id_consulta; ?></td>
        <td><?php echo $nombre_paciente; ?></td>
        <td><?php echo $fecha; ?></td>
        <td><?php echo $simbolo_moneda . '' . number_format($total, 2) ?></td>
      </tr>
      <?php
}

?>
    <tr>
    <td style='text-align:right;border-top:3px solid #2874A6;padding:4px;padding-top:4px;font-size:14px' colspan="4"><?php echo $simbolo_moneda . '' . number_format($sumador_total, 2) ?></td>
    </tr>
  </table>
</page>

