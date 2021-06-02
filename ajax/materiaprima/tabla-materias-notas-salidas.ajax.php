<?php

require_once "../../controladores/notas-salidas.controlador.php";
require_once "../../modelos/notas-salidas.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){


        $materiaprima = ControladorNotasSalidas::ctrMostrarMateriasNotas();	
        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $descripcion = str_replace('"','',$materiaprima[$i]["DesPro"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarMateriaNota recuperarBoton' idMateriaNota='".$materiaprima[$i]["CodPro"]."'><i class='fa fa-plus-square'></i> Agregar</button></div>"; 
    
                $datosJson .= '[
                "'.$materiaprima[$i]["CodPro"].'",
                "'.$materiaprima[$i]["CodFab"].'",
                "'.$descripcion.'",
                "'.$materiaprima[$i]["Unidad"].'",
                "'.$materiaprima[$i]["CodigoColor"].'",
                "'.$materiaprima[$i]["Color"].'",
                "'.$materiaprima[$i]["precio"].'",
                "'.$materiaprima[$i]["Stk_Min"].'",
                "'.$materiaprima[$i]["CodAlm01"].'",
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