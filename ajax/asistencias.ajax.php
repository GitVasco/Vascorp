<?php

require_once "../controladores/asistencia.controlador.php";
require_once "../modelos/asistencia.modelo.php";

class AjaxAsistencias{

	/*=============================================
	EDITAR ASISTENCIA
	=============================================*/	

	public $idAsistencia;

	public function ajaxEditarAsistencia(){

		$item = "id";
		$valor = $this->idAsistencia;

		$respuesta = ControladorAsistencias::ctrMostrarAsistencias($item, $valor);

		echo json_encode($respuesta);

	}

	//ACTIVAR ASISTENCIA
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarAsistencia(){

		$tabla="asistenciasjf";
		$valor1=$this->activarEstado;
		$valor2=$this->activarId;
		$valor3=$this->fechaAsistencia;

		//VALIDAMOS SI ES SABADO O DIA DE SEMANA PARA RESTABLECER LOS MINUTOS UN DIA SABADO
		$validar_fecha=date("l",strtotime($valor3));	

		if($validar_fecha == "Saturday"){
			$minutos = 255;
		}else{
			$minutos = 525;
		}
		if($valor1 == "FALTA"){
			$respuesta=ModeloAsistencias::mdlActualizarFalta($tabla,$valor1, $valor2);
			$eliminar=ModeloAsistencias::mdlEliminarAsistenciaPara($valor2);
		}else{
			$respuesta=ModeloAsistencias::mdlActualizarAsistencia($tabla,$valor1, $valor2,$minutos);
		}
		

		echo $respuesta;
	}
}

/*=============================================
EDITAR CATEGORÍA
=============================================*/	
if(isset($_POST["idAsistencia"])){

	$asistencia = new AjaxAsistencias();
	$asistencia -> idAsistencia = $_POST["idAsistencia"];
	$asistencia -> ajaxEditarAsistencia();
}
/*=============================================
ACTIVAR ASISTENCIA
=============================================*/ 

if(isset($_POST["activarId"])){
	$activar=new AjaxAsistencias();
	$activar->activarId=$_POST["activarId"];
	$activar->activarEstado=$_POST["activarEstado"];
	$activar->fechaAsistencia=$_POST["fechaAsistencia"];
	$activar->ajaxActivarDesactivarAsistencia();
}
