<?php

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";

// require_once "../controladores/marcas.controlador.php";
// require_once "../modelos/marcas.modelo.php";

class TablaModelos{

    /*=============================================
    MOSTRAR LA TABLA DE MODELOS
    =============================================*/ 

    public function mostrarTablaModelos(){
        $item=null;
        $valor=null;

        $modelos = ControladorModelos::ctrMostrarModelos($item,$valor);	
        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($modelos); $i++){

        /*=============================================
        TRAEMOS LA IMAGEN
        =============================================*/ 

        $imagen = "<img src='".$modelos[$i]["imagen"]."' width='40px'>";

        /*=============================================
        ESTADO
        =============================================*/ 

        if($modelos[$i]["estado"] == "Descontinuado" || $modelos[$i]["estado"] == "DESCONTINUADO"){

            /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-danger btn-xs btnActivar' idModelo='".$modelos[$i]["modelo"]."' estadoModelo='Activo'>Inactivo</button>";

        }

        else{

            /* $estado = "<button class='btn btn-success btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-success btn-xs btnActivar' idModelo='".$modelos[$i]["modelo"]."' estadoModelo='Descontinuado'>Activo</button>";

        }

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/
        
        if( $_GET["perfil"]=="Supervisor" ||
            $_GET["perfil"]=="Sistemas"){

                $botones =  "<div class='btn-group'><button class='btn btn-primary btnVerModelo' modelo='".$modelos[$i]["modelo"]."' data-toggle='modal' data-target='#modalVerModelo'><i class='fa fa-eye'></i></button><button class='btn btn-warning btnEditarModelo' modelo='".$modelos[$i]["modelo"]."' data-toggle='modal' data-target='#modalEditarModelo'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarModelo' idModelo='".$modelos[$i]["id_modelo"]."' modelo='".$modelos[$i]["modelo"]."' imagen='".$modelos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";

        }else{

                $botones =  "<button class='btn btn-primary btnVerModelo' modelo='".$modelos[$i]["modelo"]."' data-toggle='modal' data-target='#modalVerModelo'><i class='fa fa-eye'></i></button><div class='btn-group'><button class='btn btn-warning btnEditarModelo' modelo='".$modelos[$i]["modelo"]."' data-toggle='modal' data-target='#modalEditarModelo'><i class='fa fa-pencil'></i></button></div>"; 

        }

        /*=============================================
        TRAEMOS LOS MODELOS QUE TIENEN OPERACION
        =============================================*/
        if( $modelos[$i]["operaciones"] == 1){

                $operaciones =  "<button class='btn btn-primary btn-xs'>Si tiene</button>";

        }else{

                $operaciones =  "<button class='btn btn-danger btn-xs'>Pendiente</button>";

        }

            $datosJson .= '[
            "'.($i+1).'",
            "'.$imagen.'",
            "'.$modelos[$i]["marca"].'",
            "'.$modelos[$i]["modelo"].'",
            "'.$modelos[$i]["nombre"].'",
            "'.$estado.'",
            "'.$modelos[$i]["tipo"].'",
            "'.$modelos[$i]["linea"].'",
            "'.$operaciones.'",
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
ACTIVAR TABLA DE MODELOS
=============================================*/ 
$activarModelos = new TablaModelos();
$activarModelos -> mostrarTablaModelos();