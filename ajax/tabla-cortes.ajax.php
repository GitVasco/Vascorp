<?php

require_once "../controladores/cortes.controlador.php";
require_once "../modelos/cortes.modelo.php";

class TablaCortes{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaCortes(){

        $cortes = ControladorCortes::ctrMostrarCortes();

        #var_dump("almacencorte", $cortes);

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($cortes); $i++){

            /* 
            todo: Modelo
            */
            $modelo = "<b><span style='font-size:100%' class='text-primary'>".$cortes[$i]["modelo"]."</span></b>";

            /* 
            todo: Almacen de Corte
            */
            $alm_corteI = number_format($cortes[$i]["alm_corte"],0);
            $alm_corte = "<center><b><span style='font-size:100%' class='text-default'>".$alm_corteI."</span></b></center>";

            /* 
            todo: Operaciones
            */
            $operacion = "<b><span style='font-size:100%' class='text-success'>".$cortes[$i]["operacion"]."</span></b>";

            /* 
            todo: BOTONES
            */                
            $botones =  "<div class='btn-group'><button class='btn btn-primary btnMandarTaller' codigo='".$cortes[$i]["articulo"]."'><i class='fa fa-users'></i></button></div>"; 
                   
                $datosJson .= '[
                "'.$cortes[$i]["articulo"].'",
                "'.$cortes[$i]["marca"].'",
                "'.$modelo.'",
                "'.$cortes[$i]["nombre"].'",
                "'.$cortes[$i]["color"].'",
                "'.$cortes[$i]["talla"].'",
                "'.$alm_corte.'",
                "'.$cortes[$i]["cod_operacion"].'",
                "'.$operacion.'",
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
ACTIVAR TABLA DE orden$ordencorte
=============================================*/ 
$activarAlmacenCorte = new TablaCortes();
$activarAlmacenCorte -> mostrarTablaCortes();