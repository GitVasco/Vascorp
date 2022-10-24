<?php

require_once "../controladores/proveedor.controlador.php";
require_once "../modelos/proveedor.modelo.php";

class AjaxProveedores{

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/	

	public $CodRuc;

	public function ajaxEditarProveedor(){

		$item = "CodRuc";
		$valor = $this->CodRuc;

		$respuesta = ControladorProveedores::ctrMostrarProveedores($item, $valor);

		echo json_encode($respuesta);


	}
    
	/*=============================================
	VALIDAR RUC PROVEEDOR
	=============================================*/	
	public $RucPro;
	public function ajaxValidarRuc(){

		$item="RucPro";
		$valor=$this->RucPro;
		$respuesta=ControladorProveedores::ctrMostrarProveedores($item,$valor);

		echo json_encode($respuesta);

	}

	/*=============================================
	CONSULTAR RUC PROVEEDOR O CLIENTE
	=============================================*/	
	public $nuevoRuc;
	public function ajaxConsultarRUC(){

		$valor=$this->nuevoRuc;

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://apiperu.dev/api/ruc/$valor?api_token=201e8d38c22bfc0524af033a1ec4702e62cb6a74489d9e07bd59e812e6e818e8",
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
EDITAR PROVEEDOR
=============================================*/	

if(isset($_POST["CodRuc"])){

	$cliente = new AjaxProveedores();
	$cliente -> CodRuc = $_POST["CodRuc"];
	$cliente -> ajaxEditarProveedor();

}

/*=============================================
VALIDAR RUC PROVEEDOR
=============================================*/	
if(isset($_POST["RucPro"])){
	$validarDocumento=new AjaxProveedores();
	$validarDocumento->RucPro=$_POST["RucPro"];
	$validarDocumento->ajaxValidarRuc();
}


/*=============================================
CONSULTAR RUC PROVEEDOR O CLIENTE
=============================================*/	

if(isset($_POST["nuevoRuc"])){

	$consultarRuc = new AjaxProveedores();
	$consultarRuc -> nuevoRuc = $_POST["nuevoRuc"];
	$consultarRuc -> ajaxConsultarRUC();

}