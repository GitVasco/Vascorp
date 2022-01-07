<?php

require_once "../../controladores/facturacion.controlador.php";
require_once "../../modelos/facturacion.modelo.php";

class TablaNotasCD{

    /* 
    * MOSTRAR TABLA DE ORDENES DE CORTE
    */
    public function mostrarTablaNotasCD(){

        $notas = ControladorFacturacion::ctrRangoFechasNotasCD($_GET["fechaInicial"],$_GET["fechaFinal"]);
        
        if(count($notas)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($notas); $i++){
                   
            /* 
            todo: formato de miles
            */
            $serie = substr($notas[$i]["documento"],0,4);
            $estado = "<button class='btn btn-success btn-xs'>FACTURADO</button>";
            if($serie == "B002" || $serie == "F002"){
                $botones =  "<div class='btn-group'><button class='btn btn-xs btn-warning btnEditarNotaCD' title='Editar notas CD' tipo='".$notas[$i]["tipo"]."' documento='".$notas[$i]["documento"]."'><i class='fa fa-pencil'></i></button><button title='Imprimir Nota Credito' class='btn btn-xs btn-success btnImprimirNotaCredito' tipo='".$notas[$i]["tipo"]."' documento='".$notas[$i]["documento"]."'><i class='fa fa-print'></i></button></div>";
            }else{
                $botones =  "<div class='btn-group'><button title='Imprimir Nota Credito' class='btn btn-xs btn-success btnImprimirNotaCredito' tipo='".$notas[$i]["tipo"]."' documento='".$notas[$i]["documento"]."'><i class='fa fa-print'></i></button></div>";
            }
                
            if($notas[$i]["nombre_tipo"] == "ND"){

                $nombre_tipo = "<span style='font-size:85%' class='label label-primary'>".$notas[$i]["nombre_tipo"]."</span>";

            }else{

                $nombre_tipo = "<span style='font-size:85%' class='label label-info'>".$notas[$i]["nombre_tipo"]."</span>";

            }
            
            


                $datosJson .= '[
                "'.$notas[$i]["tipo_documento"].'",
                "'.$nombre_tipo.'",
                "'.$notas[$i]["documento"].'",
                "'.$notas[$i]["total"].'",
                "'.$notas[$i]["cliente"]." - ".$notas[$i]["nombre"].'",
                "'.$notas[$i]["fecha"].'",
                "'.$notas[$i]["usuario"]." - ".$notas[$i]["nombres"].'",
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
ACTIVAR TABLA DE NOTAS
=============================================*/ 
$activarNotasCD= new TablaNotasCD();
$activarNotasCD -> mostrarTablaNotasCD();