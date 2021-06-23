<?php

session_start();

//ajuntar la libreria excel
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

require_once "../../controladores/orden-compra.controlador.php";
require_once "../../modelos/orden-compra.modelo.php";

$inicio = $_GET["inicio"];
$fin=$_GET["fin"];

/* 
* LLAMAMOS A LA CONEXION
*/
$con=ControladorUsuarios::ctrMostrarConexiones("id",1);

$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
mysql_select_db($con["db"], $conexion); 


//fechaactual
$fecha=date("d/m/Y");

$UsuReg=$_SESSION['nombre'];



$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Kiuvox"); //autor
$objPHPExcel->getProperties()->setTitle("E - Reporte de OC General"); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 20
    )
));
 
$subtitulo = new PHPExcel_Style(); //nuevo estilo
 
$subtitulo->applyFromArray(
  array('fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'FF3399FF')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));
 
$bordes = new PHPExcel_Style(); //nuevo estilo
 
$bordes->applyFromArray(
  array('borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
));
//fin estilos
 
$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Reporte de OC General"); //establecer titulo de hoja
 
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
 

 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Empresa:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CORPORACION VASCO S.A.C.');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'Fecha:');
if($inicio == null){
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $fecha);
}else {
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $inicio." / " .$fin);
  $objPHPExcel->getActiveSheet()->mergeCells("L$fila:N$fila"); //unir celdas
}





$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Local:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '.:: CORPORACION VASCO S.A.C. ::.');
// $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Hora:');
// $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $hora);


$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Usuario:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $UsuReg);  


$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DETALLADO DE ORDENES DE COMPRA");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila"); //establecer estilo
 
//titulos de columnas
$fila+=1;

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'NRO.OC');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'FEC.EMISION');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'FEC.ENTREGA');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'PROVEEDOR');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'COD.FABRICA');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'UND');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'CAN.PEDIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'CAN.RECIBIDA');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'SALDO');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:N$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:N$fila")->getFont()->setBold(true); //negrita


//rellenar con contenido

$ordencompra=ControladorOrdenCompra::ctrReporteFechasOrdenCompraGeneral($inicio,$fin); 

        
foreach($ordencompra as $res){    
    $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getNumberFormat()->setFormatCode('000000'); 
  $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getNumberFormat()->setFormatCode('00000'); 
  $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getNumberFormat()->setFormatCode('000000'); 
  $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getNumberFormat()->setFormatCode('00000'); 


  $CodPro=$res["CodPro"]; 
  

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["CodPro"]);
 
  

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["nro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["fecemi"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["fecllegada"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["razpro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["codpro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["codfab"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["despro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["cantidad_pedida"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["cantidad_recibida"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["saldo"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", utf8_encode($res["estado"]));
  

  //Establecer estilo
  $objPHPExcel->getActiveSheet() ->setSharedStyle($bordes, "B$fila:N$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila") ->getNumberFormat()->setFormatCode('000000');
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila") ->getNumberFormat()->setFormatCode('00000');  
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("L$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);   
  $objPHPExcel->getActiveSheet() ->getStyle("M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
  $objPHPExcel->getActiveSheet() ->getStyle("N$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
 

 }
 
//insertar formula
// $fila+=2;
// $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'SUMA');
// $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '=1+2');
 
//recorrer las columnas
// foreach (range( 'C', 'D' , 'E' , 'F' , 'G' , 'H' , 'I' , 'J', 'K') as $columnID) {
//   //autodimensionar las columnas
//   $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
// }
 



  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(50);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);



//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_OCGeneral.xls"');
//**********************************************************************
 
//****************Guardar como excel 2007*******************************
//$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); //Escribir archivo
//
//// Establecer formado de Excel 2007
//header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//
//// nombre del archivo
//header('Content-Disposition: attachment; filename="kiuvox.xlsx"');
//**********************************************************************
 
//forzar a descarga por el navegador
$objWriter->save('php://output');