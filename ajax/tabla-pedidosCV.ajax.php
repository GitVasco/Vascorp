<?php

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class TablaPedidosCV{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaPedidosCV(){

        $pedidos = controladorPedidos::ctrMostraPedidosCabecera();

        if(count($pedidos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($pedidos); $i++){

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

        $botones =  "<div class='btn-group'><button class='btn btn-primary btnEditarPedidoCV' codigo='".$pedidos[$i]["codigo"]."'><i class='fa fa-eye'></i></button><button class='btn btn-success btnImprimirPedido' codigo='".$pedidos[$i]["codigo"]."'><i class='fa fa-print'></i></button></div>";

            $datosJson .= '[
            "'.($i+1).'",
            "<b>'.$pedidos[$i]["codigo"].'</b>",
            "'.$pedidos[$i]["cod_cli"].'",
            "<b>'.$pedidos[$i]["nombre"].'</b>",
            "'.$pedidos[$i]["vendedor"].'",
            "<b>S/ '.$pedidos[$i]["total"].'</b>",
            "'.$pedidos[$i]["descripcion"].'",
            "'.$pedidos[$i]["estado"].'",
            "'.$pedidos[$i]["nom_usu"].'",
            "'.$pedidos[$i]["fecha"].'",
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
ACTIVAR TABLA DE articulos
=============================================*/
$activarArticulosPedidos = new TablaPedidosCV();
$activarArticulosPedidos -> mostrarTablaPedidosCV();