<?php

require_once "../controladores/asistencia.controlador.php";
require_once "../modelos/asistencia.modelo.php";

class TablaAsistencia{
 /*=============================================
    MOSTRAR LA TABLA DE ASISTENCIAS
    =============================================*/ 

    public function mostrarTablaAsistencia(){

        $item = null;     
        $valor = null;

        $asistencia = ControladorAsistencias::ctrMostrarAsistencias($item, $valor);	

        

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($asistencia); $i++){  

        /*=============================================
        TRAEMOS LA IMAGEN
        =============================================*/ 
        if($asistencia[$i]["estado"] == "ASISTIO"){

            $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$asistencia[$i]["id"]."' estadoAsistencia='FALTA'><img id='estadoImagen' src='vistas/img/plantilla/asistio.png'  width='40px'></button>";
            

        }else{

            $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$asistencia[$i]["id"]."' estadoAsistencia='ASISTIO'><img id='estadoImagen' src='vistas/img/plantilla/falto.png'  width='40px'></button>";
            
        }
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        $botones =  "<div class='btn-group'><button class='btn btn-danger btnEditarAsistencia' idAsistencia='".$asistencia[$i]["id"]."' data-toggle='modal' data-target='#modalEditarAsistencia' title='Editar para'><i class='fa fa-exclamation-triangle'></i></button><button class='btn btn-success btnEditarExtras' idAsistencia='".$asistencia[$i]["id"]."' data-toggle='modal' data-target='#modalEditarExtras' title='Editar horas extras'><i class='fa fa-clock-o'></i></button></div>"; 
        

            $datosJson .= '[
            "'.$asistencia[$i]["id_trabajador"].'",
            "'.$asistencia[$i]["nom_tra"].$asistencia[$i]["ape_pat_tra"].$asistencia[$i]["ape_mat_tra"].'",
            "'.$imagen.'",
            "'.date("Y-m-d", strtotime($asistencia[$i]["fecha"])).'",
            "'.$asistencia[$i]["minutos"].'",
            "'.$asistencia[$i]["nombre"].'",
            "'.$asistencia[$i]["tiempo_para"].'",
            "'.$asistencia[$i]["horas_extras"].'",
            "'.$botones.'"
            ],';        
            }

            $datosJson=substr($datosJson, 0, -1);

            $datosJson .= '] 

            }';

        echo $datosJson;

    }

}
/*=============================================
ACTIVAR TABLA DE OPERACIONES
=============================================*/ 
$activarAsistencia = new TablaAsistencia();
$activarAsistencia -> mostrarTablaAsistencia();