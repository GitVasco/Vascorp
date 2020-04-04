<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Cortes

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Cortes</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        
       <table class="table table-bordered table-striped dt-responsive tablaCortes">
         
        <thead>
         
         <tr>
           
           <th>Artículo</th>
           <th>Marca</th>
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Color</th>
           <th>Talla</th>
           <th>Alm. Corte</th>
           <th>Cod. Op.</th>
           <th>Operación</th>
           <th>Acciones</th>

         </tr> 

        </thead>

       </table>

      </div>

    </div>

  </section>

</div>