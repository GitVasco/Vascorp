<?php

    //* USAMOS LAS LIBRERIAS
    //include "../reportes_excel/Classes/PHPExcel.php";
    require_once '../reportes_excel/Classes/PHPExcel/IOFactory.php';
    require_once '../reportes_excel/Classes/PHPExcel.php';
    require_once "../../controladores/usuarios.controlador.php";
    require_once "../../modelos/usuarios.modelo.php";
    require_once "../../controladores/facturacion.controlador.php";
    require_once "../../modelos/facturacion.modelo.php";
    require_once("../../extensiones/cantidad_en_letras.php");
    require_once("../../extensiones/cantidad_en_letras_v2.php");

    //*RECIBIMOS LOS DATOS
    $tipo = $_GET["tipo"];
    $documento = $_GET["documento"];

    //*CONECTAMOS CON LA DB
    $con=ControladorUsuarios::ctrMostrarConexiones("id",1);

    $conexion = mysql_connect($con["ip"], $con["user"], $con["pwd"]) or die("No se pudo conectar: " . mysql_error());
    mysql_select_db($con["db"], $conexion);
    
    //*CREAMOS E OBJETO
    $objPHPExcel = new PHPExcel(); 

    //*Query para la cabecera
    $feFacturaCab = ControladorFacturacion::ctrFEFacturaCab($tipo, $documento);

    //*FILA 1 
    $fila = 1;
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $feFacturaCab["a1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $feFacturaCab["b1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $feFacturaCab["c1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $feFacturaCab["d1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $feFacturaCab["e1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $feFacturaCab["f1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $feFacturaCab["g1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("N$fila", $feFacturaCab["n1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("Q$fila", $feFacturaCab["q1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("V$fila", $feFacturaCab["v1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $feFacturaCab["al1"]);

    if($feFacturaCab["ar1"] > 0){

        $objPHPExcel->getActiveSheet()->SetCellValue("AR$fila", $feFacturaCab["ar1"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("BH$fila", $feFacturaCab["bh1"]);

    }

    $objPHPExcel->getActiveSheet()->SetCellValue("BB$fila", $feFacturaCab["bb1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("BC$fila", $feFacturaCab["bc1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("BD$fila", $feFacturaCab["bd1"]);

    $fila = 2;

    $fila = 3;

    if(substr($feFacturaCab["a3"],0,4) == "0003"){

        $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $feFacturaCab["a3"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $feFacturaCab["b3"]);
    }

    if($feFacturaCab["c1"] == "01"){

        $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $feFacturaCab["e3"]);

    }

    $fila+= 1;
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $feFacturaCab["a4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $feFacturaCab["b4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $feFacturaCab["c4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $feFacturaCab["d4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $feFacturaCab["e4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $feFacturaCab["f4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $feFacturaCab["g4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $feFacturaCab["h4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $feFacturaCab["i4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $feFacturaCab["j4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $feFacturaCab["k4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $feFacturaCab["l4"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $feFacturaCab["m4"]);

    $fila+= 1;
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $feFacturaCab["a5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $feFacturaCab["b5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $feFacturaCab["c5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $feFacturaCab["d5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $feFacturaCab["e5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $feFacturaCab["f5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $feFacturaCab["g5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("H$fila", $feFacturaCab["h5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $feFacturaCab["i5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $feFacturaCab["j5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $feFacturaCab["k5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $feFacturaCab["l5"]);

    $fila+= 1;
    $monto_letras = convertir($feFacturaCab["n1"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $monto_letras);

    $fila+= 1;
    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $feFacturaCab["a7"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", $feFacturaCab["d7"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $feFacturaCab["e7"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $feFacturaCab["f5"]);
    $objPHPExcel->getActiveSheet()->SetCellValue("G$fila", $feFacturaCab["g5"]);

    $fila+= 1;

    //*Query para el detalle

    $feFacturaDet = ControladorFacturacion::ctrFEFacturaDet($tipo, $documento);

    $cont = 0;

    for($i = 0; $i < count($feFacturaDet); $i++){

        $cont+= 1;
        $fila+= 1;
        $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", $cont);
        $objPHPExcel->getActiveSheet()->SetCellValue("B$fila", $feFacturaDet[$i]["b9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("C$fila", $feFacturaDet[$i]["c9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("D$fila", utf8_encode($feFacturaDet[$i]["d9"]));
        $objPHPExcel->getActiveSheet()->SetCellValue("E$fila", $feFacturaDet[$i]["e9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("F$fila", $feFacturaDet[$i]["f9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("I$fila", $feFacturaDet[$i]["i9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("J$fila", $feFacturaDet[$i]["j9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("K$fila", $feFacturaDet[$i]["k9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("L$fila", $feFacturaDet[$i]["l9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("M$fila", $feFacturaDet[$i]["m9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("S$fila", $feFacturaDet[$i]["s9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("T$fila", $feFacturaDet[$i]["t9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("U$fila", $feFacturaDet[$i]["u9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("AK$fila", $feFacturaDet[$i]["ak9"]);
        $objPHPExcel->getActiveSheet()->SetCellValue("AL$fila", $feFacturaDet[$i]["al9"]);     

    }

    $fila+= 1;

    $objPHPExcel->getActiveSheet()->SetCellValue("A$fila", "FF00FF");




    //setting column heading
    /* $objPHPExcel->getActiveSheet()->setCellValue('A1',$tipo); 
    $objPHPExcel->getActiveSheet()->setCellValue('B1',$documento);  */
    

    
    //*CREAMOS EL ARCHIVO
    header('Content-type: text/csv');
    header('Content-Disposition: attachment;filename="20513613939-'.$feFacturaCab["c1"].'-'.$feFacturaCab["b1"].'.csv"');
    header('Cache-Control: max-age=0');
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
 
    $nombre = '20513613939-'.$feFacturaCab["c1"].'-'.$feFacturaCab["b1"].'.csv';
    $objWriter->save('csv_fe/'.$nombre.'');

    $origen = 'csv_fe/'.$nombre.'';

    if($feFacturaCab["c1"] == "01"){

        $destino = 'c:/daemonOSE21/documents/in/invoice/'.$nombre.'';

    }else{

        $destino = 'c:/daemonOSE21/documents/in/boleta/'.$nombre.'';

    }
    

    rename($origen, $destino);

    exit;

?>