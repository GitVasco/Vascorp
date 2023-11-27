<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Procesar comprobante electronico

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Procesar comprobante electronico</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header with-border">
                <div class="col-md-2">
                    <select class="form-control selectpicker " data-live-search="true" name="selectDocumentoCE" id="selectDocumentoCE">
                        <option value="">SELECCIONAR DOCUMENTO</option>
                        <option value="E05">NOTAS CREDITO</option>
                        <option value="S02">BOLETAS VENTAS</option>
                        <option value="S03">FACTURAS</option>
                        <option value="S05">NOTAS DEBITO</option>
                        <option value="S01">GUIAS DE REMISION</option>
                    </select>
                </div>

                <button class="btn btn-info btnVerToken" data-toggle="modal" data-target="#modalGenerarToken" onclick="showTime()">
                    <i class="fa fa-key"></i>
                    Generar token

                </button>

                <button class="btn btn-primary btnNuevaConsultaSunat" data-toggle="modal" data-target="#modalConsultarSunat">
                    <i class="fa fa-search"></i>
                    Consulta SUNAT

                </button>

                <button type="button" class="btn btn-default pull-right" id="daterange-btnProcesarCE">
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

                <button type="button" class="btn btn-success" id="regMesM" name="regMesM" data-toggle="modal" data-target="#modalRegMEs">Registro Ventas
                </button>

                <button type="button" class="btn btn-warning transSistontClie" id="transSistontClie" name="transSistontClie">
                    Transferir Clientes SISCONT
                </button>

                <button type="button" class="btn btn-warning" id="transSistont" name="transSistont" data-toggle="modal" data-target="#modalSiscont">
                    Transferir Ventas SISCONT
                </button>

                <button type="button" class="btn btn-warning" id="transSistontLetras" name="transSistontLetras" data-toggle="modal" data-target="#modalSiscontLetras">
                    Transferir Canje SISCONT
                </button>

                <button type="button" class="btn btn-warning" id="transSistontCancelaciones" name="transSistontCancelaciones" data-toggle="modal" data-target="#modalSiscontCancelaciones">
                    Transferir Cancelaciones SISCONT
                </button>


            </div>

            <div class="box-body">
                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">

                <table class="table table-bordered table-striped dt-responsive tablaProcesarCE" width="100%">

                    <thead>

                        <tr>

                            <th>Tipo Doc.</th>
                            <th>Documento</th>
                            <th>Total</th>
                            <th>Cod. Cliente</th>
                            <th>Nombre</th>
                            <th>DNI/RUC</th>
                            <th>Vend.</th>
                            <th>Fec. Emisión</th>
                            <th>Doc. Origen</th>
                            <th>Estado</th>
                            <th>Agencia</th>
                            <th>Destino</th>
                            <th style="width:70px">Est. Envio</th>
                            <th style="width:102px">Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>


<!--=====================================
MODAL GENERAR TOKEN
======================================-->

<div id="modalGenerarToken" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="formularioToken">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Generar token</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL CODIGO -->

                        <div class="form-group">
                            <label>RUC</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" min="0" class="form-control input-md" name="nuevoRuc" value="10472810371" readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <label>SERIE</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-md" name="nuevaSerie" value="af1e8535-d99a-4915-b515-91e36d9f71ae" readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-lg-6" style="padding-left:0px !important">
                            <label>HORA INICIAL</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>

                                <input type="text" class="form-control input-md" name="nuevoInicio" id="nuevoInicio" readonly>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-lg-6" style="padding-right:0px !important">
                            <label>HORA FINAL</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>

                                <input type="text" class="form-control input-md" name="nuevoFin" id="nuevoFin" readonly>

                                <input type="hidden" id="nuevaFechaToken" value="<?php echo date("d-m-Y"); ?>">
                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->
                        <label>SERIE SECRET</label>
                        <div class="form-group ">

                            <div class="col-md-8" style="padding-left:0px !important">
                                <div class="input-group ">

                                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                    <input type="text" class="form-control input-md" name="nuevaContrasena" value="MepGYmNzOeZ6EMMr2i0t4A==" readonly>


                                </div>

                            </div>


                            <div class="col-md-4">
                                <button type="button" class="btn btn-success btnGenerarToken" onclick="stopTime()"><i class="fa fa-play-circle-o"></i> Generar</button>
                            </div>



                        </div>


                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group">
                            <label>TOKEN</label>

                            <textarea class="form-control input-md" name="nuevoCodigoToken" id="nuevoCodigoToken" rows="12" readonly></textarea>


                        </div>

                        <!-- ENTRADA PARA LA DURACCION -->

                        <div class="form-group ">
                            <label>DURACIÓN</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>

                                <input type="text" class="form-control input-md" name="nuevaDuracion" id="nuevaDuracion" readonly>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>


                </div>

            </form>


        </div>

    </div>

</div>


<!--=====================================
MODAL CONSULTAR SUNAT
======================================-->

<div id="modalConsultarSunat" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="formularioConsultaSunat" autocomplete="off">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Consultar SUNAT</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- ENTRADA PARA EL CODIGO -->

                        <div class="form-group  col-lg-6">
                            <label>TIPO DOCUMENTO</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-text-width"></i></span>

                                <select class="form-control selectpicker " data-live-search="true" name="selectDocumentoConsulta" id="selectDocumentoConsulta">
                                    <option value="">SELECCIONAR DOCUMENTO</option>
                                    <option value="01">01-FACTURAS</option>
                                    <option value="03">03-BOLETAS VENTAS</option>
                                    <option value="07">07-NOTAS CREDITO</option>
                                    <option value="08">08-NOTAS DEBITO</option>
                                </select>

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-lg-6">
                            <label>RUC</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" maxlength="11" class="form-control input-md info-box-text" name="nuevoRucConsulta" id="nuevoRucConsulta" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>


                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-lg-4">
                            <label>SERIE</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-md info-box-text" name="nuevaSerieConsulta" id="nuevaSerieConsulta" maxlength="4">

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->

                        <div class="form-group col-lg-8">
                            <label>CORRELATIVO</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                <input type="text" class="form-control input-md" name="nuevoCorrelativoConsulta" id="nuevoCorrelativoConsulta" maxlength="8" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>

                            </div>

                        </div>

                        <div class="form-group col-lg-6">
                            <label>FECHA EMISION</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="nuevaEmisionConsulta" id="nuevaEmisionConsulta">

                            </div>

                        </div>

                        <!-- ENTRADA PARA EL NOMBRE -->
                        <div class="form-group col-lg-6">
                            <label>MONTO</label>
                            <div class="input-group ">

                                <span class="input-group-addon"><i class="fa fa-usd"></i></span>

                                <input type="number" step="any" min="0" class="form-control input-md" name="nuevoMontoConsulta" id="nuevoMontoConsulta">


                            </div>

                        </div>

                        <div class="form-group col-lg-12" align="center">


                            <button type="button" class="btn btn-primary btnConsultarSunat"><i class="fa fa-search"></i> Consultar</button>
                            <button type="button" class="btn btn-danger btnLimpiarConsultaSunat"><i class="fa fa-trash"></i> Limpiar</button>

                        </div>
                        <div class="loadingSunat col-lg-12" align="center"></div>

                        <table class="table table-condensed table-bordered  consultaActivo hidden">
                            <thead style="background:#3c8dbc; color:white">
                                <tr>
                                    <td colspan="3" rowspan="2">
                                        <h4>Resultado de la Búsqueda</h4>
                                    </td>
                                </tr>
                            </thead>
                            <tbody style="font-size:17px">
                                <tr>
                                    <td><b>Estado del comprobante a la fecha de la consulta</b></td>
                                    <td> : </td>
                                    <td class="estComp"></td>
                                </tr>
                                <tr>
                                    <td><b>Estado del contribuyente a la fecha de emision</b></td>
                                    <td> : </td>
                                    <td class="estContrib"></td>
                                </tr>
                                <tr>
                                    <td><b>Condición de domicilio a la fecha de emisión</b></td>
                                    <td> : </td>
                                    <td class="estDomicilio"></td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>


                </div>

            </form>


        </div>

    </div>

</div>

<!--=====================================
MODAL REGISTRO DE VENTAS
======================================-->

<div id="modalRegMEs" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post" id="formularioRegistro">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Registro de Ventas</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <!-- ENTRADA PARA PORCENTAJE -->

                        <div class="form-group col-lg-6">

                            <label>Fecha Inicio</label>

                            <input type="date" id="fInicio" name="fInicio">

                        </div>

                        <div class="form-group col-lg-6">

                            <label>Fecha Fin</label>

                            <input type="date" id="fFin" name="fFin">

                        </div>

                        <div class="form-group col-lg-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="conGuias" name="conGuias" checked>
                                <label class="form-check-label" for="conGuias">
                                    Con Guias
                                </label>
                            </div>
                        </div>


                        <div class="form-group col-lg-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="soloRemision" name="soloRemision" unchecked>
                                <label class="form-check-label" for="soloRemision">
                                    Solo Guias de Remisión
                                </label>
                            </div>
                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="button" id="generarReg" name="generarReg" class="btn btn-primary btnGenerarReg">GENERAR</button>

                </div>

            </form>

        </div>

    </div>

</div>

<!--=====================================
MODAL TRANSFERIR INFO SISCONT
======================================-->

<div id="modalSiscont" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Tranferir Información VENTAS</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Inicio</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="inicioSiscont" id="inicioSiscont" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Fin</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="finSiscont" id="finSiscont" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Correlativo Inicio VENTAS 02</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-md" name="iniVentas" id="iniVentas" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary btnGenerarReg">GENERAR</button>

                </div>

            </form>

            <?php

            $dividir = new ControladorContabilidad();
            $dividir->ctrGenerarVentasSiscont();

            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL TRANSFERIR CANJE DE LETRAS INFO SISCONT
======================================-->

<div id="modalSiscontLetras" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Tranferir Información Canje Letras</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Inicio</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="inicioSiscontL" id="inicioSiscontL" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Fin</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="finSiscontL" id="finSiscontL" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Correlativo Inicio Canje 05</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-md" name="iniCanje" id="iniCanje" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">GENERAR</button>

                </div>

            </form>

            <?php

            $dividir = new ControladorContabilidad();
            $dividir->ctrGenerarCanjeSiscont();

            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL TRANSFERIR CANCELACIONES INFO SISCONT
======================================-->

<div id="modalSiscontCancelaciones" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Tranferir Información Cancelaciones</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Inicio</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="inicioSiscontC" id="inicioSiscontC" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Fin</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="finSiscontC" id="finSiscontC" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Correlativo Inicio Cancelaciones 04</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-md" name="iniCance04" id="iniCance04" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Correlativo Inicio Cancelaciones 08</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                                <input type="text" class="form-control input-md" name="iniCance08" id="iniCance08" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">GENERAR</button>

                </div>

            </form>

            <?php

            $dividir = new ControladorContabilidad();
            $dividir->ctrGenerarCancelacionesSiscont();

            ?>

        </div>

    </div>

</div>

<!--=====================================
MODAL TRANSFERIR CLIENTES
======================================-->

<div id="modalSiscontClie" class="modal fade" role="dialog">

    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Tranferir Información Clientes</h4>

                </div>

                <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

                <div class="modal-body">

                    <div class="box-body">


                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Inicio</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="inicioSiscontCli" id="inicioSiscontCli" required>

                            </div>

                        </div>

                        <div class="form-group col-lg-6" style="padding-left:0px">
                            <label>Fecha Fin</label>
                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                                <input type="date" class="form-control input-md" name="finSiscontCli" id="finSiscontCli" required>

                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
        PIE DEL MODAL
        ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">GENERAR</button>

                </div>

            </form>

            <?php

            $dividir = new ControladorContabilidad();
            $dividir->ctrGenerarClientesSiscont();

            ?>

        </div>

    </div>

</div>

<?php
$enviarFacturaXML = new ControladorFacturacion();
$enviarFacturaXML->ctrCrearFacturaXML();
?>

<?php
$enviarNotaCreditoXML = new ControladorFacturacion();
$enviarNotaCreditoXML->ctrCrearNotaCreditoXML();
?>

<?php
$enviarNotaDebitoXML = new ControladorFacturacion();
$enviarNotaDebitoXML->ctrCrearNotaDebitoXML();
?>

<?php

$generarFEacBol = new ControladorFacturacion();
$generarFEacBol->ctrGenerarFEFacBolA();

?>

<script>
    window.document.title = "Procesar CE"

    var t;

    function showTime() {
        myDate = new Date();
        hours = myDate.getHours();
        hours2 = hours + 1;
        minutes = myDate.getMinutes();
        seconds = myDate.getSeconds();
        if (hours < 10) hours = "0" + hours;
        if (hours2 < 10) hours2 = "0" + hours2;
        if (minutes < 10) minutes = "0" + minutes;
        if (seconds < 10) seconds = "0" + seconds;
        $("#nuevoInicio").val(hours + ":" + minutes + ":" + seconds);
        $("#nuevoFin").val(hours2 + ":" + minutes + ":" + seconds);
        t = setTimeout("showTime()", 1000);

    }

    function stopTime() {
        clearTimeout(t);
    }
</script>