<?php

// Requerimos el controlador y el modelo
require_once '../controladores/cortes.controlador.php';
require_once '../modelos/cortes.modelo.php';

class ajaxCortes{

	public function ajaxMostrarCortes(){

		$valor1 = $this->articulo;
		$valor2 = $this->operacion;

		$respuesta = ControladorCortes::ctrMostrarCortes($valor1, $valor2);

        echo json_encode($respuesta);

	}

}

/*
* OBJETOS
*/

if(isset($_POST["articulo"])){

	$mostrar = new ajaxCortes();
	$mostrar -> articulo=$_POST["articulo"];
	$mostrar -> operacion=$_POST["operacion"];
    $mostrar -> ajaxMostrarCortes();

}