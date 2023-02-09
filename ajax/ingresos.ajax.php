<?php
require_once '../controladores/ingresos.controlador.php';
require_once '../modelos/ingresos.modelo.php';
require_once '../controladores/produccion.controlador.php';
require_once '../modelos/produccion.modelo.php';
require_once '../controladores/cierres.controlador.php';
require_once '../modelos/cierres.modelo.php';

class AjaxIngresos
{

	public $codigoIngreso;
	public function ajaxVisualizarIngreso()
	{
		$codigoIngreso = $this->codigoIngreso;
		$respuesta = ControladorIngresos::ctrMostrarIngresos("documento", $codigoIngreso);
		echo json_encode($respuesta);
	}

	public $codigoDIngreso;
	public function ajaxVisualizarDetalleIngreso()
	{
		$codigoDIngreso = $this->codigoDIngreso;
		$respuesta = ControladorIngresos::ctrVisualizarIngresoDetalle($codigoDIngreso);
		echo json_encode($respuesta);
	}

	public $documento;
	public $articulo;
	public $cantidad;
	public function ajaxEliminarIngreso()
	{
		$documento = $this->documento;
		$articulo = $this->articulo;
		$cantidad = $this->cantidad;

		$respuesta = ModeloProduccion::mdlVerIngresos($documento, $articulo);

		if ($respuesta["idcierre"] != "0") {

			$cierre = ModeloCierres::mdlVerDetalleCierres($respuesta["idcierre"]);

			$nuevoSaldo = $cierre["cantidad"] + $respuesta["cantidad"];

			$udpCierre = ModeloIngresos::mdlactualizarCierre($respuesta["idcierre"], $nuevoSaldo);

			$stock = $cantidad * -1;

			$actStock = ModeloIngresos::mdlactualizarStock("externo", $articulo, $stock, $cantidad);

			$eliminar = ModeloIngresos::mdlEliminarMovimiento($documento, $articulo, $cantidad);

			echo json_encode($eliminar);
		} else {

			$stock = $cantidad * -1;

			$actStock = ModeloIngresos::mdlactualizarStock("interno", $articulo, $stock, $cantidad);

			$eliminar = ModeloIngresos::mdlEliminarMovimiento($documento, $articulo, $cantidad);

			echo json_encode($actStock);
		}
	}
}

// OBJETOS


if (isset($_POST["codigoIngreso"])) {

	$verIngreso = new AjaxIngresos();
	$verIngreso->codigoIngreso = $_POST["codigoIngreso"];
	$verIngreso->ajaxVisualizarIngreso();
}

if (isset($_POST["codigoDIngreso"])) {

	$detalleIngreso = new AjaxIngresos();
	$detalleIngreso->codigoDIngreso = $_POST["codigoDIngreso"];
	$detalleIngreso->ajaxVisualizarDetalleIngreso();
}

if (isset($_POST["documento"])) {

	$detalleIngreso = new AjaxIngresos();
	$detalleIngreso->documento = $_POST["documento"];
	$detalleIngreso->articulo = $_POST["articulo"];
	$detalleIngreso->cantidad = $_POST["cantidad"];
	$detalleIngreso->ajaxEliminarIngreso();
}
