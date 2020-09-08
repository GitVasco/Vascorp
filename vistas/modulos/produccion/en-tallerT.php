<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Talleres - TERMINADO

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Talleres - TERMINADO</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-12 col-md-12 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border">
            <button type="button" class="btn btn-info" id="asddadad" name="asddadad" data-toggle="modal" data-target="#fsdfsfsd">Asignar Trabajador
            </button>

            <button type="button" class="btn btn-default pull-right" id="daterange-btnTallerT">

          <span>
            <i class="fa fa-calendar"></i>

            <?php

              if(isset($_GET["fechaInicial"])){

                echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];

              }else{
              
                echo 'Rango de fecha';

              }

            ?>

          </span>

          <i class="fa fa-caret-down"></i>

        </button>
          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaTalleresT">

              <thead>

                <tr>

                  <th>Id</th>
                  <th>Cod. Barra</th>
                  <th>Modelo</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Operación</th>
                  <th>Trabajador</th>
                  <th>Cantidad</th>
                  <th>Fecha Proceso</th>
                  <th>Fecha Terminado</th>
                  <th>Estado</th>
                  <th>Tiempo real</th>

                </tr>

              </thead>

            </table>

          </div>

        </div>

      </div>

    </section>

  </div>

     

<!--=====================================
MODAL CONFIGURAR Trabajador
======================================-->

<div id="fsdfsfsd" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Asignar Trabajador</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group" align="center">

              <img src="vistas/img/plantilla/jackyform_paloma.png" width="400px" height="300px">

            </div>
            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                  <select class="form-control input-sm selectpicker" id="cod_tra" name="cod_tra" data-live-search="true" required>

                    <option value="">Seleccionar Trabajador</option>

                    <?php

                    $trabajador = ControladorTrabajador::ctrMostrarTrabajadorActivo();
                    #var_dump("trabajador", $trabajador);

                    foreach ($trabajador as $key => $value) {

                      echo '<option value="' . $value["cod_tra"] . '">' . $value["cod_tra"] . ' - ' . $value["nom_tra"] . ', ' . $value["ape_pat_tra"] . ' ' . $value["ape_mat_tra"] . '</option>';
                    }

                    ?>

                  </select>

              </div>

            </div>       

            <div class="form-group">

              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                  <input type="text" class="form-control" id="codigoBarra" name="codigoBarra" placeholder="Ingresar Código" autofocus>

              </div>

            </div>                

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Asignar Trabajador</button>

        </div>

      </form>

        <?php

          $asignarTrabajador = new ControladorTalleres();
          $asignarTrabajador -> ctrAsignarTrabajador();

        ?>  


    </div>

  </div>

</div>
