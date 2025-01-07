<?php

require_once "../../controladores/arreglos.controlador.php";
require_once "../../modelos/arreglos.modelo.php";

// declaramos zona horaria
date_default_timezone_set('America/Lima');
class TablaArreglos
{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/

    public function mostrarTablaArreglos()
    {


        $arreglos = ControladorArreglos::ctrRangoFechasArreglos($_GET["fechaInicial"], $_GET["fechaFinal"]);
        if (count($arreglos) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($arreglos); $i++) {

                /*=============================================
        ESTADO
        =============================================*/

                if ($arreglos[$i]["estado"] == "INACTIVO") {

                    /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
                    $estado = "<button class='btn btn-danger btn-xs btnActivarCierre' >Inactivo</button>";
                } else {

                    /* $estado = "<button class='btn btn-success btn-xs btnActivarArt'>".$articulos[$i]["id"]."</button>"; */
                    $estado = "<button class='btn btn-success btn-xs btnActivarCierre' >Activo</button>";
                }

                if ($arreglos[$i]["estado_pago"] == "POR PAGAR") {

                    /* $estado = "<button class='btn btn-danger btn-xs btnActivar'>".$articulos[$i]["id"]."</button>"; */
                    $estado_pago = "<button class='btn btn-warning btn-xs btnPagarCierre' guiaCierre='" . $arreglos[$i]["guia"] . "' estadoPago='PAGADO'>POR PAGAR</button>";
                } else {

                    /* $estado = "<button class='btn btn-success btn-xs btnActivarArt'>".$articulos[$i]["id"]."</button>"; */
                    $estado_pago = "<button class='btn btn-primary btn-xs btnPagarCierre' guiaCierre='" . $arreglos[$i]["guia"] . "' estadoPago='POR PAGAR'>PAGADO</button>";
                }

                //tipo

                if ($arreglos[$i]["tipo"] == 1) {
                    $tipo = "<button class='btn btn-primary btn-xs'>Registro</button>";
                } else {
                    $tipo = "<button class='btn btn-danger btn-xs' >Cierre</button>";
                }

                /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/
                $fecha = substr($arreglos[$i]["fecha"], 0, 10);
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-info btnVisualizarCierre' title='Visualizar Cierre' data-toggle='modal' data-target='#modalVisualizarCierre' codigoCierre='" . $arreglos[$i]["codigo"] . "'><i class='fa fa-eye'></i></button></div>";

                $datosJson .= '[
            "' . ($i + 1) . '",
            "' . $tipo . '",
            "' . $arreglos[$i]["codigo"] . '",
            "' . $arreglos[$i]["guia"] . '",
            "' . $arreglos[$i]["nombre"] . '",
            "' . $arreglos[$i]["taller"] . " - " . $arreglos[$i]["nom_sector"] . '",
            "' . $arreglos[$i]["total"] . '",
            "' . $arreglos[$i]["pendiente"] . '",
            "' . $fecha . '",
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
ACTIVAR TABLA DE SERVICIOS
=============================================*/
$activarArreglos = new TablaArreglos();
$activarArreglos->mostrarTablaArreglos();
