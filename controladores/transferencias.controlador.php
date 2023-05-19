<?php

class controladorTransferencias
{
    static public function ctrCrearTransferencia()
    {

        if (isset($_POST["pedidoCod"])) {
            $codigo = $_POST["pedidoCod"];
            $tabla = "ing_sal";
            $transferencia = ModeloPedidos::mdlMostrarTemporal($tabla, $_POST["pedidoCod"]);

            if ($transferencia["codigo"] != "") {
                $valor = $_POST["modeloModalA"];
                $respuesta = controladorArticulos::ctrVerArticulosB($valor);

                foreach ($respuesta as $value) {

                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_ing_sal";
                    $val1 = $articulo;
                    $val2 = $_POST[$articulo];
                    $val3 = $codigo;
                    $val4 = 0;

                    #1ero eliminar si ya se registro
                    $eliminar = array(
                        "codigo" => $val3,
                        "articulo" => $val1
                    );

                    $limpiar = ModeloPedidos::mdlEliminarDetalleTemporal($tabla, $eliminar);

                    if ($val2 > 0) {

                        $datos = array(
                            "codigo"    => $val3,
                            "articulo"  => $val1,
                            "cantidad"  => $val2,
                            "precio"    => $val4
                        );

                        $respuestaB = ModeloPedidos::mdlGuardarTemporalDetalle($tabla, $datos);
                    }
                }

                if ($respuestaB = "ok") {

                    echo '  <script>                                        

                    $("#updDiv").load(" #updDiv");//actualizas el div
                    $("#updDivB").load(" #updDivB");//actualizas el div
                    $("#updDivC").load(" #updDivC");//actualizas el div
                    Command: toastr["success"]("El modelo fue registrado");

                </script>';
                }
            } else {

                $datos = array(
                    "codigo" => $codigo,
                    "cliente" => $_POST["almDes"],
                    "vendedor" => $_POST["almOri"],
                    "lista" => "",
                    "usuario" => $_SESSION["id"]
                );

                ModeloSalidas::mdlGuardarTemporal($tabla, $datos);

                $valor = $_POST["modeloModalA"];
                $respuesta = controladorArticulos::ctrVerArticulos($valor);

                foreach ($respuesta as $value) {

                    $articulo = $value["articulo"];
                    #var_dump("articulo", $value["articulo"]);
                    $tabla = "detalle_ing_sal";
                    $val1 = $articulo;
                    $val2 = $_POST[$articulo];
                    $val3 = $codigo;
                    $val4 = 0;

                    if ($val2 > 0) {

                        $datos = array(
                            "codigo"    => $val3,
                            "articulo"  => $val1,
                            "cantidad"  => $val2,
                            "precio"    => $val4
                        );

                        $respuesta = ModeloPedidos::mdlGuardarTemporalDetalle($tabla, $datos);

                        if ($respuesta = "ok") {

                            echo '  <script>

                                        Command: toastr["success"]("El modelo fue registrado");
                                        window.location="index.php?ruta=crear-transferencias-apt&codigo=' . $codigo . '";

                                    </script>';
                        }
                    }
                }
            }
        }
    }
}
