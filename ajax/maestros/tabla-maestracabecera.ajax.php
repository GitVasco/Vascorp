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

            /* 
            * boton en el codigo de tabla
            */

            $cod_tabla = "<button class='btn btn-link btn-xs btnActivarSubLinea' codigo='".$maestras[$i]["cod_tabla"]."'>".$maestras[$i]["cod_tabla"]."</button>";


        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs btnCrearSubLinea' codigo='".$maestras[$i]["cod_tabla"]."' descripcion='".$maestras[$i]["descripcion"]."' data-toggle='modal' data-target='#modalAgregarSubLinea'><i class='fa fa-plus'></i></button></div>"; 

            $datosJson .= '[
            "'.$cod_tabla.'",
            "'.$maestras[$i]["descripcion"].'",
            "'.$maestras[$i]["lon_campo"].'",
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
$activarTabla = new TablaMaestraCabecera();
$activarTabla -> mostrarTablaMaestraCabecera();

