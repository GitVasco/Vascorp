<?php

require_once "../controladores/produccion.controlador.php";
require_once "../modelos/produccion.modelo.php";


class TablaEficiencia{

    /*=============================================
    MOSTRAR LA TABLA DE ARTICULOS
    =============================================*/ 

    public function mostrarTablaEficiencia(){

        $valor = "null";

        $eficiencia = ControladorProduccion::ctrMostrarEficiencia($valor);	

        if(count($eficiencia)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($eficiencia); $i++){

            $datosJson .= '[
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'",
            "'.$eficiencia[$i]["trabajador"].'"
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
ACTIVAR TABLA DE ARTICULOS
=============================================*/ 
$activarArticulos = new TablaEficiencia();
$activarArticulos -> mostrarTablaEficiencia();