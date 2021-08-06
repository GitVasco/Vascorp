<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaGastosCaja{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaGastosCaja(){

        $mes = $_GET["mesG"];

        $gastos = ControladorCentroCostos::ctrMostrarGastosCaja($mes);	

        if(count($gastos)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($gastos); $i++){  


            /* 
            * Monto
            */
            $total = "<div style='text-align:right !important'>".number_format($gastos[$i]["total"],2)."</div>";

            /* 
            * Botones
            */
            $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarGasto' idGasto='".$gastos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarGasto'><i class='fa fa-pencil'></i></button><button class='btn btn-xs btn-danger btnAnularGasto' title='Anular Gasto' idGasto='".$gastos[$i]["id"]."'><i class='fa fa-times'></i></button></div>"; 

            /* 
            *estado
            */
            if($gastos[$i]["estado"] == "1"){

                $estado = "<button class='btn btn-success btn-xs' idSolicitud='".$gastos[$i]["id"]."'>Aprobado</button>";

            }else if($gastos[$i]["estado"] == "2"){

                $estado = "<button class='btn btn-warning btn-xs btnAprobarSol' idSolicitud='".$gastos[$i]["id"]."' estadoSol='3' total=".$gastos[$i]["total"]." fecha='".$gastos[$i]["fecha"]."'>Por Aprobar</button>";

            }else if($gastos[$i]["estado"] == "3"){

                $estado = "<button class='btn btn-primary btn-xs btnAprobarSol' idSolicitud='".$gastos[$i]["id"]."' estadoSol='1'>Por Rendir</button>";

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

