<?php

require_once "../../controladores/trabajador.controlador.php";
require_once "../../modelos/trabajador.modelo.php";

class TablaTrabajador2{

    /*=============================================
    MOSTRAR LA TABLA DE TRABAJADORES
    =============================================*/ 

    public function mostrarTablaTrabajador2(){

        $valor = null;

        $trabajador = ControladorTrabajador::ctrMostrarTrabajador2($valor);	
        if(count($trabajador)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($trabajador); $i++){  

        /*=============================================
        ESTADO
        =============================================*/ 

        if($trabajador[$i]["estado"] == 0){

            /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-danger btn-xs btnActivarTrabajador2' idTrabajador='".$trabajador[$i]["id"]."' estadoTrabajador='Activo'>Inactivo</button>";

        }

        else{

            /* $estado = "<button class='btn btn-success btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
            $estado = "<button class='btn btn-success btn-xs btnActivarTrabajador2' idTrabajador='".$trabajador[$i]["id"]."' estadoTrabajador='Inactivo'>Activo</button>";

        }

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-default  btnPaseLaboral' title='Pase laboral de trabajador' codigo='".$trabajador[$i]["id"]."' style='color:red'><i class='fa fa-file-pdf-o' ></i></button></div>"; 

            $datosJson .= '[
            "'.($key+1).'",
            "'.$trabajador[$i]["dni"].'",
            "'.$trabajador[$i]["nombres"].'",
            "'.$trabajador[$i]["ape_pat"].'",
            "'.$trabajador[$i]["ape_mat"].'",
            "'.$estado.'",
            "'.$trabajador[$i]["funcion"].'",
            "'.$trabajador[$i]["sector"].'",
            "'.$trabajador[$i]["funcion"].'",
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
$activarTrabajador2 = new TablaTrabajador2();
$activarTrabajador2 -> mostrarTablaTrabajador2();