<?php

require_once "../../controladores/almacencorte.controlador.php";
require_once "../../modelos/almacencorte.modelo.php";

class TablaVerAlmacenCortes{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerAlmacenCortes(){

        $item = null;     
        $valor = $_GET["codigo"];

        $almacencortes = ControladorAlmacenCorte::ctrVisualizarAlmacenCorteDetalle($valor);	
        if(count($almacencortes)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($almacencortes); $i++){

    
            $datosJson .= '[
            "'.$almacencortes[$i]["almacencorte"].'",
            "'.$almacencortes[$i]["fechas"].'",
            "'.$almacencortes[$i]["modelo"].'",
            "'.$almacencortes[$i]["nombre"].'",
            "'.$almacencortes[$i]["color"].'",
            "'.$almacencortes[$i]["t1"].'",
            "'.$almacencortes[$i]["t2"].'",
            "'.$almacencortes[$i]["t3"].'",
            "'.$almacencortes[$i]["t4"].'",
            "'.$almacencortes[$i]["t5"].'",
            "'.$almacencortes[$i]["t6"].'",
            "'.$almacencortes[$i]["t7"].'",
            "'.$almacencortes[$i]["t8"].'",
            "'.$almacencortes[$i]["subtotal"].'"
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
$activarVerAlmacenCortes = new TablaVerAlmacenCortes();
$activarVerAlmacenCortes -> mostrarTablaVerAlmacenCortes();