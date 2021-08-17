<?php

require_once "../controladores/compras.controlador.php";
require_once "../modelos/compras.modelo.php";

class AjaxCompras{
 /*=============================================
    VALIDAR ESTADO DE COMPRA
 =============================================*/ 

  public function ajaxValidarCompra(){
    
    $ruc = $this->ruc;
    $serie = $this->serie;
    $correlativo = $this->correlativo;
    $estado = $this->estado;

    $datos = array( "ruc"           =>  $ruc,
                    "serie_doc"     =>  $serie,
                    "num_doc"       =>  $correlativo,
                    "comprobante"   =>  $estado,
                    "contribuyente" =>  $estado,
                    "condicion"     =>  $estado,
                    "estado"        =>  '1');
    #var_dump($datos);

    $respuesta = ModeloCompras::mdlActualizarRegCompras($datos);
    $respuesta2 = ModeloCompras::mdlActualizarDiario($datos);

    echo $respuesta;

  }

}


/*=============================================
    VALIDAR ESTADO DE COMPRA
=============================================*/	
if(isset($_POST["estado"])){

	$aprobarCompra = new AjaxCompras();
	$aprobarCompra -> ruc = $_POST["ruc"];
    $aprobarCompra -> serie = $_POST["serie"];
    $aprobarCompra -> correlativo = $_POST["correlativo"];
    $aprobarCompra -> estado = $_POST["estado"];
	$aprobarCompra -> ajaxValidarCompra();
}
