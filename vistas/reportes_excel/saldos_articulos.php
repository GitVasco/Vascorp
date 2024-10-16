<?php

session_start();

date_default_timezone_set('America/Lima'); // O la zona horaria que corresponda

//ajuntar la libreria excel
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../modelos/articulos.modelo.php";


$fin = $_GET['fin'];
$guias = $_GET['guias'];
//sacamos el año
$anio = substr($fin, 0, 4);

$where = $guias == 1 ? "('S01')" : "('S01','S70')";
$titulo = $guias == 1 ? 'Con Guias' : 'Sin Guias';

$tabla = "movimientosjf_{$anio}";

$articulos = ModeloArticulos::mdlSaldosArticulos($tabla, $fin, $where);

//var_dump($articulos);

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Vasco"); //autor
$objPHPExcel->getProperties()->setTitle("Saldos Articulo"); //titulo

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Saldos a una fecha"); //establecer titulo de hoja

//orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

//tipo papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);


//establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);
//fin: establecer impresion a pagina completa

//establecer margenes
$margin = 0.5 / 3.54; // 0.5 centimetros
$marginBottom = 1.2 / 3.54; //1.2 centimetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginBottom);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($margin);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($margin);
//fin: establecer margenes

$fila = 1;
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:C$fila");
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Saldos a: ' . $fin . ' - ' . $titulo);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'CORPORACION VASCO S.A.C.');

$fila = 3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Articulo');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Marca');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Modelo');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Nombre');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'CodColor');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Color');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'CodTalla');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Talla');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Estado');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Ingresos');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Salidas');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Saldo');

foreach ($articulos as $articulo) {
    $fila += 1;

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $articulo['articulo']);
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $articulo['marca']);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $articulo['modelo']);
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $articulo['nombre']);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $articulo['cod_color']);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $articulo['color']);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $articulo['cod_talla']);
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $articulo['talla']);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $articulo['estado']);
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $articulo['ingresos']);
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $articulo['salidas']);
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $articulo['saldo']);
}


$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo
header('Content-Disposition: attachment; filename="Saldos APT a ' . $fin . '.xls"');

//forzar a descarga por el navegador
$objWriter->save('php://output');
