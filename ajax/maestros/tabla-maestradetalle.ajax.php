<?php

require_once "../../controladores/maestras.controlador.php";
require_once "../../modelos/maestras.modelo.php";

class TablaMaestraDetalle
{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/

    public function mostrarTablaMaestraDetalle()
    {

        $valor = $_GET["codigoSubLinea"];
        $maestras = ControladorMaestras::ctrMostrarMaestrasDetalle($valor);
        if (count($maestras) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($maestras); $i++) {

                $des_larga = str_replace('"', '', $maestras[$i]["des_larga"]);


                /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/

                // $botones =  "<div class='btn-group'><button class='btn btn-warning btn-xs btnEditarSubLinea' codigo='".$maestras[$i]["cod_tabla"]."' argumento='".$maestras[$i]["cod_argumento"]."' data-toggle='modal' data-target='#modalEditarSubLinea'><i class='fa fa-pencil'></i></button></div>"; 

                $botones = "";

                $datosJson .= '[
            "' . $maestras[$i]["cod_tabla"] . '",
            "' . $maestras[$i]["cod_argumento"] . '",
            "' . $des_larga . '",
            "' . $maestras[$i]["des_corta"] . '",
            "' . $maestras[$i]["valor_1"] . '",
            "' . $maestras[$i]["valor_2"] . '",
            "' . $maestras[$i]["valor_3"] . '",
            "' . $maestras[$i]["valor_4"] . '",
            "' . $maestras[$i]["valor_5"] . '",
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
ACTIVAR TABLA DE AGENCIAS
=============================================*/
$activarTabla = new TablaMaestraDetalle();
$activarTabla->mostrarTablaMaestraDetalle();
