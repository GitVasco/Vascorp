<?php

require_once "../controladores/salidas.controlador.php";
require_once "../modelos/salidas.modelo.php";


class AjaxSalidas{
    /*=============================================
      SELECT DOCUMENTO
      =============================================*/ 
    
      public $documento;
    
      public function ajaxSelectDocumento(){
        $valor = $this->documento;
    
        $respuesta = ControladorSalidas::ctrMostrarArgumentoSalida($valor);
    
        echo json_encode($respuesta);
    
      }
    
    }
    
    
    /*=============================================
    SELECT DOCUMENTO
    =============================================*/	
    if(isset($_POST["documento"])){
    
        $selectDocumento = new AjaxSalidas();
        $selectDocumento -> documento = $_POST["documento"];
        $selectDocumento -> ajaxSelectDocumento();
    }
    