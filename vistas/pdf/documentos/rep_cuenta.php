<?php
include 'is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
/* Connect To Database*/
require_once "../../db.php";
require_once "../../php_conexion.php";
//Inicia Control de Permisos
include "../../permisos.php";
//Archivo de funciones PHP
require_once "../../funciones.php";
//Ontengo variables pasadas por GET
$id_ingreso = intval($_REQUEST['id_ingreso']);
// check if id_consulta  already not exists
$sql                   = "SELECT * FROM ingresos WHERE id_ingreso ='" . $id_ingreso . "';";
$query_check_user_name = mysqli_query($conexion, $sql);
$query_check_user      = mysqli_num_rows($query_check_user_name);
if ($query_check_user == false) {
    echo "<script>alert('Aun no existe el pago del Ingreso, por favor procese el mismo antes de esta operación')</script>";
    echo "<script>window.close();</script>";
    exit;
}
// get the HTML
ob_start();
include dirname(__FILE__) . '/res/rep_cuenta_html.php';
$content = ob_get_clean();

// convert to PDF
require_once dirname(__FILE__) . '/../html2pdf.class.php';
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    ob_end_clean();
    $html2pdf->Output('recibo.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
