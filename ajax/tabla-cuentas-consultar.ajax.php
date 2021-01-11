<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
class TablaCuentasConsultar{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaCuentasConsultar(){

        $item = "cliente";     
        $valor = $_GET["cliente"];

        $cuenta = ControladorCuentas::ctrMostrarTipoCuentas($item, $valor);	
        if(count($cuenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cuenta); $i++){  
        $clientes=ControladorClientes::ctrMostrarClientes("codigo",$cuenta[$i]["cliente"]);
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/      
            if($cuenta[$i]["estado"]=='PENDIENTE'){
                $estado =  "<button class='btn btn-danger btn-xs'>PENDIENTE</button>";
            }else{
                $estado =  "<button class='btn btn-success btn-xs'>CANCELADO</button>";
            }
                
            $botones =  "<div class='btn-group'><button class='btn btn-primary btnVisualizarCuenta' numCta='".$cuenta[$i]["num_cta"]."'  title='Visualizar cuenta'><i class='fa fa-eye'></i></button></div>";
             
            $datosJson .= '[
            "'.$cuenta[$i]["tipo_doc"].'",
            "'.$cuenta[$i]["num_cta"].'",
            "'.$clientes["codigo"]." - ".$clientes["nombre"].'",
            "'.$cuenta[$i]["vendedor"].'",
            "'.$cuenta[$i]["fecha"].'",
            "'.$cuenta[$i]["fecha_ven"].'",
            "'.$cuenta[$i]["monto"].'",
            "'.$cuenta[$i]["saldo"].'",
            "'.$estado.'",
            "'.$cuenta[$i]["num_unico"].'",
            "'.$cuenta[$i]["doc_origen"].'",
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
ACTIVAR TABLA DE TIPO DE PAGO
=============================================*/ 
$activarCuentasConsultar = new TablaCuentasConsultar();
$activarCuentasConsultar -> mostrarTablaCuentasConsultar();

