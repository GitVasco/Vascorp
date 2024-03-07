<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Editar lote Corte

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Editar lote corte</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-12">

                <div class="box box-primary">

                    <div class="box-header with-border">

                        <h4 class="box-title">Editar lote corte</h4>

                        <div class="row">

                            <div class="col-xs-1">

                                <label>Corte</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Fecha</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Modelo</label>

                            </div>

                            <div class="col-xs-3">

                                <label>Nombre</label>

                            </div>

                            <div class="col-xs-2">

                                <label>Color</label>

                            </div>

                            <div class="col-xs-2">

                                <label>Cantidad</label>

                            </div>

                            <div class="col-xs-2">

                                <label>Lote</label>

                            </div>

                        </div>


                        <?php
                        $ac = $_GET["codigo"];

                        $articulosLotes = ModeloAlmacenCorte::mdlVerLotes($ac);

                        foreach ($articulosLotes as $key => $value) :

                        ?>
                            <div class="row" style="margin-top:10px">

                                <div class="col-xs-1">

                                    <input type="text" class="form-control" name="corte<?= $key ?>" id="corte<?= $key ?>" value="<?= $value["almacencorte"] ?>" readonly>

                                </div>

                                <div class="col-xs-1">

                                    <input type="text" class="form-control" name="fecha<?= $key ?>" id="fecha<?= $key ?>" value="<?= $value["fecha"] ?>" readonly>

                                </div>

                                <div class="col-xs-1">

                                    <input type="text" class="form-control" name="modelo<?= $key ?>" id="modelo<?= $key ?>" value="<?= $value["modelo"] ?>" readonly>

                                </div>

                                <div class="col-xs-3">

                                    <input type="text" class="form-control" name="nombre<?= $key ?>" id="nombre<?= $key ?>" value="<?= $value["nombre"] ?>" readonly>

                                </div>

                                <div class="col-xs-2">

                                    <input type="text" class="form-control" name="color<?= $key ?>" id="color<?= $key ?>" value="<?= $value["color"] ?>" readonly>

                                </div>

                                <div class="col-xs-2">

                                    <input type="text" class="form-control" name="cantidad<?= $key ?>" id="cantidad<?= $key ?>" value="<?= $value["cantidad"] ?>" readonly>

                                </div>

                                <div class="col-xs-2">

                                    <input type="text" class="form-control loteCorte" name="lote<?= $key ?>" id="lote<?= $key ?>" ac="<?= $value["almacencorte"] ?>" articulo="<?= $value["modelo"] . $value["cod_color"] ?>" value="<?= $value["lote"] ?>">

                                </div>

                            </div>
                        <?php endforeach; ?>

                        <!-- Creamos un boton guardar, pero q solo vaya a la pagina almacencorte -->
                        <div class="box-footer">

                            <button id="guardarCambios" class="btn btn-primary">Guardar Cambios</button>

                        </div>


                    </div>
                </div>
            </div>

        </div>

    </section>

</div>

<script>
    window.document.title = "Editar cortes x Lote"
</script>