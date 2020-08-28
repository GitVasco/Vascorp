<?php

require_once "../controladores/tarjetas.controlador.php";
require_once "../modelos/tarjetas.modelo.php";

class TablaFichaTecnica{
 /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaFichaTecnica(){

        $item = null;     
        $valor = null;

        $fichaTecnica = ControladorTarjetas::ctrMostrarFichasTecnicas($item, $valor);	
        if(count($fichaTecnica)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($fichaTecnica); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarFichaTecnica' idFichaTecnica='".$fichaTecnica[$i]["id"]."' data-toggle='modal' data-target='#modalEditarFichaTecnica'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarFichaTecnica' idFichaTecnica='".$fichaTecnica[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$fichaTecnica[$i]["codigo"].'",
            "'.$fichaTecnica[$i]["archivo"].'",
            "'.$fichaTecnica[$i]["fecha_cambio"].'",
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
ACTIVAR TABLA DE OPERACIONES
=============================================*/ 
$activarFichaTecnica = new TablaFichaTecnica();
$activarFichaTecnica -> mostrarTablaFichaTecnica();