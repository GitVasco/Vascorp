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
    $comprobante = $this->comprobante;
    $contribuyente = $this->contribuyente;
    $domicilio = $this->domicilio;

    $datos = array( "ruc"           =>  $ruc,
                    "serie_doc"     =>  $serie,
                    "num_doc"       =>  $correlativo,
                    "comprobante"   =>  $comprobante,
                    "contribuyente" =>  $contribuyente,
                    "condicion"     =>  $domicilio,
                    "estado"        =>  '1');
    #var_dump($datos);

    $respuesta = ModeloCompras::mdlActualizarRegCompras($datos);
    $respuesta2 = ModeloCompras::mdlActualizarDiario($datos);

    echo $respuesta;

  }

  public function ajaxTraerCompra(){

    $ruc    = $this->ruc;
    $serie  = $this->serie;
    $numero = $this->numero;

    $respuesta = ControladorCompras::ctrTraerCompra($ruc, $serie, $numero);

    echo json_encode($respuesta);

  }  

}


/*=============================================
    VALIDAR ESTADO DE COMPRA
=============================================*/	
if(isset($_POST["comprobante"])){

	$aprobarCompra = new AjaxCompras();
	$aprobarCompra -> ruc = $_POST["ruc"];
  $aprobarCompra -> serie = $_POST["serie"];
  $aprobarCompra -> correlativo = $_POST["correlativo"];
  $aprobarCompra -> comprobante = $_POST["comprobante"];
  $aprobarCompra -> contribuyente = $_POST["contribuyente"];
  $aprobarCompra -> domicilio = $_POST["domicilio"];
	$aprobarCompra -> ajaxValidarCompra();
}

if(isset($_POST["rucS"])){

	  $traerCompra = new AjaxCompras();
	  $traerCompra -> ruc = $_POST["rucS"];
    $traerCompra -> serie = $_POST["serie"];
    $traerCompra -> numero = $_POST["numero"];
    $traerCompra -> ajaxTraerCompra();

}