<?php

require_once "../../controladores/ordencorte.controlador.php";
require_once "../../modelos/ordencorte.modelo.php";

class TablaVerOrdenCorteCantidad{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarVerTablaOrdenCorteCantidad(){

        $ordencorte = ControladorOrdenCorte::ctrRangoFechasOrdenCortesCantidad($_GET["fechaInicial"],$_GET["fechaFinal"]);
        // $ordencorte = ControladorOrdenCorte::ctrRangoFechasOrdenCortes($item,$valor);
        
        if(count($ordencorte)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($ordencorte); $i++){
                   
          
                $datosJson .= '[
                "'.$ordencorte[$i]["ordencorte"].'",
                "'.$ordencorte[$i]["fechas"].'",
                "'.$ordencorte[$i]["modelo"].'",
                "'.$ordencorte[$i]["nombre"].'",
                "'.$ordencorte[$i]["color"].'",
                "'.$ordencorte[$i]["t1"].'",
                "'.$ordencorte[$i]["t2"].'",
                "'.$ordencorte[$i]["t3"].'",
                "'.$ordencorte[$i]["t4"].'",
                "'.$ordencorte[$i]["t5"].'",
                "'.$ordencorte[$i]["t6"].'",
                "'.$ordencorte[$i]["t7"].'",
                "'.$ordencorte[$i]["t8"].'",
                "'.$ordencorte[$i]["subtotal"].'"
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
$activarVerOrdenCorteCantidad = new TablaVerOrdenCorteCantidad();
$activarVerOrdenCorteCantidad -> mostrarVerTablaOrdenCorteCantidad();