<?php

header('Content-Type: text/html; charset=ISO-8859-1');



/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";
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

$fechaInicial = $_GET["inicio"];
$fechaFinal = $_GET["fin"];

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
$objPHPExcel->getActiveSheet()->setTitle("PARAS -".$fecha);

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



// TITULO
$fila = 1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Tip. Doc');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Num Cta');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Cod Pago');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Doc Origen');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Fec Emi');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Fec Ven');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Monto');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Saldo');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'TC');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Ult. Pago');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Tip Mov');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Cod. Cli');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Doc. Cli');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Cliente');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'Vendedor');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'Notas');





#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
                          'A' AS orden,
                          '' AS tipo_doc,
                          '' AS num_cta,
                          '' AS cod_pago,
                          '' AS doc_origen,
                          DATE_SUB('$fechaInicial', INTERVAL 1 DAY) AS fecha,
                          DATE_SUB('$fechaInicial', INTERVAL 1 DAY) AS fecha_ven,
                          ROUND(SUM(cc.monto - IFNULL(c1.monto, 0)), 2) AS monto,
                          0 AS saldo,
                          '' AS tip_cambio,
                          '' AS ult_pago,
                          '' AS tip_mov,
                          cc.cliente AS cliente,
                          '' AS doc_cliente,
                          '' AS nombre,
                          '' AS vendedor,
                          '' AS notas 
                          FROM
                          cuenta_ctejf cc 
                          LEFT JOIN 
                            (SELECT 
                              cc.tipo_doc,
                              cc.num_cta,
                              SUM(cc.monto) AS monto 
                            FROM
                              cuenta_ctejf cc 
                            WHERE cc.tip_mov = '-' 
                              AND cc.fecha <= DATE_SUB('$fechaInicial', INTERVAL 1 DAY) 
                            GROUP BY cc.tipo_doc,
                              cc.num_cta) AS c1 
                            ON cc.tipo_doc = c1.tipo_doc 
                            AND cc.num_cta = c1.num_cta 
                          LEFT JOIN clientesjf AS c 
                            ON cc.cliente = c.codigo 
                          WHERE cc.tip_mov = '+' 
                          AND cc.fecha <= DATE_SUB('$fechaInicial', INTERVAL 1 DAY) 
                          GROUP BY c.codigo 
                          UNION
                          SELECT 
                          'B' AS orden,
                          cc.tipo_doc,
                          cc.num_cta,
                          cc.cod_pago,
                          cc.doc_origen,
                          cc.fecha,
                          cc.fecha_ven,
                          ROUND(cc.monto, 2) AS monto,
                          ROUND(cc.saldo, 2) AS saldo,
                          cc.tip_cambio,
                          cc.ult_pago,
                          cc.tip_mov,
                          cc.cliente,
                          c.documento AS doc_cliente,
                          c.nombre,
                          cc.vendedor,
                          cc.notas 
                          FROM
                          cuenta_ctejf cc 
                          LEFT JOIN clientesjf c 
                            ON cc.cliente = c.codigo 
                          WHERE cc.fecha >= DATE_SUB('$fechaInicial', INTERVAL 1 DAY) 
                          ORDER BY cliente,
                          orden,
                          tipo_doc,
                          num_cta,
                          fecha,
                          tip_mov") or die(mysql_error());


while($respDetalle = mysql_fetch_array($sqlDetalle)){

    $fila+=1;
    
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("A$fila", utf8_encode($respDetalle["tipo_doc"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", utf8_encode($respDetalle["num_cta"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("C$fila", utf8_encode($respDetalle["cod_pago"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("D$fila", utf8_encode($respDetalle["doc_origen"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", date("d/m/Y",strtotime($respDetalle['fecha']))); 
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", date("d/m/Y",strtotime($respDetalle['fecha_ven']))); 
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["monto"])); 
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["saldo"])); 
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["tip_cambio"])); 
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", date("d/m/Y",strtotime($respDetalle['ult_pago']))); 
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("K$fila", utf8_encode($respDetalle["tip_mov"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("L$fila", utf8_encode($respDetalle["cliente"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("M$fila", utf8_encode($respDetalle["doc_cliente"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["nombre"])); 
    $objPHPExcel->getActiveSheet()->setCellValueExplicit("O$fila", utf8_encode($respDetalle["vendedor"]), PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("P$fila", utf8_encode($respDetalle["notas"])); 

    


}

# Ajustar el tamaño de las columnas
/* $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14.28);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(21.42);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(11.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(11.43);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(50);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8.57); */

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
header('Content-Disposition: attachment; filename=" Estado Cta - '.$fechaInicial.'.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');