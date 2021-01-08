<?php
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