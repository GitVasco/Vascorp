<?php

require_once "../../controladores/notas-ingresos.controlador.php";
require_once "../../modelos/notas-ingresos.modelo.php";

class TablaNotasIngresos{

    /*=============================================
    MOSTRAR LA TABLA DE NOTAS Ingresos
    =============================================*/ 

    public function mostrarTablaNotasIngresos(){
        
        $notasIngresos = ControladorNotasIngresos::ctrRangoFechasNotasIngresos($_GET["fechaInicial"], $_GET["fechaFinal"]);	

        if(count($notasIngresos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($notasIngresos); $i++){

       
     
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/    
        $botones =  ""; 

            $datosJson .= '[
            "'.$notasIngresos[$i]["tnea"].'",
            "'.$notasIngresos[$i]["fecemi"].'",
            "'.$notasIngresos[$i]["nnea"].'",
            "'.$notasIngresos[$i]["razpro"].'",
            "'.$notasIngresos[$i]["tipodoc"].'",
            "'.$notasIngresos[$i]["nrdcto"].'",
            "'.$notasIngresos[$i]["nroguiaasociada"].'",
            "'.$notasIngresos[$i]["nrooc"].'",
            "'.$notasIngresos[$i]["tnea"].'" 
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
ACTIVAR TABLA DE NOTAS Ingresos
=============================================*/ 
$activarNotasIngresos = new TablaNotasIngresos();
$activarNotasIngresos -> mostrarTablaNotasIngresos();