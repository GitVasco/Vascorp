<?php

header('Content-Type: text/html; charset=ISO-8859-1');

/* 
* RECIBIMOS VARIABLE DESDE LA VISTA
*/

$id = $_GET["codigo"];


/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";

/* 
* LLAMAMOS A LA CONEXION
*/
$conexion = mysql_connect("192.168.1.3", "jesus", "admin123") or die("No se pudo conectar: " . mysql_error());
mysql_select_db("new_vasco", $conexion);

/* 
* CONFIGURAMOS LA FECHA ACTUAL
*/
$fechaactual = getdate();
$fecha = "$fechaactual[mday]/$fechaactual[mon]/$fechaactual[year]";

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
$sqlHoja = mysql_query("SELECT 
                                CONCAT('OPERACION - ',modelo,' - MODELO') AS modelo
                                FROM
                                modelojf m
                                WHERE m.modelo= $id") or die(mysql_error());

$respHoja = mysql_fetch_array($sqlHoja);

$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

# Titulo de la hoja
$objPHPExcel->getActiveSheet()->setTitle($respHoja["modelo"]);

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

/* 
todo: INICIO CABECERA
*/

#query para sacar los datos de la cabecera
$sqlCabecera = mysql_query("SELECT 
                                    m.modelo,m.nombre,op.total_pd,op.total_ts,op.fecha_creacion
                                    FROM
                                    modelojf m 
                                    LEFT JOIN operacion_cabecerajf op
                                    ON m.modelo=op.articulo
                                    WHERE m.modelo = $id ") or die(mysql_error());

$respCabecera = mysql_fetch_array($sqlCabecera);

$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Corporación Vasco S.A.C');
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:M$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "K$fila:M$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$fila = 5 ;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MODELO:');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "B$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["modelo"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'NOMBRE:');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila:G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respCabecera["nombre"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "H$fila");

$fila = 6 ;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'FECHA:');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "B$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["fecha_creacion"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "D$fila");

$fila = 7 ;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Tiempo Estandar:');
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:C$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "B$fila:C$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respCabecera["total_ts"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "D$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Precio x Docena:');
$objPHPExcel->getActiveSheet()->mergeCells("F$fila:G$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila:G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respCabecera["total_pd"]));
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "H$fila");

/* 
todo: FIN CABECERA
*/
/* 
todo: INICIO DE DETALLE
*/

$fila = 9;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "E$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "G$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "H$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde1, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$fila = 10;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'N°');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'MODELO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'OPERACION');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'TIEMPO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'PRECIO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 11;
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'OPERACION');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", '');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'STANDARD');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'DOCENA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde3, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
                                    od.modelo,od.cod_operacion,od.precio_doc,od.tiempo_stand,o.nombre,o.codigo 
                                    FROM
                                    operaciones_detallejf od 
                                    LEFT JOIN operacionesjf o
                                    ON od.cod_operacion = o.codigo
                                    WHERE od.modelo = $id") or die(mysql_error());

$cont = 0;
while($respDetalle = mysql_fetch_array($sqlDetalle)){
    $cont+=1;

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $cont);
    

    
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["modelo"])); 
    

    
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("G$fila",utf8_encode($respDetalle["cod_operacion"]), PHPExcel_Cell_DataType::TYPE_STRING);
    

    
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["nombre"]));
    

    
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["tiempo_stand"]));
    
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["precio_doc"]));
    
    
    
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
}

# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(4.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.87);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(35.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12.29);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12.29);
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
$sqlArchivo = mysql_query("SELECT 
CONCAT('OPERACIONES - ',modelo,' - MODELO') AS modelo
FROM
modelojf m
WHERE m.modelo= $id") or die(mysql_error());

$respArchivo = mysql_fetch_array($sqlArchivo);


# Nombre del archivo
header('Content-Disposition: attachment; filename="' . $respArchivo["modelo"] . '.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');