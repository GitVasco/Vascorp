<?php

require_once "../../controladores/materiaprima.controlador.php";
require_once "../../modelos/materiaprima.modelo.php";

class TablaKardex{

    /*=============================================
    MOSTRAR LA TABLA DE MATERIA PRIMA
    =============================================*/ 

    public function mostrarTablaKardex(){

        $codigo = $_GET["codigo"];
        $ano = $_GET["ano"];
        $ano_ant = $_GET["ano_ant"];

        $kardex = ControladorMateriaPrima::ctrMostrarKardexMP($codigo, $ano, $ano_ant);

        if(count($kardex)>0){

        $datosJson = '{
            "data": [';
    
            for($i = 0; $i < count($kardex); $i++){

            /* 
            todo: quitamos los ceros y pintamos
            */
                if($kardex[$i]["nDoc"] == ''){
                        
                    $ndoc = '';

                }

                if($kardex[$i]["CanIng"] <= 0){

                    $caning = '';

                }else{

                    $ndoc = "<b><span style='color:#000080'>".$kardex[$i]["nDoc"]."</span></b>";

                    $caning = "<b><span style='color:#000080;display:block;text-align:right'>".number_format($kardex[$i]["CanIng"],4)."</span></b>";                    

                }

                if($kardex[$i]["CanSal"] <= 0){

                    

                    $cansal = '';

                }else{

                    $ndoc = "<b><span style='color:#8B0000'>".$kardex[$i]["nDoc"]."</span></b>";

                    $cansal = "<b><span style='color:#8B0000;display:block;text-align:right'>".number_format($kardex[$i]["CanSal"],4)."</span></b>";

                }





                $datosJson .= '[
                "'.$ndoc.'",
                "'.$kardex[$i]["Fecha"].'",
                "'.$kardex[$i]["FecEmi"].'",
                "'.$kardex[$i]["Razon"].'",
                "<b>'.$kardex[$i]["StkInicial"].'</b>",
                "'.$caning.'",
                "'.$cansal.'"
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
ACTIVAR TABLA DE MATERIA PRIMA
=============================================*/ 
$activarMateriaPrima = new TablaKardex();
$activarMateriaPrima -> mostrarTablaKardex();