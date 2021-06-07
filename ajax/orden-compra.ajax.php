<?php

require_once "../controladores/orden-compra.controlador.php";
require_once "../modelos/orden-compra.modelo.php";

class AjaxOrdenCompra{

	

	/*=============================================
	CONSULTAR API TIPO DE CAMBIO
	=============================================*/	
	public function ajaxConsultarTipoCambio(){


		$ws = file_get_contents("https://dni.optimizeperu.com/api/tipo-cambio");


		echo $ws;

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