<?php

require_once "../../controladores/servicio.controlador.php";
require_once "../../modelos/servicio.modelo.php";

class TablaVerPagoServicios{

    /*=============================================
    MOSTRAR LA TABLA DE PRODUCTOS
    =============================================*/ 

    public function mostrarTablaVerPagoServicios(){

        $inicio = $_GET["inicio"];     
        $fin = $_GET["fin"];

        $pagoservicios = ControladorServicios::ctrVerPagoServicios($inicio,$fin);	
        if(count($pagoservicios)>0){

        $datosJson = '{
        "data": [';


        for($i = 0; $i < count($pagoservicios); $i++){
            //convirtiendo fecha datetime a date por cadena
            $fecha=substr($pagoservicios[$i]["fecha"],0,10);
    
            $datosJson .= '[
            "'.$pagoservicios[$i]["cod_sector"]." - ".$pagoservicios[$i]["nom_sector"].'",
            "'.$pagoservicios[$i]["guia"].'",
            "'.$fecha.'",
            "'.$pagoservicios[$i]["codigo"].'",
            "'.$pagoservicios[$i]["modelo"].'",
            "'.$pagoservicios[$i]["nombre"].'",
            "'.$pagoservicios[$i]["cod_color"].'",
            "'.$pagoservicios[$i]["color"].'",
            "'.$pagoservicios[$i]["t1"].'",
            "'.$pagoservicios[$i]["t2"].'",
            "'.$pagoservicios[$i]["t3"].'",
            "'.$pagoservicios[$i]["t4"].'",
            "'.$pagoservicios[$i]["t5"].'",
            "'.$pagoservicios[$i]["t6"].'",
            "'.$pagoservicios[$i]["t7"].'",
            "'.$pagoservicios[$i]["t8"].'",
            "'.$pagoservicios[$i]["total_docenas"].'",
            "'.$pagoservicios[$i]["precio_doc"].'",
            "'.$pagoservicios[$i]["total_soles"].'"
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
ACTIVAR TABLA DE SERVICIOS
=============================================*/ 
$activarVerPagoServicios = new TablaVerPagoServicios();
$activarVerPagoServicios -> mostrarTablaVerPagoServicios();