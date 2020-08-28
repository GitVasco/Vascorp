<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar fichas tecnicas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Fichas tecnicas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarFichaTecnica">
          
          Agregar ficha tecnica

        </button>

      </div>

      <div class="box-body">
      <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
       <table class="table table-bordered table-striped dt-responsive tablaFichaTecnica">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Tarjetas</th>
           <th>Archivo</th>
           <th>Fecha de Cambio</th>
           <th>Acciones</th>

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
MODAL AGREGAR PARA
======================================-->

<div id="modalAgregarFichaTecnica" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Ficha tecnica</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select name="nuevaTarjeta" id="nuevaTarjeta" class="form-control input-lg">
                <option value="">Seleccionar ficha tecnica</option>

                  <?php

                  $valor = null;

                  $tarjetas = ControladorTarjetas::ctrMostrarTarjetas($valor);

                  foreach ($tarjetas as $key => $value) {
                    echo '<option value="' . $value["id"] . '">' . $value["codigo"] . '</option>';
                  }

                  ?>
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="file" class="form-control input-lg" name="nuevaPara" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar ficha tecnica</button>

        </div>

        <?php

          $crearPara = new ControladorParas();
          $crearPara -> ctrCrearPara();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PARA
======================================-->

<div id="modalEditarFichaTecnica" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Ficha tecnica</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select name="editarTarjeta" id="editarTarjeta" class="form-control input-lg">
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="file" class="form-control input-lg" name="editarPara" id="editarPara" required>

                 <input type="hidden"  name="idPara" id="idPara" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

        <?php

          $editarPara = new ControladorParas();
          $editarPara -> ctrEditarPara();

        ?>

      </form>

    </div>

  </div>

</div>


<?php

  $borrarPara = new ControladorParas();
  $borrarPara -> ctrBorrarPara();

?>
