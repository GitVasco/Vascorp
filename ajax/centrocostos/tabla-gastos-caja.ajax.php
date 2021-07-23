<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaGastosCaja{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaGastosCaja(){

        $mes = $_GET["mesG"];

        $gastos = ControladorCentroCostos::ctrMostrarGastosCaja($mes);	

        if(count($gastos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($gastos); $i++){  


            /* 
            * Monto
            */
            $total = "<div style='text-align:right !important'>".number_format($gastos[$i]["total"],2)."</div>";

            /* 
            * Botones
            */
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarGasto' idGasto='".$gastos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarGasto'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularGasto' title='Anular Gasto' idGasto='".$gastos[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[            
                "'.$gastos[$i]["fecha"].'",
                "'.$gastos[$i]["recibo"].'",
                "'.$gastos[$i]["proveedor"].'",
                "'.$gastos[$i]["nom_sucursal"].'",
                "'.$gastos[$i]["tipo_gasto"].'",
                "'.$gastos[$i]["cod_caja"].'",
                "<b>'.$gastos[$i]["nom_caja"].'</b>",
                "<b>'.$total.'</b>",
                "'.$gastos[$i]["nombre_documento"].'",
                "'.$gastos[$i]["documento"].'",
                "'.$gastos[$i]["solicitante"].'",
                "<b>'.$gastos[$i]["desc_salida"].'</b>",
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
$activarAgencias = new TablaGastosCaja();
$activarAgencias -> mostrarTablaGastosCaja();

