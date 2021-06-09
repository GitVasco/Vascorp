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
	
   /* 
    * Traer cabecera nota ingreso
    */
    public function ajaxTraerNiCab(){

		$valor = $this->idNotaIngreso;

		$respuesta = ControladorNotasIngresos::ctrTraerNiCab($valor);

		echo json_encode($respuesta);
	}

   /* 
    * Traer detalle nota ingreso
    */
    public function ajaxTraerNiDet(){

		$valor = $this->idNotaIngresoDet;

		$respuesta = ControladorNotasIngresos::ctrTraerNiDet($valor);

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

/* 
* Traer cabecera nota ingreso
*/
if(isset($_POST["idNotaIngreso"])){

	$editarSubLinea = new AjaxTablaNotaIngresa();
	$editarSubLinea -> idNotaIngreso = $_POST["idNotaIngreso"];
	$editarSubLinea -> ajaxTraerNiCab();

}

/* 
* Traer detalle nota ingreso
*/
if(isset($_POST["idNotaIngresoDet"])){

	$editarSubLinea = new AjaxTablaNotaIngresa();
	$editarSubLinea -> idNotaIngresoDet = $_POST["idNotaIngresoDet"];
	$editarSubLinea -> ajaxTraerNiDet();

}