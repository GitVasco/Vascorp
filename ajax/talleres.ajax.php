<?php

require_once "../controladores/talleres.controlador.php";
require_once "../modelos/talleres.modelo.php";

class AjaxTalleres{
/*=============================================
  EDITAR CANTIDAD DE TALLER
  =============================================*/ 

  public $idTaller;

  public function ajaxEditarCantidad(){

    $valor = $this->idTaller;

    $respuesta = ControladorTalleres::ctrMostrarTalleresG($valor);

    echo json_encode($respuesta);

    }

}
/*=============================================
EDITAR CANTIDAD DE TALLER
=============================================*/	
if(isset($_POST["idTaller"])){

	$taller = new AjaxTalleres();
	$taller -> idTaller = $_POST["idTaller"];
	$taller -> ajaxEditarCantidad();
}
