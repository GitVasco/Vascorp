<?php

session_start();

date_default_timezone_set('America/Lima'); // O la zona horaria que corresponda

//ajuntar la libreria excel
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../modelos/materiaprima.modelo.php";


$fin = $_GET['fin'];
// sacamos el año
$anio = substr($fin, 0, 4);

$materiaprima = ModeloMateriaPrima::mdlMPSaldos();

$stockInicial = ModeloMateriaPrima::mdlMPStockInicial($anio);

$ingresos = ModeloMateriaPrima::mdlMPIngresos($anio, $fin);

$ingresosOS = ModeloMateriaPrima::mdlMPIngresosOS($anio, $fin);

$salidas = ModeloMateriaPrima::mdlMPSalidas($anio, $fin);

$salidasOs = ModeloMateriaPrima::mdlMPSalidasOS($anio, $fin);

$resultadoFinal = [];

// Convertir los arrays de las otras consultas en arrays asociativos para un acceso rápido por codpro
$stockInicialMap = array_column($stockInicial, 'cantidad', 'codpro');
$ingresosMap = array_column($ingresos, 'cantidad', 'codpro');
$ingresosOSMap = array_column($ingresosOS, 'cantidad', 'codpro');
$salidasMap = array_column($salidas, 'cantidad', 'codpro');
$salidasOSMap = array_column($salidasOs, 'cantidad', 'codpro');

// Recorrer la lista de productos y combinar los datos
foreach ($materiaprima as $producto) {
    $codpro = $producto['codpro'];

    // Obtener los valores de stock inicial, ingresos, salidas, etc.
    $stockInicialValue = isset($stockInicialMap[$codpro]) ? $stockInicialMap[$codpro] : 0;
    $ingresosValue = isset($ingresosMap[$codpro]) ? $ingresosMap[$codpro] : 0;
    $ingresosOSValue = isset($ingresosOSMap[$codpro]) ? $ingresosOSMap[$codpro] : 0;
    $salidasValue = isset($salidasMap[$codpro]) ? $salidasMap[$codpro] : 0;
    $salidasOSValue = isset($salidasOSMap[$codpro]) ? $salidasOSMap[$codpro] : 0;

    // Calcular el saldo final
    $saldoFinal = $stockInicialValue + $ingresosValue + $ingresosOSValue - ($salidasValue + $salidasOSValue);

    // Crear un array por producto con la información base y agregar los datos de las otras consultas
    $resultadoFinal[] = [
        'codpro' => $codpro,
        'linea' => $producto['linea'],
        'codfab' => $producto['codfab'],
        'despro' => $producto['despro'],
        'stock' => $producto['stock'],
        'unidad' => $producto['unidad'],
        'color' => $producto['color'],
        'talla' => $producto['talla'],
        'fam' => $producto['fam'],
        'stockInicial' => $stockInicialValue,
        'ingresos' => $ingresosValue,
        'ingresosOS' => $ingresosOSValue,
        'salidas' => $salidasValue,
        'salidasOS' => $salidasOSValue,
        'saldoFinal' => $saldoFinal, // Añadir el saldo final al array
    ];
}


//var_dump($articulos);

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Vasco"); //autor
$objPHPExcel->getProperties()->setTitle("Saldos Materia Prima"); //titulo

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
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Saldos a: ' . $fin);
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'CORPORACION VASCO S.A.C.');

$fila = 3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'CodPro');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Linea');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CodFab');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Descripcion');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Color');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Talla');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Und');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Stk Inicial');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Ingresos');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Ingresos OS');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Salidas');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Salidas OS');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Saldo');

foreach ($resultadoFinal as $resultado) {
    $fila += 1;

    $objPHPExcel->getActiveSheet()->setCellValueExplicit("A$fila", $resultado['codpro'], PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $resultado['linea']);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resultado['codfab']);
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $resultado['despro']);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $resultado['color']);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $resultado['talla']);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $resultado['unidad']);
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $resultado['stockInicial']);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $resultado['ingresos']);
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $resultado['ingresosOS']);
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $resultado['salidas']);
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $resultado['salidasOS']);
    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $resultado['saldoFinal']);
}


$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo
header('Content-Disposition: attachment; filename="Saldos MP a ' . $fecha . '.xls"');

//forzar a descarga por el navegador
$objWriter->save('php://output');
