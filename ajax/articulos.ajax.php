<?php
session_start();
// Requerimos el controlador y el modelo
require_once '../controladores/articulos.controlador.php';
require_once '../modelos/articulos.modelo.php';
require_once '../controladores/usuarios.controlador.php';
require_once '../modelos/usuarios.modelo.php';

class AjaxArticulos
{

	/* 
	* Activar-Desactivar Articulo
	*/
	public $activarId;
	public $activarEstado;

	public function ajaxActivarDesactivarArticulo()
	{

		$valor1 = $this->activarEstado;
		date_default_timezone_set('America/Lima');
		$fecha = new DateTime();
		$valor2 = $this->activarId;
		$articulo = ControladorArticulos::ctrMostrarArticulos($valor2);
		$usuario = $_SESSION["nombre"];
		if ($valor1 == "Activo") {

			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se activo un articulo';
			$descripcion   = 'El usuario ' . $usuario . ' activo el articulo ' . $articulo["articulo"] . ' - ' . $articulo["nombre"] . " talla: " . $articulo["talla"] . " color: " . $articulo["color"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if ($_SESSION["correo"] == 1) {
				mail($para, $asunto, $descripcion, $de);
			}
			if ($_SESSION["datos"] == 1) {
				$datos2 = array(
					"usuario" => $usuario,
					"concepto" => $descripcion,
					"fecha" => $fecha->format("Y-m-d H:i:s")
				);
				$auditoria = ModeloUsuarios::mdlIngresarAuditoria("auditoriajf", $datos2);
			}
		} else {
			$para      = 'notificacionesvascorp@gmail.com';
			$asunto    = 'Se descontinuo un articulo';
			$descripcion   = 'El usuario ' . $usuario . ' descontinuo el articulo ' . $articulo["articulo"] . ' - ' . $articulo["nombre"] . " talla: " . $articulo["talla"] . " color: " . $articulo["color"];
			$de = 'From: notificacionesvascorp@gmail.com';
			if ($_SESSION["correo"] == 1) {
				mail($para, $asunto, $descripcion, $de);
			}
			if ($_SESSION["datos"] == 1) {
				$datos2 = array(
					"usuario" => $usuario,
					"concepto" => $descripcion,
					"fecha" => $fecha->format("Y-m-d H:i:s")
				);
				$auditoria = ModeloUsuarios::mdlIngresarAuditoria("auditoriajf", $datos2);
			}
		}
		$respuesta = ModeloArticulos::mdlActualizarArticulo($valor1, $valor2);

		echo $respuesta;
	}

	public function ajaxCorteIncompleto()
	{

		$codigo = $this->codigo;
		$estado = $this->estado;

		$respuesta = ModeloArticulos::mdlCorteIncompleto($codigo, $estado);

		echo $respuesta;
	}

	/* 
	* EDITAR ARTICULO
	*/
	public $articulo;

	public function ajaxEditarArticulo()
	{

		$valor = $this->articulo;

		$respuesta = ControladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);
	}

	/* 
	* MOSTRAR ARTICULO PARA ORDEN DE CORTE
	*/
	public $articuloOC;

	public function ajaxMostrarArticuloOC()
	{

		$valor = $this->articuloOC;

		$respuesta = controladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);
	}

	/* 
	* MOSTRAR ARTICULO PARA ALMACEN DE CORTE
	*/

	public function ajaxMostrarArticuloAC()
	{

		$valor = $this->articuloAC;

		$respuesta = controladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);
	}

	/* 
	* MOSTRAR ARTICULO PARA ALMACEN DE CORTE
	*/
	public $articuloServicio;
	public function ajaxMostrarArticuloServicio()
	{

		$valor = $this->articuloServicio;

		$respuesta = controladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);
	}

	public $articuloT;
	public function ajaxMostrarArticuloT()
	{

		$valor = $this->articuloT;

		$respuesta = controladorArticulos::ctrMostrarArticulos($valor);

		echo json_encode($respuesta);
	}

	public function ajaxMostrarModCol()
	{
		$valor = $this->modcol;
		$respuesta = ModeloArticulos::MostrarModCol($valor);

		echo json_encode($respuesta);
	}

	public $articuloArreglo;
	public function ajaxMostrarArticuloArreglo()
	{

		$valor = $this->articuloArreglo;

		$respuesta = ModeloArticulos::mdlMostrarArticulosArreglosUnicos($valor);

		echo json_encode($respuesta);
	}
}

//OBJETOS
/*=============================================
ACTIVAR Y DESACTIVAR ARTICULO
=============================================*/
if (isset($_POST["activarId"])) {
	$activar = new AjaxArticulos();
	$activar->activarId = $_POST["activarId"];
	$activar->activarEstado = $_POST["activarEstado"];
	$activar->ajaxActivarDesactivarArticulo();
}


/*=============================================
EDITAR ARTICULO
=============================================*/

if (isset($_POST["articulo"])) {

	$editarArticulo = new AjaxArticulos();
	$editarArticulo->articulo = $_POST["articulo"];
	$editarArticulo->ajaxEditarArticulo();
}


/* 
* MOSTRAR ARTICULOS PARA ORDEN DE CORTE
*/
if (isset($_POST["articuloOC"])) {

	$mostrarArticuloOC = new AjaxArticulos();
	$mostrarArticuloOC->articuloOC = $_POST["articuloOC"];
	$mostrarArticuloOC->ajaxMostrarArticuloOC();
}


/* 
* MOSTRAR ARTICULOS PARA ALMACEN DE CORTE
*/
if (isset($_POST["articuloAC"])) {

	$mostrarArticuloAC = new AjaxArticulos();
	$mostrarArticuloAC->articuloAC = $_POST["articuloAC"];
	$mostrarArticuloAC->ajaxMostrarArticuloAC();
}

/* 
* MOSTRAR ARTICULOS PARA ALMACEN DE CORTE
*/
if (isset($_POST["articuloServicio"])) {

	$mostrarArticuloServicio = new AjaxArticulos();
	$mostrarArticuloServicio->articuloServicio = $_POST["articuloServicio"];
	$mostrarArticuloServicio->ajaxMostrarArticuloServicio();
}


/* 
* MOSTRAR ARTICULOS PARA INGRESAR STOCK
*/
if (isset($_POST["articuloT"])) {

	$mostrarArticuloT = new AjaxArticulos();
	$mostrarArticuloT->articuloT = $_POST["articuloT"];
	$mostrarArticuloT->ajaxMostrarArticuloT();
}


/* 
* Actualozar Corte Incompleto
*/
if (isset($_POST["codigo"])) {

	$corteI = new AjaxArticulos();
	$corteI->codigo = $_POST["codigo"];
	$corteI->estado = $_POST["estadoCorte"];
	$corteI->ajaxCorteIncompleto();
}


/* 
* MOSTRAR ARTICULOS COLORES DE ALMACEN DE CORTE
*/
if (isset($_POST["modcol"])) {

	$mostrarArticulo = new AjaxArticulos();
	$mostrarArticulo->modcol = $_POST["modcol"];
	$mostrarArticulo->ajaxMostrarModCol();
}

// Mostrar los articulos en arreglos
if (isset($_POST["articuloArreglo"])) {

	$mostrarArticuloArreglo = new AjaxArticulos();
	$mostrarArticuloArreglo->articuloArreglo = $_POST["articuloArreglo"];
	$mostrarArticuloArreglo->ajaxMostrarArticuloArreglo();
}
