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
			'background-color':'#F4596F',
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


$(".TablaGastosCaja").DataTable({
    ajax: "ajax/centrocostos/tabla-gastos-caja.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    order: [[0, "desc"]],
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
    },
    "createdRow":function(row,data,index){
		if(data[4] == "94"){
		  $('td',row).eq(4).css({
			'background-color':'#52BE80',
			'color':'black'
		  })
		}else if (data[4] == "95"){
		  $('td',row).eq(4).css({
			'background-color':'#52BEB4',
			'color':'black'
		  })
		}else if(data[4] == "92"){
		  $('td',row).eq(4).css({
			'background-color':'#F4596F',
			'color':'black'
		  })
		}else if(data[4] == "97"){
		  $('td',row).eq(4).css({
			'background-color':'#5F86F8',
			'color':'black'
		  })
		}else if(data[4] == "60"){
		  $('td',row).eq(4).css({
			'background-color':'#CCF459',
			'color':'black'
		  })
		}else if(data[4] == "10"){
		  $('td',row).eq(4).css({
			'background-color':'#AAE1FF',
			'color':'black'
		  })
		}else if(data[4] == "11"){
		  $('td',row).eq(4).css({
			'background-color':'#DDDAD6',
			'color':'black'
		  })
		}else if(data[4] == "12"){
		  $('td',row).eq(4).css({
			'background-color':'#FFCFE8',
			'color':'black'
		  })
		}else if(data[4] == "13"){
		  $('td',row).eq(4).css({
			'background-color':'#F5FAA5',
			'color':'black'
		  })
		}else if(data[4] == "14"){
		  $('td',row).eq(4).css({
			'background-color':'#DFB6F9',
			'color':'black'
		  })
		}

		if(data[9] == "POR RENDIR"){
			$('td',row).eq(9).css({
			  'background-color':'#F5F106',
			  'color':'black'
			})
		  }

	  }

  });