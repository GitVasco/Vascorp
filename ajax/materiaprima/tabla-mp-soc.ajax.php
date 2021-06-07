<?php

require_once "../../controladores/notas-ingresos.controlador.php";
require_once "../../modelos/notas-ingresos.modelo.php";

class TablaMPSinOC{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMPSinOC(){

        $empresa = $_GET["empresa"];
        $oc = $_GET["oc"];

        $sinOC = ControladorNotasIngresos::ctrMostrarMPOC($empresa, $oc);	

        if(count($sinOC)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($sinOC); $i++){

            $descripcion = str_replace('"','',$sinOC[$i]["DesPro"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                $botones = "<div class='btn-group'><button class='btn btn-xs btn-primary agregarMPNI recuperarBoton' codpro='".$sinOC[$i]["CodPro"]."' orden='".$sinOC[$i]["Nro"]."' idBoton='".$sinOC[$i]["CodPro"].$sinOC[$i]["Nro"]."' empresa='".$sinOC[$i]["codruc"]."'><i class='fa fa-plus'></i></button></div>";
    
                $datosJson .= '[
                "'.$sinOC[$i]["CodPro"].'",
                "'.$sinOC[$i]["CodFab"].'",
                "'.$descripcion.'",
                "'.$sinOC[$i]["Unidad"].'",
                "'.$sinOC[$i]["ColPro"].'",
                "'.$sinOC[$i]["Color"].'",
                "'.$sinOC[$i]["precio"].'",
                "'.$sinOC[$i]["preciocigv"].'",
                "'.$sinOC[$i]["Stk_Act"].'",
                "'.$sinOC[$i]["CanNI"].'",
                "'.$sinOC[$i]["Nro"].'",
                "'.$sinOC[$i]["Proveedor"].'",
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
$activarMateriaPrima = new TablaMPSinOC();
$activarMateriaPrima -> mostrarTablaMPSinOC();