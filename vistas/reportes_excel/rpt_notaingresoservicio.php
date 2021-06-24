<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;

header('Content-Type: text/html; charset=ISO-8859-1');

$id = $_GET["idNotaIngresoServicio"];

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
 
$objPHPExcel->getProperties()->setCreator("Leydi"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte de Nota de Ingreso"); //titulo
 
//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
));



$titulo1 = new PHPExcel_Style(); //nuevo estilo
$titulo1->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 10
    )
));

 


$observaciones = new PHPExcel_Style(); //nuevo estilo
$observaciones->applyFromArray(
  array('alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 8
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte de Notas de Ingreso"); //establecer titulo de hoja
 
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
 


// //incluir una imagen
// $objDrawing = new PHPExcel_Worksheet_Drawing();
// $objDrawing->setPath('phpexcel_logo.jpg'); //ruta
// $objDrawing->setHeight(75); //altura
// $objDrawing->setCoordinates('A1');
// $objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
// //fin: incluir una imagen
 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);


	
    $sqlPro=mysql_query("SELECT neo.tNeaOs, neo.sNeaOs, neo.CodRuc, neo.nNeaOs, DATE_FORMAT(neo.FecEmi, '%d/%m/%Y') AS FecEmi, neo.NroOs,  prov.RazPro AS RazPro, neo.SerDcto , neo.NroDcto,neo.usureg
   FROM 
   nea_os neo
   LEFT JOIN Proveedor prov ON 
    prov.CodRuc= neo.CodRuc
    and neo.nNeaOs= $id " );
    
     
              
$resPro=mysql_fetch_array($sqlPro);



$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Empresa:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CORPORACION VASCO S.A.C.');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Tipo:');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $resPro["tNeaOs"]);   
$objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "J$fila");





$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Local:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '.:: CORPORACION VASCO S.A.C. ::.');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Serie:');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $resPro["sNeaOs"]);   
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getNumberFormat()->setFormatCode('000');    
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "J$fila");
 

$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Usuario:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["usureg"]);  
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'Número:');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $resPro["nNeaOs"]);  
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo1, "J$fila");

$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT); 
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getNumberFormat()->setFormatCode('000000');    

 
$fila=4;

$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'F.Emision:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["FecEmi"]);  

 
$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Proveedor:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["RazPro"]);   
			

$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'T.Dto:');  

  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["SerDcto"]); 
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('000'); 
$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);  
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $resPro["NroDcto"]);
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getNumberFormat()->setFormatCode('0000000'); 
$objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);





$fila=8;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Nro OS');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila",  $resPro["NroOs"]);
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('000000');  
$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);




// $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", "Hora:");  
// $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $hora); 



//3830.86+1479+1479= 6788.86 -> Fin de Junio
//1700-> 28 Julio
//1068.19+920=  1988.19 -> CTS
//1300 ->Vacaciones = 

$fila=9;

      
 


$fila=10;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "NOTA DE INGRESO X ORDEN DE SERVICIO");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:K$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:K$fila"); //establecer estilo

$fila=11;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '');


//titulos de columnas
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITE');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'COD.INICIAL');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'UND');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'COD.DESTINO');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'UND');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'C.RECIBIDA');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:K$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:K$fila")->getFont()->setBold(true); //negrita
 


//rellenar con contenido
    $sql=mysql_query("SELECT DISTINCT  Item, CodProOrigen, pro.DesPro AS DesProOrigen,  CodProDestino, pro1.DesPro AS Descripcion, CanSol, 
        tb1.Des_Larga AS Color, tb3.Des_Larga AS Color2, tb2.Des_Corta AS Unidad
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
     WHERE (tb1.Cod_Tabla = 'TCOL' OR tb1.Cod_Tabla IS NULL) 
        AND (tb2.Cod_Tabla = 'TUND' OR tb2.Cod_Tabla IS NULL)
        AND (tb3.Cod_Tabla = 'TCOL' OR tb3.Cod_Tabla IS NULL)
        AND nod.nNeaOs=$id 
        ORDER BY nod.Item ASC;
         ");
          
while($res=mysql_fetch_array($sql)){    

 
 

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila",  utf8_encode($res["Item"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila",  utf8_encode($res["CodProOrigen"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila",  utf8_encode($res["DesProOrigen"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  utf8_encode($res["Color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila",  utf8_encode($res["Unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila",  utf8_encode($res["CodProDestino"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila",  utf8_encode($res["Descripcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila",  utf8_encode($res["Color2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila",  utf8_encode($res["Unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila",  utf8_encode($res["CanSol"]));


  //Establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:K$fila");
  $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('00000');
  $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getNumberFormat()->setFormatCode('00000');  

  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("D$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT); 
  $objPHPExcel->getActiveSheet() ->getStyle("K$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);


 }
 



//recorrer las columnas
// foreach (range( 'C', 'D' , 'E' , 'F' , 'G' , 'H' , 'I' , 'J') as $columnID) {
  //autodimensionar las columnas
  // $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
  // $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(10);

  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(7);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(13);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(12);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth();
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);

// }




$objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "A$fila"); //establecer estilo




//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);






//Escribir archivo
 
// Establecer formado de Excel 2003


header("Content-Type: application/vnd.ms-excel");












 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_NotaIngresoXOrdenServicio.xls"');

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