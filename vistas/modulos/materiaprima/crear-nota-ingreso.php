<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Crear Nota de Ingreso

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear Nota de Ingreso</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            LA TABLA DE PRODUCTOS
            ======================================-->
            <div class="col-lg-12">
                <div class="box box-warning collapsed-box tablaCollapsada" id="tablaCollapsada" name="tablaCollapsada">
                    <div class="box-header with-border">
                        <h3 class="box-title">Seleccionar Materia Prima</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                            </button>
                        </div>

                    </div>
                    <div class="box-body">

                        <table class="table table-bordered table-striped dt-responsive tablaMpSOc" width="100%">

                            <thead>

                                <tr>
                                    <th>CodPro</th>
                                    <th>Cod. Fabrica</th>
                                    <th style="min-width: 300px;">Descripción</th>
                                    <th>Und</th>
                                    <th>Cod. Color</th>
                                    <th style="min-width: 120px;">Color</th>
                                    <th style="min-width: 80px;">Sin IGV</th>
                                    <th style="min-width: 80px;">Inc. IGV</th>
                                    <th style="min-width: 80px;">Stock Actual</th>
                                    <th style="min-width: 80px;">Saldo Oc</th>
                                    <th style="min-width: 80px;">Nro. OC</th>
                                    <th style="min-width: 300px;">Proveedor</th>
                                    <th>#</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>

            </div>


            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-12 col-xs-12">

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <form role="form" method="post" class="formularioNotaIngreso">

                        <div class="box-body">

                            <div class="box">

                                <?php
                                date_default_timezone_set('America/Lima');
                                $fecha = new DateTime();
                                ?>

                                <div class="form-group" style="padding-top:5px">

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Proveedor</label>
                                    <div class="col-lg-3">
                                        <select class="form-control input-sm selectpicker" data-live-search="true" name="nuevoProveedor" id="nuevoProveedor" required>

                                            <option value="">SELECCIONAR PROVEEDOR</option>

                                            <?php
                                            $item = null;
                                            $valor = null;

                                            $proveedores = ControladorProveedores::ctrMostrarProveedores($item, $valor);

                                            foreach ($proveedores as $key => $value) {

                                                echo '<option value="' . $value["CodRuc"] . '">' . $value["CodRuc"] . ' - ' . $value["RazPro"] . '</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Doc. Principal</label>
                                    <div class="col-lg-2">
                                        <select class="form-control input-sm" name="tipDocP" id="tipDocP" required>
                                            <option value="">Doc. Principal</option>
                                            <?php
                                            $documentos = ControladorNotasIngresos::ctrDocNI();
                                            #var_dump("ubigeo", $documentos);

                                            foreach ($documentos as $key => $value) {

                                                echo '<option value="' . $value["cod_argumento"] . '">' . $value["cod_argumento"] . ' - ' . $value["des_larga"] . '</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" class="form-control input-sm" id="nuevaSerieP" name="nuevaSerieP" placeholder="Serie">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" class="form-control input-sm" id="nuevoNroP" name="nuevoNroP" placeholder="Número">
                                    </div>

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Fec. Emision</label>
                                    <div class="col-lg-2">
                                        <input type="date" class="form-control input-sm" id="fecP" name="fecP" value="<?php echo $fecha->format("Y-m-d"); ?>">
                                    </div>

                                </div>

                                <div class="form-group" style="padding-top:25px;">

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Orden Compra</label>
                                    <div class="col-lg-3">
                                        <select class="form-control input-md selectpicker" name="nuevaOc" id="nuevaOc" data-live-search="true">
                                            <option value="">Seleccionar OC</option>

                                        </select>
                                    </div>

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Doc. Sec.</label>
                                    <div class="col-lg-2">
                                        <select class="form-control input-sm" name="tipDocS" id="tipDocS">
                                            <option value="">Doc. Secundario</option>
                                            <?php
                                            $documentos = ControladorNotasIngresos::ctrDocNI();
                                            #var_dump("ubigeo", $documentos);

                                            foreach ($documentos as $key => $value) {

                                                echo '<option value="' . $value["cod_argumento"] . '">' . $value["cod_argumento"] . ' - ' . $value["des_larga"] . '</option>';
                                            }

                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" class="form-control input-sm" id="nuevaSerieS" name="nuevaSerieS" placeholder="Serie">
                                    </div>
                                    <div class="col-lg-1">
                                        <input type="text" class="form-control input-sm" id="nuevoNroS" name="nuevoNroS" placeholder="Número">
                                    </div>

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Fec. Emision</label>
                                    <div class="col-lg-2">
                                        <input type="date" class="form-control input-sm" id="fecS" name="fecS" value="<?php echo $fecha->format("Y-m-d"); ?>">
                                    </div>

                                </div>

                                <div class="form-group" style="padding-top:25px;padding-bottom:25px">

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Cerrar OC</label>
                                    <div class="col-lg-3">
                                        <select class="form-control input-md" name="nuevoCerrar" id="nuevoCerrar">
                                            <option value="">Seleccionar</option>
                                            <option value="SI">SI</option>
                                            <option value="NO">NO</option>
                                        </select>
                                    </div>

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Moneda</label>
                                    <div class="col-lg-2">
                                        <select class="form-control input-md selectpicker" name="nuevaMoneda" id="nuevaMoneda" data-live-search="true" required>
                                            <option value="">Seleccionar Moneda</option>
                                            <?php
                                            $monedas = ControladorProveedores::ctrMostrarMonedas();
                                            foreach ($monedas as $key => $value) {
                                                echo '<option value="' . $value["Cod_Argumento"] . '">' . $value["Cod_Argumento"] . " - " . $value["Des_Larga"] . '</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">IGV</label>
                                    <div class="col-lg-1">
                                        <select class="form-control input-md" name="nuevoIGV" id="nuevoIGV">
                                            <option value="0.18">18%</option>
                                            <option value="0.09">9%</option>
                                        </select>
                                    </div>

                                    <label class="col-form-label col-lg-1 col-md-3 col-sm-3">Observaciones</label>
                                    <div class="col-lg-2">
                                        <input type="text" class="form-control input-sm" id="nuevaObservacion" name="nuevaObservacion">
                                    </div>

                                </div>

                                <!--=====================================
                                        TITULOS
                                ======================================-->

                                <div class="box box-primary">

                                    <div class="row">
                                        <div class="col-lg-1">

                                            <label>CodPro</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">CodFab</label>

                                        </div>

                                        <div class="col-lg-2">

                                            <label for="">Descripción / Color / Und</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">Cantidad</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">C. Recibida</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">Saldo</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">Exceso</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">V. Unitario</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">Total</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">OC</label>

                                        </div>

                                        <div class="col-lg-1">

                                            <label for="">Cerrar</label>

                                        </div>
                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA PARA AGREGAR PRODUCTO
                                ======================================-->

                                <div class="form-group row nuevaMPNI">


                                </div>

                                <hr>

                                <input type="hidden" id="listaNI" name="listaNI">

                                <div class="row">

                                    <!--=====================================
                                    ENTRADA IMPUESTOS Y TOTAL
                                    ======================================-->

                                    <div class="col-xs-6 pull-right">

                                        <table class="table">

                                            <thead>

                                                <tr>
                                                    <th>SubTotal</th>
                                                    <th>Impuesto</th>
                                                    <th>Total</th>
                                                </tr>

                                            </thead>

                                            <tbody>

                                                <tr>

                                                    <td style="width: 30%">

                                                        <div class="input-group">

                                                            <input type="number" step="any" class="form-control" min="0" id="nuevoSubTotalNi" name="nuevoSubTotalNi" placeholder="0" required readonly>
                                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                                            <input type="hidden" name="subTotalNi" id="subTotalNi">

                                                        </div>

                                                    </td>

                                                    <td style="width: 30%">

                                                        <div class="input-group">

                                                            <input type="number" step="any" class="form-control" min="0" id="nuevoImpuestoNi" name="nuevoImpuestoNi" placeholder="0" required readonly>
                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                                            <input type="hidden" name="impuestoNi" id="impuestoNi">

                                                        </div>

                                                    </td>

                                                    <td style="width: 40%">

                                                        <div class="input-group">

                                                            <span class="input-group-addon"><i class="fa fa-money"></i></span>

                                                            <input type="number" step="any" min="1" class="form-control" id="nuevoTotalNi" name="nuevoTotalNi" readonly required>

                                                            <input type="hidden" name="totalNi" id="totalNi">

                                                        </div>

                                                    </td>

                                                </tr>

                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                                <hr>

                                <br>

                            </div>

                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">Guardar Nota de Ingreso</button>

                            <a href="notas-ingresos" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>

                        </div>

                    </form>

                    <?php

                    $crearNotaIngreso = new ControladorNotasIngresos();
                    $crearNotaIngreso->ctrCrearNotaIngreso();

                    ?>

                </div>

            </div>

        </div>

    </section>

</div>

<script>
    window.document.title = "Crear nota ingreso"
</script>