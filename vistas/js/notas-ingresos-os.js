/*=============================================
CARGAR LA TABLA DINÁMICA DE NOTAS DE Ingresos
=============================================*/
if (localStorage.getItem("capturarRango32") != null) {
	$("#daterange-btnNotasIngresosOS span").html(localStorage.getItem("capturarRango32"));
	cargarTablaNotasIngresosOS(localStorage.getItem("fechaInicial"), localStorage.getItem("fechaFinal"));
} else {
	$("#daterange-btnNotasIngresosOS span").html('<i class="fa fa-calendar"></i> Rango de Fecha ');
	cargarTablaNotasIngresosOS(null, null);
}

/* 
*TABLA DE NOTAS DE INGRESO POR ORDEN DE SERVICIO
*/
function cargarTablaNotasIngresosOS(fechaInicial,fechaFinal) {

    $(".tablaNotasIngresosOS").DataTable({
        ajax: "ajax/materiaprima/tabla-notas-ingresos-os.ajax.php?perfil="+$("#perfilOculto").val() + "&fechaInicial=" + fechaInicial + "&fechaFinal=" + fechaFinal,
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

$("#daterange-btnNotasIngresosOS").daterangepicker(
  {
    cancelClass: "CancelarNotasIngresosOS",
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
    $("#daterange-btnNotasIngresosOS span").html(
      start.format("MMMM D, YYYY") + " - " + end.format("MMMM D, YYYY")
    );

    var fechaInicial = start.format("YYYY-MM-DD");

    var fechaFinal = end.format("YYYY-MM-DD");

    var capturarRango32 = $("#daterange-btnNotasIngresosOS span").html();
  
    localStorage.setItem("capturarRango32", capturarRango32);
    localStorage.setItem("fechaInicial", fechaInicial);
    localStorage.setItem("fechaFinal", fechaFinal);

    // Recargamos la tabla con la información para ser mostrada en la tabla
    $(".tablaNotasIngresosOS").DataTable().destroy();
    cargarTablaNotasIngresosOS(fechaInicial, fechaFinal);
  });

  /*=============================================
  CANCELAR RANGO DE FECHAS
  =============================================*/  
  $(".daterangepicker.opensleft .range_inputs .CancelarNotasIngresosOS").on(
    "click",
    function() {
      localStorage.removeItem("capturarRango32");
      localStorage.removeItem("fechaInicial");
      localStorage.removeItem("fechaFinal");
      localStorage.clear();
      window.location = "notas-ingresos-os";
    }
  ); 
  
  /*=============================================
  CAPTURAR HOY
  =============================================*/
  
  $(".daterangepicker.opensleft .ranges li").on("click", function() {
    var textoHoy = $(this).attr("data-range-key");
    var ruta = $("#rutaAcceso").val();
    if(ruta == "notas-ingresos-os"){
      if (textoHoy == "Hoy") {
        var d = new Date();
    
        var dia = d.getDate();
        var mes = d.getMonth() + 1;
        var año = d.getFullYear();
    
        dia = ("0" + dia).slice(-2);
        mes = ("0" + mes).slice(-2);
    
        var fechaInicial = año + "-" + mes + "-" + dia;
        var fechaFinal = año + "-" + mes + "-" + dia;
    
        localStorage.setItem("capturarRango32", "Hoy");
        localStorage.setItem("fechaInicial", fechaInicial);
        localStorage.setItem("fechaFinal", fechaFinal);
      // Recargamos la tabla con la información para ser mostrada en la tabla
        $(".tablaNotasIngresosOS").DataTable().destroy();
        cargarTablaNotasIngresosOS(fechaInicial, fechaFinal);
      }
    }
  
  });  

/* 
*Cargar tabla de mp en orden de servicio
*/
$(".tablaMpSO").DataTable({
  ajax: "ajax/materiaprima/tabla-mp-os.ajax.php",
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


$(".tablaMpSO").on("click", ".agregarMPOS", function() {

  var idboton = $(this).attr("idboton");
  var ordser = $(this).attr("ordser");
  var codori = $(this).attr("codori");
  var coddes = $(this).attr("coddes");
  //console.log(idboton,ordser,codori,coddes)

  $(this).removeClass("btn-primary agregarMPNI");
  $(this).addClass("btn-default");

  var datos = new FormData();
  datos.append("ordser", ordser);
  datos.append("codori", codori);
  datos.append("coddes", coddes);  

  $.ajax({
    url: "ajax/notas-ingresos-os.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

      //console.log(respuesta);

      //var codori = respuesta["codproorigen"];
      var descripcion = respuesta["desori"];
      var colOri = respuesta["colorori"];
      var colDes = respuesta["colordes"];
      var saldo = respuesta["saldo"];
      var descontar = respuesta["descontar"];

      $(".nuevaMPOS").append(

        '<div class="row" style="padding:1px 15px">' +

          "<!-- CODORI -->" +

          '<div class="col-xs-1" style="padding-right:0px">' +

              '<input type="text" class="form-control input-sm nuevoCodOri" codori="' + codori + '" name="codori" id="codori" value="' + codori + '"  readonly>' +

          "</div>" +
          
          "<!-- DESCRIPCION -->" +

          '<div class="col-xs-4" >' +

              '<input type="text" class="form-control input-sm nuevaDescripcion" name="descripcion" id ="descripcion" value="' + descripcion + '"  readonly>' +

          "</div>" +
          
          "<!-- COLOR ORIGEN -->" +

          '<div class="col-xs-1 ingresoColOri">' +

              '<input type="text" class="form-control input-sm nuevoColOri" style="width:120px;font-size: 12px;padding: 2px;" name="colOri" id="colOri" value="'+ colOri +'" readonly>' +

          "</div>" +   
          
          "<!-- CODDES -->" +

          '<div class="col-xs-1" style="padding-right:0px">' +

              '<input type="text" class="form-control input-sm nuevoCodDes" coddes="' + coddes + '" name="coddes" id="coddes" value="' + coddes + '"  readonly>' +

          "</div>" + 
          
          "<!-- COLOR DESTINO -->" +

          '<div class="col-xs-1 ingresoColDes">' +

              '<input type="text" class="form-control input-sm nuevoColDes" style="width:120px;font-size: 12px;padding: 2px;" name="colDes" id="colDes" value="'+ colDes +'" readonly>' +

          "</div>" +   
          
          "<!-- SALDO -->" +

          '<div class="col-xs-1 ingresoSaldo">' +

              '<input type="number" step="any" class="form-control input-sm nuevoSaldo"  name="saldo" id="saldo" value="'+ saldo +'" readonly>' +

          "</div>" +     
          
          "<!-- CANTIDAD RECIBIDA -->" +

          '<div class="col-xs-1 ingresoCantidad">' +

              '<input type="number" step="any" class="form-control input-sm nuevaCantidadRecibida"  name="cantidadRecibida" id="cantidadRecibida" descontar="'+ descontar +'" cantidadReal="0" value="0" min="1">' +

          "</div>" +   
          
          "<!-- ORDEN DE SERVICIO -->" +

          '<div class="col-xs-1" >' +

              '<input type="number" step="any" class="form-control input-sm nuevaOS"  name="ordenservicio" id="ordenservicio" value="'+ ordser +'" readonly>' +

          "</div>" +      
          
          "<!-- CERRAR Y BORRAR LINEA -->" +

          '<div class="col-xs-1">' +

            '<div class="input-group">' +

            '<input type="text" class="form-control input-sm nuevoCerrar" name="cerrar" id="cerrar">' +
            
            '<span class="input-group-addon" style="padding: 3px 6px"><button type="button" class="btn btn-danger btn-xs quitarMPNIS" idBoton="' + idboton + '"><i class="fa fa-times"></i></button></span>' +

            "</div>" +

          "</div>" +          

        "</div>"

      );     
      listarMpNiS();

    }

  });   

})

/*=============================================
CUANDO CARGUE LA TABLA CADA VEZ QUE NAVEGUE EN ELLA
=============================================*/
$(".tablaMpSO").on("draw.dt", function() {
  /* console.log("tabla"); */

  if (localStorage.getItem("quitarMPNIS") != null) {
    var listaIdMPNIS = JSON.parse(localStorage.getItem("quitarMPNIS"));

    //console.log(listaIdMPNIS);

    for (var i = 0; i < listaIdMPNIS.length; i++) {
      $(
        "button.recuperarBoton[idBoton='" +
        listaIdMPNIS[i]["idBoton"] +
          "']"
      ).removeClass("btn-default");
      $(
        "button.recuperarBoton[idBoton='" +
        listaIdMPNIS[i]["idBoton"] +
          "']"
      ).addClass("btn-primary agregarMPNI");
    }
  }
});

/*=============================================
QUITAR PRODUCTOS DE LA VENTA Y RECUPERAR BOTÓN
=============================================*/
var idQuitarMPNIS = [];

localStorage.removeItem("quitarMPNIS");

$(".formularioNotaIngresoServ").on("click", "button.quitarMPNIS", function() {
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

  if (localStorage.getItem("quitarMPNIS") == null) {
    idQuitarMPNIS = [];
  } else {
    idQuitarMPNIS.concat(localStorage.getItem("quitarMPNIS"));
  }

  idQuitarMPNIS.push({
    idBoton: idBoton
  });

  //console.log(idQuitarMPNIS);

  localStorage.setItem("quitarMPNIS", JSON.stringify(idQuitarMPNIS));

  $(".recuperarBoton[idBoton='" + idBoton + "']").removeClass(
    "btn-default"
  );

  $(".recuperarBoton[idBoton='" + idBoton + "']").addClass(
    "btn-primary agregarMPNI"
  );

  if ($(".nuevaMPOS").children().length == 0) {

    $("#listaOS").val("");
    
  } else {

    listarMpNiS();
  }
  
});

$(".formularioNotaIngresoServ").on("keyup", "input.nuevaCantidadRecibida", function() {

  listarMpNiS();

});


$(".formularioNotaIngresoServ").on("keyup", "input.nuevoCerrar", function() {

  listarMpNiS();

});

function listarMpNiS(){

  listaMpNiS = [];

  var codori=       $(".nuevoCodOri");
  var descripcion = $(".nuevaDescripcion");
  var coddes =      $(".nuevoCodDes");
  var cantidadRe =  $(".nuevaCantidadRecibida");
  var ordser =      $(".nuevaOS");
  var cerrar =      $(".nuevoCerrar");


  for (var i = 0; i < descripcion.length; i++) {

    listaMpNiS.push({
      codori:  $(codori[i]).val(),
      coddes:  $(coddes[i]).val(),
      cantidadRe: $(cantidadRe[i]).val(),
      ordser: $(ordser[i]).val(),
      cerrar: $(cerrar[i]).val()
    });
  }

    //console.log("listaMpNiS", JSON.stringify(listaMpNiS)); 

    $("#listaOS").val(JSON.stringify(listaMpNiS));

}

/* 
* BOTON REPORTE DE ORDEN DE CORTE
*/
$(".tablaNotasIngresosOS").on("click", ".btnDetalleReporteNotaIngresoServicio", function () {

  var idNotaIngresoServicio = $(this).attr("idNotaIngresoServicio");
  console.log("idNotaIngresoServicio", idNotaIngresoServicio);

  window.location = "vistas/reportes_excel/rpt_notaingresoservicio.php?idNotaIngresoServicio=" + idNotaIngresoServicio;

})
