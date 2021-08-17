<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaRegCompras{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaRegCompras(){

        $compras = ControladorCentroCostos::ctrMostrarRegCompras();	

        if(count($compras)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($compras); $i++){  

            $razon_social = str_replace('"','',$compras[$i]["razon_social"]);

            $total = "<div style='text-align:right !important'>".number_format($compras[$i]["total"],2)."</div>";


            /* 
            *comprobante
            */
            if($compras[$i]["comprobante"] == "0"){

                $comprobante = "<button class='btn btn-warning btn-xs fa fa-exclamation-triangle' title='Comprobante'></button>";

            }else if($compras[$i]["comprobante"] == "1"){

                $comprobante = "<button class='btn btn-danger btn-xs fa fa-window-close' title='Comprobante'></button>";

            }else if($compras[$i]["comprobante"] == "2"){

                $comprobante = "<button class='btn btn-success btn-xs fa fa-check-square' title='Comprobante'></button>";

            }

            /* 
            *contribuyente
            */
            if($compras[$i]["contribuyente"] == "0"){

                $contribuyente = "<button class='btn btn-warning btn-xs fa fa-exclamation-triangle' title='Contribuyente'></button>";

            }else if($compras[$i]["contribuyente"] == "1"){

                $contribuyente = "<button class='btn btn-danger btn-xs fa fa-window-close' title='Contribuyente'></button>";

            }else if($compras[$i]["contribuyente"] == "2"){

                $contribuyente = "<button class='btn btn-success btn-xs fa fa-check-square' title='Contribuyente'></button>";

            }   
            
            /* 
            *condicion
            */
            if($compras[$i]["condicion"] == "0"){

                $condicion = "<button class='btn btn-warning btn-xs fa fa-exclamation-triangle' title='Condición'></button>";

            }else if($compras[$i]["condicion"] == "1"){

                $condicion = "<button class='btn btn-danger btn-xs fa fa-window-close' title='Condición'></button>";

            }else if($compras[$i]["condicion"] == "2"){

                $condicion = "<button class='btn btn-success btn-xs fa fa-check-square' title='Condición'></button>";

            }

            /* 
            *estado
            */
            if($compras[$i]["estado"] == "0"){

                $estado = "<button class='btn btn-warning btn-xs fa fa-ellipsis-h' title='Por Validar'></button>";

            }else if($compras[$i]["estado"] == "1"){

                $estado = "<button class='btn btn-primary btn-xs fa fa-certificate' title='Validado'></button>";

            }

            $botones =  "<div class='btn-group'><button title='Consultar Estado' class='btn btn-xs btn-warning btnConsultarEstadoCompra' ruc='".$compras[$i]["ruc"]."' tipo = '".$compras[$i]["tipo_documento"]."' serie='".$compras[$i]["serie_doc"]."' correlativo = '".$compras[$i]["num_doc"]."' fecha='".$compras[$i]["fecha_emision"]."' monto='".number_format($compras[$i]["total"],2,".","")."'><i class='fa fa-search'></i></button></div>";

            $datosJson .= '[
            
                "'.$compras[$i]["mes"].'",
                "'.$compras[$i]["origen"].'",
                "'.$compras[$i]["voucher"].'",
                "'.$compras[$i]["ruc"].'",
                "'.$razon_social.'",
                "'.$compras[$i]["tipo_documento"].'",
                "'.$compras[$i]["serie_doc"].'",
                "'.$compras[$i]["num_doc"].'",
                "'.$total.'",
                "'.$compras[$i]["fecha_emision"].'",
                "'.$compras[$i]["fecha_vencimiento"].'",
                "<center>'.$comprobante.$contribuyente.$condicion.'</center>",
                "'.$estado.'",
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
ACTIVAR TABLA DE AGENCIAS
=============================================*/ 
$activarAgencias = new TablaRegCompras();
$activarAgencias -> mostrarTablaRegCompras();

