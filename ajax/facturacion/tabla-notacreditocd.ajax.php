<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaNotasCD
{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaNotasCD()
    {

        $notas = ControladorFacturacion::ctrRangoFechasNotasCD($_GET["fechaInicial"], $_GET["fechaFinal"]);

        if (count($notas) > 0) {

            $datosJson = '{
            "data": [';

            for ($i = 0; $i < count($notas); $i++) {

                date_default_timezone_set('America/Lima');
                $hoy = date("Y-m-d");

                if ($notas[$i]["cuenta"] == null || $notas[$i]["cuenta"] == "") {

                    $cuenta = "<button title='Cuenta' class='btn btn-xs btn-default btnCargarCuenta' tipo='" . $notas[$i]["tipo"] . "' documento='" . $notas[$i]["documento"] . "' data-toggle='modal' data-target='#modalCuenta'><i class='fa fa-certificate'></i></button>";
                } else {

                    $cuenta = "<button title='Cuenta' class='btn btn-xs btn-warning btnCargarCuenta' tipo='" . $notas[$i]["tipo"] . "' documento='" . $notas[$i]["documento"] . "' data-toggle='modal' data-target='#modalCuenta'><i class='fa fa-certificate'></i></button>";
                }

                /* 
            todo: formato de miles
            */
                $serie = substr($notas[$i]["documento"], 0, 4);

                if ($notas[$i]["facturacion"] == "0" && $hoy == $notas[$i]["fecha"]) {

                    $estado = "<span style='font-size:85%' class='label label-success'>GENERADO</span>";
                } else if ($notas[$i]["facturacion"] == "0" && $hoy >= $notas[$i]["fecha"]) {

                    $estado = "<span style='font-size:85%' class='label label-warning'>GENERADO</span>";
                } else if ($notas[$i]["facturacion"] == "1") {

                    $estado = "<span style='font-size:85%' class='label label-warning'>ERROR</span>";
                } else if ($notas[$i]["facturacion"] == "2") {

                    $estado = "<span style='font-size:85%' class='label label-primary'>ENVIADO</span>";
                } else if ($notas[$i]["facturacion"] == "4") {

                    $estado = "<span class='btn btn-danger btn-xs btn btnEliminarDocumento' documento='" . $notas[$i]["documento"] . "' tipo='" . $notas[$i]["tipo"] . "' pagina='facturas'>ANULADO</span>";
                }



                #$estado = "<button class='btn btn-success btn-xs'>FACTURADO</button>";


                if ($serie == "B002" || $serie == "F002" || $serie = "B003" || $serie = "F003") {
                    $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarNotaCD' title='Editar notas CD' tipo='" . $notas[$i]["tipo"] . "' documento='" . $notas[$i]["documento"] . "'><i class='fa fa-pencil'></i></button><button title='Imprimir Nota Credito' class='btn btn-xs btn-success btnImprimirNotaCredito' tipo='" . $notas[$i]["tipo"] . "' documento='" . $notas[$i]["documento"] . "'><i class='fa fa-print'></i></button>" . $cuenta . "</div>";
                } else {
                    $botones =  "<div class='btn-group'><button title='Imprimir Nota Credito' class='btn btn-xs btn-success btnImprimirNotaCredito' tipo='" . $notas[$i]["tipo"] . "' documento='" . $notas[$i]["documento"] . "'><i class='fa fa-print'></i></button>" . $cuenta . "</div>";
                }

                if ($notas[$i]["nombre_tipo"] == "ND") {

                    $nombre_tipo = "<span style='font-size:85%' class='label label-primary'>" . $notas[$i]["nombre_tipo"] . "</span>";
                } else {

                    $nombre_tipo = "<span style='font-size:85%' class='label label-info'>" . $notas[$i]["nombre_tipo"] . "</span>";
                }

                $datosJson .= '[
                "' . $notas[$i]["tipo_documento"] . '",
                "' . $nombre_tipo . '",
                "' . $notas[$i]["documento"] . '",
                "' . $notas[$i]["total"] . '",
                "' . $notas[$i]["cliente"] . " - " . $notas[$i]["nombre"] . '",
                "' . $notas[$i]["fecha"] . '",
                "' . $notas[$i]["doc_origen"] . '",
                "' . $notas[$i]["fec_origen"] . '",
                "' . $notas[$i]["usuario"] . " - " . $notas[$i]["nombres"] . '",
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
ACTIVAR TABLA DE NOTAS
=============================================*/
$activarNotasCD = new TablaNotasCD();
$activarNotasCD->mostrarTablaNotasCD();
