<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Diario

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Diario</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header">

                <div class="col-lg-6 text-center">

                    <button class="btn btn-default  btnEneD" id="btnEneD" name="btnEneD" value="1">
                        Ene
                    </button>
                    <button class="btn btn-default  btnFebD" id="btnFebD" name="btnFebD" value="2">
                        Feb
                    </button>
                    <button class="btn btn-default  btnMarD" id="btnMarD" name="btnMarD" value="3">
                        Mar
                    </button>
                    <button class="btn btn-default  btnAbrD" id="btnAbrD" name="btnAbrD" value="4">
                        Abr
                    </button>
                    <button class="btn btn-default  btnMayD" id="btnMayD" name="btnMayD" value="5">
                        May
                    </button>
                    <button class="btn btn-default  btnJunD" id="btnJunD" name="btnJunD" value="6">
                        Jun
                    </button>
                    <button class="btn btn-default  btnJulD" id="btnJulD" name="btnJulD" value="7">
                        Jul
                    </button>
                    <button class="btn btn-default  btnAgoD" id="btnAgoD" name="btnAgoD" value="8">
                        Ago
                    </button>
                    <button class="btn btn-default  btnSepD" id="btnSepD" name="btnSepD" value="9">
                        Sep
                    </button>
                    <button class="btn btn-default  btnOctD" id="btnOctD" name="btnOctD" value="10">
                        Oct
                    </button>
                    <button class="btn btn-default  btnNovD" id="btnNovD" name="btnNovD" value="11">
                        Nov
                    </button>
                    <button class="btn btn-default  btnDicD" id="btnDicD" name="btnDicD" value="12">
                        Dic
                    </button>
                    
                </div>



                <div class="col-lg-5 text-center">

                    <form role="form"  method="POST" enctype="multipart/form-data">
                        <div class="col-lg-6">
                            <input type="file" name="archivoxlsventa" id="archivoxlsventa" class="form-control" accept="application/vnd.ms-excel">
                        </div>
                        <div class="col-lg-6">
                            <button type="submit"  class="btn btn-success" name="importventa" ><i class="fa fa-refresh"></i> Cargar Diario</a>
                        </div>
                    </form>

                </div>

                <div class="col-lg-1 text-center">
                    <button type="button" class="btn btn-danger" id="borrarMesD" name="borrarMesD" data-toggle="modal" data-target="#modalBorrarMesD">Borrar Mes
                    </button>
                </div>

            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive TablaDiario" width="100%">

                    <thead>

                        <tr>

                            <th>Cta</th>
                            <th>O.</th>
                            <th>Voucher</th>
                            <th>Cuenta</th>
                            <th>Descripción</th>
                            <th>Débito</th>
                            <th>Crédito</th>
                            <th>M</th>
                            <th>T/C</th>
                            <th>Fecha</th>
                            <th>Concepto</th>
                            <th>Ruc</th>
                            <th></th>
                            <th width="80px">Acciones</th>

                        </tr>

                    </thead>

                    <tbody>
                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<script>
    window.document.title = "Diario";
</script>