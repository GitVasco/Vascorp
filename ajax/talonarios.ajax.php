<?php

require_once "../controladores/talonarios.controlador.php";
require_once "../modelos/talonarios.modelo.php";

class AjaxTalonarios{

	/*=============================================
	EDITAR CATEGORÍA
	=============================================*/	

	public $idCategoria;

	public function ajaxTraerTalonario(){

		$valor = $this->documento;

		$respuesta = ControladorTalonarios::ctrMostrarTalonarios($valor);

		echo json_encode($respuesta);

	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["documento"])){

	$talonario = new AjaxTalonarios();
	$talonario -> documento = $_POST["documento"];
	$talonario -> ajaxTraerTalonario();
}
