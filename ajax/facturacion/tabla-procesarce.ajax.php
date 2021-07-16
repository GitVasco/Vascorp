<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaProcesarCE{

    /*=============================================
    MOSTRAR LA TABLA DE PROCESAR COMPROBANTE ELECTRONICO
    =============================================*/

    public function mostrarTablaProcesarCE(){


        $factura = ControladorFacturacion::ctrRangoFechasProcesarCE($_GET["fechaInicial"],$_GET["fechaFinal"],$_GET["tipo"]);

        if(count($factura)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($factura); $i++){

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

            $botones =  "<div class='btn-group'><button title='Generar XML' class='btn btn-xs btn-primary btnGenerarXMLCE' tipo = '".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."'><i class='fa fa-paper-plane'></i></button></div>";
       


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
ACTIVAR TABLA DE PROCESAR COMPROBANTES ELECTRONICOS
=============================================*/
$activarProcesoCE = new TablaProcesarCE();
$activarProcesoCE -> mostrarTablaProcesarCE();