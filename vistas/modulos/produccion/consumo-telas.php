<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar consumo de telas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar consumo de telas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
        <div class="box-header with-border">

        <button type="button" class="btn btn-default pull-right" id="daterange-btnConsumoTela">
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
        
       <table class="table table-bordered table-striped dt-responsive tablaConsumoTelas" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Corte</th>
           <th>Nota salida</th>
           <th>Guia</th>
           <th>Fecha</th>
           <th>Materia Prima</th>
           <th>Color</th>
           <th>Unidad</th>
           <th>Stock</th>

         </tr> 

        </thead>

        <tbody>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>


<script>
window.document.title = "Consumo de telas"
</script>