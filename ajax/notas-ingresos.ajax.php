<?php

require_once '../controladores/notas-ingresos.controlador.php';
require_once '../modelos/notas-ingresos.modelo.php';

class AjaxTablaNotaIngresa{

   /* 
    * Traer sublinea
    */
    public function ajaxTraerOc(){

		$valor = $this->empresa;

		$respuesta = ControladorNotasIngresos::ctrOCProv($valor);

		echo json_encode($respuesta);
	}	

}

/* 
* Traer sublinea
*/
if(isset($_POST["empresa"])){

	$editarSubLinea = new AjaxTablaNotaIngresa();
	$editarSubLinea -> empresa = $_POST["empresa"];
	$editarSubLinea -> ajaxTraerOc();

}