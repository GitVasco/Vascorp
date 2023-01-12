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
$objPHPExcel->getActiveSheet()->setTitle("ORDEN DE CORTE -" . $fecha);

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
$objDrawing->setCoordinates('B1');
$objDrawing->setWorksheet($objPHPExcel->getActiveSheet());

// TITULO
$fila = 2;
$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'ORDEN DE CORTE - MP');
$objPHPExcel->getActiveSheet()->mergeCells("C$fila:D$fila");
$objPHPExcel->getActiveSheet()->setSharedStyle($texto3, "C$fila:D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $fecha);
$objPHPExcel->getActiveSheet()->setSharedStyle($texto2, "E$fila");


$fila = 7;
$objPHPExcel->getActiveSheet()->SetCellValue("A$fila", 'Linea');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "A$fila");
$objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("B$fila", 'MATERIA PRIMA');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "B$fila");
$objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("C$fila", 'CONSUMO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "C$fila");
$objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("D$fila", 'STOCK');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "D$fila");
$objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->SetCellValue("E$fila", 'ESTADO');
$objPHPExcel->getActiveSheet()->setSharedStyle($borde2, "E$fila");
$objPHPExcel->getActiveSheet()->getStyle("E$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


#query para sacar los datos deL detalle
$sqlDetalle = mysql_query("SELECT 
                LEFT(mp.codfab, 3) AS linea,
                mp.descripcion AS materiaprima,
                SUM(ROUND((doc.cantidad * dt.consumo), 2)) AS consumo,
                mp.stock,
                CASE
                WHEN mp.stock > SUM(ROUND((doc.cantidad * dt.consumo), 2)) 
                THEN 'OK' 
                ELSE 'FALTANTE' 
                END AS estado 
                FROM
                detalles_ordencortejf doc 
                LEFT JOIN detalles_tarjetajf dt 
                ON doc.articulo = dt.articulo 
                LEFT JOIN 
                (SELECT DISTINCT 
                    p.codpro,
                    CONCAT(p.DesPro, ' - ', tb.Des_Larga) AS descripcion,
                    p.codalm01 AS stock,
                    p.codfab 
                FROM
                    producto AS p,
                    Tabla_M_Detalle AS tb 
                WHERE tb.Cod_Tabla IN ('TCOL') 
                    AND tb.Cod_Argumento = p.ColPro 
                    AND p.estpro = '1' 
                ORDER BY SUBSTRING(CodFab, 1, 6) ASC) AS mp 
                ON dt.mat_pri = mp.codpro 
                LEFT JOIN ordencortejf oc 
                ON doc.ordencorte = oc.codigo 
                WHERE LEFT(mp.codfab, 3) IN (
                'BLO',
                'ELA',
                'SES',
                'TIR',
                'TEL',
                'MET',
                'PLA',
                'ETI'
                ) 
                AND doc.estado = '0' 
                GROUP BY mp.descripcion 
                ORDER BY LEFT(mp.codfab, 3),
                mp.descripcion") or die(mysql_error());

$cont = 0;
while ($respDetalle = mysql_fetch_array($sqlDetalle)) {
    $cont += 1;

    $fila += 1;

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", utf8_encode($respDetalle["linea"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", utf8_encode($respDetalle["materiaprima"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", utf8_encode($respDetalle["consumo"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($respDetalle["stock"]));

    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", utf8_encode($respDetalle["estado"]));



    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "A$fila");
    $objPHPExcel->getActiveSheet()->getStyle("A$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "B$fila");
    /* $objPHPExcel->getActiveSheet()->getStyle("B$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "C$fila");
    /* $objPHPExcel->getActiveSheet()->getStyle("C$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "D$fila");
    /* $objPHPExcel->getActiveSheet()->getStyle("D$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */

    $objPHPExcel->getActiveSheet()->setSharedStyle($borde5, "E$fila");
    /* $objPHPExcel->getActiveSheet()->getStyle("G$fila")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); */
}

# Ajustar el tamaño de las columnas
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(7);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(70);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(12.72);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15.72);

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
header('Content-Disposition: attachment; filename=" ORDEN DE CORTE - ' . $fecha . '.xls"');


//forzar a descarga por el navegador
$objWriter->save('php://output');
