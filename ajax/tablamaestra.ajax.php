<?php

require_once '../controladores/maestras.controlador.php';
require_once '../modelos/maestras.modelo.php';

class AjaxTablaMaestra{

    /* 
    * Traer correlativo
    */
    public function ajaxTraerCorrelativo(){

		$valor = $this->subLinea;

		$respuesta = ControladorMaestras::ctrMostrarCorrelativo($valor);

		echo json_encode($respuesta);
	}	

    /* 
    * Traer correlativo de la sublinea
    */
    public function ajaxTraerCorrelativoSubLinea(){

		$valor = $this->des_corta;

		$respuesta = ControladorMaestras::ctrMostrarCorrelativoSubLinea($valor);

		echo json_encode($respuesta);
	}
	
    /* 
    * Traer sublinea
    */
    public function ajaxTraerSubLinea(){

		$valor = $this->codigo;
		$valor1 = $this->argumento;

		$respuesta = ControladorMaestras::ctrMostrarSubLineaEditar($valor,$valor1);

		echo json_encode($respuesta);
	}	

}

/* 
* Traer correlativo
*/
if(isset($_POST["subLinea"])){

	$traerCorrelativo = new AjaxTablaMaestra();
	$traerCorrelativo -> subLinea = $_POST["subLinea"];
	$traerCorrelativo -> ajaxTraerCorrelativo();

}

/* 
* Traer correlativo de la sublinea
*/
if(isset($_POST["des_corta"])){

	$traerCorrelativoSub = new AjaxTablaMaestra();
	$traerCorrelativoSub -> des_corta = $_POST["des_corta"];
	$traerCorrelativoSub -> ajaxTraerCorrelativoSubLinea();

}

/* 
* Traer sublinea
*/
if(isset($_POST["argumento"])){

	$editarSubLinea = new AjaxTablaMaestra();
	$editarSubLinea -> argumento = $_POST["argumento"];
	$editarSubLinea -> codigo = $_POST["codigo"];
	$editarSubLinea -> ajaxTraerSubLinea();

}