<?php

require_once "../../controladores/articulos.controlador.php";
require_once "../../modelos/articulos.modelo.php";

class TablaArticulosArreglos
{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarArticuloArreglos()
    {

        $articulos = ModeloArticulos::mdlMostrarArticulosArreglos($_GET["sectorArreglos"]);
        if (count($articulos) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($articulos); $i++) {

                $bgnegro = "black";
                $bgblanco = "white";
                $bgplomo = "gray";
                $bglanvanda = "lavender";
                $bgrosado = "pink";
                $blanco = "#FFFFFF";
                $negro = "#000000";
                $beige = "#F5F5DC";
                $plomo = "#808080";
                $turquesa = "#40E0D0";
                $chicle = "#FF69B4";
                $coral = "#FF7F50";
                $celeste = "#ADD8E6";
                $rosado = "#FFC0CB";
                $rojo = "#FF0000";
                $azalea = "#FF00FF"; //fucsia
                $perla = "#FAFAD2"; //crema
                $verdeLima = "#32CD32";
                $vaqua = "#66CDAA";
                $lila = "#9370DB";
                $marron = "#A52A2A";
                $vino = "#8B0000";
                $uva = "#800080";
                $azulino = "#0000FF";
                $amarillo = "#FFFF00";
                $melon = "#FA8072";
                $cobalto = "#008080";
                $verde = "#008000";
                $neutro = "#000000";


                /* 
                todo: BOTONES
                */

                $botones =  "<div class='btn-group '><button class='btn btn-primary btn-xs  agregarArtiArreglo recuperarBoton' taller='" . $articulos[$i]["taller"] . "' articulo='" . $articulos[$i]["articulo"] . "' articuloArreglo='" . $articulos[$i]["id"] . "' idArreglo='" . $articulos[$i]["id"] . "'><i class='fa fa-plus-circle'></i></button></div>";

                /* 
                todo: STOCK
                */
                if ($articulos[$i]["stock"] >= 0) {

                    $stock = "<center><b><span style='color:" . $cobalto . "; background-color:" . $bgblanco . " ;'>" . $articulos[$i]["stock"] . "</span></b></center>";
                } else {

                    $stock = "<center><b><span style='color:" . $rojo . "; background-color:" . $bgrosado . " ;'>" . $articulos[$i]["stock"] . "</span></b></center>";
                }

                $datosJson .= '[
            "<center>' . $articulos[$i]["guia"] . '</center>",
            "<center>' . $articulos[$i]["codigo"] . '</center>",
            "<center>' . $articulos[$i]["modelo"] . '</center>",
            "<center>' . $articulos[$i]["color"] . '</center>",
            "<center>' . $articulos[$i]["talla"] . '</center>",
            "' . $stock . '",
            "<center>' . $articulos[$i]["pendiente"] . '</center>",
            "<center>' . $botones . '</center>"
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
ACTIVAR TABLA DE MATERIA PRIMA TARJETAS
=============================================*/
$activarArticuloTaller = new TablaArticulosArreglos();
$activarArticuloTaller->mostrarArticuloArreglos();
