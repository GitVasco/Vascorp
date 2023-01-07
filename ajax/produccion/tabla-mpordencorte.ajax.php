<?php

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

class TablaProductosServicios
{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/

    public function mostrarTablaProductosServicios()
    {


        $articulos = controladorArticulos::ctrMostrarMPOC();

        if (count($articulos) > 0) {

            $datosJson = '{
                "data": [';

            for ($i = 0; $i < count($articulos); $i++) {

                if ($articulos[$i]["stock"] > $articulos[$i]["consumo"]) {
                    $estado = "<div style='text-align:right !important; color:blue'>OK</div>";
                } else {
                    $estado = "<div style='text-align:right !important; color:red'>Faltante</div>";
                }

                $consumo = "<div style='text-align:right !important;'>" . number_format($articulos[$i]["consumo"], 2) . "</div>";

                $stock = "<div style='text-align:right !important;'>" . number_format($articulos[$i]["stock"], 2) . "</div>";

                $datosJson .= '[
                    "' . $articulos[$i]["mat_pri"] . '",
                    "' . $articulos[$i]["codfab"] . '",
                    "' . $articulos[$i]["despro"] . '",
                    "' . $articulos[$i]["color"] . '",
                    "' . $articulos[$i]["talla"] . '",
                    "' . $consumo . '",
                    "' . $stock . '",
                    "' . $estado . '"
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/
$activarProductosServicios = new TablaProductosServicios();
$activarProductosServicios->mostrarTablaProductosServicios();
