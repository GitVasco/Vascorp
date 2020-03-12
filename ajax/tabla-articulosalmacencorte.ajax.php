<?php

require_once "../controladores/almacencorte.controlador.php";
require_once "../modelos/almacencorte.modelo.php";

class TablaArticulosAlmacenCorte{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarArticuloAlmacenCorte(){

        $articulos = controladorAlmacenCorte::ctrMostarArticulosOrdCorte();	

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($articulos); $i++){

    
        /* 
        todo: BOTONES
        */                
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarArtAC recuperarBoton' idCorte='".$articulos[$i]["id"]."' ordcorte='".$articulos[$i]["ordencorte"]."'  saldo='".$articulos[$i]["saldo"]."' articuloAC='".$articulos[$i]["articulo"]."'><i class='fa fa-plus-circle'></i> Agregar</button></div>";
        
            $datosJson .= '[
            "'.$articulos[$i]["ordencorte"].'",
            "'.$articulos[$i]["modelo"].'",
            "'.$articulos[$i]["color"].'",
            "'.$articulos[$i]["talla"].'",
            "'.$articulos[$i]["cantidad"].'",
            "'.$articulos[$i]["saldo"].'",
            "'.$articulos[$i]["alm_corte"].'",
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
ACTIVAR TABLA DE MATERIA PRIMA TARJETAS
=============================================*/ 
$activarArticuloAlmacenCorte = new TablaArticulosAlmacenCorte();
$activarArticuloAlmacenCorte -> mostrarArticuloAlmacenCorte();