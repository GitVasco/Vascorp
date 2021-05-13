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
