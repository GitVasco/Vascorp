/*=============================================
CARGAR LA TABLA DINÁMICA DE NOTAS DE Ingresos
=============================================*/
if (localStorage.getItem("capturarRango29") != null) {
	$("#daterange-btnNotasIngresos span").html(localStorage.getItem("capturarRango29"));
	cargarTablaNotasIngresos(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnNotasIngresos span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaNotasIngresos(null, null);
}

/* 
*TABLA DE NOTAS DE INGRESO
*/
function cargarTablaNotasIngresos(fechaInicial,fechaFinal) {

$(".tablaNotasIngresos").DataTable({
    ajax: "ajax/materiaprima/tabla-notas-ingresos.ajax.php?perfil="+$("#perfilOculto").val() + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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
RANGO DE FECHAS PARA NOTAS Ingreso
=============================================*/

$("#daterange-btnNotasIngresos").daterangepicker(
    {
      cancelClass: "CancelarNotasIngresos",
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
      $("#daterange-btnNotasIngresos span").html(
        start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
      );
  
      var fechaInicial = start.format("YYYY-MM-DD");
  
      var fechaFinal = end.format("YYYY-MM-DD");
  
      var capturarRango29 = $("#daterange-btnNotasIngresos span").html();
    
      localStorage.setItem("capturarRango29", capturarRango29);
      localStorage.setItem("fechaInicial", fechaInicial);
      localStorage.setItem("fechaFinal", fechaFinal);
  
      // Recargamos la tabla con la información para ser mostrada en la tabla
      $(".tablaNotasIngresos").DataTable().destroy();
      cargarTablaNotasIngresos(fechaInicial, fechaFinal);
    });
  
  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/
  
  $(".daterangepicker.opensleft .range_inputs .CancelarNotasIngresos").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango29");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "notas-ingresos";
    }
  );
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
    if(ruta == "notas-ingresos"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango29", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaNotasIngresos").DataTable().destroy();
        cargarTablaNotasIngresos(fechaInicial, fechaFinal);
      }
    }
  
  });


/* 
* TABLA A PARA MP SIN OC  
*/
function cargarTablaSinOc(empresa, oc){

  $(".tablaMpSOc").DataTable({
    ajax: "ajax/materiaprima/tabla-mp-soc.ajax.php?empresa=" + empresa+ "&oc=" + oc,
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[1, "asc"]],
    "pageLength": 10,
    "lengthMenu": [[10, 20, 30, -1], [10, 20, 30, 'Todos']],
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

/* 
* ACTIVAR TABLA CON EMPRESA
*/  
/* if (localStorage.getItem("empresa") != null) {

	cargarTablaSinOc(localStorage.getItem("empresa"),localStorage.getItem("oc"));
	// console.log("lleno");
	
}else{

	cargarTablaSinOc(null, null);
	// console.log("vacio");

} */

/* 
* CARGAR LAS OC Y LA TABLA DEL PROVEEDOR
*/
$("#nuevoProveedor").change(function(){

  var empresa = $(this).val();
  //console.log(empresa);

  //$("#tablaCollapsada").removeClass("collapsed-box");

  var oc = null;

  localStorage.setItem("empresa", empresa);
  localStorage.setItem("oc", oc);
  $(".tablaMpSOc").DataTable().destroy();
	cargarTablaSinOc(localStorage.getItem("empresa"),localStorage.getItem("oc"));

  var nuevaOc = $("#nuevaOc");
  //nuevaOc.find('option').remove();
  //console.log(nuevaOc);

  var datos = new FormData();
  datos.append("empresa", empresa);

  $.ajax({

      url:"ajax/notas-ingresos.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){

          //console.log(respuesta);

          // Limpiamos el select
          nuevaOc.find('option').remove();

          nuevaOc.append('<option value="">SIN OC</option>');

          for(var id of respuesta){
              nuevaOc.append('<option value="' + id.nro + '">' + id.nro + '</option>');
              //console.log(nuevaOc);
          }
          $("#nuevaOc").selectpicker("refresh");

      }

  })  

})


/*  
* CARGAR TABLA CON LA ORDEN DE COMPRA
*/
$("#nuevaOc").change(function(){

  var empresa = $("#nuevoProveedor").val();
  //console.log(empresa);

  var oc = $(this).val();
  //console.log(oc);

  localStorage.setItem("empresa", empresa);
  localStorage.setItem("oc", oc);
  $(".tablaMpSOc").DataTable().destroy();
	cargarTablaSinOc(localStorage.getItem("empresa"),localStorage.getItem("oc"));

});

/* 
*AGREGANDO MATERIA PRIMA
*/
$(".tablaMpSOc").on("click", ".agregarMPNI", function() {

  var idboton = $(this).attr("idboton");
  var codpro = $(this).attr("codpro");
  var orden =$(this).attr("orden");
  var codruc =$(this).attr("empresa");
  

  if(orden == ""){

    var orden = null;

  }else{
    
    var orden =$(this).attr("orden");


  }
  //console.log(idboton, codpro, orden, codruc);

  $(this).removeClass("btn-primary agregarMPNI");
  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("codpro", codpro);
  datos.append("orden", orden);
  datos.append("codruc", codruc);

  $.ajax({
    url: "ajax/notas-ingresos.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      //console.log(respuesta);
      var codpro = respuesta["codpro"];
      var codfab = respuesta["codfab"];
      var descripcion = respuesta["descripcion"];
      var cantidad = respuesta["canni"];
      var precio = respuesta["precio"];

      if(respuesta["nro"] == null){

        var nroorden = "";

      }else{

        var nroorden = respuesta["nro"];

      }
      

      $(".nuevaMPNI").append(

        '<div class="row" style="padding:1px 15px">' +

          "<!-- CODPRO -->" +

          '<div class="col-xs-1" style="padding-right:0px">' +

              '<input type="text" class="form-control input-sm nuevoCodPro" codpro="' + codpro + '" name="codpro" id="codpro" value="' + codpro + '"  readonly>' +

          "</div>" +

          "<!-- CODFAB -->" +

          '<div class="col-xs-1" >' +

              '<input type="text" class="form-control input-sm nuevoCodFab"  name="codfab" id ="codfab" value="' + codfab + '"  readonly>' +

          "</div>" +

          "<!-- DESCRIPCION -->" +

          '<div class="col-xs-2" >' +

              '<input type="text" class="form-control input-sm nuevaDescripcion" style="width: 280px;  font-size: 12px;padding: 2px;" name="descripcion" id ="descripcion" value="' + descripcion + '"  readonly>' +

          "</div>" +

          "<!-- CANTIDAD -->" +

          '<div class="col-xs-1 ingresoCantidadOC">' +

              '<input type="number" step="any" class="form-control input-sm nuevaCantidad"  name="cantidad" id="cantidad" value="' + cantidad + '"  readonly>' +

          "</div>" +

          "<!-- CANTIDAD RECIBIDA -->" +

          '<div class="col-xs-1 ingresoCantidad">' +

              '<input type="number" step="any" class="form-control input-sm nuevaCantidadRecibida"  name="cantidadRecibida" id="cantidadRecibida" cantidadReal="0" value="1" min="1">' +

          "</div>" +

          "<!-- SALDO -->" +

          '<div class="col-xs-1 ingresoSaldo">' +

              '<input type="number" step="any" class="form-control input-sm nuevoSaldo"  name="saldo" id="saldo"  readonly>' +

          "</div>" +

          "<!-- EXCESO -->" +

          '<div class="col-xs-1 ingresoExceso">' +

              '<input type="number" step="any" class="form-control input-sm nuevoExceso"  name="exceso" id="exceso"  readonly>' +

          "</div>" + 
          
          "<!-- PRECIO SIN IGV -->" +

          '<div class="col-xs-1 ingresoPrecio" >' +

              '<input type="number" step="any" class="form-control input-sm nuevoPrecio"  name="precio" id="precio" value="'+ precio +'" precioReal="'+ precio +'">' +

          "</div>" +

          "<!-- TOTAL SIN IGV -->" +

          '<div class="col-xs-1 ingresoTotal" >' +

              '<input type="number" step="any" class="form-control input-sm nuevoTotal"  name="nuevoTotal" id="nuevoTotal" value="'+ precio +'" readonly>' +

          "</div>" +   
          
          "<!-- ORDEN DE COMPRA -->" +

          '<div class="col-xs-1" >' +

              '<input type="number" step="any" class="form-control input-sm nuevaOC"  name="ordencompra" id="ordencompra" value="'+ nroorden +'" readonly>' +

          "</div>" +          


          "<!-- CERRAR Y BORRAR LINEA -->" +

          '<div class="col-xs-1">' +

            '<div class="input-group">' +

            '<input type="text" class="form-control input-sm nuevoCerrar" name="cerrar" id="cerrar">' +
            
            '<span class="input-group-addon" style="padding: 3px 6px"><button type="button" class="btn btn-danger btn-xs quitarMPNI" idBoton="' + idboton + '"><i class="fa fa-times"></i></button></span>' +

            "</div>" +

          "</div>" +


        "</div>"


      );     
      sumarTotalPreciosNI();
      agregarImpustoNI();
      listarMpNi();

    }

  });  
  
});

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/

$(".tablaMpSOc").on("draw.dt", function() {
  /* console.log("tabla"); */

  if (localStorage.getItem("quitarMPNI") != null) {
    var listaIdMPNI = JSON.parse(localStorage.getItem("quitarMPNI"));

    //console.log(listaIdMPNI);

    for (var i = 0; i < listaIdMPNI.length; i++) {
      $(
        "button.recuperarBoton[idBoton='" +
        listaIdMPNI[i]["idBoton"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idBoton='" +
        listaIdMPNI[i]["idBoton"] +
          "']"
      ).addClass("btn-primary agregarMPNI");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/

var idQuitarMPNI = [];

localStorage.removeItem("quitarMPNI");

$(".formularioNotaIngreso").on("click", "button.quitarMPNI", function() {
  /* console.log("boton"); */

  $(this)
    .parent()
    .parent()
    .parent()
    .parent()
    .remove();

  var idBoton = $(this).attr("idBoton");
  //console.log(idBoton);

  /*=============================================
  ALMACENAR EN EL LOCALSTORAGE EL ID DEL PRODUCTO A QUITAR
  =============================================*/

  if (localStorage.getItem("quitarMPNI") == null) {
    idQuitarMPNI = [];
  } else {
    idQuitarMPNI.concat(localStorage.getItem("quitarMPNI"));
  }

  idQuitarMPNI.push({
    idBoton: idBoton
  });

  //console.log(idQuitarMPNI);

  localStorage.setItem("quitarMPNI", JSON.stringify(idQuitarMPNI));

  $(".recuperarBoton[idBoton='" + idBoton + "']").removeClass(
    "btn-default"
  );

  $(".recuperarBoton[idBoton='" + idBoton + "']").addClass(
    "btn-primary agregarMPNI"
  );

  if ($(".nuevaMPNI").children().length == 0) {
    $("#nuevoSubTotalNi").val(0);
    $("#nuevoImpuestoNi").val(0);
    $("#nuevoTotalNi").val(0);

    $("#subTotalNi").val(0);
    $("#impuestoNi").val(0);
    $("#totalNi").attr("total", 0);

    $("#listaNI").val("");

  } else {

    sumarTotalPreciosNI();
    agregarImpustoNI();
    listarMpNi();
  }  
  
});

/*=============================================
MODIFICAR EL TOTAL AL CAMBIAR LA CANTIDAD
=============================================*/
$(".formularioNotaIngreso").on("keyup", "input.nuevaCantidadRecibida", function() {

  var precio = $(this)
              .parent()
              .parent()
              .children(".ingresoPrecio")
              .children(".nuevoPrecio");  

  var cantRecibida = Number($(this).val());
  //console.log(cantRecibida)

  precioFinal = precio.val() * cantRecibida
  //console.log(precioFinal);

  var total = $(this)
              .parent()
              .parent()
              .children(".ingresoTotal")
              .children(".nuevoTotal"); 

  total.val(precioFinal.toFixed(6));

  var cantidad = $(this)
                .parent()
                .parent()
                .children(".ingresoCantidadOC")
                .children(".nuevaCantidad");

  var cant = Number(cantidad.val());
  //console.log(cant);

  var saldo = $(this)
                .parent()
                .parent()
                .children(".ingresoSaldo")
                .children(".nuevoSaldo");

  var exceso = $(this)
      .parent()
      .parent()
      .children(".ingresoExceso")
      .children(".nuevoExceso");

   if(cant <= 0){

    saldoNI = 0;

    excesoNI = cantRecibida;

  }else{

    if(cantRecibida > cant){

      excesoNI = cantRecibida - cant;
      saldoNI = 0;


    }else{

      saldoNI = cant - cantRecibida;
      excesoNI = 0; 

    }    

  }
  
  //console.log('exceso: ',excesoNI,' saldo: ', saldoNI);

  exceso.val(excesoNI);
  saldo.val(saldoNI);

  sumarTotalPreciosNI();
  agregarImpustoNI();
  listarMpNi();

});

$(".formularioNotaIngreso").on("keyup", "input.nuevoPrecio", function() {

  var cantidadRecibida = $(this)
                        .parent()
                        .parent()
                        .children(".ingresoCantidad")
                        .children(".nuevaCantidadRecibida");  

  var precio = Number($(this).val());
  //console.log(precio)

  var precioFinal = cantidadRecibida.val() * precio;
  //console.log(precioFinal);

  var total = $(this)
  .parent()
  .parent()
  .children(".ingresoTotal")
  .children(".nuevoTotal"); 

  total.val(precioFinal.toFixed(6));

  sumarTotalPreciosNI();
  agregarImpustoNI();
  listarMpNi();

});

$(".formularioNotaIngreso").on("keyup", "input.nuevoCerrar", function() {

  sumarTotalPreciosNI();
  agregarImpustoNI();
  listarMpNi();

});

function sumarTotalPreciosNI() {

  var precioItem = $(".nuevoTotal");
 // console.log("precioitem", precioItem);

  var arraySumaPrecio = [];

  for (var i = 0; i < precioItem.length; i++) {
    arraySumaPrecio.push(Number($(precioItem[i]).val()));
  }
  //console.log("arraySumaPrecio", arraySumaPrecio);  

  function sumaArrayPrecios(total, numero) {
    return total + numero;
  }

  var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecios);
  //console.log("sumaTotalPrecio", sumaTotalPrecio);  

  $("#nuevoSubTotalNi").val(sumaTotalPrecio.toFixed(4));
  $("#subTotalNi").val(sumaTotalPrecio);
  $("#nuevoSubTotalNi").attr("subTotal", sumaTotalPrecio);

}

function agregarImpustoNI(){

  subTotal = $("#nuevoSubTotalNi").attr("subTotal");
  //console.log(subTotal);

  impuesto= Number(subTotal) * 0.18;
  //console.log(impuesto);

  $("#nuevoImpuestoNi").val(impuesto.toFixed(4));
  $("#impuestoNi").val(impuesto);
  $("#nuevoImpuestoNi").attr("impuesto", impuesto);

  total = Number(subTotal) + Number(impuesto);
  //console.log(total);

  $("#nuevoTotalNi").val(total.toFixed(4));
  $("#totalNi").val(total);
  $("#nuevoTotalNi").attr("total", total);

}

function listarMpNi(){

  listaMpNi = [];

  var codpro=       $(".nuevoCodPro");
  var descripcion = $(".nuevaDescripcion");
  var cantidadOc =  $(".nuevaCantidad");
  var cantidadRe =  $(".nuevaCantidadRecibida");
  var saldo =       $(".nuevoSaldo");
  var exceso =      $(".nuevoExceso");
  var precio =      $(".nuevoPrecio");
  var total =       $(".nuevoTotal");
  var oc =          $(".nuevaOC");
  var cerrar =      $(".nuevoCerrar");

  for (var i = 0; i < descripcion.length; i++) {

    listaMpNi.push({
      codpro:  $(codpro[i]).val(),
      cantidadOc:  $(cantidadOc[i]).val(),
      cantidadRe: $(cantidadRe[i]).val(),
      saldo: $(saldo[i]).val(),
      exceso: $(exceso[i]).val(),
      precio: $(precio[i]).val(),
      total: $(total[i]).val(),
      oc: $(oc[i]).val(),
      cerrar: $(cerrar[i]).val()
    });
  }

    //console.log("listaMpNi", JSON.stringify(listaMpNi)); 

    $("#listaNI").val(JSON.stringify(listaMpNi));

}

/* 
* BOTON REPORTE DE ORDEN DE CORTE
*/
$(".tablaNotasIngresos").on("click", ".btnDetalleReporteNotaIngreso", function () {

  var idNotaIngreso = $(this).attr("idNotaIngreso");
  console.log("idNotaIngreso", idNotaIngreso);

  window.location = "vistas/reportes_excel/rpt_notasingresos.php?idNotaIngreso=" + idNotaIngreso;

})

/* 
* VISUALIZAR DETALLE DEL CORTE
*/ 
$(".tablaNotasIngresos").on("click", ".btnVisualizarNotaIngreso", function () {

  var idNotaIngreso = $(this).attr("idNotaIngreso");
  //console.log(idNotaIngreso);

  var datos = new FormData();
	datos.append("idNotaIngreso", idNotaIngreso);

	$.ajax({

		url:"ajax/notas-ingresos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
      //console.log(respuesta);

      $("#NotaIngreso").val(respuesta["ni"]);
      $("#fecNi").val(respuesta["emi_ni"]);
      $("#tipDocP").val(respuesta["cod_doc_pri"]);
      $("#tipDocP").selectpicker("refresh");
      $("#nuevaSerieP").val(respuesta["ser_pri"]);
      $("#nuevoNroP").val(respuesta["num_pri"]);
      $("#fecP").val(respuesta["emi_pri"]);

      $("#tipDocS").val(respuesta["cod_doc_sec"]);
      $("#tipDocS").selectpicker("refresh");
      $("#nuevaSerieS").val(respuesta["ser_sec"]);
      $("#nuevoNroS").val(respuesta["num_sec"]);
      $("#fecS").val(respuesta["emi_sec"]);      
      
      $("#proveedor").val(respuesta["nom_prov"]);
      $("#oc").val(respuesta["oc"]);
      $("#moneda").val(respuesta["moneda"]);
      $("#nuevaObservacion").val(respuesta["obser"]);
      
		  }

  })  

  var idNotaIngresoDet = $(this).attr("idNotaIngreso");
  //console.log(idNotaIngresoDet);

  var datosDOC = new FormData();
  datosDOC.append("idNotaIngresoDet", idNotaIngresoDet);
  
  $.ajax({

  url:"ajax/notas-ingresos.ajax.php",
  method: "POST",
  data: datosDOC,
  cache: false,
  contentType: false,
  processData: false,
  dataType:"json",
  success:function(respuestaDetalle){

    console.log(respuestaDetalle);

    $(".detalleNI").remove();
     
    for(var id of respuestaDetalle){
          
      $('.tablaDetalleNotaIngreso').append(

        '<tr class="detalleNI">' +
          '<td class="text-center">' + id.item + ' </td>' +
          '<td class="text-center">' + id.codpro + ' </td>' +
          '<td class="text-left">' + id.codfab + ' </td>' +
          '<td>' + id.despro + '</td>' +
          '<td >' + id.color + ' </td>' +
          '<td class="text-center">' + id.unidad + ' </td>' +
          '<td class="text-right">' + id.cansol + ' </td>' +
          '<td class="text-right">' + id.salpro + ' </td>' +
          '<td class="text-right">' + id.excpro + ' </td>' +
          '<td class="text-right">' + id.p_unitario + ' </td>' +
          '<td class="text-right">' + id.total + ' </td>' +
          '<td class="text-center">' + id.ndoc + ' </td>' +
        '</tr>'

      )

    }            

  }

})

})