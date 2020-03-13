<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class TablaOperaciones{


    public function mostrarTablaDetalleOperaciones(){

        $item = null;     
        $valor = null;

        $operaciones = ControladorOperaciones::ctrMostrarCabeceraOperaciones($item, $valor);	

        
        
        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($operaciones); $i++){  
   
            
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarOperacion' idOperacion='".$operaciones[$i]["id"]."' ><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarOperacion' idOperacion='".$operaciones[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$operaciones[$i]["articulo"].'",
            "'.$operaciones[$i]["nombre"].'",
            "'.$operaciones[$i]["total_pd"].'",
            "'.$operaciones[$i]["total_ts"].'",
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
ACTIVAR TABLA DETALLE OPERACIONES
=============================================*/ 
$activarDetalleOperaciones = new TablaOperaciones();
$activarDetalleOperaciones -> mostrarTablaDetalleOperaciones();