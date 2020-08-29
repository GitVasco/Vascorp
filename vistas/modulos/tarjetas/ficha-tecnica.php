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


      <div class="box-body">
      <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">
       <table class="table table-bordered table-striped dt-responsive tablaFichaTecnica">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Ficha tecnica</th>
           <th>Codigo</th>
           <th>Modelo</th>
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
