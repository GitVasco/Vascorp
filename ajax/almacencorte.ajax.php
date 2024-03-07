<?php

require_once '../controladores/almacencorte.controlador.php';
require_once '../modelos/almacencorte.modelo.php';

require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxAlmacenCorte
{

	/* 
	* VISUALIZAR LA CABECERA DEL CORTE
	*/
	// no tengo la variable $codigoAC
	public $codigoAC;
	public function ajaxVisualizarAlmacen()
	{

		$valor = $this->codigoAC;

		$respuesta = ControladorAlmacenCorte::ctrMostrarAlmacenCorte($valor);

		echo json_encode($respuesta);
	}

	/* 
	* VISUALIZAR DETALLE DEL CORTE
	*/
	// no tengo la variable $codigoDAC
	public $codigoDAC;

	public function ajaxVisualizarAlmacenDetalle()
	{
		// Se obtiene el código del almacén
		$codigoAlmacen = $this->codigoDAC;

		// Se obtiene el detalle del almacén
		$respuestaDetalle = ControladorAlmacenCorte::ctrVisualizarAlmacenCorteDetalle($codigoAlmacen);

		// Se devuelve el detalle del almacén
		echo json_encode($respuestaDetalle);
	}

	/* 
	* ESTADO CORTE
	*/
	public function ajaxEstadoCorte()
	{

		$valor = $this->activarId;

		$valor1 = $this->activarAM;

		$respuesta = ModeloAlmacenCorte::mdlEstadoCorte($valor, $valor1);

		echo $respuesta;
	}

	/* 
	* VISUALIZAR LA CABECERA DEL CORTE
	*/
	public function ajaxEditarAlmacen()
	{

		$valor = $this->codigo;

		$respuesta = ControladorAlmacenCorte::ctrMostrarTelasAlmacenCorte($valor);

		echo json_encode($respuesta);
	}

	// guardar lotes
	public $guardarCambios;
	public function ajaxGuardarLote()
	{
		// Obtén la cadena JSON enviada a través de FormData y decodifícala
		$valorJson = isset($_POST['guardarCambios']) ? $_POST['guardarCambios'] : null;
		$valor = json_decode($valorJson, true);

		if (is_array($valor)) {
			foreach ($valor as $key => $value) {
				$lote = ModeloAlmacenCorte::mdlActualizarLotes($value["articulo"], $value["lote"]);
			}
			echo json_encode($lote);
		} else {
			// Manejo de error si $valor no es un array
			echo json_encode(array("error" => "Datos no válidos"));
		}
	}
}


/* 
 * VISUALIZAR LA CABECERA DEL CORTE
*/
if (isset($_POST["codigoAC"])) {

	$visualizarAlmacenCorte = new AjaxAlmacenCorte();
	$visualizarAlmacenCorte->codigoAC = $_POST["codigoAC"];
	$visualizarAlmacenCorte->ajaxVisualizarAlmacen();
}

/* 
 * VISUALIZAR DETALLE DE LA ORDEN DE CORTE
*/
if (isset($_POST["codigoDAC"])) {

	$visualizarAlmacenCorteDetalle = new AjaxAlmacenCorte();
	$visualizarAlmacenCorteDetalle->codigoDAC = $_POST["codigoDAC"];
	$visualizarAlmacenCorteDetalle->ajaxVisualizarAlmacenDetalle();
}

/* 
* PROCESADO Y PEDIR REVISAR A SISTEMAS
*/
if (isset($_POST["activarId"])) {

	$activar = new AjaxAlmacenCorte();
	$activar->activarId = $_POST["activarId"];
	$activar->activarAM =  $_POST["activarAM"];
	$activar->ajaxEstadoCorte();
}

/* 
 * VISUALIZAR LA CABECERA DEL CORTE
*/
if (isset($_POST["codigo"])) {

	$editarAlmacenCorte = new AjaxAlmacenCorte();
	$editarAlmacenCorte->codigo = $_POST["codigo"];
	$editarAlmacenCorte->ajaxEditarAlmacen();
}

//* guardar Lotes
if (isset($_POST["guardarCambios"])) {

	$guardarLote = new AjaxAlmacenCorte();
	$guardarLote->guardarCambios = $_POST["guardarCambios"];
	$guardarLote->ajaxGuardarLote();
}
