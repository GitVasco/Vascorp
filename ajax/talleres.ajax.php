<?php

require_once "../controladores/talleres.controlador.php";
require_once "../modelos/talleres.modelo.php";

class AjaxTalleres{
/*=============================================
  EDITAR CANTIDAD DE TALLER
  =============================================*/ 

  public $idTaller;

  public function ajaxEditarCantidad(){

    $valor = $this->idTaller;

    $respuesta = ControladorTalleres::ctrMostrarTalleresG($valor);

    echo json_encode($respuesta);

    }
    public $idTallerT;
    public function ajaxVerTallerT(){

      $valor = $this->idTallerT;
  
      $respuesta = ModeloTalleres::mdlVerTalleresTerminado($valor);
  
      echo json_encode($respuesta);
  
      }

    public $fecha;
    public function ajaxSelectTaller(){

      $valor = $this->fecha;
  
      $respuesta = ModeloTalleres::mdlMostrarSelectTaller($valor);
  
      echo json_encode($respuesta);
  
    }

}
/*=============================================
EDITAR CANTIDAD DE TALLER
=============================================*/	
if(isset($_POST["idTaller"])){

	$taller = new AjaxTalleres();
	$taller -> idTaller = $_POST["idTaller"];
	$taller -> ajaxEditarCantidad();
}

/*=============================================
VER TALLER T
=============================================*/	
if(isset($_POST["idTallerT"])){

	$verTallerT = new AjaxTalleres();
	$verTallerT -> idTallerT = $_POST["idTallerT"];
	$verTallerT -> ajaxVerTallerT();
}

/*=============================================
SELECT TALLER
=============================================*/	
if(isset($_POST["fecha"])){

	$selectTaller = new AjaxTalleres();
	$selectTaller -> fecha = $_POST["fecha"];
	$selectTaller -> ajaxSelectTaller();
}