$('.tablaAbonos').DataTable({
    "ajax": "ajax/tabla-abonos.ajax.php?perfil="+$("#perfilOculto").val(),
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
/*=============================================
EDITAR ABONO
=============================================*/
$(".tablaAbonos").on("click", ".btnEditarAbono", function () {

    var idAbono = $(this).attr("idAbono");
    var datos = new FormData();
    datos.append("idAbono", idAbono);

    $.ajax({

        url: "ajax/abonos.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $("#idAbono").val(respuesta["id"]);
            $("#editarFecha").val(respuesta["fecha"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarMonto").val(respuesta["monto"]);
            $("#editarAgencia").val(respuesta["agencia"]);
            $("#editarOpe").val(respuesta["num_ope"]);
        }

    })

})


/*=============================================
ELIMINAR ABONO
=============================================*/
$(".tablaAbonos").on("click", ".btnEliminarAbono", function(){

	var idAbono = $(this).attr("idAbono");
	
	swal({
        title: '¿Está seguro de borrar el abono?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar abono!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=abonos&idAbono="+idAbono;
        }

  })

})
//Reporte de Colores
// $(".box").on("click", ".btnReporteColor", function () {
//     window.location = "vistas/reportes_excel/rpt_color.php";
  
// })
/*
* validar el checkbox
*/
$('.tablaAbonosCancelar').on("change",'.chkAbono',function(){
  var chkBox = document.getElementById('chkAbono');

  if(chkBox.checked == true){
    var monto = $(this).attr("monto");
    var mayor = Number(monto)+5;
    var menor = Number(monto)-5;
    localStorage.setItem("montoMayor", mayor);
    localStorage.setItem("montoMenor", menor);
	  cargarTablaCuentasCancelar(localStorage.getItem("montoMayor"),localStorage.getItem("montoMenor"));
  }else{
    localStorage.removeItem("montoMayor");
    localStorage.removeItem("montoMenor");
    localStorage.clear();
  }

});

/* 
* VEMOS SI LOCAL STORAGE TRAE ALGO
*/
if (localStorage.getItem("montoMayor") != null) {

	cargarTablaCuentasCancelar(localStorage.getItem("montoMayor"),localStorage.getItem("montoMenor"));
	//console.log("lleno");
	
}else{

	cargarTablaCuentasCancelar(null,null);
	//console.log("vacio");

}

  $('.tablaAbonosCancelar').DataTable({
    "ajax": "ajax/tabla-abonos-cancelar.ajax.php?perfil="+$("#perfilOculto").val(),
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

function cargarTablaCuentasCancelar(mayor,menor) {
  $('.tablaCuentasCancelar').DataTable({
    "ajax": "ajax/tabla-cuentas-cancelar.ajax.php?perfil="+$("#perfilOculto").val()+ "&mayor=" + mayor + "&menor=" + menor,
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
