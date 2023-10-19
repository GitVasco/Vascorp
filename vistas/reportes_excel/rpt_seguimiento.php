<?php

header('Content-Type: text/html; charset=ISO-8859-1');



/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
include "../reportes_excel/estilos.php";
require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";
/* 
* LLAMAMOS A LA CONEXION
*/
$con = ControladorUsuarios::ctrMostrarConexiones("id", 1);

//* CONFIGURAMOS LA FECHA ACTUAL
date_default_timezone_set('America/Lima');
$fechaactual = getdate();

$fecha = date("d-m-Y");


//* INSTANCIAMOS
$objPHPExcel = new PHPExcel();

//* CONFIGURAMOS AL CREADOR DEL ARCHIVO
$objPHPExcel->getProperties()->setCreator("Corp. Vasco"); //autor
$objPHPExcel->getProperties()->setTitle("00000020"); //titulo

//* CONFIGURAMOS LA 1ERA HOJA
$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Seguimiento -" . $fecha);

# Orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

# Tipo Papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

# Establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

# Establecer margenes
$marginV = 0.5 / 3.54; // 0.5 centimetros

$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($marginV);


# Incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyform_letras.png'); //ruta
$objDrawing->setWidthAndHeight(200, 150);
$objDrawing->setCoordinates('B1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// TITULO
$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Seguimiento de articulos');
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:E$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "D$fila:E$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'fecha:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "G$fila");


$fila = 7;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Modelo');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Nombre');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Cod. Color');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Color');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Cod. Talla');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Talla');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Estado');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Proyección');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '% Avance');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Stock');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Pedidos');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'En Taller');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'En Servicio');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Alm. Corte');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Ord. Corte');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "O$fila");
$objPHPExcel->getActiveSheet()->getStyle("O$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Ult 30d');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "P$fila");
$objPHPExcel->getActiveSheet()->getStyle("P$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Duración Mes');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "Q$fila");
$objPHPExcel->getActiveSheet()->getStyle("Q$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'Und. Faltantes');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "R$fila");
$objPHPExcel->getActiveSheet()->getStyle("R$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'MP Faltante');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "S$fila");
$objPHPExcel->getActiveSheet()->getStyle("S$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'Articulo');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "T$fila");
$objPHPExcel->getActiveSheet()->getStyle("T$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$consulta = ModeloArticulos::mdlMostrarSeguimiento("null");

$fila = 8;
foreach ($consulta as $key => $value) {
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("A$fila", $value["modelo"], PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $value["nombre"]);

    $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", $value["cod_color"], PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $value["color"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $value["cod_talla"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $value["talla"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $value["estado"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $value["proyeccion"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $value["avance"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $value["stockB"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $value["pedidos"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $value["taller"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $value["servicio"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $value["alm_corte"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("O$fila", $value["ord_corte"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", $value["ult_mes"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $value["dura_tc"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("R$fila", $value["faltantes"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $value["mp_faltante"]);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("T$fila", $value["articulo"], PHPExcel_Cell_DataType::TYPE_STRING);

    $fila += 1;
}


//* CREAR EL ARCHIVO
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

//* Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

//* Nombre del archivo
header('Content-Disposition: attachment; filename=" Seguimiento - ' . $fecha . '.xls"');

//* forzar a descarga por el navegador
$objWriter->save('php://output');
