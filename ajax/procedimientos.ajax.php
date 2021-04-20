<?php

require_once "../controladores/procedimiento.controlador.php";
require_once "../modelos/procedimiento.modelo.php";


class AjaxProcedimientos{
    /*=============================================
      EDITAR BANCO
      =============================================*/ 
    
      public $idSublimado;
    
      public function ajaxEditarSublimado(){
        $item="id";
        $valor = $this->idSublimado;
    
        $respuesta = ControladorProcedimientos::ctrMostrarSublimados($item,$valor);
    
        echo json_encode($respuesta);
    
      }
    
    }
    
    
    /*=============================================
    EDITAR SUBLIMADO
    =============================================*/	
    if(isset($_POST["idSublimado"])){
    
        $editarSublimado = new AjaxProcedimientos();
        $editarSublimado -> idSublimado = $_POST["idSublimado"];
        $editarSublimado -> ajaxEditarSublimado();
    }
    