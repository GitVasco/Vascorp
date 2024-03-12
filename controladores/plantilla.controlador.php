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

    //* Obtener informacion del json
    static public function obtenerInfoJson($rutaArchivo, $seccion, $idBuscado = null)
    {
        // Cargar el archivo JSON
        $jsonData = json_decode(file_get_contents($rutaArchivo), true);

        // Verificar si la sección existe
        if (!isset($jsonData[$seccion])) {
            return ["error" => "Sección no encontrada."];
        }

        // Acceder a la sección específica
        $datosSeccion = $jsonData[$seccion];

        // Si se ha proporcionado un ID, buscar el elemento específico
        if ($idBuscado !== null) {
            foreach ($datosSeccion as $elemento) {
                if ($elemento["id"] == $idBuscado) {
                    // Devolver la información del elemento específico como un array
                    return [
                        "id"            => $elemento["id"],
                        "nombre"        => $elemento["nombre"],
                        // Asumiendo que "color" y "icono" pueden no estar definidos para todos los elementos
                    ];
                }
            }

            // Si el ID no fue encontrado, devolver un mensaje de error
            return ["error" => "ID no encontrado en la sección."];
        }

        // Si no se proporcionó un ID, devolver todos los elementos de la sección
        return $datosSeccion;
    }

    //* Mostar información del proceso
    static public function showInfoConsole($message, $value)
    {
        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
            echo '<script>console.info("Modo de desarrollo: ' . $message . '..."); console.table(JSON.parse(\'' . $value . '\'));</script>';
        } else {
            echo '<script>console.info("Modo de desarrollo: ' . $message . '...", "' . $value . '");</script>';
        }
    }
}
