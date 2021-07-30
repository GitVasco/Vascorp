$(".TablaCentroCostos").DataTable({
    "ajax": "ajax/centrocostos/tabla-centrocostos.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
	/* "scrollY":        "700px",
	"scrollCollapse": true,
	"paging":         false, */
    "pageLength": 110,
    "lengthMenu": [[110, 220, 330, -1], [110, 220, 330, 'Todos']],
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "No hay datos disponibles en esta tabla",
        "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Registros del 0 al 0 de un total de 0",
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
    },
    "createdRow":function(row,data,index){
		if(data[0] == "0"){
		  $('td',row).css({
			'background-color':'#52BE80',
			'color':'black'
		  })
		}else if (data[0] == "1"){
		  $('td',row).css({
			'background-color':'#52BEB4',
			'color':'black'
		  })
		}else if(data[0] == "2"){
		  $('td',row).css({
			'background-color':'#FF6868',
			'color':'black'
		  })
		}else if(data[0] == "3"){
		  $('td',row).css({
			'background-color':'#5F86F8',
			'color':'black'
		  })
		}else if(data[0] == "4"){
		  $('td',row).css({
			'background-color':'#CCF459',
			'color':'black'
		  })
		}else if(data[0] == "5"){
		  $('td',row).css({
			'background-color':'#AAE1FF',
			'color':'black'
		  })
		}else if(data[0] == "6"){
		  $('td',row).css({
			'background-color':'#DDDAD6',
			'color':'black'
		  })
		}else if(data[0] == "7"){
		  $('td',row).css({
			'background-color':'#FFCFE8',
			'color':'black'
		  })
		}else if(data[0] == "8"){
		  $('td',row).css({
			'background-color':'#F5FAA5',
			'color':'black'
		  })
		}else if(data[0] == "9"){
		  $('td',row).css({
			'background-color':'#DFB6F9',
			'color':'black'
		  })
		}

	  }
});

$("#tipoGasto").change(function(){

    var tipoGasto = $(this).val();
    //console.log(tipoGasto)

	var datos = new FormData();

	datos.append("tipoGasto", tipoGasto);
	
	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){
			//console.log(respuesta);
			$("#Area").find('option').remove();
			$("#Area").append("<option value=''> Seleccionar Área </option>");
			for (let i = 0; i < respuesta.length; i++) {
				
				$("#Area").append("<option value='"+respuesta[i]["cod_argumento"]+"'>"+respuesta[i]["cod_argumento"]+" - "+respuesta[i]["des_larga"]+"</option>");
				
			}
			$("#Area").selectpicker("refresh");
 
		}
  
	})    

})

$("#Area").change(function(){

    var area = $(this).val();
    var tipoGasto = $("#tipoGasto").val();
    //console.log(area,tipoGasto);

	var datos = new FormData();

	datos.append("area", area);
    datos.append("tipoGastoB", tipoGasto);
    
	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			//console.log('HOLA MUNDO',respuesta);
			$("#nuevoCod").val(respuesta["correlativo"]);
 
		}
  
	})     

})


$(".TablaCentroCostosResumen").DataTable({
    "ajax": "ajax/centrocostos/tabla-centrocostosresumen.ajax.php",
    "deferRender": true,
    "retrieve": true,
    "processing": true,
    "order": [[0, "asc"]],
    "pageLength": 110,
    "lengthMenu": [[110, 220, 330, -1], [110, 220, 330, 'Todos']],
	"fixedHeader": {
		"header": true,
		"footer": true
	},
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "No hay datos disponibles en esta tabla",
        "sInfo": "Registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Registros del 0 al 0 de un total de 0",
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
    },
    "createdRow":function(row,data,index){
		if(data[0] == "0"){
		  $('td',row).css({
			'background-color':'#52BE80',
			'color':'black'
		  })
		}else if (data[0] == "1"){
		  $('td',row).css({
			'background-color':'#52BEB4',
			'color':'black'
		  })
		}else if(data[0] == "2"){
		  $('td',row).css({
			'background-color':'#FF6868',
			'color':'black'
		  })
		}else if(data[0] == "3"){
		  $('td',row).css({
			'background-color':'#5F86F8',
			'color':'black'
		  })
		}else if(data[0] == "4"){
		  $('td',row).css({
			'background-color':'#CCF459',
			'color':'black'
		  })
		}else if(data[0] == "5"){
		  $('td',row).css({
			'background-color':'#AAE1FF',
			'color':'black'
		  })
		}else if(data[0] == "6"){
		  $('td',row).css({
			'background-color':'#DDDAD6',
			'color':'black'
		  })
		}else if(data[0] == "7"){
		  $('td',row).css({
			'background-color':'#FFCFE8',
			'color':'black'
		  })
		}else if(data[0] == "8"){
		  $('td',row).css({
			'background-color':'#F5FAA5',
			'color':'black'
		  })
		}else if(data[0] == "9"){
		  $('td',row).css({
			'background-color':'#DFB6F9',
			'color':'black'
		  })
		}

	},
	"drawCallback":function(){
		var api=this.api();
		$(api.column(5).footer()).html(
			api.column(5,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(6).footer()).html(
			api.column(6,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(7).footer()).html(
			api.column(7,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(8).footer()).html(
			api.column(8,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(9).footer()).html(
			api.column(9,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(10).footer()).html(
			api.column(10,{page:'current'}*-1).data().sum().toFixed(2)
		)
		$(api.column(11).footer()).html(
			api.column(11,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(12).footer()).html(
			api.column(12,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(13).footer()).html(
			api.column(13,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(14).footer()).html(
			api.column(14,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(15).footer()).html(
			api.column(15,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(16).footer()).html(
			api.column(16,{page:'current'}).data().sum().toFixed(2)
		)
		$(api.column(17).footer()).html(
			api.column(17,{page:'current'}).data().sum().toFixed(2)
		)
	}
});