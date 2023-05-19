<?php

require_once "../controladores/maestras.controlador.php";
require_once "../modelos/maestras.modelo.php";

class AjaxCorrelativo
{

    /*=============================================
	EDITAR ABONO
	=============================================*/

    public $codigo;

    public function ajaxActualizarCorrelativo()
    {

        $codigo = $this->codigo;

        $respuesta = ModeloMaestras::mdlActualizarCorrelativo($codigo);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR ABONO
=============================================*/

if (isset($_POST["codigo"])) {

    $abono = new AjaxCorrelativo();
    $abono->codigo = $_POST["codigo"];
    $abono->ajaxActualizarCorrelativo();
}
