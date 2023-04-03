<?php
session_start();
$user_id = $_SESSION['id_users'];
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Incluimos la libreria PDF
include_once('libs/fpdf.php');
$daterange      = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
$tipo      = intval($_REQUEST['tipoo']);
//consulta a la tabla perfil
$sql           = mysqli_query($conexion, "SELECT moneda, nombre_empresa, logo_url FROM perfil");
$rw            = mysqli_fetch_array($sql);
$moneda        = $rw["moneda"];
$bussines_name = $rw["nombre_empresa"];
$logo      = $rw["logo_url"];
//Consulta de la Tabla Factura Ventas
$tables    = "egresos,  users";
$campos    = "*";
$sWhere    = "users.id_users=egresos.users";
if ($tipoo > 0) {
    $sWhere .= " and egresos.tipo_egreso = '" . $tipoo . "' ";
}
if (!empty($daterange)) {
    list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
    list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
    $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
    list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
    $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";

    $sWhere .= " and egresos.fecha_added between '$fecha_inicial' and '$fecha_final' ";
}
$sWhere .= " order by egresos.id_egreso";
$resultado = mysqli_query($conexion, "SELECT $campos FROM  $tables where $sWhere ");
class PDF extends FPDF
{
    // Funcion encargado de realizar el encabezado
    function Header()
    {
        global $logo;
        global $user_id;
        global $users;
        // Logo
        $this->Image($logo, 10, 5, 40); //Insertamos el logo si es en PNG su calidad o formato debe estar entre PNG 8/PNG 24
        $this->SetFont('Arial', 'B', 16); //Tamanio del encabezado
        $this->Cell(300, 30, "Reporte de Gastos", 0, 1, 'C');
        $this->SetFont('Arial', 'B', 10);
        $ancho = 220; //mover el encabezado derecho
        $horizontal = 55; //Permitirá que las dimensiones que abarca horizontalmente sea 85 puntos más que cuando es vertical
        $this->SetY(10);
        $this->Cell($ancho + $horizontal, 10, '' . $users . '', 0, 0, 'R');
        $this->SetY(15);
        $this->Cell($ancho + $horizontal, 10, 'Fecha: ' . date('d/m/Y'), 0, 0, 'R');
        $this->SetY(20);
        $this->Cell($ancho + $horizontal, 10, 'Hora: ' . date('H:i:s'), 0, 0, 'R');

        $this->Ln(25);
    }

    // Funcion pie de pagina
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Pagina ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

//$pdf = new PDF();
//Horientacion de las paginas
$pdf = new PDF('L', 'mm', 'A4', true, 'UTF-8', false);
//header
$pdf->AddPage();
//foter page
//Encabezados Principales
$pdf->SetFont('Arial', 'B', 12); //Formato del texto
$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
$pdf->setFillColor(133, 193, 233); //Fondo de las celdas de los encabezados
// Declaramos el ancho de las columnas
$w = array(40, 85, 40, 30);
//Declaramos el encabezado de la tabla
$pdf->Cell(40, 12, 'REFERENCIAS', 1, 0, 'C', 1);
$pdf->Cell(85, 12, 'TIPO DE GASTO', 1, 0, 'C', 1);
$pdf->Cell(40, 12, 'FECHA.', 1, 0, 'C', 1);
$pdf->Cell(45, 12, 'MONTO', 1, 0, 'C', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 11);
$pdf->setFillColor(213, 216, 220);
$bandera = false; //Para alternar el relleno
//Mostramos el contenido de la tabla
$total = 0;
while ($row = mysqli_fetch_array($resultado)) {
    // Consulta de los usuarios
    $referencia  = $row['referencia_egreso'];
    $tipo_gasto = $row['tipo_egreso'];
    $total += $row['monto'];
    $nombre_gasto    = get_row('tipo_gasto', 'nombre_tipo', 'id_tipo', $tipo_gasto);

    $pdf->Cell($w[0], 6, $row['referencia_egreso'], 1, 0, 'L', $bandera);
    $pdf->Cell($w[2], 6, $nombre_gasto, 1, 0, 'L', $bandera);
    $pdf->Cell($w[3], 6, date("d/m/Y", strtotime($row['fecha_added'])), 1, 0, 'L', $bandera);
    $pdf->Cell($w[4], 6, ($moneda . ' ' . number_format($row['monto'], 4)), 1, 0, 'L', $bandera);
    $pdf->Ln();
    $bandera = !$bandera; //Alterna el valor de la bandera
}
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 12); //Formato del texto
$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
$pdf->Cell(235, 12, 'TOTAL GENERAL', 1, 0, 'R', 1);
$pdf->Cell(45, 12, $moneda . ' ' . number_format($total, 4), 1, 0, 'L', 1);
$pdf->Ln();
$pdf->Output();
