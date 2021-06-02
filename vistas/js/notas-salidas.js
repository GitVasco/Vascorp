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
  datos.append("idMateriaPrima", idMateriaNota);

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
          $(".nuevoDestinoNota").find('option').remove();
                
            $(".nuevoDestinoNota").append("<option value=''>SELECCIONAR DESTINO</option>");
            for (let i = 0; i < respuesta2.length; i++) {
              
              $(".nuevoDestinoNota").append("<option value='"+respuesta2[i]["Cod_Argumento"]+"'>"+respuesta2[i]["Cod_Argumento"]+" - "+respuesta2[i]["Des_Larga"]+"</option>");
              
            }
        }

      });

      $(".nuevaMateriaNota").append(

        '<div class="row" style="padding:5px 15px">' +

          "<!-- Descripción del producto -->" +

          '<div class="col-xs-1" style="padding-right:0px">' +

              '<input type="text" class="form-control nuevoCodigoPro" idMateriaNota="' + codpro + '" name="agregarProducto" value="' + codpro + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control nuevoCodigoFabrica"  name="nuevoCodigoFabrica" value="' + codfab + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-4" >' +

              '<input type="text" class="form-control nuevaDescripcionMateria"  name="nuevaDescripcionMateria" value="' + descripcion + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control nuevoCodigoColor"  name="nuevoCodigoColor" value="' + codcolor + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control nuevoColor"  name="nuevoColor" value="' + color + '"  readonly>' +

          "</div>" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control nuevoCosto"  name="nuevoCosto" value="' + precio + '"  readonly required>' +

          "</div>" +

          '<div class="col-xs-2" >' +

              '<select class="form-control  nuevoDestinoNota" name="nuevoDestinoNota" required>' +
              '<option value="">Seleccionar destino</option>' +

              '</select>'+

          "</div>" +

          "<!-- Cantidad del producto -->" +

          '<div class="col-xs-1">' +

            '<div class="input-group">' +

            '<input type="number" step="any" class="form-control nuevaCantidadMateria" name="nuevaCantidadMateria" min="1" value="1" stock="' + stock + '" nuevoStock="' + Number(stock - 1) + '" required>' +
            
            '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarMateriaNota" idMateriaNota="' + idMateriaNota + '"><i class="fa fa-times"></i></button></span>' +

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

  console.log("listarMateriaNotas", JSON.stringify(listarMateriaNotas)); 

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
    console.log(idNotaSalida);
    
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
      $("#fecha").val(fechaNueva);
      $("#almacen").val(respuesta["AlmDes"]);
      $("#ruc").val(respuesta["Ruc"]);
      $("#cliente").val(respuesta["Ruc"]);
      $("#motivo").val(respuesta["DocSal"])

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
						'<td class="text-center">' + id.CanVta + '</td>' +
						'<td >' + id.DesPro + ' </td>' +
            '<td class="text-center">' + id.Des_Larga + ' </td>' +
            '<td class="text-center">' + id.pcosto + ' </td>' +
            '<td class="text-center">' + id.CenCosto + ' </td>' +
					'</tr>'

				)

			}            

		}

	})
  
});