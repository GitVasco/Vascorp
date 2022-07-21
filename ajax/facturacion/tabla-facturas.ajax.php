<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaGuiasRemision{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaGuiasRemision(){


        $factura = ControladorFacturacion::ctrRangoFechasFacturas($_GET["fechaInicial"],$_GET["fechaFinal"]);
        #$rutaCar  = "../imagenes_vasco/S03/cargos/C";
        #$rutaRep = "../imagenes_vasco/S03/recepcion/R";

        if(count($factura)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($factura); $i++){

            date_default_timezone_set('America/Lima');
            $hoy = date("Y-m-d");

            /* 
            *estado
            */
            if($factura[$i]["facturacion"] == "0" && $hoy == $factura[$i]["fecha"]){

                $estado = "<span style='font-size:85%' class='label label-success'>GENERADO</span>";
                
            }else if($factura[$i]["facturacion"] == "0" && $hoy >= $factura[$i]["fecha"]){

                $estado = "<span style='font-size:85%' class='label label-warning'>GENERADO</span>";
                
            }else if($factura[$i]["facturacion"] == "1"){

                $estado = "<span style='font-size:85%' class='label label-warning'>ERROR</span>";

            }else if($factura[$i]["facturacion"] == "2"){

                $estado = "<span style='font-size:85%' class='label label-primary'>ENVIADO</span>";

            }else if($factura[$i]["facturacion"] == "4"){

                $estado = "<span class='btn btn-danger btn-xs btn btnEliminarDocumento' documento='".$factura[$i]["documento"]."' tipo='".$factura[$i]["tipo"]."' pagina='facturas'>BAJA</span>";

            }

            $total = "<div style='text-align:right !important'>".number_format($factura[$i]["total"],2)."</div>";

            //* CARGO
            $rutaCar  = "../../".$factura[$i]["cargo"];
            

            if(file_exists($rutaCar) && $factura[$i]["cargo"] != "../imagenes_vasco/default/anonymous.png"){

                $cargo = "<a class='btn btn-xs btn-info' href='".$rutaCar."' download title='Descargar CARGO' >C</a>";

            }else{

                $cargo = "";

            }

            //*RECEPCION
            $rutaRep = "../../".$factura[$i]["recepcion"];

            if(file_exists($rutaRep) && $factura[$i]["recepcion"] != "../imagenes_vasco/default/anonymous.png"){

                $recepcion = "<a class='btn btn-xs btn-info' href='".$rutaRep."' download title='Descargar RECEPCION' >R</a>";

            }else{

                $recepcion = "";

            }

            if($factura[$i]["cuenta"] == null || $factura[$i]["cuenta"] == ""){

                $cuenta = "<button title='Cuenta' class='btn btn-xs btn-default btnCargarCuenta' tipo='".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."' data-toggle='modal' data-target='#modalCuenta'><i class='fa fa-certificate'></i></button>";

            }else{

                $cuenta = "<button title='Cuenta' class='btn btn-xs btn-warning btnCargarCuenta' tipo='".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."' data-toggle='modal' data-target='#modalCuenta'><i class='fa fa-certificate'></i></button>";

            }


            if($factura[$i]["facturacion"] == "0"){

                $botones =  "<div class='btn-group'><button title='Imprimir Factura' class='btn btn-xs btn-success btnImprimirFactura' tipo='".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."'><i class='fa fa-print'></i></button><button title='Anular Documento' class='btn btn-xs  btn-danger btnAnularDocumento' documento='".$factura[$i]["documento"]."' tipo='".$factura[$i]["tipo"]."' pagina='facturas'><i class='fa fa-close'></i></button><button title='Cargar Fotos' class='btn btn-xs btn-info btnCargarFotosFact' tipo='".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."' data-toggle='modal' data-target='#modalCargarFotos'><i class='fa fa-camera'></i></button>".$cuenta."</div>";

            }else{

                $botones =  "<div class='btn-group'><button title='Imprimir Factura' class='btn btn-xs btn-success btnImprimirFactura' tipo='".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."'><i class='fa fa-print'></i></button><button class='btn btn-xs btn-primary btnImprimirTicketFacBol' tipo='".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."'><i class='fa fa-file-word-o'></i></button><button title='Cargar Fotos' class='btn btn-xs btn-info btnCargarFotosFact' tipo='".$factura[$i]["tipo"]."' documento='".$factura[$i]["documento"]."' data-toggle='modal' data-target='#modalCargarFotos'><i class='fa fa-camera'></i></button>".$cuenta."</div>";

            }     


            $datosJson .= '[
            "'.$factura[$i]["tipo_documento"].'",
            "<b>'.$factura[$i]["documento"].'</b>",
            "'.$total.'",
            "'.$factura[$i]["cliente"].'",
            "<b>'.$factura[$i]["nombre"].'</b>",
            "'.$factura[$i]["vendedor"].'",
            "'.$factura[$i]["fecha"].'",
            "'.$factura[$i]["doc_destino"].'",
            "'.$factura[$i]["descripcion"].'",
            "'.$estado.'",
            "'.$factura[$i]["ubigeo"].'",
            "'.$factura[$i]["usureg"].'",
            "'.$cargo." ".$recepcion.'",
            "'.$botones.'"
            ],';
            }

            $datosJson=substr($datosJson, 0, -1);

            $datosJson .= ']

            }';

        echo $datosJson;
        }else{

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
$activarArticulosPedidos = new TablaGuiasRemision();
$activarArticulosPedidos -> mostrarTablaGuiasRemision();