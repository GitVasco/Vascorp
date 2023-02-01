<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Errores

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Errores</li>


        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-body">

                <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
                <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">

                <div class="col-lg-9">

                    <table class="table table-bordered table-striped dt-responsive tablaErrores" width="100%">

                        <thead>

                            <tr>

                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th>Serie</th>
                                <th>Documento</th>
                                <th>Neto <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> A</span></th>
                                <th>IGV <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> B</span></th>
                                <th>Total <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> C</span></th>
                                <th>Total Und <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> D</span></th>
                                <th>Error <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> A-D</span></th>
                                <TH>Error <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> B</span></TH>
                                <th>Error <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> C</span></th>
                                <th>Total CC <span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> E</span></th>
                                <th>Diff<span style="color: blue;border-radius: 25%;border: 1px solid blue;padding: 5px;"> C-E</span></th>
                                <th>Estado</th>
                                <th>Usuario</th>
                                <th>Acciones</th>

                            </tr>

                        </thead>

                    </table>

                </div>

                <div class="col-lg-3 row">
                    <h2>

                        Correlativos Faltantes

                    </h2>

                    <div class="col-lg-12">

                        <div class="col-lg-6">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Facturas</h3>
                                </div>

                                <?php

                                $tipo = "S03";
                                $talonario = ModeloTalonarios::mdlMostrarTalonariosB('01');

                                foreach ($talonario as $key => $value) {
                                    $series = $value["serie_factura"];

                                    $prueba = ModeloFacturacion::mdlMaxMin($tipo, $series);

                                    $numr = array();

                                    foreach ($prueba as $sql) {
                                        $numr = array_merge($numr, range($prueba['minnum'], $prueba['maxnum']));
                                    }

                                    $res_recibo = ModeloFacturacion::mdlTodos($tipo, $series);;

                                    foreach ($res_recibo as $key => $value) {
                                        $arr_recibo[] = $value["numero"];
                                    }

                                    $dif_recibos = array_unique(array_diff($numr, $arr_recibo));

                                    echo '<div class="box-body">
                                    <strong><i class="fa fa-pencil margin-r-5"></i> ' . $series . '</strong>';

                                    foreach ($dif_recibos as $key => $value) {

                                        if ($value == "0") {

                                            echo '';
                                        } else {

                                            echo '<p>
                                                <span class="label label-danger">' . $value . '</span>
                                            </p>';
                                        }
                                    }


                                    echo '</div>';
                                }

                                ?>

                            </div>
                        </div>

                        <div class="col-lg-6">

                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Boletas</h3>
                                </div>

                                <?php

                                $tipo = "S02";
                                $talonario = ModeloTalonarios::mdlMostrarTalonariosB('03');

                                foreach ($talonario as $key => $value) {
                                    $series = $value["serie_boletas"];

                                    $prueba = ModeloFacturacion::mdlMaxMin($tipo, $series);

                                    $numr = array();

                                    foreach ($prueba as $sql) {
                                        $numr = array_merge($numr, range($prueba['minnum'], $prueba['maxnum']));
                                    }

                                    $res_recibo = ModeloFacturacion::mdlTodos($tipo, $series);;

                                    foreach ($res_recibo as $key => $value) {
                                        $arr_recibo[] = $value["numero"];
                                    }

                                    $dif_recibos = array_unique(array_diff($numr, $arr_recibo));

                                    echo '<div class="box-body">
                                    <strong><i class="fa fa-pencil margin-r-5"></i> ' . $series . '</strong>';

                                    foreach ($dif_recibos as $key => $value) {

                                        if ($value == "0") {

                                            echo '';
                                        } else {

                                            echo '<p>
                                                <span class="label label-danger">' . $value . '</span>
                                            </p>';
                                        }
                                    }


                                    echo '</div>';
                                }

                                ?>


                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">

                        <div class="col-lg-6">

                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">NC</h3>
                                </div>

                                <?php

                                $tipo = "E05";
                                $talonario = ModeloTalonarios::mdlMostrarTalonariosB('07');

                                foreach ($talonario as $key => $value) {
                                    $series = $value["serie_nc"];

                                    $prueba = ModeloFacturacion::mdlMaxMin($tipo, $series);

                                    $numr = array();

                                    foreach ($prueba as $sql) {
                                        $numr = array_merge($numr, range($prueba['minnum'], $prueba['maxnum']));
                                    }

                                    $res_recibo = ModeloFacturacion::mdlTodos($tipo, $series);;

                                    foreach ($res_recibo as $key => $value) {
                                        $arr_recibo[] = $value["numero"];
                                    }

                                    $dif_recibos = array_unique(array_diff($numr, $arr_recibo));

                                    echo '<div class="box-body">
                                    <strong><i class="fa fa-pencil margin-r-5"></i> ' . $series . '</strong>';

                                    foreach ($dif_recibos as $key => $value) {
                                        if ($value == "0") {

                                            echo '';
                                        } else {

                                            echo '<p>
                                                <span class="label label-danger">' . $value . '</span>
                                            </p>';
                                        }
                                    }


                                    echo '</div>';
                                }

                                ?>


                            </div>
                        </div>

                        <div class="col-lg-6">

                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">ND</h3>
                                </div>

                                <?php

                                $tipo = "S05";
                                $talonario = ModeloTalonarios::mdlMostrarTalonariosB('08');

                                foreach ($talonario as $key => $value) {
                                    $series = $value["serie_nd"];

                                    $prueba = ModeloFacturacion::mdlMaxMin($tipo, $series);

                                    $numr = array();

                                    foreach ($prueba as $sql) {
                                        $numr = array_merge($numr, range($prueba['minnum'], $prueba['maxnum']));
                                    }

                                    $res_recibo = ModeloFacturacion::mdlTodos($tipo, $series);;

                                    foreach ($res_recibo as $key => $value) {
                                        $arr_recibo[] = $value["numero"];
                                    }

                                    $dif_recibos = array_unique(array_diff($numr, $arr_recibo));

                                    echo '<div class="box-body">
                                    <strong><i class="fa fa-pencil margin-r-5"></i> ' . $series . '</strong>';

                                    foreach ($dif_recibos as $key => $value) {

                                        if ($value == "0") {

                                            echo '';
                                        } else {

                                            echo '<p>
                                                <span class="label label-danger">' . $value . '</span>
                                            </p>';
                                        }
                                    }


                                    echo '</div>';
                                }

                                ?>


                            </div>
                        </div>
                    </div>



                </div>
            </div>


        </div>

</div>

</section>

</div>


<script>
    window.document.title = "Errores"
</script>