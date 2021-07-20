<?php

require_once '../controladores/centro-costos.controlador.php';
require_once '../modelos/centro-costos.modelo.php';

class AjaxTablaCentroCostos{

    /* 
    * Traer area
    */
    public function ajaxTraerArea(){

		$valor = $this->tipoGasto;

		$respuesta = ControladorCentroCostos::ctrMostrarAreas($valor);

		echo json_encode($respuesta);

	}	

	    /* 
    * Traer correlativo
    */
    public function ajaxTraerCorrelativo(){

		$tipoGasto = $this->tipoGasto;
		$area = $this->area;

		$respuesta = ControladorCentroCostos::ctrMostrarCorrelativo($tipoGasto, $area);

		echo json_encode($respuesta);

	}	
	
}

/* 
* Traer areas
*/
if(isset($_POST["tipoGasto"])){

	$traerArea = new AjaxTablaCentroCostos();
	$traerArea -> tipoGasto = $_POST["tipoGasto"];
	$traerArea -> ajaxTraerArea();

}

/* 
*traer correlativo
*/
if(isset($_POST["area"])){

	$traerCorrelativo = new AjaxTablaCentroCostos();
	$traerCorrelativo -> area = $_POST["area"];
	$traerCorrelativo -> tipoGasto = $_POST["tipoGastoB"];
	$traerCorrelativo -> ajaxTraerCorrelativo();

}