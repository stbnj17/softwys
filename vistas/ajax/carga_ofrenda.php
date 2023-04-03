<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../db.php";
require_once "../php_conexion.php";
$query_id = mysqli_query($conexion, "SELECT RIGHT(ref_ingreso,6) as ref FROM ingresos
  ORDER BY ref DESC LIMIT 1")
or die('error ' . mysqli_error($conexion));
$count = mysqli_num_rows($query_id);

if ($count != 0) {

    $data_id    = mysqli_fetch_assoc($query_id);
    $referencia = $data_id['ref'] + 1;
} else {
    $referencia = 1;
}

$buat_id    = str_pad($referencia, 6, "0", STR_PAD_LEFT);
$referencia = "OFD-$buat_id";

?>
<label for="ref" class="control-label">Referencia:</label>
<input type="text" class="form-control" id="ref" name="ref" value="<?php echo $referencia; ?>" autocomplete="off" readonly>
