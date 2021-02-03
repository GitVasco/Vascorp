<?php

require_once "../../controladores/almacencorte.controlador.php";
require_once "../../modelos/almacencorte.modelo.php";

class TablaVerCortes{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerCortes(){

        $item = null;     
        $valor = null;

        $cierres = ControladorAlmacenCorte::ctrRangoFechasVerCortes($_GET["fechaInicial"],$_GET["fechaFinal"]);	
        if(count($cierres)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cierres); $i++){

    
            $datosJson .= '[
            "'.$cierres[$i]["almacencorte"].'",
            "'.$cierres[$i]["fechas"].'",
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
            "'.$cierres[$i]["subtotal"].'"
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
$activarVerCortes = new TablaVerCortes();
$activarVerCortes -> mostrarTablaVerCortes();