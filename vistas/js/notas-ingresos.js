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

  $(".TablaMpSOc").DataTable({
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
  $(".TablaMpSOc").DataTable().destroy();
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
  console.log(empresa);

  var oc = $(this).val();
  console.log(oc);

  localStorage.setItem("empresa", empresa);
  localStorage.setItem("oc", oc);
  $(".TablaMpSOc").DataTable().destroy();
	cargarTablaSinOc(localStorage.getItem("empresa"),localStorage.getItem("oc"));

})