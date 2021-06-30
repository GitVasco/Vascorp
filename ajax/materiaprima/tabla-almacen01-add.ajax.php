<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaAlmacen01Add{

    /*=============================================
    MOSTRAR LA TABLA DE NOTAS Ingresos
    =============================================*/ 

    public function mostrarTablaAlmacen01Add(){
        
        $alm01 = ControladorMateriaPrima::ctrAlmacen01Agregar($_GET["codpro"]);	

        if(count($alm01)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($alm01); $i++){       

            $descripcion = str_replace('"','',$alm01[$i]["despro"]);
     
            /*
            *TRAEMOS LAS ACCIONES
            */    
            $cuadro = "<button type='button' class='btn btn-primary btn-xs btnAddAlm01' cuadro='".$_GET["codpro"]."' codpro='".$alm01[$i]["codpro"]."'>Agregar</button>";

            $datosJson .= '[
                "'.$alm01[$i]["codpro"].'",
                "'.$alm01[$i]["codfab"].'",
                "'.$descripcion.'",
                "'.$alm01[$i]["color"].'",
                "'.$alm01[$i]["talla"].'",
                "'.$alm01[$i]["unidad"].'",
                "'.$alm01[$i]["stock"].'",
                "<center>'.$cuadro.'</center>" 
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
ACTIVAR TABLA DE NOTAS Ingresos
=============================================*/ 
$activarTabla = new TablaAlmacen01Add();
$activarTabla -> mostrarTablaAlmacen01Add();