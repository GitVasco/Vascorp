<?php

require_once "../../controladores/orden-compra.controlador.php";
require_once "../../modelos/orden-compra.modelo.php";

class TablaMpOcDetalle
{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/

    public function mostrarTablaMpOcDetalle()
    {
        $item = "Nro";
        $valor = $_GET["idOrdenCompra"];

        $materiaprima = ControladorOrdenCompra::ctrMostrarDetallesOrdenCompra($item, $valor);

        if (count($materiaprima) > 0) {

            $datosJson = '{
            "data": [';

            for ($i = 0; $i < count($materiaprima); $i++) {

                $descripcion = str_replace('"', '', $materiaprima[$i]["despro"]);


                /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
                if ($materiaprima[$i]["estado"] == "CERRADA") {
                    $botones = "<div class='btn-group'><button class='btn  btn-xs   ' codpro='" . $materiaprima[$i]["id"] . "'   title='Cerrar Detalle' disabled><i class='fa fa-times-circle'></i> Cerrar</button></div>";
                    $estado = "<span class ='label label-danger'>" . $materiaprima[$i]["estado"] . "</span>";
                } elseif ($materiaprima[$i]["estado"] == "CERRADA") {
                    $estado = "<span class ='label label-warning'>" . $materiaprima[$i]["estado"] . "</span>";
                    $botones = "<div class='btn-group'><button class='btn  btn-xs  btnCerrarDetalleCompra ' codpro='" . $materiaprima[$i]["id"] . "' nro = '" . $materiaprima[$i]["Nro"] . "' title='Cerrar Detalle' ><i class='fa fa-times-circle'></i> Cerrar</button></div>";
                } else {
                    $estado = "<span class ='label label-success'>" . $materiaprima[$i]["estado"] . "</span>";
                    $botones = "<div class='btn-group'><button class='btn  btn-xs  btnCerrarDetalleCompra ' codpro='" . $materiaprima[$i]["id"] . "' nro = '" . $materiaprima[$i]["Nro"] . "' title='Cerrar Detalle' ><i class='fa fa-times-circle'></i> Cerrar</button></div>";
                }

                $cantidad = "<div style='text-align:right !important'>" . number_format($materiaprima[$i]["cantidad"], 4) . "</div>";
                $recibido = "<div style='text-align:right !important'>" . number_format($materiaprima[$i]["recibido"], 4) . "</div>";
                $pendiente = "<div style='text-align:right !important'>" . number_format($materiaprima[$i]["pendiente"], 4) . "</div>";

                $datosJson .= '[
                "' . ($i + 1) . '",
                "' . $materiaprima[$i]["id"] . '",
                "' . $descripcion . '",
                "' . $materiaprima[$i]["color"] . '",
                "' . $materiaprima[$i]["unidad"] . '",
                "' . $cantidad . '",
                "' . $recibido . '",
                "' . $pendiente . '",
                "' . $estado . '",
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
ACTIVAR TABLA DE MATERIA PRIMA
=============================================*/
$activarMateriaPrima = new TablaMpOcDetalle();
$activarMateriaPrima->mostrarTablaMpOcDetalle();
