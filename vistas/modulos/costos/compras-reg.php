<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Compras

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Compras</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-header">

                <div class="col-lg-1">

                    <button class="btn btn-info  generarTxt" id="generarTxt" name="generarTxt">
                        Generar *.txt
                    </button>
                    
                </div>
                <div class="col-lg-1">
                    <button class="btn btn-success btnVerToken" data-toggle="modal" data-target="#modalGenerarToken" onclick="showTime()">
                        <i class="fa fa-key"></i>
                        Generar token

                    </button>
                </div>

                <div class="col-lg-offset-5 col-lg-5">

                    <form role="form"  method="POST" enctype="multipart/form-data">
                        <div class="col-lg-10">
                            <input type="file" name="archivotxt" id="archivotxt" class="form-control" accept="text/plain">
                        </div>
                        <div class="col-lg-2">
                            <button type="submit"  class="btn btn-success" name="imporTxt"><i class="fa fa-upload"></i> Cargar Diario</a>
                        </div>
                    </form>

                    
                    <?php

                        $actualizarStock = new ControladorCompras();
                        $actualizarStock->ctrLeerTxt();

                    ?>
                    
                </div>                
            
            </div>

            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive TablaRegCompras" width="100%">

                    <thead>

                        <tr>

                            <th>Mes</th>
                            <th>O.</th>
                            <th>V.</th>
                            <th>Ruc</th>
                            <th>Razón Social</th>
                            <th>TD</th>
                            <th>Ser</th>
                            <th>Doc</th>
                            <th>Total</th>
                            <th width="60px">F. Emi</th>
                            <th width="60px">F. Ven</th>
                            <th>Comp-Cont-Cond</th>
                            <th>Rev</th>
                            <th>Botones</th>

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
MODAL GENERAR TOKEN
======================================-->

<div id="modalGenerarToken" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="formularioToken">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Generar token</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <div class="box-body" >

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              <label>RUC</label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" min="0" class="form-control input-md" name="nuevoRuc"  value="10472810371" readonly>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <label>SERIE</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-md" name="nuevaSerie" value="af1e8535-d99a-4915-b515-91e36d9f71ae" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-6" style="padding-left:0px !important">
              <label>HORA INICIAL</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-md" name="nuevoInicio" id="nuevoInicio"  readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-6" style="padding-right:0px !important">
              <label>HORA FINAL</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-md" name="nuevoFin" id="nuevoFin"  readonly>

                <input type="hidden" id ="nuevaFechaToken" value="<?php echo date("d-m-Y");?>">
              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            <label>SERIE SECRET</label>
            <div class="form-group ">
              
              <div class="col-md-8"  style="padding-left:0px !important">
                <div class="input-group ">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-md" name="nuevaContrasena" value="MepGYmNzOeZ6EMMr2i0t4A==" readonly>
                

                </div>

              </div>
              

              <div class="col-md-4">
                <button type="button" class="btn btn-success btnGenerarToken" onclick="stopTime()"><i class="fa fa-play-circle-o"></i> Generar</button>
              </div>

              

            </div>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              <label>TOKEN</label>

            <textarea class="form-control input-md" name="nuevoCodigoToken" id = "nuevoCodigoToken" rows="12" readonly></textarea>


            </div>

            <!-- ENTRADA PARA LA DURACCION -->
            
            <div class="form-group ">
              <label>DURACIÓN</label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-md" name="nuevaDuracion" id="nuevaDuracion"  readonly>

              </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>


        </div>

      </form>


    </div>

  </div>

</div>

<?php

    $generarTxt = new ControladorCompras();
    $generarTxt -> ctrGenerarTxt();

?>

<script>
    window.document.title = "Compras";

    var t;
    function showTime(){
        myDate = new Date();
        hours = myDate.getHours();
        hours2 = hours+1;
        minutes = myDate.getMinutes();
        seconds = myDate.getSeconds();
        if (hours < 10) hours = "0" + hours;
        if (hours2 < 10) hours2 = "0" + hours2;
        if (minutes < 10) minutes = "0" + minutes;
        if (seconds < 10) seconds = "0" + seconds;
        $("#nuevoInicio").val(hours+ ":" +minutes+ ":" +seconds);
        $("#nuevoFin").val(hours2+ ":" +minutes+ ":" +seconds);
        t = setTimeout("showTime()", 1000);

    }
    function stopTime() {
        clearTimeout(t);
    }
</script>