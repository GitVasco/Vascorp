<?php

require_once "../../controladores/talleres.controlador.php";
require_once "../../modelos/talleres.modelo.php";

class TablaEnTalleres
{

    /*
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaEnTalleres()
    {

        $taller = $_GET["taller"];
        $cortes = ControladorTalleres::ctrEnTalleres($taller);

        if (count($cortes) > 0) {


            //$botones = "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-eye'></i></button></div>";
            $botones = "";

            $datosJson = '{
            "data": [';

            for ($i = 0; $i < count($cortes); $i++) {

                if ($taller == "null") {

                    $datosJson .= '[
                        "' . $cortes[$i]["fecha"] . '",
                        "' . $cortes[$i]["guia"] . '",
                        "' . $cortes[$i]["taller"] . '",
                        "' . $cortes[$i]["modelo"] . '",
                        "' . $cortes[$i]["nombre"] . '",
                        "' . $cortes[$i]["color"] . '",
                        "' . $cortes[$i]["talla"] . '",
                        "' . $cortes[$i]["cantidad"] . '",
                        "' . $cortes[$i]["saldo"] . '",
                        "' . $botones . '"
                        ],';
                } else if ($cortes[$i]["taller"] == $taller) {
                    $datosJson .= '[
                        "' . $cortes[$i]["fecha"] . '",
                        "' . $cortes[$i]["guia"] . '",
                        "' . $cortes[$i]["taller"] . '",
                        "' . $cortes[$i]["modelo"] . '",
                        "' . $cortes[$i]["nombre"] . '",
                        "' . $cortes[$i]["color"] . '",
                        "' . $cortes[$i]["talla"] . '",
                        "' . $cortes[$i]["cantidad"] . '",
                        "' . $cortes[$i]["saldo"] . '",
                        "' . $botones . '"
                        ],';
                }
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
ACTIVAR TABLA DE orden$ordencorte
=============================================*/
$activarAlmacenCorte = new TablaEnTalleres();
$activarAlmacenCorte->mostrarTablaEnTalleres();
