<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaIngresosCaja{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 
    public function mostrarTablaIngresosCaja(){

        $mes = $_GET["mesI"];

        $ingresos = ControladorCentroCostos::ctrMostrarIngresosCaja($mes);	

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
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarIngreso' idIngreso='".$ingresos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarIngreso'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularIngreso' title='Anular Ingreso' idIngreso='".$ingresos[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[            
                "'.$ingresos[$i]["fecha"].'",
                "'.$ingresos[$i]["cod_ingreso"].'",
                "<b>'.$ingresos[$i]["nom_ingreso"].'</b>",
                "'.$ingresos[$i]["cod_responsable"].'",
                "<b>'.$ingresos[$i]["nom_responsable"].'</b>",
                "'.$ingresos[$i]["nom_documento"].'",
                "'.$ingresos[$i]["documento"].'",
                "<b>'.$total.'</b>",
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
$activarTabla = new TablaIngresosCaja();
$activarTabla -> mostrarTablaIngresosCaja();

