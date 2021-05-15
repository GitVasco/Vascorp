$('.tablaProveedores').DataTable({
    "ajax": "ajax/maestros/tabla-proveedores.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
		"pageLength": 15,
		"lengthMenu": [[15, 30, 60, -1], [15, 30, 60, 'Todos']],
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
/*=============================================
EDITAR TIPO DE PAGO
=============================================*/
$(".tablaProveedores").on("click", ".btnEditarProveedor", function () {

    var CodRuc = $(this).attr("CodRuc");

    var datos = new FormData();
    datos.append("CodRuc", CodRuc);

    $.ajax({

        url: "ajax/proveedor.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            // console.log(respuesta);
            $("#editarTipoProv").val(respuesta["TipPro"]);
			$("#editarTipoProv").selectpicker("refresh");
            $("#editarRucPro").val(respuesta["RucPro"]);
            $("#editarCodigoPro").val(respuesta["CodRuc"]);
			$("#editarRazPro").val(respuesta["RazPro"]);
			$("#editarDireccion").val(respuesta["DirPro"]);
			$("#editarUbiPro").val(respuesta["UbiPro"]);
			$("#editarUbiPro").selectpicker("refresh");
			$("#editarTlf1").val(respuesta["TelPro1"]);
			$("#editarTlf2").val(respuesta["TelPro2"]);
			$("#editarTlf3").val(respuesta["TelPro3"]);
			$("#editarTlf4").val(respuesta["FaxPro"]);
			$("#editarContacto").val(respuesta["ConPro"]);
			$("#editarEmail1").val(respuesta["EmaPro"]);
			$("#editarEmail2").val(respuesta["EmaPro2"]);
			$("#editarWeb").val(respuesta["WebPro"]);
			$("#editarTipoEntr").val(respuesta["TieEnt"]);
			$("#editarFormaPago").val(respuesta["ForPag"]);
			$("#editarFormaPago").selectpicker("refresh");
			$("#editarDias").val(respuesta["Dia"]);
			$("#editarBanco").val(respuesta["Banco"]);
			$("#editarBanco").selectpicker("refresh");
			$("#editarMoneda").val(respuesta["Moneda"]);
			$("#editarMoneda").selectpicker("refresh");
			$("#editarNroCuenta").val(respuesta["NroCta"]);
			$("#editarBanco1").val(respuesta["Banco1"]);
			$("#editarBanco1").selectpicker("refresh");
			$("#editarMoneda1").val(respuesta["Moneda1"]);
			$("#editarMoneda1").selectpicker("refresh");
			$("#editarNroCuenta1").val(respuesta["NroCta1"]);
        }

    })

})


/*=============================================
ANULAR PROVEEDOR
=============================================*/
$(".tablaProveedores").on("click", ".btnEliminarProveedor", function(){

	var CodRuc = $(this).attr("CodRuc");
	
	swal({
        title: '¿Está seguro de anular al proveedor?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular proveedor!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=proveedor&CodRuc="+CodRuc;
        }

  })

})
//Reporte de Colores
// $(".box").on("click", ".btnReporteColor", function () {
//     window.location = "vistas/reportes_excel/rpt_color.php";
  
// })

$("#nuevoRucPro").keyup(function () {
	var RucPro = $(this).val();
	var datos = new FormData();
	datos.append("RucPro", RucPro);
	$.ajax({
		url: "ajax/proveedor.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			if (respuesta) {
				if ($(".msgError").length == 0) {
					$("#alertaRUC").parent().after('<div class="alert alert-danger alert-dismissable msgError" id="mensajeError">' +
						'<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>' +
						'<strong>Error!</strong> El RUC ya existe en la Base de Datos, por favor verifique.' +
						'</div>');
				}
				$("#nuevoRucPro").val("");
				$("#nuevoRucPro").focus();
			} else {
				$(".msgError").remove();
			}
		}
	});
});

$("#editarRucPro").change(function () {
	var RucPro = $(this).val();
	var datos = new FormData();
	datos.append("RucPro", RucPro);
	$.ajax({
		url: "ajax/proveedor.ajax.php",
		type: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function (respuesta) {
			if (respuesta) {
				if ($(".msgError").length == 0) {
					$("#alertaRUC2").parent().after('<div class="alert alert-danger alert-dismissable msgError" id="mensajeError">' +
						'<a href="#" class="close" data-dismiss="alert" aria-label="close">x</a>' +
						'<strong>Error!</strong> El RUC ya existe en la Base de Datos, por favor verifique.' +
						'</div>');
				}
				$("#editarRucPro").val("");
				$("#editarRucPro").focus();
			} else {
				$(".msgError").remove();
			}
		}
	});
});

//OBTENER DATOS POR RUC MEDIANTE LA API 
function ObtenerDatosRuc(){
	var nuevoRuc = $("#nuevoRucPro").val();
	var datos = new FormData();
	datos.append("nuevoRuc",nuevoRuc);
	$.ajax({
		type: "POST",
		url: 'ajax/proveedor.ajax.php',
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success:function( jsonx ) {
			// console.log(jsonx);
			if(jsonx["success"]==false){
				$('#nuevaRazPro').attr('readonly',false);
				$('#nuevaRazPro').val("");
				$('#nuevaDireccion').val("");
				$("#nuevoUbiPro").val("");
				$("#nuevoUbiPro").selectpicker("refresh");
				
			}else{
				$('#nuevaRazPro').val(jsonx["razonSocial"]);
				$('#nuevaDireccion').val(jsonx["direccion"]);
				$("#nuevoUbiPro").val(jsonx["ubigeo"]);
				$("#nuevoUbiPro").selectpicker("refresh");
			}
		  
		}
	})
}