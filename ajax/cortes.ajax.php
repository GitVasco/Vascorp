<?php

// Requerimos el controlador y el modelo
require_once '../controladores/cortes.controlador.php';
require_once '../modelos/cortes.modelo.php';

class ajaxCortes{

	public function ajaxMostrarCortes(){

		$valor1 = $this->articulo;

		$respuesta = ControladorCortes::ctrMostrarCortes($valor1);

        echo json_encode($respuesta);

	}

	public $modeloSublimado;
	public $colorSublimado;
	public function ajaxMostrarCorteSublimado(){

		$valor1 = $this->modeloSublimado;
		$valor2 = $this->colorSublimado;

		$respuesta = ControladorCortes::ctrMostrarCorteSublimado($valor1,$valor2);

        echo json_encode($respuesta);

	}

}

/*
* OBJETOS
*/

if(isset($_POST["articulo"])){

	$mostrar = new ajaxCortes();
	$mostrar -> articulo = $_POST["articulo"];
    $mostrar -> ajaxMostrarCortes();

}

if(isset($_POST["modeloSublimado"])){

	$mostrarSublimado = new ajaxCortes();
	$mostrarSublimado -> modeloSublimado = $_POST["modeloSublimado"];
	$mostrarSublimado -> colorSublimado = $_POST["colorSublimado"];
    $mostrarSublimado -> ajaxMostrarCorteSublimado();

}