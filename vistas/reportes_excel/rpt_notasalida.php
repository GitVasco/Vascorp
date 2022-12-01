<?php

session_start();
// $id=$_GET['nrooc'];
// $id=$_POST['nrooc'];

// echo $id;



// header("Content-Type: text/html;charset=utf-8");

// <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

// header("Content-Type: text/html;charset=ISO-8859-1");


header('Content-Type: text/html; charset=ISO-8859-1');



$id = $_GET["idNotaSalida"];



//ajuntar la libreria excel
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

$fechahora = new DateTime();

$hora = $fechahora->format("H:i:s");


$objPHPExcel = new PHPExcel(); //nueva instancia

$objPHPExcel->getProperties()->setCreator("Leydi"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte de Nota de Salida"); //titulo

//inicio estilos
$titulo = new PHPExcel_Style(); //nuevo estilo
$titulo->applyFromArray(
  array(
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 16
    )
  )
);

$observaciones = new PHPExcel_Style(); //nuevo estilo
$observaciones->applyFromArray(
  array(
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 8
    )
  )
);

$subtitulo = new PHPExcel_Style(); //nuevo estilo

$subtitulo->applyFromArray(
  array(
    'fill' => array( //relleno de color
      'type' => PHPExcel_Style_Fill::FILL_SOLID,
      'color' => array('argb' => 'FF3399FF')
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
  )
);


//FIRMAS

$firmas = new PHPExcel_Style(); //nuevo estilo
$firmas->applyFromArray(
  array(
    'alignment' => array( //alineacion
      'wrap' => false,
      'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER
    ),
    'font' => array( //fuente
      'bold' => true,
      'size' => 14
    ),
    'borders' => array( //bordes
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
  )
);


$bordes = new PHPExcel_Style(); //nuevo estilo

$bordes->applyFromArray(
  array(
    'borders' => array(
      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    )
  )
);
//fin estilos

$objPHPExcel->createSheet(0); //crear hoja
$objPHPExcel->setActiveSheetIndex(0); //seleccionar hora
$objPHPExcel->getActiveSheet()->setTitle("Reporte de Nota de Salida"); //establecer titulo de hoja

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



$sqlPro = mysql_query("SELECT DISTINCT vc.Tip, vc.Ser, vc.Nro, DATE_FORMAT(vc.FecEmi, '%d/%m/%Y') AS FecEmi, cli.Ruc, cli.CodCli, cli.RazCli, cli.DirCli, vc.UsuReg, vc.detdocsal 
      from Ventas_Cab vc, Clientes AS cli
        where  cli.Ruc= vc.Ruc
         and vc.Nro= $id 
       ");



$resPro = mysql_fetch_array($sqlPro);



$fila = 3;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Empresa :');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CORPORACION VASCO S.A.C.');

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  'Fecha:');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $fecha);


// $objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  $fecha);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Tipo:');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $resPro["Tip"]);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);



$fila = 4;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Local :');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", '.:: CORPORACION VASCO S.A.C. ::.');

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "Hora: ");
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $hora);
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Serie:');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $resPro["Ser"]);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getNumberFormat()->setFormatCode('000');

$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$fila = 5;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'Registrado por:');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["UsuReg"]);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Orden de Corte:');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $resPro["detdocsal"]);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'Número:');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $resPro["Nro"]);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getNumberFormat()->setFormatCode('000000');

$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$fila = 7;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'F.Emision :');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $resPro["FecEmi"]);
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'Cliente :');
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $resPro["Ruc"] . '-' . $resPro["RazCli"]);
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);




$fila = 8;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Moneda : ");
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "NUEVOS SOLES");
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "Direccion: ");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila",  utf8_encode($resPro["DirCli"]));
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$fila = 9;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "Almacen: ");
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", "MATERIA PRIMA");
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "Tipo de Salida:");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", "11-SALIDA DE ALMACEN");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


$fila = 11;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", "NOTA DE SALIDA DEL ALMACEN - MATERIA PRIMA");
$objPHPExcel->getActiveSheet()->mergeCells("B$fila:H$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "B$fila:H$fila"); //establecer estilo

$fila = 12;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "");

//titulos de columnas
$fila += 1;
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ITE');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'COD FABRICA');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'DESCRIPCION');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'PAIS');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'UND');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'CANTIDAD');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'DESTINO');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "B$fila:I$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("B$fila:I$fila")->getFont()->setBold(true); //negrita

$objPHPExcel->getActiveSheet()->getStyle("D$fila:I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);



//rellenar con contenido



$sql = mysql_query("SELECT DISTINCT 
    vd.Item,
    pro.CodFab,
    pro.CodPro,
    TbCol.Des_Larga AS DesCol,
    TbPai.Des_Larga AS DesPai,
    TbUnd.Des_Larga AS DesUnd,
    vd.CanVta,
    pro.DesPro,
    pro.ColPro,
    pro.CosPro,
    vd.CodPro,
    vd.PreVta,
    vd.CanVta,
    CASE
      WHEN vd.CenCosto IS NULL 
      THEN '' 
      ELSE cc.nombre_area 
    END AS Destino 
  FROM
    Venta_Det vd 
    INNER JOIN Producto pro 
      ON pro.CodPro = vd.CodPro 
    LEFT JOIN Tabla_M_Detalle AS TbCol 
      ON TbCol.Cod_Tabla IN ('TCOL') 
      AND TbCol.Cod_Argumento = pro.ColPro 
    LEFT JOIN Tabla_M_Detalle AS TbPai 
      ON TbPai.Cod_Tabla IN ('PAIS') 
      AND TbPai.Cod_Argumento = pro.PaiPro 
    LEFT JOIN Tabla_M_Detalle AS TbUnd 
      ON TbUnd.Cod_Tabla IN ('TUND') 
      AND TbUnd.Cod_Argumento = pro.UndPro 
    LEFT JOIN centro_costos cc 
      ON cc.cod_area = vd.CenCosto 
  WHERE vd.Nro = $id 
  ORDER BY Item ASC");




while ($res = mysql_fetch_array($sql)) {

  // $CodPro=$res["CodPro"]; 
  // ITE COD PROD  DESCRIPCION COLOR COLOR PROV. CANTIDAD  UND P.UNITARIO  % DSCTO TOTAL



  $fila += 1;
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $res["Item"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $res["CodPro"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila",  utf8_encode($res["DesPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  utf8_encode($res["DesCol"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila",  utf8_encode($res["DesPai"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $res["DesUnd"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $res["CanVta"]);
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila",  utf8_encode($res["Destino"]));







  //Establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "B$fila:I$fila");

  $objPHPExcel->getActiveSheet()->getStyle("B$fila:I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getNumberFormat()->setFormatCode('00000');
}



//insertar formula
$fila += 2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", '');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '');

//insertar formula
$fila += 3;
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'ALMACÉN DE MATERIA PRIMA');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'SOLICITANTE');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'LOGÍSTICA');

$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->setSharedStyle($firmas, "D$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->setSharedStyle($firmas, "F$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->setSharedStyle($firmas, "H$fila"); //establecer estilo





//recorrer las columnas
// foreach (range( 'C', 'D' , 'E' , 'F' , 'G' , 'H' , 'I' , 'J') as $columnID) {
//autodimensionar las columnas
// $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
// $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setWidth(10);

$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

// }






$objPHPExcel->getActiveSheet()->setSharedStyle($observaciones, "A$fila"); //establecer estilo



//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');

//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo

// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");

// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_NotaSalida.xls"');
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
