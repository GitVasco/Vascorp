<?php

header('Content-Type: text/html; charset=ISO-8859-1');
date_default_timezone_set('America/Lima');

include "../reportes_excel/Classes/PHPExcel.php";
require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Corp. Vasco"); // Autor
$objPHPExcel->getProperties()->setTitle("Reporte Agrupado"); // Título

$objPHPExcel->createSheet(0);
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setTitle("Articulos Agrupados en Talleres");

// Configuración de página
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToPage(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToWidth(1);
$objPHPExcel->getActiveSheet()->getPageSetup()->setFitToHeight(0);

// Márgenes
$marginV = 0.5 / 3.54; // 0.5 centímetros
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft($marginV);
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight($marginV);

// Título del reporte
$headerRow = 1;
$maxColumn = 'P'; // Ajusta según la cantidad de columnas necesarias (actualizado para incluir dos columnas adicionales)
$objPHPExcel->getActiveSheet()->mergeCells("A$headerRow:$maxColumn$headerRow");
$objPHPExcel->getActiveSheet()->SetCellValue("A$headerRow", 'Articulos en Talleres Agrupados ' . date('d/m/Y'));
$objPHPExcel->getActiveSheet()->getStyle("A$headerRow")->getFont()->setSize(16);
// Se elimina la negrita del título
$objPHPExcel->getActiveSheet()->getStyle("A$headerRow")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// Definir los nombres de las tallas
$tallas = [
    1 => "S\n28\n3",
    2 => "M\n30\n4",
    3 => "L\n32\n6",
    4 => "XL\n34\n8",
    5 => "XXL\n36\n10",
    6 => "XS\n38\n12",
    7 => "40\n14",
    8 => "42\n16"
];

// Encabezados de columnas - Fila de encabezados (fila 3)
$headerRow = 3;

// Encabezados básicos, incluyendo Código y Nombre del Taller
$encabezados_basicos = ['Fecha', 'Guia', 'Código Taller', 'Nombre Taller', 'Modelo', 'Nombre', 'Color'];
$col = 'A';
foreach ($encabezados_basicos as $encabezado) {
    $objPHPExcel->getActiveSheet()->SetCellValue("{$col}{$headerRow}", $encabezado);
    $col++;
}

// Encabezados de tallas
foreach ($tallas as $codigo => $nombre_talla) {
    // Escribir el nombre de la talla con un salto de línea
    $cell = "{$col}{$headerRow}";
    $objPHPExcel->getActiveSheet()->SetCellValue($cell, $nombre_talla);
    $objPHPExcel->getActiveSheet()->getStyle($cell)->getAlignment()->setWrapText(true);
    $col++;
}

// Encabezado para Saldo Total
$cellTotal = "{$col}{$headerRow}";
$objPHPExcel->getActiveSheet()->SetCellValue($cellTotal, "Saldo Total");

// Se eliminan negrita y alineación centrada de los encabezados
$objPHPExcel->getActiveSheet()->getStyle("A$headerRow:$cellTotal$headerRow")->getFont()->setBold(false);
$objPHPExcel->getActiveSheet()->getStyle("A$headerRow:$cellTotal$headerRow")->getAlignment()->setWrapText(true);

// Obtener los detalles
$detalles = ControladorTalleres::ctrEnTalleres(null);

// Agrupar los datos
$groupedData = [];

foreach ($detalles as $detalle) {
    // Asegúrate de que los campos 'codigo_taller' y 'nombre_taller' existen en $detalle
    // Ajusta los nombres de los campos según tu estructura de datos real
    $codigo_taller = isset($detalle["codigo_taller"]) ? $detalle["codigo_taller"] : (isset($detalle["taller"]) ? $detalle["taller"] : '');
    $nombre_taller = isset($detalle["nombre_taller"]) ? $detalle["nombre_taller"] : (isset($detalle["nom_sector"]) ? $detalle["nom_sector"] : '');

    // Asegúrate de que todos los campos necesarios están presentes
    if (empty($detalle["fecha"]) || empty($detalle["guia"]) || empty($codigo_taller) || empty($nombre_taller) || empty($detalle["modelo"]) || empty($detalle["nombre"]) || empty($detalle["color"])) {
        // Omitir registros con datos incompletos
        continue;
    }

    $key = $detalle["fecha"] . '|' . $detalle["guia"] . '|' . $codigo_taller . '|' . $nombre_taller . '|' . $detalle["modelo"] . '|' . $detalle["nombre"] . '|' . $detalle["color"];

    if (!isset($groupedData[$key])) {
        // Inicializar el grupo
        $groupedData[$key] = [
            "fecha" => $detalle["fecha"],
            "guia" => $detalle["guia"],
            "codigo_taller" => $codigo_taller,
            "nombre_taller" => $nombre_taller,
            "modelo" => $detalle["modelo"],
            "nombre" => $detalle["nombre"],
            "color" => $detalle["color"],
            "tallas" => array_fill(1, 8, ["saldo" => 0]),
            "saldo_total" => 0
        ];
    }

    $talla = $detalle["cod_talla"];
    if (isset($tallas[$talla])) { // Verificar si la talla está definida
        $groupedData[$key]["tallas"][$talla]["saldo"] += $detalle["saldo"];
    }

    // Sumar totales
    $groupedData[$key]["saldo_total"] += $detalle["saldo"];
}

// Verificar el número de grupos (para depuración)
$numeroGrupos = count($groupedData);
error_log("Número de grupos: $numeroGrupos"); // Revisa el archivo de logs para ver este valor

// Inicializar $dataRow para las filas de datos
$dataRow = $headerRow + 1; // Comienza en la fila siguiente a los encabezados

// Escribir los datos agrupados en el Excel
foreach ($groupedData as $group) {
    // Escribir datos en la fila actual
    $objPHPExcel->getActiveSheet()->SetCellValue("A$dataRow", date('d/m/Y', strtotime($group["fecha"])));
    $objPHPExcel->getActiveSheet()->getStyle("A$dataRow")->getNumberFormat()->setFormatCode('dd/mm/yyyy');
    $objPHPExcel->getActiveSheet()->SetCellValueExplicit("B$dataRow", $group["guia"], PHPExcel_Cell_DataType::TYPE_STRING);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$dataRow", $group["codigo_taller"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D$dataRow", $group["nombre_taller"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$dataRow", $group["modelo"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$dataRow", $group["nombre"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$dataRow", $group["color"]);

    // Escribir saldos por talla
    $col = 'H';
    foreach ($tallas as $codigo => $nombre_talla) {
        $saldo = $group["tallas"][$codigo]["saldo"];
        $objPHPExcel->getActiveSheet()->SetCellValue("{$col}{$dataRow}", $saldo);
        $objPHPExcel->getActiveSheet()->getStyle("{$col}{$dataRow}")->getNumberFormat()->setFormatCode('#,##0');
        $col++;
    }

    // Escribir saldo total
    $objPHPExcel->getActiveSheet()->SetCellValue("{$col}{$dataRow}", $group["saldo_total"]);
    $objPHPExcel->getActiveSheet()->getStyle("{$col}{$dataRow}")->getNumberFormat()->setFormatCode('#,##0');

    // Incrementar $dataRow para la siguiente fila de datos
    $dataRow++;
}

// Aplicar bordes solo al contenido de la tabla
$tablaInicio = $headerRow; // Fila de encabezados
$tablaFinal = $dataRow - 1; // Última fila con datos
$tablaRango = "A$tablaInicio:$maxColumn$tablaFinal"; // Rango completo de la tabla

$objPHPExcel->getActiveSheet()->getStyle($tablaRango)->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);

// Ajustar alineaciones a la izquierda para todo el contenido de la tabla
$objPHPExcel->getActiveSheet()->getStyle("A$tablaInicio:G$tablaFinal")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
// $objPHPExcel->getActiveSheet()->getStyle("H$tablaInicio:$maxColumn$tablaFinal")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

// Autoajustar el ancho de las columnas
foreach (range('A', $maxColumn) as $columna) {
    $objPHPExcel->getActiveSheet()->getColumnDimension($columna)->setAutoSize(true);
}

// Crear el escritor y forzar la descarga del archivo Excel
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel); // Usar Excel5 para formato .xls

// Manejo de errores durante la generación del archivo
try {
    header("Content-Type: application/vnd.ms-excel");
    header('Content-Disposition: attachment; filename="Articulos_Agrupados_en_Talleres.xls"');
    // Forzar descarga por el navegador
    $objWriter->save('php://output');
} catch (Exception $e) {
    // Manejar el error, quizás registrar el error y mostrar un mensaje amigable al usuario
    error_log("Error al generar el Excel: " . $e->getMessage());
    echo "Ocurrió un error al generar el reporte.";
}

exit();
