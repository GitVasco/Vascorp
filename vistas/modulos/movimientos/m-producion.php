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

                <button type="button" class="btn btn-default pull-right" id="daterange-btn">

                    <span><i class="fa fa-calendar"></i> Rango de Fechas </span>
                    <i class="fa fa-caret-down"></i>

                </button>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-condensed table-hover dt-responsive tablaVentas" width="100%">

                    <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">

                    <thead>

                        <tr class="info">
                            <th>Código</th>
                            <th>Estado</th>
                            <th>Cliente</th>
                            <th>Neto</th>
                            <th>Descuento</th>
                            <th>Total</th>
                            <th>Adelanto</th>
                            <th>Pendiente</th>
                            <th>Envio</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>