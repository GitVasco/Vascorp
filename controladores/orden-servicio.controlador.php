<?php


class ControladorOrdenServicio{
    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasOrdenServicio($fechaInicial, $fechaFinal){


		$respuesta = ModeloOrdenServicio::mdlRangoFechasOrdenServicio($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR ORDEN DE SERVICIO
	=============================================*/	

	static public function ctrMostrarOrdenServicio($item,$valor){


		$respuesta = ModeloOrdenServicio::mdlMostrarOrdenServicio($item,$valor);

		return $respuesta;
		
	}

	/*=============================================
	MOSTRAR DETALLES ORDEN DE SERVICIO
	=============================================*/	

	static public function ctrMostrarDetallesOrdenServicio($item,$valor){


		$respuesta = ModeloOrdenServicio::mdlMostrarDetallesOrdenServicio($item,$valor);

		return $respuesta;
		
	}
}