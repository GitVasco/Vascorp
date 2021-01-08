<?php

require_once "../controladores/cierres.controlador.php";
require_once "../modelos/cierres.modelo.php";

class TablaProductosCierres{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS CIERRES
    =============================================*/ 

    public function mostrarTablaProductosCierres(){
    

        $articulos = ControladorCierres::ctrMostrarArticulosCierre();	
        if(count($articulos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

        

        // if($articulos[$i]["taller"] <= 0){

        //     $taller = "<button class='btn btn-danger'>".$articulos[$i]["taller"]."</button>";

        // }else{

        //     $taller = "<button class='btn btn-success'>".$articulos[$i]["taller"]."</button>";

        // }        

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-primary agregarProducto recuperarBoton' articuloCierre='".$articulos[$i]["articulo"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>"; 

            $datosJson .= '[
            "'.$articulos[$i]["articulo"].'",
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["nombre"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$articulos[$i]["servicio"].'",
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
$activarProductosCierres = new TablaProductosCierres();
$activarProductosCierres -> mostrarTablaProductosCierres();