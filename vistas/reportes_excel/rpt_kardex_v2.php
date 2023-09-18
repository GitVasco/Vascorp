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

$codigo = $_GET["codigo"];
$anno = $_GET["anno"];
$mes = $_GET["mes"];

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
* INICIO DE ESTILOS
*/
#negrita-subrayado-13-rojo
$texto_1 = new PHPExcel_Style();
$texto_1->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'font' => array(
			'bold' => true,
			'color' => array('rgb' => 'FF0008'),
			'underline' => true,
			'size' => 13
		)
	)
);

#negrita-11-negro
$texto_2 = new PHPExcel_Style();
$texto_2->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 10
		)
	)
);

#normal-10
$texto_3 = new PHPExcel_Style();
$texto_3->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'font' => array(
			'bold' => false,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 10
		)
	)
);

#normal-11-azul
$texto_4 = new PHPExcel_Style();
$texto_4->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '0400FF'),
			'size' => 11
		)
	)
);

#negrita-11-rojo
$borde_1 = new PHPExcel_Style();
$borde_1->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => 'FF0008'),
			'size' => 8
		)
	)
);

#negrita-11-azul
$borde_2 = new PHPExcel_Style();
$borde_2->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '0400FF'),
			'size' => 8
		)
	)
);

#negrita-11-negro
$borde_3 = new PHPExcel_Style();
$borde_3->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 10
		)
	)
);

#negrita-11-celeste
$borde_4 = new PHPExcel_Style();
$borde_4->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '0174BB'),
			'size' => 8
		)
	)
);

#negrita-11-verde
$borde_5 = new PHPExcel_Style();
$borde_5->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '00833E'),
			'size' => 8
		)
	)
);

#normal-10-negro
$borde_6 = new PHPExcel_Style();
$borde_6->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => false,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 11
		)
	)
);

#negrita-10-vino
$borde_7 = new PHPExcel_Style();
$borde_7->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => 'A4001E'),
			'size' => 8
		)
	)
);

#negrita-10-rojo/rosado
$borde_8 = new PHPExcel_Style();
$borde_8->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'fill' => array(
			'type' => PHPExcel_Style_Fill::FILL_SOLID,
			'color' => array('rgb' => 'EEABAB')
		),
		'borders' => array(
			'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => 'FF0008'),
			'size' => 8
		)
	)
);

//TODO: MARCOS
#negrita-11-negro
$borde_3A = new PHPExcel_Style();
$borde_3A->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 9.5
		)
	)
);

$borde_3B = new PHPExcel_Style();
$borde_3B->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 10
		)
	)
);

$borde_3C = new PHPExcel_Style();
$borde_3C->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 10
		)
	)
);

$borde_3D = new PHPExcel_Style();
$borde_3D->applyFromArray(
	array(
		'alignment' => array(
			'wrap' => false
		),
		'borders' => array(
			'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
			'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
		),
		'font' => array(
			'bold' => true,
			'underline' => false,
			'color' => array('rgb' => '000000'),
			'size' => 10
		)
	)
);

/* 
* FIN DE ESTILOS
*/


/* 
* CONFIGURAMOS LA 1ERA HOJA
*/
$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle($codigo . " -" . $fecha);

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

//establecer titulos de impresion en cada hoja

function applyCellStyles($sheet, $column, $row, $style, $alignment = PHPExcel_Style_Alignment::HORIZONTAL_CENTER)
{
	$cellId = $column . $row;
	$sheet->SetCellValue($cellId, $column === "A" ? 'FECHA' : strtoupper($column));
	$sheet->setSharedStyle($style, $cellId);
	$sheet->getStyle($cellId)->getAlignment()->setHorizontal($alignment);
}

function populateData($sheet, $column, $row, $value, $dataType = PHPExcel_Cell_DataType::TYPE_STRING)
{
	$sheet->setCellValueExplicit($column . $row, $value, $dataType);
	applyBorderStyle($sheet, $column . $row);
}

$fila = 1;

$columnsHeaders = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N"];
$headerStyle = $borde_3A;
$detailStyle = $borde_3D;

foreach ($columnsHeaders as $column) {
	$sheet = $objPHPExcel->getActiveSheet();
	$sheet->getRowDimension($fila)->setRowHeight(12.01);
	applyCellStyles($sheet, $column, $fila, $headerStyle);
}

$detalle = ControladorCentroCostos::ctrVerItemsDet($codigo, $item[$i]["item"]);

foreach ($detalle as $detail) {
	$fila++;
	$sheet->getRowDimension($fila)->setRowHeight(12.01);
	$headerCols = ["A", "B", "C", "D", "E"];
	$values = [
		$detail["fecha"], utf8_decode($detail["t_tabla"]),
		utf8_decode($detail["establecimiento"]), utf8_decode($detail["num_documento"]),
		utf8_decode($detail["ctm"])
	];

	foreach ($headerCols as $index => $column) {
		populateData($sheet, $column, $fila, $values[$index]);
	}

	$sheet->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$columnData = [
		"F" => $detail["cantidad_a"],
		"G" => $detail["pu_a"],
		"H" => $detail["total_a"],
		"I" => $detail["cantidad_b"],
		"J" => $detail["pu_b"],
		"K" => $detail["total_b"],
		"L" => $detail["cantidad_c"],
		"M" => $detail["pu_c"],
		"N" => $detail["total_c"]
	];

	foreach ($columnData as $column => $value) {
		applyNumberFormat($sheet, $column . $fila, $value);
		applyBorderStyle($sheet, $column . $fila);
	}
}

$fila++;


# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(5.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(6.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(11.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10.71);


/* 
* CREAR EL ARCHIVO
*/
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

/* 
* Establecer formado de Excel 2003
*/
header("Content-Type: application/vnd.ms-excel");

/* 
* CONFIGURAR EL NOMBRE DEL ARCHIVO
*/



# Nombre del archivo
header('Content-Disposition: attachment; filename=" Kardex - ' . $codigo . '.xlsx"');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


//forzar a descarga por el navegador
$objWriter->save('php://output');

//**CABECERA */
function createRow($sheet, &$row, $height, $styles)
{
	$sheet->getActiveSheet()->getRowDimension($row)->setRowHeight($height);
	foreach ($styles as $range => $style) {
		$sheet->getActiveSheet()->setSharedStyle($style, str_replace('n', $row, $range));
	}
}

function createMergedCell($sheet, $cell, $value, $mergeRange, $style, $alignment = null)
{
	$sheet->getActiveSheet()->SetCellValue($cell, $value);
	$sheet->getActiveSheet()->mergeCells(str_replace('n', substr($cell, 1), $mergeRange));
	$sheet->getActiveSheet()->setSharedStyle($style, $cell);
	if ($alignment) {
		$sheet->getActiveSheet()->getStyle($cell)->getAlignment()->setHorizontal($alignment);
	}
}

function createLabelValuePair($sheet, &$row, $leftStyle, $rightStyle, $textStyle, $label, $value)
{
	$row += 1;
	createRow($sheet, $row, 12.01, ["An" => $leftStyle, "Hn" => $textStyle, "Nn" => $rightStyle]);
	$sheet->getActiveSheet()->SetCellValue("A$row", $label);
	$sheet->getActiveSheet()->SetCellValue("G$row", ':');
	$sheet->getActiveSheet()->getStyle("G$row")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	$sheet->getActiveSheet()->setCellValueExplicit("H$row", $value, PHPExcel_Cell_DataType::TYPE_STRING);
}

function getAlmacenName($codigo)
{
	switch ($codigo) {
		case "APT":
			return '02 PRODUCTO TERMINADO';
		case "AMP":
			return '03 MATERIAS PRIMAS Y AUXILIARES - MATERIALES';
		default:
			return '99 PRODUCTO EN PROCESO';
	}
}


//**DETALLE */
function applyNumberFormat($worksheet, $cell, $value)
{
	$worksheet->SetCellValue($cell, $value);
	if ($value < 1) {
		$worksheet->getStyle($cell)->getNumberFormat()->setFormatCode("0.00");
	} elseif ($value < 1000) {
		$worksheet->getStyle($cell)->getNumberFormat()->setFormatCode("0.00");
	} elseif ($value < 1000000) {
		$worksheet->getStyle($cell)->getNumberFormat()->setFormatCode("0,000.00");
	}
}

function applyBorderStyle($worksheet, $cell)
{
	$worksheet->getStyle($cell)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$worksheet->getStyle($cell)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$worksheet->getStyle($cell)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
	$worksheet->getStyle($cell)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
}
