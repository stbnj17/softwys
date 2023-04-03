<?php
session_start();
if (!isset($_SESSION['user_login_status']) and $_SESSION['user_login_status'] != 1) {
    header("location: ../../login.php");
    exit;
}
/* Connect To Database*/
require_once "../db.php"; //Contiene las variables de configuracion para conectar a la base de datos
require_once "../php_conexion.php"; //Contiene funcion que conecta a la base de datos
//Fin
require_once "../funciones.php";
$daterange = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['daterange'], ENT_QUOTES)));
$cel       = intval($_REQUEST['cel']);
if ($cel == '') {
    $where = '';
} else {
    $where = "and celula_id='" . $cel . "'";
}
if (!empty($daterange)) {
    list($f_inicio, $f_final)                    = explode(" - ", $daterange); //Extrae la fecha inicial y la fecha final en formato espa?ol
    list($dia_inicio, $mes_inicio, $anio_inicio) = explode("/", $f_inicio); //Extrae fecha inicial
    $fecha_inicial                               = "$anio_inicio-$mes_inicio-$dia_inicio 00:00:00"; //Fecha inicial formato ingles
    list($dia_fin, $mes_fin, $anio_fin)          = explode("/", $f_final); //Extrae la fecha final
    $fecha_final                                 = "$anio_fin-$mes_fin-$dia_fin 23:59:59";
}

$consulta  = "SELECT * FROM asistencias WHERE fecha_add between '$fecha_inicial' and '$fecha_final' $where ORDER BY id_asistencia";
$resultado = $conexion->query($consulta);

if ($resultado->num_rows > 0) {

    date_default_timezone_set('America/Mexico_City');

    if (PHP_SAPI == 'cli') {
        die('Este archivo solo se puede ver desde un navegador web');
    }

    /** Se agrega la libreria PHPExcel */
    require_once 'lib/PHPExcel/PHPExcel.php';

    // Se crea el objeto PHPExcel
    $objPHPExcel = new PHPExcel();

    // Se asignan las propiedades del libro
    $objPHPExcel->getProperties()->setCreator("Codedrinks") //Autor
        ->setLastModifiedBy("Codedrinks") //Ultimo usuario que lo modificó
        ->setTitle("Reporte Excel con PHP y MySQL")
        ->setSubject("Reporte Excel con PHP y MySQL")
        ->setDescription("Reporte de Asistencias")
        ->setKeywords("reporte ingresos")
        ->setCategory("Reporte excel");

    $tituloReporte   = "Reporte de Asistencias";
    $titulosColumnas = array('ID', 'CELULA', 'HERMANOS', 'AMIGOS', 'NIÑOS', 'OFRENDA', 'CONV.', 'RECON.', 'BAUTISMOS', 'SEMINARISTA', 'AST.IGLESIA', 'FECHA');

    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A1:L1');

    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', $tituloReporte)
        ->setCellValue('A3', $titulosColumnas[0])
        ->setCellValue('B3', $titulosColumnas[1])
        ->setCellValue('C3', $titulosColumnas[2])
        ->setCellValue('D3', $titulosColumnas[3])
        ->setCellValue('E3', $titulosColumnas[4])
        ->setCellValue('F3', $titulosColumnas[5])
        ->setCellValue('G3', $titulosColumnas[6])
        ->setCellValue('H3', $titulosColumnas[7])
        ->setCellValue('I3', $titulosColumnas[8])
        ->setCellValue('J3', $titulosColumnas[9])
        ->setCellValue('K3', $titulosColumnas[10])
        ->setCellValue('L3', $titulosColumnas[11]);

    //Se agregan los datos de los alumnos
    $i = 4;
    while ($fila = $resultado->fetch_array()) {
        //otra consulta
        $sqlb   = mysqli_query($conexion, "select nombre_cel from celulas where id_celula='" . $fila['celula_id'] . "'");
        $rww    = mysqli_fetch_array($sqlb);
        $celula = $rww['nombre_cel'];

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $fila['id_asistencia'])
            ->setCellValue('B' . $i, $celula)
            ->setCellValue('C' . $i, $fila['hermanos'])
            ->setCellValue('D' . $i, $fila['amigos'])
            ->setCellValue('E' . $i, $fila['ninos'])
            ->setCellValue('F' . $i, $fila['ofrenda'])
            ->setCellValue('G' . $i, $fila['conv'])
            ->setCellValue('H' . $i, $fila['recon'])
            ->setCellValue('I' . $i, $fila['bautismos'])
            ->setCellValue('J' . $i, $fila['seminarista'])
            ->setCellValue('K' . $i, $fila['ast_iglesia'])
            ->setCellValue('L' . $i, date('d/m/Y', strtotime($fila['fecha_add'])));
        $i++;
    }

    $estiloTituloReporte = array(
        'font'      => array(
            'name'   => 'Verdana',
            'bold'   => true,
            'italic' => false,
            'strike' => false,
            'size'   => 12,
            'color'  => array(
                'rgb' => 'FFFFFF',
            ),
        ),
        'fill'      => array(
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => 'FF220835'),
        ),
        'borders'   => array(
            'allborders' => array(
                'style' => PHPExcel_Style_Border::BORDER_NONE,
            ),
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'rotation'   => 0,
            'wrap'       => true,
        ),
    );

    $estiloTituloColumnas = array(
        'font'      => array(
            'name'  => 'Arial',
            'bold'  => true,
            'size'  => 10,
            'color' => array(
                'rgb' => 'FFFFFF',
            ),
        ),
        'fill'      => array(
            'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
            'rotation'   => 90,
            'startcolor' => array(
                'rgb' => 'c47cf2',
            ),
            'endcolor'   => array(
                'argb' => 'FF431a5d',
            ),
        ),
        'borders'   => array(
            'top'    => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array(
                    'rgb' => '143860',
                ),
            ),
            'bottom' => array(
                'style' => PHPExcel_Style_Border::BORDER_MEDIUM,
                'color' => array(
                    'rgb' => '143860',
                ),
            ),
        ),
        'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            'wrap'       => true,
        ));

    $estiloInformacion = new PHPExcel_Style();
    $estiloInformacion->applyFromArray(
        array(
            'font'    => array(
                'name'  => 'Arial',
                'color' => array(
                    'rgb' => '000000',
                ),
            ),
            'fill'    => array(
                'type'  => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('argb' => 'FFd9b7f4'),
            ),
            'borders' => array(
                'left' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN,
                    'color' => array(
                        'rgb' => '3a2a47',
                    ),
                ),
            ),
        ));

    $objPHPExcel->getActiveSheet()->getStyle('A1:L1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:L3')->applyFromArray($estiloTituloColumnas);
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G" . ($i - 1));
    //FORMATO NUMERICO
    $objPHPExcel->getActiveSheet()->getStyle('F3:F' . ($i - 1))->getNumberFormat()->setFormatCode('#,##0.00');

    for ($i = 'A'; $i <= 'L'; $i++) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->getColumnDimension($i)->setAutoSize(true);
    }

    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('Asistencias');

    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Inmovilizar paneles
    //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 4);

    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reporte_Asistencias.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;

} else {
    echo "<script>alert('No hay resultados para mostrar')</script>";
    echo "<script>window.close();</script>";
    //echo "<script>window.location.replace('../html/rep_pagos.php');</script>";
    header("Location:../html/asistencias.php");
    exit;
    //print_r('No hay resultados para mostrar, Seleccionar un Paciente');
}
