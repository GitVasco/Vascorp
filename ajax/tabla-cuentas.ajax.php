<?php

require_once "../controladores/cuentas.controlador.php";
require_once "../modelos/cuentas.modelo.php";
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
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

        if(isset($cuenta[$i]["saldo"])) {
        /*=============================================
        TRAEMOS LAS ACCIONES
        =============================================*/      
        
            if($cuenta[$i]["saldo"]==0){
                $botones =  "<div class='btn-group'><button class='btn btn-primary btnVisualizarCuenta' idCuenta='".$cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalVisualizarrCuenta' title='Visualizar cuenta'><i class='fa fa-eye'></i></button><button class='btn btn-warning btnEditarCuenta' idCuenta='".$cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCuenta' idCuenta='".$cuenta[$i]["id"]."' title='Eliminar cuenta'><i class='fa fa-times'></i></button></div>";
            }else{
                $botones =  "<div class='btn-group'><button class='btn btn-primary btnVisualizarCuenta' idCuenta='".$cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalVisualizarrCuenta' title='Visualizar cuenta'><i class='fa fa-eye'></i></button><button class='btn btn-success btnCancelarCuenta' idCuenta='".$cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalCancelarCuenta' title='Cancelar cuenta'><i class='fa fa-money'></i></button><button class='btn btn-warning btnEditarCuenta' idCuenta='".$cuenta[$i]["id"]."' data-toggle='modal' data-target='#modalEditarCuenta' title='Editar cuenta'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCuenta' idCuenta='".$cuenta[$i]["id"]."' title='Eliminar cuenta'><i class='fa fa-times'></i></button></div>"; 
            }
            
        $clientes=ControladorClientes::ctrMostrarClientes("codigo",$cuenta[$i]["cliente"]);
      

        

            $datosJson .= '[
            "'.$cuenta[$i]["tipo_doc"].'",
            "'.$cuenta[$i]["num_cta"].'",
            "'.$clientes["codigo"]." - ".$clientes["nombre"].'",
            "'.$cuenta[$i]["vendedor"].'",
            "'.$cuenta[$i]["fecha"].'",
            "'.$cuenta[$i]["fecha_ven"].'",
            "'.$cuenta[$i]["monto"].'",
            "'.$cuenta[$i]["saldo"].'",
            "'.$cuenta[$i]["estado_doc"].'",
            "'.$cuenta[$i]["num_unico"].'",
            "'.$cuenta[$i]["doc_origen"].'",
            "'.$botones.'"
            ],'; 
                }       
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

