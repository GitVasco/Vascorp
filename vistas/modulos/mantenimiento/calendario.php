<?php

$valor = null;
$respuesta = ControladorMantenimiento::ctrTraerCalendario($valor);
#var_dump($respuesta);

?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
        Calendario
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Calendar</li>
        </ol>
    </section>


    <section class="content">
        <div class="row">
            <div class="col-lg-7">
                <div class="box box-danger">
                    <div class="box-header with-border"></div>

                    <div class="box-header with-border">
  
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCalendario">
                        <i class="fa fa-calendar"></i>
                            Agregar actividad

                        </button>

                    </div>

                    <div class="box-body no-padding">
                        <table class="table table-bordered table-striped dt-responsive tablaCalendario" width="100%"> 
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Título</th>
                                    <th>Inicio</th>
                                    <th>Fin</th>
                                    <th>Indicaciones</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th style="width:100px">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>                            
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-lg-5">
                <div class="box box-primary">
                    <div class="box-body no-padding">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>

            <div class="col-lg-7">

            </div>
            
            <div class="col-lg-2">
                <div class="box box-info">
                    <div class="box-header with-border">
                    <h4 class="box-title">Leyenda</h4>
                    </div>
                    <div>                        
                        <div class="bg-yellow">Mantenimiento</div>
                        <div class="bg-aqua">Actividades</div>
                        <div class="bg-light-blue">Reuniones</div>
                        <div class="bg-red">Capacitaciones</div>
                        <div class="bg-green">Cumpleaños</div>
                    </div>
                </div>
            </div>

            <div class="col-lg-2">

            </div>           
            
        </div>
    </section>

</div>

<!--=====================================
MODAL AGREGAR CALENDARIO
======================================-->
<div id="modalAgregarCalendario" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-dialog-centered" style="width:50%">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Agregar Actividad</h4>

            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <div class="box-body">            
                    
                <label>DATOS DE LA ACTIVIDAD</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA TIPO ACTIVIDAD-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TIPO</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="nuevoTipo" id="nuevoTipo" data-size="10" required>

                                <option value="">Seleccionar</option>
                                <option value="Actividades">Actividades</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Capacitacion">Capacitacion</option>
                                <option value="Cumpleaños">Cumpleaños</option>

                            </select>

                        </div>   
                        
                        <!-- ENTRADA TITULO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TÍTULO</label>
                        <div class="col-lg-4">

                            <input type="input" class="form-control input-md" name="nuevoTitulo" id="nuevoTitulo" maxlength="20">

                        </div>                          

                    </div>

                    <div class="col-lg-12"></div>
                    
                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA MANTENIMIENTO PROGRAMADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">INICIO</label>
                        <div class="col-lg-4">

                            <input type="datetime-local" class="form-control input-md" name="nuevoInicio" id="nuevoInicio">

                        </div>  

                        <!-- ENTRADA PARA MANTENIMIENTO PROGRAMADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">FIN</label>
                        <div class="col-lg-4">

                            <input type="datetime-local" class="form-control input-md" name="nuevoFin"  id="nuevoFin">

                        </div>                          

                    </div>

                    <div class="col-lg-12"></div>     
                    
                    <div class="form-group">

                        <!-- ENTRADA PARA TIPO MOTOR-->
                        <label for="" class="col-form-label col-lg-4 col-md-3 col-sm-3">DESCRIPCIÓN DE LA ACTIVIDAD</label>
                        <div class="col-lg-12">

                            <textarea type="textarea" rows="5" cols="136" id="nuevaObservacion" name="nuevaObservacion" placeholder="Detallar la actividad"></textarea>

                        </div>   

                    </div>  
                    
                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary">Registrar mantenimiento</button>

            </div>

            </form>

            <?php

            $crearMantenimiento = new ControladorMantenimiento();
            $crearMantenimiento -> ctrCrearCalendario();

            ?>    

        </div>

    </div>

</div>

<!--=====================================
MODAL AGREGAR CALENDARIO
======================================-->
<div id="modalEditarCalendario" class="modal fade" role="dialog">
  
    <div class="modal-dialog modal-dialog-centered" style="width:50%">

        <div class="modal-content">

            <form role="form" method="post" enctype="multipart/form-data">

            <!--=====================================
            CABEZA DEL MODAL
            ======================================-->

            <div class="modal-header" style="background:#3c8dbc; color:white">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Editar Actividad</h4>

            </div>

            <!--=====================================
            CUERPO DEL MODAL
            ======================================-->

            <div class="modal-body">

                <div class="box-body">            
                    
                <label>DATOS DE LA ACTIVIDAD</label>
                    <div class="form-group">

                        <!-- ENTRADA PARA TIPO ACTIVIDAD-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TIPO</label>
                        <div class="col-lg-4">

                            <select  class="form-control input-md selectpicker" data-live-search="true" name="editarTipo" id="editarTipo" data-size="10" required>

                                <option value="">Seleccionar</option>
                                <option value="Actividades">Actividades</option>
                                <option value="Mantenimiento">Mantenimiento</option>
                                <option value="Reunion">Reunion</option>
                                <option value="Capacitacion">Capacitacion</option>
                                <option value="Cumpleaños">Cumpleaños</option>

                            </select>

                        </div>   
                        
                        <!-- ENTRADA TITULO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">TÍTULO</label>
                        <div class="col-lg-4">

                            <input type="input" class="form-control input-md" name="editarTitulo" id="editarTitulo" maxlength="20">

                            <input type="hidden" class="form-control input-md" name="id" id="id">

                        </div>                          

                    </div>

                    <div class="col-lg-12"></div>
                    
                    <div class="form-group" style ="padding-top:25px">

                        <!-- ENTRADA PARA MANTENIMIENTO PROGRAMADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">INICIO</label>
                        <div class="col-lg-4">

                            <input type="datetime-local" class="form-control input-md" name="editarInicio" id="editarInicio">

                        </div>  

                        <!-- ENTRADA PARA MANTENIMIENTO PROGRAMADO-->
                        <label for="" class="col-form-label col-lg-2 col-md-3 col-sm-3">FIN</label>
                        <div class="col-lg-4">

                            <input type="datetime-local" class="form-control input-md" name="editarFin"  id="editarFin">

                        </div>                          

                    </div>

                    <div class="col-lg-12"></div>     
                    
                    <div class="form-group">

                        <!-- ENTRADA PARA TIPO MOTOR-->
                        <label for="" class="col-form-label col-lg-4 col-md-3 col-sm-3">DESCRIPCIÓN DE LA ACTIVIDAD</label>
                        <div class="col-lg-12">

                            <textarea type="textarea" rows="5" cols="136" id="editarObservacion" name="editarObservacion" placeholder="Detallar la actividad"></textarea>

                        </div>   

                    </div>  
                    
                </div>

            </div>

            <!--=====================================
            PIE DEL MODAL
            ======================================-->

            <div class="modal-footer">

                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

                <button type="submit" class="btn btn-primary">Registrar mantenimiento</button>

            </div>

            </form>

            <?php

            $crearMantenimiento = new ControladorMantenimiento();
            $crearMantenimiento -> ctrEditarCalendario();

            ?>    

        </div>

    </div>

</div>

<?php

$crearMantenimiento = new ControladorMantenimiento();
$crearMantenimiento -> ctrAnularCalendario();

?>    


<script>

window.document.title = "Calendario"

$(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function init_events(ele) {
        ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            }

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject)

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1070,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            })

        })
    }

    init_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
        },
        //Random default events
        events: [

            <?php
                foreach ($respuesta as $key => $value) {

                    if($value["tipo"] == "Mantenimiento" || $value["tipo"] == "Cumpleaños"){

                        echo "{
                            title: '".$value["titulo"]."',
                            start: new Date(".$value["yi"].", ".$value["moi"].", ".$value["di"]."),
                            backgroundColor: '".$value["backgroundColor"]."',
                            borderColor: '".$value["borderColor"]."'
                        },";

                    }else if($value["tipo"] == "Capacitacion" || $value["tipo"] == "Reunion" || $value["tipo"] == "Actividades"){

                        echo "{
                            title: '".$value["titulo"]."',
                            start: new Date(".$value["yi"].", ".$value["moi"].", ".$value["di"].", ".$value["hi"].", ".$value["mi"]."),
                            end: new Date(".$value["yf"].", ".$value["mof"].", ".$value["df"].", ".$value["hf"].", ".$value["mf"]."),
                            backgroundColor: '".$value["backgroundColor"]."',
                            borderColor: '".$value["borderColor"]."'
                        },";

                    }
                    

                }

                #var_dump($respuesta);

            ?>
            
        ],

    })

})
</script>

