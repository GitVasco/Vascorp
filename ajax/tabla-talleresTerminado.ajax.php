<?php

require_once "../controladores/talleres.controlador.php";
require_once "../modelos/talleres.modelo.php";

class TablaTalleresT{

    /*
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaTalleresT(){

        $valor = null;

        $talleres = ControladorTalleres::ctrMostrarTalleresTerminado($valor);

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

                $botones =  "<div class='btn-group'><button class='btn btn-primary btnAsignarTrabajador' codigo='".$talleres[$i]["codigo"]."' data-toggle='modal' data-target='#modalAsignarTrabajador'><i class='fa fa-user'></i></button></div>"; 




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
$activarTalleresT = new TablaTalleresT();
$activarTalleresT -> mostrarTablaTalleresT();