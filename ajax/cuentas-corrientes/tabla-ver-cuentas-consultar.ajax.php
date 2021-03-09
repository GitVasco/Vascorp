<?php

require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";

class TablaVerCuentas{

    /*=============================================
    MOSTRAR LA TABLA DE CuentaS
    =============================================*/ 

    public function mostrarTablaVerCuentas(){

        $Cuenta = ControladorCuentas::ctrMostrarCancelaciones("num_cta",$_GET["numCta"]);
        if(count($Cuenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($Cuenta); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/         
       
            $datosJson .= '[
            "'.$Cuenta[$i]["num_cta"].'",
            "'.$Cuenta[$i]["vendedor"].'",
            "'.$Cuenta[$i]["monto"].'",
            "'.$Cuenta[$i]["notas"].'"
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
ACTIVAR TABLA DE Cuenta
=============================================*/ 
$activarVerCuentas = new TablaVerCuentas();
$activarVerCuentas -> mostrarTablaVerCuentas();

