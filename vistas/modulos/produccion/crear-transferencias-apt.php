<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Crear transferencia

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear transferencia</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            EL FORMULARIO
            ======================================-->
            <div class="col-lg-6 col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <form role="form" metohd="post" class="formularioTransferencia">

                        <?php

                        date_default_timezone_set('America/Lima');
                        $ahora = date('Y/m/d h:i:s');

                        if (empty($_GET["codigo"])) {

                            $correlativo = ModeloTalonarios::mdlMostrarTalonariosC("transapt");

                            $talonario = "T" . str_pad($_SESSION["id"], 2, '0', STR_PAD_LEFT) . str_pad($correlativo["actual"], 7, '0', STR_PAD_LEFT);

                            $listaArtPed = ModeloSalidas::mdlMostraDetallesTemporal("detalle_ing_sal", $talonario);
                        } else {
                            $talonario = $_GET["codigo"];

                            $tabla = "ing_sal";
                            $transferencia = ModeloPedidos::mdlMostrarTemporal($tabla, $talonario);

                            $almacenVen = $transferencia["vendedor"] == "01" ? "01 - Almacen APT" : "05 - Almacen Show Room";
                            $almacenCli = $transferencia["cliente"] == "01" ? "01 - Almacen APT" : "05 - Almacen Show Room";


                            $listaArtPed = ModeloSalidas::mdlMostraDetallesTemporal("detalle_ing_sal", $talonario);
                        }

                        ?>

                        <div class="box-body">

                            <div class="box">

                                <!--=====================================
                                ENTRADA DEL VENDEDOR
                                ======================================-->
                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                        <input type="text" class="form-control" id="nombreUsuario" name="nombreUsuario" value="<?php echo $_SESSION["nombre"] ?>" readonly>

                                        <input type="hidden" class="form-control" id="idUsuario" name="idUsuario" value="<?php echo $_SESSION["id"] ?>" readonly>

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL VENDEDOR
                                ======================================-->
                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                        <input type="text" class="form-control" id="nuevoCodigo" name="nuevoCodigo" value="<?php echo $talonario ?>" readonly>

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL ALMACEN DE ORIGEN
                                ======================================-->
                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                        <?php if (empty($_GET["codigo"])) : ?>

                                            <select class="form-control" name="almacenOrigen" id="almacenOrigen">

                                                <option value="">Seleccione Almacen Origen</option>
                                                <option value="01">01 - Almacen APT</option>
                                                <option value="05">05 - Almacen Show Room</option>

                                            </select>

                                        <?php else : ?>

                                            <input type="text" class="form-control" id="almacenOrigen" name="almacenOrigen" value="<?php echo $almacenVen ?>" readonly>

                                        <?php endif ?>

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL ALMACEN DE DESTINO
                                ======================================-->
                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                        <?php if (empty($_GET["codigo"])) : ?>

                                            <select class="form-control" name="almacenDestino" id="almacenDestino">

                                                <option value="">Seleccione Almacen Destino</option>
                                                <option value="01">01 - Almacen APT</option>
                                                <option value="05">05 - Almacen Show Room</option>

                                            </select>

                                        <?php else : ?>

                                            <input type="text" class="form-control" id="almacenDestino" name="almacenDestino" value="<?php echo $almacenCli ?>" readonly>

                                        <?php endif ?>


                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->
                                <div class="form-group row nuevoProducto">

                                    <div class="box box-primary">

                                        <div class="row">

                                            <div class="col-xs-10">

                                                <label>Item</label>

                                            </div>

                                            <div class="col-xs-2">

                                                <label>Cantidad</label>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="box box-primary" id="updDiv">
                                        <?php foreach ($listaArtPed as $key => $value) : ?>

                                            <?php
                                            $infoArtPed = controladorArticulos::ctrMostrarArticulos($value["articulo"]);

                                            $total_detalle = $value["cantidad"] * $value["precio"];
                                            ?>

                                            <!-- Descripción del producto -->

                                            <div class="col-xs-10" style="padding-right:0px">

                                                <div class="input-group">

                                                    <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarArtTrans" articulo=<?php echo $value["articulo"] ?>><i class="fa fa-times"></i></button></span>

                                                    <input type="text" class="form-control nuevaTransArticulo" id="addDescTrans" name="addDescTrans" value="<?php echo $infoArtPed["packing"] ?>" articulo=<?php echo $value["articulo"] ?> articuloP=<?php echo $value["articulo"] ?> readonly>

                                                </div>

                                            </div>

                                            <!-- Cantidad del producto -->

                                            <div class="col-xs-2">

                                                <input type="number" class="form-control nuevaCantidadArtTrans" id="addCantTrans" name="addCantTrans" min="1" value=<?php echo $value["cantidad"] ?> artPed="<?php $infoArtPed["pedidos"] ?>" required readonly>

                                            </div>

                                        <?php endforeach ?>
                                    </div>


                                    <input type="hidden" id="listaArticulosTransferencia" name="listaArticulosTransferencia">

                                </div>

                            </div>

                        </div>

                        <div class="box-footer">

                            <a href="transferencias-apt" class="btn btn-primary pull-right">Guardar registro</a>


                        </div>

                    </form>

                </div>

            </div>

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->
            <div class="col-lg-6 hidden-md hidden-sm hidden-xs">

                <div class="box box-warning">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                        <label for="" class="col-form-label col-lg-2">Modelo</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control input-md" id='modelo' name='modelo'>
                        </div>
                        <div class="form-group col-lg-2">
                            <button class='btn btn-primary btn-md modificarTransf' data-toggle='modal' data-target='#modalArticuloTransferencia' id="botonTrans" disabled>Agregar</button>
                        </div>

                        <div class="form-group col-lg-2">
                            <button class='btn btn-success btn-md refreshDetalle' pedido='<?php echo $codigo; ?>'><i class="fa fa-refresh"></i></button>
                        </div>

                    </div>

                    <div class="box-body" id="updDivB">

                        <div class="zona_impresion">
                            <table border="1" align="left" width="700px">

                                <thead>
                                    <tr>
                                        <th style="width:10%"></th>
                                        <th style="width:20%"></th>
                                        <th style="width:6%">S</th>
                                        <th style="width:6%">M</th>
                                        <th style="width:6%">L</th>
                                        <th style="width:6%">XL</th>
                                        <th style="width:6%">XXL</th>
                                        <th style="width:6%">XS</th>
                                        <th style="width:6%"></th>
                                        <th style="width:6%"></th>
                                        <th style="width:6%"></th>
                                    </tr>

                                    <tr>
                                        <th style="width:10%"></th>
                                        <th style="width:20%"></th>
                                        <th style="width:6%">28</th>
                                        <th style="width:6%">30</th>
                                        <th style="width:6%">32</th>
                                        <th style="width:6%">34</th>
                                        <th style="width:6%">36</th>
                                        <th style="width:6%">38</th>
                                        <th style="width:6%">40</th>
                                        <th style="width:6%">42</th>
                                        <th style="width:6%"></th>
                                    </tr>

                                    <tr>
                                        <th style="width:10%;text-align:left;">Modelo</th>
                                        <th style="width:20%">Color</th>
                                        <th style="width:6%">3</th>
                                        <th style="width:6%">4</th>
                                        <th style="width:6%">6</th>
                                        <th style="width:6%">8</th>
                                        <th style="width:6%">10</th>
                                        <th style="width:6%">12</th>
                                        <th style="width:6%">14</th>
                                        <th style="width:6%">16</th>
                                        <th style="width:6%">TOTAL</th>
                                    </tr>
                                </thead>

                            </table>

                            <?php

                            $modelo = ModeloSalidas::mdlSalidaImpresionMod($talonario);

                            foreach ($modelo as $key => $value) {
                                echo '<table class="tablaVerPed" border="1" style="border:dashed" align="left" width="700px">';

                                $respuesta = ModeloSalidas::mdlSalidaImpresion($talonario, $value["modelo"]);

                                foreach ($respuesta as $key => $value2) {
                                    $output = [];
                                    for ($i = 1; $i <= 8; $i++) {
                                        $key = "t" . $i;
                                        $output[$key] = ($value2[$key] <= 0) ? " " : $value2[$key];
                                    }

                                    echo '<tr>
                                        <th style="width:10%;font-weight: normal;text-align:left;"><button class="btn-link" modelo="' . $value2["modelo"] . '" pedido="' . $talonario . '">' . $value2["modelo"] . '</button></th>
                                        <th style="width:20%;text-align:left;">' . $value2["color"] . '</th>';

                                    for ($i = 1; $i <= 8; $i++) {
                                        echo '<th style="width:6%;font-weight: normal;"><button class="btn-link" modelo="' . $value2["modelo"] . $value2["cod_color"] . $i . '" pedido="' . $talonario . '">' . $output["t" . $i] . '</button></th>';
                                    }

                                    echo '<th style="width:6%">' . $value2["total"] . '</th>
                                    </tr>';
                                }

                                echo '</table>';
                            }

                            ?>


                        </div>


                    </div>

                </div>


            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL MODIFICAR ARTICULOS
======================================-->

<div id="modalArticuloTransferencia" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 60% !important;">

        <div class="modal-content">

            <!-- <form role="form" method="post" class="formularioPedido"> -->
            <form role="form" method="post" class="formularioPedido">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Detalle Artículos</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <div class="box box-primary">

                            <div class="form-group col-lg-3">

                                <div class="input-group">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-sm" id="modeloModalA" name="modeloModalA" readonly>

                                    <input type="hidden" id="pedidoCod" name="pedidoCod">
                                    <input type="hidden" id="almOri" name="almOri">
                                    <input type="hidden" id="almDes" name="almDes">

                                </div>

                            </div>

                        </div>

                        <div class="box box-warning col-lg-12">

                            <!-- TABLA DE DETALLES -->

                            <label>TABLA DETALLES</label>

                            <div class="box-body">

                                <table class="table table-bordered table-striped dt-responsive tablaColTal" width="100%">

                                    <thead>

                                        <tr>
                                            <th style="width:50px"></th>
                                            <th style="width:200px"></th>
                                            <th style="width:100px">S</th>
                                            <th style="width:100px">M</th>
                                            <th style="width:100px">L</th>
                                            <th style="width:100px">XL</th>
                                            <th style="width:100px">XXL</th>
                                            <th style="width:100px">XS</th>
                                            <th style="width:100px"></th>
                                            <th style="width:100px"></th>
                                        </tr>

                                        <tr>
                                            <th style="width:50px"></th>
                                            <th style="width:200px"></th>
                                            <th style="width:100px">28</th>
                                            <th style="width:100px">30</th>
                                            <th style="width:100px">32</th>
                                            <th style="width:100px">34</th>
                                            <th style="width:100px">36</th>
                                            <th style="width:100px">38</th>
                                            <th style="width:100px">40</th>
                                            <th style="width:100px">42</th>
                                        </tr>

                                        <tr>
                                            <th style="width:50px">Modelo</th>
                                            <th style="width:200px">Color</th>
                                            <th style="width:100px">3</th>
                                            <th style="width:100px">4</th>
                                            <th style="width:100px">6</th>
                                            <th style="width:100px">8</th>
                                            <th style="width:100px">10</th>
                                            <th style="width:100px">12</th>
                                            <th style="width:100px">14</th>
                                            <th style="width:100px">16</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        <tr class="detalleCT">

                                        </tr>

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="box box-success">

                    <div class="form-group col-lg-4">

                        <label> Total Unidades</label>

                        <div class="input-group">

                            <input type="text" name="totalCantidadA" id="totalCantidadA" readonly>


                        </div>

                    </div>

                    <div class="form-group col-lg-4">

                    </div>

                    <div class="form-group col-lg-4">

                        <label></label>

                        <div class="input-group">

                            <button type="button" class="btn btn-success pull-left btnCalTransferencia">Calcular</button>

                        </div>


                    </div>

                </div>


                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar Modelo</button>

                </div>



            </form>

            <?php

            $crearPedido = new controladorTransferencias();
            $crearPedido->ctrCrearTransferencia();

            ?>

        </div>

    </div>

</div>


<script>
    window.document.title = "Crear Tranferencia"
</script>