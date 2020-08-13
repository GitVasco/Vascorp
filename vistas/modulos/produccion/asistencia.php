<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar asistencias
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar asistencias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
    <?php
    $hoy= date("Y-m-d");
    $marcoAsistencia=ControladorAsistencias::ctrMostrarPresente();
    if($marcoAsistencia["fecha"] != $hoy){
      
      echo '<div class="box-header with-border">
        <form role="form" method="post">
          <button type="submit" class="btn btn-primary " name="btnRegistrarAsistencia">
            <i class="fa fa-plus-square"></i>
            Registrar asistencias

          </button>
        </form>';
    
        if(isset($_POST["btnRegistrarAsistencia"])){
          $crearAsistencia= new ControladorAsistencias();
          $crearAsistencia-> ctrCrearAsistencia();
        }
     
      echo'</div>';
      
    }
      ?>

      <button type="button" class="btn btn-default pull-right" id="daterange-btnes">

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
        
       <table class="table table-bordered table-striped dt-responsive tablaAsistencias">
         
        <thead>
         <tr>
           
           <th>Codigo trabajador</th>
           <th>Trabajador</th>
           <th>Estado</th>
           <th>Fecha</th>
           <th>Minutos</th>
           <th>Para</th>
           <th>Tiempo para</th>
           <th>Horas extras</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
         <?php
            // if(isset($_GET["fechaInicial"])){

            //   $fechaInicial = $_GET["fechaInicial"];
            //   $fechaFinal = $_GET["fechaFinal"];

            // }else{

            //   $fechaInicial = null;
            //   $fechaFinal = null;

            // }
            // $respuesta = ControladorAsistencias::ctrRangoFechasAsistencias($fechaInicial, $fechaFinal);
            // foreach ($respuesta as $key => $value) {

            //   if($value["estado"] == "ASISTIO"){

            //     $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$value["id"]."' estadoAsistencia='FALTA'><img id='estadoImagen' src='vistas/img/plantilla/asistio.png'  width='40px'></button>";
                
    
            // }else{
    
            //     $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$value["id"]."' estadoAsistencia='ASISTIO'><img id='estadoImagen' src='vistas/img/plantilla/falto.png'  width='40px'></button>";
                
            // }

            //   $botones =  "<div class='btn-group'><button class='btn btn-danger btnEditarAsistencia' idAsistencia='".$value["id"]."' data-toggle='modal' data-target='#modalEditarAsistencia' title='Editar para'><i class='fa fa-exclamation-triangle'></i></button><button class='btn btn-success btnEditarExtras' idAsistencia='".$value["id"]."' data-toggle='modal' data-target='#modalEditarExtras' title='Editar horas extras'><i class='fa fa-clock-o'></i></button></div>"; 

            // echo '<tr>
            //         <td>'.$value["id_trabajador"].'</td>
            //         <td>'.$value["nom_tra"].$value["ape_pat_tra"].$value["ape_mat_tra"].'</td>
            //         <td>'.$imagen.'</td>
            //         <td>'.date("Y-m-d",strtotime($value["fecha"])).'</td>
            //         <td>'.$value["minutos"].'</td>
            //         <td>'.$value["nombre"].'</td>
            //         <td>'.$value["tiempo_para"].'</td>
            //         <td>'.$value["horas_extras"].'</td>
            //         <td>'.$botones.'</td></tr>';
            // }
         ?> 
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>



<!--=====================================
MODAL EDITAR Asistencia
======================================-->

<div id="modalEditarAsistencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" id="formularioAsistencia" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar asistencia</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-3">
            <label ><strong>Codigo Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>
                
              </div>

            </div>

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-9" style="margin-top:20px">
            <label ><strong>Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTrabajador" id="editarTrabajador" required>
                
              </div>

            </div>
            <div class="box box-primary col-lg-12">
            <!-- ENTRADA PARA EL MINUTOS -->
            <div class="form-group col-lg-12 ingresoMinuto">
            <label ><strong>Minutos</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="number" class="form-control input-lg nuevoMinuto" name="editarMinutos" id="editarMinutos" step="any" min="0" original="" original2="" required readonly>
                <input type="hidden" id="idAsistencia" name="idAsistencia">
              </div>

            </div>
            </div>
            <!-- ENTRADA PARA PARAS -->
            <div class="box box-primary col-lg-12">

              <div class="form-group col-lg-6">
                <label ><strong>Para</strong></label>
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span> 

                  <select name="editarPara" id="editarPara" class="form-control input-lg selectpicker" data-live-search="true">
                    <option value="">Seleccionar Para</option>

                    <?php 
                      $item=null;
                      $valor=null;
                      $para=ControladorParas::ctrMostrarParas($item,$valor);
                      foreach ($para as $key => $value) {
                        echo"<option value='".$value['id']."'>".$value["nombre"]."</option>";
                      }
                    ?>
                  </select>
                </div>

              </div>

              <!-- ENTRADA PARA EL TIEMPO DE PARA -->
              
              <div class="form-group col-lg-6">
                <label><strong>Tiempo de para</strong></label>
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="number" class="form-control input-lg" name="editarTiempoPara" id="editarTiempoPara" step="any" min="0" max="585" required>
                  
                </div>

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

        $editarAsistencia = new ControladorAsistencias();
        $editarAsistencia -> ctrEditarAsistencia();

      ?>   


    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR HORAS EXTRAS
======================================-->

<div id="modalEditarExtras" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form"  method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Extras</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-3">
            <label ><strong>Codigo Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo2" id="editarCodigo2" required>
                
              </div>

            </div>

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-9" style="margin-top:20px">
            <label ><strong>Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTrabajador2" id="editarTrabajador2" required>
                
              </div>

            </div>
            <div class="box box-primary col-lg-12">
            <!-- ENTRADA PARA EL MINUTOS -->
            <div class="form-group col-lg-12 ">
            <label ><strong>Minutos</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="number" class="form-control input-lg " name="editarMinutos2" id="editarMinutos2" step="any" min="0" originales="" originales2="" required readonly>
                <input type="hidden" id="idAsistencia2" name="idAsistencia2">
              </div>

            </div>
            </div>

              <!-- ENTRADA PARA EL TIEMPO DE PARA -->
              <div class="box box-primary col-lg-12">
                <div class="form-group col-lg-12">
                  <label><strong>Horas Extras</strong></label>
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarExtras" id="editarExtras" step="any" min="0" required>
                    
                  </div>

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

        $editarExtra = new ControladorAsistencias();
        $editarExtra -> ctrEditarExtra();

      ?>   


    </div>

  </div>

</div>
