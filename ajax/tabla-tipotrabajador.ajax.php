<?php

require_once "../controladores/tipotrabajador.controlador.php";
require_once "../modelos/tipotrabajador.modelo.php";

class TablaTipoTrabajador{
 /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaTipoTrabajador(){

        $item = null;     
        $valor = null;

        $tipotrabajador = ControladorTipoTrabajador::ctrMostrarTipoTrabajador($item, $valor);	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($tipotrabajador); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarTipoTrabajador' idTipoTrabajador='".$tipotrabajador[$i]["cod_tip_tra"]."' data-toggle='modal' data-target='#modalEditarTipoTrabajador'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarTipoTrabajador' idTipoTrabajador='".$tipotrabajador[$i]["cod_tip_tra"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$tipotrabajador[$i]["nom_tip_trabajador"].'",
            "'.$tipotrabajador[$i]["detalle"].'",
            "'.$botones.'"
            ],';        
            }

            $datosJson=substr($datosJson, 0, -1);

            $datosJson .= '] 

            }';

        echo $datosJson;

    }

}
/*=============================================
ACTIVAR TABLA DE OPERACIONES
=============================================*/ 
$activarTipoTrabajador = new TablaTipoTrabajador();
$activarTipoTrabajador -> mostrarTablaTipoTrabajador();