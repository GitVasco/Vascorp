<?php
session_start();
require_once "../controladores/articulos.controlador.php";
require_once "../modelos/articulos.modelo.php";

require_once "../controladores/salidas.controlador.php";
require_once "../modelos/salidas.modelo.php";

require_once "../controladores/movimientos.controlador.php";
require_once "../modelos/movimientos.modelo.php";

require_once "../controladores/facturacion.controlador.php";
require_once "../modelos/facturacion.modelo.php";


class AjaxTransferencias
{
    public $codigo;

    public function ajaxProcesarTransferencia()
    {
        $codigo = $this->codigo;

        $cabecera = ModeloSalidas::mdlMostrarSalidasCabecera($codigo);

        $origen = $cabecera["ven_tra"] == "01" ? "stock01" : "stock05";
        $destino = $cabecera["cli_tra"] == "01" ? "stock01" : "stock05";

        $detalle = ModeloSalidas::mdlMostraDetallesTemporal("detalle_ing_sal", $codigo);

        $detallesA = "";
        $detallesB = "";

        date_default_timezone_set("America/Lima");
        $fecha = date("Y-m-d");

        foreach ($detalle as $key => $value) {
            $stock = ModeloArticulos::mdlActualizarStockTransferencia($value["articulo"], $value["cantidad"], $origen, $destino);

            $documento = $codigo;
            $cliente = $destino;
            $vendedor = $origen;
            $dscto = 0;
            $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto) / 100);

            foreach (array("E30" => "05", "S30" => "01") as $tipo => $almacen) {
                $doc = $tipo . $documento;
                $tipoMov = ModeloMovimientos::mdlCodigoMaestra("ttop", $tipo);
                $nombre_tipo = $tipoMov["descripcion"];

                $query = "(   '" . $tipo . "','" . $doc . "','" . $fecha . "','" . $value["articulo"] . "','" . $cliente . "','" . $vendedor . "'," . $value["cantidad"] . "," . $value["precio"] . ",0," . $dscto . "," . $total . ",'" . $nombre_tipo . "','" . $almacen . "')";

                if ($tipo == "E30") {
                    $detallesA .= $query . ",";
                } else {
                    $detallesB .= $query . ",";
                }
            }
        }

        // Elimina la última coma
        $detallesA = rtrim($detallesA, ',');
        $detallesB = rtrim($detallesB, ',');

        $respuestaMovimientosA = ModeloFacturacion::mdlRegistrarMovimientos($detallesA);
        $respuestaMovimientosB = ModeloFacturacion::mdlRegistrarMovimientos($detallesB);

        // todo_cabecera
        $respuestaDoc = ModeloSalidas::mdlMostrarSalidasCabecera($codigo);

        $tipos = array("E30", "S30");
        $documento = $codigo;
        $usuario = $_SESSION["id"];
        $docOrigen = $codigo;

        foreach ($tipos as $tipo) {
            $doc = $tipo . $documento;
            $tipoMov = ModeloMovimientos::mdlCodigoMaestra("ttop", $tipo);
            $nombre_tipo = $tipoMov["descripcion"];

            $datos = array(
                "tipo" => $tipo,
                "documento" => $doc,
                "neto" => $respuestaDoc["op_gravada"],
                "igv" => $respuestaDoc["igv"],
                "dscto" => $respuestaDoc["descuento_total"],
                "total" => $respuestaDoc["total"],
                "cliente" => $destino,
                "vendedor" => $origen,
                "agencia" => $respuestaDoc["agencia"],
                "lista_precios" => $respuestaDoc["lista"],
                "condicion_venta" => $respuestaDoc["condicion_venta"],
                "doc_destino" => '',
                "doc_origen" => $docOrigen,
                "usuario" => $usuario,
                "tipo_documento" => $nombre_tipo
            );

            $respuestaDocumento = ModeloSalidas::mdlRegistrarDocumentoSalida($datos);
        }

        $estado = ModeloSalidas::mdlActualizarSalidaF($codigo);


        echo json_encode($estado);
    }
}

if (isset($_POST["codigo"])) {

    $tipoPago = new AjaxTransferencias();
    $tipoPago->codigo = $_POST["codigo"];
    $tipoPago->ajaxProcesarTransferencia();
}
