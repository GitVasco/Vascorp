<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar Transferencias

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Transferencias</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <a href="index.php?ruta=crear-transferencias-apt&codigo=" onclick="createCorrelativo(event,'transapt')">

                    <button class="btn btn-primary">

                        Agregar Transferencia

                    </button>

                </a>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaTransferencias" width="100%">

                    <thead>

                        <tr>

                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Almacen Origen</th>
                            <th>Almacen Destino</th>
                            <th>Responsable</th>
                            <th>Estado</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>


<script>
    window.document.title = "Transferencias APT"
</script>