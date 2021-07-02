<?php

require_once "../../controladores/procedimiento.controlador.php";
require_once "../../modelos/procedimiento.modelo.php";

class TablaSublimados{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaSublimados(){

        $sublimado = ControladorProcedimientos::ctrRangoFechasSublimados($_GET["fechaInicial"], $_GET["fechaFinal"]);	
        if(count($sublimado)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($sublimado); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarSublimado' idSublimado='".$sublimado[$i]["id"]."' data-toggle='modal' data-target='#modalEditarSublimado'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarSublimado' idSublimado='".$sublimado[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$sublimado[$i]["modelo"].'",
            "'.$sublimado[$i]["nombre"].'",
            "'.$sublimado[$i]["nom_color"].'",
            "'.$sublimado[$i]["cantidad"].'",
            "'.$sublimado[$i]["materia_prima"].'",
            "'.$sublimado[$i]["descripcion"].'",
            "'.$sublimado[$i]["color"].'",
            "'.$sublimado[$i]["fecha_inicio"].'",
            "'.$sublimado[$i]["fecha_fin"].'",
            "'.$sublimado[$i]["tiempo_utilizado"].'",
            "'.$sublimado[$i]["cod_corte"].'",
            "'.$sublimado[$i]["nom_user"].'",
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
ACTIVAR TABLA DE SUBLIMADOS
=============================================*/ 
$activarSublimados = new TablaSublimados();
$activarSublimados -> mostrarTablaSublimados();

