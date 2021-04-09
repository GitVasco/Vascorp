<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar sublimados
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar sublimados</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSublimado">
          
          Agregar sublimado

        </button>

        <button class="btn btn-outline-success btnReporteColor" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte sublimados  </button>
        

        <button type="button" class="btn btn-default pull-right" id="daterange-btnSublimado">
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
        
       <table class="table table-bordered table-striped dt-responsive tablaSublimados">
         
        <thead>
         
         <tr>
           
           <th>N°</th>
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Col. Modelo</th>
           <th>Cantidad</th>
           <th>Cod. Mat.</th>
           <th>Mat. Prima</th>
           <th>Color Mat. Prima</th>
           <th>Fec. Inicio</th>
           <th>Fec. Fin</th>
           <th>Tie. Utilizado</th>
           <th>Corte</th>
           <th>Usuario</th>
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
MODAL AGREGAR TIPO PAGO
======================================-->

<div id="modalAgregarSublimado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar sublimado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <label for="">Modelo</label>   
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-list"></i></span> 

                <select class="form-control input-lg selectpicker" name="nuevoModeloSublimado" id="nuevoModeloSublimado" data-live-search="true" required>
                  <option value="">Seleccionar Modelo</option>
                  <?php
                    $item=null;
                    $valor=null;
                    $modelos = ControladorModelos::ctrMostrarModelosActivos($item,$valor);
                    foreach ($modelos as $key => $value) {
                      echo '<option value="' . $value["modelo"] . '">' . $value["nombre"] . '</option>';
                    }
                  ?>

                </select>
              </div>

            </div>          

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <label for="">Color modelo</label>   
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-list"></i></span> 

                <select class="form-control input-lg selectpicker" name="nuevoColorModelo" id="nuevoColorModelo" data-live-search="true" required>
                  <option value="">Seleccionar Color Modelo</option>
                 
                </select>
              </div>

            </div>  

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <label for="">Materia Prima</label>   
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-list"></i></span> 

                <select class="form-control input-lg selectpicker" name="nuevaMateriaSublimado"  id="nuevaMateriaSublimado" data-live-search="true" required>
                  <option value="">Seleccionar Materia Prima</option>
                 
                </select>
              </div>

            </div>  

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <label for="">Orden Corte</label>   
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-list"></i></span> 

                <select class="form-control input-lg selectpicker" name="nuevoCorteSublimado" id="nuevoCorteSublimado"  data-live-search="true" >
                  <option value="">Seleccionar Orden de Corte</option>
                 
                </select>
              </div>

            </div>  

            <?php 
              $fecha = new DateTime();
              $fechaActual = $fecha->format("Y-m-d").' 00:00:00';
            ?>

            <div class="form-group ">
            <label for="">Fecha Inicio</label>                    
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  <input type="datetime" class="form-control"  name="nuevaFechaInicio" data-inputmask="'mask':'9999-99-99 99:99:99'" data-mask   value="<?php echo $fechaActual;?>" required>

              </div>

            </div>       

            
            <div class="form-group ">
            <label for="">Fecha Fin</label>                    
              <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                  <input type="datetime" class="form-control"  name="nuevaFechaFin" data-inputmask="'mask':'9999-99-99 99:99:99'" data-mask value="<?php echo $fechaActual;?>" required>

              </div>

            </div>   
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <label for="">Cantidad</label>   
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-height"></i></span> 

                <input type="number" class="form-control input-md" name="nuevaCantidad" placeholder="Ingresar cantidad" required>
                <input type="hidden" name="nuevoUsuario" value="<?php echo $_SESSION["id"];?>">

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar sublimado</button>

        </div>

      </form>


      <?php

        $crearSublimado = new ControladorProcedimientos();
        $crearSublimado -> ctrCrearSublimado();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR TIPO PAGO
======================================-->

<div id="modalEditarSublimado" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar sublimado</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO  -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text"  class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
                <input type="hidden" id="idProcedimiento" name="idProcedimiento">
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

        $editarBanco = new ControladorBancos();
        $editarBanco -> ctrEditarBanco();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarBanco = new ControladorBancos();
  $eliminarBanco -> ctrEliminarBanco();

?>

<script>
window.document.title = "Sublimados"
</script>