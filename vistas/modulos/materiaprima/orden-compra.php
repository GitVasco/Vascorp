<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Orden de compra

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Orden de compra</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <a href="crear-orden-compra">

                    <button class="btn btn-primary">

                        Agregar Orden de compra

                    </button>

                </a>

                <button class="btn btn-outline-success btnReporteOCompraEmitida" style="border:green 1px solid" inicio="" fin="">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> OCompra Emitidas
                </button>

                <button class="btn btn-outline-success btnReporteOCompraCerrada" style="border:green 1px solid" inicio="" fin="">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> OCompra Cerradas
                </button>

                <button class="btn btn-outline-success btnReporteOCompraParcial" style="border:green 1px solid" inicio="" fin="">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> OCompra Parciales
                </button>

                <button class="btn btn-outline-success btnReporteOCompraGeneral" style="border:green 1px solid" inicio="" fin="">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> OCompra General Detallado
                </button>

                <button type="button" class="btn btn-default pull-right" id="daterange-btnOrdenCompra">
                    <span>
                        <i class="fa fa-calendar"></i>

                        <?php

                        if (isset($_GET["fechaInicial"])) {

                            echo $_GET["fechaInicial"] . " - " . $_GET["fechaFinal"];
                        } else {

                            echo 'Rango de fecha';
                        }

                        ?>

                    </span>

                    <i class="fa fa-caret-down"></i>

                </button>

            </div>




            <div class="box-body">

                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
                <table class="table table-bordered table-striped dt-responsive tablaOrdenesCompras" width="100%">

                    <thead>

                        <tr>

                            <th>Est</th>
                            <th>Serie</th>
                            <th>Numero</th>
                            <th>Proveedor</th>
                            <th>Fec. Emisión</th>
                            <th>Responsable</th>
                            <th>Estado</th>
                            <th>Cerrar</th>
                            <th style="width:170px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>



<!--=====================================
MODAL VIZUALIZAR ORDEN DE COMPRA
======================================-->

<div id="modalVisualizarOrdenCompra" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 75% !important;">

        <div class="modal-content">


            <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">VISUALIZAR ORDEN DE COMPRA</h4>

            </div>

            <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

            <div class="modal-body">

                <div class="box-body">

                    <div class="form-group col-lg-2">

                        <label>CODIGO</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-key"></i></span>

                            <input type="text" class="form-control input-sm" name="codigo" id="codigo" readonly>

                        </div>

                    </div>

                    <div class="form-group col-lg-2">

                        <label>PROVEEDOR</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                            <input type="text" class="form-control input-sm" name="proveedor" id="proveedor" readonly>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA GUIA-->

                    <div class="form-group col-lg-4">

                        <label>RAZON SOCIAL</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-truck"></i></span>
                            <input type="text" class="form-control input-sm" name="razonsocial" id="razonsocial" readonly>
                        </div>

                    </div>

                    <!-- ENTRADA PARA LA FECHA-->

                    <div class="form-group col-lg-2">

                        <label>RUC</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span>

                            <input type="number" class="form-control input-sm" name="ruc" id="ruc" readonly>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA FECHA-->

                    <div class="form-group col-lg-2">

                        <label>ESTADO</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                            <input type="text" class="form-control input-sm" name="estado" id="estado" readonly>

                        </div>

                    </div>


                    <!-- ENTRADA PARA LA RESPONSABLE-->

                    <div class="form-group col-lg-2">

                        <label>FECHA EMISION</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                            <input type="text" class="form-control input-sm" name="emision" id="emision" readonly>
                        </div>

                    </div>


                    <!-- ENTRADA PARA LA CANTIDAD-->

                    <div class="form-group col-lg-2">

                        <label>FECHA ENTREGA</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                            <input type="text" class="form-control input-sm" name="entrega" id="entrega" readonly>

                        </div>

                    </div>

                    <!-- ENTRADA PARA EL ESTADO-->

                    <div class="form-group col-lg-6">

                        <label for="">OBSERVACION</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                            <input type="text" class="form-control input-sm" name="observacion" id="observacion" readonly>

                        </div>

                    </div>

                    <!-- ENTRADA PARA LA CANTIDAD-->

                    <div class="form-group col-lg-2">

                        <label>CENT COSTO</label>

                        <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                            <select class="form-control input-sm" name="centcosto" id="centcosto" disabled>
                                <?php

                                $centro = ControladorMaestras::ctrMostrarMaestrasDetalle("TDET");


                                foreach ($centro as $key => $value) {

                                    echo '<option value="' . $value["des_corta"] . '">' . $value["des_larga"] . '</option>';
                                }
                                ?>
                            </select>

                        </div>

                    </div>


                    <div class="form-group col-lg-12">
                        <table class="table table-hover table-striped tablaDetalleOrdenCompra" width="100%">
                            <thead>

                                <th>Item</th>
                                <th>Cod.Pro</th>
                                <th style="min-width:240px">Descripcion</th>
                                <th>Color</th>
                                <th>Und</th>
                                <th style="min-width:80px">Cantidad</th>
                                <th style="min-width:80px">Recibido</th>
                                <th align="left" style="min-width:80px">Pendiente</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <!--=====================================
        PIE DEL MODAL
        ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>


            </div>



        </div>

    </div>

</div>

<?php

$anularOrdenCompra = new ControladorOrdenCompra();
$anularOrdenCompra->ctrAnularOrdenCompra();

?>

<script>
    window.document.title = "Orden de compra"
</script>