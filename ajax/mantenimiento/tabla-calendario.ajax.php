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

                //*TIPO ACTIVIDAD

                if($calendario[$i]["tipo"] == "Actividades"){

                    $tipo = "<span style='font-size:85%' class='label label-primary'>".$calendario[$i]["tipo"]."</span>";

                }else if($calendario[$i]["tipo"] == "Mantenimiento"){

                    $tipo = "<span style='font-size:85%' class='label label-warning'>".$calendario[$i]["tipo"]."</span>";

                }else if($calendario[$i]["tipo"] == "Reunion"){

                    $tipo = "<span style='font-size:85%' class='label label-info'>".$calendario[$i]["tipo"]."</span>";

                }else if($calendario[$i]["tipo"] == "Capacitacion"){

                    $tipo = "<span style='font-size:85%' class='label label-danger'>".$calendario[$i]["tipo"]."</span>";

                }else if($calendario[$i]["tipo"] == "Cumpleaños"){

                    $tipo = "<span style='font-size:85%' class='label label-success'>".$calendario[$i]["tipo"]."</span>";

                }




                //*TRAEMOS LAS ACCIONES  
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditaCalendario' idCalendario='".$calendario[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCalendario'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularCalendario' idCalendario='".$calendario[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

                $datosJson .= '[
                    "'.$tipo.'",
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

