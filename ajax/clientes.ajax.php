<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes{

	/*=============================================
	EDITAR CLIENTE
	=============================================*/	

	public $codigo;

	public function ajaxEditarCliente(){

		$item = "codigo";
		$valor = $this->codigo;

		$respuesta = ControladorClientes::ctrMostrarClientes($item, $valor);

		echo json_encode($respuesta);


	}
	/*=============================================
	VALIDAR DOCUMENTO CLIENTE
	=============================================*/	
	public $documento;
	public function ajaxValidarDocumento(){
		$item="documento";
		$valor=$this->documento;
		$respuesta=ControladorClientes::ctrMostrarClientes($item,$valor);
		echo json_encode($respuesta);
	}

	public $clienteCuenta;

	public function ajaxMostrarClienteCuenta(){

		$respuesta = ControladorClientes::ctrMostrarClientesCuentas(null, null);

		echo json_encode($respuesta);


	}

	/*=============================================
	CONSULTAR DNI CLIENTE
	=============================================*/	
	public $nuevoDni;
	public function ajaxConsultarDNI(){

		$valor=$this->nuevoDni;

/* 		$ws = file_get_contents("https://apiperu.dev/api/dni/$valor?api_token=201e8d38c22bfc0524af033a1ec4702e62cb6a74489d9e07bd59e812e6e818e8");
		echo $ws; */

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://apiperu.dev/api/dni/$valor?api_token=201e8d38c22bfc0524af033a1ec4702e62cb6a74489d9e07bd59e812e6e818e8",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_SSL_VERIFYPEER => false
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}		

	}


}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["codigo"])){

	$cliente = new AjaxClientes();
	$cliente -> codigo = $_POST["codigo"];
	$cliente -> ajaxEditarCliente();

}

/*=============================================
VALIDAR DOCUMENTO EXISTENTE
=============================================*/	
if(isset($_POST["documento"])){
	$validarDocumento=new AjaxClientes();
	$validarDocumento->documento=$_POST["documento"];
	$validarDocumento->ajaxValidarDocumento();
}

/*=============================================
CARGAR CLIENTES CON BOTON 
=============================================*/	
if(isset($_POST["clienteCuenta"])){
	$clienteCuenta=new AjaxClientes();
	$clienteCuenta->clienteCuenta=$_POST["clienteCuenta"];
	$clienteCuenta->ajaxMostrarClienteCuenta();
}

/*=============================================
CONSULTAR DNI CLIENTE
=============================================*/	

if(isset($_POST["nuevoDni"])){

	$consultarDni = new AjaxClientes();
	$consultarDni -> nuevoDni = $_POST["nuevoDni"];
	$consultarDni -> ajaxConsultarDNI();

}