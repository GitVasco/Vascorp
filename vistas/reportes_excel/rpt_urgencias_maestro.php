<?php

header('Content-Type: text/html; charset=ISO-8859-1');

/* 
* RECIBIMOS VARIABLE DESDE LA VISTA
*/

#$id = $_GET["codigo"];

date_default_timezone_set('America/Lima');
$dia = date('d/m/Y');
$hora = date('h:i:s');



/* 
* LLAMAMOS A LA LIBRERIA PHPEXCEL
*/
include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/usuarios.controlador.php";
require_once "../../modelos/usuarios.modelo.php";

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

/* 
* LLAMAMOS A LA CONEXION
*/
$con = ControladorUsuarios::ctrMostrarConexiones("id", 1);

$conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
mysql_select_db($con["db"], $conexion);

/* 
* CONFIGURAMOS LA FECHA ACTUAL
*/
$fechaactual = getdate();
$fecha = "$fechaactual[mday]/$fechaactual[mon]/$fechaactual[year]";

$tipo = $_GET["tipo"];
$mes = ModeloArticulos::mdlConfUrgencias($tipo);
$articulos = controladorArticulos::ctrMostrarUrgenciaMaestro($tipo, $mes["argumento"]);

if ($tipo == "prod") {

    $report = "PRODUCCIÓN";
} else if ($tipo == "alm") {

    $report = "ALMACEN DE CORTE";
} else if ($tipo == "corte") {

    $report = "CORTE";
} else if ($tipo == "plan") {

    $report = "PLANIFICACIÓN";
}

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
#negrita-subrayado-13-rojo
$texto_1 = new PHPExcel_Style();
$texto_1->applyFromArray(
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

#negrita-11-negro
$texto_2 = new PHPExcel_Style();
$texto_2->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => '000000'),
            'size' => 11
        )
    )
);

#normal-10
$texto_3 = new PHPExcel_Style();
$texto_3->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'font' => array(
            'bold' => false,
            'underline' => false,
            'color' => array('rgb' => '000000'),
            'size' => 10
        )
    )
);

#normal-11-azul
$texto_4 = new PHPExcel_Style();
$texto_4->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => '0400FF'),
            'size' => 11
        )
    )
);

#negrita-11-rojo
$borde_1 = new PHPExcel_Style();
$borde_1->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => 'FF0008'),
            'size' => 8
        )
    )
);

#negrita-11-azul
$borde_2 = new PHPExcel_Style();
$borde_2->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => '0400FF'),
            'size' => 8
        )
    )
);

#negrita-11-negro
$borde_3 = new PHPExcel_Style();
$borde_3->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => '000000'),
            'size' => 8
        )
    )
);

#negrita-11-celeste
$borde_4 = new PHPExcel_Style();
$borde_4->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => '0174BB'),
            'size' => 8
        )
    )
);

#negrita-11-verde
$borde_5 = new PHPExcel_Style();
$borde_5->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => '00833E'),
            'size' => 8
        )
    )
);

#normal-10-negro
$borde_6 = new PHPExcel_Style();
$borde_6->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => false,
            'underline' => false,
            'color' => array('rgb' => '000000'),
            'size' => 8
        )
    )
);

#negrita-10-vino
$borde_7 = new PHPExcel_Style();
$borde_7->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => 'A4001E'),
            'size' => 8
        )
    )
);

#negrita-10-rojo/rosado
$borde_8 = new PHPExcel_Style();
$borde_8->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'EEABAB')
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'color' => array('rgb' => 'FF0008'),
            'size' => 8
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
$objPHPExcel->getActiveSheet()->setTitle('Urgencias');

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

# Establecer cabecera de cada Hoja
$objPHPExcel->getActiveSheet()->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);
$objPHPExcel->getActiveSheet()->freezePaneByColumnAndRow(0, 7);


# Incluir una imagen
$objDrawing = new PHPExcel_Worksheet_Drawing();
$objDrawing->setPath('img/jackyform_letras.png'); //ruta
$objDrawing->setWidthAndHeight(200, 150);
$objDrawing->setCoordinates('A1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

/* 
todo: INICIO CABECERA
*/


$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'NUEVO REPORTE DE URGENCIAS');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_1, "C$fila:I$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 3;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $report);
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:I$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_1, "C$fila:I$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'FECHA:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $dia);
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "K$fila:L$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$fila = 4;
$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'HORA:');
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "J$fila");

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $hora);
$objPHPExcel->getActiveSheet()->mergeCells("K$fila:L$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto_2, "K$fila:L$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

/* 
todo: FIN CABECERA
*/

/* 
todo: INICIO DETALLE
*/
$fila = 6;
$objPHPExcel->getActiveSheet()->getRowDimension($fila)->setRowHeight(38.06);

$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'TALLER');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'ART.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'NOMBRE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'COLOR');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'TALLA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("F$fila", 'MAT. FALTANTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "F$fila");
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("F$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("G$fila", 'STOCK');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_4, "G$fila");
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("H$fila", 'PEDIDOS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "H$fila");
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("H$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("I$fila", 'EN TALLER');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "I$fila");
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("I$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("J$fila", 'ALM. CORTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "J$fila");
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("K$fila", 'ORD. CORTE');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "K$fila");
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("K$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("L$fila", 'VTAS. ULT. 30 DIAS');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_4, "L$fila");
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("L$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("M$fila", 'DURA.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "M$fila");
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("M$fila")->getAlignment()->setWrapText(true);

$objPHPExcel->getActiveSheet()->SetCellValue("N$fila", 'SIT.');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "N$fila");
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle("N$fila")->getAlignment()->setWrapText(true);


//$articulos  = ControladorArticulos::ctrArticulosUrgencia();

for ($i = 0; $i < count($articulos) - 1; $i++) {

    $fila += 1;
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($articulos[$i]["nom_taller"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($articulos[$i]["modelo"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($articulos[$i]["nombre"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($articulos[$i]["color"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", "T" . utf8_encode($articulos[$i]["talla"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", utf8_encode($articulos[$i]["mp_faltante"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", utf8_encode($articulos[$i]["stockB"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", utf8_encode($articulos[$i]["pedidos"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", utf8_encode($articulos[$i]["taller"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", utf8_encode($articulos[$i]["alm_corte"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", utf8_encode($articulos[$i]["ord_corte"]));
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", utf8_encode($articulos[$i]["ult_mes"]));

    if ($tipo == "prod") {
        $dura = $articulos[$i]["urg_prod"];
        if ($dura <= 0.85) {
            $situacion = "PRIORIDAD";
        } else if ($dura > 0.85) {
            $situacion = "URGENTE";
        }
    } else if ($tipo == "alm") {
        $dura = $articulos[$i]["urg_alm"];
        if ($dura <= 0.85) {
            $situacion = "PRIORIDAD";
        } else if ($dura > 0.85) {
            $situacion = "URGENTE";
        }
    } else if ($tipo == "corte") {
        $dura = $articulos[$i]["urg_corte"];
        if ($dura <= 1) {
            $situacion = "PRIORIDAD";
        } else if ($dura > 1) {
            $situacion = "URGENTE";
        }
    } else if ($tipo == "plan") {
        $dura = $articulos[$i]["urg_plan"];
        if ($dura <= 2) {
            $situacion = "PRIORIDAD";
        } else if ($dura > 2) {
            $situacion = "URGENTE";
        }
    }

    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", number_format($dura, 2));
    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $situacion);


    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "A$fila");
    $objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "B$fila");
    $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "C$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "D$fila");
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "E$fila");
    $objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_5, "F$fila");

    if (utf8_encode($articulos[$i]["mp_faltante"]) == "F/TELA") {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "F$fila");
    } else {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_7, "F$fila");
    }

    if (utf8_encode($articulos[$i]["stockB"]) < 0) {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "G$fila");
    } else {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_7, "G$fila");
    }

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "H$fila");

    if (utf8_encode($articulos[$i]["taller"]) <= 0) {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "I$fila");
    } else {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "I$fila");
    }

    if (utf8_encode($articulos[$i]["alm_corte"]) <= 0) {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "J$fila");
        $objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    } else {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_6, "J$fila");
        $objPHPExcel->getActiveSheet()->getStyle("J$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
    }

    if (utf8_encode($articulos[$i]["ord_corte"]) <= 0) {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "K$fila");
    } else {

        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_3, "K$fila");
    }

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_4, "L$fila");

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde_2, "M$fila");

    if ($situacion == "PRIORIDAD") {
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_8, "N$fila");
    } else {
        $objPHPExcel->getActiveSheet()->setSharedStyle($borde_1, "N$fila");
    }
}

/* 
todo: FIN DETALLE
*/


# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(11.42);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(7.85);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13.14);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(5.71);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(8.57);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(11);



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
header('Content-Disposition: attachment; filename="Urgencias-' . date('d-m-Y') . '.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');
