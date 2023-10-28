<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Seguimiento

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Urgencias</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="col-lg-2">
                    <select name="selectArticuloUrgenciaSeg" id="selectArticuloUrgenciaSeg" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
                        <option value="">--------Seleccionar articulo-------</option>
                        <?php
                        $modelos = controladorModelos::ctrMostrarModelosActivos();
                        // var_dump($modelos);
                        foreach ($modelos as $key => $value) {
                            echo '<option value="' . $value["modelo"] . '">' . $value["nombre"] . '</option>';
                        }

                        ?>
                    </select>
                </div>

                <div class="col-lg-1">
                    <button class="btn btn-primary btnLimpiarArticuloUrgenciaSeg" name="btnLimpiarArticuloUrgenciaSeg"><i class="fa fa-refresh"></i> Limpiar</button>
                </div>
                <a href="vistas/reportes_excel/rpt_seguimiento.php" class="btn btn-default pull-right" style="border:green 1px solid">

                    <img src="vistas/img/plantilla/excel.png" width="20px"> SEGUIMIENTO

                </a>


            </div>

            <div class="box-body">

                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

                <table class="table table-bordered table-striped dt-responsive tablaSeguimiento" width="100%">

                    <thead>

                        <tr>

                            <th>Modelo</th>
                            <th>Nombre</th>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Estado</th>
                            <th>Proyección</th>
                            <th>% Avance</th>
                            <th>Stock</th>
                            <th>Pedidos</th>
                            <th>En Taller</th>
                            <th>En Servicio</th>
                            <th>Alm. Corte</th>
                            <th>Ord. Corte</th>
                            <th>Ult 30d</th>
                            <th>Duración Mes</th>
                            <th>Und. Faltantes</th>
                            <th>MP Faltante</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                    <tbody>


                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL CONFIGURAR MATERIA PRIMA FALTANTE
======================================-->

<div id="modalMpFaltante" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 70% !important;">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Configurar Porcentaje</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA CODIGO DEL ARTICULO-->

                        <div class="form-group col-lg-2">

                            <label>Artículo</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <b><input type="text" class="form-control input-sm" name="articuloA" id="articuloA" required readonly></b>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL MODELO-->

                        <div class="form-group col-lg-2">

                            <label>Modelo</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <input type="text" class="form-control input-sm" name="modeloA" id="modeloA" required readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA DESCRIPCION-->

                        <div class="form-group col-lg-4">

                            <label>Descripción</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <b><input type="text" class="form-control input-sm" name="nombreA" id="nombreA" required readonly></b>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL COLOR -->

                        <div class="form-group col-lg-2">

                            <label>Color</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <b><input type="text" class="form-control input-sm" name="colorA" id="colorA" required readonly></b>

                                <input type="hidden" class="form-control input-sm" name="cod_color" id="cod_color" required readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA TALLA-->

                        <div class="form-group col-lg-2">

                            <label>Talla</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <b><input type="text" class="form-control input-sm" name="tallaA" id="tallaA" required readonly></b>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL STOCK-->

                        <div class="form-group col-lg-2">

                            <label>Stock</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <b><input type="text" class="form-control input-sm" name="stockA" id="stockA" required readonly></b>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LOS PEDIDOS-->

                        <div class="form-group col-lg-2">

                            <label>Pedidos</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <input type="text" class="form-control input-sm" name="pedidosA" id="pedidosA" required readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA ESTADO-->

                        <div class="form-group col-lg-2">

                            <label>Estado</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <b><input type="text" class="form-control input-sm" name="estadoA" id="estadoA" required readonly></b>

                            </div>

                        </div>

                        <!-- ENTRADA PARA MATERIA PRIMA FALTANTE-->

                        <div class="form-group col-lg-6">

                            <label>Mp Faltante</label>

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                                <b><input type="text" class="form-control input-sm" name="mpFaltante" id="mpFaltante"></b>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar Mp Faltante</button>

                </div>

            </form>

            <?php

            $mpFaltante = new controladorArticulos();
            $mpFaltante->ctrMpFaltante();

            ?>


        </div>

    </div>

</div>

<script>
    window.document.title = "Seguimiento"
</script>