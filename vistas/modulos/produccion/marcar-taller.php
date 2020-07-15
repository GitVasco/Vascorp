<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Registro de Tareas a Talleres

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Crear venta</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            LA TABLA DE EN PROCESO
            ======================================-->

            <div class="col-lg-8 hidden-md hidden-sm hidden-xs">

                <div class="box box-primary">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <h3 class="box-title">En Proceso</h3>

                        <table class="table table-bordered table-striped dt-responsive tablaTallerP">

                            <thead>

                                <tr>
                                    <th style="width: 50px">Cod. Barra</th>
                                    <th>Taller</th>
                                    <th>Trabajador</th>
                                    <th>Operación</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Hora Inicio</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <h3 class="box-title">Terminado</h3>

                        <table class="table table-bordered table-striped dt-responsive tablaTallerT">

                            <thead>

                                <tr>
                                    <th style="width: 50px">Cod. Barra</th>
                                    <th>Taller</th>
                                    <th>Trabajador</th>
                                    <th>Operación</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Hora Fin</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>                


            </div>
         

            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-4 col-xs-12">

                <div class="box box-info">

                    <div class="box-header with-border"></div>

                    <form role="form" method="post">

                        <div class="box-body">

                            <div class="box">

                                <div class="form-group" align="center">

                                    <img src="vistas/img/plantilla/jackyform_paloma.png" width="400px" height="400px">

                                </div>
                                
                                <br>

                                <div class="form-group" align="center">

                                <h1>Registrar Código de Barra</h1>
                                
                                </div>

                                <br>

                                <!--=====================================
                                ENTRADA DEL VENDEDOR
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                                        <input type="text" class="form-control" id="codigoBarra" name="codigoBarra" placeholder="Ingresar Código" autofocus>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">Registrar</button>

                        </div>

                    </form>

                    <?php

                    $registrarProceso = new ControladorTalleres();
                    $registrarProceso -> ctrProceso();

                    ?> 

                </div>

            </div>

        </div>

    </section>

</div>
