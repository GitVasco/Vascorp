<?php
require_once '../controladores/servicio.controlador.php';
require_once '../modelos/servicio.modelo.php';


require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';


class AjaxServicios{
	# Método para eliminar la info de Ventas
	public $idServicio;
	public function ajaxEliminarServicio(){

        $idServicio=$this->idServicio;
        
		$respuesta=ControladorServicios::ctrEliminarServicio($idServicio);
        echo $respuesta;
        
	}
}

// OBJETOS
if(isset($_POST["idServicio"])){

	$eliminarServicio=new AjaxServicios();
	$eliminarServicio->idServicio=$_POST["idServicio"];
    $eliminarServicio->ajaxEliminarServicio();
    
}