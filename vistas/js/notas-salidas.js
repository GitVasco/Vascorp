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