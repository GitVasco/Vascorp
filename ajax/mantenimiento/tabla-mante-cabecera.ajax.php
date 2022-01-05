<?php

require_once "../../controladores/mantenimiento.controlador.php";
require_once "../../modelos/mantenimiento.modelo.php";

class TablaManteCabecera{

    /*=============================================
    MOSTRAR LA TABLA DE AGENCIAS
    =============================================*/ 

    public function mostrarTablaManteCabecera(){

        $valor = null;

        $mantenimiento = ControladorMantenimiento::ctrMostrarMantenimiento($valor);	
        if(count($mantenimiento)>0){

        $datosJson = '{
        "data": [';

            for($i = 0; $i < count($mantenimiento); $i++){  

                //*TIPO
                if($mantenimiento[$i]["tipo_mante"] == "Preventivo"){

                    $tipo = "<span style='font-size:85%' class='label label-primary'>P</span>";

                }else{
                    
                    $tipo = "<span style='font-size:85%' class='label label-warning'>C</span>";

                }

                //*ESTADO
                if($mantenimiento[$i]["estado"] == "HECHO"){

                    $estado = "<span style='font-size:85%' class='label label-success'>HECHO</span>";

                }else{
                    
                    $estado = "<span style='font-size:85%' class='label label-danger'>NO HECHO</span>";

                }

                //*CODIGO
                $cod_interno = "<button class='btn btn-link btn-xs btnActivarDetalleMante' codigo='".$mantenimiento[$i]["cod_interno"]."'>".$mantenimiento[$i]["cod_interno"]."</button>";


                //*TRAEMOS LAS ACCIONES  
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarMantenimiento' idMantenimiento='".$mantenimiento[$i]["id"]."' data-toggle='modal' data-target='#modalEditarMantenimiento'><i class='fa fa-check'></i></button></div>"; 

                $datosJson .= '[
                    "'.$cod_interno.'",
                    "'.$tipo.'",                    
                    "'.$mantenimiento[$i]["mante_inicio"].'",
                    "'.$mantenimiento[$i]["mante_fin"].'",
                    "'.$mantenimiento[$i]["descripcion"].'",
                    "'.$mantenimiento[$i]["ubicacion_maquina"].'",
                    "'.$mantenimiento[$i]["nom_responsable"].'",
                    "'.$mantenimiento[$i]["items"].'",
                    "'.$mantenimiento[$i]["total_soles"].'",
                    "'.$mantenimiento[$i]["observaciones"].'",
                    "'.$estado.'",
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
$activarAgencias = new TablaManteCabecera();
$activarAgencias -> mostrarTablaManteCabecera();

