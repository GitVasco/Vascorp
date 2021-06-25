<?php

require_once "../../controladores/orden-servicio.controlador.php";
require_once "../../modelos/orden-servicio.modelo.php";

class TablaMpOcPendienteOS{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMpOcPendiente(){

        $materiaprima = ControladorOrdenServicio::ctrMpOsPendiente();	

        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $desOri = str_replace('"','',$materiaprima[$i]["DesOri"]);

            $desDes = str_replace('"','',$materiaprima[$i]["DesDes"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                $datosJson .= '[
                "'.$materiaprima[$i]["Nro"].'",
                "'.$materiaprima[$i]["FecEmi"].'",
                "'.$materiaprima[$i]["FecEnt"].'",
                "'.$materiaprima[$i]["CodProOrigen"].'",
                "'.$desOri.'",
                "'.$materiaprima[$i]["ColorOri"].'",
                "'.$materiaprima[$i]["CodProDestino"].'",
                "'.$desDes.'",
                "'.$materiaprima[$i]["ColorDes"].'",
                "'.$materiaprima[$i]["Saldo"].'"
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
$activarMateriaPrima = new TablaMpOcPendienteOS();
$activarMateriaPrima -> mostrarTablaMpOcPendiente();