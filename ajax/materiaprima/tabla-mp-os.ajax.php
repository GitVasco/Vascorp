<?php

require_once "../../controladores/notas-ingresos.controlador.php";
require_once "../../modelos/notas-ingresos.modelo.php";

class TablaMPOS
{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/

    public function mostrarTablaMPOS()
    {

        $enos = ControladorNotasIngresos::ctrMostrarMPOS();

        if (count($enos) > 0) {

            $datosJson = '{
            "data": [';

            for ($i = 0; $i < count($enos); $i++) {

                $descripcion = str_replace('"', '', $enos[$i]["desori"]);


                /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/

                $botones = "<div class='btn-group'><button class='btn btn-xs btn-primary agregarMPOS recuperarBoton' ordser='" . $enos[$i]["nro"] . "' codori='" . $enos[$i]["codproorigen"] . "' coddes='" . $enos[$i]["codprodestino"] . "' idBoton='" . $enos[$i]["nro"] . $enos[$i]["codproorigen"] . $enos[$i]["codprodestino"] . "'><i class='fa fa-plus'></i></button></div>";

                $datosJson .= '[
                "' . $enos[$i]["nro"] . '",
                "' . $descripcion . '",
                "' . $enos[$i]["codproorigen"] . '",
                "' . $enos[$i]["colorori"] . '",
                "' . $enos[$i]["codprodestino"] . '",
                "' . $enos[$i]["desdes"] . '",
                "' . $enos[$i]["colordes"] . '",
                "' . $enos[$i]["saldo"] . '",
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
$activarMateriaPrima = new TablaMPOS();
$activarMateriaPrima->mostrarTablaMPOS();
