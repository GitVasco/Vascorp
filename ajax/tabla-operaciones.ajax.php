<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class TablaOperaciones{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaOperaciones(){

        $item = null;     
        $valor = null;

        $operaciones = ControladorOperaciones::ctrMostrarOperaciones($item, $valor);	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($operaciones); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarOperacion' idOperacion='".$operaciones[$i]["id"]."' data-toggle='modal' data-target='#modalEditarOperacion'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarOperacion' idOperacion='".$operaciones[$i]["id"]."' codigo='".$operaciones[$i]["codigo"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$operaciones[$i]["codigo"].'",
            "'.$operaciones[$i]["nombre"].'",
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
$activarOperaciones = new TablaOperaciones();
$activarOperaciones -> mostrarTablaOperaciones();