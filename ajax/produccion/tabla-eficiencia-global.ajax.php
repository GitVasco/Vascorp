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
                * q27
                */
                if($eficiencia[$i]["q27"] > 0 && $eficiencia[$i]["q27"] < 0.25){

                    $q27 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q27"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q27"] >= 0.25 && $eficiencia[$i]["q27"] < 0.50){

                    $q27 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q27"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q27"] >= 0.50 && $eficiencia[$i]["q27"] < 0.75){

                    $q27 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q27"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q27"] >= 0.75 ){

                    $q27 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q27"]*100,2)." %</div>";

                }else{

                    $q27 = "";

                }

                /* 
                * q28
                */
                if($eficiencia[$i]["q28"] > 0 && $eficiencia[$i]["q28"] < 0.25){

                    $q28 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q28"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q28"] >= 0.25 && $eficiencia[$i]["q28"] < 0.50){

                    $q28 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q28"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q28"] >= 0.50 && $eficiencia[$i]["q28"] < 0.75){

                    $q28 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q28"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q28"] >= 0.75 ){

                    $q28 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q28"]*100,2)." %</div>";

                }else{

                    $q28 = "";

                }
                
                /* 
                * q29
                */
                if($eficiencia[$i]["q29"] > 0 && $eficiencia[$i]["q29"] < 0.25){

                    $q29 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q29"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q29"] >= 0.25 && $eficiencia[$i]["q29"] < 0.50){

                    $q29 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q29"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q29"] >= 0.50 && $eficiencia[$i]["q29"] < 0.75){

                    $q29 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q29"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q29"] >= 0.75 ){

                    $q29 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q29"]*100,2)." %</div>";
                    
                }else{

                    $q29 = "";

                }
                
                /* 
                * q30
                */
                if($eficiencia[$i]["q30"] > 0 && $eficiencia[$i]["q30"] < 0.25){

                    $q30 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q30"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q30"] >= 0.25 && $eficiencia[$i]["q30"] < 0.50){

                    $q30 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q30"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q30"] >= 0.50 && $eficiencia[$i]["q30"] < 0.75){

                    $q30 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q30"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q30"] >= 0.75 ){

                    $q30 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q30"]*100,2)." %</div>";

                }else{

                    $q30 = "";

                }
                
                /* 
                * q31
                */
                if($eficiencia[$i]["q31"] > 0 && $eficiencia[$i]["q31"] < 0.25){

                    $q31 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q31"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q31"] >= 0.25 && $eficiencia[$i]["q31"] < 0.50){

                    $q31 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q31"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q31"] >= 0.50 && $eficiencia[$i]["q31"] < 0.75){

                    $q31 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q31"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q31"] >= 0.75 ){

                    $q31 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q31"]*100,2)." %</div>";

                }else{

                    $q31 = "";

                }
                
                /* 
                * q32
                */
                if($eficiencia[$i]["q32"] > 0 && $eficiencia[$i]["q32"] < 0.25){

                    $q32 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q32"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q32"] >= 0.25 && $eficiencia[$i]["q32"] < 0.50){

                    $q32 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q32"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q32"] >= 0.50 && $eficiencia[$i]["q32"] < 0.75){

                    $q32 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q32"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q32"] >= 0.75 ){

                    $q32 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q32"]*100,2)." %</div>";

                }else{

                    $q32 = "";

                }
                
                /* 
                * q33
                */
                if($eficiencia[$i]["q33"] > 0 && $eficiencia[$i]["q33"] < 0.25){

                    $q33 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q33"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q33"] >= 0.25 && $eficiencia[$i]["q33"] < 0.50){

                    $q33 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q33"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q33"] >= 0.50 && $eficiencia[$i]["q33"] < 0.75){

                    $q33 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q33"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q33"] >= 0.75 ){

                    $q33 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q33"]*100,2)." %</div>";

                }else{

                    $q33 = "";

                }
                
                /* 
                * q34
                */
                if($eficiencia[$i]["q34"] > 0 && $eficiencia[$i]["q34"] < 0.25){

                    $q34 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q34"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q34"] >= 0.25 && $eficiencia[$i]["q34"] < 0.50){

                    $q34 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q34"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q34"] >= 0.50 && $eficiencia[$i]["q34"] < 0.75){

                    $q34 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q34"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q34"] >= 0.75 ){

                    $q34 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q34"]*100,2)." %</div>";

                }else{

                    $q34 = "";

                }
                
                /* 
                * q35
                */
                if($eficiencia[$i]["q35"] > 0 && $eficiencia[$i]["q35"] < 0.25){

                    $q35 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q35"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q35"] >= 0.25 && $eficiencia[$i]["q35"] < 0.50){

                    $q35 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q35"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q35"] >= 0.50 && $eficiencia[$i]["q35"] < 0.75){

                    $q35 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q35"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q35"] >= 0.75 ){

                    $q35 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q35"]*100,2)." %</div>";

                }else{

                    $q35 = "";

                }
                
                /* 
                * q36
                */
                if($eficiencia[$i]["q36"] > 0 && $eficiencia[$i]["q36"] < 0.25){

                    $q36 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q36"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q36"] >= 0.25 && $eficiencia[$i]["q36"] < 0.50){

                    $q36 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q36"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q36"] >= 0.50 && $eficiencia[$i]["q36"] < 0.75){

                    $q36 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q36"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q36"] >= 0.75 ){

                    $q36 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q36"]*100,2)." %</div>";

                }else{

                    $q36 = "";

                }
                
                /* 
                * q37
                */
                if($eficiencia[$i]["q37"] > 0 && $eficiencia[$i]["q37"] < 0.25){

                    $q37 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q37"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q37"] >= 0.25 && $eficiencia[$i]["q37"] < 0.50){

                    $q37 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q37"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q37"] >= 0.50 && $eficiencia[$i]["q37"] < 0.75){

                    $q37 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q37"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q37"] >= 0.75 ){

                    $q37 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q37"]*100,2)." %</div>";

                }else{

                    $q37 = "";

                }
                
                /* 
                * q38
                */
                if($eficiencia[$i]["q38"] > 0 && $eficiencia[$i]["q38"] < 0.25){

                    $q38 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q38"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q38"] >= 0.25 && $eficiencia[$i]["q38"] < 0.50){

                    $q38 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q38"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q38"] >= 0.50 && $eficiencia[$i]["q38"] < 0.75){

                    $q38 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q38"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q38"] >= 0.75 ){

                    $q38 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q38"]*100,2)." %</div>";

                }else{

                    $q38 = "";

                }

                /* 
                * q39
                */
                if($eficiencia[$i]["q39"] > 0 && $eficiencia[$i]["q39"] < 0.25){

                    $q39 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q39"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q39"] >= 0.25 && $eficiencia[$i]["q39"] < 0.50){

                    $q39 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q39"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q39"] >= 0.50 && $eficiencia[$i]["q39"] < 0.75){

                    $q39 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q39"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q39"] >= 0.75 ){

                    $q39 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q39"]*100,2)." %</div>";

                }else{

                    $q39 = "";

                }
                
                /* 
                * q40
                */
                if($eficiencia[$i]["q40"] > 0 && $eficiencia[$i]["q40"] < 0.25){

                    $q40 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q40"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q40"] >= 0.25 && $eficiencia[$i]["q40"] < 0.50){

                    $q40 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q40"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q40"] >= 0.50 && $eficiencia[$i]["q40"] < 0.75){

                    $q40 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q40"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q40"] >= 0.75 ){

                    $q40 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q40"]*100,2)." %</div>";

                }else{

                    $q40 = "";

                }
                
                /* 
                * q41
                */
                if($eficiencia[$i]["q41"] > 0 && $eficiencia[$i]["q41"] < 0.25){

                    $q41 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q41"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q41"] >= 0.25 && $eficiencia[$i]["q41"] < 0.50){

                    $q41 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q41"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q41"] >= 0.50 && $eficiencia[$i]["q41"] < 0.75){

                    $q41 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q41"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q41"] >= 0.75 ){

                    $q41 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q41"]*100,2)." %</div>";

                }else{

                    $q41 = "";

                }
                /* 
                * q42
                */
                if($eficiencia[$i]["q42"] > 0 && $eficiencia[$i]["q42"] < 0.25){

                    $q42 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q42"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q42"] >= 0.25 && $eficiencia[$i]["q42"] < 0.50){

                    $q42 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q42"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q42"] >= 0.50 && $eficiencia[$i]["q42"] < 0.75){

                    $q42 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q42"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q42"] >= 0.75 ){

                    $q42 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q42"]*100,2)." %</div>";

                }else{

                    $q42 = "";

                }
                
                /* 
                * q43
                */
                if($eficiencia[$i]["q43"] > 0 && $eficiencia[$i]["q43"] < 0.25){

                    $q43 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q43"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q43"] >= 0.25 && $eficiencia[$i]["q43"] < 0.50){

                    $q43 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q43"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q43"] >= 0.50 && $eficiencia[$i]["q43"] < 0.75){

                    $q43 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q43"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q43"] >= 0.75 ){

                    $q43 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q43"]*100,2)." %</div>";

                }else{

                    $q43 = "";

                }
                
                /* 
                * q44
                */
                if($eficiencia[$i]["q44"] > 0 && $eficiencia[$i]["q44"] < 0.25){

                    $q44 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q44"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q44"] >= 0.25 && $eficiencia[$i]["q44"] < 0.50){

                    $q44 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q44"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q44"] >= 0.50 && $eficiencia[$i]["q44"] < 0.75){

                    $q44 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q44"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q44"] >= 0.75 ){

                    $q44 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q44"]*100,2)." %</div>";

                }else{

                    $q44 = "";

                }
                
                /* 
                * q45
                */
                if($eficiencia[$i]["q45"] > 0 && $eficiencia[$i]["q45"] < 0.25){

                    $q45 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q45"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q45"] >= 0.25 && $eficiencia[$i]["q45"] < 0.50){

                    $q45 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q45"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q45"] >= 0.50 && $eficiencia[$i]["q45"] < 0.75){

                    $q45 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q45"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q45"] >= 0.75 ){

                    $q45 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q45"]*100,2)." %</div>";

                }else{

                    $q45 = "";

                }
                
                /* 
                * q46
                */
                if($eficiencia[$i]["q46"] > 0 && $eficiencia[$i]["q46"] < 0.25){

                    $q46 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q46"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q46"] >= 0.25 && $eficiencia[$i]["q46"] < 0.50){

                    $q46 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q46"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q46"] >= 0.50 && $eficiencia[$i]["q46"] < 0.75){

                    $q46 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q46"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q46"] >= 0.75 ){

                    $q46 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q46"]*100,2)." %</div>";

                }else{

                    $q46 = "";

                }
                
                /* 
                * q47
                */
                if($eficiencia[$i]["q47"] > 0 && $eficiencia[$i]["q47"] < 0.25){

                    $q47 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q47"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q47"] >= 0.25 && $eficiencia[$i]["q47"] < 0.50){

                    $q47 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q47"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q47"] >= 0.50 && $eficiencia[$i]["q47"] < 0.75){

                    $q47 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q47"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q47"] >= 0.75 ){

                    $q47 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q47"]*100,2)." %</div>";

                }else{

                    $q47 = "";

                }
                
                /* 
                * q48
                */
                if($eficiencia[$i]["q48"] > 0 && $eficiencia[$i]["q48"] < 0.25){

                    $q48 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q48"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q48"] >= 0.25 && $eficiencia[$i]["q48"] < 0.50){

                    $q48 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q48"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q48"] >= 0.50 && $eficiencia[$i]["q48"] < 0.75){

                    $q48 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q48"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q48"] >= 0.75 ){

                    $q48 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q48"]*100,2)." %</div>";

                }else{

                    $q48 = "";

                }
                
                /* 
                * q49
                */
                if($eficiencia[$i]["q49"] > 0 && $eficiencia[$i]["q49"] < 0.25){

                    $q49 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q49"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q49"] >= 0.25 && $eficiencia[$i]["q49"] < 0.50){

                    $q49 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q49"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q49"] >= 0.50 && $eficiencia[$i]["q49"] < 0.75){

                    $q49 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q49"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q49"] >= 0.75 ){

                    $q49 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q49"]*100,2)." %</div>";

                }else{

                    $q49 = "";

                }
                
                /* 
                * q50
                */
                if($eficiencia[$i]["q50"] > 0 && $eficiencia[$i]["q50"] < 0.25){

                    $q50 = "<div><i class='fa fa-battery-quarter text-red' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q50"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q50"] >= 0.25 && $eficiencia[$i]["q50"] < 0.50){

                    $q50 = "<div><i class='fa fa-battery-half text-orange' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q50"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q50"] >= 0.50 && $eficiencia[$i]["q50"] < 0.75){

                    $q50 = "<div><i class='fa fa-battery-three-quarters text-yellow' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q50"]*100,2)." %</div>";

                }else if($eficiencia[$i]["q50"] >= 0.75 ){

                    $q50 = "<div><i class='fa fa-battery-full text-green' style='transform:rotate(270deg)'></i> ".number_format($eficiencia[$i]["q50"]*100,2)." %</div>";

                }else{

                    $q50 = "";

                }                

                /* 
                *PROMEDIO
                */
                $nro = array();
                if($eficiencia[$i]["q27"] >0){

                    $nro[0] = $eficiencia[$i]["q27"];

                }
                if($eficiencia[$i]["q28"] >0){

                    $nro[1] = $eficiencia[$i]["q28"];

                }
                if($eficiencia[$i]["q29"] >0){

                    $nro[2] = $eficiencia[$i]["q29"];

                }
                if($eficiencia[$i]["q30"] >0){

                    $nro[3] = $eficiencia[$i]["q30"];

                }
                if($eficiencia[$i]["q31"] >0){

                    $nro[4] = $eficiencia[$i]["q31"];

                }
                if($eficiencia[$i]["q32"] >0){

                    $nro[5] = $eficiencia[$i]["q32"];

                }
                if($eficiencia[$i]["q33"] >0){

                    $nro[6] = $eficiencia[$i]["q33"];

                }
                if($eficiencia[$i]["q34"] >0){

                    $nro[7] = $eficiencia[$i]["q34"];

                }
                if($eficiencia[$i]["q35"] >0){

                    $nro[8] = $eficiencia[$i]["q35"];

                }
                if($eficiencia[$i]["q36"] >0){

                    $nro[9] = $eficiencia[$i]["q36"];

                }
                if($eficiencia[$i]["q37"] >0){

                    $nro[10] = $eficiencia[$i]["q37"];

                }
                if($eficiencia[$i]["q38"] >0){

                    $nro[11] = $eficiencia[$i]["q38"];

                }
                if($eficiencia[$i]["q39"] >0){

                    $nro[12] = $eficiencia[$i]["q39"];

                }
                if($eficiencia[$i]["q40"] >0){

                    $nro[13] = $eficiencia[$i]["q40"];

                }
                if($eficiencia[$i]["q41"] >0){

                    $nro[14] = $eficiencia[$i]["q41"];

                }
                if($eficiencia[$i]["q42"] >0){

                    $nro[15] = $eficiencia[$i]["q42"];

                }
                if($eficiencia[$i]["q43"] >0){

                    $nro[16] = $eficiencia[$i]["q43"];

                }
                if($eficiencia[$i]["q44"] >0){

                    $nro[17] = $eficiencia[$i]["q44"];

                }
                if($eficiencia[$i]["q45"] >0){

                    $nro[18] = $eficiencia[$i]["q45"];

                }
                if($eficiencia[$i]["q46"] >0){

                    $nro[19] = $eficiencia[$i]["q46"];

                }
                if($eficiencia[$i]["q47"] >0){

                    $nro[20] = $eficiencia[$i]["q47"];

                }
                if($eficiencia[$i]["q48"] >0){

                    $nro[21] = $eficiencia[$i]["q48"];

                }
                if($eficiencia[$i]["q49"] >0){

                    $nro[22] = $eficiencia[$i]["q49"];

                }
                if($eficiencia[$i]["q50"] >0){

                    $nro[23] = $eficiencia[$i]["q50"];

                }

                $cantidad = count($nro);

                $numeros = [$eficiencia[$i]["q27"],$eficiencia[$i]["q28"],$eficiencia[$i]["q29"],$eficiencia[$i]["q30"],$eficiencia[$i]["q31"],$eficiencia[$i]["q32"],$eficiencia[$i]["q33"],$eficiencia[$i]["q34"],$eficiencia[$i]["q35"],$eficiencia[$i]["q36"],$eficiencia[$i]["q37"],$eficiencia[$i]["q38"],$eficiencia[$i]["q39"],$eficiencia[$i]["q40"],$eficiencia[$i]["q41"],$eficiencia[$i]["q42"],$eficiencia[$i]["q43"],$eficiencia[$i]["q44"],$eficiencia[$i]["q45"],$eficiencia[$i]["q46"],$eficiencia[$i]["q47"],$eficiencia[$i]["q48"],$eficiencia[$i]["q49"],$eficiencia[$i]["q50"]];

                $suma = array_sum($numeros);
                
                if($cantidad > 0){

                    $promedio = $suma / $cantidad;
                    

                }else{

                    $promedio = 0;

                }
                

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
                "'.$q27.'",
                "'.$q28.'",
                "'.$q29.'",
                "'.$q30.'",
                "'.$q31.'",
                "'.$q32.'",
                "'.$q33.'",
                "'.$q34.'",
                "'.$q35.'",
                "'.$q36.'",
                "'.$q37.'",
                "'.$q38.'",
                "'.$q39.'",
                "'.$q40.'",
                "'.$q41.'",
                "'.$q42.'",
                "'.$q43.'",
                "'.$q44.'",
                "'.$q45.'",
                "'.$q46.'",
                "'.$q47.'",
                "'.$q48.'",
                "'.$q49.'",
                "'.$q50.'",
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