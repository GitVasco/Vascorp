<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar sectores
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar sectores</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarSector">
          
          Agregar sector

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Sector</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $sectores = ControladorSectores::ctrMostrarSectores($item, $valor);

          foreach ($sectores as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["cod_sector"].'</td>

                    <td>'.$value["nom_sector"].'</td>';

                    if( $_SESSION["perfil"] == "Supervisores" ||
                        $_SESSION["perfil"] == "Sistemas"){

                          echo '<td>

                                <div class="btn-group">
                                    
                                  <button class="btn btn-warning btnEditarSector" data-toggle="modal" data-target="#modalEditarSector" idSector="'.$value["cod_sector"].'"><i class="fa fa-pencil"></i></button>
          
                                  <button class="btn btn-danger btnEliminarSector" idSector="'.$value["cod_sector"].'"><i class="fa fa-times"></i></button>
          
                                </div>  
          
                              </td>';

                    }else{

                      echo '<td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-warning btnEditarSector" data-toggle="modal" data-target="#modalEditarSector" idSector="'.$value["cod_sector"].'"><i class="fa fa-pencil"></i></button>

                              </div>  

                            </td>';

                      
                    }




                  echo '</tr>';
          
            }

        ?>
         
         
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR SECTOR
======================================-->

<div id="modalAgregarSector" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Sector</h4>

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

                <input type="text" min="0" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar codigo" required>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoSector" placeholder="Ingresar sector" required>

              </div>

            </div>
 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar sector</button>

        </div>

      </form>


      <?php

        $crearSector = new ControladorSectores();
        $crearSector -> ctrCrearSector();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR SECTOR
======================================-->

<div id="modalEditarSector" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar sector</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarSector" id="editarSector" required>
                <input type="hidden" id="idSector" name="idSector">
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

        $editarSector = new ControladorSectores();
        $editarSector -> ctrEditarSector();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarSector = new ControladorSectores();
  $eliminarSector -> ctrEliminarSector();

?>