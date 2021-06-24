<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){

        $valor = null;

        $materiaprima = ControladorMateriaPrima::ctrMostrarMateriaPrima3($valor);	
        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $descripcion = str_replace('"','',$materiaprima[$i]["despro"]);

            /* 
            todo: Traemos las acciones
            */
            $botones =  "<div class='btn-group'><button type='button' class='btn btn-xs btn-primary btnCodpro' title='Agregar' codpro='".$materiaprima[$i]["codpro"]."' codfab='".$materiaprima[$i]["codfab"]."' descripcion='".$descripcion."' color='".$materiaprima[$i]["color"]."' stock='".$materiaprima[$i]["stock"]."'><i class='fa fa-plus'></i></button></div>";            
    
                $datosJson .= '[
                "'.$materiaprima[$i]["codpro"].'",
                "'.$materiaprima[$i]["codfab"].'",
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