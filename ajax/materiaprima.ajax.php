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

	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/
	public function ajaxAgregarCuadro(){

		$cuadro = $this->cuadro;
		$codpro = $this->codpro;

		$respuesta = ModeloMateriaPrima::mdlAgregarCuadro($cuadro, $codpro);

		echo json_encode($respuesta);

	}	

	/* 
	* EDITAR NOMBRE DE LA MATERIA PRIMA
	*/
	public function ajaxQuitarCuadro(){

		$codpro = $this->codproQ;

		$respuesta = ModeloMateriaPrima::mdlQuitarCuadro($codpro);

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

	/* 
	* SELECT SUBLINEA 2 PARA UNO PARA CREAR MATERIA PRIMA
	*/
	public function ajaxSelectSubLineas2(){

		$valor = $this->linea2;
		$valor2 = $this->sublinea;

		$respuesta2 = ControladorMateriaPrima::ctrMostrarSubLineas2($valor,$valor2);

		echo json_encode($respuesta2);
	}
	
	/*=============================================
	EDITAR DOCUMENTO DE VENTA
	=============================================*/	
	public $datosMateriaDuplicar;
	public function ajaxDuplicarMateria(){
        $valor = $this->datosMateriaDuplicar;
        $datos = json_decode($valor);
        foreach ($datos->{"datosMateria"} as  $value) {
          $codfab = $value->{"codfab"};
          $codalt = $value->{"codalt"};
		  $fampro = $value->{"fampro"};
		  $color = $value->{"color"};
		  $talla = $value->{"talla"};
          $despro = $value->{"despro"};
          $undpro = $value->{"undpro"};
          $padval = $value->{"padval"};
          $pseg = $value->{"pseg"};
          $pespro = $value->{"pespro"};
		  $stkactual = $value->{"stkactual"}; 
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

		$existe= ModeloMateriaPrima::mdlMostrarExisteMateria($codfab);

		if ($existe){
			$respuesta = "error";
		}else{
			$fecha = new DateTime();
			$PcReg= gethostbyaddr($_SERVER['REMOTE_ADDR']);

			$ultimoCod = ModeloMateriaPrima::mdlMostrarUltimoCodPro();

            $suma = $ultimoCod["CodPro"]+1;
            $codigoPro = str_pad($suma,strlen($ultimoCod["CodPro"]),'0',STR_PAD_LEFT);



			$datos = array(	"Cod_Local"=>'01',
							"Cod_Entidad"=>'01',
							"CodPro"=>$codigoPro,
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
							"FecReg"=>$fecha->format("Y-m-d H:i:s"),
							"PcReg"=>$PcReg,
							"UsuReg"=>$_SESSION["nombre"]);

			$respuesta = ModeloMateriaPrima::mdlIngresarPrecioMP("preciomp",$datos);
			


			$datos2 = array("CodAlt"=>$codalt,
							"Cod_Local"=>'01',
							"Cod_Entidad"=>'01',
							"CodPro"=>$codigoPro,
							"CodFab"=>$codfab,
							"DesPro"=>$despro,
							"ColPro"=>$color,
							"UndPro"=>$undpro,
							"Mo"=>'',
							"PaiPro"=>'',
							"PrePro"=>'',
							"PreFob"=>'',
							"CosPro"=>'',
							"Por_AdVal"=>$padval,
							"Por_Seg"=>$pseg,
							"PesPro"=>$pespro,
							"Stk_Act"=>$stkactual,
							"Stk_Min"=>$stkmin,
							"Stk_Max"=>$stkmax,
							"EstPro"=>'1',
							"TalPro"=>$talla,
							"FamPro"=>$fampro,
							"Proveedor"=>'',
							"CodAlm01"=>'0',
							"FecReg"=>$fecha->format("Y-m-d H:i:s"),
							"PcReg"=>$PcReg,
							"UsuReg"=>$_SESSION["nombre"]);

				$respuesta2 = ModeloMateriaPrima::mdlIngresarMateriaPrima("producto",$datos2);

			}
		}
			
    
        echo $respuesta;
    
      }

	  /* 
	 * MOSTAR MP DE ALMACEN01 
	  */
	  public function ajaxSelectAlmacen01(){

		$valor = $this->codproCua;

		$respuesta = ControladorMateriaPrima::ctrSelectAlmacen01($valor);

		echo json_encode($respuesta);

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

/* 
* SELECT PARA MOSTRAR LAS SUBLINEAS AL CREAR MATERIAPRIMA
*/

if(isset($_POST["sublinea"])){

	$selectSubLineas2 = new AjaxMateriaPrima();
	$selectSubLineas2 -> linea2 = $_POST["linea2"];
	$selectSubLineas2 -> sublinea = $_POST["sublinea"];
	$selectSubLineas2 -> ajaxSelectSubLineas2();
  
}


/*=============================================
GUARDAR CAMBIOS DE MATERIA PRIMA
=============================================*/	
if(isset($_POST["jsonMateriaDuplicar"])){
	
	$duplicarNuevoColor = new AjaxMateriaPrima();
	$duplicarNuevoColor -> datosMateriaDuplicar = $_POST["jsonMateriaDuplicar"];
	$duplicarNuevoColor -> ajaxDuplicarMateria();
}

/* 
* AGREMAR LA COPA AL CUADRO
*/

if(isset($_POST["cuadro"])){

	$agregarCuadro = new AjaxMateriaPrima();
	$agregarCuadro -> cuadro = $_POST["cuadro"];
	$agregarCuadro -> codpro = $_POST["codpro"];
	$agregarCuadro -> ajaxAgregarCuadro();
  
}

/* 
* QUITAR LA COPA AL CUADRO
*/

if(isset($_POST["codproQ"])){

	$agregarCuadro = new AjaxMateriaPrima();
	$agregarCuadro -> codproQ = $_POST["codproQ"];
	$agregarCuadro -> ajaxQuitarCuadro();
  
}

/* 
* QUITAR LA COPA AL CUADRO
*/

if(isset($_POST["codproCua"])){

	$agregarCuadro = new AjaxMateriaPrima();
	$agregarCuadro -> codproCua = $_POST["codproCua"];
	$agregarCuadro -> ajaxSelectAlmacen01();
  
}