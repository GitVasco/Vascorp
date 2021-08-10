<?php

require_once "../../controladores/asistencia.controlador.php";
require_once "../../modelos/asistencia.modelo.php";

class TablaAsistencia{
 /*=============================================
    MOSTRAR LA TABLA DE ASISTENCIAS
    =============================================*/ 

    public function mostrarTablaAsistencia(){

        $item = null;     
        $valor = null;

        $asistencia = ControladorAsistencias::ctrRangoFechasAsistencias($_GET["fechaInicial"],$_GET["fechaFinal"]);	

        
        if(count($asistencia)>0){
        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($asistencia); $i++){  

        /*=============================================
        TRAEMOS LA IMAGEN
        =============================================*/ 
        if($asistencia[$i]["estado"] == "ASISTIO"){

            $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$asistencia[$i]["id"]."' estadoAsistencia='FALTA' fecha = '".$asistencia[$i]["fecha2"]."'><img id='estadoImagen' src='vistas/img/plantilla/asistio.png'  width='20px'></button>";
            
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/      
            if($asistencia[$i]["estado_para"] == 1) {
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-info btnEditarAsistencia' idAsistencia='".$asistencia[$i]["id"]."' data-toggle='modal' data-target='#modalEditarAsistencia' title='Editar para'><i class='fa fa-exclamation-triangle'></i></button><button class='btn btn-xs btn-danger btnEditarPara' idAsistencia='".$asistencia[$i]["id"]."' data-toggle='modal' data-target='#modalEditarPara' title='Editar nueva para'><i class='fa fa-minus'></i></button><button class='btn btn-xs btn-success btnEditarExtras' idAsistencia='".$asistencia[$i]["id"]."' data-toggle='modal' data-target='#modalEditarExtras' title='Editar horas extras'><i class='fa fa-plus'></i></button></div>"; 
            }else{
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-danger btnEditarPara' idAsistencia='".$asistencia[$i]["id"]."' data-toggle='modal' data-target='#modalEditarPara' title='Editar nueva para'><i class='fa fa-minus'></i></button><button class='btn btn-xs btn-success btnEditarExtras' idAsistencia='".$asistencia[$i]["id"]."' data-toggle='modal' data-target='#modalEditarExtras' title='Editar horas extras'><i class='fa fa-plus'></i></button></div>"; 
            }
        
        }else{

            $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$asistencia[$i]["id"]."' estadoAsistencia='ASISTIO' fecha = '".$asistencia[$i]["fecha2"]."'><img id='estadoImagen' src='vistas/img/plantilla/falto.png'  width='20px'></button>";
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/      
           
            $botones =  "<div class='btn-group'></div>"; 
            
        }

        if($asistencia[$i]["estado_para"] == 1){
            $para = "<span style='font-size:85%' class='label label-danger'>PARAS</span>";
        }else{
            $para = "<span style='font-size:85%' class='label label-warning'>NO PARAS</span>";
        }
        
        

            $datosJson .= '[
            "'.$asistencia[$i]["id_trabajador"].'",
            "'.$asistencia[$i]["nom_tra"]." ".$asistencia[$i]["ape_pat_tra"]." ".$asistencia[$i]["ape_mat_tra"].'",
            "'.$imagen.'",
            "'.$asistencia[$i]["fecha2"].'",
            "'.$asistencia[$i]["minutos"].'",
            "'.$asistencia[$i]["horas_extras"].'",
            "'.$para.'",
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
ACTIVAR TABLA DE ASISTENCIAS
=============================================*/ 
$activarAsistencia = new TablaAsistencia();
$activarAsistencia -> mostrarTablaAsistencia();