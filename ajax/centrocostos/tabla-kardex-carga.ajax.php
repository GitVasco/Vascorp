<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaKardex{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaKardex(){

        $valor = null;

        $centros = ControladorCentroCostos::ctrMostrarKardex($valor);	

        if(count($centros)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($centros); $i++){  


            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-outline-success  btnExpKardex' title='Exportar Impresión' codigo='".$centros[$i]["codigo"]."' anno='".$centros[$i]["anno"]."' mes='".$centros[$i]["mes"]."' style='border:green 1px solid'><img src='vistas/img/plantilla/excel.png' width='17px'></button></div>";

            $datosJson .= '[
            
            "'.$centros[$i]["id"].'",
            "'.$centros[$i]["tipo"].'",
            "'.$centros[$i]["codigo"].'",
            "'.$centros[$i]["anno"].'",
            "'.$centros[$i]["mes"].'",
            "'.$centros[$i]["saldo_inicial"].'",
            "'.$centros[$i]["ingreso"].'",
            "'.$centros[$i]["salida"].'",
            "'.$centros[$i]["saldo_final"].'",
            "'.$centros[$i]["usureg"].'",
            "'.$centros[$i]["fecreg"].'",
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
$activarAgencias = new TablaKardex();
$activarAgencias -> mostrarTablaKardex();

