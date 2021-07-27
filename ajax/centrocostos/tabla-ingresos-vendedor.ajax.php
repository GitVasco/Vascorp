<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaIngresosVendedor{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 
    public function mostrarTablaIngresosVendedor(){

        $mes = $_GET["mesI"];

        $ingresos = ControladorCentroCostos::ctrMostrarIngresosVendedor($mes);	

        if(count($ingresos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($ingresos); $i++){  


            /* 
            * Monto
            */
            $total = "<div style='text-align:right !important'>".number_format($ingresos[$i]["total"],2)."</div>";

            /* 
            * Botones
            */
            //$botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarGasto' idGasto='".$ingresos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarGasto'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularGasto' title='Anular Gasto' idGasto='".$ingresos[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[            
                "'.$ingresos[$i]["cod_responsable"].'",
                "<b>'.$ingresos[$i]["nom_responsable"].'</b>",
                "<b>'.$total.'</b>"
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
$activarTabla = new TablaIngresosVendedor();
$activarTabla -> mostrarTablaIngresosVendedor();

