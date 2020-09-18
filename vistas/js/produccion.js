/* 
* tabla paraa cargar la lista de quincenas
*/
$('.tablaQuincena').DataTable( {
    "ajax": "ajax/tabla-quincenas.ajax.php?perfil="+$("#perfilOculto").val(),
    "deferRender": true,
	"retrieve": true,
	"processing": true,
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
} );

/* 
* EDITAR QUINCENA
*/
$(".tablaQuincena").on("click",".btnEditarQuincena",function(){

	var id=$(this).attr("id");
    var datos=new FormData();
    
	datos.append("id",id);
	$.ajax({
		url:"ajax/quincena.ajax.php",
		type:"POST",
		data:datos,
		cache:false,
		contentType:false,
		processData:false,
		dataType:"json",
		success:function(respuesta){

            //console.log(respuesta)
            $("#id").val(respuesta["id"]);
            $("#editarMes").val(respuesta["nmes"]);
            $("#editarMes").selectpicker('refresh');
            $("#editarQuincena").val(respuesta["nquincena"]);
            $("#editarQuincena").selectpicker('refresh');
            $("#editarInicio").val(respuesta["inicio"]);
            $("#editarFin").val(respuesta["fin"]);
            
        }
        
    });
    
});

/* 
* BOTON VER EFICIENCIA
*/
$(".tablaQuincena").on("click", ".btnEficiencia", function () {

	var inicio = $(this).attr("inicio");
	var fin = $(this).attr("fin");
	var nquincena = $(this).attr("nquincena");
	var id = $(this).attr("id");
	//console.log(inicio, fin, nquincena, id);

	localStorage.setItem("inicio", inicio);
	localStorage.setItem("fin", fin);
	localStorage.setItem("nquincena", nquincena);
	localStorage.setItem("id", id);

	window.location = "index.php?ruta=eficiencia&inicio=" + inicio + "&fin=" + fin + "&nquincena=" + nquincena + "&id=" + id;

	
  
})

cargarEficiencia(localStorage.getItem("inicio"), localStorage.getItem("fin"), localStorage.getItem("nquincena"), localStorage.getItem("id"));

function cargarEficiencia(inicio,fin,nquincena,id){

	$('.tablaEficiencia').DataTable({
		"ajax": "ajax/tabla-eficiencia.ajax.php?perfil=" + $("#perfilOculto").val() + "&inicio=" + inicio + "&fin=" + fin + "&nquincena=" + nquincena + "&id=" + id,
		"deferRender": true,
		"retrieve": true,
		"processing": true,
		"order": [[0, "desc"]],
		"pageLength": 20,
		"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
		"language": {
	
			"sProcessing": "Procesando...",
			"sLengthMenu": "Mostrar _MENU_ registros",
			"sZeroRecords": "No se encontraron resultados",
			"sEmptyTable": "Ningún dato disponible en esta tabla",
			"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix": "",
			"sSearch": "Buscar:",
			"sUrl": "",
			"sInfoThousands": ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
				"sFirst": "Primero",
				"sLast": "Último",
				"sNext": "Siguiente",
				"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
	
		}
		
	});


}


/* 
* TABLA EFICIENCIA POR MES
*/
/* $('.tablaEficiencia').DataTable({
	"ajax": "ajax/tabla-eficiencia.ajax.php?perfil=" + $("#perfilOculto").val(),
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[0, "desc"]],
	"pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
	"language": {

		"sProcessing": "Procesando...",
		"sLengthMenu": "Mostrar _MENU_ registros",
		"sZeroRecords": "No se encontraron resultados",
		"sEmptyTable": "Ningún dato disponible en esta tabla",
		"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
		"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
		"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
		"sInfoPostFix": "",
		"sSearch": "Buscar:",
		"sUrl": "",
		"sInfoThousands": ",",
		"sLoadingRecords": "Cargando...",
		"oPaginate": {
			"sFirst": "Primero",
			"sLast": "Último",
			"sNext": "Siguiente",
			"sPrevious": "Anterior"
		},
		"oAria": {
			"sSortAscending": ": Activar para ordenar la columna de manera ascendente",
			"sSortDescending": ": Activar para ordenar la columna de manera descendente"
		}

	}

});


	
}); */
//Reporte de Salidas
$(".box").on("click", ".btnReporteEficiencia", function () {
	inicio=$(this).attr("inicio");
	fin=$(this).attr("fin");
	quincena=$(this).attr("quincena");
	id=$(this).attr("id");
    window.location = "vistas/reportes_excel/rpt_eficiencia.php?inicio="+inicio+"&fin="+fin+"&quincena="+quincena+"&id="+id;
  
})