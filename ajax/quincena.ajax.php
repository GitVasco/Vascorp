<?php

require_once '../controladores/produccion.controlador.php';
require_once '../modelos/produccion.modelo.php';

class AjaxQuincenas{

    /* 
	* Editar quincena
	*/
	public function ajaxEditarQuincena(){

		$valor = $this->id;

		$respuesta = ControladorProduccion::ctrMostrarQuincenas($valor);

		echo json_encode($respuesta);

	}

	
	/* 
	* Actualizar precio tiempo de quincena
	*/

	public $inicioPrecioTiempo;
	public $finPrecioTiempo;
	public function ajaxActualizarPrecioTiempo(){

		$valor1 = $this->inicioPrecioTiempo;
		$valor2 = $this->finPrecioTiempo;

		$respuesta = ModeloProduccion::mdlActualizarPrecioTiempo($valor1,$valor2);

		echo $respuesta;

	}

}

/* 
* Editar qincena
*/
if(isset($_POST["id"])){

	$editarQuincena = new AjaxQuincenas();
	$editarQuincena -> id = $_POST["id"];
	$editarQuincena -> ajaxEditarQuincena();
  
}

/* 
* Actualizar precio tiempo de quincena
*/
if(isset($_POST["inicioPrecioTiempo"])){

	$actualizarPrecioT = new AjaxQuincenas();
	$actualizarPrecioT -> inicioPrecioTiempo = $_POST["inicioPrecioTiempo"];
	$actualizarPrecioT -> finPrecioTiempo = $_POST["finPrecioTiempo"];
	$actualizarPrecioT -> ajaxActualizarPrecioTiempo();
  
}