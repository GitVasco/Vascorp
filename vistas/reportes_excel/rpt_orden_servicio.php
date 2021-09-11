<?php

   session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;



// header("Content-Type: text/html;charset=utf-8");

// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

// header("Content-Type: text/html;charset=ISO-8859-1");


header('Content-Type: text/html; charset=ISO-8859-1');



$id = $_GET["idOrdenServicio"];


 
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

$fechaactual = getdate();
// print_r($fechaactual);
$fecha="$fechaactual[mday]/$fechaactual[mon]/$fechaactual[year]";

$UsuReg=$_SESSION['nombre'];



$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Leydi"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte de Orden de Servicio"); //titulo
 
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
$objPHPExcel->getActiveSheet()->setTitle("Orden de Compra"); //establecer titulo de hoja
 
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
 
 
//incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('../img/plantilla/LogoJacky.png'); //ruta
$objDrawing->setHeight(75); //altura
// $objDrawing->setWeight(10); //altura
$objDrawing->setCoordinates('B2');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); //incluir la imagen
//fin: incluir una imagen
 




 
//establecer titulos de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 10);

 $sqlPro=mysql_query("SELECT  DISTINCT os.Nro, os.Ser, os.Nro, DATE_FORMAT(os.FecEmi, '%d/%m/%Y') AS FecEmi,
               DATE_FORMAT(os.FecEnt, '%d/%m/%Y') AS Fecllegada ,   tbe.Des_Larga AS EstadoCab, EstOs, pro.CodRuc, pro.RazPro, pro.DirPro,
               pro.RucPro, os.ObsOs
     FROM  oServicio os, tabla_m_detalle tbe, proveedor pro
     WHERE os.Nro =$id
     and os.EstOs = tbe.Des_Corta 
     and pro.CodRuc= os.CodRuc
  " );


    
     
              
$resPro=mysql_fetch_array($sqlPro);

$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CORPORACION VASCO S.A.C.');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Orden de Servicio N°:');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $resPro["Nro"]);   
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "H$fila:J$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getNumberFormat()->setFormatCode('000000'); 
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:I$fila");

// $objPHPExcel->getActiveSheet()->mergeCells("J$fila:K$fila");


$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'R.U.C. : 20513613939');


$fila=4;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Dirección: CALLE SANTO TORIBIO No 259');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Fec.Emisión:');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $resPro["FecEmi"]); 
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:I$fila");
// $objPHPExcel->getActiveSheet()->setCellValue('A3', 29);
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

// $objPHPExcel->getActiveSheet()->getStyle('A3')->getNumberFormat()->setFormatCode('0000'); 

 
$fila=5;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'Distrito: SAN MARTIN DE PORRES');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Fec.Entrega:');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $resPro["Fecllegada"]);   
$objPHPExcel->getActiveSheet()->mergeCells("H$fila:I$fila");
$objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);  



$fila=6;
$objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
$objPHPExcel->getActiveSheet()->getStyle("C$fila")  ->getNumberFormat()->setFormatCode('00000'); 
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Proveedor:");  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["CodRuc"])); 
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($resPro["RazPro"])); 


$fila=7;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Dirección:");  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["DirPro"])); 


$fila=8;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Observaciones:");  
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($resPro["ObsOs"])); 
 


$fila=9;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Sirva(n)se atender la siguiente Orden de Servicio :"); 

   
$fila=10;

//titulos de columnas
$fila+=1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITEM');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'C.INICIAL');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'C.DESTINO');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'UND');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:J$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:J$fila")->getFont()->setBold(true); //negrita





    $sql=mysql_query("SELECT DISTINCT  Item, CodProOrigen, pro.DesPro AS DesProOrigen, CantidadIni, CodProDestino, pro1.DesPro AS Descripcion, Saldo, Despacho, 
        tb1.Des_Larga AS Color, tb3.Des_Larga AS Color2, tb2.Des_Corta AS Unidad,  tb4.Des_Larga AS EstadoDet
    FROM    oServicioDet osd
    INNER JOIN Producto pro ON  
         osd.CodProOrigen = pro.CodPro
     INNER JOIN Producto pro1 ON  
         osd.CodProDestino= pro1.CodPro
    INNER JOIN Tabla_M_Detalle AS tb1 ON  
    pro.ColPro = tb1.Cod_Argumento
    INNER JOIN Tabla_M_Detalle AS tb3 ON  
    pro1.ColPro = tb3.Cod_Argumento
    INNER JOIN Tabla_M_Detalle AS tb2 ON 
       pro.UndPro = tb2.Cod_Argumento
     LEFT JOIN oServicio os ON  
            os.Nro = osd.Nro
    LEFT JOIN Tabla_M_Detalle AS tb4 ON 
             osd.Estos = tb4.Des_Corta
     WHERE (tb1.Cod_Tabla = 'TCOL' OR tb1.Cod_Tabla IS NULL) 
        AND (tb2.Cod_Tabla = 'TUND' OR tb2.Cod_Tabla IS NULL)
        AND (tb3.Cod_Tabla = 'TCOL' OR tb3.Cod_Tabla IS NULL)
        AND (tb4.Cod_Tabla = 'EOC1' OR tb3.Cod_Tabla IS NULL)
        AND osd.Nro=$id   
        AND osd.EstReg='1'
        ORDER BY osd.Item ASC");
    
     

        
while($res=mysql_fetch_array($sql)){    


  // $CodPro=$res["CodPro"]; 
  // ITE COD PROD  DESCRIPCION COLOR COLOR PROV. CANTIDAD  UND P.UNITARIO  % DSCTO TOTAL

  

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["Item"]);

  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $res["CodProOrigen"]);

  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($res["DesProOrigen"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($res["Color"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($res["CodProDestino"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($res["Descripcion"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($res["Color2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($res["Unidad"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($res["CantidadIni"]));             


  //Establecer estilo
   $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('00000'); 



  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:J$fila");

  $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('00000'); 
  $objPHPExcel->getActiveSheet()->getStyle("F$fila")->getNumberFormat()->setFormatCode('00000'); 
  $objPHPExcel->getActiveSheet() ->getStyle("B$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("F$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("E$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  
 }
 


        


  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(35);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);


 


 $fila+=1;






//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_OrdenServicio.xls"');
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