
<div class="content-wrapper">
<title>Analisis</title>
<section class="content-header">
    <h1>
        Dashboard

        <small>Página de control</small>

    </h1>

    <ol class="breadcrumb">

        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

        <li class="active">Dashboard</li>

    </ol>

</section>


<section class="content">

    <div class="col-lg-10">

        <?php

            setlocale(LC_ALL,"es_ES");

            if(isset($_GET["mes"]) && $_GET["mes"] != "TODO"){

                $mesN = $_GET["mes"];

                $nomMes = ControladorTalleres::ctrMesB($mesN);
                $nomMesA = $nomMes["descripcion"];
              
              }else{
              
                $nomMesA = "TODOS";
              
              }

              #var_dump($nomMesA);

            echo '<div class="box box-success">

                    <div class="box-header">

                        <h1>Bienvenid@ ' .$_SESSION["nombre"].' - MES - <b>'.$nomMesA.'</b></h1>

                    </div>

                 </div>';


        ?>

    </div>   

    <div class="col-lg-2">

        <select class="form-control input-lg selectpicker" id="mesGerencia" name="mesGerencia" data-live-search="true">

            <option value="">Seleccionar Mes</option>  
            <option value="TODO">TODO</option>
            <option value="1">ENERO</option>
            <option value="2">FEBRERO</option>
            <option value="3">MARZO</option>
            <option value="4">ABRIL</option>
            <option value="5">MAYO</option>
            <option value="6">JUNIO</option>
            <option value="7">JULIO</option>
            <option value="8">AGOSTO</option>
            <option value="9">SEPTIEMBRE</option>
            <option value="10">OCTUBRE</option>
            <option value="11">NOVIEMBRE</option>
            <option value="12">DICIEMBRE</option>
            
        </select>

    </div>     
    
    <div class="row">

    <?php

        include "inicio/cajas-superiores-cia.php";

    ?>

    </div>    

    <div class="row">

        <div class="col-lg-3">

            <div class="box box-danger">
                <div class="box-header with-border"></div>
                <center><b>Ventas por Documento</b></center>

                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped dt-responsive tablaVtasGerencia" width="100%"> 
                        <thead>
                            <tr>
                                <th>CT</th>
                                <th>Tipo</th>
                                <th>Neto</th>
                                <th>Igv</th>
                                <th>Dscto</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>                            
                        </tbody>
                    </table>
                </div>

            </div>

        </div>




        <div class="col-lg-4">

        <div class="box box-danger">
                <div class="box-header with-border"></div>
                <center><b>Ventas / Pedidos por Vendedor</b></center>

                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped dt-responsive tablaVtasGerenciaVdor" width="100%"> 
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Ventas</th>
                                <th>Pedidos</th>                                
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>                            
                        </tbody>
                    </table>
                </div>

            </div>        



        </div>

        <div class="col-lg-5">

        <div class="box box-danger">
                <div class="box-header with-border"></div>
                <center><b>Cuentas por cobrar - Vendedor</b></center>

                <div class="box-body no-padding">
                    <table class="table table-bordered table-striped dt-responsive tablaCtasVdor" width="100%"> 
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Facturas</th>
                                <th>Guias</th>                                
                                <th>Letras</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                            
                        </tbody>
                    </table>
                </div>

            </div>        



        </div>        


    </div>      

    <div class="row">

        <div class="col-lg-6">

            <?php

                include "reportes/vtas-ano.php";

            ?>

        </div>




        <div class="col-lg-6">

            <?php

                include "reportes/pagos-ano.php";

            ?>

        </div>


    </div>

  
    
    
</section>

</div>

<script>
window.document.title = "Analisis"
</script>


