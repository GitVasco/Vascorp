<?php

require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";
class TablaCuentas
{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/

    public function mostrarTablaCuentas()
    {

        $item = null;
        $valor = null;

        $cuenta = ControladorCuentas::ctrRangoFechasCuentas($_GET["ano"]);
        if (count($cuenta) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($cuenta); $i++) {
                /*=============================================
                TRAEMOS LAS ACCIONES
                =============================================*/
                if ($cuenta[$i]["estado"] == 'PENDIENTE') {
                    $estado =  "<button class='btn btn-danger btn-xs btnCancelacionDirecta' idCta='{$cuenta[$i]['id']}' tipo_doc='{$cuenta[$i]['tipo_doc']}' num_cta='{$cuenta[$i]['num_cta']}' cliente='{$cuenta[$i]['cliente']}' vendedor='{$cuenta[$i]['vendedor']}' monto='{$cuenta[$i]['monto']}' saldo='{$cuenta[$i]['saldo']}' fecha='{$cuenta[$i]['fecha']}' fecha_ven='{$cuenta[$i]['fecha_ven']}' doc_origen='{$cuenta[$i]['doc_origen']}'>PENDIENTE</button>";
                } else {
                    $estado =  "<button class='btn btn-success btn-xs'>CANCELADO</button>";
                }


                if ($cuenta[$i]["saldo"] == 0) {

                    $botones =  "<div class='btn-group'><button class='btn btn-xs btn-primary btnVisualizarCuenta' numCta='" . $cuenta[$i]["num_cta"] . "'  codCta='" . $cuenta[$i]["tipo_doc"] . "' title='Visualizar cuenta' ><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning btnEditarCuenta' idCuenta='" . $cuenta[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarCuenta' idCuenta='" . $cuenta[$i]["id"] . "' title='Eliminar cuenta'><i class='fa fa-times'></i></button></div>";
                } else {

                    if ($cuenta[$i]["tipo_doc"] == "01" || $cuenta[$i]["tipo_doc"] == "03") {

                        if ($cuenta[$i]["monto"] ==  $cuenta[$i]["saldo"]) {

                            $botones =  "<button class='btn btn-xs btn-primary btnVisualizarCuenta' style='margin-right: 10px;' numCta='" . $cuenta[$i]["num_cta"] . "' codCta='" . $cuenta[$i]["tipo_doc"] . "' title='Visualizar cuenta' ><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-info btnAgregarLetra' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' cliente='" . $cuenta[$i]["nombre"] . "' data-toggle='modal' data-target='#modalAgregarLetras' title='Agregar letra'><i style='color:white'  class='fa fa-usd'></i></button><button class='btn btn-xs btn-warning btnEditarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' title='Eliminar cuenta'><i class='fa fa-times'></i></button>";
                        } else {

                            $botones =  "<button class='btn btn-xs btn-primary btnVisualizarCuenta' style='margin-right: 10px;' numCta='" . $cuenta[$i]["num_cta"] . "' codCta='" . $cuenta[$i]["tipo_doc"] . "' title='Visualizar cuenta' ><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning btnEditarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' title='Eliminar cuenta'><i class='fa fa-times'></i></button>";
                        }
                    } else if ($cuenta[$i]["tipo_doc"] == "85" && $cuenta[$i]["estado"] == "PENDIENTE") {

                        if ($cuenta[$i]["protesta"] == "1") {

                            $botones =  "<button class='btn btn-xs btn-info btnDividirLetra' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' cliente='" . $cuenta[$i]["nombre"] . "'data-toggle='modal' data-target='#modalDividirLetra' title='Dividir letra'><i class='fa fa-random'></i></button><button class='btn btn-xs btn-primary btnVisualizarCuenta' style='margin-right: 10px;' numCta='" . $cuenta[$i]["num_cta"] . "' codCta='" . $cuenta[$i]["tipo_doc"] . "' title='Visualizar cuenta' ><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning btnEditarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-success btnImprimirLetra' style='margin-right: 10px;' numCuenta='" . $cuenta[$i]["num_cta"] . "' ><i class='fa fa-print'></i></button><button class='btn btn-xs btn-danger btnEliminarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' title='Eliminar cuenta'><i class='fa fa-times'></i></button><button class='btn btn-xs btn-basic btnCargoProtesto' style='margin-right: 10px;' num_cta='" . $cuenta[$i]["num_cta"] . "' cliente='" . $cuenta[$i]["cliente"] . "' title='Cargo de Protesto'><i class='fa fa-file'></i></button>";
                        } else {

                            $botones =  "<button class='btn btn-xs btn-info btnDividirLetra' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' cliente='" . $cuenta[$i]["nombre"] . "'data-toggle='modal' data-target='#modalDividirLetra' title='Dividir letra'><i class='fa fa-random'></i></button><button class='btn btn-xs btn-primary btnVisualizarCuenta' style='margin-right: 10px;' numCta='" . $cuenta[$i]["num_cta"] . "' codCta='" . $cuenta[$i]["tipo_doc"] . "' title='Visualizar cuenta' ><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning btnEditarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-success btnImprimirLetra' style='margin-right: 10px;' numCuenta='" . $cuenta[$i]["num_cta"] . "' ><i class='fa fa-print'></i></button><button class='btn btn-xs btn-danger btnEliminarCuenta' idCuenta='" . $cuenta[$i]["id"] . "' title='Eliminar cuenta'><i class='fa fa-times'></i></button>";
                        }
                    } else {

                        $botones =  "<button class='btn btn-xs btn-primary btnVisualizarCuenta' style='margin-right: 10px;' numCta='" . $cuenta[$i]["num_cta"] . "' codCta='" . $cuenta[$i]["tipo_doc"] . "' title='Visualizar cuenta' ><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-warning btnEditarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarCuenta' style='margin-right: 10px;' idCuenta='" . $cuenta[$i]["id"] . "' title='Eliminar cuenta'><i class='fa fa-times'></i></button>";
                    }
                }


                if ($cuenta[$i]["protesta"] == "1") {

                    $protesta =  "<button class='btn btn-danger btn-xs'>SI</button>";
                } else {

                    $protesta =  "";
                }

                $datosJson .= '[
                    "C' . $cuenta[$i]["tipo_doc"] . '",
                    "' . $cuenta[$i]["num_cta"] . '",
                    "' . $cuenta[$i]["cliente"] . " - " . $cuenta[$i]["nombre"] . '",
                    "' . $cuenta[$i]["vendedor"] . '",
                    "' . $cuenta[$i]["fecha"] . '",
                    "' . $cuenta[$i]["fecha_ven"] . '",
                    "' . number_format($cuenta[$i]["monto"], 2) . '",
                    "' . number_format($cuenta[$i]["saldo"], 2) . '",
                    "' . $estado . '",
                    "' . $cuenta[$i]["num_unico"] . '",
                    "<center>' . $protesta . '</center>",
                    "' . $cuenta[$i]["doc_origen"] . '",
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
ACTIVAR TABLA DE TIPO DE PAGO
=============================================*/
$activarCuentas = new TablaCuentas();
$activarCuentas->mostrarTablaCuentas();
