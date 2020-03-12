<?php

// Requerimos el controlador y el modelo
require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';

class AjaxArticulos{

	/* 
	* Activar-Desactivar Usuario
	*/
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarArticulo(){

		$valor1=$this->activarEstado;

		$valor2=$this->activarId;

		$respuesta=ModeloArticulos::mdlActualizarArticulo($valor1, $valor2);

		echo $respuesta;
	}
	
	/* 
	* EDITAR ARTICULO
	*/
	public $articulo;

	public function ajaxEditarArticulo(){

		$valor = $this->articulo;

		$respuesta = ControladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);

	}
	
	/* 
	* MOSTRAR ARTICULO PARA ORDEN DE CORTE
	*/
	public $articuloOC;

	public function ajaxMostrarArticuloOC(){

		$valor = $this->articuloOC;

		$respuesta = controladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);

	}

	/* 
	* MOSTRAR ARTICULO PARA ALMACEN DE CORTE
	*/

	public function ajaxMostrarArticuloAC(){

		$valor = $this->articuloAC;

		$respuesta = controladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);

	}	

}

//OBJETOS

if(isset($_POST["activarId"])){
	$activar=new AjaxArticulos();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxActivarDesactivarArticulo();
}


/*=============================================
EDITAR ARTICULO
=============================================*/ 

if(isset($_POST["articulo"])){

	$editarArticulo = new AjaxArticulos();
	$editarArticulo -> articulo = $_POST["articulo"];
	$editarArticulo -> ajaxEditarArticulo();
  
}
  

/* 
* MOSTRAR ARTICULOS PARA ORDEN DE CORTE
*/ 
if( isset($_POST["articuloOC"])){

	$mostrarArticuloOC = new AjaxArticulos();
	$mostrarArticuloOC -> articuloOC = $_POST["articuloOC"];
	$mostrarArticuloOC -> ajaxMostrarArticuloOC();

}


/* 
* MOSTRAR ARTICULOS PARA ALMACEN DE CORTE
*/ 
if( isset($_POST["articuloAC"])){

	$mostrarArticuloAC = new AjaxArticulos();
	$mostrarArticuloAC -> articuloAC = $_POST["articuloAC"];
	$mostrarArticuloAC -> ajaxMostrarArticuloAC();

}