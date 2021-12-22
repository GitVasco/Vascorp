<?php

require_once "../../controladores/mantenimiento.controlador.php";
require_once "../../modelos/mantenimiento.modelo.php";

class TablaMantenimientoDetalle{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMantenimientoDetalle(){

        $valor = $_GET["manteCab"];
        $mantenimiento = ControladorMantenimiento::ctrMostrarMantenimientoDetalle($valor);	

        if(count($mantenimiento)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($mantenimiento); $i++){  

        $des_larga = str_replace('"','',$mantenimiento[$i]["item"]);


        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btn-xs btnEditarManteDetalle' codpro='".$mantenimiento[$i]["codpro"]."' data-toggle='modal' data-target='#modalEditarMantenimiento'><i class='fa fa-pencil'></i></button></div>"; 

            $datosJson .= '[
            "'.$mantenimiento[$i]["cod_interno"].'",
            "'.$des_larga.'",
            "'.$mantenimiento[$i]["cantidad"].'",
            "'.$mantenimiento[$i]["precio"].'",
            "'.$mantenimiento[$i]["total"].'",
            "'.$mantenimiento[$i]["observacion"].'",
            "'.$mantenimiento[$i]["cod_interno"].'"
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
$activarTabla = new TablaMantenimientoDetalle();
$activarTabla -> mostrarTablaMantenimientoDetalle();

