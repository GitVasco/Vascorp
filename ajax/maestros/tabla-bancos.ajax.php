<?php

require_once "../../controladores/bancos.controlador.php";
require_once "../../modelos/bancos.modelo.php";

class TablaBancos{

    /*=============================================
    MOSTRAR LA TABLA DE BANCOS
    =============================================*/ 

    public function mostrarTablaBancos(){

        $item = null;     
        $valor = null;

        $banco = ControladorBancos::ctrMostrarBancos($item, $valor);	
        if(count($banco)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($banco); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-sm btn-warning btnEditarBanco' idBanco='".$banco[$i]["id"]."' data-toggle='modal' data-target='#modalEditarBanco'><i class='fa fa-pencil'></i></button><button class='btn btn-sm btn-danger btnEliminarBanco' idBanco='".$banco[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.$banco[$i]["codigo"].'",
            "'.$banco[$i]["descripcion"].'",
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
ACTIVAR TABLA DE BANCOS
=============================================*/ 
$activarBancos = new TablaBancos();
$activarBancos -> mostrarTablaBancos();

