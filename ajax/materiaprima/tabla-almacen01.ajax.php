<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){

        $tipo   = $_GET["tipo"];

        $materiaprima = ControladorMateriaPrima::ctrMostrarAlmacen01($tipo);	
        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $descripcion = str_replace('"','',$materiaprima[$i]["despro"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/
            
                if($materiaprima[$i]["fam"] == "CUA" ){

                    $botones = "<div class='btn-group'><button class='btn btn-xs btn-primary btnAgregarCopas' codpro='".$materiaprima[$i]["codpro"]."' codfab='".$materiaprima[$i]["codfab"]."' despro='".$materiaprima[$i]["despro"]."' color='".$materiaprima[$i]["color"]."' unidad='".$materiaprima[$i]["unidad"]."' stock='".$materiaprima[$i]["stock"]."' data-toggle='modal' data-target='#modalAgrearCopas' title='Agregar Copas'><i class='fa fa-plus'></i></button><button class='btn btn-xs btn-danger btnQuitarCopas' codpro='".$materiaprima[$i]["codpro"]."' codfab='".$materiaprima[$i]["codfab"]."' despro='".$materiaprima[$i]["despro"]."' color='".$materiaprima[$i]["color"]."' unidad='".$materiaprima[$i]["unidad"]."' stock='".$materiaprima[$i]["stock"]."' data-toggle='modal' data-target='#modalQuitarCopas' title='Quitar Copas'><i class='fa fa-minus'></i></button><button class='btn btn-xs btn-success btnAgregarCuadrosProd' codpro='".$materiaprima[$i]["codpro"]."' title='Agregar Producción Cuadros'><i class='fa fa-calculator'></i></button></div>";

                }else{

                    $botones = "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarMateriaPrima' idMateriaPrima='".$materiaprima[$i]["codpro"]."' data-toggle='modal' data-target='#modalEditarMateriaPrima' title='Editar Materia Prima'><i class='fa fa-pencil'></i></button></div>";

                }


    
                $datosJson .= '[
                "'.$materiaprima[$i]["codpro"].'",
                "'.$materiaprima[$i]["codfab"].'",
                "'.$descripcion.'",
                "'.$materiaprima[$i]["color"].'",
                "'.$materiaprima[$i]["talla"].'",
                "'.$materiaprima[$i]["unidad"].'",                
                "'.$materiaprima[$i]["stock"].'",
                "'.$materiaprima[$i]["cuadro_nom"].'",
                "'.$materiaprima[$i]["usureg"].'",
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
ACTIVAR TABLA DE MATERIA PRIMA
=============================================*/ 
$activarMateriaPrima = new TablaMateriaPrima();
$activarMateriaPrima -> mostrarTablaMateriaPrima();