<?php

require_once "../../controladores/maestras.controlador.php";
require_once "../../modelos/maestras.modelo.php";

class TablaMaestraDetalle{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaMaestraDetalle(){

        $tipo = $_GET["tipPro"];
        $documento = $_GET["docPro"];

        $maestras = ControladorMaestras::ctrMostrarProdDetalle($tipo, $documento);	


        if(count($maestras)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($maestras); $i++){  

        $despro = str_replace('"','',$maestras[$i]["despro"]);


        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-warning btn-xs btnEditarMP' codpro='".$maestras[$i]["codigo"]."' documento='".$maestras[$i]["documento"]."'  tipo='".$maestras[$i]["tipo"]."'  despro ='".$despro."' canpro='".$maestras[$i]["cantidad"]."' color= '".$maestras[$i]["color"]."' talla='".$maestras[$i]["talla"]."' unidad='".$maestras[$i]["unidad"]."' codfab='".$maestras[$i]["codfab"]."' data-toggle='modal' data-target='#modalEditarMP' title='Editar Item'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btn-xs btnEliminarMP'  title='Eliminar Item' codigo='".$maestras[$i]["codigo"]."' documento='".$maestras[$i]["documento"]."' tipo='".$maestras[$i]["tipo"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.$maestras[$i]["tipo"].'",
            "'.$maestras[$i]["documento"].'",
            "'.$maestras[$i]["codigo"].'",
            "'.$maestras[$i]["codfab"].'",
            "'.$despro.'",
            "'.$maestras[$i]["color"].'",
            "'.$maestras[$i]["talla"].'",
            "'.$maestras[$i]["unidad"].'",
            "'.$maestras[$i]["cantidad"].'",
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
$activarTabla = new TablaMaestraDetalle();
$activarTabla -> mostrarTablaMaestraDetalle();

