<?php

require_once "../../controladores/almacencorte.controlador.php";
require_once "../../modelos/almacencorte.modelo.php";
require_once "../../controladores/plantilla.controlador.php";
class TablaAlmacenCorte
{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaAlmacenCorte()
    {

        $valor = null;

        $almacencorte = ControladorAlmacenCorte::ctrRangoFechasAlmacenCortes($_GET["fechaInicial"], $_GET["fechaFinal"]);

        #var_dump("almacencorte", $almacencorte);
        if (count($almacencorte) > 0) {
            $datosJson = '{
            "data": [';

            for ($i = 0; $i < count($almacencorte); $i++) {

                /* 
            todo: formato de miles
            */
                $total = number_format($almacencorte[$i]["total"], 0);

                /* 
            todo: orden de corte
            */
                $codigo = "<b>" . $almacencorte[$i]["codigo"] . "</b>";

                /* 
            todo: estado de orden de corte
            */
                if ($almacencorte[$i]["estado"] == "0") {

                    $estadoAC = "<button class='btn btn-warning btn-xs btnSistemas' codigo='" . $almacencorte[$i]["codigo"] . "' estadoAM='1'>Sistemas</button>";
                } else {

                    $estadoAC = "<button class='btn btn-primary btn-xs btnSistemas' codigo='" . $almacencorte[$i]["codigo"] . "' estadoAM='0'>Procesado</button>";
                }


                // todo: Traemos las acciones

                $viewAction = "<button class='btn btn-xs btn-info btnVisualizarAC' title='Visualizar Corte' data-toggle='modal' data-target='#modalVisualizarAC' codigoAC='{$almacencorte[$i]["codigo"]}'>
                    <i class='fa fa-eye'></i>
                </button>";

                $reportAction = "<button class='btn btn-xs btn-outline-success  btnReporteAC' title='Reporte de Corte' codigo='{$almacencorte[$i]["codigo"]}'style='border:green 1px solid'>
                    <img src='vistas/img/plantilla/excel.png' width='17px'>
                </button>";

                $editAction = "<button class='btn btn-xs btn-warning btnEditarCorteP' title='Editar corte'  codigoAC='{$almacencorte[$i]["codigo"]}'>
                    <i class='fa fa-pencil'></i>
                </button>";

                $telaAction = "<button class='btn btn-xs bg-orange btnEditarAC' title='Consumo de telas' data-toggle='modal' data-target='#modalEditarAC' codigoAC='{$almacencorte[$i]["codigo"]}'>
                    <i class='fa fa-shopping-bag'></i>
                </button>";

                $notificationAction = "<button class='btn btn-xs btn-success btnEditarNotificacion' title='Editar notificación' data-toggle='modal' data-target='#modalEditarNotificacion' codigoAC='{$almacencorte[$i]["codigo"]}'>
                    <i class='fa fa-commenting-o'></i>
                </button>";

                $loteAction = "<button class='btn btn-xs btn-primary btnEditarLote' title='Editar lote' codigoAC='{$almacencorte[$i]["codigo"]}'>
                    <i class='fa fa-cubes'></i>
                </button>";

                $consumoAction = "<button class='btn btn-xs btn-info btnEditarConsumo' title='Editar consumo' codigoAC='{$almacencorte[$i]["codigo"]}'>
                    <i class='fa fa-shopping-cart'></i>
                </button>";


                $botones =  "<div class='btn-group'>
                    {$viewAction}                    
                    {$reportAction}
                    {$editAction}
                    {$loteAction}
                    {$consumoAction}
                </div>";

                $botones = ControladorPlantilla::htmlClean($botones);

                $datosJson .= '[
                "' . $codigo . '",
                "' . $almacencorte[$i]["guia"] . '",
                "' . $almacencorte[$i]["nombre"] . '",
                "<center><b>' . $total . '</b></center>",
                "' . $estadoAC . '",
                "' . $almacencorte[$i]["fecha"] . '",
                "' . $botones . '"
                ],';
            }

            $datosJson = substr($datosJson, 0, -1);

            $datosJson .= '] 
    
                }';

            echo $datosJson;
        } else {

            echo '{
                    "data":[]
                }';
            return;
        }
    }
}

/*=============================================
ACTIVAR TABLA DE orden$ordencorte
=============================================*/
$activarAlmacenCorte = new TablaAlmacenCorte();
$activarAlmacenCorte->mostrarTablaAlmacenCorte();
