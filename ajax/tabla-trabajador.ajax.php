<?php

require_once "../controladores/trabajador.controlador.php";
require_once "../modelos/trabajador.modelo.php";

class TablaTrabajador{

    /*=============================================
    MOSTRAR LA TABLA DE TRABAJADORES
    =============================================*/ 

    public function mostrarTablaTrabajador(){

        $item = null;     
        $valor = null;

        $trabajador = ControladorTrabajador::ctrMostrarTrabajador($item, $valor);	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($trabajador); $i++){  

        /*=============================================
        ESTADO
        =============================================*/ 

        if($trabajador[$i]["estado"] == "Inactivo"){

            /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-danger btn-xs btnActivarTrabajador' idTrabajador='".$trabajador[$i]["cod_tra"]."' estadoTrabajador='Activo'>Inactivo</button>";

        }

        else{

            /* $estado = "<button class='btn btn-success btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-success btn-xs btnActivarTrabajador' idTrabajador='".$trabajador[$i]["cod_tra"]."' estadoTrabajador='Inactivo'>Activo</button>";

        }

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarTrabajador' idTrabajador='".$trabajador[$i]["cod_tra"]."' data-toggle='modal' data-target='#modalEditarTrabajador'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarTrabajador' idTrabajador='".$trabajador[$i]["cod_tra"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$trabajador[$i]["cod_tra"].'",
            "'.$trabajador[$i]["tipo_doc"].'",
            "'.$trabajador[$i]["nro_doc_tra"].'",
            "'.$trabajador[$i]["nom_tra"].'",
            "'.$trabajador[$i]["ape_pat_tra"].'",
            "'.$trabajador[$i]["ape_mat_tra"].'",
            "'.$trabajador[$i]["nom_tip_trabajador"].'",
            "'.$estado.'",
            "'.$trabajador[$i]["sueldo_total"].'",
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
$activarTrabajador = new TablaTrabajador();
$activarTrabajador -> mostrarTablaTrabajador();