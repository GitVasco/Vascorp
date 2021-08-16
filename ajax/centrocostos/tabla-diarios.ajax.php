<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaDiario{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaDiario(){

        $valor = $_GET["mesD"];

        $centros = ControladorCentroCostos::ctrMostrarDiario($valor);	

        if(count($centros)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($centros); $i++){  

            $concepto = str_replace('"','',$centros[$i]["concepto"]);
            $razon_social = str_replace('"','',$centros[$i]["razon_social"]);

            $debito = "<div style='text-align:right !important'>".number_format($centros[$i]["debito"],2)."</div>";

            $credito = "<div style='text-align:right !important'>".number_format($centros[$i]["credito"],2)."</div>";

            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarDiario' idDiario='".$centros[$i]["id"]."' data-toggle='modal' data-target='#modalEditarDiario'><i class='fa fa-pencil'></i></button></div>"; 

            if($centros[$i]["alerta"] == "0"){

                $alerta = "<button class='btn btn-default btn-xs btnAlertaD fa fa-ellipsis-h' ruc='".$centros[$i]["ruc"]."' documento='".$centros[$i]["documento"]."' estadoAlerta='1'></button>";

            }else if($centros[$i]["alerta"] == "1"){

                $alerta = "<button class='btn btn-danger btn-xs btnAlertaD fa fa-exclamation-circle' ruc='".$centros[$i]["ruc"]."' documento='".$centros[$i]["documento"]."' alerta='".$centros[$i]["alerta"]."' estadoAlerta='0'></button>";

            }

            $datosJson .= '[
            
            "'.$centros[$i]["tipo_gasto"].'",
            "A'.$centros[$i]["origen"].'-'.$centros[$i]["voucher"].'",
            "'.$centros[$i]["origen"].'",
            "'.$centros[$i]["voucher"].'",
            "'.$centros[$i]["cuenta"].'",
            "'.$centros[$i]["descripcion"].'",
            "'.$debito.'",
            "'.$credito.'",
            "'.$centros[$i]["moneda"].'",
            "'.$centros[$i]["tipo_cambio"].'",
            "'.$centros[$i]["fecha"].'",
            "<b>'.$concepto.'</b>",
            "'.$centros[$i]["ruc"].'",
            "'.$razon_social.'",
            "'.$centros[$i]["tipo_documento"].'",
            "'.$centros[$i]["documento"].'",
            "'.$centros[$i]["fecha_emision"].'",
            "'.$centros[$i]["fecha_vencimiento"].'",
            "'.$centros[$i]["sucursal"].'",
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

