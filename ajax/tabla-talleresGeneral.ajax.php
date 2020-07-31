<?php

require_once "../controladores/talleres.controlador.php";
require_once "../modelos/talleres.modelo.php";

class TablaTalleresG{

    /*
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaTalleresG(){

        $valor = null;

        $talleres = ControladorTalleres::ctrMostrarTalleresG($valor);

        #var_dump("almacencorte", $talleres);

        $datosJson = '{
            "data": [';

            for($i = 0; $i < count($talleres); $i++){

            /*
            todo: ESTADO
            */
            if($talleres[$i]["estado"] == "1"){


                $estado = "<span style='font-size:85%' class='label label-info'>Generado</span>";
    
            }elseif($talleres[$i]["estado"] == "2"){
    
                $estado = "<span style='font-size:85%' class='label label-primary'>En Proceso</span>";
    
            }else{
    
                $estado = "<span style='font-size:85%' class='label label-success'>Terminado</span>";
    
            } 

            /*
            todo: BOTONES
            */
            if($talleres[$i]["estado"] == "3"){

                $botones =  "<div class='btn-group'><button class='btn btn-primary btnTrabajador' codigo='".$talleres[$i]["codigo"]."'><i class='fa fa-user'></i></button> <button class='btn btn-warning btnImprimirTicket' ultimo='".$talleres[$i]["codigo"]."'><i class='fa fa-print'></i></button></div>"; 

            }else{

                $botones =  "<div class='btn-group'><button class='btn btn-warning btnImprimirTicket' ultimo='".$talleres[$i]["codigo"]."'><i class='fa fa-print'></i></button></div>"; 

            }


                $datosJson .= '[
                "'.$talleres[$i]["id"].'",
                "'.$talleres[$i]["codigo"].'",
                "'.$talleres[$i]["modelo"].'",
                "'.$talleres[$i]["color"].'",
                "'.$talleres[$i]["talla"].'",
                "'.$talleres[$i]["nom_operacion"].'",
                "'.$talleres[$i]["trabajador"].'",
                "'.$talleres[$i]["cantidad"].'",
                "'.$talleres[$i]["fecha"].'",
                "'.$estado.'",
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
ACTIVAR TABLA DE orden$ordencorte
=============================================*/ 
$activarTalleresG = new TablaTalleresG();
$activarTalleresG -> mostrarTablaTalleresG();