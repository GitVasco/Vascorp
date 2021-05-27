<?php

require_once "../../controladores/ingresos.controlador.php";
require_once "../../modelos/ingresos.modelo.php";

class TablaVerIngresos{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerIngresos(){

        $item = null;     
        $valor = null;

        $ingresos = ControladorIngresos::ctrRangoFechasVerIngresos($_GET["fechaInicial"],$_GET["fechaFinal"]);	
       
        if(count($ingresos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($ingresos); $i++){
            if($ingresos[$i]["t1"] == '0'){
                $t1 = '';
            }else{
                $t1 = $ingresos[$i]["t1"];
            }  

            if($ingresos[$i]["t2"] == '0'){
                $t2 = '';
            }else{
                $t2 = $ingresos[$i]["t2"];
            }  

            if($ingresos[$i]["t3"] == '0'){
                $t3 = '';
            }else{
                $t3 = $ingresos[$i]["t3"];
            }  

            if($ingresos[$i]["t4"] == '0'){
                $t4 = '';
            }else{
                $t4 = $ingresos[$i]["t4"];
            }  

            if($ingresos[$i]["t5"] == '0'){
                $t5 = '';
            }else{
                $t5 = $ingresos[$i]["t5"];
            }  

            if($ingresos[$i]["t6"] == '0'){
                $t6 = '';
            }else{
                $t6 = $ingresos[$i]["t6"];
            }  

            if($ingresos[$i]["t7"] == '0'){
                $t7 = '';
            }else{
                $t7 = $ingresos[$i]["t7"];
            }  

            if($ingresos[$i]["t8"] == '0'){
                $t8 = '';
            }else{
                $t8 = $ingresos[$i]["t8"];
            }  
      
    
            $datosJson .= '[
            "'.$ingresos[$i]["cod_sector"]." - ".$ingresos[$i]["nom_sector"].'",
            "'.$ingresos[$i]["guia"].'",
            "'.$ingresos[$i]["fechas"].'",
            "'.$ingresos[$i]["documento"].'",
            "'.$ingresos[$i]["modelo"].'",
            "'.$ingresos[$i]["nombre"].'",
            "'.$ingresos[$i]["color"].'",
            "'.$t1.'",
            "'.$t2.'",
            "'.$t3.'",
            "'.$t4.'",
            "'.$t5.'",
            "'.$t6.'",
            "'.$t7.'",
            "'.$t8.'",
            "'.$ingresos[$i]["total"].'"
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
ACTIVAR TABLA DE VER INGRESOS
=============================================*/ 
$activarVerIngresos = new TablaVerIngresos();
$activarVerIngresos -> mostrarTablaVerIngresos();