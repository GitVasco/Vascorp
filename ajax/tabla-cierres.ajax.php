<?php

require_once "../controladores/cierres.controlador.php";
require_once "../modelos/cierres.modelo.php";

class TablaCierres{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaCierres(){

        $item = null;     
        $valor = null;

        $cierres = ControladorCierres::ctrMostrarCierres($item, $valor);	
        if(count($cierres)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cierres); $i++){

        /*=============================================
        ESTADO
        =============================================*/ 

        if($cierres[$i]["estado"] == "INACTIVO"){

            /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-danger btn-xs btnActivarCierre' >Inactivo</button>";

        }else{

            /* $estado = "<button class='btn btn-success btn-xs btnActivarArt'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-success btn-xs btnActivarCierre' >Activo</button>";

        }

     
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarCierre' idCierre='".$cierres[$i]["codigo"]."' data-toggle='modal' data-target='#modalEditarCierre'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCierre' idCierre='".$cierres[$i]["codigo"]."'><i class='fa fa-times'></i></button><button class='btn btn-outline-success pull-right btnDetalleCierre' idCierre='".$cierres[$i]["codigo"]."' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='18px'></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$cierres[$i]["codigo"].'",
            "'.$cierres[$i]["usuario"].'",
            "'.$cierres[$i]["taller"].'",
            "'.$cierres[$i]["total"].'",
            "'.$cierres[$i]["fecha"].'",
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
$activarCierres = new TablaCierres();
$activarCierres -> mostrarTablaCierres();