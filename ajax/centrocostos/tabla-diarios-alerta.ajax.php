<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaDiario{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaDiario(){

        $centros = ControladorCentroCostos::ctrMostrarDiarioAlerta();	

        if(count($centros)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($centros); $i++){  

            $razon_social = str_replace('"','',$centros[$i]["razon_social"]);

            $total = "<div style='text-align:right !important'>".number_format($centros[$i]["total"],2)."</div>";

            /* 
            *Alerta
            */
            if($centros[$i]["alerta"] == "0"){

                $alerta = "<button class='btn btn-default btn-xs btnAlertaD fa fa-ellipsis-h' ruc='".$centros[$i]["ruc"]."' documento='".$centros[$i]["documento"]."' estadoAlerta='1'></button>";

            }else if($centros[$i]["alerta"] == "1"){

                $alerta = "<button class='btn btn-danger btn-xs btnAlertaD fa fa-exclamation-circle' ruc='".$centros[$i]["ruc"]."' documento='".$centros[$i]["documento"]."' alerta='".$centros[$i]["alerta"]."' estadoAlerta='0'></button>";

            }

            /* 
            *comprobante
            */
            if($centros[$i]["comprobante"] == "0"){

                $comprobante = "<button class='btn btn-warning btn-xs fa fa-exclamation-triangle'></button>";

            }else if($centros[$i]["comprobante"] == "1"){

                $comprobante = "<button class='btn btn-danger btn-xs fa fa-window-close'></button>";

            }else if($centros[$i]["comprobante"] == "2"){

                $comprobante = "<button class='btn btn-success btn-xs fa fa-check-square'></button>";

            }

            /* 
            *contribuyente
            */
            if($centros[$i]["contribuyente"] == "0"){

                $contribuyente = "<button class='btn btn-warning btn-xs fa fa-exclamation-triangle'></button>";

            }else if($centros[$i]["contribuyente"] == "1"){

                $contribuyente = "<button class='btn btn-danger btn-xs fa fa-window-close'></button>";

            }else if($centros[$i]["contribuyente"] == "2"){

                $contribuyente = "<button class='btn btn-success btn-xs fa fa-check-square'></button>";

            }   
            
            /* 
            *condicion
            */
            if($centros[$i]["condicion"] == "0"){

                $condicion = "<button class='btn btn-warning btn-xs fa fa-exclamation-triangle'></button>";

            }else if($centros[$i]["condicion"] == "1"){

                $condicion = "<button class='btn btn-danger btn-xs fa fa-window-close'></button>";

            }else if($centros[$i]["condicion"] == "2"){

                $condicion = "<button class='btn btn-success btn-xs fa fa-check-square'></button>";

            }



            $datosJson .= '[
            
            "'.$centros[$i]["mes"].'",
            "A'.$centros[$i]["origen"].'-'.$centros[$i]["voucher"].'",
            "'.$centros[$i]["cuenta"].'",
            "'.$centros[$i]["descripcion"].'",
            "'.$total.'",
            "'.$centros[$i]["ruc"].'",
            "'.$razon_social.'",
            "'.$centros[$i]["tipo_documento"].'",
            "'.$centros[$i]["serie_doc"].'",
            "'.$centros[$i]["num_doc"].'",
            "'.$centros[$i]["fecha_emision"].'",
            "'.$centros[$i]["fecha_vencimiento"].'",
            "<center>'.$comprobante.$contribuyente.$condicion.'</center>",
            "'.$alerta.'"
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
$activarAgencias = new TablaDiario();
$activarAgencias -> mostrarTablaDiario();

