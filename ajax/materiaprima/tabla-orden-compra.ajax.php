<?php

require_once "../../controladores/orden-compra.controlador.php";
require_once "../../modelos/orden-compra.modelo.php";

class TablaOrdenCompra{

    /*=============================================
    MOSTRAR LA TABLA DE ORDEN DE COMPRA
    =============================================*/ 

    public function mostrarTablaOrdenCompra(){


        $ordencompra = ControladorOrdenCompra::ctrRangoFechasOrdenCompra($_GET["fechaInicial"], $_GET["fechaFinal"]);	
        if(count($ordencompra)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($ordencompra); $i++){

       
        

        if($ordencompra[$i]["Estac"] == 'EMITIDO'){

            $estado ="<span class ='label label-success'>".$ordencompra[$i]["Estac"]."</span>";
            $cerrar ="<button class ='btn btn-default btn-xs btn  btnCerrarOCompra' idOrdenCompra='".$ordencompra[$i]["Nro"]."'>CERRAR</button>";
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/    
            $botones =  "<div class='btn-group' ><button class='btn btn-xs btn-warning btnEditarOrdenCompra' title='Editar Orden de compra' idOrdenCompra='".$ordencompra[$i]["Nro"]."' ><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularOrdenCompra' title='Anular Orden de compra' idOrdenCompra='".$ordencompra[$i]["Nro"]."'><i class='fa fa-times'></i></button><button class='btn btn-xs btn-outline-success pull-right btnDetalleReporteOrdenCompra' idOrdenCompra='".$ordencompra[$i]["Nro"]."' title='Reporte Orden de compra' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='15px'></button></div>"; 

        }else if($ordencompra[$i]["Estac"] == 'CERRADA'){

            $estado ="<span class ='label label-danger'>".$ordencompra[$i]["Estac"]."</span>";
            $cerrar ="<button class ='btn btn-default btn-xs btn  ' disabled>CERRAR</button>";
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/    
            $botones =  "<div class='btn-group' ><button class='btn btn-xs btn-outline-success pull-right btnDetalleReporteOrdenCompra' idOrdenCompra='".$ordencompra[$i]["Nro"]."' title='Reporte Orden de compra' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='15px'></button></div>"; 
        }else{

            $estado ="<span class ='label label-warning'>".$ordencompra[$i]["Estac"]."</span>";
            $cerrar ="<button class ='btn btn-default btn-xs btn  btnCerrarOCompra' idOrdenCompra='".$ordencompra[$i]["Nro"]."'>CERRAR</button>";
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/    
            $botones =  "<div class='btn-group' ><button class='btn btn-xs btn-outline-success pull-right btnDetalleReporteOrdenCompra' idOrdenCompra='".$ordencompra[$i]["Nro"]."' title='Reporte Orden de compra' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='15px'></button></div>"; 

        }

        

            $datosJson .= '[
            "'.$ordencompra[$i]["Tip"].'",
            "'.$ordencompra[$i]["Ser"].'",
            "'.$ordencompra[$i]["Nro"].'",
            "'.$ordencompra[$i]["RazPro"].'",
            "'.$ordencompra[$i]["FecEmi"].'",
            "'.$ordencompra[$i]["UsuReg"].'",
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
ACTIVAR TABLA DE ORDEN DE COMPRA
=============================================*/ 
$activarTablaOrdenCompra = new TablaOrdenCompra();
$activarTablaOrdenCompra -> mostrarTablaOrdenCompra();