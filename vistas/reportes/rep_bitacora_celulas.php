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
//Consulta de la Tabla Factura compras
$resultado = mysqli_query($conexion, "SELECT  * FROM celulas WHERE nombre_cel LIKE '%" . $q . "%' OR sector_cel LIKE '%" . $q . "%' ORDER BY id_celula");

class PDF extends FPDF
{
    // Funcion encargado de realizar el encabezado
    function Header()
    {
        global $logo;
        //global $sucursal;
        global $users;
        // Logo
        $this->Image($logo, 10, 5, 40); //Insertamos el logo si es en PNG su calidad o formato debe estar entre PNG 8/PNG 24
        $this->SetFont('Arial', 'B', 16); //Tamanio del encabezado
        $this->Cell(300, 15, "Reporte de Celulas Familiares", 0, 1, 'C');
        $this->SetFont('Arial', 'B', 12); //Tamanio del encabezado
        //$this->Cell(300, 10, "SUCURSAL:" . ' ' . $sucursal, 0, 1, 'C');
        $this->SetFont('Arial', 'B', 10);
        $ancho = 220; //mover el encabezado derecho
        $horizontal = 60; //Permitirá que las dimensiones que abarca horizontalmente sea 85 puntos más que cuando es vertical
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
//Encabezados Principales
$pdf->SetFont('Arial', 'B', 10); //Formato del texto
$pdf->SetTextColor(3, 3, 3); //Color del texto: Negro
$pdf->setFillColor(133, 193, 233); //Fondo de las celdas de los encabezados
// Declaramos el ancho de las columnas
$w = array(10, 40, 40, 70, 70, 20, 25);
//Declaramos el encabezado de la tabla
$pdf->Cell(10, 12, 'ID', 1, 0, 'C', 1);
$pdf->Cell(40, 12, 'NOMBRE', 1, 0, 'C', 1);
$pdf->Cell(40, 12, 'SECTOR', 1, 0, 'C', 1);
$pdf->Cell(70, 12, 'SUPERVISOR', 1, 0, 'C', 1);
$pdf->Cell(70, 12, 'LIDER.', 1, 0, 'C', 1);
$pdf->Cell(20, 12, 'ESTADO', 1, 0, 'C', 1);
$pdf->Cell(25, 12, 'FECHA ADD', 1, 0, 'C', 1);
$pdf->Ln();
$pdf->SetFont('Arial', '', 10);
$pdf->setFillColor(213, 216, 220);
$bandera = false; //Para alternar el relleno
//Mostramos el contenido de la tabla
$total_gen = 0;
while ($row = mysqli_fetch_array($resultado)) {
    if ($row['estado_cel'] == 1) {
        $estado = 'ACTIVO';
    } else {
        $estado = 'INACTIVO';
    }
    $nom_supervisor = get_row('miembros', 'nombre_miembro', 'id_miembro', $row['supervisor_cel']) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $row['supervisor_cel']);
    $nom_lider      = get_row('miembros', 'nombre_miembro', 'id_miembro', $row['supervisor_cel']) . ' ' . get_row('miembros', 'apellido_miembro', 'id_miembro', $row['supervisor_cel']);
    $pdf->Cell($w[0], 6, $row['id_celula'], 1, 0, 'L', $bandera);
    $pdf->Cell($w[1], 6, $row['nombre_cel'], 1, 0, 'L', $bandera);
    $pdf->Cell($w[2], 6, $row['sector_cel'], 1, 0, 'L', $bandera);
    $pdf->Cell($w[3], 6, $nom_supervisor, 1, 0, 'L', $bandera);
    $pdf->Cell($w[4], 6, $nom_lider, 1, 0, 'L', $bandera);
    $pdf->Cell($w[5], 6, $estado, 1, 0, 'L', $bandera);
    $pdf->Cell($w[6], 6, date("d/m/Y", strtotime($row['fecha_added'])), 1, 0, 'L', $bandera);
    $pdf->Ln();
    $bandera = !$bandera; //Alterna el valor de la bandera
}
//END
$pdf->Output();
