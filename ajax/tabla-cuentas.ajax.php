<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";

class TablaCuentas{

    /*=============================================
    MOSTRAR LA TABLA DE UNIDADES DE MEDIDA
    =============================================*/ 

    public function mostrarTablaCuentas(){

        $item = null;     
        $valor = null;

        $cuenta = ControladorCuentas::ctrMostrarCuentas($item, $valor);	
        if(count($cuenta)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($cuenta); $i++){  

        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/      
        /*=============================================
        RENOVACION
        =============================================*/ 

        if($cuenta[$i]["renovacion"] == 0 ){

            $renovacion = "<span style='font-size:85%' class='label label-danger'>FALSO</span>";

        }else{

            $renovacion = "<span style='font-size:85%' class='label label-success'>VERDADERO</span>";

        }

        /*=============================================
        PROTESTA
        =============================================*/ 

        if($cuenta[$i]["protesta"] == 0 ){

            $protesta = "<span style='font-size:85%' class='label label-danger'>FALSO</span>";

        }else{

            $protesta = "<span style='font-size:85%' class='label label-success'>VERDADERO</span>";

        }
   
        
        $botones =  "<div class='btn-group'><button class='btn btn-primary btnCancelarCuenta' idCuenta='".$cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalCancelarCuenta' title='Cancelar cuenta'><i class='fa fa-money'></i></button><button class='btn btn-warning btnEditarCuenta' idCuenta='".$cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCuenta' idCuenta='".$cuenta[$i]["id"]."' title='Eliminar cuenta'><i class='fa fa-times'></i></button></div>"; 

            $datosJson .= '[
            "'.$cuenta[$i]["tipo_doc"].'",
            "'.$cuenta[$i]["num_cta"].'",
            "'.$cuenta[$i]["cliente"].'",
            "'.$cuenta[$i]["vendedor"].'",
            "'.$cuenta[$i]["fecha"].'",
            "'.$cuenta[$i]["fecha_ven"].'",
            "'.$cuenta[$i]["monto"].'",
            "'.$cuenta[$i]["saldo"].'",
            "'.$cuenta[$i]["estado_doc"].'",
            "'.$cuenta[$i]["num_unico"].'",
            "'.$renovacion.'",
            "'.$protesta.'",
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
$activarCuentas = new TablaCuentas();
$activarCuentas -> mostrarTablaCuentas();

