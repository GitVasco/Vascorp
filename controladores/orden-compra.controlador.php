<?php


class ControladorOrdenCompra{
    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasOrdenCompra($fechaInicial, $fechaFinal){


		$respuesta = ModeloOrdenCompra::mdlRangoFechasOrdenCompra($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR MATERIA PRIMA PARA ORDEN DE COMPRA
	=============================================*/	

	static public function ctrMostrarMateriasCompras($valor){


		$respuesta = ModeloOrdenCompra::mdlMostrarMateriasCompras($valor);

		return $respuesta;
		
	}

}