<?php
require_once '../controladores/ingresos.controlador.php';
require_once '../modelos/ingresos.modelo.php';



class AjaxIngresos{
	
	public $codigoIngreso;
	public function ajaxVisualizarIngreso(){
        $codigoIngreso=$this->codigoIngreso;
		$respuesta=ControladorIngresos::ctrMostrarIngresos("documento",$codigoIngreso);
        echo json_encode($respuesta);
        
	}

	public $codigoDIngreso;
	public function ajaxVisualizarDetalleIngreso(){
        $codigoDIngreso=$this->codigoDIngreso;
		$respuesta=ControladorIngresos::ctrVisualizarIngresoDetalle($codigoDIngreso);
        echo json_encode($respuesta);
        
	}
}

// OBJETOS


if(isset($_POST["codigoIngreso"])){

	$verIngreso=new AjaxIngresos();
	$verIngreso->codigoIngreso=$_POST["codigoIngreso"];
    $verIngreso->ajaxVisualizarIngreso();
    
}

if(isset($_POST["codigoDIngreso"])){

	$detalleIngreso=new AjaxIngresos();
	$detalleIngreso->codigoDIngreso=$_POST["codigoDIngreso"];
    $detalleIngreso->ajaxVisualizarDetalleIngreso();
    
}