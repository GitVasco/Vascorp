<?php

require_once "../../controladores/ordencorte.controlador.php";
require_once "../../modelos/ordencorte.modelo.php";

class TablaEditarOrdenCorte{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaEditarOrdenCorte(){

        $item = "ordencorte";
        $valor = $_GET["codigo"];
        $ordencorte = ControladorOrdenCorte::ctrMostrarDetallesOrdenCorte($item,$valor);
        
        if(count($ordencorte)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($ordencorte); $i++){
              

            /* 
            todo: Traemos las acciones
            */


                $botones =  "<div class='btn-group'><button type='button' class='btn btn-xs btn-warning btnEditarDetalleCorte' data-toggle='modal' data-target='#modalEditarDetalleCorte' idDetalle='".$ordencorte[$i]["id"]."'><i class='fa fa-pencil'></i></button><button  type='button' class='btn btn-xs btn-danger btnEliminarDetalleCorte' codigo= '".$_GET["codigo"]."' idDetalle='".$ordencorte[$i]["articulo"]."' cantidad='".$ordencorte[$i]["cantidad"]."'><i class='fa fa-times'></i></button></div> ";




                $datosJson .= '[
                "'.($i+1).'",
                "'.$ordencorte[$i]["articulo"].'",
                "'.$ordencorte[$i]["nombre"].'",
                "'.$ordencorte[$i]["color"].'",
                "'.$ordencorte[$i]["talla"].'",
                "'.$ordencorte[$i]["marca"].'",
                "'.$ordencorte[$i]["cantidad"].'",
                "'.$ordencorte[$i]["saldo"].'",
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
ACTIVAR TABLA DE EDITAR DETALLE ORDEN CORTE
=============================================*/ 
$activarEditarOrdenCorte = new TablaEditarOrdenCorte();
$activarEditarOrdenCorte -> mostrarTablaEditarOrdenCorte();