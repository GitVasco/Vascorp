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

                $respuestaFactura = ModeloArticulos::mdlActualizarStockPedido($_POST["codPedido"]);
                //var_dump($respuestaFactura);

                /*
                todo: registrar en movimientos
                */
                if($respuestaFactura == "ok"){

                    $documento = $_POST["serie"];
                    $doc = str_replace ( '-', '', $documento);
                    #var_dump($doc);

                    $cliente = $_POST["codCli"];
                    #var_dump($cliente);

                    $vendedor = $_POST["codVen"];
                    #var_dump($vendedor);

                    $dscto = $_POST["dscto"];
                    #var_dump($dscto);

                    $tipo = "S01";
                    $nombre_tipo = "GUIA REMISION";

                    date_default_timezone_set("America/Lima");
                    $fecha = date("Y-m-d");

                    $intoA = "";
                    $intoB = "";
                    foreach ($respuesta as $key => $value) {

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        if($key < count($respuesta)-1){

                            $intoA .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."'),";

                        }else{

                            $intoB .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."')";

                        }
                        
                    }

                    $detalle = $intoA.$intoB;
                    #var_dump("detalle", $detalle);

                    $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($detalle);
                    #var_dump($respuestaMovimientos);                 

                }                

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

                    $usureg = $_SESSION["nombre"];
                    $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                        

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
                                    "tipo_documento" => "GUIA REMISION",
                                    "usureg" => $usureg,
                                    "pcreg" => $pcreg);
                    //var_dump($datosD);

                    $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);
                    #var_dump($respuestaDocumento);

                }

                /*
                todo: SUMAR 1 AL DOCUMENTO
                */
                if($respuestaDocumento == "ok"){

                    $documento = $_POST["serie"];
                    $serie = substr($documento,0,3);
                    #var_dump($serie);

                    $talonario = ModeloFacturacion::mdlActualizarTalonarioGuia($serie);
                    #var_dump($talonario); 

                }

                /*
                todo: CAMBIAR EL ESTADO DEL PEDIDO
                */
                if($talonario == "ok"){

                    $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);
                    $estadoB = ModeloFacturacion::mdlActualizarPedidoB($_POST["codPedido"]);

                    //var_dump($estado);

                    if($estado == "ok"){

                        echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero la Guia de Remisión '.$documento.'",
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

            //* FACTURA S03
            else if($_POST["tdoc"] == "01"){

                /*
                todo: BAJAR EL STOCK y CANT EN PEDIDO
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                $respuestaFactura = ModeloArticulos::mdlActualizarStockPedido($_POST["codPedido"]);
                //var_dump($respuestaFactura);

                /*
                todo: registrar en movimientos
                */
                if($respuestaFactura == "ok"){

                    $documento = $_POST["serie"];
                    $doc = str_replace ( '-', '', $documento);
                    #var_dump($doc);

                    $cliente = $_POST["codCli"];
                    #var_dump($cliente);

                    $vendedor = $_POST["codVen"];
                    #var_dump($vendedor);

                    $dscto = $_POST["dscto"];
                    #var_dump($dscto);

                    $tipo = "S03";
                    $nombre_tipo = "FACTURA";

                    date_default_timezone_set("America/Lima");
                    $fecha = date("Y-m-d");

                    $intoA = "";
                    $intoB = "";
                    foreach ($respuesta as $key => $value) {

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        if($key < count($respuesta)-1){

                            $intoA .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."'),";

                        }else{

                            $intoB .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."')";

                        }
                        
                    }

                    $detalle = $intoA.$intoB;
                    #var_dump("detalle", $detalle);

                    $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($detalle);
                    #var_dump($respuestaMovimientos);                 

                }

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

                    $usureg = $_SESSION["nombre"];
                    $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                        

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
                                    "tipo_documento" => "FACTURA",
                                    "usureg" => $usureg,
                                    "pcreg" => $pcreg);
                    //var_dump($datosD);

                    $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);
                    #var_dump($respuestaDocumento);

                }

                /*
                todo: SUMAR 1 AL DOCUMENTO
                */
                if($respuestaDocumento == "ok"){

                    $documento = $_POST["serie"];
                    $serie = substr($documento,0,4);
                    //var_dump($serie);

                    $talonario = ModeloFacturacion::mdlActualizarTalonarioFactura($serie);
                    #var_dump($talonario); 

                }

                /*
                todo: CAMBIAR EL ESTADO DEL PEDIDO
                */
                if($talonario == "ok"){

                    $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);
                    $estadoB = ModeloFacturacion::mdlActualizarPedidoB($_POST["codPedido"]);
                    ModeloPedidos::mdlReiniciarTalonario($_POST["tdoc"]);

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

                        $usureg = $_SESSION["nombre"];
                        $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);  

                        $datos = array( "tipo_doc" => $tipo_doc,
                                        "num_cta" => $doc,
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "fecha_ven" => $fecha_ven,
                                        "monto" => $monto,
                                        "cod_pago" => $cod_pago,
                                        "usuario" => $usuario,
                                        "saldo" => $saldo,
                                        "usureg" => $usureg,
                                        "pcreg" => $pcreg);
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

            //* BOLETA S01
            else if($_POST["tdoc"] == "03"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                $respuestaBoleta = ModeloArticulos::mdlActualizarStockPedido($_POST["codPedido"]);
                //var_dump($respuestaBoleta);

                /*
                todo: registrar en movimientos
                */
                if($respuestaBoleta == "ok"){

                    $documento = $_POST["serie"];
                    $doc = str_replace ( '-', '', $documento);
                    #var_dump($doc);

                    $cliente = $_POST["codCli"];
                    #var_dump($cliente);

                    $vendedor = $_POST["codVen"];
                    #var_dump($vendedor);

                    $dscto = $_POST["dscto"];
                    #var_dump($dscto);

                    $tipo = "S02";
                    $nombre_tipo = "BOLETA";

                    date_default_timezone_set("America/Lima");
                    $fecha = date("Y-m-d");

                    $intoA = "";
                    $intoB = "";
                    foreach ($respuesta as $key => $value) {

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        if($key < count($respuesta)-1){

                            $intoA .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."'),";

                        }else{

                            $intoB .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."')";

                        }
                        
                    }

                    $detalle = $intoA.$intoB;
                    #var_dump("detalle", $detalle);

                    $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($detalle);
                    #var_dump($respuestaMovimientos);                 

                }

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

                    $usureg = $_SESSION["nombre"];
                    $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                        

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
                                    "tipo_documento" => "BOLETA",
                                    "usureg" => $usureg,
                                    "pcreg" => $pcreg);
                    //var_dump($datosD);

                    $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);
                    #var_dump($respuestaDocumento);

                }

                /*
                todo: SUMAR 1 AL DOCUMENTO
                */
                if($respuestaDocumento == "ok"){

                    $documento = $_POST["serie"];
                    $serie = substr($documento,0,4);
                    //var_dump($serie);

                    $talonario = ModeloFacturacion::mdlActualizarTalonarioBoleta($serie);
                    #var_dump($talonario); 

                }

                /*
                todo: CAMBIAR EL ESTADO DEL PEDIDO
                */
                if($talonario == "ok"){

                    $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);
                    $estadoB = ModeloFacturacion::mdlActualizarPedidoB($_POST["codPedido"]);
                    ModeloPedidos::mdlReiniciarTalonario($_POST["tdoc"]);

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

                        $usureg = $_SESSION["nombre"];
                        $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);  

                        $datos = array( "tipo_doc" => $tipo_doc,
                                        "num_cta" => $doc,
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "fecha_ven" => $fecha_ven,
                                        "monto" => $monto,
                                        "cod_pago" => $cod_pago,
                                        "usuario" => $usuario,
                                        "saldo" => $saldo,
                                        "usureg" => $usureg,
                                        "pcreg" => $pcreg);
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

            //*PROFORMA S70
            else if($_POST["tdoc"] == "09"){

                /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                $respuestaProforma = ModeloArticulos::mdlActualizarStockPedido($_POST["codPedido"]);
                //var_dump($respuestaProforma);

                /*
                todo: registrar en movimientos
                */
                if($respuestaProforma == "ok"){

                    $documento = $_POST["serie"];
                    $doc = str_replace ( '-', '', $documento);
                    #var_dump($doc);

                    $cliente = $_POST["codCli"];
                    #var_dump($cliente);

                    $vendedor = $_POST["codVen"];
                    #var_dump($vendedor);

                    $dscto = $_POST["dscto"];
                    #var_dump($dscto);

                    $tipo = "S70";
                    $nombre_tipo = "PROFORMA";

                    date_default_timezone_set("America/Lima");
                    $fecha = date("Y-m-d");

                    $intoA = "";
                    $intoB = "";
                    foreach ($respuesta as $key => $value) {

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        if($key < count($respuesta)-1){

                            $intoA .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."'),";

                        }else{

                            $intoB .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."')";

                        }
                        
                    }

                    $detalle = $intoA.$intoB;
                    #var_dump("detalle", $detalle);

                    $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($detalle);
                    #var_dump($respuestaMovimientos);                 

                }

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

                    $usureg = $_SESSION["nombre"];
                    $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                        

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
                                    "tipo_documento" => "PROFORMA",
                                    "usureg" => $usureg,
                                    "pcreg" => $pcreg);
                    //var_dump($datosD);

                    $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);
                    #var_dump($respuestaDocumento);

                }

                /*
                todo: SUMAR 1 AL DOCUMENTO
                */
                if($respuestaDocumento == "ok"){

                    $documento = $_POST["serie"];
                    $serie = substr($documento,0,3);
                    //var_dump($serie);

                    $talonario = ModeloFacturacion::mdlActualizarTalonarioProforma($serie);
                    #var_dump($talonario); 

                }

                /*
                todo: CAMBIAR EL ESTADO DEL PEDIDO
                */
                if($talonario == "ok"){

                    $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);
                    $estadoB = ModeloFacturacion::mdlActualizarPedidoB($_POST["codPedido"]);
                    $reserva = ModeloPedidos::mdlReiniciarTalonario($_POST["tdoc"]);
                    var_dump($reserva);

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

                        $usureg = $_SESSION["nombre"];
                        $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);  

                        $datos = array( "tipo_doc" => $tipo_doc,
                                        "num_cta" => $doc,
                                        "cliente" => $cliente,
                                        "vendedor" => $vendedor,
                                        "fecha_ven" => $fecha_ven,
                                        "monto" => $monto,
                                        "cod_pago" => $cod_pago,
                                        "usuario" => $usuario,
                                        "saldo" => $saldo,
                                        "usureg" => $usureg,
                                        "pcreg" => $pcreg);
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
            
            //*NOTA DE CREDITO E05
            else{

               /*
                todo: BAJAR EL STOCK
                */
                $tabla = "detalle_temporal";

                $respuesta = ModeloPedidos::mdlMostraDetallesTemporal($tabla, $_POST["codPedido"]);
                //var_dump($respuesta);

                $respuestaNota = ModeloArticulos::mdlActualizarStockPedidoB($_POST["codPedido"]);
                //var_dump($respuestaNota);

                /*
                todo: registrar en movimientos
                */
                if($respuestaNota == "ok"){

                    $documento = $_POST["serie"];
                    $doc = str_replace ( '-', '', $documento);
                    #var_dump($doc);

                    $cliente = $_POST["codCli"];
                    #var_dump($cliente);

                    $vendedor = $_POST["codVen"];
                    #var_dump($vendedor);

                    $dscto = $_POST["dscto"];
                    #var_dump($dscto);

                    $tipo = "E05";
                    $nombre_tipo = "NTCD";

                    date_default_timezone_set("America/Lima");
                    $fecha = date("Y-m-d");

                    $intoA = "";
                    $intoB = "";
                    foreach ($respuesta as $key => $value) {

                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        if($key < count($respuesta)-1){

                            $intoA .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',-".$value["cantidad"].",".$value["precio"].",0,".$dscto.",-".$total.",'".$nombre_tipo."'),";

                        }else{

                            $intoB .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',-".$value["cantidad"].",".$value["precio"].",0,".$dscto.",-".$total.",'".$nombre_tipo."')";

                        }
                        
                    }

                    $detalle = $intoA.$intoB;
                    #var_dump("detalle", $detalle);

                    $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($detalle);
                    #var_dump($respuestaMovimientos);                 

                }

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

                    $usureg = $_SESSION["nombre"];
                    $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                        

                    $datosD = array("tipo" => "E05",
                                    "documento" => $doc,
                                    "neto" => "-".$respuestaDoc["op_gravada"],
                                    "igv" => "-".$respuestaDoc["igv"],
                                    "dscto" => "-".$respuestaDoc["descuento_total"],
                                    "total" => "-".$respuestaDoc["total"],
                                    "cliente" => $respuestaDoc["cod_cli"],
                                    "vendedor" => $respuestaDoc["vendedor"],
                                    "agencia" => $respuestaDoc["agencia"],
                                    "lista_precios" => $respuestaDoc["lista"],
                                    "condicion_venta" => $respuestaDoc["condicion_venta"],
                                    "doc_destino" => $docDest,
                                    "doc_origen" => $docOrigen,
                                    "usuario" => $usuario,
                                    "tipo_documento" => "NC",
                                    "usureg" => $usureg,
                                    "pcreg" => $pcreg);
                    //var_dump($datosD);

                    $respuestaDocumento = ModeloFacturacion::mdlRegistrarDocumento($datosD);
                    #var_dump($respuestaDocumento);

                }    

                /*
                todo: SUMAR 1 AL DOCUMENTO
                */
                if($respuestaDocumento == "ok"){

                    $documento = $_POST["serie"];
                    $serie = substr($documento,0,4);
                    //var_dump($serie);

                    $talonario = ModeloFacturacion::mdlActualizarNotaSerie("nota_credito","serie_nc",$serie);
                    //var_dump($talonario);

                }    
                
                /*
                todo: CAMBIAR EL ESTADO DEL PEDIDO
                */
                if($talonario == "ok"){

                    $estado = ModeloFacturacion::mdlActualizarPedidoF($_POST["codPedido"]);
                    $estadoB = ModeloFacturacion::mdlActualizarPedidoB($_POST["codPedido"]);

                    //var_dump($estado);

                    if($estado == "ok"){

                        $documento = $_POST["serie"];
                        $doc = str_replace ( '-', '', $documento);

                        $tip_nota = $_POST["tdocorigen"];
                        
                        $origen_venta = $_POST["serieOrigen"];
                        
                        $fecha_origen = $_POST["fechaOrigen"];

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $arregloNota = array("tipo"=>'E05',
                                            "documento"=>$doc,
                                            "tipo_doc"=>$tip_nota,
                                            "doc_origen"=>$origen_venta,
                                            "fecha_origen"=>$fecha_origen,
                                            "motivo"=> $_POST["notaMotivo"],
                                            "tip_cont"=>'NTCD',
                                            "observacion"=>'',
                                            "usuario"=>$usuario);

                        $notaCredito = ModeloFacturacion::mdlIngresarNotaCD($arregloNota);
                        //var_dump($ctacte);

                        if($notaCredito == "ok"){

                            echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero la Nota cred. '.$documento.'",
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

            ModeloPedidos::mdlCantAprobados();
            

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

    /*
    * MOSTRAR CABECERA DE TEMPORAL
    */
	static public function ctrMostrarTablasB(){

		$respuesta = ModeloFacturacion::mdlMostrarTablasB();

		return $respuesta;

    }    

    /*
    * MOSTRAR talonarios credito
    */
	static public function ctrMostrarTalonarios($item, $valor){
        $tabla="talonariosjf";
		$respuesta = ModeloFacturacion::mdlMostrarTalonarios($tabla, $item, $valor);

		return $respuesta;

    }

    /*
    * MOSTRAR talonarios debito
    */
	static public function ctrMostrarTalonariosDebito($item, $valor){
        $tabla="talonariosjf";
		$respuesta = ModeloFacturacion::mdlMostrarTalonariosDebito($tabla, $item, $valor);

		return $respuesta;

    }


    /*
    * MOSTRAR RANGO DE FECHAS DE NOTAS DE VENTA CREDITO/DEBITO
    */
	static public function ctrRangoFechasNotasCD($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasNotasCD( $fechaInicial, $fechaFinal);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHAS DE FACTURAS
    */
	static public function ctrRangoFechasFacturas($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasFacturas( $fechaInicial, $fechaFinal);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHA DE BOLETAS
    */
	static public function ctrRangoFechasBoletas($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasBoletas( $fechaInicial, $fechaFinal);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHA DE PROFORMAS
    */
	static public function ctrRangoFechasProformas($fechaInicial, $fechaFinal){
		$respuesta = ModeloFacturacion::mdlRangoFechasProformas( $fechaInicial, $fechaFinal);

		return $respuesta;

    }

     /*
    * MOSTRAR RANGO DE FECHA DE PROCESAR COMPROBANTES ELECTRONICOS
    */
	static public function ctrRangoFechasProcesarCE($fechaInicial, $fechaFinal,$tipo){
		$respuesta = ModeloFacturacion::mdlRangoFechasProcesarCE( $fechaInicial, $fechaFinal,$tipo);

		return $respuesta;

    }

     /*
    * MOSTRAR NOTAS DE DEBITO PARA IMPRESION
    */
	static public function ctrMostrarDebitoImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarDebitoImpresion( $documento, $tipo);

		return $respuesta;

    }

    /*
    * MOSTRAR VENTA DE NOTAS PARA IMPRESION
    */
	static public function ctrMostrarVentaImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarVentaImpresion( $documento, $tipo);

		return $respuesta;

    }

    /*
    * MOSTRAR VENTA DE NOTAS PARA IMPRESION
    */
	static public function ctrMostrarCreditoImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarCreditoImpresion( $documento, $tipo);

		return $respuesta;

    }
    
    /*
    * MOSTRAR MODELO DE NOTAS PARA IMPRESION
    */
	static public function ctrMostrarModeloImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarModeloImpresion( $documento, $tipo);

		return $respuesta;

    }

    /*
    * MOSTRAR MODELO DE PROFORMAS PARA IMPRESION
    */
	static public function ctrMostrarModeloProforma($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarModeloProforma( $documento, $tipo);

		return $respuesta;

    }


    /*
    * MOSTRAR UNIDADES DE BOLETA Y FACTURA PARA IMPRESION
    */
	static public function ctrMostrarUnidadesImpresion($documento, $tipo){
		$respuesta = ModeloFacturacion::mdlMostrarUnidadesImpresion( $documento, $tipo);

		return $respuesta;

    }


    /*
    * MOSTRAR REPORTE DE VENTA POR RESUMEN
    */
	static public function ctrMostrarVentaResumen($optipo, $opdocumento, $impuesto , $vend, $inicio, $fin){
		$respuesta = ModeloFacturacion::mdlMostrarVentaResumen( $optipo, $opdocumento, $impuesto, $vend, $inicio, $fin);

		return $respuesta;

    }

    /*
    * MOSTRAR REPORTE POR TIPO DE VENTA POR RESUMEN
    */
	static public function ctrMostrarTipoVentaResumen($optipo, $opdocumento, $impuesto , $vend, $inicio, $fin){
		$respuesta = ModeloFacturacion::mdlMostrarTipoVentaResumen( $optipo, $opdocumento, $impuesto, $vend, $inicio, $fin);

		return $respuesta;

    }

    /*
    * MOSTRAR REPORTE DE VENTA DETALLADO
    */
	static public function ctrMostrarVentaDetalle($optipo, $opdocumento, $impuesto , $vend, $inicio, $fin){
		$respuesta = ModeloFacturacion::mdlMostrarVentaDetalle( $optipo, $opdocumento, $impuesto, $vend, $inicio, $fin);

		return $respuesta;

    }

    /*
    * MOSTRAR REPORTE POR TIPO DE VENTA DETALLADO
    */
	static public function ctrMostrarTipoVentaDetalle($optipo, $opdocumento, $impuesto , $vend, $inicio, $fin){
		$respuesta = ModeloFacturacion::mdlMostrarTipoVentaDetalle( $optipo, $opdocumento, $impuesto, $vend, $inicio, $fin);

		return $respuesta;

    }


    /*
    * MOSTRAR REPORTE DE VENTA POR POSTAL RESUMEN
    */
	static public function ctrMostrarVentaPostalRsm($optipo, $opdocumento, $impuesto , $vend, $inicio, $fin){
		$respuesta = ModeloFacturacion::mdlMostrarVentaPostalRsm( $optipo, $opdocumento, $impuesto, $vend, $inicio, $fin);

		return $respuesta;

    }
    /*
    * MOSTRAR REPORTE POR TIPO DE VENTA  POSTAL RESUMEN
    */
    static public function ctrMostrarTipoVentaPostalRsm($optipo, $opdocumento,$impuesto,$vend,$inicio,$fin){

        $respuesta = ModeloFacturacion::mdlMostrarTipoVentaPostalRsm($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin);

        return $respuesta;
    }

    /*
    * MOSTRAR REPORTE DE VENTA POR POSTAL DETALLE
    */
    static public function ctrMostrarVentaPostalDet($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

        $respuesta = ModeloFacturacion::mdlMostrarVentaPostalDet($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin);

        return $respuesta;
    }

    static public function ctrMostrarTipoVentaPostalDet($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){
        
        $respuesta = ModeloFacturacion::mdlMostrarTipoVentaPostalDet($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin);

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

                $usureg = $_SESSION["nombre"];
                $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                
                
                $datosV = array(    "tipo_ori" => "S01",
                                    "tipo" => $tipo,
                                    "documento" => $docDestino,
                                    "tipo_documento" => $nombre_tipo,
                                    "doc_origen" => $codigo,
                                    "usuario" => $usuario,
                                    "usureg" => $usureg,
                                    "pcreg" => $pcreg);
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

                        $usureg = $_SESSION["nombre"];
                        $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);                           

                        $datosCta = array(  "tipo_doc" => $tipoCta,
                                            "num_cta" => $docDestino,
                                            "cliente" => $cliente,
                                            "vendedor" => $vendedor,
                                            "fecha_ven" => $fecha_ven,
                                            "monto" => $monto,
                                            "cod_pago" => $cod_pago,
                                            "usuario" => $usuario,
                                            "saldo" => $saldo,
                                            "usureg" => $usureg,
                                            "pcreg" => $pcreg);
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

                    $usureg = $_SESSION["nombre"];
                    $pcreg= gethostbyaddr($_SERVER['REMOTE_ADDR']);   

                    $datosV = array(    "tipo_ori" => "S01",
                                        "tipo" => $tipo,
                                        "documento" => $docDestino,
                                        "tipo_documento" => $nombre_tipo,
                                        "doc_origen" => $codigo,
                                        "usuario" => $usuario,
                                        "usureg" => $usureg,
                                        "pcreg" => $pcreg);
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
                                                "saldo" => $saldo,
                                                "usureg" => $usureg,
                                                "pcreg" => $pcreg);
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


    static public function ctrFacturarSalida(){

        if(isset($_POST["codSalida"])){


                /*
                todo: BAJAR o subir EL STOCK
                */
                $tabla = "detalle_ing_sal";

                $respuesta = ModeloSalidas::mdlMostraDetallesTemporal($tabla, $_POST["codSalida"]);
                //var_dump($respuesta);

                foreach($respuesta as $value){

                    $datos = array( "articulo" => $value["articulo"],
                                    "cantidad" => $value["cantidad"]);
                    #var_dump($datos);
                    $inicioTipo = substr($_POST["tdoc"],0,1);
                    if($inicioTipo == 'E'){
                        $respuestaGuia = ModeloArticulos::mdlActualizarStockIngreso($value["articulo"],$value["cantidad"]);
                    }else{
                        $respuestaGuia = ModeloArticulos::mdlActualizarStock($datos);
                    }
                    
                    #var_dump($respuestaGuia);

                }

                //var_dump($respuestaGuia);

                #$respuestaGuia="ok";

                /*
                todo: registrar en movimientos
                */
                if($respuestaGuia == "ok"){

                    $intoA = "";
                    $intoB = "";
                    foreach($respuesta as $key => $value){

                        $tipo= $_POST["tdoc"];

                        $documento = $_POST["serieSalida"];
                        $doc = $tipo.$documento;
                        //var_dump($doc);

                        $cliente = $_POST["codCli"];
                        //var_dump($cliente);

                        $vendedor = $_POST["codVen"];
                        //var_dump($vendedor);

                        $dscto = 0;
                        //var_dump($dscto);

                        date_default_timezone_set("America/Lima");
                        $fecha = date("Y-m-d");
                        $nombre_tipo = "AJUSTES DE INV.";


                        $total = $value["cantidad"] * $value["precio"] * ((100 - $dscto)/100);
                        //var_dump($total);

                        if($key < count($respuesta)-1){

                            $intoA .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."'),";

                        }else{

                            $intoB .= "('".$tipo."','".$doc."','".$fecha."','".$value["articulo"]."','".$cliente."','".$vendedor."',".$value["cantidad"].",".$value["precio"].",0,".$dscto.",".$total.",'".$nombre_tipo."')";

                        }

                    }

                    $detalle = $intoA.$intoB;
                    #var_dump("detalle", $detalle);

                    $respuestaMovimientos = ModeloFacturacion::mdlRegistrarMovimientos($detalle);
                    #var_dump($respuestaMovimientos);   
                    //var_dump($respuestaMovimientos);

                    /*
                    todo: registrar en ventajf
                    */
                    if($respuestaMovimientos == "ok"){

                        $respuestaDoc = ModeloSalidas::mdlMostrarSalidasCabecera($_POST["codSalida"]);
                        //var_dump($respuestaDoc);

                        $tipo= $_POST["tdoc"];

                        $documento = $_POST["serieSalida"];
                        $doc = $tipo.$documento;
                        //var_dump($doc);

                        $usuario = $_POST["idUsuario"];
                        //var_dump($usuario);

                        $docOrigen = $_POST["codSalida"];
                        //var_dump("$docOrigen");

                        $docDestino = $_POST["serieSeparado"];
                        $docDest = str_replace ( '-', '', $docDestino);
                        //var_dump($docDest);

                        $datosD = array("tipo" => $tipo,
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
                                        "tipo_documento" => $_POST["nomTipo"]);
                        //var_dump($datosD);

                        $respuestaDocumento = ModeloSalidas::mdlRegistrarDocumentoSalida($datosD);

                    }

                    var_dump($respuestaDocumento);

                    /* 
                    todo: SUMAR 1 AL DOCUMENTO
                    */
                    if($respuestaDocumento == "ok"){

                        $serie = $_POST["tdoc"];
                        //var_dump($serie);

                        $talonario = ModeloSalidas::mdlActualizarArgumento($serie);

                    }

                    //var_dump($talonario);

                    /*
                    todo: CAMBIAR EL ESTADO DEL PEDIDO
                    */
                    if($talonario == "ok"){

                        $estado = ModeloSalidas::mdlActualizarSalidaF($_POST["codSalida"]);

                        //var_dump($estado);

                        if($estado == "ok"){

                            echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero el documento '.$documento.'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "salidas-varios";

                                            }
                                        })

                            </script>';

                        }

                    }


                }

            

        }else{

            //var_dump("no");

        }

    }

    static public function ctrCrearFacturaXML(){

        if(isset($_GET["tipoFact"]) && isset($_GET["documentoFact"])){

            $doc = new DOMDocument();
            $doc->formatOutput = FALSE;
            $doc->preserveWhiteSpace = TRUE;
            $doc->encoding = 'utf-8';

            require_once("/../extensiones/cantidad_en_letras.php");
            require_once("/../vistas/generar_xml/signature.php"); // permite firmar xml

            $tipo = $_GET["tipoFact"];

            $documento = $_GET["documentoFact"];
            $venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);

            $modelos = ControladorFacturacion::ctrMostrarModeloImpresion($documento,$tipo);

            $unidad= ControladorFacturacion::ctrMostrarUnidadesImpresion($documento,$tipo);
            // var_dump($modelos);

            if($tipo == 'S03'){
                $tipcomprobante = '01';
            }else{
                $tipcomprobante = '03';
            }

            $emisor = 	array(
                        'tipodoc'		=> '6',
                        'ruc' 			=> '20513613939', 
                        'nombre_comercial'=> 'JACKY FORM',
                        'razon_social'	=> 'Corporacion Vasco S.A.C.', 
                        'referencia'	=> 'URB.SANTA LUISA 1RA ETAPA', 
                        'direccion'		=> 'CAL.SANTO TORIBIO NRO. 259',
                        'pais'			=> 'PE', 
                        'departamento'  => 'LIMA',
                        'provincia'		=> 'LIMA',
                        'distrito'		=> 'SAN MARTIN DE PORRES'
                        );


            $cliente = array(
                        'tipodoc'		=> '6',//6->ruc, 1-> dni 
                        'ruc'			=> $venta["dni"], 
                        'razon_social'  => $venta["nombre"], 
                        'cliente'       => $venta["cliente"],
                        'direccion'		=> $venta["direccion"],
                        'pais'			=> 'PE'
                        );	

            $vendedor = array(
                        "codigo"		=> $venta["vendedor"],
                        "nombre"		=> $venta["nom_vendedor"]
                        );

            $comprobante =	array(
                        'tipodoc'		=> $tipcomprobante, //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
                        'serie'			=> substr($venta["documento"],0,4),
                        'correlativo'	=> substr($venta["documento"],4,12),
                        'fecha_emision' => $venta["fecha_emision"],
                        'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
                        'total_opgravadas'=> 0, //OP. GRAVADAS
                        'total_opexoneradas'=>0,
                        'total_opinafectas'=>0,
                        'igv'			=> 0,
                        'total'			=> 0,
                        'total_texto'	=> ''
                    );



            $op_gravadas = 0;
            $op_inafectas = 0;
            $op_exoneradas = 0;

            $comprobante['total_opgravadas'] = $venta["neto"];
            $comprobante['total_opexoneradas'] = $op_exoneradas;
            $comprobante['total_opinafectas'] = $op_inafectas;
            $comprobante['igv'] = $venta["igv"];
            $comprobante['total'] = $venta["total"];
            $comprobante['total_texto'] = CantidadEnLetra($venta["total"]);
            $totalSinIGV= $venta["total"] - $venta["igv"];

            $serieGuia=substr($venta["origen2"],0,4);
            $correlativoGuia=substr($venta["origen2"],4,12);

            //RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
            //01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
            $nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

            $ruta = "vistas/generar_xml/archivos_xml/".$nombrexml;

            $tipoCliente = $cliente["ruc"];


            if(strlen($tipoCliente) == 8){
                $tipodoc='1';
            }else{
                $tipodoc='6';
            }
        
            $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <Invoice xmlns="urn:oasis:names:specification:ubl:schema:xsd:Invoice-2"
            xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2"
            xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2"
            xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
            <ext:UBLExtensions>';
                if($venta["dscto"] > 0){
                    $xml.='<ext:UBLExtension>
                    <ext:ExtensionContent>
                        <cbc:TotalDiscount>'.$venta["dscto"].'</cbc:TotalDiscount>
                    </ext:ExtensionContent>
                </ext:UBLExtension>';
                }
                
            $xml.='<ext:UBLExtension>
                    <ext:ExtensionContent />
                </ext:UBLExtension>
            </ext:UBLExtensions>
            <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
            <cbc:CustomizationID>2.0</cbc:CustomizationID>
            <cbc:ID>'.$comprobante["serie"].'-'.$comprobante["correlativo"].'</cbc:ID>
            <cbc:IssueDate>'.$comprobante["fecha_emision"].'</cbc:IssueDate>
            <cbc:InvoiceTypeCode listID="0101" listSchemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo51"
                name="Tipo de Operacion">'.$comprobante["tipodoc"].'</cbc:InvoiceTypeCode>
            <cbc:Note languageLocaleID="1000"> '.$comprobante["total_texto"].'</cbc:Note>
            <cbc:Note>Nro.unidades: '.$unidad["cantidad"].'</cbc:Note>
            <cbc:Note languageID="D">'.$cliente["cliente"].'</cbc:Note>
            <cbc:Note languageID="E">CONTADO .</cbc:Note>
            <cbc:Note languageID="F">'.$totalSinIGV.'</cbc:Note>
            <cbc:Note languageID="G">'.$vendedor["codigo"].' '.$vendedor["nombre"].'</cbc:Note>
            <cbc:DocumentCurrencyCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 4217 Alpha"
                listName="Currency">PEN</cbc:DocumentCurrencyCode>
            <cbc:LineCountNumeric>'.count($modelo).'</cbc:LineCountNumeric>
            <cac:DespatchDocumentReference>
                <cbc:ID>'.$serieGuia.'-'.$correlativoGuia.'</cbc:ID>
                <cbc:DocumentTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento"
                    listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01">09</cbc:DocumentTypeCode>
            </cac:DespatchDocumentReference>
            <cac:Signature>
                <cbc:ID>IDSignKG</cbc:ID>
                <cac:SignatoryParty>
                    <cac:PartyIdentification>
                        <cbc:ID>'.$emisor["ruc"].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name>'.$emisor["razon_social"].'</cbc:Name>
                    </cac:PartyName>
                </cac:SignatoryParty>
                <cac:DigitalSignatureAttachment>
                    <cac:ExternalReference>
                        <cbc:URI>#SignST</cbc:URI>
                    </cac:ExternalReference>
                </cac:DigitalSignatureAttachment>
            </cac:Signature>
            <cac:AccountingSupplierParty>
                <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="6" schemeName="Documento de Identidad"
                            schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$emisor["ruc"].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name>'.$emisor["nombre_comercial"].'</cbc:Name>
                    </cac:PartyName>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName>'.$emisor["razon_social"].'</cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">0002
                            </cbc:AddressTypeCode>
                            <cbc:CitySubdivisionName>'.$emisor["referencia"].'</cbc:CitySubdivisionName>
                            <cbc:CityName>'.$emisor["provincia"].'</cbc:CityName>
                            <cbc:CountrySubentity>'.$emisor["departamento"].'</cbc:CountrySubentity>
                            <cbc:District>'.$emisor["distrito"].'</cbc:District>
                            <cac:AddressLine>
                                <cbc:Line>'.$emisor["direccion"].'</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe"
                                    listID="ISO 3166-1" listName="Country">'.$emisor["pais"].'</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:AccountingSupplierParty>
            <cac:AccountingCustomerParty>
                <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="'.$tipodoc.'" schemeName="Documento de Identidad"
                            schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$cliente["ruc"].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name />
                    </cac:PartyName>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName>'.$cliente["razon_social"].'</cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:ID schemeAgencyName="PE:INEI" schemeName="Ubigeos" />
                            <cbc:CitySubdivisionName>-</cbc:CitySubdivisionName>
                            <cbc:CityName />
                            <cbc:CountrySubentity>'.$venta["departamento"].'</cbc:CountrySubentity>
                            <cbc:District />
                            <cac:AddressLine>
                                <cbc:Line>'.$cliente["direccion"].'</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe"
                                    listID="ISO 3166-1" listName="Country">'.$cliente["pais"].'</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                    <cac:Contact>
                        <cbc:ElectronicMail>'.$venta["email"].'</cbc:ElectronicMail>
                    </cac:Contact>
                </cac:Party>
            </cac:AccountingCustomerParty>';
            if($venta["dscto"] > 0){
                $flg_firma = 1; //Posicion del XML: 0 para firma
                $valor_dscto= $comprobante["total_opgravadas"] - $venta["dscto"];
                $xml.='<cac:AllowanceCharge>
                <cbc:ChargeIndicator>false</cbc:ChargeIndicator>
                <cbc:AllowanceChargeReasonCode listAgencyName="PE:SUNAT" listName="Cargo/descuento"
                    listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo53">02</cbc:AllowanceChargeReasonCode>
                <cbc:Amount currencyID="PEN">'.$venta["dscto"].'</cbc:Amount>
            </cac:AllowanceCharge>';
            }else{
                $flg_firma = 0; //Posicion del XML: 0 para firma
                $valor_dscto= $comprobante["total_opgravadas"];
            }
       
       $xml.='<cac:TaxTotal>
                <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["igv"].'</cbc:TaxAmount>
                <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["igv"].'</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cac:TaxScheme>
                            <cbc:ID schemeAgencyID="6" schemeID="UN/ECE 5153">1000</cbc:ID>
                            <cbc:Name>IGV</cbc:Name>
                            <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                </cac:TaxSubtotal>
            </cac:TaxTotal>
            <cac:LegalMonetaryTotal>
                <cbc:LineExtensionAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["total_opgravadas"].'</cbc:LineExtensionAmount>
                <cbc:TaxInclusiveAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["total"].'</cbc:TaxInclusiveAmount>
                <cbc:PayableAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["total"].'</cbc:PayableAmount>
            </cac:LegalMonetaryTotal>';
               
            foreach($modelos as $k=>$v){
              
               $igv = 0.18 * $v["total"];
               $totalIGV = $v["total"]+$igv;
               $precioIGV  = $totalIGV/$v["cantidad"];

        $xml.='<cac:InvoiceLine>
                <cbc:ID>'.($k+1).'</cbc:ID>
                <cbc:Note>'.$v["unidad"].'</cbc:Note>
                <cbc:InvoicedQuantity unitCode="'.$v["unidad"].'" unitCodeListAgencyName="United Nations Economic Commission for Europe"
                    unitCodeListID="UN/ECE rec 20">'.number_format($v["cantidad"],3,".","").'</cbc:InvoicedQuantity>
                <cbc:LineExtensionAmount currencyID="'.$comprobante["moneda"].'">'.$v["total"].'</cbc:LineExtensionAmount>
                <cac:BillingReference>
                    <cac:BillingReferenceLine>
                        <cbc:ID schemeID="AL">37.15</cbc:ID>
                    </cac:BillingReferenceLine>
                </cac:BillingReference>
                <cac:PricingReference>
                    <cac:AlternativeConditionPrice>
                        <cbc:PriceAmount currencyID="'.$comprobante["moneda"].'">'.number_format($precioIGV,2,".","").'</cbc:PriceAmount>
                        <cbc:PriceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Precio"
                            listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
                    </cac:AlternativeConditionPrice>
                </cac:PricingReference>
                <cac:TaxTotal>
                    <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                    <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="'.$comprobante["moneda"].'">'.$v["total"].'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cbc:Percent>18</cbc:Percent>
                            <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV"
                                listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                            <cac:TaxScheme>
                                <cbc:ID schemeAgencyName="PE:SUNAT" schemeName="Codigo de tributos"
                                    schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">1000</cbc:ID>
                                <cbc:Name>IGV</cbc:Name>
                                <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                    </cac:TaxSubtotal>
                </cac:TaxTotal>
                <cac:Item>
                    <cbc:Description>'.$v["nombre"].'</cbc:Description>
                    <cac:SellersItemIdentification>
                        <cbc:ID>'.$v["modelo"].'</cbc:ID>
                    </cac:SellersItemIdentification>
                </cac:Item>
                <cac:Price>
                    <cbc:PriceAmount currencyID="'.$comprobante["moneda"].'">'.$v["precio"].'</cbc:PriceAmount>
                </cac:Price>
            </cac:InvoiceLine>';  	
        }

        $xml.="</Invoice>";

            
        

	    $doc->loadXML($xml);
	    $doc->save($ruta.'.XML');

        //CREAR XML FIRMA

        $objfirma = new Signature();
       
        // $ruta_xml_firmar = $ruta . '.XML'; //es el archivo XML que se va a firmar
        $ruta = $ruta . '.XML';
        $rutacertificado = "vistas/generar_xml/";

        $ruta_firma = $rutacertificado. 'certificado_prueba.pfx'; //ruta del archivo del certicado para firmar
        $pass_firma = 'ceti';
        // $actualizadoEnvio = ModeloFacturacion::mdlActualizarProcesoFacturacion(2,$tipo,$documento);
        $resp = $objfirma->signature_xml($flg_firma, $ruta, $ruta_firma, $pass_firma);

                        echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero el  XML Invoice de '.$venta["documento"].'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "procesar-ce";

                                            }
                                        })

                            </script>';

        }

    }

    static public function ctrCrearNotaCreditoXML(){

        if(isset($_GET["tipoNotaCred"]) && isset($_GET["documentoNotaCred"])){

            $doc = new DOMDocument();
            $doc->formatOutput = FALSE;
            $doc->preserveWhiteSpace = TRUE;
            $doc->encoding = 'utf-8';

            require_once("/../extensiones/cantidad_en_letras.php");
            require_once("/../vistas/generar_xml/signature.php"); // permite firmar xml

            $tipo = $_GET["tipoNotaCred"];

            $documento = $_GET["documentoNotaCred"];

            $inicialOrigen = substr($venta["doc_origen"],0,1);

            if($inicialOrigen == 'B'){
                $tipoOrigen = '03';
            }else{
                $tipoOrigen = '01';
            }

            $venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);

            // var_dump($modelos);
            $emisor = 	array(
                        'tipodoc'		=> '6',
                        'ruc' 			=> '20513613939', 
                        'nombre_comercial'=> 'JACKY FORM',
                        'razon_social'	=> 'Corporacion Vasco S.A.C.', 
                        'referencia'	=> 'URB.SANTA LUISA 1RA ETAPA', 
                        'direccion'		=> 'CAL.SANTO TORIBIO NRO. 259',
                        'pais'			=> 'PE', 
                        'departamento'  => 'LIMA',
                        'provincia'		=> 'LIMA',
                        'distrito'		=> 'SAN MARTIN DE PORRES'
                        );


            $cliente = array(
                        'tipodoc'		=> '6',//6->ruc, 1-> dni 
                        'ruc'			=> $venta["dni"], 
                        'razon_social'  => $venta["nombre"], 
                        'cliente'       => $venta["cliente"],
                        'direccion'		=> $venta["direccion"],
                        'pais'			=> 'PE'
                        );	

            $vendedor = array(
                        "codigo"		=> $venta["vendedor"],
                        "nombre"		=> $venta["nom_vendedor"]
                        );

            $comprobante =	array(
                        'tipodoc'		=> '07', //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
                        'serie'			=> substr($venta["documento"],0,4),
                        'correlativo'	=> substr($venta["documento"],4,12),
                        'fecha_emision' => $venta["fecha_emision"],
                        'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
                        'total_opgravadas'=> 0, //OP. GRAVADAS
                        'total_opexoneradas'=>0,
                        'total_opinafectas'=>0,
                        'igv'			=> 0,
                        'total'			=> 0,
                        'total_texto'	=> ''
                    );



            $op_gravadas = 0;
            $op_inafectas = 0;
            $op_exoneradas = 0;

            $comprobante['total_opgravadas'] = ($venta["neto"]*-1);
            $comprobante['total_opexoneradas'] = $op_exoneradas;
            $comprobante['total_opinafectas'] = $op_inafectas;
            $comprobante['igv'] = ($venta["igv"]*-1);
            $comprobante['total'] = ($venta["total"]*-1);
            $comprobante['total_texto'] = CantidadEnLetra($venta["total"]*-1);
            $totalSinIGV= ($venta["total"]*-1 )-($venta["igv"]*-1);

            $serieInvoice=substr($venta["doc_origen"],0,4);
            $correlativoInvoice=substr($venta["doc_origen"],4,12);

            //RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
            //01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
            $nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

            $ruta = "vistas/generar_xml/archivos_xml/".$nombrexml;

            $tipoCliente = $cliente["ruc"];

            if(strlen($tipoCliente) == 8){
                $tipodoc='1';
            }else{
                $tipodoc='6';
            }

            //TIPO DE MOTIVO SEGUN SUNAT
            if($venta["motivo"] == "C1"){

                $tipoMotivo = "01";

            }else if($venta["motivo"] == "C2"){

                $tipoMotivo = "02";

            }else if($venta["motivo"] == "C3"){

                $tipoMotivo = "03";

            }else if($venta["motivo"] == "C4"){

                $tipoMotivo = "04";

            }else if($venta["motivo"] == "C5"){

                $tipoMotivo = "05";

            }else if($venta["motivo"] == "C6"){

                $tipoMotivo = "06";

            }else if($venta["motivo"] == "C7"){

                $tipoMotivo = "07";

            }else if($venta["motivo"] == "C8"){

                $tipoMotivo = "08";

            }else if($venta["motivo"] == "C9"){

                $tipoMotivo = "09";

            }else{

                $tipoMotivo = "10";

            }

            if($comprobante["serie"] =="F002" || $comprobante["serie"] == "B002"){

                $xml = '<?xml version="1.0" encoding="UTF-8"?>
                <CreditNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
                <ext:UBLExtensions>
                    <ext:UBLExtension>
                        <ext:ExtensionContent />
                    </ext:UBLExtension>
                </ext:UBLExtensions>
                    <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
                    <cbc:CustomizationID>2.0</cbc:CustomizationID>
                    <cbc:ID>'.$comprobante['serie'].'-'.$comprobante['correlativo'].'</cbc:ID>
                    <cbc:IssueDate>'.$comprobante['fecha_emision'].'</cbc:IssueDate>
                    <cbc:Note languageLocaleID="1000"> '.$comprobante["total_texto"].'</cbc:Note>
                    <cbc:Note languageID="D">'.$cliente["cliente"].'</cbc:Note>
                    <cbc:Note languageID="F">'.$totalSinIGV.'</cbc:Note>
                    <cbc:Note languageID="G">'.$vendedor["codigo"].' '.$vendedor["nombre"].'</cbc:Note>
                    <cbc:DocumentCurrencyCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 4217 Alpha" listName="Currency">PEN</cbc:DocumentCurrencyCode>
                    <cbc:LineCountNumeric>1</cbc:LineCountNumeric>
                    <cac:DiscrepancyResponse>
                        <cbc:ReferenceID>'.$serieInvoice."-".$correlativoInvoice.'</cbc:ReferenceID>
                        <cbc:ResponseCode listAgencyName="PE:SUNAT" listName="Tipo de nota de credito" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo09">'.$tipoMotivo.'</cbc:ResponseCode>
                        <cbc:Description>'.ucfirst(strtolower($venta['nom_motivo'])).'</cbc:Description>
                    </cac:DiscrepancyResponse>
                    <cac:BillingReference>
                        <cac:InvoiceDocumentReference>
                            <cbc:ID>'.$serieInvoice."-".$correlativoInvoice.'</cbc:ID>
                            <cbc:IssueDate>'.$venta["fecha_origen"].'</cbc:IssueDate>
                            <cbc:DocumentTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01">'.$tipoOrigen.'</cbc:DocumentTypeCode>
                        </cac:InvoiceDocumentReference>
                    </cac:BillingReference>
                    <cac:Signature>
                        <cbc:ID>IDSignKG</cbc:ID>
                        <cac:SignatoryParty>
                            <cac:PartyIdentification>
                                <cbc:ID>'.$emisor["ruc"].'</cbc:ID>
                            </cac:PartyIdentification>
                            <cac:PartyName>
                                <cbc:Name>'.$emisor["razon_social"].'</cbc:Name>
                            </cac:PartyName>
                        </cac:SignatoryParty>
                        <cac:DigitalSignatureAttachment>
                            <cac:ExternalReference>
                                <cbc:URI>#SignST</cbc:URI>
                            </cac:ExternalReference>
                        </cac:DigitalSignatureAttachment>
                    </cac:Signature>
                    <cac:AccountingSupplierParty>
                        <cac:Party>
                            <cac:PartyIdentification>
                                <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="6" schemeName="Documento de Identidad" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$emisor["ruc"].'</cbc:ID>
                            </cac:PartyIdentification>
                            <cac:PartyName>
                                <cbc:Name>'.$emisor["nombre_comercial"].'</cbc:Name>
                            </cac:PartyName>
                            <cac:PartyLegalEntity>
                                <cbc:RegistrationName>'.$emisor["razon_social"].'</cbc:RegistrationName>
                                <cac:RegistrationAddress>
                                    <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">0002
                                    </cbc:AddressTypeCode>
                                    <cbc:CitySubdivisionName>'.$emisor["referencia"].'</cbc:CitySubdivisionName>
                                    <cbc:CityName>'.$emisor["provincia"].'</cbc:CityName>
                                    <cbc:CountrySubentity>'.$emisor["departamento"].'</cbc:CountrySubentity>
                                    <cbc:District>'.$emisor["distrito"].'</cbc:District>
                                    <cac:AddressLine>
                                        <cbc:Line>'.$emisor["direccion"].'</cbc:Line>
                                    </cac:AddressLine>
                                    <cac:Country>
                                        <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 3166-1" listName="Country">'.$emisor["pais"].'</cbc:IdentificationCode>
                                    </cac:Country>
                                </cac:RegistrationAddress>
                            </cac:PartyLegalEntity>
                        </cac:Party>
                    </cac:AccountingSupplierParty>
                    <cac:AccountingCustomerParty>
                        <cac:Party>
                        <cac:PartyIdentification>
                            <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="'.$tipodoc.'" schemeName="Documento de Identidad"
                            schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$cliente["ruc"].'</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyLegalEntity>
                        <cbc:RegistrationName>'.$cliente["razon_social"].'</cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:ID schemeAgencyName="PE:INEI" schemeName="Ubigeos" />
                            <cbc:CitySubdivisionName>-</cbc:CitySubdivisionName>
                            <cbc:CityName />
                            <cbc:CountrySubentity>'.$venta["departamento"].'</cbc:CountrySubentity>
                            <cbc:District />
                            <cac:AddressLine>
                                <cbc:Line>'.$cliente["direccion"].'</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 3166-1" listName="Country">'.$cliente["pais"].'</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                        </cac:PartyLegalEntity>
                        <cac:Contact>
                            <cbc:ElectronicMail>'.$venta["email"].'</cbc:ElectronicMail>
                        </cac:Contact>
                        </cac:Party>
                    </cac:AccountingCustomerParty>
                    <cac:TaxTotal>
                        <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                        <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cac:TaxScheme>
                                <cbc:ID schemeAgencyID="6" schemeID="UN/ECE 5153">1000</cbc:ID>
                                <cbc:Name>IGV</cbc:Name>
                                <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                        </cac:TaxSubtotal>
                    </cac:TaxTotal>
                    <cac:LegalMonetaryTotal>
                        <cbc:PayableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total'].'</cbc:PayableAmount>
                    </cac:LegalMonetaryTotal>
                    <cac:CreditNoteLine>
                        <cbc:ID>1</cbc:ID>
                        <cbc:Note>ZZ</cbc:Note>
                        <cbc:CreditedQuantity unitCode="ZZ" unitCodeListAgencyName="United Nations Economic Commission for Europe" unitCodeListID="UN/ECE rec 20">1</cbc:CreditedQuantity>
                        <cbc:LineExtensionAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:LineExtensionAmount>
                        <cac:BillingReference>
                            <cac:BillingReferenceLine>
                                <cbc:ID schemeID="AF">'.$comprobante["total"].'</cbc:ID>
                            </cac:BillingReferenceLine>
                        </cac:BillingReference>
                        <cac:PricingReference>
                            <cac:AlternativeConditionPrice>
                                <cbc:PriceAmount currencyID="PEN">'.$comprobante["total"].'</cbc:PriceAmount>
                                <cbc:PriceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Precio" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
                            </cac:AlternativeConditionPrice>
                        </cac:PricingReference>
                        <cac:TaxTotal>
                            <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                            <cac:TaxSubtotal>
                            <cbc:TaxableAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                            <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                            <cac:TaxCategory>
                                <cbc:Percent>18.00</cbc:Percent>
                                <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                                <cac:TaxScheme>
                                    <cbc:ID schemeAgencyName="PE:SUNAT" schemeName="Codigo de tributos" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">1000</cbc:ID>
                                    <cbc:Name>IGV</cbc:Name>
                                    <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                                </cac:TaxScheme>
                            </cac:TaxCategory>
                            </cac:TaxSubtotal>
                        </cac:TaxTotal>
                        <cac:Item>
                            <cbc:Description>'.$venta["observacion"].'</cbc:Description>
                        </cac:Item>
                        <cac:Price>
                            <cbc:PriceAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:PriceAmount>
                        </cac:Price>
                    </cac:CreditNoteLine>
                </CreditNote>';

            }else{
                $modelos = ControladorFacturacion::ctrMostrarModeloImpresion($documento,$tipo);

                $unidad= ControladorFacturacion::ctrMostrarUnidadesImpresion($documento,$tipo);


            $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <CreditNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:CreditNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
            <ext:UBLExtensions>
                <ext:UBLExtension>
                    <ext:ExtensionContent />
                </ext:UBLExtension>
            </ext:UBLExtensions>
            <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
            <cbc:CustomizationID>2.0</cbc:CustomizationID>
            <cbc:ID>'.$comprobante["serie"].'-'.$comprobante["correlativo"].'</cbc:ID>
            <cbc:IssueDate>'.$comprobante["fecha_emision"].'</cbc:IssueDate>
            <cbc:Note languageLocaleID="1000"> '.$comprobante["total_texto"].'</cbc:Note>
            <cbc:Note>Nro.unidades: '.($unidad["cantidad"]*-1).'</cbc:Note>
            <cbc:Note languageID="D">'.$cliente["cliente"].'</cbc:Note>
            <cbc:Note languageID="E">CONTADO .</cbc:Note>
            <cbc:Note languageID="F">'.$totalSinIGV.'</cbc:Note>
            <cbc:Note languageID="G">'.$vendedor["codigo"].' '.$vendedor["nombre"].'</cbc:Note>
            <cbc:DocumentCurrencyCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 4217 Alpha"
                listName="Currency">PEN</cbc:DocumentCurrencyCode>
            <cbc:LineCountNumeric>'.count($modelos).'</cbc:LineCountNumeric>
            <cac:DiscrepancyResponse>
                <cbc:ReferenceID>'.$serieInvoice."-".$correlativoInvoice.'</cbc:ReferenceID>
                <cbc:ResponseCode listAgencyName="PE:SUNAT" listName="Tipo de nota de credito" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo09">'.$tipoMotivo.'</cbc:ResponseCode>
                <cbc:Description>'.ucfirst(strtolower($venta['nom_motivo'])).'</cbc:Description>
            </cac:DiscrepancyResponse>
            <cac:OrderReference>
                <cbc:ID>'.$venta["origen2"].'</cbc:ID>
            </cac:OrderReference>
            <cac:BillingReference>
                <cac:InvoiceDocumentReference>
                    <cbc:ID>'.$serieInvoice."-".$correlativoInvoice.'</cbc:ID>
                    <cbc:IssueDate>'.$venta["fecha_origen"].'</cbc:IssueDate>
                    <cbc:DocumentTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01">'.$tipoOrigen.'</cbc:DocumentTypeCode>
                </cac:InvoiceDocumentReference>
            </cac:BillingReference>
            <cac:Signature>
                <cbc:ID>IDSignKG</cbc:ID>
                <cac:SignatoryParty>
                    <cac:PartyIdentification>
                        <cbc:ID>'.$emisor["ruc"].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name>'.$emisor["razon_social"].'</cbc:Name>
                    </cac:PartyName>
                </cac:SignatoryParty>
                <cac:DigitalSignatureAttachment>
                    <cac:ExternalReference>
                        <cbc:URI>#SignST</cbc:URI>
                    </cac:ExternalReference>
                </cac:DigitalSignatureAttachment>
            </cac:Signature>
            <cac:AccountingSupplierParty>
                <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="6" schemeName="Documento de Identidad"
                            schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$emisor["ruc"].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name>'.$emisor["nombre_comercial"].'</cbc:Name>
                    </cac:PartyName>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName>'.$emisor["razon_social"].'</cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">0002
                            </cbc:AddressTypeCode>
                            <cbc:CitySubdivisionName>'.$emisor["referencia"].'</cbc:CitySubdivisionName>
                            <cbc:CityName>'.$emisor["provincia"].'</cbc:CityName>
                            <cbc:CountrySubentity>'.$emisor["departamento"].'</cbc:CountrySubentity>
                            <cbc:District>'.$emisor["distrito"].'</cbc:District>
                            <cac:AddressLine>
                                <cbc:Line>'.$emisor["direccion"].'</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe"
                                    listID="ISO 3166-1" listName="Country">'.$emisor["pais"].'</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                </cac:Party>
            </cac:AccountingSupplierParty>
            <cac:AccountingCustomerParty>
                <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="'.$tipodoc.'" schemeName="Documento de Identidad"
                            schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$cliente["ruc"].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyName>
                        <cbc:Name />
                    </cac:PartyName>
                    <cac:PartyLegalEntity>
                        <cbc:RegistrationName>'.$cliente["razon_social"].'</cbc:RegistrationName>
                        <cac:RegistrationAddress>
                            <cbc:ID schemeAgencyName="PE:INEI" schemeName="Ubigeos" />
                            <cbc:CitySubdivisionName>-</cbc:CitySubdivisionName>
                            <cbc:CityName />
                            <cbc:CountrySubentity>'.$venta["departamento"].'</cbc:CountrySubentity>
                            <cbc:District />
                            <cac:AddressLine>
                                <cbc:Line>'.$cliente["direccion"].'</cbc:Line>
                            </cac:AddressLine>
                            <cac:Country>
                                <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe"
                                    listID="ISO 3166-1" listName="Country">'.$cliente["pais"].'</cbc:IdentificationCode>
                            </cac:Country>
                        </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                    <cac:Contact>
                    <cbc:ElectronicMail>'.$venta["email"].'</cbc:ElectronicMail>
                    </cac:Contact>
                </cac:Party>
            </cac:AccountingCustomerParty>
            <cac:TaxTotal>
                <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["igv"].'</cbc:TaxAmount>
                <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["igv"].'</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cac:TaxScheme>
                            <cbc:ID schemeAgencyID="6" schemeID="UN/ECE 5153">1000</cbc:ID>
                            <cbc:Name>IGV</cbc:Name>
                            <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                </cac:TaxSubtotal>';
                if($venta["dscto"] < 0){
                    $xml.='<cac:TaxSubtotal>
                        <cbc:TaxAmount currencyID="PEN">'.($venta["dscto"]*-1).'</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cac:TaxScheme>
                                <cbc:ID schemeAgencyID="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05" schemeAgencyName="PE:SUNAT" schemeName="Codigo de tributos">7152</cbc:ID>
                                <cbc:Name>ICBPER</cbc:Name>
                                <cbc:TaxTypeCode>OTH</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                    </cac:TaxSubtotal>';
                }
            $xml.='</cac:TaxTotal>
            <cac:LegalMonetaryTotal>
                <cbc:PayableAmount currencyID="'.$comprobante["moneda"].'">'.$comprobante["total"].'</cbc:PayableAmount>
            </cac:LegalMonetaryTotal>';
               
            foreach($modelos as $k=>$v){
              
               $igv = 0.18 * ($v["total"]*-1);
               $totalIGV = ($v["total"]*-1)+$igv;
               $precioIGV  = $totalIGV/($v["cantidad"]*-1);

        $xml.='<cac:CreditNoteLine>
                <cbc:ID>'.($k+1).'</cbc:ID>
                <cbc:Note>'.$v["unidad"].'</cbc:Note>
                <cbc:InvoicedQuantity unitCode="'.$v["unidad"].'" unitCodeListAgencyName="United Nations Economic Commission for Europe"
                    unitCodeListID="UN/ECE rec 20">'.number_format(($v["cantidad"]*-1),3,".","").'</cbc:InvoicedQuantity>
                <cbc:LineExtensionAmount currencyID="'.$comprobante["moneda"].'">'.($v["total"]*-1).'</cbc:LineExtensionAmount>
                <cac:BillingReference>
                    <cac:BillingReferenceLine>
                        <cbc:ID schemeID="AL">37.15</cbc:ID>
                    </cac:BillingReferenceLine>
                </cac:BillingReference>
                <cac:PricingReference>
                    <cac:AlternativeConditionPrice>
                        <cbc:PriceAmount currencyID="'.$comprobante["moneda"].'">'.number_format($precioIGV,2,".","").'</cbc:PriceAmount>
                        <cbc:PriceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Precio"
                            listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
                    </cac:AlternativeConditionPrice>
                </cac:PricingReference>
                <cac:TaxTotal>
                    <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                    <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="'.$comprobante["moneda"].'">'.($v["total"]*-1).'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="'.$comprobante["moneda"].'">'.number_format($igv,2,".","").'</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cbc:Percent>18</cbc:Percent>
                            <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV"
                                listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                            <cac:TaxScheme>
                                <cbc:ID schemeAgencyName="PE:SUNAT" schemeName="Codigo de tributos"
                                    schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">1000</cbc:ID>
                                <cbc:Name>IGV</cbc:Name>
                                <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                    </cac:TaxSubtotal>
                </cac:TaxTotal>
                <cac:Item>
                    <cbc:Description>'.$v["nombre"].'</cbc:Description>
                    <cac:SellersItemIdentification>
                        <cbc:ID>'.$v["modelo"].'</cbc:ID>
                    </cac:SellersItemIdentification>
                </cac:Item>
                <cac:Price>
                    <cbc:PriceAmount currencyID="'.$comprobante["moneda"].'">'.$v["precio"].'</cbc:PriceAmount>
                </cac:Price>
            </cac:CreditNoteLine>';  	
        }
    

        $xml.="</CreditNote>";

     }

	    $doc->loadXML($xml);
	    $doc->save($ruta.'.XML');

        //CREAR XML FIRMA

        $objfirma = new Signature();
       
        // $ruta_xml_firmar = $ruta . '.XML'; //es el archivo XML que se va a firmar
        $ruta = $ruta . '.XML';
        $rutacertificado = "vistas/generar_xml/";
        $flg_firma = 0; //Posicion del XML: 0 para firma
        $ruta_firma = $rutacertificado. 'certificado_prueba.pfx'; //ruta del archivo del certicado para firmar
        $pass_firma = 'ceti';
        $actualizadoEnvio = ModeloFacturacion::mdlActualizarProcesoFacturacion(2,$tipo,$documento);
        $resp = $objfirma->signature_xml($flg_firma, $ruta, $ruta_firma, $pass_firma);

                        echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero el XML Nota de Credito de '.$venta["documento"].'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "procesar-ce";

                                            }
                                        })

                            </script>';

        }

    }

    static public function ctrCrearNotaDebitoXML(){

        if(isset($_GET["tipoNotaDeb"]) && isset($_GET["documentoNotaDeb"])){

            $doc = new DOMDocument();
            $doc->formatOutput = FALSE;
            $doc->preserveWhiteSpace = TRUE;
            $doc->encoding = 'utf-8';

            require_once("/../extensiones/cantidad_en_letras.php");
            require_once("/../vistas/generar_xml/signature.php"); // permite firmar xml

            $tipo = $_GET["tipoNotaDeb"];

            $documento = $_GET["documentoNotaDeb"];

            $inicialOrigen = substr($venta["doc_origen"],0,1);

            if($inicialOrigen == 'B'){
                $tipoOrigen = '03';
            }else{
                $tipoOrigen = '01';
            }

            $venta = ControladorFacturacion::ctrMostrarDebitoImpresion($documento,$tipo);

            // var_dump($modelos);
            $emisor = 	array(
                        'tipodoc'		=> '6',
                        'ruc' 			=> '20513613939', 
                        'nombre_comercial'=> 'JACKY FORM',
                        'razon_social'	=> 'Corporacion Vasco S.A.C.', 
                        'referencia'	=> 'URB.SANTA LUISA 1RA ETAPA', 
                        'direccion'		=> 'CAL.SANTO TORIBIO NRO. 259',
                        'pais'			=> 'PE', 
                        'departamento'  => 'LIMA',
                        'provincia'		=> 'LIMA',
                        'distrito'		=> 'SAN MARTIN DE PORRES'
                        );


            $cliente = array(
                        'tipodoc'		=> '6',//6->ruc, 1-> dni 
                        'ruc'			=> $venta["dni"], 
                        'razon_social'  => $venta["nombre"], 
                        'cliente'       => $venta["cliente"],
                        'direccion'		=> $venta["direccion"],
                        'pais'			=> 'PE'
                        );	

            $vendedor = array(
                        "codigo"		=> $venta["vendedor"],
                        "nombre"		=> $venta["nom_vendedor"]
                        );

            $comprobante =	array(
                        'tipodoc'		=> '08', //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
                        'serie'			=> substr($venta["documento"],0,4),
                        'correlativo'	=> substr($venta["documento"],4,12),
                        'fecha_emision' => $venta["fecha_emision"],
                        'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
                        'total_opgravadas'=> 0, //OP. GRAVADAS
                        'total_opexoneradas'=>0,
                        'total_opinafectas'=>0,
                        'igv'			=> 0,
                        'total'			=> 0,
                        'total_texto'	=> ''
                    );



            $op_gravadas = 0;
            $op_inafectas = 0;
            $op_exoneradas = 0;

            $comprobante['total_opgravadas'] = $venta["neto"];
            $comprobante['total_opexoneradas'] = $op_exoneradas;
            $comprobante['total_opinafectas'] = $op_inafectas;
            $comprobante['igv'] = $venta["igv"];
            $comprobante['total'] = $venta["total"];
            $comprobante['total_texto'] = CantidadEnLetra($venta["total"]);
            $totalSinIGV= $venta["total"]-$venta["igv"];

            $serieInvoice=substr($venta["doc_origen"],0,4);
            $correlativoInvoice=substr($venta["doc_origen"],4,12);

            //RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
            //01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
            $nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

            $ruta = "vistas/generar_xml/archivos_xml/".$nombrexml;

            $tipoCliente = $cliente["ruc"];

            if(strlen($tipoCliente) == 8){
                $tipodoc='1';
            }else{
                $tipodoc='6';
            }

            //TIPO DE MOTIVO SEGUN SUNAT
            if($venta["motivo"] == "D1"){

                $tipoMotivo = "01";

            }else if($venta["motivo"] == "D2"){

                $tipoMotivo = "02";

            }else{

                $tipoMotivo = "03";

            }

            

            $xml = '<?xml version="1.0" encoding="UTF-8"?>
            <DebitNote xmlns="urn:oasis:names:specification:ubl:schema:xsd:DebitNote-2" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2">
            <ext:UBLExtensions>
                <ext:UBLExtension>
                    <ext:ExtensionContent />
                </ext:UBLExtension>
            </ext:UBLExtensions>
                <cbc:UBLVersionID>2.1</cbc:UBLVersionID>
                <cbc:CustomizationID>2.0</cbc:CustomizationID>
                <cbc:ID>'.$comprobante['serie'].'-'.$comprobante['correlativo'].'</cbc:ID>
                <cbc:IssueDate>'.$comprobante['fecha_emision'].'</cbc:IssueDate>
                <cbc:Note languageLocaleID="1000"> '.$comprobante["total_texto"].'</cbc:Note>
                <cbc:Note languageID="D">'.$cliente["cliente"].'</cbc:Note>
                <cbc:Note languageID="F">'.$totalSinIGV.'</cbc:Note>
                <cbc:Note languageID="G">'.$vendedor["codigo"].' '.$vendedor["nombre"].'</cbc:Note>
                <cbc:DocumentCurrencyCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 4217 Alpha" listName="Currency">PEN</cbc:DocumentCurrencyCode>
                <cbc:LineCountNumeric>1</cbc:LineCountNumeric>
                <cac:DiscrepancyResponse>
                    <cbc:ReferenceID>'.$serieInvoice."-".$correlativoInvoice.'</cbc:ReferenceID>
                    <cbc:ResponseCode listAgencyName="PE:SUNAT" listName="Tipo de nota de credito" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo09">'.$tipoMotivo.'</cbc:ResponseCode>
                    <cbc:Description>'.ucfirst(strtolower($venta['nom_motivo'])).'</cbc:Description>
                </cac:DiscrepancyResponse>
                <cac:BillingReference>
                    <cac:InvoiceDocumentReference>
                        <cbc:ID>'.$serieInvoice."-".$correlativoInvoice.'</cbc:ID>
                        <cbc:IssueDate>'.$venta["fecha_origen"].'</cbc:IssueDate>
                        <cbc:DocumentTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Documento" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo01">'.$tipoOrigen.'</cbc:DocumentTypeCode>
                    </cac:InvoiceDocumentReference>
                </cac:BillingReference>
                <cac:Signature>
                    <cbc:ID>IDSignKG</cbc:ID>
                    <cac:SignatoryParty>
                        <cac:PartyIdentification>
                            <cbc:ID>'.$emisor["ruc"].'</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyName>
                            <cbc:Name>'.$emisor["razon_social"].'</cbc:Name>
                        </cac:PartyName>
                    </cac:SignatoryParty>
                    <cac:DigitalSignatureAttachment>
                        <cac:ExternalReference>
                            <cbc:URI>#SignST</cbc:URI>
                        </cac:ExternalReference>
                    </cac:DigitalSignatureAttachment>
                </cac:Signature>
                <cac:AccountingSupplierParty>
                    <cac:Party>
                        <cac:PartyIdentification>
                            <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="6" schemeName="Documento de Identidad" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$emisor["ruc"].'</cbc:ID>
                        </cac:PartyIdentification>
                        <cac:PartyName>
                            <cbc:Name>'.$emisor["nombre_comercial"].'</cbc:Name>
                        </cac:PartyName>
                        <cac:PartyLegalEntity>
                            <cbc:RegistrationName>'.$emisor["razon_social"].'</cbc:RegistrationName>
                            <cac:RegistrationAddress>
                                <cbc:AddressTypeCode listAgencyName="PE:SUNAT" listName="Establecimientos anexos">0002
                                </cbc:AddressTypeCode>
                                <cbc:CitySubdivisionName>'.$emisor["referencia"].'</cbc:CitySubdivisionName>
                                <cbc:CityName>'.$emisor["provincia"].'</cbc:CityName>
                                <cbc:CountrySubentity>'.$emisor["departamento"].'</cbc:CountrySubentity>
                                <cbc:District>'.$emisor["distrito"].'</cbc:District>
                                <cac:AddressLine>
                                    <cbc:Line>'.$emisor["direccion"].'</cbc:Line>
                                </cac:AddressLine>
                                <cac:Country>
                                    <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 3166-1" listName="Country">'.$emisor["pais"].'</cbc:IdentificationCode>
                                </cac:Country>
                            </cac:RegistrationAddress>
                        </cac:PartyLegalEntity>
                    </cac:Party>
                </cac:AccountingSupplierParty>
                <cac:AccountingCustomerParty>
                    <cac:Party>
                    <cac:PartyIdentification>
                        <cbc:ID schemeAgencyName="PE:SUNAT" schemeID="'.$tipodoc.'" schemeName="Documento de Identidad"
                        schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo06">'.$cliente["ruc"].'</cbc:ID>
                    </cac:PartyIdentification>
                    <cac:PartyLegalEntity>
                    <cbc:RegistrationName>'.$cliente["razon_social"].'</cbc:RegistrationName>
                    <cac:RegistrationAddress>
                        <cbc:ID schemeAgencyName="PE:INEI" schemeName="Ubigeos" />
                        <cbc:CitySubdivisionName>-</cbc:CitySubdivisionName>
                        <cbc:CityName />
                        <cbc:CountrySubentity>'.$venta["departamento"].'</cbc:CountrySubentity>
                        <cbc:District />
                        <cac:AddressLine>
                            <cbc:Line>'.$cliente["direccion"].'</cbc:Line>
                        </cac:AddressLine>
                        <cac:Country>
                            <cbc:IdentificationCode listAgencyName="United Nations Economic Commission for Europe" listID="ISO 3166-1" listName="Country">'.$cliente["pais"].'</cbc:IdentificationCode>
                        </cac:Country>
                    </cac:RegistrationAddress>
                    </cac:PartyLegalEntity>
                    <cac:Contact>
                        <cbc:ElectronicMail>'.$venta["email"].'</cbc:ElectronicMail>
                    </cac:Contact>
                    </cac:Party>
                </cac:AccountingCustomerParty>
                <cac:TaxTotal>
                    <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                    <cac:TaxSubtotal>
                    <cbc:TaxableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                    <cbc:TaxAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['igv'].'</cbc:TaxAmount>
                    <cac:TaxCategory>
                        <cac:TaxScheme>
                            <cbc:ID schemeAgencyID="6" schemeID="UN/ECE 5153">1000</cbc:ID>
                            <cbc:Name>IGV</cbc:Name>
                            <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                        </cac:TaxScheme>
                    </cac:TaxCategory>
                    </cac:TaxSubtotal>
                </cac:TaxTotal>
                <cac:RequestedMonetaryTotal>
                    <cbc:PayableAmount currencyID="'.$comprobante['moneda'].'">'.$comprobante['total'].'</cbc:PayableAmount>
                </cac:RequestedMonetaryTotal>
                <cac:DebitNoteLine>
                    <cbc:ID>1</cbc:ID>
                    <cbc:Note>ZZ</cbc:Note>
                    <cbc:DebitedQuantity unitCode="ZZ" unitCodeListAgencyName="United Nations Economic Commission for Europe" unitCodeListID="UN/ECE rec 20">1</cbc:DebitedQuantity>
                    <cbc:LineExtensionAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:LineExtensionAmount>
                    <cac:BillingReference>
                        <cac:BillingReferenceLine>
                            <cbc:ID schemeID="AF">'.$comprobante["total"].'</cbc:ID>
                        </cac:BillingReferenceLine>
                    </cac:BillingReference>
                    <cac:PricingReference>
                        <cac:AlternativeConditionPrice>
                            <cbc:PriceAmount currencyID="PEN">'.$comprobante["total"].'</cbc:PriceAmount>
                            <cbc:PriceTypeCode listAgencyName="PE:SUNAT" listName="Tipo de Precio" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo16">01</cbc:PriceTypeCode>
                        </cac:AlternativeConditionPrice>
                    </cac:PricingReference>
                    <cac:TaxTotal>
                        <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                        <cac:TaxSubtotal>
                        <cbc:TaxableAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:TaxableAmount>
                        <cbc:TaxAmount currencyID="PEN">'.$comprobante["igv"].'</cbc:TaxAmount>
                        <cac:TaxCategory>
                            <cbc:Percent>18.00</cbc:Percent>
                            <cbc:TaxExemptionReasonCode listAgencyName="PE:SUNAT" listName="Afectacion del IGV" listURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo07">10</cbc:TaxExemptionReasonCode>
                            <cac:TaxScheme>
                                <cbc:ID schemeAgencyName="PE:SUNAT" schemeName="Codigo de tributos" schemeURI="urn:pe:gob:sunat:cpe:see:gem:catalogos:catalogo05">1000</cbc:ID>
                                <cbc:Name>IGV</cbc:Name>
                                <cbc:TaxTypeCode>VAT</cbc:TaxTypeCode>
                            </cac:TaxScheme>
                        </cac:TaxCategory>
                        </cac:TaxSubtotal>
                    </cac:TaxTotal>
                    <cac:Item>
                        <cbc:Description>'.$venta["observacion"].'</cbc:Description>
                    </cac:Item>
                    <cac:Price>
                        <cbc:PriceAmount currencyID="PEN">'.$comprobante["total_opgravadas"].'</cbc:PriceAmount>
                    </cac:Price>
                </cac:DebitNoteLine>
            </DebitNote>';

            

	    $doc->loadXML($xml);
	    $doc->save($ruta.'.XML');

        //CREAR XML FIRMA

        $objfirma = new Signature();
       
        // $ruta_xml_firmar = $ruta . '.XML'; //es el archivo XML que se va a firmar
        $ruta = $ruta . '.XML';
        $rutacertificado = "vistas/generar_xml/";
        $flg_firma = 0; //Posicion del XML: 0 para firma
        $ruta_firma = $rutacertificado. 'certificado_prueba.pfx'; //ruta del archivo del certicado para firmar
        $pass_firma = 'ceti';
        // $actualizadoEnvio = ModeloFacturacion::mdlActualizarProcesoFacturacion(2,$tipo,$documento);
        $resp = $objfirma->signature_xml($flg_firma, $ruta, $ruta_firma, $pass_firma);

                        echo'<script>

                            swal({
                                    type: "success",
                                    title: "Se Genero el XML Nota de Debito de '.$venta["documento"].'",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar"
                            }).then(function(result){
                                            if (result.value) {

                                            window.location = "procesar-ce";

                                            }
                                        })

                            </script>';

        }

    }

    /*
    * MOSTRAR MODELO DE NOTAS PARA IMPRESION
    */
	static public function ctrFEFacturaCab($tipo, $documento){

		$respuesta = ModeloFacturacion::mdlFEFacturaCab($tipo, $documento);

		return $respuesta;

    }    

    /*
    * MOSTRAR MODELO DE NOTAS PARA IMPRESION
    */
	static public function ctrFEFacturaDet($tipo, $documento){

		$respuesta = ModeloFacturacion::mdlFEFacturaDet($tipo, $documento);

		return $respuesta;

    }    

    //*GENERAR EFACT
	static public function ctrGenerarFEFacBol(){

        if(isset($_POST["tipo"])){

            $datos = ModeloFacturacion::mdlFEFacturaCab($_POST["tipo"], $_POST["documento"]);
            //var_dump($datos);
            
            //todo: FILA 1
            $fila1 =    $datos["a1"].','.
                        $datos["b1"].','.
                        $datos["c1"].','.  
                        $datos["d1"].','.  
                        $datos["e1"].','.  
                        $datos["f1"].','. 
                        $datos["g1"].',,,,,,,'.
                        $datos["n1"].',,,'.
                        $datos["q1"].',,,,,'.
                        $datos["v1"].',,,,,,,,,,,,,,,,'.
                        $datos["al1"].',,,,,,'.
                        $datos["ar1"].',,,,,,,,,,'.
                        $datos["bb1"].','. 
                        $datos["bc1"].','. 
                        $datos["bd1"].',,,,'.
                        $datos["bh1"].',';

            //todo: FILA 2
            $fila2 = ',,,,,,,,,,,,,,,,,,,,,,,,,,,,';   
            
            //todo: FILA 3
            if(substr($datos["a3"],0,4) == "0003"){

                $fila3 =    $datos["a3"].','.
                            $datos["b3"].',,,'.
                            $datos["e3"]; 


            }else{

                $fila3 =    ',,,,,'.
                            $datos["e3"];  

            }

            $a4 = str_replace('\"','', $datos["a4"]);
            //todo: FILA 4
            $fila4 =    $datos["a4"].','.
                        $datos["b4"].','. 
                        $datos["c4"].','.
                        $datos["d4"].','.
                        $datos["e4"].','.
                        $datos["f4"].','.
                        $datos["g4"].','.
                        $datos["h4"].','.
                        $datos["i4"].','.
                        $datos["j4"].','.
                        '0002'.',';

            //todo: FILA 5
            $fila5 =    $datos["a5"].','.
                        $datos["b5"].','. 
                        $datos["c5"].','.
                        $datos["d5"].','.
                        $datos["e5"].','.
                        $datos["f5"].','.
                        $datos["g5"].','.
                        $datos["h5"].','.
                        $datos["i5"].','.
                        $datos["j5"].','.
                        $datos["k5"].','.
                        $datos["l5"].',';

            //todo: FILA 6
            require_once("/../extensiones/cantidad_en_letras_v2.php");
            $monto_letras = convertir($datos["n1"]);
            $fila6 =    $monto_letras.',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,';

            //todo: FILA 7
            $fila7 =    $datos["a7"].',,,'.
                        $datos["d7"].','.
                        $datos["e7"].','.
                        $datos["f7"].','.
                        $datos["g7"].',';

            $nombre = '20513613939-'.$datos["c1"].'-'.$datos["b1"];
            
            $fp = fopen('../vistas/reportes_excel/csv_fe/'.$nombre.'.txt', 'w'); 
            
            fwrite($fp, $fila1.PHP_EOL);
            fwrite($fp, $fila2.PHP_EOL);
            fwrite($fp, $fila3.PHP_EOL);
            fwrite($fp, $fila4.PHP_EOL);
            fwrite($fp, $fila5.PHP_EOL);
            fwrite($fp, $fila6.PHP_EOL);
            fwrite($fp, $fila7.PHP_EOL);

            $datosD = ModeloFacturacion::mdlFEFacturaDet($_POST["tipo"], $_POST["documento"]);
            //var_dump($datosD);

            foreach($datosD as $key=>$value){

                if($key < count($datosD)-1){

                    fwrite($fp,     ($key+1).','.
                                    $value["b9"].','.
                                    $value["c9"].','.
                                    $value["d9"].','.
                                    $value["e9"].','.
                                    $value["f9"].',,,'.
                                    $value["i9"].','.
                                    $value["j9"].','.
                                    $value["k9"].','.
                                    $value["l9"].','.
                                    $value["m9"].',,,,,,'.
                                    $value["s9"].','.
                                    $value["t9"].','.
                                    $value["u9"].',,,,,,,,,,,,,,,,'.
                                    $value["ak9"].','.
                                    $value["al9"].',,,,'.
                                    "\r\n");

                }else{

                    fwrite($fp, ($key+1).','.
                                $value["b9"].','.
                                $value["c9"].','.
                                $value["d9"].','.
                                $value["e9"].','.
                                $value["f9"].',,,'.
                                $value["i9"].','.
                                $value["j9"].','.
                                $value["k9"].','.
                                $value["l9"].','.
                                $value["m9"].',,,,,,'.
                                $value["s9"].','.
                                $value["t9"].','.
                                $value["u9"].',,,,,,,,,,,,,,,,'.
                                $value["ak9"].','.
                                $value["al9"].',,,,'.PHP_EOL);
                    fwrite($fp, 'FF00FF');

                }					

            }
            
            fclose($fp); 

            $origen = 'c:/xampp/htdocs/vascorp/vistas/reportes_excel/csv_fe/'.$nombre.'.txt';

            if($datos["c1"] == "01"){

                //?destino prueba
                $destino = 'c:/prueba/invoice/'.$nombre.'.csv';

                //!destino produccion
                //!$destino = 'c:/daemonOSE21/documents/in/invoice/'.$nombre.'.csv';

            }else{

                //?destino prueba
                $destino = 'c:/prueba/boleta/'.$nombre.'.csv';

                //!destino produccion
                //!$destino = 'c:/daemonOSE21/documents/in/boleta/'.$nombre.'.csv';

            }

            copy($origen,$destino);
            //rename($origen, $destino);

        }
        
        $respuesta = "ok";
		return $respuesta;

    }     

    //*GENERAR NUBE FACTURA Y BOLETA
	static public function ctrGenerarFEFacBolA(){

        if(isset($_POST["tipo"])){

            $datos = ModeloFacturacion::mdlFEFacturaCabA($_POST["tipo"], $_POST["documento"]);
            //var_dump($datos);

            if($_POST["tipo"] == "S03"){

                //todo: FILA 1
                $fila1 =    $datos["a1"].','.
                            $datos["b1"].','.
                            $datos["c1"].','.  
                            $datos["d1"].','.  
                            $datos["e1"].','.  
                            $datos["f1"].','. 
                            $datos["g1"].',,,,,,,'.
                            $datos["n1"].','.
                            $datos["o1"].',,'.
                            $datos["q1"].',,,,,'.
                            $datos["v1"].',,,,'.
                            $datos["z1"].',,,,,,,,,,,,'.
                            $datos["al1"].',,,,,,,'.
                            $datos["as1"].','.
                            $datos["at1"].',,,,,,,,,,,,,,'.
                            $datos["bh1"].','. 
                            $datos["bi1"].','. 
                            $datos["bj1"].',,,,,,,,,,,,,,,,,,,,,';

            }else{

                //todo: FILA 1
                $fila1 =    $datos["a1"].','.
                            $datos["b1"].','.
                            $datos["c1"].','.  
                            $datos["d1"].','.  
                            $datos["e1"].','.  
                            $datos["f1"].','. 
                            $datos["g1"].',,,,,,,'.
                            $datos["n1"].',,,'.
                            $datos["q1"].',,,,,'.
                            $datos["v1"].',,,,'.
                            $datos["z1"].',,,,,,,,,,,,'.
                            $datos["al1"].',,,,,,,'.
                            $datos["as1"].','.
                            $datos["at1"].',,,,,,,,,,,,,,'.
                            $datos["bh1"].','. 
                            $datos["bi1"].','. 
                            $datos["bj1"].',,,,,,,,,,,,,,,,,,,,,';

            }
            


            //todo: FILA 2
            $fila2 = ',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,';   
            
            //todo: FILA 3

            if($_POST["tipo"] == "S03"){

                if(substr($datos["a3"],0,4) == "0003"){

                    $fila3 =    $datos["a3"].','.
                                $datos["b3"].',,'.
                                $datos["e3"].','.
                                $datos["f3"].','.
                                $datos["g3"].','.
                                $datos["h3"]; 
    
    
                }else{
    
                    $fila3 =    ',,,,'.
                                $datos["e3"].','.
                                $datos["f3"].','.
                                $datos["g3"].','.
                                $datos["h3"];  
    
                }

            }else {

                if(substr($datos["a3"],0,4) == "0003"){

                    $fila3 =    $datos["a3"].','.
                                $datos["b3"].',,,,'; 
    
    
                }else{
    
                    $fila3 =    ',,,,,';  
    
                }

                
            }



            $a4 = str_replace('\"','', $datos["a4"]);

            //todo: FILA 4
            $fila4 =    $datos["a4"].','.
                        $datos["b4"].','. 
                        $datos["c4"].','.
                        $datos["d4"].','.
                        $datos["e4"].','.
                        $datos["f4"].','.
                        $datos["g4"].','.
                        $datos["h4"].','.
                        $datos["i4"].','.
                        $datos["j4"].','.
                        $datos["k4"].','.
                        $datos["l4"].','.
                        '0002'.',';

            //todo: FILA 5
            $fila5 =    $datos["a5"].','.
                        $datos["b5"].','. 
                        $datos["c5"].','.
                        $datos["d5"].','.
                        $datos["e5"].','.
                        $datos["f5"].','.
                        $datos["g5"].','.
                        $datos["h5"].','.
                        $datos["i5"].','.
                        $datos["j5"].','.
                        $datos["k5"].','.
                        $datos["l5"].',';

            //todo: FILA 6
            require_once("/../extensiones/cantidad_en_letras_v2.php");
            $monto_letras = convertir($datos["n1"]);
            $fila6 =    $monto_letras.',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,';

            //todo: FILA 7
            $fila7 =    $datos["a7"].',,'.
                        $datos["g3"].','.
                        $datos["d7"].','.
                        $datos["e7"].','.
                        $datos["f7"].','.
                        $datos["g7"].',,,,,,';

            $nombre = '20513613939-'.$datos["c1"].'-'.$datos["b1"];
            
            $fp = fopen('../vistas/reportes_excel/csv_fe/'.$nombre.'.txt', 'w'); 
            
            fwrite($fp, $fila1.PHP_EOL);
            fwrite($fp, $fila2.PHP_EOL);
            fwrite($fp, $fila3.PHP_EOL);
            fwrite($fp, $fila4.PHP_EOL);
            fwrite($fp, $fila5.PHP_EOL);
            fwrite($fp, $fila6.PHP_EOL);
            fwrite($fp, $fila7.PHP_EOL);

            $datosD = ModeloFacturacion::mdlFEFacturaDetA($_POST["tipo"], $_POST["documento"]);
            //var_dump($datosD);

            foreach($datosD as $key=>$value){

                if($key < count($datosD)-1){

                    fwrite($fp,     ($key+1).','.
                                    $value["b9"].','.
                                    $value["c9"].','.
                                    $value["d9"].','.
                                    $value["e9"].','.
                                    $value["f9"].',,,'.
                                    $value["i9"].','.
                                    $value["j9"].','.
                                    $value["k9"].','.
                                    $value["l9"].','.
                                    $value["m9"].',,,,,,'.
                                    $value["s9"].','.
                                    $value["t9"].','.
                                    $value["u9"].',,,'.
                                    $value["x9"].',,,,,,,,,,,,,,,,,,'.
                                    $value["ap9"].',,,,,,,,,,,,,,,,,,,,,'.
                                    "\r\n");

                }else{

                    fwrite($fp, ($key+1).','.
                                $value["b9"].','.
                                $value["c9"].','.
                                $value["d9"].','.
                                $value["e9"].','.
                                $value["f9"].',,,'.
                                $value["i9"].','.
                                $value["j9"].','.
                                $value["k9"].','.
                                $value["l9"].','.
                                $value["m9"].',,,,,,'.
                                $value["s9"].','.
                                $value["t9"].','.
                                $value["u9"].',,,'.
                                $value["x9"].',,,,,,,,,,,,,,,,,,'.
                                $value["ap9"].',,,,,,,,,,,,,,,,,,,,,'.PHP_EOL);
                    fwrite($fp, 'FF00FF');

                }					

            }
            
            fclose($fp); 

            $origen = 'c:/xampp/htdocs/vascorp/vistas/reportes_excel/csv_fe/'.$nombre.'.txt';

            if($datos["c1"] == "01"){

                //?destino prueba
                $destino = 'c:/prueba/invoice/'.$nombre.'.csv';

                //!destino produccion
                //!$destino = 'c:/daemonOSE21/documents/in/invoice/'.$nombre.'.csv';

            }else{

                //?destino prueba
                $destino = 'c:/prueba/boleta/'.$nombre.'.csv';

                //!destino produccion
                //!$destino = 'c:/daemonOSE21/documents/in/boleta/'.$nombre.'.csv';

            }

            //copy($origen,$destino);
            rename($origen, $destino);

        }
        
        $respuesta = "okA";
		return $respuesta;

    }  

    //*GENERAR NUBE NOTA CREDITO
	static public function ctrGenerarFENCA(){

        if(isset($_POST["tipo"])){

            $datos = ModeloFacturacion::mdlFENCACabA($_POST["tipo"], $_POST["documento"]);
            //var_dump($datos);

            //todo: FILA 1
            $fila1 =    $datos["a1"].','.
                        $datos["b1"].','.
                        $datos["c1"].','.  
                        $datos["d1"].','.  
                        $datos["e1"].','.  
                        $datos["f1"].',,,,,,,'.
                        $datos["m1"].',,,'.
                        $datos["p1"].',,,,'.
                        $datos["t1"].',,,,,,,,,,,'.
                        $datos["ae1"].',,,,,'.
                        $datos["aj1"].','.
                        $datos["ak1"].',,,'.
                        $datos["an1"].',';

            //todo: FILA 2
            $fila2 = ',,,,,,,,,';                           

            //todo: FILA 3
            $fila3 =    $datos["a3"].','.
                        $datos["b3"].','. 
                        $datos["c3"].','.
                        $datos["d3"].','.
                        $datos["e3"].','.
                        $datos["f3"].','.
                        $datos["g3"].','.
                        $datos["h3"].','.
                        $datos["i3"].','.
                        $datos["j3"].','.
                        $datos["k3"].','.
                        $datos["l3"].','.
                        '0000'.',';
                        
            //todo: FILA 4
            $fila4 =    $datos["a4"].','.
                        $datos["b4"].','. 
                        $datos["c4"].','.
                        $datos["d4"].','.
                        $datos["e4"].','.
                        $datos["f4"].','.
                        $datos["g4"].','.
                        $datos["h4"].','.
                        $datos["i4"].','.
                        $datos["j4"].','.
                        $datos["k4"].','.
                        $datos["l4"].',';                              
                        
            //todo: FILA 5
            require_once("/../extensiones/cantidad_en_letras_v2.php");
            $monto_letras = convertir($datos["m1"]);
            $fila5 =    $monto_letras.',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,';

            //todo: FILA 6
            $fila6 =    $datos["a6"].',,,'.
                        $datos["d6"].','.
                        $datos["e6"].','.
                        $datos["f6"].','.
                        $datos["g6"].',,,,,,,,,,,,,,,,,,,,,,,,,,,,,';

            //todo: FILA 7
            $fila7 =    $datos["a7"].','.
                        $datos["b7"].','.
                        $datos["c7"].','.
                        $datos["d7"].','.
                        $datos["e7"].','.
                        $datos["f7"].',';                        

            $nombre = '20513613939-07'.'-'.$datos["b1"];

            $fp = fopen('../vistas/reportes_excel/csv_fe/'.$nombre.'.txt', 'w'); 
            
            fwrite($fp, $fila1.PHP_EOL);
            fwrite($fp, $fila2.PHP_EOL);
            fwrite($fp, $fila3.PHP_EOL);
            fwrite($fp, $fila4.PHP_EOL);
            fwrite($fp, $fila5.PHP_EOL);
            fwrite($fp, $fila6.PHP_EOL);
            fwrite($fp, $fila7.PHP_EOL);

            if( substr($_POST["documento"],0,4) == "B001" || 
                substr($_POST["documento"],0,4) == "F001"){

                    //*Uniaades

                    $datosD = ModeloFacturacion::mdlFENCDetA($_POST["tipo"], $_POST["documento"]);
                    //var_dump($datosD);
        
                    foreach($datosD as $key=>$value){
        
                        if($key < count($datosD)-1){
        
                            fwrite($fp,     ($key+1).','.
                                            $value["b9"].','.
                                            $value["c9"].','.
                                            $value["d9"].','.
                                            $value["e9"].','.
                                            $value["f9"].',,,'.
                                            $value["i9"].','.
                                            $value["j9"].','.
                                            $value["k9"].','.
                                            $value["l9"].','.
                                            $value["m9"].',,,,,,'.
                                            $value["s9"].','.
                                            $value["t9"].','.
                                            $value["u9"].',,,'.
                                            $value["x9"].',,,,,,'.
                                            $value["ad9"].',,,,,,'.
                                            "\r\n");
        
                        }else{
        
                            fwrite($fp, ($key+1).','.
                                        $value["b9"].','.
                                        $value["c9"].','.
                                        $value["d9"].','.
                                        $value["e9"].','.
                                        $value["f9"].',,,'.
                                        $value["i9"].','.
                                        $value["j9"].','.
                                        $value["k9"].','.
                                        $value["l9"].','.
                                        $value["m9"].',,,,,,'.
                                        $value["s9"].','.
                                        $value["t9"].','.
                                        $value["u9"].',,,'.
                                        $value["x9"].',,,,,,'.
                                        $value["ad9"].',,,,,,'.PHP_EOL);
                            fwrite($fp, 'FF00FF');
        
                        }					
        
                    }                    

            }else{

                //*CONCEPTO
                $datosD = ModeloFacturacion::mdlFENCDetB($_POST["tipo"], $_POST["documento"]);
                #var_dump($datosD["d8"]);   

                $datosD["d8"] = str_replace(",", "A", $datosD["d8"] );
 
                $fila8 =    '1'.','.
                            $datosD["b8"].','.
                            $datosD["c8"].','.
                            $datosD["d8"].','.
                            $datosD["e8"].','.
                            $datosD["f8"].',,,'.
                            $datosD["i8"].','.
                            $datosD["j8"].','.
                            $datosD["k8"].','.
                            $datosD["l8"].','.
                            $datosD["m8"].',,,,,,,'.
                            $datosD["t8"].','.
                            $datosD["u8"].',,,'.
                            $datosD["x8"].',,,,,,'.
                            $datosD["ad8"].',,,,,,';
   
                        fwrite($fp, $fila8.PHP_EOL);
                        fwrite($fp, 'FF00FF');

            }

            fclose($fp); 

            $origen = 'c:/xampp/htdocs/vascorp/vistas/reportes_excel/csv_fe/'.$nombre.'.txt';

                //?destino prueba
                $destino = 'c:/prueba/nc/'.$nombre.'.csv';

                //!destino produccion
                //!$destino = 'c:/daemonOSE21/documents/in/creditnote/'.$nombre.'.csv';


            //copy($origen,$destino);
            rename($origen, $destino);          

        }

        $respuesta = "okA";
		return $respuesta;

    }

    //*GENERAR NUBE DEBITO
	static public function ctrGenerarFENDA(){

        if(isset($_POST["tipo"])){

            $datos = ModeloFacturacion::mdlFENDACabA($_POST["tipo"], $_POST["documento"]);
            //var_dump($datos);

            //todo: FILA 1
            $fila1 =    $datos["a1"].','.
                        $datos["b1"].','.
                        $datos["c1"].','.  
                        $datos["d1"].','.  
                        $datos["e1"].','.  
                        $datos["f1"].',,,,,,,'.
                        $datos["m1"].',,,'.
                        $datos["p1"].',,,,'.
                        $datos["t1"].',,,,,,,,,,,'.
                        $datos["ae1"].',,,,,'.
                        $datos["aj1"].','.
                        $datos["ak1"].',,,'.
                        $datos["an1"].',';

            //todo: FILA 2
            $fila2 = ',,,,,,,,,';                           

            //todo: FILA 3
            $fila3 =    $datos["a3"].','.
                        $datos["b3"].','. 
                        $datos["c3"].','.
                        $datos["d3"].','.
                        $datos["e3"].','.
                        $datos["f3"].','.
                        $datos["g3"].','.
                        $datos["h3"].','.
                        $datos["i3"].','.
                        $datos["j3"].','.
                        $datos["k3"].','.
                        $datos["l3"].','.
                        '0000'.',';
                        
            //todo: FILA 4
            $fila4 =    $datos["a4"].','.
                        $datos["b4"].','. 
                        $datos["c4"].','.
                        $datos["d4"].','.
                        $datos["e4"].','.
                        $datos["f4"].','.
                        $datos["g4"].','.
                        $datos["h4"].','.
                        $datos["i4"].','.
                        $datos["j4"].','.
                        $datos["k4"].','.
                        $datos["l4"].',';                              
                        
            //todo: FILA 5
            require_once("/../extensiones/cantidad_en_letras_v2.php");
            $monto_letras = convertir($datos["m1"]);
            $fila5 =    $monto_letras.',,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,,';

            //todo: FILA 6
            $fila6 =    $datos["a6"].',,,'.
                        $datos["d6"].','.
                        $datos["e6"].','.
                        $datos["f6"].','.
                        $datos["g6"].',,,,,,,,,,,,,,,,,,,,,,,,,,,,,';

            //todo: FILA 7
            $fila7 =    $datos["a7"].','.
                        $datos["b7"].','.
                        $datos["c7"].','.
                        $datos["d7"].','.
                        $datos["e7"].','.
                        $datos["f7"].',';                        

            $nombre = '20513613939-08'.'-'.$datos["b1"];

            $fp = fopen('../vistas/reportes_excel/csv_fe/'.$nombre.'.txt', 'w'); 
            
            fwrite($fp, $fila1.PHP_EOL);
            fwrite($fp, $fila2.PHP_EOL);
            fwrite($fp, $fila3.PHP_EOL);
            fwrite($fp, $fila4.PHP_EOL);
            fwrite($fp, $fila5.PHP_EOL);
            fwrite($fp, $fila6.PHP_EOL);
            fwrite($fp, $fila7.PHP_EOL);

            $datosD = ModeloFacturacion::mdlFENDDetA($_POST["tipo"], $_POST["documento"]);
            //var_dump($datosD);

            foreach($datosD as $key=>$value){

                if($key < count($datosD)-1){
    
                    fwrite($fp,     ($key+1).','.
                                    $value["b8"].','.
                                    $value["c8"].','.
                                    $value["d8"].','.
                                    $value["e8"].','.
                                    $value["f8"].',,,'.
                                    $value["i8"].','.
                                    $value["j8"].','.
                                    $value["k8"].','.
                                    $value["l8"].','.
                                    $value["m8"].',,,,,,,'.
                                    $value["t8"].','.
                                    $value["u8"].',,,'.
                                    $value["x8"].',,,,,,'.
                                    $value["ad8"].',,,,,,'.
                                    "\r\n");

                }else{

                    fwrite($fp, ($key+1).','.
                                $value["b8"].','.
                                $value["c8"].','.
                                $value["d8"].','.
                                $value["e8"].','.
                                $value["f8"].',,,'.
                                $value["i8"].','.
                                $value["j8"].','.
                                $value["k8"].','.
                                $value["l8"].','.
                                $value["m8"].',,,,,,,'.
                                $value["t8"].','.
                                $value["u8"].',,,'.
                                $value["x8"].',,,,,,'.
                                $value["ad8"].',,,,,,'.PHP_EOL);
                    fwrite($fp, 'FF00FF');

                }				

            }            

            fclose($fp); 

            $origen = 'c:/xampp/htdocs/vascorp/vistas/reportes_excel/csv_fe/'.$nombre.'.txt';

                //?destino prueba
                $destino = 'c:/prueba/nd/'.$nombre.'.csv';

                //!destino produccion
                //!$destino = 'c:/daemonOSE21/documents/in/debitnote/'.$nombre.'.csv';


            //copy($origen,$destino);
            rename($origen, $destino);               

        }

        $respuesta = "okA";
		return $respuesta;

    }    

    static public function ctrAnularDocumento(){

        if(isset($_GET["documento"])){

            $documento=$_GET["documento"];
            $tipo=$_GET["tipo"];
            #var_dump($documento,$tipo);

            #regresar stock al almacén
            $articulo = ModeloFacturacion::mdlRegresarStock($tipo, $documento);
            #var_dump($articulo);     

            #eliminar movimientos detalle
            $detalle = ModeloFacturacion::mdlEliminarDetalle($tipo, $documento);
            #var_dump($detalle);   

            $usureg = $_SESSION["nombre"];
            $pcreg = gethostbyaddr($_SERVER['REMOTE_ADDR']);

            #anular cabecera
            $cabecera = ModeloFacturacion::mdlAnularCabecera($tipo, $documento,$_SESSION["id"], $usureg, $pcreg);
            #var_dump($cabecera); 

            #eliminar cta cte
            if($tipo == "S03"){

                $tip = "01";
                $pagina = "facturas";

            }else if($tipo == "S02"){

                $tip = "03";
                $pagina = "boletas";

            }else if($tipo == "E05"){

                $tip = "07";
                $pagina = "ver-nota-credito";

            }else if($tipo = "S70"){

                $tip = "09";
                $pagina = "proformas";

            }else if($tipo = "S01"){

                $tip = "AA";
                $pagina = "guias-remision";

            }

            $cta = ModeloFacturacion::mdlEliminarCta($tip, $documento);
            #var_dump($cta); 

            if($cabecera == "ok"){

                echo'<script>

                swal({
                    type: "success",
                    title: "El documento ha sido anulada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then(function(result){
                        if (result.value) {

                        window.location = "'.$pagina.'";

                        }
                    })
    
                </script>';

            }

        }
    
    }    

    static public function ctrEliminarDocumento(){

        if(isset($_GET["documentoE"])){

            $documento=$_GET["documentoE"];
            $tipo=$_GET["tipo"];
            $pagina=$_GET["pagina"];
            var_dump($documento, $tipo, $pagina);

            $respuesta = ModeloFacturacion::mdlEliminarDocumento($tipo, $documento);
            var_dump($respuesta);

            if($respuesta == "ok"){

                echo'<script>

                swal({
                    type: "success",
                    title: "El documento ha sido anulada correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false
                    }).then(function(result){
                        if (result.value) {

                        window.location = "'.$pagina.'";

                        }
                    })
    
                </script>';

            }            

        }

    }      

}