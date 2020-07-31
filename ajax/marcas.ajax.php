<?php

require_once "../controladores/marcas.controlador.php";
require_once "../modelos/marcas.modelo.php";

class AjaxMarcas{

	/*=============================================
	EDITAR MARCA
	=============================================*/	

	public $idMarca;

	public function ajaxEditarMarca(){

		$valor = $this->idMarca;

		$respuesta = ControladorMarcas::ctrMostrarMarcas($valor);

		echo json_encode($respuesta);

	}

	//ACTIVAR MARCA
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarMarca(){

		$tabla="marcasjf";
		$valor1=$this->activarEstado;
		$valor2=$this->activarId;

		$respuesta=ModeloMarcas::mdlActualizarMarca($tabla,$valor1, $valor2);

		echo $respuesta;
	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idMarca"])){

	$marca = new AjaxMarcas();
	$marca -> idMarca = $_POST["idMarca"];
	$marca -> ajaxEditarMarca();
}

/*=============================================
ACTIVAR MARCA
=============================================*/ 

if(isset($_POST["activarId"])){
	$activar=new AjaxMarcas();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxActivarDesactivarMarca();
}