<?php

require_once "../controladores/modelos.controlador.php";
require_once "../modelos/modelos.modelo.php";
require_once "../controladores/pedidos.controlador.php";
require_once "../modelos/pedidos.modelo.php";

class AjaxPrecios
{

	/*=============================================
	EDITAR COLOR
	=============================================*/

	public $modelo;
	public function ajaxVerPrecio()
	{
		$item = "modelo";
		$valor = $this->modelo;

		$respuesta = ControladorModelos::ctrMostrarPrecios($item, $valor);

		echo json_encode($respuesta);
	}

	public $pedidoL;
	public $listaL;
	public function ajaxActualizarPrecio()
	{


		$pedido = $this->pedidoL;
		$lista = $this->listaL;

		$detalle = ModeloModelos::mdlActualizarDetallePedido($pedido, $lista);
		$cabecera = ModeloModelos::mdlActualizarCabeceraPedido($pedido, $lista);
		$respuesta = ModeloPedidos::mdlActualizarTotales($pedido);


		echo json_encode($respuesta);
	}
}

/*=============================================
VER PRECIO
=============================================*/

if (isset($_POST["modelo"])) {

	$modelos = new AjaxPrecios();
	$modelos->modelo = $_POST["modelo"];
	$modelos->ajaxVerPrecio();
}


if (isset($_POST["pedidoL"])) {

	$activar = new AjaxPrecios();
	$activar->pedidoL = $_POST["pedidoL"];
	$activar->listaL = $_POST["listaL"];
	$activar->ajaxActualizarPrecio();
}
