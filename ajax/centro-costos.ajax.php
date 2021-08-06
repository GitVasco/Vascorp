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
	
	/* 
    * traer datos del centro de costos
    */
    public function ajaxTraerCentroCostos(){

		$cod_caja = $this->cod_caja;

		$respuesta = ControladorCentroCostos::ctrMostrarCentroCostos($cod_caja);

		echo json_encode($respuesta);

	}	

	/* 
    * traer datos del gasto
    */
    public function ajaxTraerGastos(){

		$idGasto = $this->idGasto;

		$respuesta = ControladorCentroCostos::ctrMostrarGastosCajaId($idGasto);

		echo json_encode($respuesta);

	}
	
	/* 
    * traer datos del gasto
    */
    public function ajaxTraerIngresos(){

		$idIngreso = $this->idIngreso;

		$respuesta = ControladorCentroCostos::ctrMostrarIngresosCajaId($idIngreso);

		echo json_encode($respuesta);

	}	

	/* 
    * traer datos del gasto
    */
    public function ajaxCambiarEstado(){

		$idSolicitud = $this->idSolicitud;
		$estadoSol = $this->estadoSol;

		$datosE = array("id" 		=> $idSolicitud,
						"estado" 	=> $estadoSol);

		$respuesta = ModeloCentroCostos::mdlCambiarEstado($datosE);

		echo json_encode($respuesta);

	}	

	/* 
    * traer datos del gasto
    */
    public function ajaxActualizarEgresosA(){

		$fecha = $this->fecha;
		$egreso = $this->total;

		$datosE = array("fecha" 		=> $fecha,
						"egreso"	 	=> $egreso);

		$respuesta = ModeloCentroCostos::mdlActualizarEgresosA($datosE);

		//echo json_encode($respuesta);

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

/* 
* traer datos del centro de costos
*/
if(isset($_POST["cod_caja"])){

	$traerCentroCostos = new AjaxTablaCentroCostos();
	$traerCentroCostos -> cod_caja = $_POST["cod_caja"];
	$traerCentroCostos -> ajaxTraerCentroCostos();

}


/* 
* traer datos del gasto
*/
if(isset($_POST["idGasto"])){

	$traerCentroCostos = new AjaxTablaCentroCostos();
	$traerCentroCostos -> idGasto = $_POST["idGasto"];
	$traerCentroCostos -> ajaxTraerGastos();

}


/* 
* traer datos del gasto
*/
if(isset($_POST["idIngreso"])){

	$traerCentroCostos = new AjaxTablaCentroCostos();
	$traerCentroCostos -> idIngreso = $_POST["idIngreso"];
	$traerCentroCostos -> ajaxTraerIngresos();

}

/* 
* cambiar de estado
*/
if(isset($_POST["idSolicitud"])){

	$traerCentroCostos = new AjaxTablaCentroCostos();
	$traerCentroCostos -> idSolicitud = $_POST["idSolicitud"];
	$traerCentroCostos -> estadoSol = $_POST["estadoSol"];
	$traerCentroCostos -> ajaxCambiarEstado();

}


/* 
* cambiar de estado
*/
if(isset($_POST["fecha"])){

	$traerCentroCostos = new AjaxTablaCentroCostos();
	$traerCentroCostos -> fecha = $_POST["fecha"];
	$traerCentroCostos -> total = $_POST["total"];
	$traerCentroCostos -> ajaxActualizarEgresosA();

}