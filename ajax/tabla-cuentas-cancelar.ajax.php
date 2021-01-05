<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
class TablaCancelarCuentas{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaCancelarCuentas(){

        $mayor = $_GET["mayor"];     
        $menor = $_GET["menor"];

        $cuenta = ControladorCuentas::ctrMostrarCuentasPendientes($mayor, $menor);	
        if(count($cuenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cuenta); $i++){  
        $clientes=ControladorClientes::ctrMostrarClientes("codigo",$cuenta[$i]["cliente"]);
        
            
            $botones =  "<div class='btn-group'><input type='checkbox'>Cancelar</div>"; 
                
            $datosJson .= '[
            "'.$cuenta[$i]["tipo_doc"].'",
            "'.$cuenta[$i]["num_cta"].'",
            "'.$clientes["codigo"]." - ".$clientes["nombre"].'",
            "'.$cuenta[$i]["fecha"].'",
            "'.$cuenta[$i]["fecha_ven"].'",
            "'.$cuenta[$i]["monto"].'",
            "'.$cuenta[$i]["saldo"].'",
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
ACTIVAR TABLA CANCELAR CUENTAS
=============================================*/ 
$activarCancelarCuentas = new TablaCancelarCuentas();
$activarCancelarCuentas -> mostrarTablaCancelarCuentas();

