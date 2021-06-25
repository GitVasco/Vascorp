<?php

require_once "../../controladores/orden-compra.controlador.php";
require_once "../../modelos/orden-compra.modelo.php";

class TablaMpOcPendiente{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMpOcPendiente(){

        $materiaprima = ControladorOrdenCompra::ctrMpOcPendiente();	

        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $descripcion = str_replace('"','',$materiaprima[$i]["despro"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                $datosJson .= '[
                "'.$materiaprima[$i]["nro"].'",
                "'.$materiaprima[$i]["fecemi"].'",
                "'.$materiaprima[$i]["fecllegada"].'",
                "'.$materiaprima[$i]["proveedor"].'",
                "'.$materiaprima[$i]["codpro"].'",
                "'.$materiaprima[$i]["codfab"].'",
                "'.$descripcion.'",
                "'.$materiaprima[$i]["color"].'",
                "'.$materiaprima[$i]["unidad"].'",
                "'.$materiaprima[$i]["cantni"].'"
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
$activarMateriaPrima = new TablaMpOcPendiente();
$activarMateriaPrima -> mostrarTablaMpOcPendiente();