<?php

require_once "../../controladores/salidas.controlador.php";
require_once "../../modelos/salidas.modelo.php";

class TablaSalidas
{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaSalidas()
    {

        $valor = null;

        $salidas = ControladorSalidas::ctrMostrarSalidasGeneral($valor);

        if (count($salidas) > 0) {

            $datosJson = '{

                "data": [';

            for ($i = 0; $i < count($salidas); $i++) {

                if (substr($salidas[$i]["codigo"], 0, 1) === "T") {

                    if ($salidas[$i]["estado"] == "GENERADO") {

                        $estado = "<button class='btn btn-basic btn-xs btnAprobarPedido' codigo='" . $salidas[$i]["codigo"] . "' estadoPedido='APROBADO'>GENERADO</button>";

                        $botones =  "<div class='btn-group'><a title='Editar Pedido' class='btn btn-xs btn-warning' href='index.php?ruta=crear-transferencias-apt&codigo=" . $salidas[$i]["codigo"] . "' codigo='" . $salidas[$i]["codigo"] . "'><i class='fa fa-pencil-square-o'></i></a><button title='Imprimir Salida' class='btn btn-xs btn-success btnImprimirTransferencia' codigo='" . $salidas[$i]["codigo"] . "'><i class='fa fa-print'></i></button><button title='Transferir' class='btn btn-xs btn-primary btnTransferirAPT' codigo='" . $salidas[$i]["codigo"] . "' ><i class='fa fa-paper-plane'></i></button></div>";
                    } else {

                        $estado = "<button class='btn btn-success btn-xs btn' codigo='" . $salidas[$i]["codigo"] . "' estadoPedido='FACTURADO'>FACTURADO</button>";

                        $botones =  "<div class='btn-group'><button title='Imprimir Salida' class='btn btn-xs btn-success btnImprimirTransferencia' codigo='" . $salidas[$i]["codigo"] . "'><i class='fa fa-print'></i></button></div>";
                    }


                    $almacenVen = $salidas[$i]["ven_tra"] == "01" ? "01 - Almacen APT" : "05 - Almacen Show Room";
                    $almacenCli = $salidas[$i]["cli_tra"] == "01" ? "01 - Almacen APT" : "05 - Almacen Show Room";


                    /*=============================================
                    TRAEMOS LAS ACCIONES
                    =============================================*/
                    $datosJson .= '[
                                "<b>' . $salidas[$i]["codigo"] . '</b>",
                                "' . $salidas[$i]["fecha"] . '",
                                "' . $almacenVen . '",
                                "' . $almacenCli . '",
                                "' . $salidas[$i]["nom_usu"] . '",
                                "' . $estado . '",
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
ACTIVAR TABLA DE articulos
=============================================*/
$activarArticulossalidas = new TablaSalidas();
$activarArticulossalidas->mostrarTablaSalidas();
