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


$fecha=date("d/m/Y");

$UsuReg=$_SESSION['nombre'];



$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Kiuvox"); //autor
$objPHPExcel->getProperties()->setTitle("E - Reporte de OS Pendientes"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte de OS Pendientes"); //establecer titulo de hoja
 
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


$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "RESUMEN - LISTADO ORDENES DE SERVICIO PENDIENTES");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:L$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:L$fila"); //establecer estilo
 
//titulos de columnas
$fila+=1;

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'NRO.OS');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'FEC.EMISION');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'FEC.ENTREGA');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COD.ORIGEN');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'COD.DESTINO');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:K$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:K$fila")->getFont()->setBold(true); //negrita






//rellenar con contenido

   
  
    $sql=mysql_query("SELECT 
    osd.Nro,
    CodProOrigen,
    p1.DesPro AS DesOri,
    tcol.Des_Larga AS ColorOri,
    tund.Des_Corta AS UndOri,
    CodProDestino,
    p2.DesPro AS DesDes,
    tcol2.Des_Larga AS ColorDes,
    tund.Des_Corta AS UndDes,
    Saldo,
    DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
    DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS FecEnt 
  FROM
    oserviciodet osd 
    INNER JOIN Producto p1 
      ON p1.CodPro = osd.CodProOrigen 
    INNER JOIN Producto p2 
      ON p2.CodPro = osd.CodProDestino 
    LEFT JOIN tabla_m_detalle tcol 
      ON tcol.Cod_Argumento = p1.ColPro 
    LEFT JOIN tabla_m_detalle tcol2 
      ON tcol2.Cod_Argumento = p2.ColPro 
    LEFT JOIN tabla_m_detalle tund 
      ON tund.Cod_Argumento = p1.UndPro 
    LEFT JOIN tabla_m_detalle tund2 
      ON tund2.Cod_Argumento = p2.UndPro 
    LEFT JOIN oservicio os 
      ON os.Nro = osd.Nro 
  WHERE (
      tcol.Cod_Tabla = 'TCOL' 
      OR tcol.Cod_Tabla IS NULL
    ) 
    AND (
      tund.Cod_Tabla = 'TUND' 
      OR tund.Cod_Tabla IS NULL
    ) 
    AND (
      tcol2.Cod_Tabla = 'TCOL' 
      OR tcol2.Cod_Tabla IS NULL
    ) 
    AND (
      tund2.Cod_Tabla = 'TUND' 
      OR tund2.Cod_Tabla IS NULL
    ) 
    AND osd.EstReg = '1' 
    AND osd.EstOS IN ('ABI', 'PAR') 
  ORDER BY Nro DESC ");  





    
     
         
        
while($res=mysql_fetch_array($sql)){    

  $CodPro=$res["CodPro"]; 
  

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["CodPro"]);
 
  

  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($res["Nro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($res["FecEmi"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["FecEnt"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["CodProOrigen"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["DesOri"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["ColorOri"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["CodProDestino"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["DesDes"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["ColorDes"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($res["Saldo"]));



  //Establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:K$fila");
  $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getNumberFormat()->setFormatCode('000000');
   $objPHPExcel->getActiveSheet()->getStyle("E$fila")->getNumberFormat()->setFormatCode('00000');  
   $objPHPExcel->getActiveSheet()->getStyle("H$fila")->getNumberFormat()->setFormatCode('00000');  
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
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(40);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);



//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_OSPendientes.xls"');
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