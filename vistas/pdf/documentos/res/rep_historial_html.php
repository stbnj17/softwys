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
<page pageset='new' backtop='10mm' backbottom='10mm' backleft='15mm' backright='15mm' footer='page'>
  <page_header>
  <table cellpadding='4' cellspacing='0' border='0'>
  <tr>
    <td style="width:100%;" class='midnight-blue' align="center">HISTORIAL DE OFRENDAS Y DIEZMOS</td>
  </tr>
</table>
  <table style="width: 100%; border: solid 0px black;" cellspacing=0>
    <tr>
      <td style="text-align: left;    width: 33%"></td>
      <td style="text-align: center;    width: 34%;font-size: 14px; font-weight: bold"></td>
      <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
    </tr>
  </table>
  </page_header>
  <?php require_once "../../funciones.php";?>
  <?php include "encabezado.php";?><br>
  <?php
//Ontengo variables pasadas por GET
$sql1       = mysqli_query($conexion, "select * from miembros where id_miembro='" . $id_miembro . "'");
$rw1        = mysqli_fetch_array($sql1);
$fullname   = $rw1['nombre_miembro'] . ' ' . $rw1['apellido_miembro'];
$direccion  = $rw1['direccion_miembro'];
$telefono   = $rw1['telefono_miembro'];
$email      = $rw1['email_miembro'];
$cumpleanos = new DateTime($rw1['fecha_nacimiento']);
$hoy        = new DateTime();
$annos      = $hoy->diff($cumpleanos);
$edad       = $annos->y;

?>
  <table style="width:80%; font-size: 14px;  padding: 5px;"> <!-- Lo cambiaremos por CSS -->
    <tr>
      <td style="width:50%;" class='midnight-blue' colspan="3">MIEMBRO</td>
    </tr>
    <tr>
      <td rowspan="5" >

    </td>
    <td style="width: 20%; text-align: left; font-weight: bold;">Nombre:</td>
    <td style="width: 60%;"><b><?php echo $fullname; ?></b></td>
  </tr>
  <tr>
    <td style="width: 20%; text-align: left; font-weight: bold;">Direccion:</td>
    <td style="width: 60%;"><?php echo $direccion; ?></td>
  </tr>
  <tr>
    <td style="width: 20%; text-align: left; font-weight: bold;">Telefono:</td>
    <td style="width: 60%;"><?php echo $telefono; ?></td>
  </tr>
  <tr>
    <td style="width: 20%; text-align: left; font-weight: bold;">Email:</td>
    <td style="width: 60%;"><?php echo $email; ?></td>
  </tr>
  <tr>
    <td style="width: 20%; text-align: left; font-weight: bold;">Edad:</td>
    <td style="width: 60%;"><?php echo $edad; ?> Años</td>
  </tr>
</table><br>
<?php
$categoria = get_row('tipo_ingreso', 'nombre_tipoi', 'id_tipoi', $tipoo);
if ($tipo == null) {
    $yWhere = "";
} else {
    $yWhere = " and ingresos.cod_ingreso = '" . $tipo . "' ";
}
if ($tipoo == null) {
    $xWhere = "";
} else {
    $xWhere = " and ingresos.tipo_ingreso = '" . $tipoo . "' ";
}

?>
<br>
  <table  cellspacing="0" style="width: 100%; text-align: left; font-size: 10px; border: 0px solid #000000;">
  <tr class="midnight-blue">
    <th class="formato" style="width:15%;text-align:center">Referencia</th>
    <th class="formato" style="width:15%;text-align:center">Tipo de Ingreso</th>
    <th class="formato" style="width:20%;text-align:center">Categoria</th>
    <th class="formato" style="width:15%;text-align:center">Fecha</th>
    <th class="formato" style="width:20%;text-align:center">Forma de Pago</th>
    <th class="formato" style="width:15%;text-align:center">Monto</th>
  </tr>
  <?php
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
//CONSULTA PRINCIPAL
$total_full = 0;
while ($row = mysqli_fetch_array($query)) {
    $fecha_mes  = date("m", strtotime($row['fecha_added']));
    $fecha_anio = date("Y", strtotime($row['fecha_added']));

    ?>
    <tr class="cabeza-blue">
      <td class="formato" colspan="8"><b><?php echo mes($fecha_mes) . ' ' . $fecha_anio; ?></b></td>
    </tr>
    <?php
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
    $sumador_total  = 0;

//SUB CONSULTA
    $sql_sub = mysqli_query($conexion, "SELECT * FROM ingresos WHERE month(fecha_added)='" . $fecha_mes . "' and year(fecha_added)='" . $anio_inicio . "' and miembro_id=$id_miembro $xWhere $yWhere");
    while ($roww = mysqli_fetch_array($sql_sub)) {
        $referencia  = $roww['ref_ingreso'];
        $cod_ingreso = $roww['cod_ingreso'];
        $tipoo       = get_row('tipo_ingreso', 'nombre_tipoi', 'id_tipoi', $roww['tipo_ingreso']);
        $miembro     = get_row('miembros', 'nombre_miembro', 'id_miembro', $roww['miembro_id']) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $roww['miembro_id']);
        $pago        = $roww['pago_ingreso'];
        $descripcion = $roww['obs_ingreso'];
        $id_users    = $roww['users'];
        //otra consulta para el nombre del paciente
        $sql          = mysqli_query($conexion, "select nombre_users, apellido_users from users where id_users='" . $id_users . "'");
        $rw           = mysqli_fetch_array($sql);
        $nombre_users = $rw['nombre_users'] . ' ' . $rw['apellido_users'];
        // fin consulta
        $date_added = $roww['fecha_added'];
        $monto      = $roww['monto'];
        $sumador_total += $monto;

        list($date)      = explode(" ", $date_added);
        list($Y, $m, $d) = explode("-", $date);
        $fecha           = $d . "-" . $m . "-" . $Y;
        if ($cod_ingreso == 1) {
            $tip = "<span class='badge badge-primary'>OFRENDA</span>";
        } else {
            $tip = "<span class='badge badge-danger'>DIEZMO</span>";
        }
        ?>

      <tr>
        <td class="formato" style="width: 15%"><?php echo $referencia; ?></td>
        <td class="formato" style="width: 15%"><?php echo $tip; ?></td>
        <td class="formato" style="width: 20%"><?php echo $tipoo; ?></td>
        <td class="formato" style="width: 15%"><?php echo $fecha; ?></td>
        <td class="formato" style="width: 20%"><?php echo pago2($pago); ?></td>
        <td class="formato" style="width: 15%"><?php echo $simbolo_moneda . '' . number_format($monto, 2) ?></td>
      </tr>
      <?php
}
    $total_full += $sumador_total;
    ?>
      <!-- FIN DE LA SUBCONSULTAL-->
      <tr>
        <td colspan="5" style="text-align: right;  font-size: 12px;"><b>Total Mes <?php echo $simbolo_moneda; ?></b></td>
        <td style="text-align: left;  font-size: 12px;"><b><?php echo number_format($sumador_total, 2); ?></b></td>
      </tr>
    <?php }
?>
    <!-- FIN DE CONSULTA PRINCIPAL-->
  </table>
  <br>
  <table cellspacing="0" style="width: 100%; font-size: 12pt; border: 1px solid #000000;">
    <tr>
      <td style="width: 70%; text-align: right;"><b>Total <?php echo $simbolo_moneda; ?></b></td>
      <td style="width: 30%; text-align: left;"><b><?php echo number_format($total_full, 2); ?></b></td>
    </tr>
  </table>
</page>