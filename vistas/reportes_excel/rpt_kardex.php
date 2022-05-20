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
$con=ControladorUsuarios::ctrMostrarConexiones("id",1);

$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
mysql_select_db($con["db"], $conexion);

/* 
* CONFIGURAMOS LA FECHA ACTUAL
*/
date_default_timezone_set('America/Lima');
$fechaactual = getdate();

$fecha = date("d-m-Y");

$codigo= $_GET["codigo"];
$anno= $_GET["anno"];
$mes= $_GET["mes"];

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
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'color' => array('rgb' => 'FF0008'),
      'underline' =>true,
      'size' => 13
    )
));

#negrita-11-negro
$texto_2 = new PHPExcel_Style();
$texto_2->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 10
    )
));

#normal-10
$texto_3 = new PHPExcel_Style();
$texto_3->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => false,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 10
    )
));

#normal-11-azul
$texto_4 = new PHPExcel_Style();
$texto_4->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '0400FF'),
      'size' => 11
    )
));

#negrita-11-rojo
$borde_1 = new PHPExcel_Style();
$borde_1->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => 'FF0008'),
      'size' => 8
    )
));

#negrita-11-azul
$borde_2 = new PHPExcel_Style();
$borde_2->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => '0400FF'),
      'size' => 8
    )
));

#negrita-11-negro
$borde_3 = new PHPExcel_Style();
$borde_3->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 10
    )
));

#negrita-11-celeste
$borde_4 = new PHPExcel_Style();
$borde_4->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => '0174BB'),
      'size' => 8
    )
));

#negrita-11-verde
$borde_5 = new PHPExcel_Style();
$borde_5->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => '00833E'),
      'size' => 8
    )
));

#normal-10-negro
$borde_6 = new PHPExcel_Style();
$borde_6->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 11
    )
));

#negrita-10-vino
$borde_7 = new PHPExcel_Style();
$borde_7->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => 'A4001E'),
      'size' => 8
    )
));

#negrita-10-rojo/rosado
$borde_8 = new PHPExcel_Style();
$borde_8->applyFromArray(
  array('alignment' => array(
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
      'underline' =>false,
      'color' => array('rgb' => 'FF0008'),
      'size' => 8
    )
));

//TODO: MARCOS
#negrita-11-negro
$borde_3A = new PHPExcel_Style();
$borde_3A->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 9.5
    )
));

$borde_3B = new PHPExcel_Style();
$borde_3B->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 10
    )
));

$borde_3C = new PHPExcel_Style();
$borde_3C->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 10
    )
));

$borde_3D = new PHPExcel_Style();
$borde_3D->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'borders' => array(
        'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
		'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'color' => array('rgb' => '000000'),
      'size' => 10
    )
));

/* 
* FIN DE ESTILOS
*/


/* 
* CONFIGURAMOS LA 1ERA HOJA
*/
$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle($codigo. " -".$fecha);

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
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginV*2);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0);

//establecer titulos de impresion en cada hoja
//$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 4);
$fila = 1;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

$item = ControladorCentroCostos::ctrVerItems($codigo);

for ($i=0; $i < count($item) ; $i++) { 

	$fila += 1;
	$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

	$objPHPExcel->getActiveSheet()->mergeCells("A$fila:N$fila");
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "A$fila:N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'FORMATO  13.1      "REGISTRO  DEL  INVENTARIO  PERMANENTE  VALORIZADO  -  DETALLE  DEL  INVENTARIO  VALORIZADO"');
    $objPHPExcel->getActiveSheet()->mergeCells("B$fila:M$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "B$fila:M$fila");
    $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     PERIODO');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", strtoupper($mes).' '.$anno);
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     RUC');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $objPHPExcel->getActiveSheet()->setCellValueExplicit("H$fila", "20513613939", PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     APELLIDOS Y NOMBRES ,DENOMINACIÓN  Y/O  RAZÓN SOCIAL');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'CORPORACION VASCO S.A.C.');
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     ESTABLECIMIENTO(1)');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

	if(substr($codigo, 0, 3) == "APT"){
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '003 ALMACEN PRODUCTO TERMINADO');
		$objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   
	}else if(substr($codigo, 0, 3) == "AMP"){
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '001  ALMACEN GENERAL');
		$objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   
	}else{
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '002 ALMACEN PRODUCTO EN PROCESO');
		$objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   
	}

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     CÓDIGO DE  LA EXISTENCIAS');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $objPHPExcel->getActiveSheet()->setCellValueExplicit("H$fila", utf8_decode($item[$i]["item"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");    

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     TIPO  (TABLA 5)');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

	if(substr($codigo, 0, 3) == "APT"){
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '02 PRODUCTO TERMINADO');
		$objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   
	}else if(substr($codigo, 0, 3) == "AMP"){
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '03 MATERIAS PRIMAS Y AUXILIARES - MATERIALES');
		$objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   
	}else{
		$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '99 PRODUCTO EN PROCESO');
		$objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   
	}	

    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '03 MATERIAS PRIMAS Y AUXILIARES - MATERIALES');
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");   

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     DESCRIPCIÓN');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $item[$i]["descripcion"]);
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");  

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     CÓDIGO DE LA  UNIDAD  DE MEDIDA (TABLA 6)');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

    $objPHPExcel->getActiveSheet()->setCellValueExplicit("H$fila", utf8_decode($item[$i]["cod_unidad"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");      

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");


    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '     MÉTODO DE  VALUACIÓN');
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '     :');
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
	
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'PROMEDIO  PONDERADO MÓVIL');
    $objPHPExcel->getActiveSheet()->setSharedStyle($texto_3, "H$fila");  
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

	$fila += 1;
	$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3C, "A$fila");
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3B, "N$fila");

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'DOCUMENTO  DE TRASLADO , COMPROBANTE');
	$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila");
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "A$fila:D$fila");

    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'TIPO DE');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "E$fila");
	$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'ENTRADA');
	$objPHPExcel->getActiveSheet()->mergeCells("F$fila:H$fila");
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "F$fila:H$fila");
    $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    
	$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'SALIDA');
	$objPHPExcel->getActiveSheet()->mergeCells("I$fila:K$fila");
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "I$fila:K$fila");
    $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'SALDO INCIAL');
	$objPHPExcel->getActiveSheet()->mergeCells("L$fila:N$fila");
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "L$fila:N$fila");
    $objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);
	
	$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'DE PAGO,  DOCUMENTO INTERNO  O SIMILAR');
	$objPHPExcel->getActiveSheet()->mergeCells("A$fila:D$fila");
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "A$fila:D$fila");

	$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'OPERA');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "E$fila");
	$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

	$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'CANTIDAD');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "F$fila");
	$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'COSTO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "G$fila");
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'COSTO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "H$fila");
	$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'CANTIDAD');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "I$fila");
	$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'COSTO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "J$fila");
	$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'COSTO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "K$fila");
	$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'CANTIDAD');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "L$fila");
	$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'COSTO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "M$fila");
	$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'COSTO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "N$fila");
	$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$fila += 1;
    $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

	$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'FECHA');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "A$fila");
	$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TIPO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "B$fila");
	$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'SERIE');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "C$fila");
	$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NÚMERO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3A, "D$fila");
	$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'CIÓN');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "E$fila");
	$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "F$fila");
	$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'UNITARIO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "G$fila");
	$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'TOTAL');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "H$fila");
	$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "I$fila");
	$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'UNITARIO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "J$fila");
	$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'TOTAL');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "K$fila");
	$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "L$fila");
	$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'UNITARIO');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "M$fila");
	$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

	$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'TOTAL');
	$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3D, "N$fila");
	$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
	

    $detalle = ControladorCentroCostos::ctrVerItemsDet($codigo, $item[$i]["item"]);

    for ($j=0; $j < count($detalle); $j++) { 

        $fila += 1;
        $objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(12.01);

        $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $detalle[$j]["fecha"]);
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "A$fila");

		$objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", utf8_decode($detalle[$j]["t_tabla"]), PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "B$fila");

		$objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", utf8_decode($detalle[$j]["establecimiento"]), PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "C$fila");

		$objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", utf8_decode($detalle[$j]["num_documento"]), PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "D$fila");

		$objPHPExcel->getActiveSheet()->setCellValueExplicit("E$fila", utf8_decode($detalle[$j]["ctm"]), PHPExcel_Cell_DataType::TYPE_STRING);
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "E$fila");
		$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	

		//*montos en cero
		if($detalle[$j]["cantidad_a"] == 0){

			$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_a"] > 0 && $detalle[$j]["cantidad_a"] < 1){

			$cantidad_a = $detalle[$j]["cantidad_a"];
			$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $cantidad_a);

			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_a"] >= 1 && $detalle[$j]["cantidad_a"] < 1000){

			$cantidad_a = $detalle[$j]["cantidad_a"];

			$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $cantidad_a);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_a"] >= 1000 && $detalle[$j]["cantidad_a"]< 1000000){

			$cantidad_a = $detalle[$j]["cantidad_a"];
			$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $cantidad_a);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}

		
		if($detalle[$j]["pu_a"] <= 0){

			$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_a"] > 0 && $detalle[$j]["pu_a"] < 1){

			$pu_a = $detalle[$j]["pu_a"];
			$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $pu_a);

			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_a"] >= 1 && $detalle[$j]["pu_a"] < 1000){

			$pu_a = $detalle[$j]["pu_a"];

			$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $pu_a);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_a"] >= 1000 && $detalle[$j]["pu_a"]< 1000000){

			$pu_a = $detalle[$j]["pu_a"];
			$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $pu_a);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}


		if($detalle[$j]["total_a"] <= 0){

			$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_a"] > 0 && $detalle[$j]["total_a"] < 1){

			$total_a = $detalle[$j]["total_a"];
			$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $total_a);

			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_a"] >= 1 && $detalle[$j]["total_a"] < 1000){

			$total_a = $detalle[$j]["total_a"];

			$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $total_a);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_a"] >= 1000 && $detalle[$j]["total_a"]< 1000000){

			$total_a = $detalle[$j]["total_a"];
			$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $total_a);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}		

		if($detalle[$j]["cantidad_b"] <= 0){

			$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_b"] > 0 && $detalle[$j]["cantidad_b"] < 1){

			$cantidad_b = $detalle[$j]["cantidad_b"];
			$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $cantidad_b);

			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_b"] >= 1 && $detalle[$j]["cantidad_b"] < 1000){

			$cantidad_b = $detalle[$j]["cantidad_b"];

			$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $cantidad_b);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_b"] >= 1000 && $detalle[$j]["cantidad_b"]< 1000000){

			$cantidad_b = $detalle[$j]["cantidad_b"];
			$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $cantidad_b);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}	

		if($detalle[$j]["pu_b"] <= 0){

			$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_b"] > 0 && $detalle[$j]["pu_b"] < 1){

			$pu_b = $detalle[$j]["pu_b"];
			$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $pu_b);

			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_b"] >= 1 && $detalle[$j]["pu_b"] < 1000){

			$pu_b = $detalle[$j]["pu_b"];

			$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $pu_b);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_b"] >= 1000 && $detalle[$j]["pu_b"]< 1000000){

			$pu_b = $detalle[$j]["pu_b"];
			$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $pu_b);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}	
        

		if($detalle[$j]["total_b"] <= 0){

			$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_b"] > 0 && $detalle[$j]["total_b"] < 1){

			$total_b = $detalle[$j]["total_b"];
			$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $total_b);

			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_b"] >= 1 && $detalle[$j]["total_b"] < 1000){

			$total_b = $detalle[$j]["total_b"];

			$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $total_b);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_b"] >= 1000 && $detalle[$j]["total_b"]< 1000000){

			$total_b = $detalle[$j]["total_b"];
			$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $total_b);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}	


		if($detalle[$j]["cantidad_c"] <= 0){

			if ($detalle[$j]["ctm"] == "TOTAL") {

				$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 0);
				$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getNumberFormat()->setFormatCode ("0.00");

			}else{
			
				$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');

			}

			//$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_c"] > 0 && $detalle[$j]["cantidad_c"] < 1){

			$cantidad_c = $detalle[$j]["cantidad_c"];
			$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $cantidad_c);

			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_c"] >= 1 && $detalle[$j]["cantidad_c"] < 1000){

			$cantidad_c = $detalle[$j]["cantidad_c"];

			$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $cantidad_c);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["cantidad_c"] >= 1000 && $detalle[$j]["cantidad_c"]< 1000000){

			$cantidad_c = $detalle[$j]["cantidad_c"];
			$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $cantidad_c);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}	

		if($detalle[$j]["pu_c"] <= 0){

			$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", '');

			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_c"] > 0 && $detalle[$j]["pu_c"] < 1){

			$pu_c = $detalle[$j]["pu_c"];
			$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $pu_c);

			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_c"] >= 1 && $detalle[$j]["pu_c"] < 1000){

			$pu_c = $detalle[$j]["pu_c"];

			$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $pu_c);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["pu_c"] >= 1000 && $detalle[$j]["pu_c"]< 1000000){

			$pu_c = $detalle[$j]["pu_c"];
			$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $pu_c);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}		

		if($detalle[$j]["total_c"] <= 0){

			if ($detalle[$j]["ctm"] == "TOTAL") {

				$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 0);
				$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getNumberFormat()->setFormatCode ("0.00");

			}else{
			
				$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", '');

			}

			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_c"] > 0 && $detalle[$j]["total_c"] < 1){

			$total_c = $detalle[$j]["total_c"];
			$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $total_c);

			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_c"] >= 1 && $detalle[$j]["total_c"] < 1000){

			$total_c = $detalle[$j]["total_c"];

			$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $total_c);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getNumberFormat()->setFormatCode ("0.00");

			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}else if($detalle[$j]["total_c"] >= 1000 && $detalle[$j]["total_c"]< 1000000){

			$total_c = $detalle[$j]["total_c"];
			$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $total_c);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getNumberFormat()->setFormatCode ("0,000.00");

			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
			$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

		}


    }

    $fila += 1;

}






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
header('Content-Disposition: attachment; filename=" Kardex - '.$codigo.'.xlsx"');
$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');


//forzar a descarga por el navegador
$objWriter->save('php://output');