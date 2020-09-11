<?php

require_once "../controladores/produccion.controlador.php";
require_once "../modelos/produccion.modelo.php";

/* require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";
 */
class TablaQuincena{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaQuincena(){

        $valor = null;

        $quincena = ControladorProduccion::ctrMostrarQuincenas($valor);	

        if(count($quincena)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($quincena); $i++){

            /* 
            * BOTONES            
            */
            $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarQuincena' id='".$quincena[$i]["id"]."' data-toggle='modal' data-target='#modalEditarQuincena'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarQuincena' id='".$quincena[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 
     
            $datosJson .= '[
            "'.($i+1).'",
            "'.$quincena[$i]["ano"].'",
            "'.$quincena[$i]["mes"].'",
            "'.$quincena[$i]["quincena"].'",
            "'.$quincena[$i]["inicio"].'",
            "'.$quincena[$i]["fin"].'",
            "'.$quincena[$i]["nombre"].'",
            "'.$quincena[$i]["fecha_creacion"].'",
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
ACTIVAR TABLA DE ARTICULOS
=============================================*/ 
$activarArticulos = new TablaQuincena();
$activarArticulos -> mostrarTablaQuincena();