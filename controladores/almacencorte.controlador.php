<?php
class ControladorAlmacenCorte{

    /* 
    * SACAR EL ULTIMO CODIGO
    */
    static public function ctrUltimoCodigoAC(){

        $respuesta = ModeloAlmacenCorte::mdlUltimoCodigoAC();

        return $respuesta;

    }

	/* 
	* MOSTRAR ARTICULOS EN ORDENES DE CORTE PARA EL ALMACEN CORTE
	*/	
	static public function ctrMostarArticulosOrdCorte(){

		$respuesta = ModeloAlmacenCorte::mdlMostarArticulosOrdCorte();

		return $respuesta;
		
	}    



}