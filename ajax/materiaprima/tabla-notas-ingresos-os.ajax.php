<?php

require_once "../../controladores/notas-ingresos.controlador.php";
require_once "../../modelos/notas-ingresos.modelo.php";

class TablaNotasIngresosOS{

    /*=============================================
    MOSTRAR LA TABLA DE NOTAS Ingresos
    =============================================*/ 

    public function mostrarTablaNotasIngresosOS(){
        
        $notasIngresos = ControladorNotasIngresos::ctrRangoFechasNotasIngresosOS($_GET["fechaInicial"], $_GET["fechaFinal"]);	

        if(count($notasIngresos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($notasIngresos); $i++){

       
     
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/    
        $botones =  "<div class='btn-group' ><button class='btn btn-xs btn-primary btnVisualizarNotaIngresoServicio' title='Visualizar Nota de Ingreso' idNotaIngresoServicio='".$notasIngresos[$i]["nneaos"]."' data-toggle='modal' data-target='#modalVizualizarNotaIngresoServicio'><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-outline-success pull-right btnDetalleReporteNotaIngresoServicio' idNotaIngresoServicio='".$notasIngresos[$i]["nneaos"]."' title='Reporte Nota de Ingreso' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='15px'></button></div>"; 

            $datosJson .= '[
            "'.$notasIngresos[$i]["tneaos"].'",
            "'.$notasIngresos[$i]["fecemi"].'",
            "'.$notasIngresos[$i]["nneaos"].'",
            "'.$notasIngresos[$i]["proveedor"].'",
            "'.$notasIngresos[$i]["nroos"].'",
            "'.$notasIngresos[$i]["nrodcto"].'",
            "'.$notasIngresos[$i]["usureg"].'",
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
ACTIVAR TABLA DE NOTAS Ingresos
=============================================*/ 
$activarNotasIngresosOS = new TablaNotasIngresosOS();
$activarNotasIngresosOS -> mostrarTablaNotasIngresosOS();