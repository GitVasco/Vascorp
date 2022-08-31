<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Equipos

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Equipos</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

        <div class="box-header with-border">

            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarEquipos">
            <i class="fa fa-plus-square"></i>
                Agregar maquina

            </button>

        </div>

        <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaEquipos" width="100%"> 

                <thead>

                    <tr>

                        <th>Cod. Tip</th>
                        <th>Nombre Tipo</th>
                        <th>Descripcion</th>
                        <th>Ubicación</th>
                        <th>Marca Equipo</th>
                        <th>Modelo Equipo</th>
                        <th>Serie Equipo</th>
                        <th>Ult. Mantenimiento</th>
                        <th>Estado</th>
                        <th style="width:100px">Acciones</th>

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
MODAL AGREGAR EQUIPOS
======================================-->
<div id="modalAgregarEquipos" class="modal fade" role="dialog">
  
    <div class="modal-dialog" style="width:50%">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Agregar Equipo</h4>

            </div>

            <?php 
            date_default_timezone_set('America/Lima');
            $fecha = new DateTime();
            ?>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <div class="box-body">            
                    
                <label>DATOS DE LA MAQUINA</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA EL CÓDIGO DEL TIPO DE MAQUINA -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TIPO MAQUINA</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoTipMaq" id="nuevoTipMaq" data-size="10" required>
                            
                            <?php

                                $valor = 'TDMV';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR TIPO MAQUINA</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div> 

                        <!-- ENTRADA PARA EL CÓDIGO TIPO -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">COD. TIPO</label>
                        <div class="col-lg-2">

                            <input type="text" class="form-control input-md"  name="nuevoCodTipo"  id ="nuevoCodTipo" readonly required>

                        </div>           

                    </div>

                    <div class="col-lg-12"></div>
                    
                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA LA DESCRIPCION -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">DESCRIPCION</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaDescripcion"  id="nuevaDescripcion" placeholder="Ingresar descripción"  required>

                        </div> 

                        <!-- ENTRADA PARA LA UBICACION -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">UBICACIÓN</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaUbicacion" id="nuevaUbicacion" data-size="10" required>
                            
                            <?php

                                $valor = 'TUBI';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR UBICACIÓN</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div>                     

                    </div>

                    <div class="col-lg-12"></div>

                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA LA MARCA DE MAQUINA -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MARCA MAQUINA</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaMarcaMaq" id="nuevaMarcaMaq" data-size="10" required>
                            
                            <?php

                                $valor = 'TMAR';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR MARCA</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div> 
                        
                        <!-- ENTRADA PARA modelo -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MODELO MAQUINA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevoModeloMaq"  id="nuevoModeloMaq" placeholder="Ingresar modelo de maquina"  required>

                        </div>                     

                    </div>  
                    
                    <div class="col-lg-12"></div>

                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA LA SERIE -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">SERIE MAQUINA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaSerieMaq"  id="nuevaSerieMaq" placeholder="Ingresar serie de maquina"  required>

                        </div>                     

                    </div>                  

                    <div class="col-lg-12"></div>     
                    
                    <label style ="padding-top:15px">DATOS DEL MOTOR</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA TIPO MOTOR-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TIPO MOTOR</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevoTipoMotor"  id="nuevoTipoMotor" placeholder="Ingresar tipo motor">

                        </div>   
                        
                        <!-- ENTRADA PARA LA MARCA DE MOTOR -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MARCA MOTOR</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaMarcaMotor" id="nuevaMarcaMotor" data-size="10">
                            
                            <?php

                                $valor = 'TMAR';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR UBICACIÓN</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div>                     

                    </div>               
                    
                    <div class="col-lg-12"></div>     
                    
                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA MODELO MOTOR-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MODELO MOTOR</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevoModeloMotor"  id="nuevoModeloMotor" placeholder="Ingresar modelo motor">

                        </div>   
                        
                        <!-- ENTRADA PARA SERIE MOTOR-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">SERIE MOTOR</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevoSerieMotor"  id="nuevoSerieMotor" placeholder="Ingresar serie motor">

                        </div>                      

                    </div> 

                    <div class="col-lg-12"></div>     
                    
                    <label style ="padding-top:15px">DATOS DE LA CAJA</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA LA MARCA DE CAJA -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MARCA CAJA</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevaMarcaCaja" id="nuevaMarcaCaja" data-size="10">
                            
                            <?php

                                $valor = 'TMAR';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR MARCA CAJA</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div>        
                        
                        <!-- ENTRADA PARA MODELO CAJA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MODELO CAJA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevoModeloCaja"  id="nuevoModeloCaja" placeholder="Ingresar modelo caja">

                        </div>                      

                    </div>               
                    
                    <div class="col-lg-12"></div>     
                    
                    <div class="form-group" style="padding-top:25px">

                        <!-- ENTRADA PARA SERIE CAJA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">SERIE CAJA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaSerieCaja"  id="nuevaSerieCaja" placeholder="Ingresar serie caja">

                        </div>   

                    </div>  
                    
                    <div class="col-lg-12"></div>     
                    
                    <label style="padding-top:15px">DETALLES</label>  

                    <div class="form-group"> 

                        <!-- ENTRADA PARA FACTURA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">DOCUMENTO</label>
                        <div class="col-lg-2">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevoDocumento"  id="nuevoDocumento">   

                        </div>   

                        <!-- ENTRADA PARA RUC-->
                        <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RUC</label>
                        <div class="col-lg-2">

                            <input type="number" class="form-control input-md" style="text-transform:uppercase;" name="nuevoRuc"  id="nuevoRuc">   

                        </div>                          

                        <!-- ENTRADA PARA EMISION FACTURA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Fecha Emisión</label>
                        <div class="col-lg-3">

                            <input type="date" class="form-control input-md" style="text-transform:uppercase;" name="nuevoFecEmision"  id="nuevoFecEmision">

                        </div> 

                    </div>                      
                    
                    <div class="form-group" style="padding-top:25px">

                        <!-- ENTRADA PARA ESTADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">ESTADO</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoEstado" id="nuevoEstado" data-size="10" required>

                                <option value="">SELECCIONAR</option>
                                <option value="Operativo">Operativo</option>
                                <option value="Inoperativo">Inoperativo</option>
                                <option value="Sin Usar">Sin Usar</option>

                            </select>

                        </div>   

                        <!-- ENTRADA PARA OBSERVACIÓN-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">OBSERVACIÓN</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="nuevaObservacion"  id="nuevaObservacion" placeholder="Ingresar observaciones">

                        </div>  
                        
                    </div> 

                    <div class="col-lg-12"></div>

                    <div class="form-group" style="padding-top:25px">

                        <!-- ENTRADA PARA ULTIMO MANTE-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">ÚLT. MANTE.</label>
                        <div class="col-lg-4">

                            <input type="date" class="form-control input-md" style="text-transform:uppercase;" name="nuevoUltimoMantenimiento"  id="nuevoUltimoMantenimiento">

                        </div>   

                        <!-- ENTRADA PARA MANTENIMIENTO PROGRAMADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">PROG. MANTE.</label>
                        <div class="col-lg-4">

                            <input type="date" class="form-control input-md" style="text-transform:uppercase;" name="nuevoProgMantenimiento"  id="nuevoProgMantenimiento">

                        </div>                         

                    </div>                      

                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary">Guardar maquina</button>

            </div>

            </form>

            <?php

            $crearMaquina = new ControladorMantenimiento();
            $crearMaquina -> ctrCrearMaquina();

            ?>    

        </div>

    </div>

</div>

<!--=====================================
MODAL EDITAR EQUIPOS
======================================-->
<div id="modalEditarEquipos" class="modal fade" role="dialog">
  
    <div class="modal-dialog" style="width:50%">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Editar Equipo</h4>

            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <div class="box-body">            
                    
                <label>DATOS DE LA MAQUINA</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA EL CÓDIGO DEL TIPO DE MAQUINA -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TIPO MAQUINA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md"  name="editarTipMaq"  id ="editarTipMaq" readonly required>

                        </div> 

                        <!-- ENTRADA PARA EL CÓDIGO TIPO -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">COD. TIPO</label>
                        <div class="col-lg-2">

                            <input type="text" class="form-control input-md"  name="editarCodTipo"  id="editarCodTipo" readonly required>

                            <input type="hidden" class="form-control input-md"  name="editarIdEquipo"  id="editarIdEquipo" readonly required>

                        </div>           

                    </div>

                    <div class="col-lg-12"></div>
                    
                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA LA DESCRIPCION -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">DESCRIPCION</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" name="editarDescripcion"  id="editarDescripcion" required>

                        </div> 

                        <!-- ENTRADA PARA LA UBICACION -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">UBICACIÓN</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="editarUbicacion" id="editarUbicacion" data-size="10" required>
                            
                            <?php

                                $valor = 'TUBI';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR UBICACIÓN</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div>                     

                    </div>

                    <div class="col-lg-12"></div>

                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA LA MARCA DE MAQUINA -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MARCA MAQUINA</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="editarMarcaMaq" id="editarMarcaMaq" data-size="10" required>
                            
                            <?php

                                $valor = 'TMAR';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR MARCA</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div> 
                        
                        <!-- ENTRADA PARA modelo -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MODELO MAQUINA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarModeloMaq"  id="editarModeloMaq" placeholder="Ingresar modelo de maquina"  required>

                        </div>                     

                    </div>  
                    
                    <div class="col-lg-12"></div>

                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA LA SERIE -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">SERIE MAQUINA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarSerieMaq"  id="editarSerieMaq" placeholder="Ingresar serie de maquina"  required>

                        </div>                     

                    </div>                  

                    <div class="col-lg-12"></div>     
                    
                    <label style ="padding-top:15px">DATOS DEL MOTOR</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA TIPO MOTOR-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TIPO MOTOR</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarTipoMotor"  id="editarTipoMotor" placeholder="Ingresar tipo motor">

                        </div>   
                        
                        <!-- ENTRADA PARA LA MARCA DE MOTOR -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MARCA MOTOR</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="editarMarcaMotor" id="editarMarcaMotor" data-size="10">
                            
                            <?php

                                $valor = 'TMAR';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR UBICACIÓN</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div>                     

                    </div>               
                    
                    <div class="col-lg-12"></div>     
                    
                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA MODELO MOTOR-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MODELO MOTOR</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarModeloMotor"  id="editarModeloMotor" placeholder="Ingresar modelo motor">

                        </div>   
                        
                        <!-- ENTRADA PARA SERIE MOTOR-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">SERIE MOTOR</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarSerieMotor"  id="editarSerieMotor" placeholder="Ingresar serie motor">

                        </div>                      

                    </div> 

                    <div class="col-lg-12"></div>     
                    
                    <label style ="padding-top:15px">DATOS DE LA CAJA</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA LA MARCA DE CAJA -->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MARCA CAJA</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="editarMarcaCaja" id="editarMarcaCaja" data-size="10">
                            
                            <?php

                                $valor = 'TMAR';
                                $tmaq = ControladorMateriaPrima::ctrGlobalMaestra($valor);
                                var_dump($tmaq);


                                echo '<option value="">SELECCIONAR MARCA CAJA</option>';

                                foreach ($tmaq as $key => $value) {

                                    echo '<option value="'.$value["cod_argumento"].'">'.$value["cod_argumento"].' - '.$value["des_larga"].'</option>';

                                }

                            ?>
                            </select>

                        </div>        
                        
                        <!-- ENTRADA PARA MODELO CAJA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">MODELO CAJA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarModeloCaja"  id="editarModeloCaja" placeholder="Ingresar modelo caja">

                        </div>                      

                    </div>               
                    
                    <div class="col-lg-12"></div>     
                    
                    <div class="form-group" style="padding-top:25px">

                        <!-- ENTRADA PARA SERIE CAJA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">SERIE CAJA</label>
                        <div class="col-lg-4">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarSerieCaja"  id="editarSerieCaja" placeholder="Ingresar serie caja">

                        </div>   

                    </div>  
                    
                    <div class="col-lg-12"></div>     
                    
                    <label style ="padding-top:15px">DETALLES</label>  
                    
                    <div class="form-group" > 

                        <!-- ENTRADA PARA FACTURA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">DOCUMENTO</label>
                        <div class="col-lg-2">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarDocumento"  id="editarDocumento">   

                        </div>   

                        <!-- ENTRADA PARA RUC-->
                        <label for="" class="col-form-label col-lg-1 col-md-3 col-sm-3">RUC</label>
                        <div class="col-lg-2">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarRuc"  id="editarRuc">   

                        </div>                          

                        <!-- ENTRADA PARA EMISION FACTURA-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">Fecha Emisión</label>
                        <div class="col-lg-3">

                            <input type="date" class="form-control input-md" style="text-transform:uppercase;" name="editarFecEmision"  id="editarFecEmision">

                        </div> 

                    </div>  
                        
                    <div class="col-lg-12"></div>

                    <div class="form-group" style="padding-top:25px">

                        <!-- ENTRADA PARA ULTIMO MANTE-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">ÚLT. MANTE.</label>
                        <div class="col-lg-4">

                            <input type="date" class="form-control input-md" style="text-transform:uppercase;" name="editarUltimoMantenimiento"  id="editarUltimoMantenimiento">

                        </div>   

                        <!-- ENTRADA PARA MANTENIMIENTO PROGRAMADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">PROG. MANTE.</label>
                        <div class="col-lg-4">

                            <input type="date" class="form-control input-md" style="text-transform:uppercase;" name="editarProgMantenimiento"  id="editarProgMantenimiento">

                        </div>                         

                    </div>    
                    
                    <div class="col-lg-12"></div>  

                    <div class="form-group" style="padding-top:25px">                     

                        <!-- ENTRADA PARA ESTADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">ESTADO</label>
                        <div class="col-lg-2">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="editarEstado" id="editarEstado" data-size="10" required>

                                <option value="">SELECCIONAR</option>
                                <option value="Operativo">Operativo</option>
                                <option value="Inoperativo">Inoperativo</option>
                                <option value="Sin Usar">Sin Usar</option>

                            </select>

                        </div>   

                        <!-- ENTRADA PARA OBSERVACIÓN-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">OBSERVACIÓN</label>
                        <div class="col-lg-6">

                            <input type="text" class="form-control input-md" style="text-transform:uppercase;" name="editarObservacion"  id="editarObservacion" placeholder="Ingresar observaciones">

                        </div>  
                    
                    </div>  

                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary">Editar maquina</button>

            </div>

            </form>

            <?php

            $editarMaquina = new ControladorMantenimiento();
            $editarMaquina -> ctrEditarMaquina();

            ?>    

        </div>

    </div>

</div>

<script>
    window.document.title = "Equipos"
</script>