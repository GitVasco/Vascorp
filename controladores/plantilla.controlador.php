<?php
class ControladorPlantilla
{

    static public function ctrPlantilla()
    {

        include "vistas/plantilla.php";
    }

    //* Función Limpiar HTML
    static public function htmlClean($code)
    {

        $search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

        $replace = array('>', '<', '\\1');

        $code = preg_replace($search, $replace, $code);

        $code = str_replace("> <", "><", $code);

        return $code;
    }
}
