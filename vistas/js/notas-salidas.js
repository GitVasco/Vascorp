/*=============================================
CARGAR LA TABLA DINÁMICA DE NOTAS DE SALIDAS
=============================================*/

if (localStorage.getItem("capturarRango28") != null) {
	$("#daterange-btnNotasSalidas span").html(localStorage.getItem("capturarRango28"));
	cargarTablaNotasSalidas(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnNotasSalidas span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaNotasSalidas(null, null);
}


/* 
* TABLA PARA PRODUCCION Brasier
*/
function cargarTablaNotasSalidas(fechaInicial,fechaFinal) {

 $(".tablaNotasSalidas").DataTable({
    ajax: "ajax/materiaprima/tabla-notas-salidas.ajax.php?perfil="+$("#perfilOculto").val() + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[2, "desc"]],
    "pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior"
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
        sSortDescending: ": Activar para ordenar la columna de manera descendente"
      }
    }
  });
}


/*=============================================
RANGO DE FECHAS PARA NOTAS SALIDAS
=============================================*/

$("#daterange-btnNotasSalidas").daterangepicker(
    {
      cancelClass: "CancelarNotasSalidas",
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
      $("#daterange-btnNotasSalidas span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango28 = $("#daterange-btnNotasSalidas span").html();
    
      localStorage.setItem("capturarRango28", capturarRango28);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
  
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaNotasSalidas").DataTable().destroy();
      cargarTablaNotasSalidas(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarNotasSalidas").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango28");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "notas-salidas";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
    if(ruta == "notas-salidas"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango28", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaNotasSalidas").DataTable().destroy();
        cargarTablaNotasSalidas(fechaInicial, fechaFinal);
      }
    }
  
  });

  //CARGAR RUC CON SELECT AL INPUT
  $(".formularioNotaSalida").on("change","#nuevoClienteNota",function(){
    var rucCliente = $(this).val();
    $("#nuevoRuc").val(rucCliente);
  })

  // TABLA MATERIA NOTAS SALIDAS

  $(".tablaMateriaNotaSalida").DataTable({
    ajax: "ajax/materiaprima/tabla-materias-notas-salidas.ajax.php?perfil="+$("#perfilOculto").val(),
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[0, "asc"]],
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "Ningún dato disponible en esta tabla",
      sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior"
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
        sSortDescending: ": Activar para ordenar la columna de manera descendente"
      }
    }
  });


  
/*=============================================
AGREGANDO PRODUCTOS A LA VENTA DESDE LA TABLA
=============================================*/

$(".tablaMateriaNotaSalida tbody").on("click", "button.agregarMateriaNota", function() {

  var idMateriaNota = $(this).attr("idMateriaNota");

  /* console.log("idProducto", idProducto); */

  $(this).removeClass("btn-primary agregarMateriaNota");

  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("idMateriaPrima2", idMateriaNota);

  $.ajax({
    url: "ajax/materiaprima.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      // console.log(respuesta);
      var codpro = respuesta["codpro"];
      var codfab = respuesta["codfab"];
      var color = respuesta["color"];
      var codcolor = respuesta["ColPro"];
      var precio = respuesta["precio"];
      var descripcion = respuesta["descripcion"];
      var stock = respuesta["stock"];

      /*=============================================
      EVITAR AGREGAR PRODUTO CUANDO EL STOCK ESTÁ EN CERO
      =============================================*/

      if (stock == 0) {
        swal({
          title: "No hay stock disponible",
          type: "error",
          confirmButtonText: "¡Cerrar!"
        });

        $("button[idMateriaNota='" + idMateriaNota + "']").addClass(
          "btn-primary agregarMateriaNota"
        );

        return;
      }
      var datos2 = new FormData();
      datos2.append("idMateriaNota", idMateriaNota);

      $.ajax({
        url: "ajax/notas-salidas.ajax.php",
        method: "POST",
        data: datos2,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta2) {
          $("#nuevoDestinoNota"+codpro).find('option').remove();
                
            $("#nuevoDestinoNota"+codpro).append("<option value=''>SELECCIONAR DESTINO</option>");
            for (let i = 0; i < respuesta2.length; i++) {
              
              $("#nuevoDestinoNota"+codpro).append("<option value='"+respuesta2[i]["Cod_Argumento"]+"'>"+respuesta2[i]["Cod_Argumento"]+" - "+respuesta2[i]["Des_Larga"]+"</option>");
              
            }
        }

      });

      $(".nuevaMateriaNota").append(

        '<div class="row" style="padding:1px 15px">' +

          "<!-- Descripción del producto -->" +

          '<div class="col-xs-1" style="padding-right:0px">' +

              '<input type="text" class="form-control input-sm nuevoCodigoPro" idMateriaNota="' + codpro + '" name="agregarProducto" value="' + codpro + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoCodigoFabrica"  name="nuevoCodigoFabrica" value="' + codfab + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-4" >' +

              '<input type="text" class="form-control input-sm nuevaDescripcionMateria"  name="nuevaDescripcionMateria" value="' + descripcion + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoCodigoColor"  name="nuevoCodigoColor" value="' + codcolor + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoColor"  name="nuevoColor" value="' + color + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoCosto"  name="nuevoCosto" value="' + precio + '"  readonly required>' +

          "</div>" +

          '<div class="col-xs-2" >' +

              '<select class="form-control input-sm nuevoDestinoNota" name="nuevoDestinoNota" id="nuevoDestinoNota'+codpro+'" required>' +
              '<option value="">Seleccionar destino</option>' +

              '</select>'+

          "</div>" +

          "<!-- Cantidad del producto -->" +

          '<div class="col-xs-1">' +

            '<div class="input-group">' +

            '<input type="number" step="any" class="form-control input-sm nuevaCantidadMateria" name="nuevaCantidadMateria" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required>' +
            
            '<span class="input-group-addon"  style="padding: 3px 6px"><button type="button" class="btn btn-danger btn-xs quitarMateriaNota" idMateriaNota="' + idMateriaNota + '"><i class="fa fa-times"></i></button></span>' +

            "</div>" +

          "</div>" +


        "</div>"


      );


      // AGRUPAR MATERIAS EN FORMATO JSON

      listarMateriaNotas();
     
      


    }
  });
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaMateriaNotaSalida").on("draw.dt", function() {
  /* console.log("tabla"); */

  if (localStorage.getItem("quitarMateriaNota") != null) {
    var listaIdMateriaNota = JSON.parse(localStorage.getItem("quitarMateriaNota"));

    for (var i = 0; i < listaIdMateriaNota.length; i++) {
      $(
        "button.recuperarBoton[idMateriaNota='" +
        listaIdMateriaNota[i]["idMateriaNota"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idMateriaNota='" +
        listaIdMateriaNota[i]["idMateriaNota"] +
          "']"
      ).addClass("btn-primary agregarMateriaNota");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarMateriaNota = [];

localStorage.removeItem("quitarMateriaNota");

$(".formularioNotaSalida").on("click", "button.quitarMateriaNota", function() {
  /* console.log("boton"); */

  $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .remove();

  var idMateriaNota = $(this).attr("idMateriaNota");

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarMateriaNota") == null) {
    idQuitarMateriaNota = [];
  } else {
    idQuitarMateriaNota.concat(localStorage.getItem("quitarMateriaNota"));
  }

  idQuitarMateriaNota.push({
    idMateriaNota: idMateriaNota
  });

  localStorage.setItem("quitarMateriaNota", JSON.stringify(idQuitarMateriaNota));

  $("button.recuperarBoton[idMateriaNota='" + idMateriaNota + "']").removeClass(
    "btn-default"
  );

  $("button.recuperarBoton[idMateriaNota='" + idMateriaNota + "']").addClass(
    "btn-primary agregarMateriaNota"
  );

   
    // AGRUPAR MATERIAS EN FORMATO JSON

    listarMateriaNotas();
  
});


/*=============================================
MODIFICAR LA CANTIDAD
=============================================*/

$(".formularioNotaSalida").on("keyup", "input.nuevaCantidadMateria", function() {
  

  var nuevoStock = Number($(this).attr("stock")) - $(this).val();

  $(this).attr("nuevoStock", nuevoStock);

  if (Number($(this).val()) > Number($(this).attr("stock"))) {
    /*=============================================
    SI LA CANTIDAD ES SUPERIOR AL STOCK REGRESAR VALORES INICIALES
    =============================================*/

    $(this).val(1);

    

    swal({
      title: "La cantidad supera el Stock",
      text: "¡Sólo hay " + $(this).attr("stock") + " unidades!",
      type: "error",
      confirmButtonText: "¡Cerrar!"
    });

    return;
  }

  

  // AGRUPAR MATERIAS EN FORMATO JSON

  listarMateriaNotas();
});

/*=============================================
MODIFICAR DESTINO
=============================================*/
$(".formularioNotaSalida").on("change", "select.nuevoDestinoNota", function() {
  listarMateriaNotas();
});



/*=============================================
LISTAR TODOS LOS PRODUCTOS
=============================================*/

function listarMateriaNotas() {
  var listarMateriaNotas = [];

  var descripcion = $(".nuevaDescripcionMateria");

  var cantidad = $(".nuevaCantidadMateria");

  var codpro = $(".nuevoCodigoPro");

  var codfab = $(".nuevoCodigoFab");
  
  var destino = $(".nuevoDestinoNota");

  var codcolor = $(".nuevoCodigoColor");

  var color = $(".nuevoColor");

  var precio = $(".nuevoCosto");

  for (var i = 0; i < descripcion.length; i++) {
    listarMateriaNotas.push({
      id:  $(codpro[i]).val(),
      codfab:  $(codfab[i]).val(),
      descripcion: $(descripcion[i]).val(),
      cantidad: $(cantidad[i]).val(),
      destino: $(destino[i]).val(),
      codcolor: $(codcolor[i]).val(),
      color: $(color[i]).val(),
      stock : $(cantidad[i]).attr("nuevoStock"),
      precio: $(precio[i]).val()
    });
  }

  // console.log("listarMateriaNotas", JSON.stringify(listarMateriaNotas)); 

  $("#listarMateriaNotas").val(JSON.stringify(listarMateriaNotas));
}


/*=============================================
FUNCIÓN PARA DESACTIVAR LOS BOTONES AGREGAR CUANDO EL PRODUCTO YA HABÍA SIDO SELECCIONADO EN LA CARPETA
=============================================*/

function quitarAgregarMateriaNota() {
  //Capturamos todos los id de productos que fueron elegidos en la venta
  var idMateriaNotas = $(".quitarMateriaNota");
  //console.log("idProductos", idProductos);

  //Capturamos todos los botones de agregar que aparecen en la tabla
  var botonesTabla = $(".tablaMateriaNotaSalida tbody button.agregarMateriaNota");


  //Recorremos en un ciclo para obtener los diferentes idProductos que fueron agregados a la venta
  for (var i = 0; i < idMateriaNotas.length; i++) {
    //Capturamos los Id de los productos agregados a la venta
    var boton = $(idMateriaNotas[i]).attr("idMateriaNota");

    //Hacemos un recorrido por la tabla que aparece para desactivar los botones de agregar
    for (var j = 0; j < botonesTabla.length; j++) {
      if ($(botonesTabla[j]).attr("idMateriaNota") == boton) {
        $(botonesTabla[j]).removeClass("btn-primary agregarMateriaNota");
        $(botonesTabla[j]).addClass("btn-default");
      }
    }
  }
}

/*=============================================
CADA VEZ QUE CARGUE LA TABLA CUANDO NAVEGAMOS EN ELLA EJECUTAR LA FUNCIÓN:
=============================================*/

$(".tablaMateriaNotaSalida").on("draw.dt", function() {
  quitarAgregarMateriaNota();
});


/*=============================================
OBTENER TEXTO DE MOTIVO
=============================================*/
$(".formularioNotaSalida").on("change", "select#nuevoMotivoNota", function() {
  var texto = $(this).find('option:selected').text();
  $("#desMotivo").val(texto);
});

/*=============================================
OBTENER CODIGO DE CLIENTE
=============================================*/
$(".formularioNotaSalida").on("change", "select#nuevoClienteNota", function() {
  var texto = $(this).find('option:selected').text();
  var codigo = texto.substr(0,6);
  $("#codigoCli").val(codigo);
});

/* 
* VISUALIZAR DETALLE DEL CORTE
*/ 
$(".tablaNotasSalidas").on("click", ".btnVisualizarNotaSalida", function () {

	var idNotaSalida = $(this).attr("idNotaSalida");
  //console.log(idNotaSalida);
    
  var datos = new FormData();
	datos.append("idNotaSalida", idNotaSalida);

	$.ajax({

		url:"ajax/notas-salidas.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
      // console.log(respuesta);
      var fecha = respuesta["FecReg"];
      var fechaNueva = fecha.substr(0,10);
      $("#codigo").val(idNotaSalida);
      $("#fecha").val(fechaNueva);
      $("#almacen").val(respuesta["AlmDes"]);
      $("#ruc").val(respuesta["Ruc"]);
      $("#cliente").val(respuesta["Ruc"]);
      $("#motivo").val(respuesta["DocSal"]);
      $("#observacion").val(respuesta["observacion"]);

		  }

    })
    
    var idNotaSalidaDetalle = $(this).attr("idNotaSalida");	
    //console.log("codigoDAC", codigoDAC);

    var datosDOC = new FormData();
    datosDOC.append("idNotaSalidaDetalle", idNotaSalidaDetalle);
    
    $.ajax({

		url:"ajax/notas-salidas.ajax.php",
		method: "POST",
		data: datosDOC,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDetalle){

			// console.log(respuestaDetalle);

      $(".detalleNS").remove();
       
			for(var id of respuestaDetalle){
            
				$('.tablaDetalleNotaSalida').append(

					'<tr class="detalleNS">' +
            '<td class="text-center">' + id.Item + ' </td>' +
            '<td class="text-center">' + id.CodPro + ' </td>' +
            '<td class="text-center">' + id.CodFab + ' </td>' +
						'<td >' + id.DesPro + ' </td>' +
            '<td class="text-center">' + id.Des_Larga + ' </td>' +
            '<td class="text-center">' + id.pcosto + ' </td>' +
            '<td class="text-center">' + id.CenCosto + ' </td>' +
            '<td class="text-center">' + id.CanVta + '</td>' +
					'</tr>'

				)

			}            

		}

	})
  
});


/*=============================================
ANULAR PROVEEDOR
=============================================*/
$(".tablaNotasSalidas").on("click", ".btnAnularNotaSalida", function(){

	var idNotaSalida = $(this).attr("idNotaSalida");
	
	swal({
        title: '¿Está seguro de anular la nota de salida?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular nota de salida!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=notas-salidas&idNotaSalida="+idNotaSalida;
        }

  })

})

/* 
* BOTON REPORTE DE ORDEN DE CORTE
*/
$(".tablaNotasSalidas").on("click", ".btnDetalleReporteNotaSalida", function () {

  var idNotaSalida = $(this).attr("idNotaSalida");
  //console.log("codigo", codigo);

  window.location = "vistas/reportes_excel/rpt_notasalida.php?idNotaSalida=" + idNotaSalida;

})

// ACTIVANDO- NOTA DE SALIDA
$(".tablaNotasSalidas").on("click",".btnActivarNotaSalida",function(){
	// Capturamos el id del usuario y el estado
  
	var idNotaSalida=$(this).attr("idNotaSalida");
	var estadoNotaSalida=$(this).attr("estadoNotaSalida");

	var datos=new FormData();
	datos.append("activarId",idNotaSalida);
	datos.append("activarEstado",estadoNotaSalida);
	$.ajax({
    url:"ajax/notas-salidas.ajax.php",
    type:"POST",
    data:datos,
    cache:false,
    contentType:false,
    processData:false,
    success:function(respuesta){
      // console.log(respuesta);
      if(estadoNotaSalida == "1"){

        Command: toastr["success"]("Nota de salida aprobada correctamente!");
      }
    }
	});
	//Cambiamos el estado del botón físicamente
	if(estadoNotaSalida=='1'){
	$(this).addClass("btn-success");
	$(this).removeClass("btn-danger");
  $(this).removeClass("btnActivarNotaSalida");
	$(this).html("APROBADO");}
});


$(".formularioUnirNotaSalida").on("change","select#selectNotaSalida",function(){
  var idNotaSalida = $(this).val();

  var datosDOC = new FormData();
    datosDOC.append("idNotaSalidaDetalle", idNotaSalida);
    
    $.ajax({

		url:"ajax/notas-salidas.ajax.php",
		method: "POST",
		data: datosDOC,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuestaDetalle){

      var materiaprima = $("#selectCodPro");

      materiaprima.find('option').remove();

      materiaprima.append('<option value="">SELECCIONAR MATERIA PRIMA</option>');

      for(var id of respuestaDetalle){
          if(!id.union_ns){
            
            materiaprima.append('<option value="' + id.CodPro + '">' +id.CodPro +" - "+ id.DesPro + " - "+id.Des_Larga+'</option>');
          }
          
          //console.log(serieSeparadoB);
      }

      materiaprima.selectpicker("refresh");

      var notaSaldar = $("#selectDependienteNotaSalida");

      notaSaldar.val("");

      notaSaldar.selectpicker("refresh");
      $("#nuevaCantidadSaldar").val("");
      
    }

  })
 
})

$(".formularioUnirNotaSalida").on("change","select#selectCodPro",function(){
  var unirNota = $("#selectNotaSalida").val();
  var unirCodPro  = $(this).val();

  var datosUnir = new FormData();
  datosUnir.append("unirNota", unirNota);
  datosUnir.append("unirCodPro", unirCodPro);
  $.ajax({

    url:"ajax/notas-salidas.ajax.php",
    method: "POST",
    data: datosUnir,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuesta){
      var notaSaldar = $("#selectDependienteNotaSalida");

      notaSaldar.find('option').remove();

      notaSaldar.append('<option value="">SELECCIONAR NOTA DE SALIDA</option>');

      for(var id of respuesta){
          notaSaldar.append('<option value="' + id.Nro + '">' +id.Nro +" / "+id.fecha+'</option>');
          //console.log(serieSeparadoB);
      }

      notaSaldar.selectpicker("refresh");
      
    }
  })
})

$(".formularioUnirNotaSalida").on("change","select#selectDependienteNotaSalida",function(){
  
  var notaSalida = $(this).val();

  var codPro = $("#selectCodPro").val();

  var datosNotaSalida = new FormData();
  datosNotaSalida.append("notaSalida", notaSalida);
  datosNotaSalida.append("codPro", codPro);
  $.ajax({

    url:"ajax/notas-salidas.ajax.php",
    method: "POST",
    data: datosNotaSalida,
    cache: false,
    contentType: false,
    processData: false,
    dataType:"json",
    success:function(respuestaSalida){
      // console.log(respuestaSalida);
      var saldo = Number(respuestaSalida["SalVta"]);
      $("#nuevaCantidadSaldar").val(saldo.toFixed(6));
      $("#nuevaCantidadSaldar").attr("saldo",saldo.toFixed(6));

    }

  })
})

$(".formularioUnirNotaSalida").on("keyup","input#nuevaCantidadSaldar",function(){

  if (Number($(this).val()) >  Number($(this).attr("saldo"))) {
    /*=============================================
    SI LA CANTIDAD ES SUPERIOR AL SERVICIO REGRESAR VALORES INICIALES
    =============================================*/

    $(this).val($(this).attr("saldo"));


    Command: toastr["error"]("Solo hay "+$(this).attr("saldo")+" de saldo disponible");
  }
})