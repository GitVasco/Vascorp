<?php

require_once "../controladores/produccion.controlador.php";
require_once "../modelos/produccion.modelo.php";

require_once "../controladores/materiaprima.controlador.php";
require_once "../modelos/materiaprima.modelo.php";

class AjacPrehormado
{

    /*=============================================
	Traemos los articulos
	=============================================*/

    public $tipoPrehormado;

    public function ajaxTraerArticulo()
    {

        $tipoPrehormado = $this->tipoPrehormado;

        if ($tipoPrehormado == "01") {
            $respuesta = ModeloProduccion::mdlMostrarArticulosBrasier();
        } else {
            $respuesta = ModeloMateriaPrima::mdlMostrarAlmacen01('COP');
        }

        echo json_encode($respuesta);
    }

    public $eliminarPrehormado;

    public function ajaxEliminarPrehormdo()
    {

        $id = $this->eliminarPrehormado;

        $respuesta = ModeloProduccion::mdlEliminarPrehormado($id);

        echo json_encode($respuesta);
    }
}

/*=============================================
Traemos los articulos
=============================================*/
if (isset($_POST["tipoPrehormado"])) {

    $para = new AjacPrehormado();
    $para->tipoPrehormado = $_POST["tipoPrehormado"];
    $para->ajaxTraerArticulo();
}

// eliminamos el prehormado
if (isset($_POST["eliminarPrehormado"])) {

    $para = new AjacPrehormado();
    $para->eliminarPrehormado = $_POST["eliminarPrehormado"];
    $para->ajaxEliminarPrehormdo();
}
