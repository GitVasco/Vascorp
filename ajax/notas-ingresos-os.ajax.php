<?php

require_once '../controladores/notas-ingresos.controlador.php';
require_once '../modelos/notas-ingresos.modelo.php';

class AjaxTablaNotaIngresaOS{

   /* 
    * Traer sublinea
    */
    public function ajaxTraerMPOS(){

		$ordser = $this->ordser;
		$codori = $this->codori;
		$coddes = $this->coddes;

		$respuesta = ControladorNotasIngresos::ctrTraerMPOS($ordser, $codori, $coddes);

		echo json_encode($respuesta);

	}	

}

/* 
* Traer Materia prima sola o de OC
*/
if(isset($_POST["ordser"])){

	$traerMP = new AjaxTablaNotaIngresaOS();
	$traerMP -> ordser = $_POST["ordser"];
	$traerMP -> codori = $_POST["codori"];
	$traerMP -> coddes = $_POST["coddes"];
	$traerMP -> ajaxTraerMPOS();

}

