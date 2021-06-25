<?php

require_once "../../controladores/orden-servicio.controlador.php";
require_once "../../modelos/orden-servicio.modelo.php";

class TablaOrdenServicio{

    /*=============================================
    MOSTRAR LA TABLA DE ORDEN DE SERVICIO
    =============================================*/ 

    public function mostrarTablaOrdenServicio(){


        $ordenservicio = ControladorOrdenServicio::ctrRangoFechasOrdenServicio($_GET["fechaInicial"], $_GET["fechaFinal"]);	
        if(count($ordenservicio)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($ordenservicio); $i++){

       
        

        if($ordenservicio[$i]["EstOS"] == 'EMITIDO'){

            $estado ="<span class ='label label-success'>".$ordenservicio[$i]["EstOS"]."</span>";
            $cerrar ="<button class ='btn btn-default btn-xs btn  btnCerrarOServicio' idOrdenServicio='".$ordenservicio[$i]["Nro"]."'>CERRAR</button>";
            

        }else if($ordenservicio[$i]["EstOS"] == 'CERRADA'){

            $estado ="<span class ='label label-danger'>".$ordenservicio[$i]["EstOS"]."</span>";
            $cerrar ="<button class ='btn btn-default btn-xs btn  ' disabled>CERRAR</button>";
            
        }else{

            $estado ="<span class ='label label-warning'>".$ordenservicio[$i]["EstOS"]."</span>";
            $cerrar ="<button class ='btn btn-default btn-xs btn  btnCerrarOServicio' idOrdenServicio='".$ordenservicio[$i]["Nro"]."'>CERRAR</button>";

        }
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/    
            $botones =  "<div class='btn-group' ><button class='btn btn-xs btn-primary btnVisualizarOrdenServicio' title='Visualizar Orden de servicio' idOrdenServicio='".$ordenservicio[$i]["Nro"]."' data-toggle='modal' data-target='#modalVizualizarOrdenServicio'><i class='fa fa-eye'></i></button><button class='btn btn-xs btn-outline-success pull-right btnDetalleReporteOrdenServicio' idOrdenServicio='".$ordenservicio[$i]["Nro"]."' title='Reporte Orden de servicio' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='15px'></button></div>"; 

        

            $datosJson .= '[
            "'.$ordenservicio[$i]["Tip"].'",
            "'.$ordenservicio[$i]["Ser"].'",
            "'.$ordenservicio[$i]["Nro"].'",
            "'.$ordenservicio[$i]["RazPro"].'",
            "'.$ordenservicio[$i]["FecEmi"].'",
            "'.$ordenservicio[$i]["UsuReg"].'",
            "'.$estado.'",
            "'.$cerrar.'",
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
ACTIVAR TABLA DE ORDEN DE SERVICIO
=============================================*/ 
$activarTablaOrdenServicio = new TablaOrdenServicio();
$activarTablaOrdenServicio -> mostrarTablaOrdenServicio();