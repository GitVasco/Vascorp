<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar operaciones articulos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar operaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a class="btn btn-primary" href="creardetalleoperaciones">
          
          Agregar operaciones

        </a>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaDetalleOperaciones">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Modelo</th>
           <th>Vendedor</th>
           <th>Total x Decena</th>
           <th>Tiempo standar total</th>
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
MODAL AGREGAR OPERACION
======================================-->

<div id="modalAgregarDetalleOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</butOperacion>
          <h4 class="modal-title">Agregar Operación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaOperacion" placeholder="Ingresar nombre" required>

              </div>

            </div>
 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar operación</button>

        </div>

      </form>


      <?php

        $crearOperacion = new ControladorOperaciones();
        $crearOperacion -> ctrCrearOperacion();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR OPERACION
======================================-->

<div id="modalEditarOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar operación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarOperacion" id="editarOperacion" required>
                <input type="hidden" id="idOperacion" name="idOperacion">
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

      </form>

      <?php

        $editarCabeceraOperacion = new ControladorOperaciones();
        $editarCabeceraOperacion -> ctrEditarCabeceraOperacion();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarCabeceraOperacion = new ControladorOperaciones();
  $eliminarCabeceraOperacion -> ctrEliminarCabeceraOperacion();

?>