<?php

class ControladorFacturacion{

    static public function ctrFacturar(){

        if(isset($_POST["codPedido"])){

            if($_POST["tdoc"] == "00"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaGuia = ModeloArticulos::mdlActualizarStock($datos);
                    //var_dump($respuestaGuia);

                }

                //var_dump($respuestaGuia);

                /*
                todo: registrar en movimientos
                */
                if($respuestaGuia == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S01",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "GUIA REMISION");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDestino = $_POST["serieSeparado"];
                        $docDest = str_replace ( '-', '', $docDestino);
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S01",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "GUIA REMISION");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /* 
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,3);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioGuia($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero la Guia '.$documento.'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "pedidoscv";

                                            }
                                        })

                            </script>';

                        }

                    }


                }

            }else if($_POST["tdoc"] == "01"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaFactura = ModeloArticulos::mdlActualizarStock($datos);
                    //var_dump($respuestaFactura);

                }

                //var_dump($respuestaFactura);

                /*
                todo: registrar en movimientos
                */
                if($respuestaFactura == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S03",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "FACTURA");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDest = "";
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S03",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "FACTURA");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /*
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,4);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioFactura($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            /*
                            todo:GENERAMOS LA CUENTA CORRIENTE
                            */
                            $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                            //var_dump($respuestaDoc);

                            $tipo_doc = $_POST["tdoc"];
                            //var_dump($tipo_doc);

                            $documento = $_POST["serie"];
                            $doc = str_replace ( '-', '', $documento);
                            //var_dump($doc);

                            $cliente = $respuestaDoc["cod_cli"];
                            //var_dump($cliente);

                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);

                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);

                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);

                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipo_doc;
                            //var_dump($cod_pago);

                            $usuario = $_POST["idUsuario"];
                            //var_dump($usuario);

                            $datos = array( "tipo_doc" => $tipo_doc,
                                            "num_cta" => $doc,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                            //var_dump($datos);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datos);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la Factura '.$documento.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                }).then(function(result){
                                                if (result.value) {

                                                window.location = "pedidoscv";

                                                }
                                            })

                                </script>';

                            }

                        }

                    }

                }

            }else if($_POST["tdoc"] == "03"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaBoleta = ModeloArticulos::mdlActualizarStock($datos);
                    //var_dump($respuestaBoleta);

                }

                //var_dump($respuestaBoleta);

                /*
                todo: registrar en movimientos
                */
                if($respuestaBoleta == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S02",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "BOLETA");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDest = "";
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S02",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "BOLETA");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /*
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,4);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioBoleta($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            /*
                            todo:GENERAMOS LA CUENTA CORRIENTE
                            */
                            $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                            //var_dump($respuestaDoc);

                            $tipo_doc = $_POST["tdoc"];
                            //var_dump($tipo_doc);

                            $documento = $_POST["serie"];
                            $doc = str_replace ( '-', '', $documento);
                            //var_dump($doc);

                            $cliente = $respuestaDoc["cod_cli"];
                            //var_dump($cliente);

                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);

                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);

                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);

                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipo_doc;
                            //var_dump($cod_pago);

                            $usuario = $_POST["idUsuario"];
                            //var_dump($usuario);

                            $datos = array( "tipo_doc" => $tipo_doc,
                                            "num_cta" => $doc,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                            //var_dump($datos);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datos);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la Boleta '.$documento.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                }).then(function(result){
                                                if (result.value) {

                                                window.location = "pedidoscv";

                                                }
                                            })

                                </script>';

                            }

                        }

                    }

                }

            }else if($_POST["tdoc"] == "09"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    //var_dump($datos);

                    $respuestaProforma = ModeloArticulos::mdlActualizarStock($datos);
                    //var_dump($respuestaProforma);

                }

                //var_dump($respuestaProforma);

                /*
                todo: registrar en movimientos
                */
                if($respuestaProforma == "ok"){

                    foreach($respuesta as $value){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = $_POST["dscto"];
                        //var_dump($dscto);

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        $datosM = array("tipo" => "S70",
                                        "documento" => $doc,
                                        "articulo" => $value["articulo"],
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "cantidad" => $value["cantidad"],
                                        "precio" => $value["precio"],
                                        "dscto2" => $dscto,
                                        "total" => $total,
                                        "nombre_tipo" => "PROFORMA");
                        //var_dump($datosM);

                        $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($datosM);

                    }

                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                        //var_dump($respuestaDoc);

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codPedido"];
                        //var_dump("$docOrigen");

                        $docDest = "";
                        //var_dump($docDest);

                        $datosD = array("tipo" => "S70",
                                        "documento" => $doc,
                                        "neto" => $respuestaDoc["op_gravada"],
                                        "igv" => $respuestaDoc["igv"],
                                        "dscto" => $respuestaDoc["descuento_total"],
                                        "total" => $respuestaDoc["total"],
                                        "cliente" => $respuestaDoc["cod_cli"],
                                        "vendedor" => $respuestaDoc["vendedor"],
                                        "agencia" => $respuestaDoc["agencia"],
                                        "lista_precios" => $respuestaDoc["lista"],
                                        "condicion_venta" => $respuestaDoc["condicion_venta"],
                                        "doc_destino" => $docDest,
                                        "doc_origen" => $docOrigen,
                                        "usuario" => $usuario,
                                        "tipo_documento" => "PROFORMA");
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);

                    }

                    //var_dump($respuestaDocumento);

                    /*
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $documento = $_POST["serie"];
                        $serie = substr($documento,0,3);
                        //var_dump($serie);

                        $talonario = ModeloFacturacion::mdlActualizarTalonarioProforma($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            /*
                            todo:GENERAMOS LA CUENTA CORRIENTE
                            */
                            $respuestaDoc = ModeloPedidos::mdlMostraPedidosCabecera($_POST["codPedido"]);
                            //var_dump($respuestaDoc);

                            $tipo_doc = $_POST["tdoc"];
                            //var_dump($tipo_doc);

                            $documento = $_POST["serie"];
                            $doc = str_replace ( '-', '', $documento);
                            //var_dump($doc);

                            $cliente = $respuestaDoc["cod_cli"];
                            //var_dump($cliente);

                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);

                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);

                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);

                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipo_doc;
                            //var_dump($cod_pago);

                            $usuario = $_POST["idUsuario"];
                            //var_dump($usuario);

                            $datos = array( "tipo_doc" => $tipo_doc,
                                            "num_cta" => $doc,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                            //var_dump($datos);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datos);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la Proforma '.$documento.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                }).then(function(result){
                                                if (result.value) {

                                                window.location = "pedidoscv";

                                                }
                                            })

                                </script>';

                            }

                        }

                    }

                }

            }else{

                var_dump("otro");

            }

        }else{

            //var_dump("no");

        }

    }

    /*
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostrarTablas($tipo, $estado, $valor){

		$respuesta = ModeloFacturacion::mdlMostrarTablas($tipo, $estado, $valor);

		return $respuesta;

    }

    static public function ctrFacturarGuia(){

        if(isset($_POST["codPedido"])){

            $codigo = $_POST["codPedido"];
            //var_dump($codigo);
            $serie = $_POST["serieDest"];
            //var_dump($serie);
            $documento = $_POST["docDest"];
            //var_dump($serie.$documento);
            $docDestino = $serie.$documento;
            //var_dump($docDestino);

            $tip_dest = substr($serie, 0, 1);
            //var_dump($tip_dest);
            date_default_timezone_set("America/Lima");
            $fecha = date("Y-m-d");
            //var_dump($fecha);
            $tipo_origen = "S01";
            //var_dump($tipo_origen);
            $usuario = $_POST["idUsuario"];

            if($tip_dest == "F"){

                $tipo = "S03";
                //var_dump($tipo);
                $tipoCta = '01';
                //var_dump($tipoCta);
                $nombre_tipo="FACTURA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioFactura($serie);
                //var_dump("factura", $talonario);

            }else{

                $tipo = "S02";
                //var_dump($tipo);
                $tipoCta = '03';
                //var_dump($tipoCta);
                $nombre_tipo="BOLETA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioBoleta($serie);
                //var_dump("boleta", $talonario);

            }

            /*
            todo GENERAMOS EN MOVIMIENTOS
            */

            $datos = array( "tipo" => $tipo,
                            "documento" => $docDestino,
                            "fecha" => $fecha,
                            "nombre_tipo" => $nombre_tipo,
                            "codigo" => $codigo,
                            "tipo_documento" => $tipo_origen);
            //var_dump($datos);

            $facturar = ModeloFacturacion::mdlFacturarGuiaM($datos);
            //var_dump($facturar);

            /*
            todo REGISTRAMOS EN VENTAJF
            */
            if($facturar == "ok"){

                //var_dump($tipo);
                //var_dump($docDestino);
                //var_dump($nombre_tipo);
                //var_dump($codigo);
                //var_dump($usuario);

                $datosV = array(    "tipo_ori" => "S01",
                                    "tipo" => $tipo,
                                    "documento" => $docDestino,
                                    "tipo_documento" => $nombre_tipo,
                                    "doc_origen" => $codigo,
                                    "usuario" => $usuario);
                //var_dump($datosV);

                $facturarV = ModeloFacturacion::mdlFacturarGuiaV($datosV);
                //$facturarV = "ok";
                //var_dump($facturar);

                if($facturarV == "ok"){

                    $estado = ModeloFacturacion::mdlActualizarGuiaF($codigo);
                    //var_dump($estado);

                    if($estado == "ok"){

                        $codCta = $docDestino;
                        //var_dump($codCta);
                        $tipoDoc = $tipo;

                        $respuestaDoc = ModeloFacturacion::mdlMostraVentaDocumento($codCta, $tipoDoc);
                        //var_dump($respuestaDoc);

                        $cliente = $respuestaDoc["cliente"];
                        //var_dump($cliente);
                        $vendedor = $respuestaDoc["vendedor"];
                        //var_dump($vendedor);

                        date_default_timezone_set("America/Lima");
                        $fecha = date("Y-m-d");
                        //var_dump($fecha);
                        $dias = $respuestaDoc["dias"];
                        //var_dump($dias);
                        $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                        //var_dump($fecha_ven);

                        $monto = $respuestaDoc["total"];
                        //var_dump($monto);
                        $saldo = $respuestaDoc["total"];
                        //var_dump($saldo);

                        $cod_pago = $tipoCta;
                        //var_dump($cod_pago);

                        $datosCta = array(  "tipo_doc" => $tipoCta,
                                            "num_cta" => $docDestino,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo);
                        //var_dump($datosCta);

                        $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datosCta);
                        //var_dump($ctacte);

                        if($ctacte == "ok"){

                            echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero la '.$nombre_tipo.' N° '.$docDestino.'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "guias-remision";

                                            }
                                        })

                            </script>';

                        }

                    }

                }

            }

        }

    }

    /* 
    * FACTURAR DESDE GUIA
    */
    static public function ctrFacturarB(){

        if(isset($_POST["codPedidoB"])){

            $codigo = $_POST["codPedidoB"];
            //var_dump($codigo);
            $doc = $_POST["serieSeparadoB"];
            $docDestino = str_replace ( '-', '', $doc);
            //var_dump($docDestino);
            $tip_dest = substr($docDestino, 0, 1);
            //var_dump($tip_dest);
            date_default_timezone_set("America/Lima");
            $fecha = date("Y-m-d");
            //var_dump($fecha);
            $tipo_origen = "S01";
            //var_dump($tipo_origen);
            $usuario = $_POST["idUsuarioB"];
            //var_dump($usuario);

            $serie = substr($docDestino, 0, 4);;
            //var_dump($serie);

            if($tip_dest == "F"){

                $tipo = "S03";
                //var_dump($tipo);
                $tipoCta = '01';
                //var_dump($tipoCta);
                $nombre_tipo="FACTURA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioFactura($serie);
                //var_dump("factura", $talonario);

            }else{

                $tipo = "S02";
                //var_dump($tipo);
                $tipoCta = '03';
                //var_dump($tipoCta);
                $nombre_tipo="BOLETA";
                //var_dump($nombre_tipo);

                $talonario = ModeloFacturacion::mdlActualizarTalonarioBoleta($serie);
                //var_dump("boleta", $talonario);

            }

                /*
                todo GENERAMOS EN MOVIMIENTOS
                */
                $datos = array( "tipo" => $tipo,
                                "documento" => $docDestino,
                                "fecha" => $fecha,
                                "nombre_tipo" => $nombre_tipo,
                                "codigo" => $codigo,
                                "tipo_documento" => $tipo_origen);
                //var_dump($datos);

                $facturar = ModeloFacturacion::mdlFacturarGuiaM($datos);
                //var_dump($facturar);

                /*
                todo REGISTRAMOS EN VENTAJF
                */
                if($facturar == "ok"){

                    $datosV = array(    "tipo_ori" => "S01",
                                        "tipo" => $tipo,
                                        "documento" => $docDestino,
                                        "tipo_documento" => $nombre_tipo,
                                        "doc_origen" => $codigo,
                                        "usuario" => $usuario);
                    //var_dump($datosV);

                    $facturarV = ModeloFacturacion::mdlFacturarGuiaV($datosV);
                    //var_dump($facturarV);

                    if($facturarV == "ok"){

                        $estado = ModeloFacturacion::mdlActualizarGuiaF($codigo);
                        //var_dump($estado);

                        if($estado == "ok"){

                            $codCta = $docDestino;
                            //var_dump($codCta);
                            $tipoDoc = $tipo;

                            $respuestaDoc = ModeloFacturacion::mdlMostraVentaDocumento($codCta, $tipoDoc);
                            //var_dump($respuestaDoc);

                            $cliente = $respuestaDoc["cliente"];
                            //var_dump($cliente);
                            $vendedor = $respuestaDoc["vendedor"];
                            //var_dump($vendedor);

                            date_default_timezone_set("America/Lima");
                            $fecha = date("Y-m-d");
                            //var_dump($fecha);
                            $dias = $respuestaDoc["dias"];
                            //var_dump($dias);
                            $fecha_ven = date("Y-m-d",strtotime($fecha."+ ".$dias." day"));
                            //var_dump($fecha_ven);

                            $monto = $respuestaDoc["total"];
                            //var_dump($monto);
                            $saldo = $respuestaDoc["total"];
                            //var_dump($saldo);

                            $cod_pago = $tipoCta;
                            //var_dump($cod_pago);

                            $datosCta = array(  "tipo_doc" => $tipoCta,
                                                "num_cta" => $docDestino,
                                                "cliente" => $cliente,
                                                "vendedor" => $vendedor,
                                                "fecha_ven" => $fecha_ven,
                                                "monto" => $monto,
                                                "cod_pago" => $cod_pago,
                                                "usuario" => $usuario,
                                                "saldo" => $saldo);
                            //var_dump($datosCta);

                            $ctacte = ModeloFacturacion::mdlGenerarCtaCte($datosCta);
                            //var_dump($ctacte);

                            if($ctacte == "ok"){

                                echo'<script>

                                swal({
                                        type: "success",
                                        title: "Se Genero la '.$nombre_tipo.' N° '.$docDestino.'",
                                        showConfirmButton: true,
                                        confirmButtonText: "Cerrar"
                                }).then(function(result){
                                                if (result.value) {

                                                window.location = "guias-remision";

                                                }
                                            })

                                </script>';

                            }

                        }

                    }

                }


        }

    }

}