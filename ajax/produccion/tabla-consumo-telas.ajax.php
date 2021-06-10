<?php

require_once "../../controladores/almacencorte.controlador.php";
require_once "../../modelos/almacencorte.modelo.php";

class TablaConsumoTelas{

    /*=============================================
    MOSTRAR LA TABLA DE CONSUMO DE TELAS
    =============================================*/ 

    public function mostrarTablaConsumoTelas(){


        $consumoTelas = ControladorAlmacenCorte::ctrRangoFechasConsumoTelas($_GET["fechaInicial"], $_GET["fechaFinal"]);	
        if(count($consumoTelas)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($consumoTelas); $i++){

     
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         

            $datosJson .= '[
            "'.$consumoTelas[$i]["almacencorte"].'",
            "'.$consumoTelas[$i]["nota_salida"].'",
            "'.$consumoTelas[$i]["guia"].'",
            "'.$consumoTelas[$i]["fechas"].'",
            "'.$consumoTelas[$i]["mat_pri"]." - ".$consumoTelas[$i]["DesPro"].'",
            "'.$consumoTelas[$i]["Color"].'",
            "'.$consumoTelas[$i]["Unidad"].'",
            "'.$consumoTelas[$i]["Stk_Act"].'"
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
$activarTablaConsumoTelas = new TablaConsumoTelas();
$activarTablaConsumoTelas -> mostrarTablaConsumoTelas();