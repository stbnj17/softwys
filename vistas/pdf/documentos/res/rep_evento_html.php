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
?>
  </div>

  <table cellpadding='4' cellspacing='0' border='0'>
    <tr>
      <th style="width:8%;">ID</th>
      <th style="width:35%;">Título</th>
      <th style="width:20%;">Fecha Inicial</th>
      <th style="width:20%;">Fecha Final</th>
      <th style="width:25%;">Usuario</th>
    </tr>
    <?php
#$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$sumador_total = 0;
//consulta de la anterior que manda la pagina anteior
while ($row = mysqli_fetch_array($query)) {
    $id_evento         = $row['id'];
    $titulo            = $row['title'];
    $date_added        = $row['start'];
    $date_end          = $row['end'];
    $nombre_users      = $row['nombre_users'] . ' ' . $row['apellido_users'];
    list($date, $hora) = explode(" ", $date_added);
    list($Y, $m, $d)   = explode("-", $date);
    $fecha             = $d . "-" . $m . "-" . $Y;
    list($date, $hora) = explode(" ", $date_end);
    list($Y, $m, $d)   = explode("-", $date);
    $fecha_end         = $d . "-" . $m . "-" . $Y;

    ?>
      <tr>
        <td><?php echo $id_evento; ?></td>
        <td><?php echo $titulo; ?></td>
        <td><?php echo $fecha; ?></td>
        <td><?php echo $fecha_end; ?></td>
        <td><?php echo $nombre_users; ?></td>
      </tr>
      <?php
}

?>
  </table>
  <div style='border-bottom: 3px solid #2874A6;padding-bottom:10px'></div>
</page>

