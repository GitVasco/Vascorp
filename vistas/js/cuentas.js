$('.tablaCuentas').DataTable({
    "ajax": "ajax/tabla-cuentas.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
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
          $("#cancelarNota").val(respuesta["notas"]);
          $("#cancelarVendedor").val(respuesta["vendedor"]);
          $("#cancelarVendedor").selectpicker('refresh');
          $("#cancelarFechaUltima").val(respuesta["ult_pago"]);
          $("#cancelarSaldo").val(respuesta["saldo"]);
      }

  })

})
$("#cancelarMonto").change(function(){
  var saldo = $(this).val();
  var saldoAntiguo = $("#cancelarSaldo").val();
  if(saldo>saldoAntiguo){
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