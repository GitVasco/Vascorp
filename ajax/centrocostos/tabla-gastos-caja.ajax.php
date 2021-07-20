<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaGastosCaja{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaGastosCaja(){

        $gastos = ControladorCentroCostos::ctrMostrarGastosCaja();	

        if(count($gastos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($gastos); $i++){  


            /* 
            * Monto
            */
            $total = "<div style='text-align:right !important'>".number_format($gastos[$i]["total"],2)."</div>";

            $datosJson .= '[
            
            "'.$gastos[$i]["fecha"].'",
            "'.$gastos[$i]["recibo"].'",
            "'.$gastos[$i]["proveedor"].'",
            "'.$gastos[$i]["nom_sucursal"].'",
            "'.$gastos[$i]["tipo_gasto"].'",
            "'.$gastos[$i]["cod_caja"].'",
            "<b>'.$gastos[$i]["nom_caja"].'</b>",
            "'.$total.'",
            "'.$gastos[$i]["nombre_documento"].'",
            "'.$gastos[$i]["documento"].'",
            "'.$gastos[$i]["solicitante"].'",
            "<b>'.$gastos[$i]["desc_salida"].'</b>"
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
ACTIVAR TABLA DE AGENCIAS
=============================================*/ 
$activarAgencias = new TablaGastosCaja();
$activarAgencias -> mostrarTablaGastosCaja();

