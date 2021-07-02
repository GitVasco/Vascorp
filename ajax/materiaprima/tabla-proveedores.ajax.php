<?php

require_once "../../controladores/proveedor.controlador.php";
require_once "../../modelos/proveedor.modelo.php";

class TablaProveedores{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaProveedores(){

        $item = null;     
        $valor = null;

        $proveedor = ControladorProveedores::ctrMostrarProveedores($item, $valor);	
        if(count($proveedor)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($proveedor); $i++){  

        $razon = str_replace('"','',$proveedor[$i]["RazPro"]);

        $direccion= str_replace('"','',$proveedor[$i]["DirPro"]);;

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
        
        $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btn-xs btnEditarProveedor' CodRuc='".$proveedor[$i]["CodRuc"]."' data-toggle='modal' data-target='#modalEditarProveedor'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btn-xs btnEliminarProveedor' CodRuc='".$proveedor[$i]["CodRuc"]."'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.$proveedor[$i]["CodRuc"].'",
            "'.$proveedor[$i]["RucPro"].'",
            "'.$razon.'",
            "'.$direccion.'",
            "'.$proveedor[$i]["TelPro1"].'",
            "'.$proveedor[$i]["EmaPro"].'",
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
ACTIVAR TABLA DE PROVEEDORES
=============================================*/ 
$activarProveedores = new TablaProveedores();
$activarProveedores -> mostrarTablaProveedores();

