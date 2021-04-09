/*
* cargamos la tabla para FACTURAS
*/
if (localStorage.getItem("capturarRango27") != null) {
	$("#daterange-btnFactura span").html(localStorage.getItem("capturarRango27"));
	cargarTablaSublimado(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnFactura span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaSublimado(null, null);
}

function cargarTablaSublimado(fechaInicial,fechaFinal) {
$('.tablaSublimados').DataTable({
    "ajax": "ajax/produccion/tabla-sublimados.ajax.php?perfil="+$("#perfilOculto").val()+"&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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
}
/*=============================================
EDITAR TIPO DE PAGO
=============================================*/
$(".tablaSublimados").on("click", ".btnEditarBanco", function () {

    var idBanco = $(this).attr("idBanco");

    var datos = new FormData();
    datos.append("idBanco", idBanco);

    $.ajax({

        url: "ajax/bancos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idBanco").val(respuesta["id"]);
            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["nombre"]);
        }

    })

})


/*=============================================
ELIMINAR TIPO DE PAGO
=============================================*/
$(".tablaSublimados").on("click", ".btnEliminarSublimado", function(){

	var idSublimado = $(this).attr("idSublimado");
	
	swal({
        title: '¿Está seguro de borrar el sublimado?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar sublimado!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=sublimados&idSublimado="+idSublimado;
        }

  })

})

  /*=============================================
RANGO DE FECHAS SUBLIMADOS
=============================================*/


$("#daterange-btnSublimado").daterangepicker(
    {
      cancelClass: "CancelarSublimado",
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
      $("#daterange-btnSublimado span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango27 = $("#daterange-btnSublimado span").html();
  
	  localStorage.setItem("capturarRango27", capturarRango27);
      localStorage.setItem("fechaInicial", fechaInicial);
	  localStorage.setItem("fechaFinal", fechaFinal);
	  
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaSublimados").DataTable().destroy();
      cargarTablaSublimado(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarSublimado").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango27");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "sublimados";
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
      localStorage.setItem("capturarRango27", "Hoy");
      localStorage.setItem("fechaInicial", fechaInicial);
	  localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaSublimados").DataTable().destroy();
      cargarTablaSublimado(fechaInicial, fechaFinal);
    }
  });

  $("#nuevoModeloSublimado").change(function(){

    var modelo = $(this).val();

    var datos = new FormData();
	datos.append("modelo3", modelo);
	
    $.ajax({

      url:"ajax/modelos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        $("#nuevoColorModelo").find('option').remove();
        $("#nuevoColorModelo").append('<option value="">Seleccionar color modelo</option>')
        for (let i = 0; i < respuesta.length; i++) {
          $("#nuevoColorModelo").append("<option value='"+respuesta[i]["cod_color"]+"'>"+respuesta[i]["cod_color"]+" - "+respuesta[i]["color"]+"</option>");
          
        }
        $('#nuevoColorModelo').selectpicker('refresh');
      }
    })
  
  })


  $("#nuevoColorModelo").change(function(){

    var color = $(this).val();
    var modelo = $("#nuevoModeloSublimado").val();
    var articulo = modelo+color;
    var datos = new FormData();
	  datos.append("articuloSublimado", articulo);
	
    $.ajax({

      url:"ajax/materiaprima.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        // console.log(respuesta);
        $("#nuevaMateriaSublimado").find('option').remove();
        $("#nuevaMateriaSublimado").append('<option value="">Seleccionar materia prima</option>')
        for (let i = 0; i < respuesta.length; i++) {
          $("#nuevaMateriaSublimado").append("<option value='"+respuesta[i]["mat_pri"]+"'>"+respuesta[i]["mat_pri"]+" - "+respuesta[i]["descripcion"]+"</option>");
          
        }
        $('#nuevaMateriaSublimado').selectpicker('refresh');
      }
    })
  
  })
