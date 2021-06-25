<?php
session_start();

 //ajuntar la libreria excel
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

/* 
* LLAMAMOS A LA CONEXION
*/
$con=ControladorUsuarios::ctrMostrarConexiones("id",1);
 
$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
mysql_select_db($con["db"], $conexion); 

date_default_timezone_set('America/Lima');
         $fecha=date("d/m/Y");

        $UsuReg=$_SESSION["nombre"];

$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Kiuvox"); //autor
$objPHPExcel->getProperties()->setTitle("E - Reporte de NI X OS General"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte de NI x OS General"); //establecer titulo de hoja
 
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
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $fecha);




$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Local:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '.:: CORPORACION VASCO S.A.C. ::.');
// $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Hora:');
// $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $hora);


$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Usuario:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $UsuReg);  


$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Proveedor:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'INDUSTRIAS VASQUEZ S.A.C.');  

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "DETALLADO DE NOTAS DE INGRESO X ORDEN DE SERVICIO");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila"); //establecer estilo
 


//titulos de columnas
$fila+=1;

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'NRO.NI');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'FEC.EMISION');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'NRO.OS');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'UND');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'UND');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:M$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:M$fila")->getFont()->setBold(true); //negrita





//rellenar con contenido

   
  
    $sql=mysql_query("SELECT DISTINCT  nod.nNeaOs, nod.NroOs , Item , CodProOrigen, pro.DesPro AS DesProOrigen,  CodProDestino, pro1.DesPro AS Descripcion, CanSol, 
        tb1.Des_Larga AS Color, tb3.Des_Larga AS Color2, tb2.Des_Corta AS Unidad, DATE_FORMAT(no.FecEmi, '%d/%m/%Y') AS FecEmi
    FROM    nea_os_det nod
    INNER JOIN Producto pro ON  
         nod.CodProOrigen = pro.CodPro
     INNER JOIN Producto pro1 ON  
         nod.CodProDestino= pro1.CodPro
    INNER JOIN Tabla_M_Detalle AS tb1 ON  
    pro.ColPro = tb1.Cod_Argumento
    INNER JOIN Tabla_M_Detalle AS tb3 ON  
    pro1.ColPro = tb3.Cod_Argumento
    INNER JOIN Tabla_M_Detalle AS tb2 ON 
       pro.UndPro = tb2.Cod_Argumento
    LEFT JOIN nea_os no ON
         no.nNeaOs= nod.nNeaOs
     WHERE (tb1.Cod_Tabla = 'TCOL' OR tb1.Cod_Tabla IS NULL) 
        AND (tb2.Cod_Tabla = 'TUND' OR tb2.Cod_Tabla IS NULL)
        AND (tb3.Cod_Tabla = 'TCOL' OR tb3.Cod_Tabla IS NULL)
        ORDER BY no.nNeaOs DESC , nod.Item ASC;
 ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){
  $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getNumberFormat()->setFormatCode('000000'); 
  $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getNumberFormat()->setFormatCode('00000'); 
  $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getNumberFormat()->setFormatCode('000000'); 
  $objPHPExcel->getActiveSheet()->getStyle("I$fila")->getNumberFormat()->setFormatCode('00000'); 


  $CodPro=$res["CodProOrigen"]; 
  

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["CodProOrigen"]);
 
  

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["nNeaOs"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["FecEmi"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["NroOs"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["CodProOrigen"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["DesProOrigen"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["Color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["Unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["CodProDestino"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["Descripcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["Color2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($res["Unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", utf8_encode($res["CanSol"]));
  //Establecer estilo
  $objPHPExcel->getActiveSheet() ->setSharedStyle($bordes, "B$fila:M$fila");
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila") ->getNumberFormat()->setFormatCode('000000');
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila") ->getNumberFormat()->setFormatCode('000000');
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila") ->getNumberFormat()->setFormatCode('00000');  
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila") ->getNumberFormat()->setFormatCode('00000');
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
 
  $objPHPExcel->getActiveSheet() ->getStyle("M$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 

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
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);


//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_OrdenesServicioGeneral.xls"');
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