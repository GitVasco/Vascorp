<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaCentroCostos{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaCentroCostos(){

        $valor = null;

        $centros = ControladorCentroCostos::ctrMostrarCentroCostos($valor);	

        if(count($centros)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($centros); $i++){  

            $datosJson .= '[
            
            "'.$centros[$i]["key_gasto"].'",
            "<b>'.$centros[$i]["tipo_gasto"].'</b>",
            "<b>'.$centros[$i]["nombre_gasto"].'</b>",
            "'.$centros[$i]["cod_area"].'",
            "<b>'.$centros[$i]["nombre_area"].'</b>",
            "'.$centros[$i]["cod_caja"].'",
            "<b>'.$centros[$i]["descripcion"].'</b>",
            "'.$centros[$i]["cc1"].'",
            "'.$centros[$i]["cc2"].'"
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
$activarAgencias = new TablaCentroCostos();
$activarAgencias -> mostrarTablaCentroCostos();

