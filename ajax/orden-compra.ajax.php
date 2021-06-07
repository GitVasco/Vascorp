<?php

require_once "../controladores/orden-compra.controlador.php";
require_once "../modelos/orden-compra.modelo.php";
require_once "../controladores/maestras.controlador.php";
require_once "../modelos/maestras.modelo.php";

class AjaxOrdenCompra{

	

	/*=============================================
	CONSULTAR API TIPO DE CAMBIO
	=============================================*/	
	public function ajaxConsultarTipoCambio(){


		$ws = file_get_contents("https://dni.optimizeperu.com/api/tipo-cambio");


		echo $ws;

	}

	public function ajaxSelectColores(){
		$valor="TCOL";

		$respuesta = ControladorMaestras::ctrMostrarMaestrasDetalle($valor);
		
		echo json_encode($respuesta);
	}


}

/*=============================================
CONSULTAR RUC PROVEEDOR O CLIENTE
=============================================*/	

if(isset($_POST["ApiCambio"])){

	$consultarTipoCambio = new AjaxOrdenCompra();
	$consultarTipoCambio -> ApiCambio = $_POST["ApiCambio"];
	$consultarTipoCambio -> ajaxConsultarTipoCambio();

}

/*=============================================
CONSULTAR RUC PROVEEDOR O CLIENTE
=============================================*/	

if(isset($_POST["ColorCompra"])){

	$consultarTipoCambio = new AjaxOrdenCompra();
	$consultarTipoCambio -> ajaxSelectColores();

}