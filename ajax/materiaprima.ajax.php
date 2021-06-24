<?php
session_start();
// Requerimos el controlador y el modelo
require_once '../controladores/materiaprima.controlador.php';
require_once '../modelos/materiaprima.modelo.php';

class AjaxMateriaPrima{


	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/

	public $idMateriaPrima;

	public function ajaxEditarMateriaPrima(){

		$valor = $this->idMateriaPrima;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);

		echo json_encode($respuesta);

	}

	/* 
	* EDITAR EL COSTO DE LA MATERIA PRIMA
	*/

	public $materiaPrima;

	public function ajaxEditarMateriaPrimaCostos(){

		$valor = $this->materiaPrima;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);

		echo json_encode($respuesta);

	}

	/* 
	* VISUALIZAR LA CABECERA DE LA MATERIA PRIMA
	*/
	public $articuloMP;
	public function ajaxVisualizarMateriaPrima(){

		$valor = $this->articuloMP;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima($valor);

		echo json_encode($respuesta);
	
	}

	/* 
	* VISUALIZAR DETALLE DE LA MATERIA PRIMA
	*/
	public function ajaxVisualizarMateriaPrimaDetalle(){

			$valor = $this->articuloMPDetalle;

			$respuestaDetalle = ControladorMateriaPrima::ctrVisualizarMateriaPrimaDetalle($valor);

			echo json_encode($respuestaDetalle);
	}	

	/* 
	* VISUALIZAR  MATERIA PRIMA DE ARTICULO
	*/
	public $articuloSublimado;
	public function ajaxVisualizarMateriaArticulo(){

		$valor = $this->articuloSublimado;

		$respuestaDetalle = ControladorMateriaPrima::ctrMostrarMateriaArticulo($valor);

		echo json_encode($respuestaDetalle);
	}	

	/* 
	* SELECT SUBLINEA PARA CREAR MATERIA PRIMA
	*/
	public $linea;
	public function ajaxSelectSubLineas(){

		$valor = $this->linea;

		$respuestaDetalle = ControladorMateriaPrima::ctrMostrarSubLineas($valor);

		echo json_encode($respuestaDetalle);
	}	

	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/

	public $CodigoFab;

	public function ajaxValidarCodFab(){

		$valor = $this->CodigoFab;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaFabrica($valor);

		echo json_encode($respuesta);

	}

	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/

	public $idMateriaPrima2;

	public function ajaxAgregarMateriaPrima2(){

		$valor = $this->idMateriaPrima2;

		$respuesta = ControladorMateriaPrima::ctrMostrarMateriaPrima2($valor);

		echo json_encode($respuesta);

	}


	 /*=============================================
      EDITAR DOCUMENTO DE VENTA
      =============================================*/	
      public $datosMateria;
      public function ajaxCambiosMateria(){
        $valor = $this->datosMateria;
        $datos = json_decode($valor);
        foreach ($datos->{"datosMateria"} as  $value) {
          $codpro = $value->{"codpro"};
          $codalt = $value->{"codalt"};
          $despro = $value->{"despro"};
          $undpro = $value->{"undpro"};
          $padval = $value->{"padval"};
          $pseg = $value->{"pseg"};
          $pespro = $value->{"pespro"};
          $stkmin = $value->{"stkmin"};
          $stkmax = $value->{"stkmax"};
          $codprov1 = $value->{"codprov1"};
          $preprov1 = $value->{"preprov1"};
          $monprov1 = $value->{"monprov1"};
          $obsprov1 = $value->{"obsprov1"};
          $codprov2 = $value->{"codprov2"};
          $preprov2 = $value->{"preprov2"};
		  $monprov2 = $value->{"monprov2"};
          $obsprov2 = $value->{"obsprov2"};
		  $codprov3 = $value->{"codprov3"};
          $preprov3 = $value->{"preprov3"};
		  $monprov3 = $value->{"monprov3"};
          $obsprov3 = $value->{"obsprov3"};
		  date_default_timezone_set('America/Lima');
		  $fecha = new DateTime();
		  $PcMod= gethostbyaddr($_SERVER['REMOTE_ADDR']);

		  $datos1 = array("CodPro"=>$codpro,
						  "CodProv1"=>$codprov1,
						  "PreProv1"=>$preprov1,
						  "MonProv1"=>$monprov1,
						  "ObsProv1"=>$obsprov1,
						  "CodProv2"=>$codprov2,
						  "PreProv2"=>$preprov2,
						  "MonProv2"=>$monprov2,
						  "ObsProv2"=>$obsprov2,
						  "CodProv3"=>$codprov3,
						  "PreProv3"=>$preprov3,
						  "MonProv3"=>$monprov3,
						  "ObsProv3"=>$obsprov3,
						  "FecMod"=>$fecha->format("Y-m-d H:i:s"),
						  "PcMod"=>$PcMod,
						  "UsuMod"=>$_SESSION["nombre"]);

		  $respuesta = ModeloMateriaPrima::mdlEditarPrecioMP("preciomp",$datos1);


		  $datos2 = array("CodAlt"=>$codalt,
						  "CodPro"=>$codpro,
						  "DesPro"=>$despro,
						  "UndPro"=>$undpro,
						  "Por_AdVal"=>$padval,
						  "Por_Seg"=>$pseg,
						  "PesPro"=>$pespro,
						  "Stk_Min"=>$stkmin,
						  "Stk_Max"=>$stkmax,
						  "FecMod"=>$fecha->format("Y-m-d H:i:s"),
						  "PcMod"=>$PcMod,
						  "UsuMod"=>$_SESSION["nombre"]);


		  $respuesta2 = ModeloMateriaPrima::mdlEditarMateriaPrima($datos2);

        }
        
    
        echo $respuesta;
    
      }

}


/* 
* EDITAR NOMBRE DE MATERIA PRIMA
*/

if(isset($_POST["idMateriaPrima"])){

	$editarMateriaPrima = new AjaxMateriaPrima();
	$editarMateriaPrima -> idMateriaPrima = $_POST["idMateriaPrima"];
	$editarMateriaPrima -> ajaxEditarMateriaPrima();
  
}

/* 
* EDITAR COSTO DE MATERIA PRIMA
*/

if(isset($_POST["materiaPrima"])){

	$editarMateriaPrimaCostos = new AjaxMateriaPrima();
	$editarMateriaPrimaCostos -> materiaPrima = $_POST["materiaPrima"];
	$editarMateriaPrimaCostos -> ajaxEditarMateriaPrimaCostos();
  
}

/* 
 * VISUALIZAR LA CABECERA DE LA MATERIA PRIMA
*/
if(isset($_POST["articuloMP"])){

	$visualizarMateriaPrima = new AjaxMateriaPrima();
	$visualizarMateriaPrima -> articuloMP = $_POST["articuloMP"];
	$visualizarMateriaPrima -> ajaxVisualizarMateriaPrima();
  
}

/* 
 * VISUALIZAR DETALLE DE LA MATERIA PRIMA
*/
if(isset($_POST["articuloMPDetalle"])){

  	$visualizarMateriaPrimaDetalle = new AjaxMateriaPrima();
	$visualizarMateriaPrimaDetalle -> articuloMPDetalle = $_POST["articuloMPDetalle"];
	$visualizarMateriaPrimaDetalle -> ajaxVisualizarMateriaPrimaDetalle();
  
}

/* 
 * MOSTRAR ARTICULO MATERIA PRIMA SUBLIMADO
*/
if(isset($_POST["articuloSublimado"])){

  $visualizarMateriaSublimado = new AjaxMateriaPrima();
  $visualizarMateriaSublimado -> articuloSublimado = $_POST["articuloSublimado"];
  $visualizarMateriaSublimado -> ajaxVisualizarMateriaArticulo();

}

/* 
* SELECT PARA MOSTRAR LAS SUBLINEAS AL CREAR MATERIAPRIMA
*/

if(isset($_POST["linea"])){

	$selectSubLineas = new AjaxMateriaPrima();
	$selectSubLineas -> linea = $_POST["linea"];
	$selectSubLineas -> ajaxSelectSubLineas();
  
}

/* 
* VALIDAR CODIGO DE FABRICA AL CREAR MATERIA PRIMA
*/

if(isset($_POST["CodigoFab"])){

	$validarMateriaPrima = new AjaxMateriaPrima();
	$validarMateriaPrima -> CodigoFab = $_POST["CodigoFab"];
	$validarMateriaPrima -> ajaxValidarCodFab();
  
}

/* 
* AGREGAR NOMBRE DE MATERIA PRIMA PARA OCOMPRA Y NS
*/

if(isset($_POST["idMateriaPrima2"])){

	$agregarMateriaPrima = new AjaxMateriaPrima();
	$agregarMateriaPrima -> idMateriaPrima2 = $_POST["idMateriaPrima2"];
	$agregarMateriaPrima -> ajaxAgregarMateriaPrima2();
  
}

/*=============================================
GUARDAR CAMBIOS DE MATERIA PRIMA
=============================================*/	
if(isset($_POST["jsonMateria"])){
	
	$editarVentaCambios = new AjaxMateriaPrima();
	$editarVentaCambios -> datosMateria = $_POST["jsonMateria"];
	$editarVentaCambios -> ajaxCambiosMateria();
}
