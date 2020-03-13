<?php
require_once "../controladores/trabajador.controlador.php";
require_once "../modelos/trabajador.modelo.php";

class AjaxTrabajador{
  /*=============================================
  EDITAR TRABAJADOR
  =============================================*/ 

  public $idTrabajador;

  public function ajaxEditarTrabajador(){
      
    $item="cod_tra";
    $valor = $this->idTrabajador;

    $respuesta = ControladorTrabajador::ctrMostrarTrabajador($item,$valor);

    echo json_encode($respuesta);

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