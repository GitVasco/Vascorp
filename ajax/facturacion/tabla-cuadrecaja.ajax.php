<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaCuadreCaja
{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaCuadreCaja()
    {

        $fecha = $_GET["fecha"];
        $documento = ModeloFacturacion::mdlDocumentosCuadre($fecha);

        if (count($documento) > 0) {

            $datosJson = '{
                 "data": [';

            for ($i = 0; $i < count($documento); $i++) {

                $tipoDocumento = TablaCuadreCaja::obtenerTipoDocumento($documento[$i]["tipo"]);;

                $cuadres = ModeloFacturacion::mdlDocumentosCuadrePagos($tipoDocumento, $documento[$i]["documento"]);

                $formaPago = '<div>';
                $observacion = '<div>';
                $saldo = 0;
                foreach ($cuadres as $key => $value) {

                    $tipoPago = TablaCuadreCaja::obtenerTipoPago($value["cod_pago"]);


                    $formaPago .= '<p><b>' . $value["cod_pago"] . '</b> - ' . $tipoPago . ' - S/ ' . $value["monto"] . '</p>';

                    $observacion .= '<p>' . $value["notas"] . '</p>';

                    $saldo += $value["monto"];
                }
                $formaPago .= '</div>';
                $observacion .= '</div>';

                $total = "<div style='text-align:right !important'>" . number_format($documento[$i]["total"], 2) . "</div>";

                $nuevoSaldo = "<div style='text-align:right !important'>" .  number_format($documento[$i]["total"] - $saldo, 2) . "</div>";

                if ($documento[$i]["tipo_entrega"] == "1") {

                    $tipo_entrega = "<button class='btn btn-primary btn-xs btnTipoEntrega' documento=" . $documento[$i]["documento"] . " estadoArticulo='0'>ENVIO</button>";
                } else {

                    $tipo_entrega = "<button class='btn btn-success btn-xs btnTipoEntrega' documento=" . $documento[$i]["documento"] . " estadoArticulo='1'>TIENDA</button>";
                }

                $botones =  "<div class='btn-group'><button title='Agregar Pago' class='btn btn-xs btn-primary btnAgregarCobro' numcta=" . $documento[$i]["documento"] . " codcta=" . $tipoDocumento . " data-toggle='modal' data-target='#modalAgregarCuadre'><i class='fa fa-plus'></i></button></div>";

                $datosJson .= '[
                    "' . $documento[$i]["fecha"] . '",
                    "' . $documento[$i]["tipo_documento"] . '",
                    "' . $documento[$i]["cliente"] . '",
                    "' . $documento[$i]["nombre"] . '", 
                    "' . $documento[$i]["documento"] . '",
                    "' . $total . '",
                    "' . $nuevoSaldo . '",
                    "' . $tipo_entrega . '",
                    "' . $formaPago . '",
                    "' . $observacion . '",
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
    public function obtenerTipoPago($codigo)
    {
        switch ($codigo) {
            case '00':
                return 'LETRAS BCP';
            case '05':
                return 'DEP. CTACTE';
            case '06':
                return 'POS-BCP - YAPE';
            case '14':
                return 'CULQUI';
            case '80':
                return 'EFECTIVO';
            case '82':
                return 'ABONO EN CTA. S/.';
            default:
                return 'desconocido';
        }
    }

    public function obtenerTipoDocumento($codigo)
    {
        switch ($codigo) {
            case 'S02':
                return '03';
            case 'S03':
                return '01';
            case 'S05':
                return '08';
            case 'S70':
                return '09';
            case 'E05':
                return '07';
            default:
                return 'desconocido';
        }
    }
}

/*=============================================
ACTIVAR TABLA DE articulos
=============================================*/
$activarArticulosPedidos = new TablaCuadreCaja();
$activarArticulosPedidos->mostrarTablaCuadreCaja();
