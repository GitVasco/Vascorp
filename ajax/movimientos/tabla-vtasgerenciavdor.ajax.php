<?php

require_once "../../controladores/movimientos.controlador.php";
require_once "../../modelos/movimientos.modelo.php";


class TablaMovimientos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVtasGerencia(){

        $mes = $_GET["mes"];

        $movimientos = ControladorMovimientos::ctrMostrarResumenVdor($mes);	

        if(count($movimientos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($movimientos); $i++){

            if($movimientos[$i]["codigo"] == "99"){

                $pedidos = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["pedidos"],2)."</b></div>";
                $ventas = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["ventas"],2)."</div>";
                $total = "<div style='text-align:right !important'><b>".number_format($movimientos[$i]["total"],2)."</b></div>";

            }else{

                $pedidos = "<div style='text-align:right !important'>".number_format($movimientos[$i]["pedidos"],2)."</div>";
                $ventas = "<div style='text-align:right !important'>".number_format($movimientos[$i]["ventas"],2)."</div>";
                $total = "<div style='text-align:right !important'>".number_format($movimientos[$i]["total"],2)."</div>";
                
            }
            
            if($movimientos[$i]["codigo"] != "99"){

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-success btnEstadoCtaVdor' title='Descargar Estado de Cuenta' vendedor=".$movimientos[$i]['codigo']."><i class='fa fa-download'></i></button></div>"; 

            }else{

                $botones =  "<div class='btn-group'></div>"; 

            }





                $datosJson .= '[
                "'.$movimientos[$i]["codigo"].'",
                "'.$movimientos[$i]["descripcion"].'",
                "'.$ventas.'",
                "'.$pedidos.'",                
                "'.$total.'",
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
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarMovimientos = new TablaMovimientos();
$activarMovimientos -> mostrarTablaVtasGerencia();