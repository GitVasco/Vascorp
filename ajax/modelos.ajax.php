<?php

// Requerimos el controlador y el modelo
require_once '../controladores/modelos.controlador.php';
require_once '../modelos/modelos.modelo.php';

class AjaxModelos{
	//ACTIVAR ARTICULO
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarModelo(){

		$tabla="modelojf";
		$valor1=$this->activarEstado;

		$valor2=$this->activarId;

		$respuesta=ModeloModelos::mdlActualizarModelo($tabla,$valor1, $valor2);

		echo $respuesta;
	}
	/* 
	* EDITAR ARTICULO
	*/
	public $modelo;

	public function ajaxEditarModelo(){

        $item="modelo";
		$valor = $this->modelo;

		$respuesta = ControladorModelos::ctrMostrarModelos($item,$valor);

		echo json_encode($respuesta);

	}


}


/*=============================================
ACTIVAR ARTICULO
=============================================*/ 

if(isset($_POST["activarId"])){
	$activar=new AjaxModelos();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxActivarDesactivarModelo();
}


/*=============================================
EDITAR ARTICULO
=============================================*/ 

if(isset($_POST["modelo"])){

	$editarModelo = new AjaxModelos();
	$editarModelo -> modelo = $_POST["modelo"];
	$editarModelo -> ajaxEditarModelo();
  
}
