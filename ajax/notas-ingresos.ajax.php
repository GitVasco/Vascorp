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

   	/* 
    * TTraer Materia prima sola o de OC
    */
    public function ajaxTraerMpOc(){

		$codpro = $this->codpro;
		$orden = $this->orden;
		$codruc = $this->codruc;

		$respuesta = ControladorNotasIngresos::ctrTraerMpOC($codpro, $orden, $codruc);

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

/* 
* Traer Materia prima sola o de OC
*/
if(isset($_POST["codpro"])){

	$traerMP = new AjaxTablaNotaIngresa();
	$traerMP -> codpro = $_POST["codpro"];
	$traerMP -> orden = $_POST["orden"];
	$traerMP -> codruc = $_POST["codruc"];
	$traerMP -> ajaxTraerMpOc();

}