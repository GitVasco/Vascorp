<?php
session_start();
require_once "../controladores/notas-salidas.controlador.php";
require_once "../modelos/notas-salidas.modelo.php";

class AjaxNotasSalidas{

  /*=============================================
  SELECT DESTINOS
  =============================================*/ 
  public function ajaxSelectDestino(){

    $respuesta = ControladorNotasSalidas::ctrMostrarDestinoNota();

    echo json_encode($respuesta);

  }

  /*=============================================
  VISUALIZAR NOTA SALIDA CABECERA
  =============================================*/ 
  public function ajaxVisualizarCabecera(){
    $item="Nro";
		$valor = $this->idNotaSalida;
    $respuesta = ControladorNotasSalidas::ctrMostrarNotaSalida($item,$valor);

    echo json_encode($respuesta);

  }

  /*=============================================
  VISUALIZAR NOTA SALIDA DETALLE
  =============================================*/ 
  public function ajaxVisualizarDetalle(){
    $item="Nro";
		$valor = $this->idNotaSalidaDetalle;
    $respuesta = ControladorNotasSalidas::ctrMostrarDetalleNotaSalida($item,$valor);

    echo json_encode($respuesta);

  }


  /*=============================================
  VISUALIZAR NOTA SALIDA DETALLE CON 2 PARAMETROS
  =============================================*/ 
  public function ajaxVisualizarDetalle2(){
    $item="Nro";
		$valor = $this->notaSalida;
    $item2="CodPro";
		$valor2 = $this->codPro;
    $respuesta = ControladorNotasSalidas::ctrMostrarDetalleNotaSalida2($item,$valor,$item2,$valor2);

    echo json_encode($respuesta);

  }


  /* 
	* Activar-Desactivar Articulo
	*/
	public $activarId;
	public $activarEstado;

	public function ajaxAprobarNotaSalida(){

		$valor1=$this->activarEstado;
		date_default_timezone_set('America/Lima');
		$fecha = new DateTime();
		$valor2=$this->activarId;
		$usuario= $_SESSION["nombre"];
    $PcMod= gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $datos = array ("EstNota" => $valor1,
                    "Nro" => $valor2,
                    "UsuMod" => $usuario,
                    "PcMod" => $PcMod,
                    "FecMod" => $fecha->format("Y-m-d H:i:s"));
		$respuesta=ModeloNotasSalidas::mdlAprobarNotaSalida($datos);

		echo $respuesta;
	}

}


/*=============================================
SELECT DESTINOS
=============================================*/	
if(isset($_POST["idMateriaNota"])){

	$destino = new AjaxNotasSalidas();
	$destino -> idMateriaNota = $_POST["idMateriaNota"];
	$destino -> ajaxSelectDestino();
}

/*=============================================
VISUALIZAR NOTA SALIDA CABECERA
=============================================*/	
if(isset($_POST["idNotaSalida"])){

	$cabecera = new AjaxNotasSalidas();
	$cabecera -> idNotaSalida = $_POST["idNotaSalida"];
	$cabecera -> ajaxVisualizarCabecera();
}

/*=============================================
VISUALIZAR NOTA SALIDA DETALLE
=============================================*/	
if(isset($_POST["idNotaSalidaDetalle"])){

	$detalle = new AjaxNotasSalidas();
	$detalle -> idNotaSalidaDetalle = $_POST["idNotaSalidaDetalle"];
	$detalle -> ajaxVisualizarDetalle();
}


/*=============================================
VISUALIZAR NOTA SALIDA DETALLE
=============================================*/	
if(isset($_POST["codPro"])){

	$detalle2 = new AjaxNotasSalidas();
	$detalle2 -> codPro = $_POST["codPro"];
  $detalle2 -> notaSalida = $_POST["notaSalida"];
	$detalle2 -> ajaxVisualizarDetalle2();
}

/*=============================================
ACTIVAR Y DESACTIVAR ARTICULO
=============================================*/ 
if(isset($_POST["activarId"])){
	$activar=new AjaxNotasSalidas();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->ajaxAprobarNotaSalida();
}
