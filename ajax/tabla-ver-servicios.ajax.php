<?php

require_once "../controladores/servicio.controlador.php";
require_once "../modelos/servicio.modelo.php";

class TablaVerServicios{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerServicios(){

        $item = null;     
        $valor = null;

        $servicios = ControladorServicios::ctrVisualizarServicioDetalle( $valor);	
        if(count($servicios)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($servicios); $i++){

    
            $datosJson .= '[
            "'.$servicios[$i]["cod_sector"]." - ".$servicios[$i]["nom_sector"].'",
            "'.$servicios[$i]["codigo"].'",
            "'.$servicios[$i]["modelo"].'",
            "'.$servicios[$i]["nombre"].'",
            "'.$servicios[$i]["color"].'",
            "'.$servicios[$i]["t1"].'",
            "'.$servicios[$i]["t2"].'",
            "'.$servicios[$i]["t3"].'",
            "'.$servicios[$i]["t4"].'",
            "'.$servicios[$i]["t5"].'",
            "'.$servicios[$i]["t6"].'",
            "'.$servicios[$i]["t7"].'",
            "'.$servicios[$i]["t8"].'",
            "'.$servicios[$i]["total"].'"
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
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
$activarVerServicios = new TablaVerServicios();
$activarVerServicios -> mostrarTablaVerServicios();