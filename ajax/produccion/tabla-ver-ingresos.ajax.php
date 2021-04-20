<?php

require_once "../../controladores/ingresos.controlador.php";
require_once "../../modelos/ingresos.modelo.php";

class TablaVerIngresos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerIngresos(){

        $item = null;     
        $valor = null;

        $ingresos = ControladorIngresos::ctrRangoFechasVerIngresos($_GET["fechaInicial"],$_GET["fechaFinal"]);	
       
        if(count($ingresos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($ingresos); $i++){

    
            $datosJson .= '[
            "'.$ingresos[$i]["cod_sector"]." - ".$ingresos[$i]["nom_sector"].'",
            "'.$ingresos[$i]["guia"].'",
            "'.$ingresos[$i]["fechas"].'",
            "'.$ingresos[$i]["documento"].'",
            "'.$ingresos[$i]["modelo"].'",
            "'.$ingresos[$i]["nombre"].'",
            "'.$ingresos[$i]["color"].'",
            "'.$ingresos[$i]["t1"].'",
            "'.$ingresos[$i]["t2"].'",
            "'.$ingresos[$i]["t3"].'",
            "'.$ingresos[$i]["t4"].'",
            "'.$ingresos[$i]["t5"].'",
            "'.$ingresos[$i]["t6"].'",
            "'.$ingresos[$i]["t7"].'",
            "'.$ingresos[$i]["t8"].'",
            "'.$ingresos[$i]["total"].'"
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
ACTIVAR TABLA DE VER INGRESOS
=============================================*/ 
$activarVerIngresos = new TablaVerIngresos();
$activarVerIngresos -> mostrarTablaVerIngresos();