<?php

      session_start();

//   $fecdesde=$_GET['fecdesde'];
// $fechasta=$_GET['fechasta'];


 
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

$UsuReg=$_SESSION['usuario'];


$objPHPExcel = new PHPExcel(); //nueva instancia
 
$objPHPExcel->getProperties()->setCreator("Leydi"); //autor
$objPHPExcel->getProperties()->setTitle("Reporte de Proveedores"); //titulo
 
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
      'color' => array('argb' => 'FFCCFFCC')
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
$objPHPExcel->getActiveSheet()->setTitle("Reporte de Proveedores"); //establecer titulo de hoja
 
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
 
$fila=1;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Empresa:');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'CORPORACION VASCO S.A.C.');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'Fecha:');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $fecha);




$fila=2;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Local:');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '.:: CORPORACION VASCO S.A.C. ::.');



$fila=3;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Usuario:');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $UsuReg); 

$fila=6;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "LISTADO DE PROVEEDORES");
$objPHPExcel->getActiveSheet()->mergeCells("A$fila:V$fila"); //unir celdas
$objPHPExcel->getActiveSheet()->setSharedStyle($titulo, "A$fila:V$fila"); //establecer estilo


 
//titulos de columnas
$fila+=1;





$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'NRO');
$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'TIP.PROV.');
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CODIGO');
$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'RAZON SOCIAL');
$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'DIRECCION');
$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'DISTRITO');
$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'TELEFONO1');
$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'TELEFONO2');
$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'TELEFONO3');
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'FAX');
$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'CONTACTO');
$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'E-MAIl1');
$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'E-MAIL2');
$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'WEB');
$objPHPExcel->getActiveSheet()->SetCellValue("O$fila", 'T.ENTREGA');
$objPHPExcel->getActiveSheet()->SetCellValue("P$fila", 'FORM.PAGO');
$objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", 'BANCO');
$objPHPExcel->getActiveSheet()->SetCellValue("R$fila", 'MONEDA');
$objPHPExcel->getActiveSheet()->SetCellValue("S$fila", 'BANCO1');
$objPHPExcel->getActiveSheet()->SetCellValue("T$fila", 'MONEDA1');
$objPHPExcel->getActiveSheet()->SetCellValue("U$fila", 'N°CUENTA');
$objPHPExcel->getActiveSheet()->SetCellValue("V$fila", 'OBSERV.');
$objPHPExcel->getActiveSheet()->setSharedStyle($subtitulo, "A$fila:V$fila"); //establecer estilo
$objPHPExcel->getActiveSheet()->getStyle("A$fila:V$fila")->getFont()->setBold(true); //negrita
 
//rellenar con contenido



    $sql=mysql_query("SELECT distinct Proveedor.Cod_Local, Proveedor.Cod_Entidad, CodRuc, TipPro, RucPro, RazPro, DirPro,
			UbiPro, Telpro1,TelPro2, TelPro3, FaxPro, ConPro, EmaPro, EmaPro2, WebPro, TieEnt,
			ForPag, Dia, Banco, Moneda, NroCta, Banco1, Moneda1, NroCta1, EstPro, Observa,
			Tabla_M_Detalle.Des_Larga AS Tippro, IFNULL(Ubigeo.Distrito,'') AS Dispro,
			IFNULL(Tabla_M_Detalle_1.Des_Larga,'') AS Foppro, IFNULL(Tabla_M_Detalle_2.Des_Larga,'') AS Banco2,
			IFNULL(Tabla_M_Detalle_3.Des_Larga,'') AS Moneda2, IFNULL(Tabla_M_Detalle_4.Des_Larga,'') AS Banco3,
			IFNULL(Tabla_M_Detalle_5.Des_Larga,'') AS Moneda3
	From Proveedor
			LEFT JOIN Tabla_M_Detalle ON 
      Proveedor.TipPro = Tabla_M_Detalle.Cod_Argumento	
      and (Tabla_M_Detalle.Cod_Tabla = 'TPRO') 	
			LEFT JOIN Ubigeo ON Proveedor.UbiPro = Ubigeo.Codigo
			LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_1 ON 
      Proveedor.ForPag = Tabla_M_Detalle_1.Cod_Argumento
			AND  (Tabla_M_Detalle_1.Cod_Tabla = 'TFOR' OR Tabla_M_Detalle_1.Cod_Tabla IS NULL) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_2 ON 
      Proveedor.Banco = Tabla_M_Detalle_2.Cod_Argumento
      AND (Tabla_M_Detalle_2.Cod_Tabla = 'TBAN' OR Tabla_M_Detalle_2.Cod_Tabla IS NULL) 
			LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_3 ON 
      Proveedor.Moneda = Tabla_M_Detalle_3.Cod_Argumento
      AND (Tabla_M_Detalle_3.Cod_Tabla = 'TMON' OR Tabla_M_Detalle_3.Cod_Tabla IS NULL) 
			LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_4 ON
      Proveedor.Banco1 = Tabla_M_Detalle_4.Cod_Argumento
			AND (Tabla_M_Detalle_4.Cod_Tabla = 'TBAN' OR Tabla_M_Detalle_4.Cod_Tabla IS NULL) 
      LEFT JOIN Tabla_M_Detalle AS Tabla_M_Detalle_5 ON 
      Proveedor.Moneda1 = Tabla_M_Detalle_5.Cod_Argumento
      AND (Tabla_M_Detalle_5.Cod_Tabla = 'TMON' OR Tabla_M_Detalle_5.Cod_Tabla IS NULL)
	Where 
       Proveedor.EstPro not like '2'
       order by Proveedor.CodRuc ");
    
     $fila1=0;
         
        
while($res=mysql_fetch_array($sql)){    

$fila1++;
  // $CodPro=$res["CodPro"]; 
								

  $fila+=1;
  $objPHPExcel->getActiveSheet()->SetCellValue("A$fila",  utf8_encode($res["CodRuc"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("B$fila",  utf8_encode($res["Tippro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode( $res["RucPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("D$fila",  utf8_encode($res["RazPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("E$fila",  utf8_encode($res["DirPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("F$fila",  utf8_encode($res["Dispro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("G$fila",  utf8_encode($res["Telpro1"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode( $res["TelPro2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("I$fila",  utf8_encode($res["TelPro3"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("J$fila",  utf8_encode($res["FaxPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("K$fila",  utf8_encode($res["ConPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("L$fila",  utf8_encode($res["EmaPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("M$fila",  utf8_encode($res["EmaPro2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("N$fila",  utf8_encode($res["WebPro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("O$fila",  utf8_encode($res["TieEnt"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("P$fila",  utf8_encode($res["Foppro"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila",  utf8_encode($res["Banco2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("R$fila",  utf8_encode($res["Moneda2"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("S$fila",  utf8_encode($res["Banco3"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("T$fila",  utf8_encode($res["Moneda3"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("U$fila",  utf8_encode($res["NroCta"]));
  $objPHPExcel->getActiveSheet()->SetCellValue("V$fila",  utf8_encode($res["Observa"]));
  //Establecer estilo
  $objPHPExcel->getActiveSheet()->setSharedStyle($bordes, "A$fila:V$fila");

  $objPHPExcel->getActiveSheet() ->getStyle("C$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("G$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("H$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("I$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet() ->getStyle("J$fila")  ->getAlignment()  ->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  

 }
 
//insertar formula
// $fila+=2;
// $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'SUMA');
// $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", '=1+2');
 
//recorrer las columnas
  $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
  $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(50);
  $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(60);
  $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
  $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(11);
  $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(30);
  $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(30);
//establecer pie de impresion en cada hoja
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&R&F página &P / &N');
 
//*************Guardar como excel 2003*********************************
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); //Escribir archivo
 
// Establecer formado de Excel 2003
header("Content-Type: application/vnd.ms-excel");
 
// nombre del archivo
header('Content-Disposition: attachment; filename="Reporte_Proveedores.xls"');
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