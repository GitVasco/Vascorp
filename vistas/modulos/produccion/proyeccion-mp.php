<div class="content-wrapper">
    <!-- Header del Contenido -->
    <section class="content-header">

        <h1>Movimientos Producción</h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Movimientos Producción</li>

        </ol>

    </section>

    <!-- Sección de Contenido -->
    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <div class="col-lg-4">

                    <select class="form-control selectpicker input-lg" id="proyMp" name="proyMp" data-live-search="true">

                    <option value="">Seleccione Orden de Corte</option>

                        <?php

                        $ordencorte = ControladorOrdenCorte::ctrOCPend($item, $valor);
                        //var_dump($ordencorte);

                        foreach ($ordencorte as $key => $value) {
                        
                        echo '<option value="'.$value["codigo"].'">'.$value["ordencorte"].'</option>';
                        }

                        ?>

                    </select>

                </div>

                <div class="col-lg-6">
                
                    <button class="btn btn-primary btnCargarProyMp">CARGAR</button>
                    <button class="btn btn-danger btnLimpiarProyMp">LIMPIAR</button>

                </div>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-condensed table-hover dt-responsive tablaProyMp" width="100%">

                    <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">

                    <thead>

                        <tr class="info">
                            <th>Cod. Lin</th>
                            <th>Cod. Pro.</th>
                            <th>Cod. Fab</th>
                            <th>Descripcion</th>
                            <th>Color</th>
                            <th>Unidad</th>
                            <th>Req.</th>
                            <th>Stock</th>
                            <th>Oc. Pend</th>
                            <th>Os. Pend</th>
                            <th>Ingresos</th>
                            <th>Proyeccion</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>