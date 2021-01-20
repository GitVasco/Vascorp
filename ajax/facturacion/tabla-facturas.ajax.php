<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaGuiasRemision{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaGuiasRemision(){

        $tipo = "S03";
        $estado = "GENERADO";
        $valor = null;

        $factura = ControladorFacturacion::ctrMostrarTablas($tipo, $estado, $valor);

        if(count($factura)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($factura); $i++){

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

        if($factura[$i]["doc_destino"] != ""){
            $botones =  "<div class='btn-group'><button title='Editar Factura' class='btn btn-warning btnEditarFacturaCV' codigo='".$factura[$i]["documento"]."'><i class='fa fa-pencil-square-o'></i></button><button title='Facturar Pedido' class='btn btn-primary btnFacturarA' documento='".$factura[$i]["documento"]."' cod_cli='".$factura[$i]["cliente"]."'  nom_cli='".$factura[$i]["nombre"]."' tip_doc='".$factura[$i]["tip_doc"]."' nro_doc='".$factura[$i]["num_doc"]."' cod_ven='".$factura[$i]["vendedor"]."' serie_dest='".$factura[$i]["serie_dest"]."' nro_dest='".$factura[$i]["nro_dest"]."' data-toggle='modal' data-target='#modalFacturarA'><i class='fa fa-paper-plane'></i></button></div>";
        }else{

            $botones =  "<div class='btn-group'><button title='Editar Factura' class='btn btn-warning btnEditarFacturaCV' codigo='".$factura[$i]["documento"]."'><i class='fa fa-pencil-square-o'></i></button><button title='Facturar Pedido' class='btn btn-primary btnFacturarB' documento='".$factura[$i]["documento"]."' cod_cli='".$factura[$i]["cliente"]."'  nom_cli='".$factura[$i]["nombre"]."' tip_doc='".$factura[$i]["tip_doc"]."' nro_doc='".$factura[$i]["num_doc"]."' cod_ven='".$factura[$i]["vendedor"]."' data-toggle='modal' data-target='#modalFacturarB'><i class='fa fa-paper-plane'></i></button></div>";

        }


            $datosJson .= '[
            "'.$factura[$i]["tipo_documento"].'",
            "<b>'.$factura[$i]["documento"].'</b>",
            "'.$factura[$i]["total"].'",
            "'.$factura[$i]["cliente"].'",
            "<b>'.$factura[$i]["nombre"].'</b>",
            "'.$factura[$i]["vendedor"].'",
            "'.$factura[$i]["fecha"].'",
            "'.$factura[$i]["doc_destino"].'",
            "'.$factura[$i]["estado"].'",
            "'.$factura[$i]["agencia"].'",
            "'.$factura[$i]["ubigeo"].'",
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
$activarArticulosPedidos = new TablaGuiasRemision();
$activarArticulosPedidos -> mostrarTablaGuiasRemision();