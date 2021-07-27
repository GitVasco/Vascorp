<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Registro de ingresos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Registro de ingresos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">

                <div class="col-lg-1">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarIngresos">
                        Ingreso
                    </button>
                </div>

                <div class="col-lg-1">
                    <button type="button" class="btn btn-danger" id="cerrarMes" name="cerrarMes" data-toggle="modal" data-target="#modalCerrarMes">Seleccionar Mes
                    </button>
                </div>

                <div class="col-lg-6 text-center">
                    <button class="btn btn-default  btnEneI" id="btnEneI" name="btnEneI" value="1">
                        Ene
                    </button>
                    <button class="btn btn-default  btnFebI" id="btnFebI" name="btnFebI" value="2">
                        Feb
                    </button>
                    <button class="btn btn-default  btnMarI" id="btnMarI" name="btnMarI" value="3">
                        Mar
                    </button>
                    <button class="btn btn-default  btnAbrI" id="btnAbrI" name="btnAbrI" value="4">
                        Abr
                    </button>
                    <button class="btn btn-default  btnMayI" id="btnMayI" name="btnMayI" value="5">
                        May
                    </button>
                    <button class="btn btn-default  btnJunI" id="btnJunI" name="btnJunI" value="6">
                        Jun
                    </button>
                    <button class="btn btn-default  btnJulI" id="btnJulI" name="btnJulI" value="7">
                        Jul
                    </button>
                    <button class="btn btn-default  btnAgoI" id="btnAgoI" name="btnAgoI" value="8">
                        Ago
                    </button>
                    <button class="btn btn-default  btnSepI" id="btnSepI" name="btnSepI" value="9">
                        Sep
                    </button>
                    <button class="btn btn-default  btnOctI" id="btnOctI" name="btnOctI" value="10">
                        Oct
                    </button>
                    <button class="btn btn-default  btnNovI" id="btnNovI" name="btnNovI" value="11">
                        Nov
                    </button>
                    <button class="btn btn-default  btnDicI" id="btnDicI" name="btnDicI" value="12">
                        Dic
                    </button>
                    
                </div>

                <div class="col-lg-1 text-center bg-yellow border-20">

                    <span class="info-box-text">Saldo Inicial</span>
                    <span class="info-box-number" name="saldoInicial" id="saldoInicial">0</span>

                </div>

                <div class="col-lg-1 text-center bg-primary">

                    <span class="info-box-text">Ingresos</span>
                    <span class="info-box-number" name="saldoIngreso" id="saldoIngreso">0</span>

                </div>
                
                <div class="col-lg-1 text-center bg-red">

                    <span class="info-box-text">Egresos</span>
                    <span class="info-box-number" name="saldoEgreso" id="saldoEgreso">0</span>

                </div>   
                
                <div class="col-lg-1 text-center bg-green">

                    <span class="info-box-text">Saldo Actual</span>
                    <span class="info-box-number" name="saldoActual" id="saldoActual">0</span>

                </div>           

            </div>



        </div>


        <div class="row">

            <div class="col-lg-9 col-xs-12">

                <div class="box box-primary">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive TablaIngresosCaja" width="100%">

                        <thead>

                            <tr>

                                <th>Fecha</th>
                                <th>C. Ing</th>
                                <th>Tipo de Ingreso</th>
                                <th>C. Res</th>
                                <th>Entregado por</th>
                                <th>Tip Doc.</th>
                                <th>Documentos</th>
                                <th>Total</th>
                                <th>#</th>

                            </tr>

                        </thead>

                    </table>

                    </div>

                </div>


            </div>

            <div class="col-lg-3 col-xs-12">

                <div class="box box-primary">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <table class="table table-bordered table-striped dt-responsive TablaIngresosVendedor" width="100%">

                        <thead>

                            <tr>

                                <th>Cod. Res</th>
                                <th>Entregado por</th>
                                <th>Total Mes</th>


                            </tr>

                        </thead>

                    </table>

                    </div>

                </div>


            </div>            


        </div>
    
    </section>

</div>

<!--=====================================
MODAL REGISTRAR INGRESO
======================================-->

<div id="modalAgregarIngresos" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 50% !important">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar ingreso</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <?php
            date_default_timezone_set('America/Lima');
            $fecha = new DateTime();
          ?>

            <div class="form-group">
                <label class="col-form-label col-lg-1 col-md-1">Fecha</label>
                <div class="col-lg-3">
                    <input type="date" class="form-control input-sm" id="fechaIngreso" name="fechaIngreso"   value="<?php echo $fecha->format("Y-m-d"); ?>">
                </div>

                <label for=""  class="col-form-label col-lg-1 col-md-1">Ingreso</label>
                <div class="col-lg-7 col-md-3">
                    <select  class="form-control input-sm" name="nuevoCodIng" id="nuevoCodIng" required>
                        <option value="">Seleccionar Tipo Ingreso</option>
                        <?php
                        $valor = "TING";

                        $sucursal = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                        ?>
                    </select>
                </div>

            </div>

            <div class="form-group" style="padding-top:25px">

            <label class="col-form-label col-lg-1 col-md-1">Resp.</label>
                <div class="col-lg-6 col-md-3">
                    <select  class="form-control input-sm selectpicker" data-live-search="true" name="nuevoResp" id="nuevoResp" required>
                        <option value="">Seleccionar Responsable</option>
                        <?php
                        $valor = "COBR";

                        $sucursal = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                        ?>
                    </select>
                </div>                   

                <label class="col-form-label col-lg-2 col-md-1">Total Soles</label>
                <div class="col-lg-3 col-md-10 col-sm-9">

                    <input type="number" step="any" class="form-control input-md" name="nuevoTotal" id="nuevoTotal">

                </div>                  

            </div>

            <div class="form-group" style="padding-top:25px">

                 <label class="col-form-label col-lg-1 col-md-1">Tipo</label>
                <div class="col-lg-4 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoTipo" id="nuevoTipo" required>
                        <option value="">Tipo Doc.</option>
                        <?php

                        $tipoDoc = ControladorCentroCostos::ctrMostrarTipoDoc();
                        #var_dump($tipoDoc);
                        foreach ($tipoDoc as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Docs</label>
                <div class="col-lg-6">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="documento" name="documento">
                </div>

            </div>   
            
            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Obs.</label>
                <div class="col-lg-11">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="observacion" name="observacion">
                </div>

            </div>             

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Ingreso</button>

        </div>

        <?php

          $crearIngresosCaja = new ControladorCentroCostos();
          $crearIngresosCaja -> ctrCrearIngresosCaja();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR INGRESO
======================================-->

<div id="modalEditarIngreso" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 50% !important">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar ingreso</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <?php
            date_default_timezone_set('America/Lima');
            $fecha = new DateTime();
          ?>

            <div class="form-group">
                <label class="col-form-label col-lg-1 col-md-1">Fecha</label>
                <div class="col-lg-3">
                    <input type="date" class="form-control input-sm" id="editarFechaIngreso" name="editarFechaIngreso">
                </div>

                <label for=""  class="col-form-label col-lg-1 col-md-1">Ingreso</label>
                <div class="col-lg-7 col-md-3">
                    <select  class="form-control input-sm" name="editarCodIng" id="editarCodIng" required>
                        <option value="">Seleccionar Tipo Ingreso</option>
                        <?php
                        $valor = "TING";

                        $sucursal = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                        ?>
                    </select>
                </div>

            </div>

            <div class="form-group" style="padding-top:25px">

            <label class="col-form-label col-lg-1 col-md-1">Resp.</label>
                <div class="col-lg-6 col-md-3">
                    <select  class="form-control input-sm selectpicker" data-live-search="true" name="editarResp" id="editarResp" required>
                        <option value="">Seleccionar Responsable</option>
                        <?php
                        $valor = "COBR";

                        $sucursal = ModeloMaestras::mdlMostrarMaestrasDetalle($valor);
                        #var_dump($sucursal);
                        foreach ($sucursal as $key => $value) {
                            echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                        ?>
                    </select>
                </div>                   

                <label class="col-form-label col-lg-2 col-md-1">Total Soles</label>
                <div class="col-lg-3 col-md-10 col-sm-9">

                    <input type="number" step="any" class="form-control input-md" name="editarTotal" id="editarTotal">
                    <input type="hidden" step="any" class="form-control input-md" name="totalAntiguo" id="totalAntiguo">
                    <input type="hidden" step="any" class="form-control input-md" name="id" id="id">

                </div>                  

            </div>

            <div class="form-group" style="padding-top:25px">

                 <label class="col-form-label col-lg-1 col-md-1">Tipo</label>
                <div class="col-lg-4 col-md-3">
                    <select  class="form-control input-md selectpicker" data-live-search="true" name="editarTipo" id="editarTipo" required>
                        <option value="">Tipo Doc.</option>
                        <?php

                        $tipoDoc = ControladorCentroCostos::ctrMostrarTipoDoc();
                        #var_dump($tipoDoc);
                        foreach ($tipoDoc as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' .$value["codigo"]." - ".$value["descripcion"].'</option>';
                        }

                        ?>
                    </select>
                </div> 

                <label class="col-form-label col-lg-1 col-md-1">Docs</label>
                <div class="col-lg-6">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarDocumentoI" name="editarDocumentoI">
                </div>

            </div>   
            
            <div class="form-group" style="padding-top:25px">

                <label class="col-form-label col-lg-1 col-md-1">Obs.</label>
                <div class="col-lg-11">
                    <input type="text" style="text-transform:uppercase;" class="form-control input-sm" id="editarObservacion" name="editarObservacion">
                </div>

            </div>             

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Ingreso</button>

        </div>

        <?php

          $editarIngresosCaja = new ControladorCentroCostos();
          $editarIngresosCaja -> ctrEditarIngresosCaja();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL CERRAR MES
======================================-->

<div id="modalCerrarMes" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cerrar Mes</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                <input type="hidden" id="usuario" name="usuario" value = "<?php echo $_SESSION["id"]?>">

                  <select class="form-control input-sm selectpicker" id="mesCerrar" name="mesCerrar" data-live-search="true" required>

                    <option value="">Seleccionar Mes</option>

                    <?php

                    $mes = ControladorCentroCostos::ctrMostrarMeses();
                    var_dump("mes", $mes);

                    foreach ($mes as $key => $value) {

                      echo '<option value="'.$value["cod_mes"].'">'.$value["correlativo"].' - '.$value["nom_mes"].'</option>';
                    }

                    ?>

                  </select>

              </div>

            </div>       

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Cerrar Mes</button>

        </div>

      </form>

        <?php

          $cerrarMEs = new ControladorCentroCostos();
          $cerrarMEs -> ctrCerrarMesI();

        ?>  


    </div>

  </div>

</div>

<?php

  $anularIngreso = new ControladorCentroCostos();
  $anularIngreso -> ctrAnularIngreso();

?>

<script>
    window.document.title = "Ingresos (+)"
</script>