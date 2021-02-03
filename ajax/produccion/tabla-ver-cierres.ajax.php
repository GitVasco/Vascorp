<?php

require_once "../../controladores/cierres.controlador.php";
require_once "../../modelos/cierres.modelo.php";

class TablaVerCierres{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerCierres(){

        $item = null;     
        $valor = null;

        $cierres = ControladorCierres::ctrRangoFechasVerCierres($_GET["fechaInicial"],$_GET["fechaFinal"]);	
        if(count($cierres)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cierres); $i++){

    
            $datosJson .= '[
            "'.$cierres[$i]["cod_sector"]." - ".$cierres[$i]["nom_sector"].'",
            "'.$cierres[$i]["guia"].'",
            "'.$cierres[$i]["fechas"].'",
            "'.$cierres[$i]["codigo"].'",
            "'.$cierres[$i]["modelo"].'",
            "'.$cierres[$i]["nombre"].'",
            "'.$cierres[$i]["color"].'",
            "'.$cierres[$i]["t1"].'",
            "'.$cierres[$i]["t2"].'",
            "'.$cierres[$i]["t3"].'",
            "'.$cierres[$i]["t4"].'",
            "'.$cierres[$i]["t5"].'",
            "'.$cierres[$i]["t6"].'",
            "'.$cierres[$i]["t7"].'",
            "'.$cierres[$i]["t8"].'",
            "'.$cierres[$i]["total"].'"
            ],';        
            }

            $datosJson=substr($datosJson, 0, -1);

            $datosJson .= '] 

            }';

        echo $datosJson;
        }else{

            echo '{
                "data":[]
            }';
            return;

        }
    }

}

/*=============================================
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
$activarVerCierres = new TablaVerCierres();
$activarVerCierres -> mostrarTablaVerCierres();