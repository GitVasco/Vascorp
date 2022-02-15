<?php

require_once "../../controladores/cierres.controlador.php";
require_once "../../modelos/cierres.modelo.php";

class TablaProductosCierres{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS CIERRES
    =============================================*/ 

    public function mostrarTablaProductosCierres(){
    

        $articulos = ControladorCierres::ctrMostrarArticulosCierre($_GET["sectorCierre"]);	
        if(count($articulos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

            $cerrar = "<button class='btn btn-danger btn-xs btnCerrarServicio' articulo='".$articulos[$i]["articulo"]."' codigo='".$articulos[$i]["codigo"]."' saldo='".$articulos[$i]["saldo"]."' idServ='".$articulos[$i]["id"]."' cerrar='1'>C</button>"; 

            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         
            
            $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarServicio recuperarBoton' codServicio ='".$articulos[$i]["id"]."' codDetalle ='".$articulos[$i]["codigo"]."' articuloCierre='".$articulos[$i]["articulo"]."' saldoServicio='".$articulos[$i]["saldo"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>"; 

            $datosJson .= '[
            "'.$articulos[$i]["codigo"].'",
            "'.$articulos[$i]["articulo"].'",
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["nombre"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$articulos[$i]["saldo"].'",
            "<center>'.$cerrar.'</center>",
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