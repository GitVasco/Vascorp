<div class="content-wrapper">
    <section class="content-header">
        <h1>Editar Produccion</h1>

        <ol class="breadcrumb">
            <li>
                <a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a>
            </li>

            <li class="active">Editar Produccion</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <a href="ingresos">
                    <button class="btn btn-danger">
                        <i class="fa fa-arrow-left"></i> Volver
                    </button>
                </a>
            </div>

            <div class="box-body">
                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["idIngreso"]; ?>" id="codigoIngreso">

                <table class="table table-bordered table-striped dt-responsive tablaEditarDetalleIngreso" width="100%">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th class="text-center">Articulo</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Color</th>
                            <th class="text-center">Talla</th>
                            <th class="text-center">Marca</th>
                            <th>
                                <center>Cantidad Total</center>
                            </th>
                            <th class="text-center">Saldo</th>
                            <th style="width: 150px">Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </section>
</div>

<div id="modalEditarDetalleIngreso" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width:50%">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Editar Detalle Orden Corte</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">

                            <input type="hidden" class="form-control input-md" name="cantidadO" id="cantidadO">

                            <input type="hidden" class="form-control input-md" name="saldoO" id="saldoO">

                            <input type="hidden" class="form-control input-md" name="codigo" id="codigo">

                            <input type="hidden" class="form-control input-md" name="sector" id="sector">

                            <input type="hidden" class="form-control input-md" name="idcierre" id="idcierre">

                            <input type="hidden" class="form-control input-md" name="almacen" id="almacen">

                            <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Artículo</label>
                            <div class="col-lg-2">

                                <input type="text" class="form-control input-md" name="articulo" id="articulo" readonly required>

                            </div>

                            <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Modelo</label>
                            <div class="col-lg-2">

                                <input type="text" class="form-control input-md" name="modelo" id="modelo" readonly required>

                            </div>

                            <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Nombre</label>
                            <div class="col-lg-5">

                                <input type="text" class="form-control input-md" name="nombre" id="nombre" readonly required>

                            </div>

                            <div class="col-lg-12"></div>

                            <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Color</label>
                            <div class="col-lg-2">

                                <input type="text" class="form-control input-md" name="color" id="color" readonly required>

                            </div>

                            <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Talla</label>
                            <div class="col-lg-2">

                                <input type="text" class="form-control input-md" name="talla" id="talla" readonly required>

                            </div>

                            <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Cantidad</label>
                            <div class="col-lg-2">

                                <input type="number" class="form-control input-md" min="1" name="cantidad" id="cantidad" required>

                            </div>

                            <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">Saldo</label>
                            <div class="col-lg-2">

                                <input type="number" class="form-control input-md" name="saldo" id="saldo" required readonly>

                            </div>

                        </div>



                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>

                </div>

                <?php

                $editarDetalle = new ControladorIngresos();
                $editarDetalle->ctrEditarIngresoB();

                ?>

            </form>

        </div>

    </div>

</div>

<script>
    window.document.title = "Editar Producción"
</script>