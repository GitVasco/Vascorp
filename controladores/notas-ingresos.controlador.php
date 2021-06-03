<?php


class ControladorNotasIngresos{

    /*=============================================
	MOSTRAR NOTAS DE INGRESO
	=============================================*/	

	static public function ctrRangoFechasNotasIngresos($fechaInicial, $fechaFinal){

		$respuesta = ModeloNotasIngresos::mdlRangoFechasNotasIngresos($fechaInicial, $fechaFinal);

		return $respuesta;
		
	}

	/* 
	*MOSTRAR MP PARA NOTA DE INGRESO CON O SIN OC
	*/
	static public function ctrMostrarMPOC($empresa, $oc){

		$respuesta = ModeloNotasIngresos::mdlMostrarMPOC($empresa, $oc);

		return $respuesta;
		
	}

	/* 
	* TIPOS DE DOC PARA NI
	*/
	static public function ctrDocNI(){

		$respuesta = ModeloNotasIngresos::mdlDocNI();

		return $respuesta;
		
	}	

	/* 
	* OC por Proveedor
	*/
	static public function ctrOCProv($empresa){

		$respuesta = ModeloNotasIngresos::mdlOCProv($empresa);

		return $respuesta;
		
	}
	

	/* 
	* MP EN OC O SUELTA
	*/
	static public function ctrTraerMpOC($codpro, $orden, $codruc){

		$respuesta = ModeloNotasIngresos::mdlTraerMpOC($codpro, $orden, $codruc);

		return $respuesta;
		
	}	

}