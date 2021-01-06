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


}

/*=============================================
EDITAR CLIENTE
=============================================*/	

if(isset($_POST["codigo"])){

	$cliente = new AjaxClientes();
	$cliente -> codigo = $_POST["codigo"];
	$cliente -> ajaxEditarCliente();

}

if(isset($_POST["documento"])){
	$validarDocumento=new AjaxClientes();
	$validarDocumento->documento=$_POST["documento"];
	$validarDocumento->ajaxValidarDocumento();
}