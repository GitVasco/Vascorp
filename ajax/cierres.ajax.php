<?php
session_start();
require_once '../controladores/cierres.controlador.php';
require_once '../modelos/cierres.modelo.php';


require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';


class AjaxCierres{
	# Método para eliminar la info de Ventas
	public $idCierre;
	public function ajaxEliminarCierre(){

        $idCierre=$this->idCierre;
        
		$respuesta=ControladorCierres::ctrEliminarCierre($idCierre);
        echo $respuesta;
        
	}
	public $cierre;
	public function ajaxUltimoCierre(){
        $cierre=$this->cierre;
		$respuesta=ControladorCierres::ctrMostrarUltimoCierre();
        echo json_encode($respuesta);
        
	}
	public $codigoCierre;
	public function ajaxVisualizarCierre(){
        $codigoCierre=$this->codigoCierre;
		$respuesta=ControladorCierres::ctrMostrarCierres("codigo",$codigoCierre);
        echo json_encode($respuesta);
        
	}

	public $codigoDCierre;
	public function ajaxVisualizarDetalleCierre(){
        $codigoDCierre=$this->codigoDCierre;
		$respuesta=ControladorCierres::ctrVisualizarCierrreDetalle($codigoDCierre);
        echo json_encode($respuesta);
        
	}

	public function ajaxCerrarServicio(){


        $articulo=$this->articulo;
		$saldo=$this->saldo;
		$id=$this->id;

		//*1ERO CERRAR EL SERVICIO

		$respuestaC=ModeloCierres::mdlCerrarServicio($id);

		//*2DO BAJAR EN SERVICIOS DEL ARTICULO

		$respuestaS=ModeloArticulos::mdlBajarServicio($articulo, $saldo);

        echo json_encode($respuestaS);
        
	}


	//PAGAR ESTADO DE PAGO
	public $activarGuia;
	public $activarPago;

	public function ajaxPagarCierre(){

		$valor1=$this->activarPago;
		
		$valor2=$this->activarGuia;

		//ENVIAR CORREO Y GUARDAR EN AUDITORIA
		// date_default_timezone_set('America/Lima');
		// $fecha = new DateTime();
		// $cierre=ControladorCierres::ctrMostrarCierres("guia",$valor2);
		// $usuario= $_SESSION["nombre"];	
		// $para      = 'notificacionesvascorp@gmail.com';
		// $asunto    = 'Se pago un cierre';
		// $descripcion   = 'El usuario '.$usuario.' pago el cierre '.$cierre["codigo"];
		// $de = 'From: notificacionesvascorp@gmail.com';
		// if($_SESSION["correo"] == 1){
		// 	mail($para, $asunto, $descripcion, $de);
		// 	}
		// if($_SESSION["datos"] == 1){
		// 	$datos2= array( "usuario" => $usuario,
		// 			"concepto" => $descripcion,
		// 			"fecha" => $fecha->format("Y-m-d H:i:s"));
		// 	$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
		// }	

		
		$respuesta=ModeloCierres::mdlPagarCierre($valor1, $valor2);

		echo $respuesta;
	}

	public $inicioServicio;
	public $finServicio;
	public $estadoPagoServicio;

	public function ajaxPagarCierreServicio(){

		$valor1=$this->estadoPagoServicio;
		
		$valor2=$this->inicioServicio;

		$valor3=$this->finServicio;

		//ENVIAR CORREO Y GUARDAR EN AUDITORIA
		// date_default_timezone_set('America/Lima');
		// $fecha = new DateTime();
		// $cierre=ControladorCierres::ctrMostrarCierres("guia",$valor2);
		// $usuario= $_SESSION["nombre"];	
		// $para      = 'notificacionesvascorp@gmail.com';
		// $asunto    = 'Se pago un cierre';
		// $descripcion   = 'El usuario '.$usuario.' pago el cierre '.$cierre["codigo"];
		// $de = 'From: notificacionesvascorp@gmail.com';
		// if($_SESSION["correo"] == 1){
		// 	mail($para, $asunto, $descripcion, $de);
		// 	}
		// if($_SESSION["datos"] == 1){
		// 	$datos2= array( "usuario" => $usuario,
		// 			"concepto" => $descripcion,
		// 			"fecha" => $fecha->format("Y-m-d H:i:s"));
		// 	$auditoria=ModeloUsuarios::mdlIngresarAuditoria("auditoriajf",$datos2);
		// }	

		
		$respuesta=ModeloCierres::mdlPagarCierreServicio($valor1,$valor2,$valor3);

		echo $respuesta;
	}
}

// OBJETOS
if(isset($_POST["idCierre"])){

	$eliminarCierre=new AjaxCierres();
	$eliminarCierre->idCierre=$_POST["idCierre"];
    $eliminarCierre->ajaxEliminarCierre();
    
}

if(isset($_POST["cierre"])){

	$ultimoCierre = new AjaxCierres();
	$ultimoCierre -> cierre =$_POST["cierre"];
    $ultimoCierre -> ajaxUltimoCierre();
    
}

if(isset($_POST["codigoCierre"])){

	$verCierre=new AjaxCierres();
	$verCierre->codigoCierre=$_POST["codigoCierre"];
    $verCierre->ajaxVisualizarCierre();
    
}

if(isset($_POST["codigoDCierre"])){

	$detalleCierre=new AjaxCierres();
	$detalleCierre->codigoDCierre=$_POST["codigoDCierre"];
    $detalleCierre->ajaxVisualizarDetalleCierre();
    
}

if(isset($_POST["activarGuia"])){
	$activar=new AjaxCierres();
	$activar->activarGuia=$_POST["activarGuia"];
	$activar->activarPago=$_POST["activarPago"];
	$activar->ajaxPagarCierre();
}

if(isset($_POST["estadoPagoServicio"])){
	$activarPagoServicio=new AjaxCierres();
	$activarPagoServicio->inicioServicio=$_POST["inicio"];
	$activarPagoServicio->finServicio=$_POST["fin"];
	$activarPagoServicio->estadoPagoServicio=$_POST["estadoPagoServicio"];
	$activarPagoServicio->ajaxPagarCierreServicio();
}


if(isset($_POST["saldo"])){
	$cerrarServicio=new AjaxCierres();
	$cerrarServicio->articulo		=$_POST["articuloSer"];
	$cerrarServicio->saldo			=$_POST["saldo"];
	$cerrarServicio->id			=$_POST["id"];
	$cerrarServicio->ajaxCerrarServicio();
}
