<?php

require_once "controladores/cuentas.controlador.php";
require_once "modelos/cuentas.modelo.php";

// Obtener cuentas con notificaciones pendientes
$cuentas = ControladorCuentas::ctrNotificacionesPendientes();
$fechaActual = date("Y-m-d");
$cuentasHoy = [];

foreach ($cuentas as $value) {
    if (
        $value["fecha_ven"] == $fechaActual &&
        !empty($value["num_unico"]) &&
        !empty($value["telefono"])
    ) {
        $cuentasHoy[] = $value;
    }
}

// Preparar el array para la API
$mensajes = [];

foreach ($cuentasHoy as $cuenta) {
    $mensajes[] = [
        'telefono' => $cuenta['telefono'],
        'mensaje' => "Hola, su letra con número único {$cuenta['num_unico']} y monto S/{$cuenta['monto']} vence el {$cuenta['fecha_ven']}. Puede realizar el pago en el BCP. ¡Gracias!"
    ];
}

// Opcional: Guardar en un archivo TXT para probar
file_put_contents('mensajes.txt', print_r($mensajes, true));

// // Ejemplo de envío a la API (ajusta según la documentación de la API que uses)
// $apiUrl = "https://api.tuwhatsapp.com/enviar";
// $apiKey = "TU_API_KEY";

// foreach ($mensajes as $mensaje) {
//     $data = [
//         'to' => $mensaje['telefono'],
//         'message' => $mensaje['mensaje']
//     ];

//     $options = [
//         'http' => [
//             'header'  => "Content-Type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
//             'method'  => 'POST',
//             'content' => json_encode($data),
//         ],
//     ];

//     $context  = stream_context_create($options);
//     $result = file_get_contents($apiUrl, false, $context);

//     if ($result === FALSE) {
//         // Manejar el error
//         error_log("Error al enviar mensaje a {$mensaje['telefono']}");
//     }
// }

// echo "Mensajes enviados correctamente.";
