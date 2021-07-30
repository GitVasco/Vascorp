<?php

require_once "../../controladores/centro-costos.controlador.php";
require_once "../../modelos/centro-costos.modelo.php";

class TablaCentroCostosResumen{

    /*
    *MOSTRAR LA TABLA DE AGENCIAS
    */ 

    public function mostrarTablaCentroCostosResumen(){

        $valor = null;

        $centros = ControladorCentroCostos::ctrMostrarCentroCostosResumen($valor);	

        if(count($centros)>0){

        $datosJson = '{
        "data": [';

        for($i = 0; $i < count($centros); $i++){  

            if($centros[$i]["m1"] == "0"){

                $m1="";

            }else{

                $m1 = "<div style='text-align:right !important'>".number_format($centros[$i]["m1"],2)."</div>";

            }
            if($centros[$i]["m2"] == "0"){

                $m2="";

            }else{

                $m2 = "<div style='text-align:right !important'>".number_format($centros[$i]["m2"],2)."</div>";

            }
            if($centros[$i]["m3"] == "0"){

                $m3="";

            }else{

                $m3 = "<div style='text-align:right !important'>".number_format($centros[$i]["m3"],2)."</div>";

            }
            if($centros[$i]["m4"] == "0"){

                $m4="";

            }else{

                $m4 = "<div style='text-align:right !important'>".number_format($centros[$i]["m4"],2)."</div>";

            }
            if($centros[$i]["m5"] == "0"){

                $m5="";

            }else{

                $m5 = "<div style='text-align:right !important'>".number_format($centros[$i]["m5"],2)."</div>";

            }
            if($centros[$i]["m6"] == "0"){

                $m6="";

            }else{

                $m6 = "<div style='text-align:right !important'>".number_format($centros[$i]["m6"],2)."</div>";

            }
            if($centros[$i]["m7"] == "0"){

                $m7="";

            }else{

                $m7 = "<div style='text-align:right !important'>".number_format($centros[$i]["m7"],2)."</div>";

            }
            if($centros[$i]["m8"] == "0"){

                $m8="";

            }else{

                $m8 = "<div style='text-align:right !important'>".number_format($centros[$i]["m8"],2)."</div>";

            }
            if($centros[$i]["m9"] == "0"){

                $m9="";

            }else{

                $m9 = "<div style='text-align:right !important'>".number_format($centros[$i]["m9"],2)."</div>";

            }
            if($centros[$i]["m10"] == "0"){

                $m10="";

            }else{

                $m10 = "<div style='text-align:right !important'>".number_format($centros[$i]["m10"],2)."</div>";

            }
            if($centros[$i]["m11"] == "0"){

                $m11="";

            }else{

                $m11 = "<div style='text-align:right !important'>".number_format($centros[$i]["m11"],2)."</div>";

            }
            if($centros[$i]["m12"] == "0"){

                $m12="";

            }else{

                $m12 = "<div style='text-align:right !important'>".number_format($centros[$i]["m12"],2)."</div>";

            }
            if($centros[$i]["total"] == "0"){

                $total="";

            }else{

                $total = "<div style='text-align:right !important'>".number_format($centros[$i]["total"],2)."</div>";

            }


            $datosJson .= '[
            
            "'.$centros[$i]["key_gasto"].'",
            "'.$centros[$i]["nombre_gasto"].'",
            "'.$centros[$i]["nombre_area"].'",
            "'.$centros[$i]["cod_caja"].'",
            "<b>'.$centros[$i]["descripcion"].'</b>",
            "'.$m1.'",
            "'.$m2.'",
            "'.$m3.'",
            "'.$m4.'",
            "'.$m5.'",
            "'.$m6.'",
            "'.$m7.'",
            "'.$m8.'",
            "'.$m9.'",
            "'.$m10.'",
            "'.$m11.'",
            "'.$m12.'",
            "'.$total.'"
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
$activarAgencias = new TablaCentroCostosResumen();
$activarAgencias -> mostrarTablaCentroCostosResumen();

