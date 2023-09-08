<?php

// Requerimos el controlador y el modelo
require_once '../controladores/cortes.controlador.php';
require_once '../modelos/cortes.modelo.php';

class ajaxCortes
{
	public $articulo;
	public function ajaxMostrarCortes()
	{

		$valor1 = $this->articulo;

		$respuesta = ControladorCortes::ctrMostrarCortes($valor1);

		echo json_encode($respuesta);
	}

	public $modeloSublimado;
	public $colorSublimado;
	public function ajaxMostrarCorteSublimado()
	{

		$valor1 = $this->modeloSublimado;
		$valor2 = $this->colorSublimado;

		$respuesta = ControladorCortes::ctrMostrarCorteSublimado($valor1, $valor2);

		echo json_encode($respuesta);
	}


	public $corte;
	public function ajaxMostrarCortesArticulos()
	{

		$corte = $this->corte;

		$respuesta = ModeloCortes::ctrMostrarCortesArticulos($corte, null);

		echo json_encode($respuesta);
	}

	public $id_articulo;
	public function ajaxMostrarCortesArticuloCantidad()
	{

		$id_articulo = $this->id_articulo;

		$respuesta = ModeloCortes::ctrMostrarCortesArticulos(null, $id_articulo);

		echo json_encode($respuesta);
	}

	public $estampado;
	public function ajaxMostrarEstampado()
	{

		$estampado = $this->estampado;

		$respuesta = ModeloCortes::mdlMostrarEstampados($estampado);

		echo json_encode($respuesta);
	}

	public $upd_id;
	public $upd_corte;
	public $upd_articulo;
	public $upd_id_articulo;
	public $upd_cantidadOrigen;
	public $upd_cantidadEstampado;
	public $upd_cantidadMerma;
	public $upd_cantidadSaldo;
	public $upd_fecha;
	public $upd_operario;
	public $upd_cerrar;
	public $upd_inicioPreparacion;
	public $upd_finPreparacion;
	public $upd_inicioProduccion;
	public $upd_finProduccion;

	public function ajaxActualizarEstampado()
	{

		$id = $this->upd_id;
		$corte = $this->upd_corte;
		$articulo = $this->upd_articulo;
		$id_articulo = $this->upd_id_articulo;
		$cantidadOrigen = $this->upd_cantidadOrigen;
		$cantidadEstampado = $this->upd_cantidadEstampado;
		$cantidadMerma = $this->upd_cantidadMerma;
		$cantidadSaldo = $this->upd_cantidadSaldo;
		$fecha = $this->upd_fecha;
		$operario = $this->upd_operario;
		$cerrar = $this->upd_cerrar;
		$inicioPreparacion = $this->upd_inicioPreparacion;
		$finPreparacion = $this->upd_finPreparacion;
		$inicioProduccion = $this->upd_inicioProduccion;
		$finProduccion = $this->upd_finProduccion;

		$respuesta = ModeloCortes::mdlActualizarEstampado($id, $corte, $articulo, $id_articulo, $cantidadOrigen, $cantidadEstampado, $cantidadMerma, $cantidadSaldo, $fecha, $operario, $cerrar, $inicioPreparacion, $finPreparacion, $inicioProduccion, $finProduccion);

		if ($cerrar == "SI" || $cantidadSaldo == 0) {
			$estampado = 1;
		} else {
			$estampado = 0;
		}

		$datos = array(
			"id"        => $id_articulo,
			"estampado" => $estampado,
			"saldo"     => $cantidadSaldo
		);

		$rptEstampado = ModeloCortes::mdlActualizarAlmacenCorte($datos);

		echo json_encode($rptEstampado);
	}

	public $eliminarEstampado;
	public function ajaxEliminarEstampado()
	{

		$id = $this->eliminarEstampado;

		$estampado = ModeloCortes::mdlMostrarEstampados($id);

		$respuesta = ModeloCortes::mdlEliminarEstampado($id);


		if ($respuesta == "ok") {
			$datos = array(
				"id"        => $estampado["almacencorte"],
				"estampado" => 0,
				"saldo"     => 0
			);
			$respuesta = ModeloCortes::mdlActualizarAlmacenCorte($datos);
		}

		echo json_encode($respuesta);
	}
}

/*
* OBJETOS
*/

if (isset($_POST["articulo"])) {

	$mostrar = new ajaxCortes();
	$mostrar->articulo = $_POST["articulo"];
	$mostrar->ajaxMostrarCortes();
}

if (isset($_POST["modeloSublimado"])) {

	$mostrarSublimado = new ajaxCortes();
	$mostrarSublimado->modeloSublimado = $_POST["modeloSublimado"];
	$mostrarSublimado->colorSublimado = $_POST["colorSublimado"];
	$mostrarSublimado->ajaxMostrarCorteSublimado();
}

//* recibimos el codigo del corte
if (isset($_POST["corte"])) {

	$mostrar = new ajaxCortes();
	$mostrar->corte = $_POST["corte"];
	$mostrar->ajaxMostrarCortesArticulos();
}

//* recibimos el codigo del corte
if (isset($_POST["id_articulo"])) {

	$mostrar = new ajaxCortes();
	$mostrar->id_articulo = $_POST["id_articulo"];
	$mostrar->ajaxMostrarCortesArticuloCantidad();
}

//* recibimos el codigo del corte
if (isset($_POST["estampado"])) {

	$mostrar = new ajaxCortes();
	$mostrar->estampado = $_POST["estampado"];
	$mostrar->ajaxMostrarEstampado();
}

if (isset($_POST["upd_id"])) {
	$activar = new ajaxCortes();
	$activar->upd_id = $_POST["upd_id"];
	$activar->upd_corte = $_POST["upd_corte"];
	$activar->upd_articulo = $_POST["upd_articulo"];
	$activar->upd_id_articulo = $_POST["upd_id_articulo"];
	$activar->upd_cantidadOrigen = $_POST["upd_cantidadOrigen"];
	$activar->upd_cantidadEstampado = $_POST["upd_cantidadEstampado"];
	$activar->upd_cantidadMerma = $_POST["upd_cantidadMerma"];
	$activar->upd_cantidadSaldo = $_POST["upd_cantidadSaldo"];
	$activar->upd_fecha = $_POST["upd_fecha"];
	$activar->upd_operario = $_POST["upd_operario"];
	$activar->upd_cerrar = $_POST["upd_cerrar"];
	$activar->upd_inicioPreparacion = $_POST["upd_inicioPreparacion"];
	$activar->upd_finPreparacion = $_POST["upd_finPreparacion"];
	$activar->upd_inicioProduccion = $_POST["upd_inicioProduccion"];
	$activar->upd_finProduccion = $_POST["upd_finProduccion"];

	$activar->ajaxActualizarEstampado();
}

if (isset($_POST["eliminarEstampado"])) {
	$activar = new ajaxCortes();
	$activar->eliminarEstampado = $_POST["eliminarEstampado"];
	$activar->ajaxEliminarEstampado();
}
