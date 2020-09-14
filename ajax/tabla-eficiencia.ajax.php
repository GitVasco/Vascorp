<?php

require_once "../controladores/produccion.controlador.php";
require_once "../modelos/produccion.modelo.php";


class TablaEficiencia{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaEficiencia(){

        $eficiencia = ControladorProduccion::ctrMostrarEficiencia($_GET["inicio"], $_GET["fin"], $_GET["nquincena"], $_GET["id"]);	

        if(count($eficiencia)>0){

            if($_GET["nquincena"] == "1"){

                $datosJson = '{
                    "data": [';
            
                    for($i = 0; $i < count($eficiencia); $i++){

                        /* 
                        * d1
                        */
                        if($eficiencia[$i]["d1"] > 0){

                            $d1 = number_format($eficiencia[$i]["d1"],2).' %';

                        }else{

                            $d1= '';

                        }
                        /* 
                        * d2
                        */
                        if($eficiencia[$i]["d2"] > 0){

                            $d2 = number_format($eficiencia[$i]["d2"],2).' %';

                        }else{

                            $d2= '';

                        }
                        /* 
                        * d3
                        */
                        if($eficiencia[$i]["d3"] > 0){

                            $d3 = number_format($eficiencia[$i]["d3"],2).' %';

                        }else{

                            $d3= '';

                        }
                        /* 
                        * d4
                        */
                        if($eficiencia[$i]["d4"] > 0){

                            $d4 = number_format($eficiencia[$i]["d4"],2).' %';

                        }else{

                            $d4= '';

                        }
                        /* 
                        * d5
                        */
                        if($eficiencia[$i]["d5"] > 0){

                            $d5 = number_format($eficiencia[$i]["d5"],2).' %';

                        }else{

                            $d5= '';

                        }
                        /* 
                        * d6
                        */
                        if($eficiencia[$i]["d6"] > 0){

                            $d6 = number_format($eficiencia[$i]["d6"],2).' %';

                        }else{

                            $d6= '';

                        }
                        /* 
                        * d7
                        */
                        if($eficiencia[$i]["d7"] > 0){

                            $d7 = number_format($eficiencia[$i]["d7"],2).' %';

                        }else{

                            $d7= '';

                        }
                        /* 
                        * d8
                        */
                        if($eficiencia[$i]["d8"] > 0){

                            $d8 = number_format($eficiencia[$i]["d8"],2).' %';

                        }else{

                            $d8= '';

                        }
                        /* 
                        * d9
                        */
                        if($eficiencia[$i]["d9"] > 0){

                            $d9 = number_format($eficiencia[$i]["d9"],2).' %';

                        }else{

                            $d9= '';

                        }
                        /* 
                        * d10
                        */
                        if($eficiencia[$i]["d10"] > 0){

                            $d10 = number_format($eficiencia[$i]["d10"],2).' %';

                        }else{

                            $d10= '';

                        }
                        /* 
                        * d11
                        */
                        if($eficiencia[$i]["d11"] > 0){

                            $d11 = number_format($eficiencia[$i]["d11"],2).' %';

                        }else{

                            $d11= '';

                        }
                        /* 
                        * d12
                        */
                        if($eficiencia[$i]["d12"] > 0){

                            $d12 = number_format($eficiencia[$i]["d12"],2).' %';

                        }else{

                            $d12= '';

                        }
                        /* 
                        * d13
                        */
                        if($eficiencia[$i]["d13"] > 0){

                            $d13 = number_format($eficiencia[$i]["d13"],2).' %';

                        }else{

                            $d13= '';

                        }
                        /* 
                        * d14
                        */
                        if($eficiencia[$i]["d14"] > 0){

                            $d14 = number_format($eficiencia[$i]["d14"],2).' %';

                        }else{

                            $d14= '';

                        }
                        /* 
                        * d15
                        */
                        if($eficiencia[$i]["d15"] > 0){

                            $d15 = number_format($eficiencia[$i]["d15"],2).' %';

                        }else{

                            $d15= '';

                        }
                        /* 
                        * d16
                        */
                        if($eficiencia[$i]["d16"] > 0){

                            $d16 = number_format($eficiencia[$i]["d16"],2).' %';

                        }else{

                            $d16= '';

                        }
                        /* 
                        * d28
                        */
                        if($eficiencia[$i]["d28"] > 0){

                            $d28 = number_format($eficiencia[$i]["d28"],2).' %';

                        }else{

                            $d28= '';

                        }
                        /* 
                        * d29
                        */
                        if($eficiencia[$i]["d29"] > 0){

                            $d29 = number_format($eficiencia[$i]["d29"],2).' %';

                        }else{

                            $d29= '';

                        }
                        /* 
                        * d30
                        */
                        if($eficiencia[$i]["d30"] > 0){

                            $d30 = number_format($eficiencia[$i]["d30"],2).' %';

                        }else{

                            $d30= '';

                        }
                        /* 
                        * d31
                        */
                        if($eficiencia[$i]["d31"] > 0){

                            $d31 = number_format($eficiencia[$i]["d31"],2).' %';

                        }else{

                            $d31= '';

                        }


            
                        $datosJson .= '[
                        "'.$eficiencia[$i]["trabajador"].'",
                        "'.$eficiencia[$i]["nom_tra"].'",
                        "'.$d28.'",
                        "'.$d29.'",
                        "'.$d30.'",
                        "'.$d31.'",
                        "'.$d1.'",
                        "'.$d2.'",
                        "'.$d3.'",
                        "'.$d4.'",
                        "'.$d5.'",
                        "'.$d6.'",
                        "'.$d7.'",
                        "'.$d8.'",
                        "'.$d9.'",
                        "'.$d10.'",
                        "'.$d11.'",
                        "'.$d12.'",
                        "'.$d13.'",
                        "'.$d14.'",
                        "'.$d15.'",
                        "'.$d16.'"
                        ],';  
            
                    }
            
                        $datosJson=substr($datosJson, 0, -1);
            
                        $datosJson .= '] 
            
                        }';
            
                    echo $datosJson;


            }else{

                $datosJson = '{
                    "data": [';
            
                    for($i = 0; $i < count($eficiencia); $i++){
            

                        /* 
                        * d1
                        */
                        if($eficiencia[$i]["d1"] > 0){

                            $d1 = number_format($eficiencia[$i]["d1"],2).' %';

                        }else{

                            $d1= '';

                        }
                        /* 
                        * d13
                        */
                        if($eficiencia[$i]["d13"] > 0){

                            $d13 = number_format($eficiencia[$i]["d13"],2).' %';

                        }else{

                            $d13= '';

                        }
                        /* 
                        * d14
                        */
                        if($eficiencia[$i]["d14"] > 0){

                            $d14 = number_format($eficiencia[$i]["d14"],2).' %';

                        }else{

                            $d14= '';

                        }
                        /* 
                        * d15
                        */
                        if($eficiencia[$i]["d15"] > 0){

                            $d15 = number_format($eficiencia[$i]["d15"],2).' %';

                        }else{

                            $d15= '';

                        }
                        /* 
                        * d16
                        */
                        if($eficiencia[$i]["d16"] > 0){

                            $d16 = number_format($eficiencia[$i]["d16"],2).' %';

                        }else{

                            $d16= '';

                        }
                        /* 
                        * d17
                        */
                        if($eficiencia[$i]["d17"] > 0){

                            $d17 = number_format($eficiencia[$i]["d17"],2).' %';

                        }else{

                            $d17= '';

                        }
                        /* 
                        * d18
                        */
                        if($eficiencia[$i]["d18"] > 0){

                            $d18 = number_format($eficiencia[$i]["d18"],2).' %';

                        }else{

                            $d18= '';

                        }
                        /* 
                        * d19
                        */
                        if($eficiencia[$i]["d19"] > 0){

                            $d19 = number_format($eficiencia[$i]["d19"],2).' %';

                        }else{

                            $d19= '';

                        }
                        /* 
                        * d20
                        */
                        if($eficiencia[$i]["d20"] > 0){

                            $d20 = number_format($eficiencia[$i]["d20"],2).' %';

                        }else{

                            $d20= '';

                        }
                        /* 
                        * d21
                        */
                        if($eficiencia[$i]["d21"] > 0){

                            $d21 = number_format($eficiencia[$i]["d21"],2).' %';

                        }else{

                            $d21= '';

                        }
                        /* 
                        * d22
                        */
                        if($eficiencia[$i]["d22"] > 0){

                            $d22 = number_format($eficiencia[$i]["d22"],2).' %';

                        }else{

                            $d22= '';

                        }
                        /* 
                        * d23
                        */
                        if($eficiencia[$i]["d23"] > 0){

                            $d23 = number_format($eficiencia[$i]["d23"],2).' %';

                        }else{

                            $d23= '';

                        }
                        /* 
                        * d24
                        */
                        if($eficiencia[$i]["d24"] > 0){

                            $d24 = number_format($eficiencia[$i]["d24"],2).' %';

                        }else{

                            $d24= '';

                        }
                        /* 
                        * d25
                        */
                        if($eficiencia[$i]["d25"] > 0){

                            $d25 = number_format($eficiencia[$i]["d25"],2).' %';

                        }else{

                            $d25= '';

                        }
                        /* 
                        * d26
                        */
                        if($eficiencia[$i]["d26"] > 0){

                            $d26 = number_format($eficiencia[$i]["d26"],2).' %';

                        }else{

                            $d26= '';

                        }
                        /* 
                        * d27
                        */
                        if($eficiencia[$i]["d27"] > 0){

                            $d27 = number_format($eficiencia[$i]["d27"],2).' %';

                        }else{

                            $d27= '';

                        }
                        /* 
                        * d28
                        */
                        if($eficiencia[$i]["d28"] > 0){

                            $d28 = number_format($eficiencia[$i]["d28"],2).' %';

                        }else{

                            $d28= '';

                        }
                        /* 
                        * d29
                        */
                        if($eficiencia[$i]["d29"] > 0){

                            $d29 = number_format($eficiencia[$i]["d29"],2).' %';

                        }else{

                            $d29= '';

                        }
                        /* 
                        * d30
                        */
                        if($eficiencia[$i]["d30"] > 0){

                            $d30 = number_format($eficiencia[$i]["d30"],2).' %';

                        }else{

                            $d30= '';

                        }
                        /* 
                        * d31
                        */
                        if($eficiencia[$i]["d31"] > 0){

                            $d31 = number_format($eficiencia[$i]["d31"],2).' %';

                        }else{

                            $d31= '';

                        }

                        $datosJson .= '[
                        "'.$eficiencia[$i]["trabajador"].'",
                        "'.$eficiencia[$i]["nom_tra"].'",
                        "'.$d13.'",
                        "'.$d14.'",
                        "'.$d15.'",
                        "'.$d16.'",
                        "'.$d17.'",
                        "'.$d18.'",
                        "'.$d19.'",
                        "'.$d20.'",
                        "'.$d21.'",
                        "'.$d22.'",
                        "'.$d23.'",
                        "'.$d24.'",
                        "'.$d25.'",
                        "'.$d26.'",
                        "'.$d27.'",
                        "'.$d28.'",
                        "'.$d29.'",
                        "'.$d30.'",
                        "'.$d31.'",
                        "'.$d1.'"
                        ],';  
            
                    }
            
                        $datosJson=substr($datosJson, 0, -1);
            
                        $datosJson .= '] 
            
                        }';
            
                    echo $datosJson;


            }



        }else{

            echo '{
                "data":[]
            }';
            return;

        }
    }

}

/*=============================================
ACTIVAR TABLA DE ARTICULOS
=============================================*/ 
$activarArticulos = new TablaEficiencia();
$activarArticulos -> mostrarTablaEficiencia();