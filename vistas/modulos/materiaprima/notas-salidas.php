<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Notas de Salidas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Notas de Salidas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-nota-salida">

          <button class="btn btn-primary">

            Agregar Nota de Salida

          </button>

        </a>

        
        <button class="btn btn-outline-success "  style="border:green 1px solid">
                      <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Notas de Salida </button> 
        <button type="button" class="btn btn-default pull-right" id="daterange-btnNotasSalidas">
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

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
       <table class="table table-bordered table-striped dt-responsive tablaNotasSalidas">
         
        <thead>
         
         <tr>
           
           <th>Tipo</th>
           <th>Serie</th>
           <th>Numero</th>
           <th>Fec. Emisión</th> 
           <th>Razon Social</th>
           <th>Almacen de Salida</th>
           <th style="width:120px">Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>
<?php 
  $eliminarIngreso = new ControladorIngresos();
  $eliminarIngreso -> ctrEliminarIngreso();
?>

<script>
window.document.title = "Notas de Salidas"
</script>