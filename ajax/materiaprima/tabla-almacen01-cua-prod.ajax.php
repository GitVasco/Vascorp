<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){

        $tipo   = 'CUA';

        $materiaprima = ControladorMateriaPrima::ctrMostrarAlmacen01($tipo);	
        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $descripcion = str_replace('"','',$materiaprima[$i]["despro"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
                $botones = "<div class='btn-group'><button class='btn btn-primary btn-xs  agregarCuadros recuperarBoton' codpro='".$materiaprima[$i]["codpro"]."' idBoton='".$materiaprima[$i]["codpro"]."' title='Agregar Copas'><i class='fa fa-plus'></i></button></div>";

                $datosJson .= '[
                "'.$materiaprima[$i]["codpro"].'",
                "'.$descripcion.'",
                "'.$materiaprima[$i]["color"].'",
                "'.$materiaprima[$i]["stock"].'",
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
ACTIVAR TABLA DE MATERIA PRIMA
=============================================*/ 
$activarMateriaPrima = new TablaMateriaPrima();
$activarMateriaPrima -> mostrarTablaMateriaPrima();