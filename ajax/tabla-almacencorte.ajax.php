<?php

require_once "../controladores/almacencorte.controlador.php";
require_once "../modelos/almacencorte.modelo.php";

class TablaAlmacenCorte{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaAlmacenCorte(){

        $valor = null;

        $almacencorte = ControladorAlmacenCorte::ctrRangoFechasAlmacenCortes($_GET["fechaInicial"],$_GET["fechaFinal"]);	

        #var_dump("almacencorte", $almacencorte);
        if(count($almacencorte)>0){
        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($almacencorte); $i++){

            /* 
            todo: formato de miles
            */
            $total = number_format($almacencorte[$i]["total"],0);                

            /* 
            todo: orden de corte
            */
             $codigo = "<b>".$almacencorte[$i]["codigo"]."</b>"; 

            /* 
            todo: estado de orden de corte
            */
            if($almacencorte[$i]["estado"] == "0"){

                $estadoAC = "<button class='btn btn-warning btn-xs btnSistemas' codigo='".$almacencorte[$i]["codigo"]."' estadoAM='1'>Sistemas</button>";
    
            }else{
    
                $estadoAC = "<button class='btn btn-primary btn-xs btnSistemas' codigo='".$almacencorte[$i]["codigo"]."' estadoAM='0'>Procesado</button>";
    
            }           

            /* 
            todo: Traemos las acciones
            */
            $botones =  "<div class='btn-group'><button class='btn btn-info btnVisualizarAC' title='Visualizar Corte' data-toggle='modal' data-target='#modalVisualizarAC' codigoAC='".$almacencorte[$i]["codigo"]."'><i class='fa fa-eye'></i></button><button class='btn btn-outline-success  btnReporteOC' title='Reporte Orden de Corte' codigo='".$almacencorte[$i]["codigo"]."'style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='20px'></button></div>";
                   
                $datosJson .= '[
                "'.$codigo.'",
                "'.$almacencorte[$i]["nombre"].'",
                "<center><b>'.$total.'</b></center>",
                "'.$estadoAC.'",
                "'.$almacencorte[$i]["fecha"].'",
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
ACTIVAR TABLA DE orden$ordencorte
=============================================*/ 
$activarAlmacenCorte = new TablaAlmacenCorte();
$activarAlmacenCorte -> mostrarTablaAlmacenCorte();