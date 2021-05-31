<?php


class ControladorNotasSalidas{
    /*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function ctrRangoFechasNotasSalidas($fechaInicial, $fechaFinal){


		$respuesta = ModeloNotasSalidas::mdlRangoFechasNotasSalidas($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

}