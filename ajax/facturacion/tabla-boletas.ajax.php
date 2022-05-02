<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaGuiasRemision{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/

    public function mostrarTablaGuiasRemision(){


        $boletas = ControladorFacturacion::ctrRangoFechasBoletas($_GET["fechaInicial"],$_GET["fechaFinal"]);

        if(count($boletas)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($boletas); $i++){

            date_default_timezone_set('America/Lima');
            $hoy = date("Y-m-d");

            /* 
            *estado
            */
            if($boletas[$i]["facturacion"] == "0" && $hoy == $boletas[$i]["fecha"]){

                $estado = "<span style='font-size:85%' class='label label-success'>GENERADO</span>";
                
            }else if($boletas[$i]["facturacion"] == "0" && $hoy >= $boletas[$i]["fecha"]){

                $estado = "<span style='font-size:85%' class='label label-warning'>GENERADO</span>";
                
            }else if($boletas[$i]["facturacion"] == "1"){

                $estado = "<span style='font-size:85%' class='label label-warning'>ERROR</span>";

            }else if($boletas[$i]["facturacion"] == "2"){

                $estado = "<span style='font-size:85%' class='label label-primary'>ENVIADO</span>";

            }else if($boletas[$i]["facturacion"] == "4"){

                $estado = "<span class='btn btn-danger btn-xs btn btnEliminarDocumento' documento='".$boletas[$i]["documento"]."' tipo='".$boletas[$i]["tipo"]."' pagina='facturas'>ANULADO</span>";

            }

            $total = "<div style='text-align:right !important'>".number_format($boletas[$i]["total"],2)."</div>";

            //* CARGO
            $rutaCar  = "../../".$boletas[$i]["cargo"];
            

            if(file_exists($rutaCar) && $boletas[$i]["cargo"] != "../imagenes_vasco/default/anonymous.png"){

                $cargo = "<a class='btn btn-xs btn-info' href='".$rutaCar."' download title='Descargar CARGO' >C</a>";

            }else{

                $cargo = "";

            }

            //*RECEPCION
            $rutaRep = "../../".$boletas[$i]["recepcion"];

            if(file_exists($rutaRep) && $boletas[$i]["recepcion"] != "../imagenes_vasco/default/anonymous.png"){

                $recepcion = "<a class='btn btn-xs btn-info' href='".$rutaRep."' download title='Descargar RECEPCION' >R</a>";

            }else{

                $recepcion = "";

            }            

            if($boletas[$i]["cuenta"] == null || $boletas[$i]["cuenta"] == ""){

                $cuenta = "<button title='Cuenta' class='btn btn-xs btn-default btnCargarCuenta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."' data-toggle='modal' data-target='#modalCuenta'><i class='fa fa-certificate'></i></button>";

            }else{

                $cuenta = "<button title='Cuenta' class='btn btn-xs btn-warning btnCargarCuenta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."' data-toggle='modal' data-target='#modalCuenta'><i class='fa fa-certificate'></i></button>";

            }            

            if($boletas[$i]["facturacion"] == "0"){

                $botones =  "<div class='btn-group'><button title='Imprimir Factura' class='btn btn-xs btn-success btnImprimirBoleta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-print'></i></button><button title='Anular Documento' class='btn btn-xs  btn-danger btnAnularDocumento' documento='".$boletas[$i]["documento"]."' tipo='".$boletas[$i]["tipo"]."' pagina='facturas'><i class='fa fa-close'></i></button><button title='Cargar Fotos' class='btn btn-xs btn-info btnCargarFotosFact' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."' data-toggle='modal' data-target='#modalCargarFotos'><i class='fa fa-camera'></i></button>".$cuenta."</div>";

            }else{

                $botones =  "<div class='btn-group'><button title='Imprimir Factura' class='btn btn-xs btn-success btnImprimirBoleta' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-print'></i></button><button class='btn btn-xs btn-primary btnImprimirTicketFacBol' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."'><i class='fa fa-file-word-o'></i></button><button title='Cargar Fotos' class='btn btn-xs btn-info btnCargarFotosFact' tipo='".$boletas[$i]["tipo"]."' documento='".$boletas[$i]["documento"]."' data-toggle='modal' data-target='#modalCargarFotos'><i class='fa fa-camera'></i></button>".$cuenta."</div>";

            }            



            $datosJson .= '[
            "'.$boletas[$i]["tipo_documento"].'",
            "<b>'.$boletas[$i]["documento"].'</b>",
            "'.$total.'",
            "'.$boletas[$i]["cliente"].'",
            "<b>'.$boletas[$i]["nombre"].'</b>",
            "'.$boletas[$i]["vendedor"].'",
            "'.$boletas[$i]["fecha"].'",
            "'.$boletas[$i]["doc_destino"].'",
            "'.$boletas[$i]["descripcion"].'",
            "'.$estado.'",
            "'.$boletas[$i]["ubigeo"].'",
            "'.$boletas[$i]["usureg"].'",
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