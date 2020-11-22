<?php

require_once "../controladores/servicio.controlador.php";
require_once "../modelos/servicio.modelo.php";

class TablaServicios{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaServicios(){

        $item = null;     
        $valor = null;

        $servicios = ControladorServicios::ctrMostrarServicios($item, $valor);	
        if(count($servicios)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($servicios); $i++){

        /*=============================================
        ESTADO
        =============================================*/ 

        if($servicios[$i]["estado"] == "INACTIVO"){

            /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-danger btn-xs btnActivarSer' >Inactivo</button>";

        }else{

            /* $estado = "<button class='btn btn-success btn-xs btnActivarArt'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-success btn-xs btnActivarSer' >Activo</button>";

        }

     
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarServicio' idServicio='".$servicios[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarServicio'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarServicio' idServicio='".$servicios[$i]["codigo"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$servicios[$i]["codigo"].'",
            "'.$servicios[$i]["usuario"].'",
            "'.$servicios[$i]["taller"].'",
            "'.$servicios[$i]["total"].'",
            "'.$servicios[$i]["fecha"].'",
            "'.$estado.'",
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
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
$activarServicios = new TablaServicios();
$activarServicios -> mostrarTablaServicios();