<?php

require_once "../../controladores/cortes.controlador.php";
require_once "../../modelos/cortes.modelo.php";

class TablaEstampado
{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaEstampado()
    {

        $estampado = ModeloCortes::mdlMostrarEstampados(null);

        if (count($estampado) > 0) {

            $datosJson = '{
            "data": [';

            for ($i = 0; $i < count($estampado); $i++) {

                $botones =  "<div class='btn-group'><button type='button' class='btn btn-xs btn-warning btnEditarEstampado' idEstampado='" . $estampado[$i]["id"] . "'><i class='fa fa-pencil'></i></button><button  type='button' class='btn btn-xs btn-danger btnEliminarEstampado' idEstampado='" . $estampado[$i]["id"] . "' cantidad='" . $estampado[$i]["cantestampado"] . "'><i class='fa fa-times'></i></button></div> ";

                $datosJson .= '[
                "' . $estampado[$i]["fecha"] . '",
                "' . $estampado[$i]["modelo"] . '",
                "' . $estampado[$i]["nombre"] . '",
                "' . $estampado[$i]["color"] . '",
                "' . $estampado[$i]["talla"] . '",
                "' . $estampado[$i]["cantestampado"] . '",
                "' . $estampado[$i]["operario"] . '",
                "' . $botones . '"
                ],';
            }

            $datosJson = substr($datosJson, 0, -1);

            $datosJson .= '] 
    
                }';

            echo $datosJson;
        } else {

            echo '{
                    "data":[]
                }';
            return;
        }
    }
}

/*=============================================
ACTIVAR TABLA DE EDITAR DETALLE ORDEN CORTE
=============================================*/
$activarEditarOrdenCorte = new TablaEstampado();
$activarEditarOrdenCorte->mostrarTablaEstampado();
