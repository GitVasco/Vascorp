<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaGuiasRemision
{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaGuiasRemision()
    {


        $gremision = ModeloFacturacion::mdlRangoFechasGuiaRemision($_GET["fechaInicial"], $_GET["fechaFinal"]);

        if (count($gremision) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($gremision); $i++) {

                date_default_timezone_set('America/Lima');
                $hoy = date("Y-m-d");

                //* Estados

                if (substr($gremision[$i]["documento"], 0, 2) == "00") {

                    $estado = "<span style='font-size:85%' class='label label-primary'>ENVIADO</span>";
                } else {
                    if ($gremision[$i]["facturacion"] == "0" && $hoy == $gremision[$i]["fecha"]) {

                        $estado = "<span style='font-size:85%' class='label label-success'>GENERADO</span>";
                    } else if ($gremision[$i]["facturacion"] == "0" && $hoy >= $gremision[$i]["fecha"]) {

                        $estado = "<span style='font-size:85%' class='label label-warning'>GENERADO</span>";
                    } else if ($gremision[$i]["facturacion"] == "1") {

                        $estado = "<span style='font-size:85%' class='label label-warning'>ERROR</span>";
                    } else if ($gremision[$i]["facturacion"] == "2") {

                        $estado = "<span style='font-size:85%' class='label label-primary'>ENVIADO</span>";
                    } else if ($gremision[$i]["facturacion"] == "4") {

                        $estado = "<span class='btn btn-danger btn-xs btn btnEliminarDocumento' documento='" . $gremision[$i]["documento"] . "' tipo='" . $gremision[$i]["tipo"] . "' pagina='facturas'>BAJA</span>";
                    }
                }


                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/

                if ($gremision[$i]["doc_destino"] != "") {
                    $botones =  "<div class='btn-group'><button title='Editar Pedido' class='btn btn-xs btn-warning btnEditarGRemision' documento='" . $gremision[$i]["documento"] . "' cod_cli='" . $gremision[$i]["cliente"] . "'  nom_cli='" . $gremision[$i]["nombre"] . "' tip_doc='" . $gremision[$i]["tipo_doc"] . "' nro_doc='" . $gremision[$i]["num_doc"] . "' cod_ven='" . $gremision[$i]["vendedor"] . "' data-toggle='modal' data-target='#modalGremision'><i class='fa fa-pencil-square-o'></i></button><button title='Imprimir Guia' class='btn btn-xs  btn-success btnImprimirGuia' codigo='" . $gremision[$i]["documento"] . "' tip_doc='" . $gremision[$i]["tipo"] . "'><i class='fa fa-print'></i></button><button title='Facturar Pedido' class='btn btn-xs btn-primary btnFacturarA' documento='" . $gremision[$i]["documento"] . "' cod_cli='" . $gremision[$i]["cliente"] . "'  nom_cli='" . $gremision[$i]["nombre"] . "' tip_doc='" . $gremision[$i]["tipo_doc"] . "' nro_doc='" . $gremision[$i]["num_doc"] . "' cod_ven='" . $gremision[$i]["vendedor"] . "' serie_dest='" . $gremision[$i]["serie_dest"] . "' nro_dest='" . $gremision[$i]["nro_dest"] . "' data-toggle='modal' data-target='#modalFacturarA'><i class='fa fa-paper-plane'></i></button></div>";
                } else {

                    $botones =  "<div class='btn-group'><button title='Editar Pedido' class='btn btn-xs btn-warning btnEditarGRemision' documento='" . $gremision[$i]["documento"] . "' cod_cli='" . $gremision[$i]["cliente"] . "'  nom_cli='" . $gremision[$i]["nombre"] . "' tip_doc='" . $gremision[$i]["tipo_doc"] . "' nro_doc='" . $gremision[$i]["num_doc"] . "' cod_ven='" . $gremision[$i]["vendedor"] . "' data-toggle='modal' data-target='#modalGremision'><i class='fa fa-pencil-square-o'></i></button><button title='Imprimir Guia' class='btn btn-xs  btn-success btnImprimirGuia' codigo='" . $gremision[$i]["documento"] . "' tip_doc='" . $gremision[$i]["tipo"] . "'><i class='fa fa-print'></i></button><button title='Facturar Pedido' class='btn btn-xs btn-primary btnFacturarB' documento='" . $gremision[$i]["documento"] . "' cod_cli='" . $gremision[$i]["cliente"] . "'  nom_cli='" . $gremision[$i]["nombre"] . "' tip_doc='" . $gremision[$i]["tipo_doc"] . "' nro_doc='" . $gremision[$i]["num_doc"] . "' cod_ven='" . $gremision[$i]["vendedor"] . "' data-toggle='modal' data-target='#modalFacturarB'><i class='fa fa-paper-plane'></i></button></div>";
                }


                $datosJson .= '[
                    "' . $gremision[$i]["tipo_documento"] . '",
                    "<b>' . $gremision[$i]["documento"] . '</b>",
                    "' . $gremision[$i]["total"] . '",
                    "' . $gremision[$i]["cliente"] . '",
                    "<b>' . $gremision[$i]["nombre"] . '</b>",
                    "' . $gremision[$i]["vendedor"] . '",
                    "' . $gremision[$i]["fecha"] . '",
                    "' . $gremision[$i]["doc_destino"] . '",
                    "' . $estado . '",
                    "' . $gremision[$i]["agencia"] . '",
                    "' . $gremision[$i]["ubigeo"] . '",
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
ACTIVAR TABLA DE articulos
=============================================*/
$activarArticulosPedidos = new TablaGuiasRemision();
$activarArticulosPedidos->mostrarTablaGuiasRemision();
