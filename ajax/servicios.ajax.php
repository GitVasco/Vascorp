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
	public $servicio;
	public function ajaxUltimoServicio(){
        $servicio=$this->servicio;
		$respuesta=ControladorServicios::ctrMostrarUltimoServicio();
        echo json_encode($respuesta);
        
	}

	/*=============================================
      EDITAR PRECIO SERVICIO
      =============================================*/ 
    
      public $idPrecioServicio;
    
      public function ajaxEditarPrecioServicio(){
        $item="id";
        $valor = $this->idPrecioServicio;
    
        $respuesta = ControladorServicios::ctrMostrarPrecioServicios($item,$valor);
    
        echo json_encode($respuesta);
    
      }
}

// OBJETOS
if(isset($_POST["idServicio"])){

	$eliminarServicio=new AjaxServicios();
	$eliminarServicio->idServicio=$_POST["idServicio"];
    $eliminarServicio->ajaxEliminarServicio();
    
}

if(isset($_POST["servicio"])){

	$ultimoServicio = new AjaxServicios();
	$ultimoServicio -> servicio =$_POST["servicio"];
    $ultimoServicio -> ajaxUltimoServicio();
    
}

if(isset($_POST["idPrecioServicio"])){

	$editarPrecioServicio=new AjaxServicios();
	$editarPrecioServicio->idServicio=$_POST["idPrecioServicio"];
    $editarPrecioServicio->ajaxEditarPrecioServicio();
    
}