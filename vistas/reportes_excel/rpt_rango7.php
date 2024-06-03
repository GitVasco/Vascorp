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
* INICIO DE ESTILOS
*/

#negrita subrayado T-11
$texto1 = new PHPExcel_Style();
$texto1->applyFromArray(
  array(
    'alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' => true,
      'size' => 11
    )
  )
);

#negrita T-11
$texto2 = new PHPExcel_Style();
$texto2->applyFromArray(
  array(
    'alignment' => array(
      'wrap' => false
    ),
    'font' => array(
      'bold' => true,
      'underline' => false,
      'size' => 11
    )
  )
);
$texto3 = new PHPExcel_Style();
$texto3->applyFromArray(
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

#bordes grueso: izquierda-arriba-derecha, color  GRIS NEGRITA T11
$borde1 = new PHPExcel_Style();
$borde1->applyFromArray(
  array(
    'alignment' => array(
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
  )
);

#bordes grueso: izquierda-derecha, color  GRIS NEGRITA T11
$borde2 = new PHPExcel_Style();
$borde2->applyFromArray(
  array(
    'alignment' => array(
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
  )
);

#bordes grueso: izquierda-derecha-abajo, color  GRIS NEGRITA T11
$borde3 = new PHPExcel_Style();
$borde3->applyFromArray(
  array(
    'alignment' => array(
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
  )
);

#bordes derecho delgado / borde izquiedo grueso / borde abajo delgado
$borde4 = new PHPExcel_Style();
$borde4->applyFromArray(
  array(
    'alignment' => array(
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
  )
);

#bordes derecho delgado / borde izquiedo delgado / borde abajo delgado
$borde5 = new PHPExcel_Style();
$borde5->applyFromArray(
  array(
    'alignment' => array(
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
  )
);

#bordes derecho grueso / borde izquiedo delgado / borde abajo delgado
$borde6 = new PHPExcel_Style();
$borde6->applyFromArray(
  array(
    'alignment' => array(
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
  )
);

#bordes grueso: izquierda-arriba-derecha, color  GRIS NEGRITA T11
$borde7 = new PHPExcel_Style();
$borde7->applyFromArray(
  array(
    'alignment' => array(
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
  )
);

#bordes grueso: ABAJO
$borde8 = new PHPExcel_Style();
$borde8->applyFromArray(
  array(
    'borders' => array(
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
  )
);

#bordes grueso: izquierda-derecha-abajo-arriba, color  GRIS NEGRITA T10
$borde9 = new PHPExcel_Style();
$borde9->applyFromArray(
  array(
    'alignment' => array(
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
$objPHPExcel->getActiveSheet()->setTitle("180 dias");

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
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// TITULO
$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'CUENTAS VENCIDAS - 181 DÍAS +');
$objPHPExcel->getActiveSheet()->mergeCells("D$fila:H$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "D$fila:H$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/* $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'fecha:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto1, "F$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "G$fila"); */


$fila = 4;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Tip Doc');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Documento');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Fec. Emi');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'Fec. Ven');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Monto');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'Saldo');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'Cod Cliente');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Cliente');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Ult. Pago');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Cod. Ven');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Vendedor');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'Ubigeo');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'Atraso');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'Obser.');
/* $objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
                            cc.tipo_doc,
                            cc.num_cta,
                            cc.fecha,
                            cc.fecha_ven,
                            cc.monto,
                            cc.saldo,
                            cc.ult_pago,
                            cc.cliente,
                            c.nombre,
                            c.ubigeo,
                            (SELECT 
                            nombre 
                            FROM
                            ubigeo u 
                            WHERE c.ubigeo = u.codigo) AS nom_ubigeo,
                            cc.vendedor,
                            (SELECT 
                            descripcion 
                            FROM
                            maestrajf m 
                            WHERE m.tipo_dato = 'TVEND' 
                            AND cc.vendedor = m.codigo) AS nom_vendedor,
                            TIMESTAMPDIFF(DAY, cc.fecha_ven, NOW()) AS atraso,
                            CASE
                            WHEN cc.vendedor IN (
                                '00A',
                                '01',
                                '02A',
                                '03',
                                '05A',
                                '07A',
                                '14',
                                '15'
                            ) 
                            THEN 'INCOBRABLE' 
                            ELSE '' 
                            END AS observacion 
                            FROM
                            cuenta_ctejf cc 
                            LEFT JOIN clientesjf c 
                            ON cc.cliente = c.codigo 
                            WHERE cc.tip_mov = '+' 
                            AND cc.estado = 'Pendiente' 
                            AND TIMESTAMPDIFF(DAY, cc.fecha_ven, NOW()) > 180 
                            ORDER BY cc.vendedor,
                            cc.cliente,
                            cc.fecha_ven") or die(mysql_error());


while ($respDetalle = mysql_fetch_array($sqlDetalle)) {

  $fila += 1;

  $objPHPExcel->getActiveSheet()->setCellValueExplicit("A$fila", utf8_encode($respDetalle["tipo_doc"]), PHPExcel_Cell_DataType::TYPE_STRING);

  $objPHPExcel->getActiveSheet()->setCellValueExplicit("B$fila", utf8_encode($respDetalle["num_cta"]), PHPExcel_Cell_DataType::TYPE_STRING);

  #$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($respDetalle["tipo_doc"])); 
  #$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["num_cta"])); 

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["fecha"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["fecha_ven"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["monto"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($respDetalle["saldo"]));

  $objPHPExcel->getActiveSheet()->setCellValueExplicit("G$fila", utf8_encode($respDetalle["cliente"]), PHPExcel_Cell_DataType::TYPE_STRING);

  #$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($respDetalle["cliente"])); 
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($respDetalle["nombre"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($respDetalle["ult_pago"]));

  $objPHPExcel->getActiveSheet()->setCellValueExplicit("J$fila", utf8_encode($respDetalle["vendedor"]), PHPExcel_Cell_DataType::TYPE_STRING);

  #$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($respDetalle["vendedor"])); 
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($respDetalle["nom_vendedor"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($respDetalle["nom_ubigeo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($respDetalle["atraso"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($respDetalle["observacion"]));
}

# Ajustar el tamaño de las columnas
/* $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25.72); */
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
header('Content-Disposition: attachment; filename="180 dias.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');
