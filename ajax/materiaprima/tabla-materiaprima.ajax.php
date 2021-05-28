<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){

        $valor = null;

        $materiaprima = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);	
        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $descripcion = str_replace('"','',$materiaprima[$i]["DesPro"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                $botones = "<div class='btn-group'><button class='btn btn-sm btn-info btnVisualizarArticulos' title='Visualizar Articulos' data-toggle='modal' data-target='#modalVisualizarArticulos' articuloMP='".$materiaprima[$i]["CodPro"]."'><i class='fa fa-eye'></i></button><button class='btn btn-sm btn-warning btnEditarMateriaPrima' idMateriaPrima='".$materiaprima[$i]["CodPro"]."' data-toggle='modal' data-target='#modalEditarMateriaPrima' title='Editar Materia Prima'><i class='fa fa-pencil'></i></button><button class='btn btn-sm btn-success btnDuplicarMateriaPrima' idMateriaPrima='".$materiaprima[$i]["CodPro"]."' data-toggle='modal' data-target='#modalDuplicarMateriaPrima' title='Nuevo Color'><i class='fa fa-clone'></i></button><button class='btn btn-sm btn-primary btnEditarCosto' title='Visualizar Costo' data-toggle='modal' data-target='#modalEditarCostos' materiaPrima='".$materiaprima[$i]["CodPro"]."'><i class='fa fa-money'></i></button><button class='btn btn-sm btn-danger btnAnularMateriaPrima' title='Anular Materia Prima' idMateriaPrima='".$materiaprima[$i]["CodPro"]."'><i class='fa fa-times'></i></button></div>";
    
                $datosJson .= '[
                "'.($i+1).'",
                "'.$materiaprima[$i]["CodPro"].'",
                "'.$materiaprima[$i]["CodFab"].'",
                "'.$materiaprima[$i]["CodAlt"].'",
                "'.$descripcion.'",
                "'.$materiaprima[$i]["Color"].'",
                "'.$materiaprima[$i]["Unidad"].'",
                "'.$materiaprima[$i]["Proveedores"].'",
                "'.$materiaprima[$i]["CodAlm01"].'",
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