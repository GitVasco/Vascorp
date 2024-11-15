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

                                <label>MP</label>

                            </div>

                            <div class="col-xs-3">

                                <label>Descripcion</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Color</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Cons. Act</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Cons. Real</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Diferencia</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Cant. Rec</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Merma</label>

                            </div>

                            <div class="col-xs-1">

                                <label>MP Disp</label>

                            </div>

                            <div class="col-xs-1">

                                <label>Guardar</label>
                            </div>

                        </div>


                        <?php
                        $ac = $_GET["codigo"];
                        $articulosLotes = ModeloAlmacenCorte::mdlVerConsumos($ac);

                        foreach ($articulosLotes as $key => $value) :
                        ?>
                            <div class="row" style="margin-top:10px" data-id="<?php echo $value['id']; ?>">

                                <!--------------------------------
        * CodProducto
        --------------------------------->
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" id="mat_pri_<?php echo $value['id']; ?>" value="<?php echo $value["mat_pri"]; ?>" readonly>
                                </div>

                                <!--------------------------------
        * Descripcion
        --------------------------------->
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" id="despro_<?php echo $value['id']; ?>" value="<?php echo $value["despro"]; ?>" readonly>
                                </div>

                                <!--------------------------------
        * Color
        --------------------------------->
                                <div class="col-xs-2">
                                    <input type="text" class="form-control" id="colpro_<?php echo $value['id']; ?>" value="<?php echo $value["des_larga"]; ?>" readonly>
                                </div>

                                <!--------------------------------
        * Consumo Actual
        --------------------------------->
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" id="cons_total_<?php echo $value['id']; ?>" value="<?php echo $value["cons_total"]; ?>" readonly>
                                </div>

                                <!--------------------------------
        * Consumo Real (Editable)
        --------------------------------->
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" id="cons_real_<?php echo $value['id']; ?>" value="<?php echo $value["cons_real"]; ?>" oninput="calcularDiferencia('<?php echo $value['id']; ?>'); calcularMpDisponible('<?php echo $value['id']; ?>');">
                                </div>

                                <!--------------------------------
        * Diferencia (Calculado)
        --------------------------------->
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" id="diferencia_<?php echo $value['id']; ?>" value="<?php echo $value["diferencia"]; ?>" readonly>
                                </div>

                                <!--------------------------------
        * Cantidad Recibida (Editable)
        --------------------------------->
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" id="cant_entregada_<?php echo $value['id']; ?>" value="<?php echo $value["cant_entregada"]; ?>" oninput="calcularMpDisponible('<?php echo $value['id']; ?>');">
                                </div>

                                <!--------------------------------
        * Merma (Editable)
        --------------------------------->
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" id="merma_<?php echo $value['id']; ?>" value="<?php echo $value["merma"]; ?>" oninput="calcularMpDisponible('<?php echo $value['id']; ?>');">
                                </div>

                                <!--------------------------------
        * Mp disponible (Calculado)
        --------------------------------->
                                <div class="col-xs-1">
                                    <input type="text" class="form-control" id="mp_sinuso_<?php echo $value['id']; ?>" value="<?php echo $value["mp_sinuso"]; ?>" readonly>
                                </div>

                                <!-- Botón para guardar cambios -->
                                <div class="col-xs-1">
                                    <button class="btn btn-primary" onclick="guardarCambios('<?php echo $value['id']; ?>')">Guardar</button>
                                </div>

                            </div>
                        <?php endforeach; ?>




                        <!-- Creamos un boton guardar, pero q solo vaya a la pagina almacencorte -->
                        <div class="box-footer">

                            <!--------------------------------
                            * Boton Atras
                            --------------------------------->
                            <a href="almacencorte" class="btn btn-danger">Atrás</a>


                        </div>


                    </div>
                </div>
            </div>

        </div>

    </section>

</div>

<script>
    window.document.title = "Editar consumo"
</script>