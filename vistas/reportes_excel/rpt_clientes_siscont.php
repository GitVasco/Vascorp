<?php

header('Content-Type: text/html; charset=ISO-8859-1');

/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

/* 
* LLAMAMOS A LA CONEXION
*/
$con = ControladorUsuarios::ctrMostrarConexiones("id", 1);

$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
mysql_select_db($con["db"], $conexion);

/* 
* CONFIGURAMOS LA FECHA ACTUAL
*/
date_default_timezone_set('America/Lima');
$fechaactual = getdate();

$fecha = date("d-m-Y");

/* 
* INSTANCIAMOS
*/
$objPHPExcel = new PHPExcel();

/* 
* CONFIGURAMOS AL CREADOR DEL ARCHIVO
*/
$objPHPExcel->getProperties()->setCreator("Corp. Vasco"); //autor
$objPHPExcel->getProperties()->setTitle("00000020"); //titulo

/* 
* CONFIGURAMOS LA 1ERA HOJA
*/
$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle("Hoja 1");

# Orientacion hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_PORTRAIT);

# Tipo Papel
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

# Establecer impresion a pagina completa
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

# Establecer margenes
$marginV = 0.2; // 1 centimetros

$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginV * 2);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);

$fila = 1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Codigo');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Tipo Cod.Trib.');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Cod.Tributario');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Razon Social');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '1er Nombre');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '2do Nombre');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '1er Apellido');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '2do Apellido');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Tipo 1/.../9');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Atencion');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Direccion');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Telefono');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Dias Vencimiento');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Aval RUC');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Aval Nombre ');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Aval Telefono');
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'Aval Direccion');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'Cobrador');
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'Zona');

#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
                    c.documento,
                    c.tipo_documento,
                    c.documento,
                    c.nombre,
                    SUBSTRING_INDEX(c.nombres, ' ', 1) AS nombre1,
                    '' AS nombre2,
                    c.ape_paterno,
                    c.ape_materno,
                    '2' AS tipoS 
                    FROM
                    clientesjf c 
                    WHERE c.siscont = '0' 
                    AND c.nombre NOT LIKE '%TALLER%'") or die(mysql_error());


while ($respDetalle = mysql_fetch_array($sqlDetalle)) {

    $fila += 1;
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("A$fila", $respDetalle["documento"], PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["tipo_documento"]));

    $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", $respDetalle["documento"], PHPExcel_Cell_DataType::TYPE_STRING);

    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["nombre"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["nombre1"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["ape_paterno"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["ape_materno"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["tipoS"]));
}

/* 
* CREAR EL ARCHIVO
*/
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo


//* Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

//* CONFIGURAR EL NOMBRE DEL ARCHIVO
# Nombre del archivo
header('Content-Disposition: attachment; filename="pc.xlsx"');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


//forzar a descarga por el navegador
$objWriter->save('php://output');


#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("UPDATE 
clientesjf 
SET
siscont = 2") or die(mysql_error());
