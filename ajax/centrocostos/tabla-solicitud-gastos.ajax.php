<?php
session_start();
require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaGastosCaja{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaGastosCaja(){

        $usuario = $_SESSION["nombre"];

        $gastos = ControladorCentroCostos::ctrMostrarGastosCajaUsuario($usuario);	

        if(count($gastos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($gastos); $i++){  


            /* 
            * Monto
            */
            $total = "<div style='text-align:right !important'>".number_format($gastos[$i]["total"],2)."</div>";

            /* 
            * Estado
            */
            if($gastos[$i]["estado"] == "2" && $_SESSION["nombre"] == $gastos[$i]["usureg"]){

                $estado = "<button class='btn btn-warning btn-xs' idSolicitud='".$gastos[$i]["id"]."' estadoSol='3' total=".$gastos[$i]["total"]." fecha='".$gastos[$i]["fecha"]."'>Por Aprobar</button>";

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarSolicitud' idGasto='".$gastos[$i]["id"]."' estado=".$gastos[$i]["estado"]." data-toggle='modal' data-target='#modalEditarSolicitud'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularGasto' id='btnSol".$gastos[$i]["id"]."' name='btnSol".$gastos[$i]["id"]."' title='Anular Gasto' idGasto='".$gastos[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            }else if($gastos[$i]["estado"] == "2" && $_SESSION["nombre"] != $gastos[$i]["usureg"]){

                $estado = "<button class='btn btn-warning btn-xs btnAprobarSol' idSolicitud='".$gastos[$i]["id"]."' estadoSol='3' total=".$gastos[$i]["total"]." fecha='".$gastos[$i]["fecha"]."'>Por Aprobar</button>";

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarSolicitud' idGasto='".$gastos[$i]["id"]."' estado=".$gastos[$i]["estado"]." data-toggle='modal' data-target='#modalEditarSolicitud'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularGasto' id='btnSol".$gastos[$i]["id"]."' name='btnSol".$gastos[$i]["id"]."' title='Anular Gasto' idGasto='".$gastos[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            }else if($gastos[$i]["estado"] == "3"){

                $estado = "<button class='btn btn-info btn-xs btnAprobarSol' idSolicitud='".$gastos[$i]["id"]."' estadoSol='4'>Por Rendir</button>";

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarSolicitud' idGasto='".$gastos[$i]["id"]."' estado=".$gastos[$i]["estado"]." data-toggle='modal' data-target='#modalEditarSolicitud'><i class='fa fa-pencil'></i></button></div>"; 

            }else if($gastos[$i]["estado"] == "4"){

                $estado = "<button class='btn btn-primary btn-xs' idSolicitud='".$gastos[$i]["id"]."'>Por Aceptar</button>";

                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarSolicitud' idGasto='".$gastos[$i]["id"]."' estado=".$gastos[$i]["estado"]." data-toggle='modal' data-target='#modalEditarSolicitud'><i class='fa fa-pencil'></i></button></div>"; 

            }


            $datosJson .= '[            
                "'.$gastos[$i]["fecha"].'",
                "'.$gastos[$i]["recibo"].'",
                "'.$gastos[$i]["proveedor"].'",
                "'.$gastos[$i]["nom_sucursal"].'",
                "'.$gastos[$i]["tipo_gasto"].'",
                "<b>'.$gastos[$i]["nom_caja"].'</b>",
                "<b>'.$total.'</b>",
                "'.$gastos[$i]["nombre_documento"].'",
                "'.$gastos[$i]["documento"].'",
                "'.$gastos[$i]["solicitante"].'",
                "<b>'.$gastos[$i]["desc_salida"].'</b>",
                "'.$gastos[$i]["usureg"].'",
                "'.$estado.'",
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
$activarTabla = new TablaGastosCaja();
$activarTabla -> mostrarTablaGastosCaja();

