<?php

header('Content-Type: text/html; charset=ISO-8859-1');
date_default_timezone_set('America/Lima');

include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/arreglos.controlador.php";
require_once "../../modelos/arreglos.modelo.php";

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Corp. Vasco"); //autor
$objPHPExcel->getProperties()->setTitle("00000020"); //titulo

$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setTitle("Articulos en Arreglos");

$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

$marginV = 0.5 / 3.54; // 0.5 centimetros

$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($marginV);

$fila = 1;
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:I$fila");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Articulos en Arreglos ' . date('d/m/Y'));
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getFont()->setSize(16);
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getFont()->setBold(true);
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Fecha');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Guia');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Taller');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Modelo');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Nombre');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Color');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Talla');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Cantidad');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Saldo');

$detalles = ModeloArreglos::verArreglosReporte(null);

foreach ($detalles as $detalle) {
    $fila++;

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", date('d/m/Y', strtotime($detalle["fecha"])));
    $objPHPExcel->getActiveSheet()->SetCellValueExplicit("B$fila", $detalle["guia"], PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $detalle["taller"] . ' - ' . $detalle["nom_sector"]);
    $objPHPExcel->getActiveSheet()->getStyle("D$fila")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $detalle["nombre"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $detalle["color"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $detalle["talla"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $detalle["cantidad"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $detalle["pendiente"]);
}

$objPHPExcel->getActiveSheet()->getStyle("A3:I$fila")->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

$objPHPExcel->getActiveSheet()->getStyle("A3:D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("G3:G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// $objPHPExcel->getActiveSheet()->getStyle("A$fila:I$fila")->getFont()->setBold(true);

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

header("Content-Type: application/vnd.ms-excel");

header('Content-Disposition: attachment; filename="Articulos en Arreglos.xls"');

//forzar a descarga por el navegador
$objWriter->save('php://output');
