<?php

header('Content-Type: text/html; charset=ISO-8859-1');



/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";

/* 
* LLAMAMOS A LA CONEXION
*/
$conexion = mysql_connect("192.168.1.8", "jesus", "admin123") or die("No se pudo conectar: " . mysql_error());
mysql_select_db("new_vasco", $conexion);

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
* INICIO DE ESTILOS
*/

#negrita subrayado T-11
$texto1 = new PHPExcel_Style();
$texto1->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>true,
      'size' => 11
    )
));

#negrita T-11
$texto2 = new PHPExcel_Style();
$texto2->applyFromArray(
  array('alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' =>false,
      'size' => 11
    )
));
$texto3 = new PHPExcel_Style();
$texto3->applyFromArray(
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

#bordes grueso: izquierda-arriba-derecha, color  GRIS NEGRITA T11
$borde1 = new PHPExcel_Style();
$borde1->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes grueso: izquierda-derecha, color  GRIS NEGRITA T11
$borde2 = new PHPExcel_Style();
$borde2->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes grueso: izquierda-derecha-abajo, color  GRIS NEGRITA T11
$borde3 = new PHPExcel_Style();
$borde3->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes derecho delgado / borde izquiedo grueso / borde abajo delgado
$borde4 = new PHPExcel_Style();
$borde4->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => false,
      'size' => 10
    )
));

#bordes derecho delgado / borde izquiedo delgado / borde abajo delgado
$borde5 = new PHPExcel_Style();
$borde5->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    ),
      'font' => array(
      'bold' => false,
      'size' => 10
    )
));

#bordes derecho grueso / borde izquiedo delgado / borde abajo delgado
$borde6 = new PHPExcel_Style();
$borde6->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => false,
      'size' => 10
    )
));

#bordes grueso: izquierda-arriba-derecha, color  GRIS NEGRITA T11
$borde7 = new PHPExcel_Style();
$borde7->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
      'size' => 11
    )
));

#bordes grueso: ABAJO
$borde8 = new PHPExcel_Style();
$borde8->applyFromArray(
  array('borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
));

#bordes grueso: izquierda-derecha-abajo-arriba, color  GRIS NEGRITA T10
$borde9 = new PHPExcel_Style();
$borde9->applyFromArray(
  array('alignment' => array( 
      'wrap' => false,
      'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
    ),
    'fill' => array(
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('rgb' => 'D7DBDD')
    ),
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    ),
      'font' => array(
      'bold' => true,
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
$objPHPExcel->getActiveSheet()->setTitle("OPERACIONES GENERALES -".$fecha);

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
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TOTAL DE OPERACIONES POR MODELO');
$objPHPExcel->getActiveSheet()->mergeCells("G$fila:K$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "G$fila:K$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'fecha:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "L$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "M$fila");

/* 
todo: INICIO DE DETALLE
*/

$fila = 6;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'TOTAL');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'FECHA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$fila = 7;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'RESPONSABLE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'PRECIO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'TIEMPO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'DE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'OPERACIONES');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 8;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'DOCENA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'STANDARD');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'CREACIÓN');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
m.nombre as descripcion ,m.modelo,u.nombre as usuario,
DATE(o.fecha_creacion) as fecha,
CASE
  WHEN IFNULL(m.operaciones, 0 ) = 0 
  THEN 'PENDIENTE'
  ELSE 'COMPLETO' 
  END AS operaciones,
CASE 
  WHEN IFNULL(m.operaciones, 1 ) = 1 
  THEN o.total_pd
  ELSE '0' 
  END AS precio,
  CASE 
  WHEN IFNULL(m.operaciones, 1 ) = 1 
  THEN o.total_ts
  ELSE '0' 
  END AS tiempo
FROM
modelojf m 
LEFT JOIN operacion_cabecerajf o 
  ON m.modelo = o.articulo 
LEFT JOIN usuariosjf u 
  ON o.vendedor_fk = u.id 
WHERE m.estado= 'Activo' OR 'ACTIVO'") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $cont);
    
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["modelo"])); 
    
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["descripcion"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["usuario"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["precio"]));

    
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["tiempo"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["fecha"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["operaciones"]));
    
    
    
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "E$fila");
    $objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "F$fila");
    $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "G$fila");
    $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "H$fila");
    $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "I$fila");
    $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "J$fila");
    $objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde4, "K$fila");
    $objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "L$fila");
    $objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
}

# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(4.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30.87);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15.29);
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
header('Content-Disposition: attachment; filename=" OPERACIONES GENERALES - '.$fecha.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');