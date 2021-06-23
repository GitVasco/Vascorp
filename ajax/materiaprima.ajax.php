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
          $undpro = $value->{"vendedor"};
          $padval = $value->{"neto"};
          $pseg = $value->{"igv"};
          $pespro = $value->{"monto"};
          $stkmin = $value->{"fecha"};
          $stkmax = $value->{"origen_venta"};
          $codprov1 = $value->{"tip_nota"};
          $preprov1 = $value->{"motivo"};
          $monprov1 = $value->{"tip_cont"};
          $obsprov1 = $value->{"fecha_origen"};
          $codprov2 = $value->{"observacion"};
          $preprov2 = $value->{"usuario"};
		  $monprov2 = $value->{"tip_cont"};
          $obsprov2 = $value->{"fecha_origen"};
		  $codprov3 = $value->{"observacion"};
          $preprov3 = $value->{"usuario"};
		  $monprov3 = $value->{"tip_cont"};
          $obsprov3 = $value->{"fecha_origen"};

        //   $arregloVenta = array("tipo"=>$doc,
        //                         "documento"=>$cta,
        //                         "neto"=>$neto2,
        //                         "igv"=>$igv2,
        //                         "total"=>$total,
        //                         "cliente"=>$cli,
        //                         "vendedor"=>$vend,
        //                         "fecha"=>$fecha,
        //                         "doc_origen"=>$origen_venta,
        //                         "usuario"=>$user);
          
        // $respuesta = ModeloMateriaPrima::mdlEditarMateriaPrima($arregloVenta);

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
