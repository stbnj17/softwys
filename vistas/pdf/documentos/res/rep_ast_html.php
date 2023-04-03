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
      <td style="text-align: center;    width: 34%;font-size: 14px; font-weight: bold">Reporte de Asistecias</td>
      <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
    </tr>
  </table>
  </page_header>
  <?php include "encabezado.php";?><br>
  <br>
      <?php
if ($cel == null) {
    $yWhere = "";
} else {
    $yWhere = " and asistencias.celula_id = '" . $cel . "' ";
}
$xWhere = " and asistencias.fecha_add between '$fecha_inicial' and '$fecha_final' ";
?>
<br>
<table  cellspacing="0" style="width: 100%; text-align: left; font-size: 10px; border: 0px solid #000000;">
  <tr class="midnight-blue">
     <th class="formato" style="width:5%">ID</th>
    <th class="formato" style="width:15%">CELULA</th>
    <th class="formato" style="width:8%">HERMANOS</th>
    <th class="formato" style="width:8%">AMIGOS</th>
    <th class="formato" style="width:8%">NIÑOS</th>
    <th class="formato" style="width:10%">OFRENDA</th>
    <th class="formato" style="width:5%">CONV.</th>
    <th class="formato" style="width:5%">RECON..</th>
    <th class="formato" style="width:8%">BAUTISMOS</th>
    <th class="formato" style="width:10%">SEMINARISTA</th>
    <th class="formato" style="width:8%">AST.IGLESIA</th>
    <th class="formato" style="width:12%">FECHA</th>
  </tr>
  <?php
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
//CONSULTA PRINCIPAL
$total_full = 0;
while ($row = mysqli_fetch_array($query)) {
    $fecha_mes  = date("m", strtotime($row['fecha_add']));
    $fecha_anio = date("Y", strtotime($row['fecha_add']));

    ?>
    <tr class="cabeza-blue">
      <td class="formato" colspan="12"><b><?php echo mes($fecha_mes) . ' ' . $fecha_anio; ?></b></td>
    </tr>
    <?php
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
    $sumador_total  = 0;

//SUB CONSULTA
    $sql_sub = mysqli_query($conexion, "SELECT * FROM asistencias WHERE month(fecha_add)='" . $fecha_mes . "' and year(fecha_add)='" . $anio_inicio . "' $yWhere $xWhere");
    while ($roww = mysqli_fetch_array($sql_sub)) {
        $id_ast      = $roww['id_asistencia'];
        $nom_celula  = get_row('celulas', 'nombre_cel', 'id_celula', $roww['celula_id']);
        $celula_id   = $roww['celula_id'];
        $hermanos    = $roww['hermanos'];
        $amigos      = $roww['amigos'];
        $ninos       = $roww['ninos'];
        $ofrenda     = $roww['ofrenda'];
        $conv        = $roww['conv'];
        $recon       = $roww['recon'];
        $bautismos   = $roww['bautismos'];
        $seminarista = $roww['seminarista'];
        $ast_iglesia = $roww['ast_iglesia'];
        $estado_ast  = $roww['estado_ast'];
        $date_added  = $roww['fecha_add'];
        $id_users    = $roww['users'];
        //$user_fullname = $row['nombre_users'] . ' ' . $row['apellido_users'];

        $sumador_total += $ofrenda;

        list($date)      = explode(" ", $date_added);
        list($Y, $m, $d) = explode("-", $date);
        $fecha           = $d . "-" . $m . "-" . $Y;
        //$finales++;
        ?>

      <tr>
        <td class="formato" style="width: 5%;text-align:center"><?php echo $id_ast; ?></td>
        <td class="formato" style="width: 15%;text-align:center"><?php echo $nom_celula; ?></td>
        <td class="formato" style="width: 8%;text-align:center"><?php echo $hermanos; ?></td>
        <td class="formato" style="width: 8%;text-align:center"><?php echo $amigos; ?></td>
        <td class="formato" style="width: 8%;text-align:center"><?php echo $ninos; ?></td>
        <td class="formato" style="width: 10%"><?php echo $simbolo_moneda . '' . number_format($ofrenda, 2) ?></td>
        <td class="formato" style="width: 5%;text-align:center"><?php echo $conv; ?></td>
        <td class="formato" style="width: 5%;text-align:center"><?php echo $recon; ?></td>
        <td class="formato" style="width: 8%;text-align:center"><?php echo $bautismos; ?></td>
        <td class="formato" style="width: 10%;text-align:center"><?php echo $seminarista; ?></td>
        <td class="formato" style="width: 8%;text-align:center"><?php echo $ast_iglesia; ?></td>
        <td class="formato" style="width: 12%;text-align:center"><?php echo $fecha; ?></td>
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

