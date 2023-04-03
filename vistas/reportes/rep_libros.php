<?php
session_start();
$user_id = $_SESSION['id_users'];
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Archivo de funciones PHP
require_once "../funciones.php";
//Incluimos la libreria PDF
include_once('libs/fpdf.php');
//consulta a la tabla perfil
$q        = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
$sql           = mysqli_query($conexion, "SELECT moneda, nombre_empresa, logo_url FROM perfil");
$rw            = mysqli_fetch_array($sql);
$moneda        = $rw["moneda"];
$bussines_name = $rw["nombre_empresa"];
$logo      = $rw["logo_url"];
// Consulta de los usuarios
$user           = mysqli_query($conexion, "SELECT nombre_users, apellido_users FROM users WHERE id_users = $user_id");
$row            = mysqli_fetch_array($user);
$users = $row['nombre_users'] . ' ' . $row['apellido_users'];
//Consulta de la Tabla Libros
$sTable = "libros, autores, editoriales";
$sWhere = "";
$sWhere .= " WHERE libros.autor_id=autores.id_autor and libros.editorial_id=editoriales.id_editorial";

if ($_GET['q'] != "") {
    $sWhere .= " and  (libros.titulo like '%$q%' or autores.autor like '%$q%' or editoriales.editorial like '%$q%')";
}
$sWhere .= " order by id_libros";
$resultado = mysqli_query($conexion, "SELECT * FROM  $sTable  $sWhere ");
class PDF extends FPDF
{
    // Funcion encargado de realizar el encabezado
    function Header()
    {
        global $logo;
        global $user_id;
        global $users;
        // Logo
        //$this->Image($logo,10,-5,50);
        //$this->SetFont('Arial','B',13);
        $ancho = 190;
        //$this->SetFont('Arial', 'B', 13);
        $this->Image($logo, 10, 15, 40); //Insertamos el logo si es en PNG su calidad o formato debe estar entre PNG 8/PNG 24
        $ancho = 190;
        $this->SetFont('Arial', 'B', 16); //Tamanio del encabezado
        $this->Cell(275, 30, "Reporte de Libros", 0, 1, 'C');
        $this->SetFont('Arial', 'B', 10);
        $horizontal = 85; //Permitirá que las dimensiones que abarca horizontalmente sea 85 puntos más que cuando es vertical
        $this->SetY(10);
        $this->Cell($ancho + $horizontal, 10, 'Usuario: ' . $users . '', 0, 0, 'R');
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
$pdf->AliasNbPages();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
//Color de Fondo de las celdas del encabezado
$pdf->setFillColor(133, 193, 233);

// Declaramos el ancho de las columnas
$w = array(10, 70, 70, 35, 70, 20);
//Declaramos el encabezado de la tabla
$pdf->Cell(10, 12, 'ID', 1, 0, 'C', 1);
$pdf->Cell(70, 12, 'TITULO', 1, 0, 'C', 1);
$pdf->Cell(70, 12, 'AUTOR', 1, 0, 'C', 1);
$pdf->Cell(35, 12, 'CATEGORIA', 1, 0, 'C', 1);
$pdf->Cell(70, 12, 'EDITORIAL', 1, 0, 'C', 1);
$pdf->Cell(20, 12, 'ESTADO', 1, 0, 'C', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 12);
$pdf->setFillColor(213, 216, 220);
$bandera = false; //Para alternar el relleno
//Mostramos el contenido de la tabla
while ($row = mysqli_fetch_array($resultado)) {
    if ($row['estado'] == 1) {
        $estado = "ACTIVO";
    } else {
        $estado = "INACTIVO";
    }
    $cat = get_row('cat_libro', 'categoria', 'id_cat', $row['cat_id']);
    $pdf->Cell($w[0], 6, utf8_decode($row['id_libros']), 1, 0, 'L', $bandera);
    $pdf->Cell($w[1], 6, utf8_decode($row['titulo']), 1, 0, 'L', $bandera);
    $pdf->Cell($w[2], 6, utf8_decode($row['autor']), 1, 0, 'L', $bandera);
    $pdf->Cell($w[3], 6, utf8_decode($cat), 1, 0, 'L', $bandera);
    $pdf->Cell($w[4], 6, utf8_decode($row['editorial']), 1, 0, 'L', $bandera);
    $pdf->Cell($w[5], 6, $estado, 1, 0, 'L', $bandera);
    $pdf->Ln();
    $bandera = !$bandera; //Alterna el valor de la bandera
}
$pdf->Output();
