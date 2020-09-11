<?php

require_once "../controladores/ingresos.controlador.php";
require_once "../modelos/ingresos.modelo.php";

class TablaIngresos{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaIngresos(){

        $ingreso = ControladorIngresos::ctrRangoFechasIngresos($_GET["fechaInicial"],$_GET["fechaFinal"]);
        // $ingreso = ControladorOrdenCorte::ctrRangoFechasOrdenCortes($item,$valor);
        
        if(count($ingreso)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($ingreso); $i++){
                   
            /* 
            todo: formato de miles
            */
            $total = number_format($ingreso[$i]["total"],0);

            
            $botones =  "<div class='btn-group'><button class='btn btn-warning  btnEditarIngStock' title='Editar Ingreso stock' idIngreso='".$ingreso[$i]["id"]."'><i class='fa fa-pencil'></i></button><button class='btn btn-danger  btnEliminarIngStock' title='Eliminar Ingreso stock' idIngreso='".$ingreso[$i]["id"]."'><i class='fa fa-times'></i></div>";



                $datosJson .= '[
                "'.($i+1).'",
                "'.$ingreso[$i]["usuario"].'",
                "'.$ingreso[$i]["documento"].'",
                "'.$ingreso[$i]["total"].'",
                "'.$total.'",
                "'.$ingreso[$i]["fecha"].'",
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
ACTIVAR TABLA DE orden$ingreso
=============================================*/ 
$activarOrdenCorte = new TablaIngresos();
$activarOrdenCorte -> mostrarTablaIngresos();