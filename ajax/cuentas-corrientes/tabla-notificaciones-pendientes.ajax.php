<?php

require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";
require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";
class TablaNotificacionesPendientes
{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/

    public function mostrarTablaNotificacionesPendientes()
    {


        $cuenta = ControladorCuentas::ctrNotificacionesPendientes();
        if (count($cuenta) > 0) {

            $datosJson = '{
        "data": [';

            for ($i = 0; $i < count($cuenta); $i++) {

                // si num_unico es diferente a null o vacio junto con telefono es diferente a null o vacio $botones tiene q tener un ✅ sino tiene que tener un ❌
                if ($cuenta[$i]["num_unico"] != null && $cuenta[$i]["num_unico"] != "" && $cuenta[$i]["telefono"] != null && $cuenta[$i]["telefono"] != "") {
                    $botones = "<button class='btn btn-success btn-xs btnEnviarNotificacion' idCuenta='" . $cuenta[$i]["id"] . "' num_unico='" . $cuenta[$i]["num_unico"] . "' telefono='" . $cuenta[$i]["telefono"] . "'><i class='fa fa-check'></i></button>";
                } else {
                    $botones = "<button class='btn btn-danger btn-xs btnEnviarNotificacion' idCuenta='" . $cuenta[$i]["id"] . "' num_unico='" . $cuenta[$i]["num_unico"] . "' telefono='" . $cuenta[$i]["telefono"] . "'><i class='fa fa-times'></i></button>";
                }

                //$botones = "<div class='btn-group'></div>";

                $datosJson .= '[
                    "' . $cuenta[$i]["num_cta"] . '",
                    "' . $cuenta[$i]["fecha"] . '",
                    "' . $cuenta[$i]["fecha_ven"] . '",
                    "' . $cuenta[$i]["vendedor"] . '",
                    "' . $cuenta[$i]["saldo"] . '",
                    "' . $cuenta[$i]["num_unico"] . '",
                    "' . $cuenta[$i]["nombre"] . '",
                    "' . $cuenta[$i]["telefono"] . '",
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
$activarNotificacionesPendientes = new TablaNotificacionesPendientes();
$activarNotificacionesPendientes->mostrarTablaNotificacionesPendientes();
