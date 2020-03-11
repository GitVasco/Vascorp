<?php

require_once "../controladores/operaciones.controlador.php";
require_once "../modelos/operaciones.modelo.php";

class AjaxOperaciones{
/*=============================================
  EDITAR OPERACIONES
  =============================================*/ 

  public $idOperacion;

  public function ajaxEditarOperacion(){
    $item="id";
    $valor = $this->idOperacion;

    $respuesta = ControladorOperaciones::ctrMostrarOperaciones($item,$valor);

    echo json_encode($respuesta);

	}
}


/*=============================================
EDITAR OPERACION
=============================================*/	
if(isset($_POST["idOperacion"])){

	$operacion = new AjaxOperaciones();
	$operacion -> idOperacion = $_POST["idOperacion"];
	$operacion -> ajaxEditarOperacion();
}

