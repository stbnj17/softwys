<?php
include '../../ajax/is_logged.php'; //Archivo verifica que el usario que intenta acceder a la URL esta logueado
$id_miembro = $_SESSION['id_miembro'];
/* Connect To Database*/
require_once "../../db.php";
require_once "../../php_conexion.php";
#require_once "../libraries/inventory.php"; //Contiene funcion que controla stock en el inventario
//Inicia Control de Permisos
include "../../permisos.php";
//Archivo de funciones PHP
require_once "../../funciones.php";
//Ontengo variables pasadas por GET
$simbolo_moneda = get_row('perfil', 'moneda', 'id_perfil', 1);
$id_abono       = intval($_REQUEST['id_abono']);
$tables         = "ingresos";
$campos         = "*";
$sWhere         = "id_ingreso='" . $id_abono . "'";
$sWhere .= " order by id_ingreso";
$query = mysqli_query($conexion, "SELECT $campos FROM  $tables where $sWhere ");
// get the HTML
ob_start();
include dirname(__FILE__) . '/res/rep_abono_html.php';
$content = ob_get_clean();

// convert to PDF
require_once dirname(__FILE__) . '/../html2pdf.class.php';
try
{
    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    $html2pdf->Output('usuarios.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
