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
            /* 
            todo: TIPO DE ENVIO
            */
            if($factura[$i]["tipo"] == 'S03'){

                $tipo = '01';
                $origen = $factura[$i]["origen2"];

            }else if($factura[$i]["tipo"] == 'S02'){

                $tipo = '03';
                $origen = $factura[$i]["origen2"];

            }else if($factura[$i]["tipo"] == 'E05'){

                $tipo = '07';
                $origen =$factura[$i]["doc_origen"];

            }else{
                $tipo = '08';
                $origen = $factura[$i]["doc_origen"];
            }

            //NOMBRE DEL ARCHIVO DEL XML
            $archivo = "20513613939"."-".$tipo."-".substr($factura[$i]["documento"],0,4)."-".substr($factura[$i]["documento"],4,12);
            if($factura[$i]["facturacion"] == "2"){

                $envio = "<span style='font-size:85%' class='label label-success'>ENVIADO</span>";

                $botones =  "<div class='btn-group' ><a class='btn btn-xs btn-success' href='vistas/generar_xml/archivos_xml/".$archivo.".XML' download title='Descargar XML'>XML</a><button title='Consultar Estado' class='btn btn-xs btn-primary btnConsultarEstado' tipo = '".$tipo."' documento='".$factura[$i]["documento"]."' fecha='".$factura[$i]["fecha"]."' monto='".$factura[$i]["total"]."'><i class='fa fa-search'></i></button></div>"; 
            }else if($factura[$i]["facturacion"] == "1"){

                $envio = "<span style='font-size:85%' class='label label-danger'>ERROR</span>";
                
            $botones =  "<div class='btn-group'><button title='Generar XML' class='btn btn-xs btn-primary btnGenerarXMLCE' tipo = '".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."'><i class='fa fa-paper-plane'></i></button></div>";
       

            }else{

                $envio = "<span style='font-size:85%' class='label label-info'>SIN ENVIAR</span>";

                
            $botones =  "<div class='btn-group'><button title='Generar XML' class='btn btn-xs btn-primary btnGenerarXMLCE' tipo = '".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."'><i class='fa fa-paper-plane'></i></button></div>";
       

            }


            $datosJson .= '[
            "'.$factura[$i]["tipo_documento"].'",
            "<b>'.$factura[$i]["documento"].'</b>",
            "'.$factura[$i]["total"].'",
            "'.$factura[$i]["cliente"].'",
            "<b>'.$factura[$i]["nombre"].'</b>",
            "'.$factura[$i]["vendedor"].'",
            "'.$factura[$i]["fecha"].'",
            "'.$origen.'",
            "'.$factura[$i]["estado"].'",
            "'.$factura[$i]["agencia"].'",
            "'.$factura[$i]["ubigeo"].'",
            "'.$envio.'",
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