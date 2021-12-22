<?php

require_once "../../controladores/mantenimiento.controlador.php";
require_once "../../modelos/mantenimiento.modelo.php";

class TablaCalendario{

    /*=============================================
    MOSTRAR LA TABLA DE AGENCIAS
    =============================================*/ 

    public function mostrarTablaCalendario(){

        $valor = null;

        $calendario = ControladorMantenimiento::ctrMostrarCalendario($valor);	
        if(count($calendario)>0){

        $datosJson = '{
        "data": [';

            for($i = 0; $i < count($calendario); $i++){  

                //*ESTADO


                //*TRAEMOS LAS ACCIONES  
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarEquipo' idCalendario='".$calendario[$i]["id"]."' data-toggle='modal' data-target='#modalAgregarEquipos'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnEliminarAgencia' idCalendario='".$calendario[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

                $datosJson .= '[
                    "'.$calendario[$i]["tipo"].'",
                    "'.$calendario[$i]["titulo"].'",
                    "'.$calendario[$i]["inicio"].'",
                    "'.$calendario[$i]["fin"].'",
                    "'.$calendario[$i]["indicaciones"].'",
                    "'.$calendario[$i]["estado"].'",
                    "'.$calendario[$i]["usureg"].'",
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
ACTIVAR TABLA DE AGENCIAS
=============================================*/ 
$activarAgencias = new TablaCalendario();
$activarAgencias -> mostrarTablaCalendario();

