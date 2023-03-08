<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Urgencias Maestro

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Urgencias Maestro</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-success btnConfUrgencias" data-toggle='modal' data-target='#modalConfUrgencias'><i class="fa fa-plus"></i> Configurar Urgencias</button>
            </div>


            <div class="box-header with-border">

                <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive tablaUrgenciasMaestro" width="100%">

                        <thead>

                            <tr>

                                <th>Modelo</th>
                                <th>Nombre</th>
                                <th>Color</th>
                                <th>Talla</th>
                                <th>Estado</th>
                                <th>Stock</th>
                                <th>Pedidos</th>
                                <th>Taller</th>
                                <th>Servicio</th>
                                <th>Alm. Corte</th>
                                <th>Ord. Corte</th>
                                <th>Ult. Mes</th>
                                <th>Estado</th>
                                <th>Sector</th>

                            </tr>

                        </thead>

                        <tbody>


                        </tbody>

                    </table>

                </div>

            </div>

        </div>
    </section>

</div>

<!--=====================================
AGREGAR CANTIDAD A TALLER
======================================-->
<div id="modalConfUrgencias" class="modal fade" role="dialog">

    <div class="modal-dialog" style="width: 50% !important;">

        <div class="modal-content">

            <form role="form" method="post">

                <!--=====================================
                CABEZA DEL MODAL
                ======================================-->

                <div class="modal-header" style="background:#3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                    <h4 class="modal-title">Configurar Urgencias</h4>

                </div>

                <!--=====================================
                CUERPO DEL MODAL
                ======================================-->

                <div class="modal-body">
                    <div class="box-body">

                        <div class="form-group col-lg-6">
                            <label for="">Urgencia Producción</label>
                            <div class="input-group">

                                <input type="number" step="any" class="form-control input-lg" name="prod" id="prod" required>
                            </div>

                        </div>

                        <div class="form-group col-lg-6">
                            <label for="">Urgencia Almacén corte</label>
                            <div class="input-group">

                                <input type="number" step="any" class="form-control input-lg" name="alm" id="alm" required>
                            </div>

                        </div>

                        <div class="form-group col-lg-6">
                            <label for="">Urgencia Corte</label>
                            <div class="input-group">

                                <input type="number" step="any" class="form-control input-lg" name="corte" id="corte" required>
                            </div>

                        </div>

                        <div class="form-group col-lg-6">
                            <label for="">Urgencia Planificación</label>
                            <div class="input-group">

                                <input type="number" step="any" class="form-control input-lg" name="plan" id="plan" required>
                            </div>

                        </div>

                    </div>

                </div>

                <!--=====================================
                PIE DEL MODAL
                ======================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

                    <button type="submit" class="btn btn-primary">Guardar configuracion</button>

                </div>

                <?php
                $activar = new controladorArticulos();
                $activar->ctrConfigurarMesesUrgencia();

                ?>

            </form>

        </div>

    </div>

</div>

<script>
    window.document.title = "Urg. Maestro"
</script>