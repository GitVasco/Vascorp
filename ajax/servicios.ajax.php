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

    /*=============================================
      VISUALIZAR SERVICIO
    =============================================*/ 
    public $codigoServicio;
    public function ajaxVisualizarServicio(){
        $codigoServicio=$this->codigoServicio;
        $respuesta=ControladorServicios::ctrMostrarServicios("codigo",$codigoServicio);
        echo json_encode($respuesta);
        
    }
  
      public $codigoDServicio;
      public function ajaxVisualizarDetalleServicio(){
          $codigoDServicio=$this->codigoDServicio;
          $respuesta=ControladorServicios::ctrVisualizarServicioDetalle($codigoDServicio);
          echo json_encode($respuesta);
          
      }

      public $idPagoServicio;
      public function ajaxEditarPagoServicio(){
       
        $valor = $this->idPagoServicio;
    
        $respuesta = ControladorServicios::ctrMostrarPagoServicios($valor);
    
        echo json_encode($respuesta);
    
      }

      //PAGAR ESTADO DE PAGO
	public $idPago;
    public $estadoPago;

	public function ajaxPagarServicio(){
        $valor1=$this->estadoPago;
		$valor2=$this->idPago;

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

		$respuesta=ModeloServicios::mdlPagarServicio($valor1,$valor2);

		echo $respuesta;
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
	$editarPrecioServicio->idPrecioServicio=$_POST["idPrecioServicio"];
    $editarPrecioServicio->ajaxEditarPrecioServicio();
    
}

if(isset($_POST["codigoServicio"])){

	$verServicio=new AjaxServicios();
	$verServicio->codigoServicio=$_POST["codigoServicio"];
    $verServicio->ajaxVisualizarServicio();
    
}

if(isset($_POST["codigoDServicio"])){

	$detalleServicios=new AjaxServicios();
	$detalleServicios->codigoDServicio=$_POST["codigoDServicio"];
    $detalleServicios->ajaxVisualizarDetalleServicio();
    
}

if(isset($_POST["idPagoServicio"])){

	$editarPagoServicio=new AjaxServicios();
	$editarPagoServicio->idPagoServicio=$_POST["idPagoServicio"];
    $editarPagoServicio->ajaxEditarPagoServicio();
    
}

if(isset($_POST["idPago"])){

	$pagarCierreServicio=new AjaxServicios();
	$pagarCierreServicio->idPago=$_POST["idPago"];
    $pagarCierreServicio->estadoPago=$_POST["estadoPago"];
    $pagarCierreServicio->ajaxPagarServicio();
    
}