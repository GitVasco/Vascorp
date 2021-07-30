<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar CENTRO DE COSTOS

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar CENTRO DE COSTOS</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCosto">
          
                    Agregar Centro de Costo
          
                  </button>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive TablaCentroCostos" width="100%">

                    <thead>

                        <tr>

                            <th>Key</th>
                            <th>Cod. Gasto</th>
                            <th>Tipo Gasto</th>
                            <th>Cod. Área</th>
                            <th>Área</th>
                            <th>Cod. Caja</th>
                            <th>Descripción</th>

                        </tr>

                    </thead>

                    <tbody>
                    </tbody>

                </table>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL AGREGAR CENTRO DE COSTOS
======================================-->

<div id="modalAgregarCosto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Centro de Costo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group">
                <label class="col-form-label col-lg-4 col-md-1">Tipo Gasto</label>
                <div class="col-lg-8 col-md-3">

                    <select  class="form-control input-md selectpicker" data-live-search="true" name="tipoGasto" id="tipoGasto" required>
                      <option value="">Seleccionar Tipo Gasto</option>
                      <?php

                        $valor = "TGAS";

                        $gastos = ControladorMaestras::ctrMostrarMaestrasDetalle($valor);
                        var_dump($gastos);
                        foreach ($gastos as $key => $value) {
                          echo '<option value="' . $value["cod_argumento"] . '">' .$value["cod_argumento"]. " - " . $value["des_larga"] . '</option>';
                        }

                      ?>
                    </select>
                </div>
            </div>

            <div class="form-group" style="padding-top:25px">
              <label class="col-form-label col-lg-4 col-md-1">Área</label>
              <div class="col-lg-8 col-md-3">

                  <select  class="form-control input-md selectpicker" data-live-search="true" name="Area" id="Area" required>
                    <option value="">Seleccionar Área</option>
                  </select>

              </div>  
              
            </div>

            <div class="form-group" style="padding-top:25px">
              <label class="col-form-label col-lg-4 col-md-1">Nuevo Código</label>
              <div class="col-lg-4 col-md-3">

                <input type="text" class="form-control input-md" name="nuevoCod" id="nuevoCod" placeholder="00000" readonly>

              </div> 

            </div>
            
            <div class="form-group" style="padding-top:25px">
              <label class="col-form-label col-lg-4 col-md-1">Centro de Costos</label>
              <div class="col-lg-8 col-md-3">

                <input type="text" class="form-control input-md" name="nuevoCC" id="nuevoCC" required>

              </div> 
            </div>        

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Centro Costo</button>

        </div>

        <?php

          $crearCentroCostos = new ControladorCentroCostos();
          $crearCentroCostos -> ctrCrearCentroCostos();

        ?>

      </form>

    </div>

  </div>

</div>

<script>
    window.document.title = "Centro de Costos"
</script>