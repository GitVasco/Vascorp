<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class TablaProductos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaOperaciones(){

        $item = null;     
        $valor = null;

        $operaciones = ControladorOperaciones::ctrMostrarOperaciones($item, $valor);	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($operaciones); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.($i+1).'",
            "'.$imagen.'",
            "'.$productos[$i]["codigo"].'",
            "'.$productos[$i]["descripcion"].'",
            "'.$categorias["categoria"].'",
            "'.$stock.'",
            "'.$productos[$i]["precio_compra"].'",
            "'.$productos[$i]["precio_venta"].'",
            "'.$productos[$i]["fecha"].'",
            "'.$botones.'"
            ],';        
            }

            $datosJson=substr($datosJson, 0, -1);

            $datosJson .= '] 

            }';

        echo $datosJson;

    }

}

/*=============================================
ACTIVAR TABLA DE PRODUCTOS
=============================================*/ 
$activarProductos = new TablaProductos();
$activarProductos -> mostrarTablaProductos();