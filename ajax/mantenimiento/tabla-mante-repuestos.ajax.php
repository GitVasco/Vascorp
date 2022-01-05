<?php

require_once "../../controladores/mantenimiento.controlador.php";
require_once "../../modelos/mantenimiento.modelo.php";

class TablaManteRepuestos{

    /*=============================================
    MOSTRAR LA TABLA DE AGENCIAS
    =============================================*/ 

    public function mostrarTablaManteRepuestos(){

        $valor = 'CAJ';
        $repuestos = ControladorMantenimiento::ctrMostrarMantenimientoRepuestos($valor);	
        if(count($repuestos)>0){

        $datosJson = '{
        "data": [';

            for($i = 0; $i < count($repuestos); $i++){  

                //*stock
                $stock = "<div style='text-align:right !important'>".$repuestos[$i]["stock"]."</div>";

                //*boton
                $boton = "<button type='button' class='btn btn-primary btn-xs btnAddRpt' codInterno='".$_GET["codInterno"]."' codpro='".$repuestos[$i]["codpro"]."' cospro='".$repuestos[$i]["cospro"]."'>Agregar</button>";

                $datosJson .= '[
                    "'.$repuestos[$i]["codpro"].'",
                    "'.$repuestos[$i]["codfab"].'",     
                    "'.$repuestos[$i]["despro"].'",
                    "'.$repuestos[$i]["unidad"].'",
                    "'.$stock.'",
                    "'.$repuestos[$i]["cospro"].'",
                    "'.$boton.'"
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
$activarAgencias = new TablaManteRepuestos();
$activarAgencias -> mostrarTablaManteRepuestos();

