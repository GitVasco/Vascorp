<?php

require_once "../../controladores/orden-compra.controlador.php";
require_once "../../modelos/orden-compra.modelo.php";

class TablaMateriaPrima{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaMateriaPrima(){

        $valor=$_GET["proveedorCompra"];
        $materiaprima = ControladorOrdenCompra::ctrMostrarMateriasCompras($valor);	
        if(count($materiaprima)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($materiaprima); $i++){

            $descripcion = str_replace('"','',$materiaprima[$i]["DesPro"]);
         
       
            /*=============================================
            TRAEMOS LAS ACCIONES
            =============================================*/         

                
        $botones =  "<div class='btn-group'><button class='btn btn-primary btn-xs agregarMateriaCompra recuperarBoton' idMateriaCompra='".$materiaprima[$i]["CodPro"]."' CodRuc = '".$materiaprima[$i]["CodRuc"]."'><i class='fa fa-plus-square'></i> Agregar</button></div>"; 
    
                $datosJson .= '[
                "'.$materiaprima[$i]["CodPro"].'",
                "'.$materiaprima[$i]["CodFab"].'",
                "'.$descripcion.'",
                "'.$materiaprima[$i]["Color"].'",
                "'.$materiaprima[$i]["Unidad"].'",
                "'.$materiaprima[$i]["PrecioSinIgv"].'",
                "'.$materiaprima[$i]["RazPro"].'",
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