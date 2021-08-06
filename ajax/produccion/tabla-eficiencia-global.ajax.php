<?php

require_once "../../controladores/produccion.controlador.php";
require_once "../../modelos/produccion.modelo.php";

class TablaEficienciaGlobal{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaEficienciaGlobal(){

        $taller = $_GET["tallerEG"];
        $eficiencia = ControladorProduccion::ctrTablaEficienciaGlobal($taller);
        
        if(count($eficiencia)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($eficiencia); $i++){

                /* 
                * q15
                */
                if($eficiencia[$i]["q15"] > 0 && $eficiencia[$i]["q15"] < 0.25){

                    $q15 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q15"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q15"] >= 0.25 && $eficiencia[$i]["q15"] < 0.50){

                    $q15 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q15"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q15"] >= 0.50 && $eficiencia[$i]["q15"] < 0.75){

                    $q15 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q15"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q15"] >= 0.75 ){

                    $q15 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q15"]*100,2)." %</div>";

                }else{

                    $q15 = "";

                }

                /* 
                * q16
                */
                if($eficiencia[$i]["q16"] > 0 && $eficiencia[$i]["q16"] < 0.25){

                    $q16 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q16"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q16"] >= 0.25 && $eficiencia[$i]["q16"] < 0.50){

                    $q16 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q16"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q16"] >= 0.50 && $eficiencia[$i]["q16"] < 0.75){

                    $q16 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q16"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q16"] >= 0.75 ){

                    $q16 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q16"]*100,2)." %</div>";

                }else{

                    $q16 = "";

                }
                
                /* 
                * q17
                */
                if($eficiencia[$i]["q17"] > 0 && $eficiencia[$i]["q17"] < 0.25){

                    $q17 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q17"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q17"] >= 0.25 && $eficiencia[$i]["q17"] < 0.50){

                    $q17 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q17"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q17"] >= 0.50 && $eficiencia[$i]["q17"] < 0.75){

                    $q17 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q17"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q17"] >= 0.75 ){

                    $q17 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q17"]*100,2)." %</div>";
                    
                }else{

                    $q17 = "";

                }
                
                /* 
                * q18
                */
                if($eficiencia[$i]["q18"] > 0 && $eficiencia[$i]["q18"] < 0.25){

                    $q18 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q18"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q18"] >= 0.25 && $eficiencia[$i]["q18"] < 0.50){

                    $q18 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q18"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q18"] >= 0.50 && $eficiencia[$i]["q18"] < 0.75){

                    $q18 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q18"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q18"] >= 0.75 ){

                    $q18 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q18"]*100,2)." %</div>";

                }else{

                    $q18 = "";

                }
                
                /* 
                * q19
                */
                if($eficiencia[$i]["q19"] > 0 && $eficiencia[$i]["q19"] < 0.25){

                    $q19 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q19"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q19"] >= 0.25 && $eficiencia[$i]["q19"] < 0.50){

                    $q19 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q19"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q19"] >= 0.50 && $eficiencia[$i]["q19"] < 0.75){

                    $q19 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q19"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q19"] >= 0.75 ){

                    $q19 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q19"]*100,2)." %</div>";

                }else{

                    $q19 = "";

                }
                
                /* 
                * q20
                */
                if($eficiencia[$i]["q20"] > 0 && $eficiencia[$i]["q20"] < 0.25){

                    $q20 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q20"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q20"] >= 0.25 && $eficiencia[$i]["q20"] < 0.50){

                    $q20 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q20"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q20"] >= 0.50 && $eficiencia[$i]["q20"] < 0.75){

                    $q20 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q20"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q20"] >= 0.75 ){

                    $q20 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q20"]*100,2)." %</div>";

                }else{

                    $q20 = "";

                }
                
                /* 
                * q21
                */
                if($eficiencia[$i]["q21"] > 0 && $eficiencia[$i]["q21"] < 0.25){

                    $q21 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q21"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q21"] >= 0.25 && $eficiencia[$i]["q21"] < 0.50){

                    $q21 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q21"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q21"] >= 0.50 && $eficiencia[$i]["q21"] < 0.75){

                    $q21 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q21"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q21"] >= 0.75 ){

                    $q21 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q21"]*100,2)." %</div>";

                }else{

                    $q21 = "";

                }
                
                /* 
                * q22
                */
                if($eficiencia[$i]["q22"] > 0 && $eficiencia[$i]["q22"] < 0.25){

                    $q22 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q22"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q22"] >= 0.25 && $eficiencia[$i]["q22"] < 0.50){

                    $q22 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q22"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q22"] >= 0.50 && $eficiencia[$i]["q22"] < 0.75){

                    $q22 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q22"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q22"] >= 0.75 ){

                    $q22 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q22"]*100,2)." %</div>";

                }else{

                    $q22 = "";

                }
                
                /* 
                * q23
                */
                if($eficiencia[$i]["q23"] > 0 && $eficiencia[$i]["q23"] < 0.25){

                    $q23 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q23"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q23"] >= 0.25 && $eficiencia[$i]["q23"] < 0.50){

                    $q23 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q23"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q23"] >= 0.50 && $eficiencia[$i]["q23"] < 0.75){

                    $q23 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q23"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q23"] >= 0.75 ){

                    $q23 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q23"]*100,2)." %</div>";

                }else{

                    $q23 = "";

                }
                
                /* 
                * q24
                */
                if($eficiencia[$i]["q24"] > 0 && $eficiencia[$i]["q24"] < 0.25){

                    $q24 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q24"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q24"] >= 0.25 && $eficiencia[$i]["q24"] < 0.50){

                    $q24 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q24"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q24"] >= 0.50 && $eficiencia[$i]["q24"] < 0.75){

                    $q24 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q24"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q24"] >= 0.75 ){

                    $q24 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q24"]*100,2)." %</div>";

                }else{

                    $q24 = "";

                }
                
                /* 
                * q25
                */
                if($eficiencia[$i]["q25"] > 0 && $eficiencia[$i]["q25"] < 0.25){

                    $q25 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q25"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q25"] >= 0.25 && $eficiencia[$i]["q25"] < 0.50){

                    $q25 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q25"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q25"] >= 0.50 && $eficiencia[$i]["q25"] < 0.75){

                    $q25 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q25"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q25"] >= 0.75 ){

                    $q25 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q25"]*100,2)." %</div>";

                }else{

                    $q25 = "";

                }
                
                /* 
                * q26
                */
                if($eficiencia[$i]["q26"] > 0 && $eficiencia[$i]["q26"] < 0.25){

                    $q26 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q26"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q26"] >= 0.25 && $eficiencia[$i]["q26"] < 0.50){

                    $q26 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q26"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q26"] >= 0.50 && $eficiencia[$i]["q26"] < 0.75){

                    $q26 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q26"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q26"] >= 0.75 ){

                    $q26 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q26"]*100,2)." %</div>";

                }else{

                    $q26 = "";

                }

                /* 
                *PROMEDIO
                */
                if($eficiencia[$i]["q15"] >0){

                    $nro[0] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q16"] >0){

                    $nro[1] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q17"] >0){

                    $nro[2] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q18"] >0){

                    $nro[3] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q19"] >0){

                    $nro[4] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q20"] >0){

                    $nro[5] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q21"] >0){

                    $nro[6] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q22"] >0){

                    $nro[7] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q23"] >0){

                    $nro[8] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q24"] >0){

                    $nro[9] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q25"] >0){

                    $nro[10] = $eficiencia[$i]["q15"];

                }
                if($eficiencia[$i]["q26"] >0){

                    $nro[11] = $eficiencia[$i]["q15"];

                }

                $cantidad = count($nro);

                $numeros = [$eficiencia[$i]["q15"],$eficiencia[$i]["q16"],$eficiencia[$i]["q17"],$eficiencia[$i]["q18"],$eficiencia[$i]["q19"],$eficiencia[$i]["q20"],$eficiencia[$i]["q21"],$eficiencia[$i]["q22"],$eficiencia[$i]["q23"],$eficiencia[$i]["q24"],$eficiencia[$i]["q25"],$eficiencia[$i]["q26"]];

                $suma = array_sum($numeros);
                
                $promedio = $suma / $cantidad;

                if($promedio > 0 && $promedio < 0.25){

                    $prom = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($promedio*100,2)." %</div>";

                }else if($promedio >= 0.25 && $promedio < 0.50){

                    $prom = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($promedio*100,2)." %</div>";

                }else if($promedio >= 0.50 && $promedio < 0.75){

                    $prom = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($promedio*100,2)." %</div>";

                }else if($promedio >= 0.75 ){

                    $prom = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($promedio*100,2)." %</div>";

                }else{

                    $prom = "";

                }
                

                $datosJson .= '[
                "<b>'.$eficiencia[$i]["sector"].'</b>",
                "'.$eficiencia[$i]["cod_tra"].'",
                "<b>'.$eficiencia[$i]["nom_tra"].'</b>",
                "'.$q15.'",
                "'.$q16.'",
                "'.$q17.'",
                "'.$q18.'",
                "'.$q19.'",
                "'.$q20.'",
                "'.$q21.'",
                "'.$q22.'",
                "'.$q23.'",
                "'.$q24.'",
                "'.$q25.'",
                "'.$q26.'",
                "'.$prom.'"
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
ACTIVAR TABLA DE orden$eficiencia
=============================================*/ 
$activarTabla = new TablaEficienciaGlobal();
$activarTabla -> mostrarTablaEficienciaGlobal();