<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaErrores
{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaErrores()
    {


        $errores = ModeloFacturacion::mdlErrores();

        if (count($errores) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($errores); $i++) {

                $neto = "<div style='text-align:right !important'>" . number_format($errores[$i]["neto"], 2) . "</div>";
                $igv = "<div style='text-align:right !important'>" . number_format($errores[$i]["igv"], 2) . "</div>";
                $total = "<div style='text-align:right !important'>" . number_format($errores[$i]["total"], 2) . "</div>";
                $total_m = "<div style='text-align:right !important'>" . number_format($errores[$i]["total_m"], 2) . "</div>";
                //$dif_m_v = "<div style='text-align:right !important'>" .  number_format($errores[$i]["dif_m_v"], 2) . "</div>";
                //$dif_igv = "<div style='text-align:right !important'>" . number_format($errores[$i]["dif_igv"], 2) . "</div>";
                //$dif_total = "<div style='text-align:right !important'>" . number_format($errores[$i]["dif_total"], 2) . "</div>";
                $monto = "<div style='text-align:right !important'>" . number_format($errores[$i]["monto"], 2) . "</div>";
                //$dif_total_cc = "<div style='text-align:right !important'>" . number_format($errores[$i]["dif_total_cc"], 2) . "</div>";


                if ($errores[$i]["dif_m_v"] != 0) {
                    $dif_m_v = "<span style='font-size:85%;' class='label label-danger'>ERROR</span>";
                } else {
                    $dif_m_v = "";
                }

                if ($errores[$i]["dif_igv"] != 0) {
                    $dif_igv = "<span style='font-size:85%;' class='label label-danger'>ERROR</span>";
                } else {
                    $dif_igv = "";
                }

                if ($errores[$i]["dif_total"] != 0) {
                    $dif_total = "<span style='font-size:85%;' class='label label-danger'>ERROR</span>";
                } else {
                    $dif_total = "";
                }

                if ($errores[$i]["dif_total_cc"] != 0) {
                    $dif_total_cc = "<span style='font-size:85%;' class='label label-danger'>ERROR</span>";
                } else {
                    $dif_total_cc = "";
                }

                if ($errores[$i]["dif_m_v"] != 0 || $errores[$i]["dif_igv"] != 0 || $errores[$i]["dif_total"] != 0 || $errores[$i]["dif_total_cc"] != 0) {
                    $botones =  "<div class='btn-group'><button title='Corregir Error' class='btn btn-xs btn-success btnCorregir' tipo=" . $errores[$i]["tipo"] . " documento=" . $errores[$i]["documento"] . " neto_m=" . $errores[$i]["total_m"] . "><i class='fa fa-exclamation-circle'></i></button></div>";
                } else {
                    $botones =  "";
                }

                if ($errores[$i]["estado"] == "ENVIADO") {

                    $estado = "<span style='font-size:85%' class='label label-success'>" . $errores[$i]["estado"] . "</span>";
                } else {

                    $estado = "<span style='font-size:85%' class='label label-warning'>" . $errores[$i]["estado"] . "</span>";
                }

                $datosJson .= '[
                "' . $errores[$i]["fecha"] . '",
                "' . $errores[$i]["tipo_documento"] . '",
                "' . $errores[$i]["serie"] . '",
                "<b>' . $errores[$i]["documento"] . '</b>",
                "' . $neto . '",
                "' . $igv . '",
                "<b>' . $total . '</b>",
                "' . $total_m . '",
                "' . $dif_m_v . '",
                "' . $dif_igv . '",
                "' . $dif_total . '",
                "' . $monto . '",
                "' . $dif_total_cc . '",
                "' . $estado . '",
                "' . $errores[$i]["usureg"] . '",
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
$activarArticulosPedidos = new TablaErrores();
$activarArticulosPedidos->mostrarTablaErrores();
