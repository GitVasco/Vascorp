<?php

require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class TablaPedidosCV{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaPedidosCV(){

        $valor = null;

        $pedidos = ControladorPedidos::ctrMostraPedidosCabecera($valor);

        if(count($pedidos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($pedidos); $i++){

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

        $botones =  "<div class='btn-group'><button title='Editar Pedido' class='btn btn-warning btnEditarPedidoCV' codigo='".$pedidos[$i]["codigo"]."'><i class='fa fa-pencil-square-o'></i></button><button title='Imprimir Pedido' class='btn btn-success btnImprimirPedido' codigo='".$pedidos[$i]["codigo"]."'><i class='fa fa-print'></i></button><button title='Facturar Pedido' class='btn btn-primary btnFacturar' codigo='".$pedidos[$i]["codigo"]."' cod_cli='".$pedidos[$i]["cod_cli"]."'  nom_cli='".$pedidos[$i]["nombre"]."' tip_doc='".$pedidos[$i]["tipo_documento"]."' nro_doc='".$pedidos[$i]["documento"]."' dscto='".$pedidos[$i]["dscto"]."' cod_ven='".$pedidos[$i]["vendedor"]."' data-toggle='modal' data-target='#modalFacturar'><i class='fa fa-paper-plane'></i></button></div>";

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