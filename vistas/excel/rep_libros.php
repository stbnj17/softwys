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
//Archivo de funciones PHP
require_once "../funciones.php";
//FIN
$q = mysqli_real_escape_string($conexion, (strip_tags($_REQUEST['q'], ENT_QUOTES)));
//Consulta de la Tabla Libros
$sTable = "libros, autores, editoriales";
$sWhere = "";
$sWhere .= " WHERE libros.autor_id=autores.id_autor and libros.editorial_id=editoriales.id_editorial";

if ($_GET['q'] != "") {
    $sWhere .= " and  (libros.titulo like '%$q%' or autores.autor like '%$q%' or editoriales.editorial like '%$q%')";
}
$sWhere .= " order by id_libros";
$resultado = mysqli_query($conexion, "SELECT * FROM  $sTable  $sWhere ");
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
        ->setDescription("Reporte de Libros")
        ->setKeywords("reporte libros")
        ->setCategory("Reporte excel");
    $tituloReporte   = "Reporte de Libros";
    $titulosColumnas = array('ID', 'TITULO', 'AUTOR', 'CATEGORIA', 'EDITORIAL', 'ESTADO');
    $objPHPExcel->setActiveSheetIndex(0)
        ->mergeCells('A1:F1');
    // Se agregan los titulos del reporte
    $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A1', $tituloReporte)
        ->setCellValue('A3', $titulosColumnas[0])
        ->setCellValue('B3', $titulosColumnas[1])
        ->setCellValue('C3', $titulosColumnas[2])
        ->setCellValue('D3', $titulosColumnas[3])
        ->setCellValue('E3', $titulosColumnas[4])
        ->setCellValue('F3', $titulosColumnas[5]);

    //Se agregan los datos de los alumnos
    $i = 4;
    while ($fila = $resultado->fetch_array()) {
        if ($fila['estado'] == 1) {
            $estado = "Activo";
        } else {
            $estado = "Inactivo";
        }
        $cat = get_row('cat_libro', 'categoria', 'id_cat', $fila['cat_id']);

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A' . $i, $fila['id_libros'])
            ->setCellValue('B' . $i, $fila['titulo'])
            ->setCellValue('C' . $i, $fila['autor'])
            ->setCellValue('D' . $i, $cat)
            ->setCellValue('E' . $i, $fila['editorial'])
            ->setCellValue('F' . $i, $estado);
        $i++;
    }
    $estiloTituloReporte = array(
        'font'      => array(
            'name'   => 'Verdana',
            'bold'   => true,
            'italic' => false,
            'strike' => false,
            'size'   => 16,
            'color'  => array(
                'rgb' => '1C2833', //Color de la Letra
            ),
        ),
        'fill'      => array(
            'type'  => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('argb' => 'D6DBDF'),
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
            'name'   => 'Arial',
            'bold'   => true,
            'italic' => false,
            'strike' => false,
            'size'   => 10,
            'color'  => array(
                'rgb' => '1C2833', //color de las letras
            ),
        ),
        'fill'      => array(
            'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
            'rotation'   => 90,
            'startcolor' => array(
                'rgb' => 'D6DBDF', //color de fonto1
            ),
            'endcolor'   => array(
                'argb' => 'D6DBDF', //color de fonto2
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
        )
    );
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
        )
    );
    $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->applyFromArray($estiloTituloReporte);
    $objPHPExcel->getActiveSheet()->getStyle('A3:F3')->applyFromArray($estiloTituloColumnas);
    //$objPHPExcel->getActiveSheet()->setSharedStyle($estiloInformacion, "A4:G" . ($i - 1));

    for ($i = 'A'; $i <= 'F'; $i++) {
        $objPHPExcel->setActiveSheetIndex(0)
            ->getColumnDimension($i)->setAutoSize(true);
    }
    // Se asigna el nombre a la hoja
    $objPHPExcel->getActiveSheet()->setTitle('Libros');

    // Se activa la hoja para que sea la que se muestre cuando el archivo se abre
    $objPHPExcel->setActiveSheetIndex(0);
    // Inmovilizar paneles
    //$objPHPExcel->getActiveSheet(0)->freezePane('A4');
    $objPHPExcel->getActiveSheet(0)->freezePaneByColumnAndRow(0, 4);

    // Se manda el archivo al navegador web, con el nombre que se indica (Excel2007)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Reportelibreria.xlsx"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    $objWriter->save('php://output');
    exit;
} else {
    echo "<script>alert('No hay resultados para mostrar')</script>";
    echo "<script>window.close();</script>";
    //echo "<script>window.location.replace('../html/rep_pagos.php');</script>";
    header("Location:../html/libreria.php");
    exit;
    //print_r('No hay resultados para mostrar, Seleccionar un Paciente');
}
