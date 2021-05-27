<?php

require_once "../../controladores/maestras.controlador.php";
require_once "../../modelos/maestras.modelo.php";

class TablaMaestraCabecera{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMaestraCabecera(){

        $maestras = ControladorMaestras::ctrMostrarMaestrasCabecera();	
        if(count($maestras)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($maestras); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnCrearSubLinea' codigo='".$maestras[$i]["cod_tabla"]."' data-toggle='modal' data-target='#modalCrearSubLinea'><i class='fa fa-pencil'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$maestras[$i]["cod_tabla"].'",
            "'.$maestras[$i]["descripcion"].'",
            "'.$maestras[$i]["lon_campo"].'",
            "'.$maestras[$i]["tip_campo"].'",
            "'.$maestras[$i]["tip_generacion"].'",
            "'.$botones.'"
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
$activarAgencias = new TablaMaestraCabecera();
$activarAgencias -> mostrarTablaMaestraCabecera();

