<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Registro de Tareas a Talleres

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Registro Talleres</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            LA TABLA DE EN PROCESO
            ======================================-->

            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

                <div class="box box-primary">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <h3 class="box-title">En Proceso</h3>

                        <table class="table table-bordered table-striped dt-responsive tablaTallerPB" width="100%">

                            <thead>

                                <tr>
                                    <th style="width: 50px">Cod. Barra</th>
                                    <th>Trabajador</th>
                                    <th>Operación</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Hora Inicio</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <h3 class="box-title">Terminado</h3>

                        <table class="table table-bordered table-striped dt-responsive tablaTallerTB" width="100%">

                            <thead>

                                <tr>
                                    <th style="width: 50px">Cod. Barra</th>
                                    <th>Trabajador</th>
                                    <th>Operación</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Hora Fin</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>                


            </div>
         

            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-5 col-xs-12">

                <div class="box box-info">

                    <div class="box-header with-border"></div>

                    <form role="form" method="post">

                        <div class="box-body">

                            <div class="box">

                                <table class="table table-bordered table-striped dt-responsive tablasA" width="100%">
                                    
                                    <thead>
                                    
                                    <tr>

                                        <th>Trabajador</th>

                                    </tr> 

                                    </thead>

                                    <tbody>

                                    <?php

                                        if($_SESSION["id"] == "26"){

                                            $taller = "T1";

                                        }else{

                                            $taller = "T3";

                                        }

                                        $traList = ControladorProduccion::ctrMostrarTrabTaller($taller);
                                        #var_dump($traList);

                                        foreach($traList as $key => $value) {
                                    
                                        echo ' <tr>

                                                    <td class="text-uppercase">                        <div class="btn-group">';

                                                    if($value["configuracion"] == "1"){

                                                        echo '<button type="button" class="btn btn-primary btn-sm btnActTra" idTrab="'.$value["cod_tra"].'"><i class="fa fa-user text-white"></i>   '.$value["cod_tra"].' - '.$value["trabajador"].'</button>';

                                                    }else{

                                                        echo '<button type="button" class="btn btn-default btn-xs btnActTra" idTrab="'.$value["cod_tra"].'"><i class="fa fa-user text-blue"></i> '.$value["cod_tra"].' - '.$value["trabajador"].'</button>';

                                                    }
                            
                                                    echo '</div>
                                                    </td>

                                            </tr>';
                                    }

                                    ?>


                                    </tbody>

                                </table>                            

                                <?php

                                $usuario = $_SESSION["id"];
                                $trabajador = ControladorTrabajador::ctrMostrarTrabajadorConfigurado($usuario);
                                //var_dump($trabajador);

                                ?>

                                <div class="box box-success">

                                    <div class="box-header">

                                        <h3 align="center"> Hola "<?php echo $trabajador["trabajador"];?>"</h3>

                                    </div>

                                </div>

                                <!--=====================================
                                ENTRADA DEL CODIGO
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                                        <input type="hidden" class="form-control" id="cod_tra" name="cod_tra" value="<?php echo $trabajador["cod_tra"];?>">

                                        <input type="text" class="form-control" id="codigoBarra" name="codigoBarra" placeholder="Ingresar Código" autofocus>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">Registrar</button>

                        </div>

                    </form>

                    <?php

                    $registrarProceso = new ControladorTalleres();
                    $registrarProceso -> ctrProceso();

                    ?> 

                </div>

            </div>

        </div>

    </section>

</div>

<?php

$configurarTrabajador = new ControladorTrabajador();
$configurarTrabajador -> ctrConfigurarTrabajador();

?> 

<script>
window.document.title = "Registrar tareas"
</script>