<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Articulos Enviados a Taller / Servicio

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Articulos Enviados a Taller / Servicio</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-lg-6">

                <div class="box">

                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablaEstampado" width="100%">

                            <thead>

                                <tr>
                                    <th>Fecha</th>
                                    <th>Modelo</th>
                                    <th>Nombre</th>
                                    <th>Color</th>
                                    <th>Talla</th>
                                    <th>Cantidad</th>
                                    <th>Operario</th>
                                    <th>Acciones</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>

            </div>

            <div class="col-lg-6">
                <div class="box box-warning">

                    <form role="form" method="post" class="formularioRegistrarEstampados">

                        <div class="box-body">

                            <div class="box">

                                <!-- CODIGO DEL CORTE -->
                                <div class="form-group col-lg-3">

                                    <label>CORTE</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <?php
                                        $corte = ModeloCortes::mdlMostrarCortesLista();
                                        ?>

                                        <select class="form-control input-sm selectpicker" name="cortesEstampado" id="cortesEstampado" data-live-search="true" data-size="10" required>
                                            <option value="">Corte</option>
                                            <?php foreach ($corte as $key => $value) : ?>
                                                <option value="<?php echo $value['guia']; ?>"><?php echo $value['guia'] . ' - ' . $value['fecha']; ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                    </div>

                                </div>

                                <!-- articulos del corte -->
                                <div class="form-group col-lg-9">

                                    <label>ARTÍCULOS</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <select class="form-control input-sm selectpicker" name="articulosCorte" id="articulosCorte" data-live-search="true" data-size="10" required>

                                        </select>

                                        <input type="hidden" id="id_articulo" name="id_articulo">
                                        <input type="hidden" id="articulo" name="articulo">

                                        <input type="hidden" id="estampado" name="estampado">
                                    </div>

                                </div>

                                <!-- cantidad del corte -->
                                <div class="form-group col-lg-3">
                                    <label>Cant. Corte</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="text" class="form-control" id="cantidadOrigen" name="cantidadOrigen" readonly />

                                    </div>
                                </div>

                                <!-- cantidad del estampado -->
                                <div class="form-group col-lg-3">
                                    <label>Cant. Estampado</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="number" class="form-control" id="cantidadEstampado" name="cantidadEstampado" min="0" required />

                                    </div>
                                </div>

                                <!-- cantidad del merma -->
                                <div class="form-group col-lg-3">
                                    <label>Cant. merma</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="number" class="form-control" id="cantidadMerma" name="cantidadMerma" value="0" min="0" />

                                    </div>
                                </div>

                                <!-- cantidad del saldo -->
                                <div class="form-group col-lg-3">
                                    <label>Cant. Saldo</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="text" class="form-control" id="cantidadSaldo" name="cantidadSaldo" min="0" readonly />

                                    </div>
                                </div>


                                <!-- fecha -->
                                <div class="form-group col-lg-3">
                                    <label>Fecha</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>
                                        <!-- necsito agregar al input el value con la fecha actual usando php  -->

                                        <input type="date" class="form-control" id="fechaEstampado" name="fechaEstampado" value="<?php echo date("Y-m-d") ?>" />

                                    </div>
                                </div>

                                <!-- Operario -->
                                <div class="form-group col-lg-6">
                                    <label>Operario</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <select class="form-control input-sm selectpicker" name="operarioEstampado" id="operarioEstampado" data-live-search="true" data-size="10">
                                            <option value="">Operario</option>
                                            <option value="RAFAEL CERBERA">RAFAEL CERBERA</option>
                                            <option value="OTROS">OTROS</option>

                                        </select>

                                    </div>
                                </div>


                                <!-- Cerrar -->
                                <div class="form-group col-lg-3">
                                    <label>Cerrar</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <select class="form-control input-sm selectpicker" name="cerrarCorte" id="cerrarCorte" data-live-search="true" data-size="10">
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>

                                        </select>

                                    </div>
                                </div>


                                <!-- Inicio Preparacion -->
                                <div class="form-group col-lg-3">
                                    <label>Inicio Preparacion</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="time" class="form-control" id="inicioPreparacion" name="inicioPreparacion" />

                                    </div>
                                </div>

                                <!-- Fin Preparacion -->
                                <div class="form-group col-lg-3">
                                    <label>Fin Preparacion</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="time" class="form-control" id="finPreparacion" name="finPreparacion" />

                                    </div>
                                </div>

                                <!-- Inicio Produccion -->
                                <div class="form-group col-lg-3">
                                    <label>Inicio Produccion</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="time" class="form-control" id="inicioProduccion" name="inicioProduccion" />

                                    </div>
                                </div>

                                <!-- Fin Produccion -->
                                <div class="form-group col-lg-3">
                                    <label>Fin Produccion</label>

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span>

                                        <input type="time" class="form-control" id="finProduccion" name="finProduccion" />

                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right" id="btnGuardarEstampado"><i class="fa fa-floppy-o"></i> Guardar Registro</button>

                            <button type="button" class="btn btn-warning pull-right" id="btnActualizarEstampado" style="display:none;"><i class="fa fa-floppy-o"></i> Actualizar Registro</button>

                            <a href="estampado" id="cancel" name="cancel" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
                        </div>

                    </form>
                    <?php

                    $guardarRegistro = new ControladorCortes();
                    $guardarRegistro->ctrRegistrarEstampado();

                    ?>
                </div>
            </div>

        </div>



    </section>

</div>

<script>
    window.document.title = "Estampados"
</script>