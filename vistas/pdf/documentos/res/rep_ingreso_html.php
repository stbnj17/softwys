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
 <page pageset='new' backtop='10mm' backbottom='10mm' backleft='15mm' backright='15mm' style="font-size: 14px; font-family: helvetica">
   <page_header>
     <table style="width: 100%; border: solid 0px black;" cellspacing=0>
       <tr>
         <td style="text-align: left;    width: 33%"></td>
         <td style="text-align: center;    width: 34%;font-size: 14px; font-weight: bold">Reporte de Ofrendas</td>
         <td style="text-align: right;    width: 33%"><?php echo date('d/m/Y'); ?></td>
       </tr>
     </table>
   </page_header>
   <?php include "encabezado.php"; ?><br>
   <br>
   <table cellpadding='4' cellspacing='0' border='0'>
     <tr>
       <?php
        $categoria = get_row('tipo_ingreso', 'nombre_tipoi', 'id_tipoi', $tipo);
        if ($tipo == null) {
          $xWhere = "";
        } else {
          $xWhere = " and ingresos.tipo_ingreso = '" . $tipo . "' ";
        }
        ?>
       <td style="width:100%;" class='midnight-blue' align="center">Categoria: <?php echo $categoria; ?>

       </td>
     </tr>
   </table>
   <br>
   <table cellspacing="0" style="width: 100%; text-align: left; font-size: 10px; border: 0px solid #000000;">
     <tr class="midnight-blue">
       <th class="formato" style="width:10%;text-align:center">Referencia</th>
       <th class="formato" style="width:25%;text-align:center">Miembro</th>
       <th class="formato" style="width:10%;text-align:center">Categoria</th>
       <th class="formato" style="width:10%;text-align:center">Fecha</th>
       <th class="formato" style="width:15%;text-align:center">Pago</th>
       <th class="formato" style="width:10%;text-align:center">Monto</th>
       <th class="formato" style="width:20%;text-align:center">Usuario</th>
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
         <td class="formato" colspan="7"><b><?php echo mes($fecha_mes) . ' ' . $fecha_anio; ?></b></td>
       </tr>
       <?php
        $simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
        $sumador_total  = 0;

        //SUB CONSULTA
        $sql_sub = mysqli_query($conexion, "SELECT * FROM ingresos WHERE cod_ingreso=1 and month(fecha_added)='" . $fecha_mes . "' and year(fecha_added)='" . $anio_inicio . "' $xWhere");
        while ($roww = mysqli_fetch_array($sql_sub)) {
          $referencia  = $roww['ref_ingreso'];
          $tipo        = get_row('tipo_ingreso', 'nombre_tipoi', 'id_tipoi', $roww['tipo_ingreso']);
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
        ?>

         <tr>
           <td class="formato" style="width: 10%"><?php echo $referencia; ?></td>
           <td class="formato" style="width: 25%"><?php echo $miembro; ?></td>
           <td class="formato" style="width: 10%"><?php echo $tipo; ?></td>
           <td class="formato" style="width: 10%"><?php echo $fecha; ?></td>
           <td class="formato" style="width: 15%"><?php echo pago2($pago); ?></td>
           <td class="formato" style="width: 10%"><?php echo $simbolo_moneda . '' . number_format($monto, 2) ?></td>
           <td class="formato" style="width: 20%"><?php echo $nombre_users; ?></td>
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