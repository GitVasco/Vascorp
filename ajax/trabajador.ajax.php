<?php
session_start();
require_once "../controladores/trabajador.controlador.php";
require_once "../modelos/trabajador.modelo.php";
require_once "../modelos/talleres.modelo.php";

// require_once "../controladores/tipodocumento.controlador.php";
// require_once "../modelos/tipodocumento.modelo.php";

class AjaxTrabajador{

  // GENERAR EL CODIGO

  public $idTrabajador;

  /*=============================================
  EDITAR TRABAJADOR
  =============================================*/ 
 
  public function ajaxEditarTrabajador(){
      
    $item="cod_tra";
    $valor = $this->idTrabajador;

    $respuesta = ControladorTrabajador::ctrMostrarTrabajador($item,$valor);

    echo json_encode($respuesta);

  }
  
  //ACTIVAR TRABAJADOR
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarTrabajador(){

		$tabla="trabajadorjf";
		$valor1=$this->activarEstadoTrabajador;
		$valor2=$this->activarTrabajador;

		$respuesta=ModeloTrabajador::mdlActualizarTrabajador($tabla,$valor1,$valor2);

		echo $respuesta;
	}


	public function ajaxActivarDesactivarTrabajador2(){

		$tabla="trabajadores_graljf";
		$valor1=$this->activarEstadoTrabajador2;
		$valor2=$this->activarTrabajador2;

		$respuesta=ModeloTrabajador::mdlActualizarTrabajador2($tabla,$valor1,$valor2);

		echo $respuesta;
	}

	public function ajaxAsignarTrabajador(){

		$trabajador=$this->asignarTrab;

		$usuario = $_SESSION["id"];

		//traemos los datos del sector del trabajador
		$datos = ModeloTrabajador::mdlMostrarTrabajador("trabajadorjf","null",$trabajador);

		//reiniciar a 0 la configuracion anterior
		$reiniciarConfiguracion = ModeloTrabajador::mdlTrabajadorSet($usuario,$datos["sector"]);
	
		
		//actualizar a 1 la configuracion marcada de trabajador
		$actualizarConfiguracion = ModeloTrabajador::ctrConfigurarTrabajador($trabajador,$usuario);

		echo $reiniciarConfiguracion;
	}

	public function ajaxPasarTicket(){

		$codTrab=$this->codTrab;
		$barra=$this->barra;

		$validar = ModeloTalleres::mdlMostrarTalleresG($barra);

		if($validar["fecha_proceso"] == null){

			date_default_timezone_set('America/Lima');

			//$fecha = "2021-02-26";
			$fecha = date('Y-m-d G:i:s');
			//var_dump($fecha);

			//$barra = $_POST["codigoBarra"];
			//$codTrab = $_POST["cod_tra"];

			$respuesta = ModeloTalleres::mdlProceso($fecha,$barra,$codTrab);
			//var_dump($respuesta);

			$respuesta2 = ModeloTalleres::mdlTerminado($fecha,$barra,$codTrab);

			echo 'ok';

		}else{

			echo 'no';

		}

	}

}

/*=============================================
EDITAR TRABAJADOR
=============================================*/	
if(isset($_POST["idTrabajador"])){

	$trabajador = new AjaxTrabajador();
	$trabajador -> idTrabajador = $_POST["idTrabajador"];
	$trabajador -> ajaxEditarTrabajador();
}
/*=============================================
ACTIVAR TRABAJADOR
=============================================*/ 

if(isset($_POST["activarTrabajador"])){
	$activarTrabajador=new AjaxTrabajador();
	$activarTrabajador->activarTrabajador=$_POST["activarTrabajador"];
	$activarTrabajador->activarEstadoTrabajador=$_POST["activarEstadoTrabajador"];
	$activarTrabajador->ajaxActivarDesactivarTrabajador();
}

if(isset($_POST["activarTrabajador2"])){
	$activarTrabajador2=new AjaxTrabajador();
	$activarTrabajador2->activarTrabajador2=$_POST["activarTrabajador2"];
	$activarTrabajador2->activarEstadoTrabajador2=$_POST["activarEstadoTrabajador2"];
	$activarTrabajador2->ajaxActivarDesactivarTrabajador2();
}

/*=============================================
ASIGNAR TRABAJADOR PARA MARCAR TALLER
=============================================*/	
if(isset($_POST["asignarTrab"])){

	$asignarTrabajador = new AjaxTrabajador();
	$asignarTrabajador -> asignarTrab = $_POST["asignarTrab"];
	$asignarTrabajador -> ajaxAsignartrabajador();
}

/*=============================================
PASAR TICKETS DESDE AJAX
=============================================*/	
if(isset($_POST["codTrab"])){
	$codTrab=new AjaxTrabajador();
	$codTrab->codTrab=$_POST["codTrab"];
	$codTrab->barra=$_POST["barra"];
	$codTrab->ajaxPasarTicket();
}