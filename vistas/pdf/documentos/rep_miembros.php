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
// escaping, additionally removing everything that could be (html/javascript-) code
$q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
$aColumns = array('nombre_miembro', 'apellido_miembro', 'documento_miembro'); //Columnas de busqueda
$sTable   = "miembros";
$sWhere   = "";
if ($_GET['q'] != "") {
    $sWhere = "WHERE (";
    for ($i = 0; $i < count($aColumns); $i++) {
        $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
    }
    $sWhere = substr_replace($sWhere, "", -3);
    $sWhere .= ')';
}
$sWhere .= " order by apellido_miembro ASC";

//pagination variables
$page      = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
$per_page  = 10; //how much records you want to show
$adjacents = 4; //gap between pages after number of adjacents
$offset    = ($page - 1) * $per_page;
//Count the total number of row in your table*/
$count_query = mysqli_query($conexion, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
$row         = mysqli_fetch_array($count_query);
$numrows     = $row['numrows'];
$total_pages = ceil($numrows / $per_page);
$reload      = '../html/miembros.php';
//main query to fetch the data
$sql   = "SELECT * FROM  $sTable $sWhere";
$query = mysqli_query($conexion, $sql);

// get the HTML
ob_start();
include dirname(__FILE__) . '/res/rep_miembros_html.php';
$content = ob_get_clean();

// convert to PDF
require_once dirname(__FILE__) . '/../html2pdf.class.php';
try
{
    $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8', 3);
    $html2pdf->pdf->SetDisplayMode('fullpage');
    $html2pdf->writeHTML($content, isset($_GET['vuehtml']));
    ob_end_clean();
    $html2pdf->Output('miembros.pdf');
} catch (HTML2PDF_exception $e) {
    echo $e;
    exit;
}
