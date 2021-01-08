$("#tipoCuenta").change(function(){
  var tipo = $(this).val();
  if(tipo=='PENDIENTE'){
    window.location="cuentas-pendientes";
  }else if(tipo=='CANCELADO'){
    window.location="cuentas-aprobadas";
  }else{
    window.location="cuentas";
  }
 });

 // Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturaRango10") != null) {
	$("#daterange-btnCuentas span").html(localStorage.getItem("capturaRango10"));
	cargarTablaCuentas(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnCuentas span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaCuentas(null, null);
}

 //CUENTAS 
function cargarTablaCuentas(fechaInicial, fechaFinal){
  $('.tablaCuentas').DataTable({
    "ajax": "ajax/tabla-cuentas.ajax.php?perfil="+$("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
    "pageLength": 20,
	  "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }    
  });
}
// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturaRango11") != null) {
	$("#daterange-btnCuentasPendientes span").html(localStorage.getItem("capturaRango11"));
	cargarTablaCuentasPendientes(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnCuentasPendientes span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaCuentasPendientes(null, null);
}

 //CUENTAS PENDIENTES
function cargarTablaCuentasPendientes(fechaInicial, fechaFinal){
  $('.tablaCuentasPendientes').DataTable({
    "ajax": "ajax/tabla-cuentas-pendientes.ajax.php?perfil="+$("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
    "pageLength": 20,
	  "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }    
  });
}

// Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("capturaRango12") != null) {
	$("#daterange-btnCuentasAprobadas span").html(localStorage.getItem("capturaRango12"));
	cargarTablaCuentasAprobadas(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnCuentasAprobadas span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaCuentasAprobadas(null, null);
}

 //CUENTAS 
function cargarTablaCuentasAprobadas(fechaInicial, fechaFinal){
  $('.tablaCuentasAprobadas').DataTable({
    "ajax": "ajax/tabla-cuentas-aprobadas.ajax.php?perfil="+$("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
    "pageLength": 20,
	  "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    "language": {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
      "sFirst":    "Primero",
      "sLast":     "Último",
      "sNext":     "Siguiente",
      "sPrevious": "Anterior"
      },
      "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
    }    
  });
}

  $("#nuevoMonto").change(function(){
    var saldo = $(this).val();
    $("#nuevoSaldo").val(saldo);
    estadoSaldo2();
  });
  function estadoSaldo2(){
    var saldo = $("#nuevoSaldo").val();
    if(saldo== "0"){
      $("#nuevoEstado1").val("CANCELADO");
      $("#nuevoEstado1").css("background-color", "green");
      $("#nuevoEstado1").css("color", "white");
    }else{
      $("#nuevoEstado1").val("PENDIENTE");
      $("#nuevoEstado1").css("background-color", "red");
      $("#nuevoEstado1").css("color", "white");
    }
  }
/*=============================================
EDITAR TIPO DE PAGO
=============================================*/
$(".tablaCuentas").on("click", ".btnEditarCuenta", function () {

    var idCuenta = $(this).attr("idCuenta");

    var datos = new FormData();
    datos.append("idCuenta", idCuenta);

    $.ajax({

        url: "ajax/cuentas.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idCuenta").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["tipo_doc"]);
            $("#editarCodigo").selectpicker('refresh');
            $("#editarDocumento").val(respuesta["num_cta"]);
            $("#editarNota").val(respuesta["notas"]);
            $("#editarCliente").val(respuesta["cliente"]);
            $("#editarCliente").selectpicker('refresh');
            $("#editarVendedor").val(respuesta["vendedor"]);
            $("#editarVendedor").selectpicker('refresh');
            if(respuesta["renovacion"] == 1){
              $("#editarRenovacion").prop('checked',true);
            }
            if(respuesta["protesta"] == 1){
              $("#editarProtestado").prop('checked',true);
            }
            $("#editarBanco").val(respuesta["banco"]);
            $("#editarBanco").selectpicker('refresh');
            $("#editarTipoDocumento").val(respuesta["cod_pago"]);
            $("#editarTipoDocumento").selectpicker('refresh');
            $("#editarFecha").val(respuesta["fecha"]);
            $("#editarFechaVenc").val(respuesta["fecha_ven"]);
            $("#editarUnico").val(respuesta["num_unico"]);
            $("#editarOrigen").val(respuesta["doc_origen"]);
            $("#editarFechaAcep").val(respuesta["fecha_cep"]);
            $("#editarFechaEnvio").val(respuesta["fecha_envio"]);
            $("#editarSaldo").val(respuesta["saldo"]);
            $("#editarFechaUltima").val(respuesta["ult_pago"]);
            $("#editarMoneda").val(respuesta["tip_mon"]);
            $("#editarMoneda").selectpicker('refresh');
            $("#editarFechaAbono").val(respuesta["fecha_abono"]);
            $("#editarEstado1").val(respuesta["estado"]);
            $("#editarMonto").val(respuesta["monto"]);
            $("#editarTipoCambio").val(respuesta["tip_cambio"]);
            $("#editarEstado").val(respuesta["estado_doc"]);
            $("#editarEstado").selectpicker('refresh');
        }

    })

})

$(".tablaCuentas").on("click", ".btnCancelarCuenta", function () {

  var idCuenta = $(this).attr("idCuenta");

  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

          $("#idCuenta2").val(respuesta["id"]);
          $("#cancelarDocumento").val(respuesta["num_cta"]);
          $("#cancelarVendedor").val(respuesta["vendedor"]);
          $("#cancelarCliente").val(respuesta["cliente"]);
          $("#cancelarSaldo").val(respuesta["saldo"]);
      }

  })

})
$("#cancelarMonto").change(function(){
  var saldo = $(this).val();
  var saldoAntiguo = $("#cancelarSaldo").val();
  if(Number(saldo)>Number(saldoAntiguo)){
    swal({
      title: "La cantidad supera el Saldo de la cuenta ",
      text: "¡Sólo hay S/. " + saldoAntiguo + " de saldo!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });

    return;
  }
});

$("#editarMonto").change(function(){
  var saldo = $(this).val();
  $("#editarSaldo").val(saldo);
  estadoSaldo();
});
function estadoSaldo(){
  var saldo = $("#editarSaldo").val();
  if(saldo== "0"){
    $("#editarEstado1").val("CANCELADO");
  }else{
    $("#editarEstado1").val("PENDIENTE");
  }
}



/*=============================================
ELIMINAR TIPO DE PAGO
=============================================*/
$(".tablaCuentas").on("click", ".btnEliminarCuenta", function(){

	var idCuenta = $(this).attr("idCuenta");
	
	swal({
        title: '¿Está seguro de borrar la cuenta?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cuenta!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=cuentas&idCuenta="+idCuenta;
        }

  })

})
//Reporte de Colores
// $(".box").on("click", ".btnReporteColor", function () {
//     window.location = "vistas/reportes_excel/rpt_color.php";
  
// })
$(".tablaCuentas").on("click", ".btnVisualizarCuenta", function () {
  var numCuenta = $(this).attr("numCta");
  window.location = "index.php?ruta=ver-cuentas&numCta=" + numCuenta ;

})


/*=============================================
ELIMINAR TIPO DE PAGO
=============================================*/
$(".tablas").on("click", ".btnEliminarCancelacion", function(){

	var idCancelacion = $(this).attr("idCancelacion");
	
	swal({
        title: '¿Está seguro de borrar la cancelación?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar cancelación!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ver-cuentas&idCancelacion="+idCancelacion;
        }

  })

})

$(".tablas").on("click", ".btnEditarCancelacion", function () {

  var idCancelacion = $(this).attr("idCancelacion");
  var datos = new FormData();
  datos.append("idCancelacion", idCancelacion);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          console.log(respuesta);
          $("#idCuenta2").val(respuesta["id"]);
          $("#cancelarDocumento").val(respuesta["num_cta"]);
          $("#cancelarNota").val(respuesta["notas"]);
          $("#cancelarCodigo").val(respuesta["tipo_doc"]);
          $("#cancelarCodigo").selectpicker('refresh');
          $("#cancelarVendedor").val(respuesta["vendedor"]);
          $("#cancelarCliente").val(respuesta["cliente"]);
          $("#cancelarFechaUltima").val(respuesta["fecha"]);
          $("#cancelarMonto2").val(respuesta["monto"]);
          $("#cancelarMontoAntiguo").val(respuesta["monto"]);
      }

  })

})
$("#cancelarMonto2").change(function(){
  var saldo = $(this).val();
  var saldoAntiguo = $("#cancelarMontoAntiguo").val();
  if(Number(saldo)>Number(saldoAntiguo)){
    swal({
      title: "La cantidad supera el Saldo de la cuenta ",
      text: "¡Sólo hay S/. " + saldoAntiguo + " de saldo!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });

    return;
  }
});


$(".tablaCuentas").on("click", ".btnAgregarLetra", function () {

  var idCuenta = $(this).attr("idCuenta");
  var cliente = $(this).attr("cliente");
  var datos = new FormData();
  datos.append("idCuenta", idCuenta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          $("#idCuenta3").val(respuesta["id"]);
          $("#letraCodigo").val(respuesta["tipo_doc"]);
          $("#letraDocumento").val(respuesta["num_cta"]);
          $("#letraUsuario").val(respuesta["usuario"]);
          $("#letraVendedor").val(respuesta["vendedor"]);
          $("#letraCli").val(respuesta["cliente"]);
          $("#letraFecha").val(respuesta["fecha"]);
          $("#letraMonto").val(respuesta["monto"]);
          $("#letraSaldo").val(respuesta["saldo"]);
          $("#letraMoneda").val(respuesta["tip_mon"]);
          $("#letraCliente").val(cliente);
          $(".letraCuenta").remove();
      }

  })

})

$(".btnGenerarLetra").click(function(){
  $(this).attr("disabled", true);
  $(this).removeClass("btn-primary");
  $(this).addClass("btn-default");
  var nroLetra = $("#nroLetra").val();  
  var saldo=$("#letraSaldo").val();
  var montoLetra=Number(saldo)/Number(nroLetra);
  var fecha= new Date($("#letraFecha").val());
  var sumaDias = Number($("#sumaFecha").val())+1;
  var intervalo=Number($("#sumaIntervalo").val());
  fecha.setDate(fecha.getDate() + sumaDias);
  var mes=(fecha.getMonth() + 1);
  var dia =fecha.getDate();
  if(mes.toString().length == 1){
    if(dia.toString().length == 1){
      var resultado= fecha.getFullYear() + '-0' +
      (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
    }else{
      var resultado= fecha.getFullYear() + '-0' +
      (fecha.getMonth() + 1) + '-' + fecha.getDate();
    }
  }else{
    if(dia.toString().length == 1){
      var resultado= fecha.getFullYear() + '-' +
      (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
    }else{
      var resultado= fecha.getFullYear() + '-' +
      (fecha.getMonth() + 1) + '-' + fecha.getDate();
    }
  }
  
  
  for (let index = 0; index < nroLetra; index++) {
    
    if(index==0){
      $(".listaLetras").append(
        '<div class="letraCuenta col-lg-12" style="padding:0px">'+
          '<div class="col-lg-3" style="padding-top:10px">' +
              '<input type="date" class="form-control "   name="fechaVenc[]" value="'+ resultado +'"  required>' +
          '</div>'+
          '<div class="col-lg-6" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="obs'+index+'" value="Letra '+(index+1)+'"  >' +
          '</div>'+
          '<div class="col-lg-2" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="monto'+index+'" value="' + montoLetra.toFixed(2) + '" readonly required>' +
          '</div>'+
          '<div class="col-lg-12"></div><br>'+
        '</div>' );
    }
    else{
    fecha.setDate(fecha.getDate() + intervalo);
    var mes2=(fecha.getMonth() + 1);
    var dia2 =fecha.getDate();
    if(mes2.toString().length == 1){
      if(dia2.toString().length == 1){
        var resultado2= fecha.getFullYear() + '-0' +
        (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
      }else{
        var resultado2= fecha.getFullYear() + '-0' +
        (fecha.getMonth() + 1) + '-' + fecha.getDate();
      }
    }else{
      if(dia2.toString().length == 1){
        var resultado2= fecha.getFullYear() + '-' +
        (fecha.getMonth() + 1) + '-' + "0"+fecha.getDate();
      }else{
        var resultado2= fecha.getFullYear() + '-' +
        (fecha.getMonth() + 1) + '-' + fecha.getDate();
      }
    }
      $(".listaLetras").append(
        '<div class="letraCuenta col-lg-12" style="padding:0px">'+
          '<div class="col-lg-3" style="padding-top:10px">' +
              '<input type="date" class="form-control "   name="fechaVenc[]" value="'+resultado2+'"  required>' +
          '</div>'+
          '<div class="col-lg-6" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="obs'+index+'"  value="Letra '+(index+1)+'"  >' +
          '</div>'+
          '<div class="col-lg-2" style="padding-top:10px">' +
              '<input type="text" class="form-control "   name="monto'+index+'" value="' + montoLetra.toFixed(2) + '" readonly required>' +
          '</div>'+
          '<div class="col-lg-12"></div><br>'+
        '</div>' );
    }
    
  }
   
});
$(".btnLimpiarLetra").click(function(){
  $(".btnGenerarLetra").removeAttr('disabled');
  $(".btnGenerarLetra").removeClass("btn-default");
  $(".btnGenerarLetra").addClass("btn-primary");
  $(".letraCuenta").remove();
});


$("#daterange-btnCuentas").daterangepicker(
  {
  cancelClass: "CancelarFechaCuenta",
  locale:{
  "daysOfWeek": [
    "Dom",
    "Lun",
    "Mar",
    "Mie",
    "Jue",
    "Vie",
    "Sab"
  ],
  "monthNames": [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ],
  },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Último mes": [
        moment()
          .subtract(1, "month")
          .startOf("month"),
        moment()
          .subtract(1, "month")
          .endOf("month")
      ]
    },
    
    startDate: moment(),
    endDate: moment()
  },
  function(start, end) {
    $("#daterange-btnCuentas span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango10 = $("#daterange-btnCuentas span").html();

    localStorage.setItem("capturarRango10", capturarRango10);
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaCuentas").DataTable().destroy();
    cargarTablaCuentas(fechaInicial, fechaFinal);
  });

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .CancelarFechaCuenta").on(
  "click",
  function() {
    localStorage.removeItem("capturarRango10");
    localStorage.removeItem("fechaInicial");
    localStorage.removeItem("fechaFinal");
    localStorage.clear();
    window.location = "cuentas";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function() {
  var textoHoy = $(this).attr("data-range-key");

  if (textoHoy == "Hoy") {
    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var año = d.getFullYear();

    dia = ("0" + dia).slice(-2);
    mes = ("0" + mes).slice(-2);

    var fechaInicial = año + "-" + mes + "-" + dia;
    var fechaFinal = año + "-" + mes + "-" + dia;

    localStorage.setItem("capturarRango10", "Hoy");
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaCuentas").DataTable().destroy();
    cargarTablaCuentas(fechaInicial, fechaFinal);
  }
});

$("#daterange-btnCuentasPendientes").daterangepicker(
  {
  cancelClass: "CancelarFechaCuentaPendiente",
  locale:{
  "daysOfWeek": [
    "Dom",
    "Lun",
    "Mar",
    "Mie",
    "Jue",
    "Vie",
    "Sab"
  ],
  "monthNames": [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ],
  },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Último mes": [
        moment()
          .subtract(1, "month")
          .startOf("month"),
        moment()
          .subtract(1, "month")
          .endOf("month")
      ]
    },
    
    startDate: moment(),
    endDate: moment()
  },
  function(start, end) {
    $("#daterange-btnCuentasPendientes span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango11 = $("#daterange-btnCuentasPendientes span").html();

    localStorage.setItem("capturarRango11", capturarRango11);
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaCuentasPendientes").DataTable().destroy();
    cargarTablaCuentasPendientes(fechaInicial, fechaFinal);
  });

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .CancelarFechaCuentaPendiente").on(
  "click",
  function() {
    localStorage.removeItem("capturarRango11");
    localStorage.removeItem("fechaInicial");
    localStorage.removeItem("fechaFinal");
    localStorage.clear();
    window.location = "cuentas-pendientes";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function() {
  var textoHoy = $(this).attr("data-range-key");

  if (textoHoy == "Hoy") {
    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var año = d.getFullYear();

    dia = ("0" + dia).slice(-2);
    mes = ("0" + mes).slice(-2);

    var fechaInicial = año + "-" + mes + "-" + dia;
    var fechaFinal = año + "-" + mes + "-" + dia;

    localStorage.setItem("capturarRango11", "Hoy");
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaCuentasPendientes").DataTable().destroy();
    cargarTablaCuentasPendientes(fechaInicial, fechaFinal);
  }
});


$("#daterange-btnCuentasAprobadas").daterangepicker(
  {
  cancelClass: "CancelarFechaCuentaAprobada",
  locale:{
  "daysOfWeek": [
    "Dom",
    "Lun",
    "Mar",
    "Mie",
    "Jue",
    "Vie",
    "Sab"
  ],
  "monthNames": [
    "Enero",
    "Febrero",
    "Marzo",
    "Abril",
    "Mayo",
    "Junio",
    "Julio",
    "Agosto",
    "Septiembre",
    "Octubre",
    "Noviembre",
    "Diciembre"
  ],
  },
    ranges: {
      Hoy: [moment(), moment()],
      Ayer: [moment().subtract(1, "days"), moment().subtract(1, "days")],
      "Últimos 7 días": [moment().subtract(6, "days"), moment()],
      "Últimos 30 días": [moment().subtract(29, "days"), moment()],
      "Este mes": [moment().startOf("month"), moment().endOf("month")],
      "Último mes": [
        moment()
          .subtract(1, "month")
          .startOf("month"),
        moment()
          .subtract(1, "month")
          .endOf("month")
      ]
    },
    
    startDate: moment(),
    endDate: moment()
  },
  function(start, end) {
    $("#daterange-btnCuentasAprobadas span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango12 = $("#daterange-btnCuentasAprobadas span").html();

    localStorage.setItem("capturarRango12", capturarRango12);
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaCuentasAprobadas").DataTable().destroy();
    cargarTablaCuentasAprobadas(fechaInicial, fechaFinal);
  });

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .CancelarFechaCuentaAprobada").on(
  "click",
  function() {
    localStorage.removeItem("capturarRango12");
    localStorage.removeItem("fechaInicial");
    localStorage.removeItem("fechaFinal");
    localStorage.clear();
    window.location = "cuentas-aprobadas";
  }
);

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function() {
  var textoHoy = $(this).attr("data-range-key");

  if (textoHoy == "Hoy") {
    var d = new Date();

    var dia = d.getDate();
    var mes = d.getMonth() + 1;
    var año = d.getFullYear();

    dia = ("0" + dia).slice(-2);
    mes = ("0" + mes).slice(-2);

    var fechaInicial = año + "-" + mes + "-" + dia;
    var fechaFinal = año + "-" + mes + "-" + dia;

    localStorage.setItem("capturarRango12", "Hoy");
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);
    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaCuentasAprobadas").DataTable().destroy();
    cargarTablaCuentasAprobadas(fechaInicial, fechaFinal);
  }
});
$(".btnCancelarCuenta2").click(function(){
  var numCta = $(this).attr("numCta");
  var datos = new FormData();
  datos.append("numCta", numCta);

  $.ajax({

      url: "ajax/cuentas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
          $("#idCuenta3").val(respuesta["id"]);
          $("#cancelarDocumento2").val(respuesta["num_cta"]);
          $("#cancelarVendedor2").val(respuesta["vendedor"]);
          $("#cancelarCliente2").val(respuesta["cliente"]);
          $("#cancelarSaldo2").val(respuesta["saldo"]);
      }

  })
});
$("#cancelarMonto3").change(function(){
  var saldo = $(this).val();
  var saldoAntiguo = $("#cancelarSaldo2").val();
  if(Number(saldo)>Number(saldoAntiguo)){
    swal({
      title: "La cantidad supera el Saldo de la cuenta ",
      text: "¡Sólo hay S/. " + saldoAntiguo + " de saldo!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });

    return;
  }
});
$("#tipoCliente").change(function(){
  var cliente = $(this).val();
  $(".tablaCuentasConsultar").DataTable().destroy();
  localStorage.setItem("cliente",cliente);
  cargarTablaCuentasConsultar(cliente);
 });

  // Validamos que venga la variable capturaRango en el localStorage
if (localStorage.getItem("cliente") != null) {
	cargarTablaCuentasConsultar(localStorage.getItem("cliente"));
} else {
	cargarTablaCuentasConsultar(null);
}

//CUENTAS consultar
function cargarTablaCuentasConsultar(cliente){
$('.tablaCuentasConsultar').DataTable({
  "ajax": "ajax/tabla-cuentas-consultar.ajax.php?perfil="+$("#perfilOculto").val()+"&cliente=" + cliente ,
  "deferRender": true,
  "retrieve": true,
  "processing": true,
  "order": [[0, "asc"]],
  "pageLength": 20,
  "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
  "language": {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
    },
    "oAria": {
      "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
      "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
  }    
});
}
