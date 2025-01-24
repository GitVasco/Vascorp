<?php
session_start();
require_once '../controladores/arreglos.controlador.php';
require_once '../modelos/arreglos.modelo.php';

class AjaxArreglos
{
    public $codigoArreglo;

    public function ajaxVisualizarDetalleArreglo()
    {
        $codigoArreglo = $this->codigoArreglo;
        $respuesta = ModeloArreglos::verArreglosDetallesAgrupados($codigoArreglo);
        echo json_encode($respuesta);
    }
}

if (isset($_POST["codigoArreglo"])) {

    $detalleCierre = new AjaxArreglos();
    $detalleCierre->codigoArreglo = $_POST["codigoArreglo"];
    $detalleCierre->ajaxVisualizarDetalleArreglo();
}
