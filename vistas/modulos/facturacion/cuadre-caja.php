<div class="content-wrapper">

    <section class="content-header">

        <h1>
            Cuadrar Caja
        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Cuadrar Caja</li>

        </ol>

    </section>

    <?php
    date_default_timezone_set('America/Lima');
    $fecha = new DateTime();
    ?>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="col-lg-2 form-group">

                    <label>Fecha Programación</label>

                    <input type="date" class="form-control fechaCuadre" name="fechaCuadre" id="fechaCuadre" value="<?php echo $fecha->format("Y-m-d"); ?>">

                </div>

                <div class="col-lg-2 form-group">
                    <button class="btn btn-primary  btnFacturados" title="Ver Pedidos FACTURADOS">

                        FACTURADOS

                    </button>
                </div>

            </div>

            <div class="box-body">

                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">

                <div class="col-lg-10">

                    <table class="table table-bordered table-striped dt-responsive tablaCuadrarCaja" width="100%">

                        <thead>

                            <tr>
                                <th>Fecha</th>
                                <th>Tipo Doc.</th>
                                <th>Cliente</th>
                                <th>Nombre</th>
                                <th>Documento</th>
                                <th>Monto</th>
                                <th>Saldo</th>
                                <th>Tipo Entrega</th>
                                <th>Forma de Pago</th>
                                <th>Observación</th>
                                <th>Opciones</th>
                            </tr>

                        </thead>

                    </table>

                </div>

                <div class="col-lg-2 nuevoResumenMonto">


                </div>
            </div>
    </section>
</div>

<!-- Agregar CORBRO -->
<div id="modalAgregarCuadre" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 85% !important;">

        <div class="modal-content">

            <form role="form" method="post" onsubmit="return checkSubmitGC();">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->
                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Cancelar cuenta</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->
                <div class="modal-body">

                    <div class="box-body">


                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-lg-1">
                            <label for=""><b>Tipo de documento</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarTipoDocumento2" id="cancelarTipoDocumento2" readonly>

                            </div>

                        </div>

                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for=""><b>Nro de documento</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarDocumentoOriginal2" id="cancelarDocumentoOriginal2" readonly>

                            </div>

                        </div>

                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for=""><b>Fecha Emisión</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="date" class="form-control input-md" name="cancelarFechaOrigen2" id="cancelarFechaOrigen2" readonly>

                            </div>

                        </div>

                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for=""><b>Fecha Vencimiento</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="date" class="form-control input-md" name="cancelarVencimientoOrigen2" id="cancelarVencimientoOrigen2" readonly>

                            </div>

                        </div>
                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for=""><b>Clientes</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarCliente2" id="cancelarCliente2" readonly>

                            </div>

                        </div>

                        <div class="form-group col-lg-3">
                            <div style="margin-top:46px"></div>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarClienteNomOrigen2" id="cancelarClienteNomOrigen2" readonly>

                            </div>

                        </div>
                        <div class="col-lg-12"></div>
                        <div class="form-group col-lg-1">
                            <label for=""><b>Vendedor</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarVendedor2" id="cancelarVendedor2" readonly>

                            </div>

                        </div>

                        <div class="form-group col-lg-2">
                            <label for=""><b>Estado</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarEstado2" id="cancelarEstado2" readonly>

                            </div>

                        </div>

                        <div class="form-group col-lg-2">
                            <label for=""><b>Saldo</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="number" class="form-control input-md" name="cancelarSaldoAntiguo2" id="cancelarSaldoAntiguo2" readonly>

                            </div>

                        </div>

                        <div class="form-group col-lg-2">
                            <label for=""><b>Num. Unico</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="number" class="form-control input-md" name="cancelarNumUnico2" id="cancelarNumUnico2" readonly>

                            </div>

                        </div>


                        <div class="form-group col-lg-2">
                            <label for=""><b>Total S/.</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="number" class="form-control input-md" name="cancelarTotal2" id="cancelarTotal2" readonly>

                            </div>

                        </div>

                        <div class="col-lg-12 bg-primary"></div>

                        <!-- ENTRADA PARA EL CODIGO -->

                        <div class="form-group col-lg-2">
                            <label for=""><b>Documento por cancelar</b></label><br>
                            <label for=""><b>Tipo de cancelacion</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <select type="text" class="form-control input-md selectpicker" name="cancelarCodigo2" id="cancelarCodigo2" data-size="10" data-live-search="true" required>
                                    <option value="">Seleccionar tipo de cancelacion</option>

                                    <?php
                                    $item = "tipo_dato";
                                    $valor = "TCAN";

                                    $array = array('00', '05', '06', '14', '80', '82');
                                    $documentos = ControladorCuentas::ctrMostrarPagos($item, $valor);

                                    foreach ($documentos as $key => $value) {
                                        if (in_array($value["codigo"], $array)) {
                                            echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] . " - " . $value["descripcion"] . '</option>';
                                        }
                                    }

                                    ?>
                                </select>
                                <input type="hidden" id="cancelarUsuario2" name="cancelarUsuario2" value="<?php echo $_SESSION["id"] ?>">
                                <input type="hidden" id="idCuenta3" name="idCuenta3">
                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for=""><b>Nro de documento</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarDocumento2" id="cancelarDocumento2" placeholder="Documento origen">
                            </div>

                        </div>

                        <?php
                        date_default_timezone_set("America/Lima");
                        $fecha = new DateTime();
                        ?>
                        <!-- ENTRADA PARA LA FECHA  -->
                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for="">Fecha </label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="cancelarFechaUltima2" id="cancelarFechaUltima2" value="<?php echo $fecha->format("Y-m-d") ?>" min="<?php echo $fecha->format("Y-m-01") ?>" required>

                            </div>

                        </div>

                        <!-- ENTRADA PARA LA NOTA -->

                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for=""><b>Notas</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>

                                <input type="text" class="form-control input-md" name="cancelarNota2" id="cancelarNota2">

                            </div>

                        </div>


                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for="">Monto </label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                                <input type="number" min="0" step="any" class="form-control input-md" name="cancelarMonto3" id="cancelarMonto3" value="0" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-2">
                            <div style="margin-top:23px"></div>
                            <label for=""><b>Saldo</b></label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>

                                <input type="number" min="0" step="any" class="form-control input-md" name="cancelarSaldo2" id="cancelarSaldo2" value="0" readonly>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->
                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" id="btnBlocClicC" class="btn btn-primary">Cancelar cuenta</button>

                </div>

            </form>

            <?php

            $cancelarCuenta2 = new controladorFacturacion();
            $cancelarCuenta2->ctrCancelarCuenta3();

            ?>


        </div>

    </div>

</div>

<script>
    window.document.title = "Cuadrar Caja"
</script>