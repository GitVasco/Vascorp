<?php

require_once "../../controladores/ingresos.controlador.php";
require_once "../../modelos/ingresos.modelo.php";

class TablaAjustes
{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/

    public function mostrarTablaAjustes()
    {

        $ajustes = ControladorIngresos::ctrMostraAjustes();

        if (count($ajustes) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($ajustes); $i++) {

                /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

                $datosJson .= '[
                                    "' . $ajustes[$i]["tipo"] . '",
                                    "' . $ajustes[$i]["documento"] . '",
                                    "' . $ajustes[$i]["fecha"] . '",
                                    "' . $ajustes[$i]["articulo"] . '",
                                    "' . $ajustes[$i]["modelo"] . '",
                                    "' . $ajustes[$i]["nombre"] . '",
                                    "' . $ajustes[$i]["color"] . '",
                                    "' . $ajustes[$i]["talla"] . '",
                                    "' . number_format($ajustes[$i]["cantidad"], 0) . '",
                                    "' . $ajustes[$i]["cliente"] . '"
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
ACTIVAR TABLA DE ajustesS
=============================================*/
$activarajustess = new TablaAjustes();
$activarajustess->mostrarTablaAjustes();
