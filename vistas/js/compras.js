$(".TablaRegCompras").DataTable({

	"ajax": "ajax/centrocostos/tabla-reg_compras.ajax.php",
	"deferRender": true,
	"retrieve": true,
	"processing": true,
	"order": [[3, "asc"]],
	"pageLength": 20,
	"lengthMenu": [[20, 40, 60, -1], [20, 40, 60, 'Todos']],
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
	}

});

$(".generarTxt").click(function(){

	var estado = 'SI';
	console.log(estado);

	// Capturamos el id de la orden de compra
	swal({
        title: '¿Desea generar *.txt?',
        text: "¡Puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, generar *.txt!'
    }).then(function (result) {

	if (result.value) {

		window.location = "index.php?ruta=compras-reg&estado="+estado;

	}
	})

})


$(".TablaRegCompras").on("click","button.btnConsultarEstadoCompra",function(){

	var tipo = $(this).attr("tipo");
	var ruc = $(this).attr("ruc");
	var serie = $(this).attr("serie");
	var correlativo = $(this).attr("correlativo");
	var emision = $(this).attr("fecha");
	var monto = $(this).attr("monto");
	var tipoEmision = serie.substring(0,1);
	if(tipoEmision == "0" || tipoEmision == "1"){
		monto="";
	}
	
	var datos = new FormData();
  
	datos.append("tipoConsulta",tipo);
	datos.append("rucConsulta",ruc);
	datos.append("serieConsulta",serie);
	datos.append("correlativoConsulta",correlativo);
	datos.append("emisionConsulta",emision);
	datos.append("montoConsulta",monto);
  
	$.ajax({
  
	  url:"ajax/facturacion.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
	  contentType: false,
	  processData: false,
	  dataType:"json",
	  success:function(respuesta){
		// console.log(respuesta);
		if(respuesta["success"] == true){
			
				var datos2=new FormData();
				datos2.append("ruc",ruc);
				datos2.append("serie",serie);
				datos2.append("correlativo",correlativo);
				
				if(respuesta["data"]["estadoCp"] == "1"){
				
					var msjComp = "ACEPTADO";
					var tipoMsjComp = "success";

				}else if(respuesta["data"]["estadoCp"] == "3"){

					var msjComp = "AUTORIZADO";
					var tipoMsjComp = "success";
				
				}else if(respuesta["data"]["estadoCp"] == "2"){
			
					var msjComp = "ANULADO";
					var tipoMsjComp = "error";

				}else{
					
					var msjComp = "NO EXISTE";
					var tipoMsjComp = "error";
				}

				if(respuesta["data"]["estadoRuc"] == "00"){
				
					var msjcontri = "ACTIVO";
					var tipoMsjCont = "success";

				}else{
				
					var msjcontri = "-";
					var tipoMsjCont = "error";

				}

				if(respuesta["data"]["condDomiRuc"] == "00"){
					
					var msjdomi = "HABIDO";
					var tipoMsjDomi = "success";
				
				}else{
					
					var msjdomi = "-";
					var tipoMsjDomi = "error";

				}

				datos2.append("comprobante",msjComp);
				datos2.append("contribuyente",msjcontri);
				datos2.append("domicilio",msjdomi);
				$.ajax({
					url:"ajax/compras.ajax.php",
					type:"POST",
					data:datos2,
					cache:false,
					contentType:false,
					processData:false,
					success:function(respuesta2){
						$(".TablaRegCompras").DataTable().ajax.reload(null,false);
					}

				})
			  
			  Command: toastr[tipoMsjComp]("Estado del comprobante : "+msjComp);
			  Command: toastr[tipoMsjCont]("Estado del contribuyente : "+msjcontri);
			  Command: toastr[tipoMsjDomi]("Condicion de domicilio : "+msjdomi);
  
			
	
		}else if(respuesta["message"] == "Unauthorized"){
		  Command: toastr["error"]("Por favor, generar token!");
		}else{
		  Command: toastr["error"]("Error al ingresar los campos requeridos!");
		}
		
	  }
	})
  });
  

function pulsar(e) {

	if (e.keyCode === 13 && !e.shiftKey) {
		e.preventDefault();

		var buscador = document.getElementById("buscador").value;
		var partes = buscador.split('|');
		//console.log(partes)

		var va =   partes[0].trim(); //ruc
		var vb =   partes[1].trim(); //tipo

		var vc =   partes[2].trim(); // serie o serie-numero
		//console.log(vc.includes('-'));

		var vd =   partes[3].trim(); // numero
		var ve =   partes[4].trim(); //igv
		var vf =   partes[5].trim(); //total
		var vg =   partes[6].trim(); //emision

		if(vc.includes('-') === true){

			var serie = vc.substring(0,vc.indexOf('-'));

			var num = vc.split('-');
			var numero = num[1].replace(/^(0+)/g, '');

			var rucS = va;
			var tipo = vb;
			var igv = vd;
			var total = ve;
			var fecha = vf;

		}else{

			var serie = vc;

			var numero = vd.replace(/^(0+)/g, '');;

			var rucS = va;
			var tipo = vb;
			var igv = ve;
			var total = vf;
			var fecha = vg;

		}

		var fec = fecha.split(/[-/]/);

		if(fec[0].length == "2"){

			var dia = fec[0];
			var mes = fec[1];
			var ano = fec[2];

		}else if(fec[0].length == "4"){

			var dia = fec[2];
			var mes = fec[1];
			var ano = fec[0];

		}else{

			var dia = vg.substr(6,2);
			var mes = vg.substr(4,2);
			var ano = vg.substr(0,4);
			
		}

		var emision = ano+'-'+mes+'-'+dia;
		
		//console.log(rucS,'|',tipo,'|',serie,'|',numero,'|',igv,'|',total,'|',emision);

		var datos = new FormData();

		datos.append("rucS", rucS);
		datos.append("serie", serie);
		datos.append("numero", numero);

		$.ajax({

			url: "ajax/compras.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(respuesta){

				if(respuesta === false){

					Command: toastr["error"]("Documento no registrado");

				}else{

					//console.log(respuesta["comprobante"]);
					$("#tipo").val(respuesta["tipo"]);
					$("#serie").val(respuesta["serie_doc"]);
					$("#numero").val(respuesta["num_doc"]);
					$("#origen").val(respuesta["origen"]);
					$("#voucher").val(respuesta["voucher"]);
					$("#concepto").val(respuesta["concepto"]);
					$("#moneda").val(respuesta["moneda"]);
					$("#cambio").val(respuesta["tipo_cambio"]);
					$("#ruc").val(respuesta["ruc"]);
					$("#razon_social").val(respuesta["razon_social"]);
					$("#emision").val(respuesta["fecha_emision"]);
					$("#vencimiento").val(respuesta["fecha_vencimiento"]);
					$("#totalS").val(respuesta["totalFS"]);
					$("#totalD").val(respuesta["totalFD"]);
					$("#comprobante").val(respuesta["comprobante"]);
					$("#contribuyente").val(respuesta["contribuyente"]);
					$("#condicion").val(respuesta["condicion"]);                    

					if(respuesta["comprobante"] == "NO EXISTE"){

						$("#tipoA").removeClass("has-default");
						$("#tipoA").addClass("has-error");  

						$("#serieA").removeClass("has-default");
						$("#serieA").addClass("has-error");  

						$("#numeroA").removeClass("has-default");
						$("#numeroA").addClass("has-error"); 
						
						$("#origenA").removeClass("has-default");
						$("#origenA").addClass("has-error");       
						
						$("#voucherA").removeClass("has-default");
						$("#voucherA").addClass("has-error");       
						
						$("#conceptoA").removeClass("has-default");
						$("#conceptoA").addClass("has-error");       
						
						$("#monedaA").removeClass("has-default");
						$("#monedaA").addClass("has-error");       
						
						$("#cambioA").removeClass("has-default");
						$("#cambioA").addClass("has-error");       
						
						$("#rucA").removeClass("has-default");
						$("#rucA").addClass("has-error");       
						
						$("#razonA").removeClass("has-default");
						$("#razonA").addClass("has-error");       
						
						$("#emisionA").removeClass("has-default");
						$("#emisionA").addClass("has-error");   
						
						$("#vencimientoA").removeClass("has-default");
						$("#vencimientoA").addClass("has-error");   
						
						$("#totalSA").removeClass("has-default");
						$("#totalSA").addClass("has-error");   
						
						$("#totalDA").removeClass("has-default");
						$("#totalDA").addClass("has-error");   
						
						$("#comprA").removeClass("has-default");
						$("#comprA").addClass("has-error");   
						
						$("#contA").removeClass("has-default");
						$("#contA").addClass("has-error");   
						
						$("#condA").removeClass("has-default");
						$("#condA").addClass("has-error");   

					}else if(respuesta["comprobante"] == "ANULADO"){

						$("#tipoA").removeClass("has-default");
						$("#tipoA").addClass("has-error");  

						$("#serieA").removeClass("has-default");
						$("#serieA").addClass("has-error");  

						$("#numeroA").removeClass("has-default");
						$("#numeroA").addClass("has-error"); 
						
						$("#origenA").removeClass("has-default");
						$("#origenA").addClass("has-error");       
						
						$("#voucherA").removeClass("has-default");
						$("#voucherA").addClass("has-error");       
						
						$("#conceptoA").removeClass("has-default");
						$("#conceptoA").addClass("has-error");       
						
						$("#monedaA").removeClass("has-default");
						$("#monedaA").addClass("has-error");       
						
						$("#cambioA").removeClass("has-default");
						$("#cambioA").addClass("has-error");       
						
						$("#rucA").removeClass("has-default");
						$("#rucA").addClass("has-error");       
						
						$("#razonA").removeClass("has-default");
						$("#razonA").addClass("has-error");       
						
						$("#emisionA").removeClass("has-default");
						$("#emisionA").addClass("has-error");   
						
						$("#vencimientoA").removeClass("has-default");
						$("#vencimientoA").addClass("has-error");   
						
						$("#totalSA").removeClass("has-default");
						$("#totalSA").addClass("has-error");   
						
						$("#totalDA").removeClass("has-default");
						$("#totalDA").addClass("has-error");   
						
						$("#comprA").removeClass("has-default");
						$("#comprA").addClass("has-error");   
						
						$("#contA").removeClass("has-default");
						$("#contA").addClass("has-success");   
						
						$("#condA").removeClass("has-default");
						$("#condA").addClass("has-success");                          
						
					}else{

						$("#tipoA").removeClass("has-default");
						$("#tipoA").addClass("has-success");  

						$("#serieA").removeClass("has-default");
						$("#serieA").addClass("has-success");  

						$("#numeroA").removeClass("has-default");
						$("#numeroA").addClass("has-success"); 
						
						$("#origenA").removeClass("has-default");
						$("#origenA").addClass("has-warning");       
						
						$("#voucherA").removeClass("has-default");
						$("#voucherA").addClass("has-warning");       
						
						$("#conceptoA").removeClass("has-default");
						$("#conceptoA").addClass("has-warning");       
						
						$("#monedaA").removeClass("has-default");
						$("#monedaA").addClass("has-warning");       
						
						$("#cambioA").removeClass("has-default");
						$("#cambioA").addClass("has-warning");       
						
						$("#rucA").removeClass("has-default");
						$("#rucA").addClass("has-success");       
						
						$("#razonA").removeClass("has-default");
						$("#razonA").addClass("has-success");       

						if(emision == respuesta["fecha_emision"]){

							$("#emisionA").removeClass("has-default");
							$("#emisionA").addClass("has-success"); 

						}else{

							$("#emisionA").removeClass("has-default");
							$("#emisionA").addClass("has-error");

						}
						
						$("#vencimientoA").removeClass("has-default");
						$("#vencimientoA").addClass("has-warning");  

						if(total == respuesta["totalS"] || total == respuesta["totalD"]){

							$("#totalSA").removeClass("has-default");
							$("#totalSA").addClass("has-success");   
							
							$("#totalDA").removeClass("has-default");
							$("#totalDA").addClass("has-success"); 

						}else{

							$("#totalSA").removeClass("has-default");
							$("#totalSA").addClass("has-error");   
							
							$("#totalDA").removeClass("has-default");
							$("#totalDA").addClass("has-error");  

						} 
						

						
						$("#comprA").removeClass("has-default");
						$("#comprA").addClass("has-success");   
						
						$("#contA").removeClass("has-default");
						$("#contA").addClass("has-success");   
						
						$("#condA").removeClass("has-default");
						$("#condA").addClass("has-success");                        

					}


				}            

			}

		})

	}else if(e.keyCode === 32 && !e.shiftKey){

		window.location.reload();

	}
	
}

function pulsarB(e) {

	if (e.keyCode === 13 && !e.shiftKey) {
		e.preventDefault();

		var rucS = document.getElementById("rucS").value;
		var serieS = document.getElementById("serieS").value;
		var numeroS = document.getElementById("numeroS").value;
		//console.log(rucS,serieS,numeroS);

		var buscador = rucS+'|01|'+serieS+'|'+numeroS;
		//console.log(buscador);
		var partes = buscador.split('|');

		var va =   partes[0].trim(); //ruc
		var vb =   partes[1].trim(); //tipo
		var vc =   partes[2].trim(); // serie
		var vd =   partes[3].trim(); // numero  

		var datos = new FormData();

		datos.append("rucS", rucS);
		datos.append("serie", serieS);
		datos.append("numero", numeroS);

		$.ajax({

			url: "ajax/compras.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function(respuesta){
				
				if(respuesta === false){

					Command: toastr["error"]("Documento no registrado");

				}else{

					//console.log(respuesta);
					$("#tipoB").val(respuesta["tipo"]);
					$("#serieB").val(respuesta["serie_doc"]);
					$("#numeroB").val(respuesta["num_doc"]);
					$("#origenB").val(respuesta["origen"]);
					$("#voucherB").val(respuesta["voucher"]);
					$("#conceptoB").val(respuesta["concepto"]);
					$("#monedaB").val(respuesta["moneda"]);
					$("#cambioB").val(respuesta["tipo_cambio"]);
					$("#rucB").val(respuesta["ruc"]);
					$("#razon_socialB").val(respuesta["razon_social"]);
					$("#emisionB").val(respuesta["fecha_emision"]);
					$("#vencimientoB").val(respuesta["fecha_vencimiento"]);
					$("#totalSB").val(respuesta["totalFS"]);
					$("#totalDB").val(respuesta["totalFD"]);
					$("#comprobanteB").val(respuesta["comprobante"]);
					$("#contribuyenteB").val(respuesta["contribuyente"]);
					$("#condicionB").val(respuesta["condicion"]);  
					
					if(respuesta["comprobante"] == "NO EXISTE"){

						$("#tipoS").removeClass("has-default");
						$("#tipoS").addClass("has-error");  

						$("#serieAS").removeClass("has-default");
						$("#serieAS").addClass("has-error");  

						$("#numeroAS").removeClass("has-default");
						$("#numeroAS").addClass("has-error"); 
						
						$("#origenS").removeClass("has-default");
						$("#origenS").addClass("has-error");       
						
						$("#voucherS").removeClass("has-default");
						$("#voucherS").addClass("has-error");       
						
						$("#conceptoS").removeClass("has-default");
						$("#conceptoS").addClass("has-error");       
						
						$("#monedaS").removeClass("has-default");
						$("#monedaS").addClass("has-error");       
						
						$("#cambioS").removeClass("has-default");
						$("#cambioS").addClass("has-error");       
						
						$("#rucAS").removeClass("has-default");
						$("#rucAS").addClass("has-error");       
						
						$("#razonAS").removeClass("has-default");
						$("#razonAS").addClass("has-error");       
						
						$("#emisionS").removeClass("has-default");
						$("#emisionS").addClass("has-error");   
						
						$("#vencimientoS").removeClass("has-default");
						$("#vencimientoS").addClass("has-error");   
						
						$("#totalSS").removeClass("has-default");
						$("#totalSS").addClass("has-error");   
						
						$("#totalDS").removeClass("has-default");
						$("#totalDS").addClass("has-error");   
						
						$("#comprS").removeClass("has-default");
						$("#comprS").addClass("has-error");   
						
						$("#contS").removeClass("has-default");
						$("#contS").addClass("has-error");   
						
						$("#condS").removeClass("has-default");
						$("#condS").addClass("has-error");   

					}else if(respuesta["comprobante"] == "ANULADO"){

						$("#tipoS").removeClass("has-default");
						$("#tipoS").addClass("has-error");  

						$("#serieAS").removeClass("has-default");
						$("#serieAS").addClass("has-error");  

						$("#numeroAS").removeClass("has-default");
						$("#numeroAS").addClass("has-error"); 
						
						$("#origenS").removeClass("has-default");
						$("#origenS").addClass("has-error");       
						
						$("#voucherS").removeClass("has-default");
						$("#voucherS").addClass("has-error");       
						
						$("#conceptoS").removeClass("has-default");
						$("#conceptoS").addClass("has-error");       
						
						$("#monedaS").removeClass("has-default");
						$("#monedaS").addClass("has-error");       
						
						$("#cambioS").removeClass("has-default");
						$("#cambioS").addClass("has-error");       
						
						$("#rucAS").removeClass("has-default");
						$("#rucAS").addClass("has-error");       
						
						$("#razonAS").removeClass("has-default");
						$("#razonAS").addClass("has-error");       
						
						$("#emisionS").removeClass("has-default");
						$("#emisionS").addClass("has-error");   
						
						$("#vencimientoS").removeClass("has-default");
						$("#vencimientoS").addClass("has-error");   
						
						$("#totalSS").removeClass("has-default");
						$("#totalSS").addClass("has-error");   
						
						$("#totalDS").removeClass("has-default");
						$("#totalDS").addClass("has-error");   
						
						$("#comprS").removeClass("has-default");
						$("#comprS").addClass("has-error");   
						
						$("#contS").removeClass("has-default");
						$("#contS").addClass("has-success");   
						
						$("#cond").removeClass("has-default");
						$("#cond").addClass("has-success");                          
						
					}else{

						$("#tipoS").removeClass("has-default");
						$("#tipoS").addClass("has-success");  

						$("#serieAS").removeClass("has-default");
						$("#serieAS").addClass("has-success");  

						$("#numeroAS").removeClass("has-default");
						$("#numeroAS").addClass("has-success"); 
						
						$("#origenS").removeClass("has-default");
						$("#origenS").addClass("has-warning");       
						
						$("#voucherS").removeClass("has-default");
						$("#voucherS").addClass("has-warning");       
						
						$("#conceptoS").removeClass("has-default");
						$("#conceptoS").addClass("has-warning");       
						
						$("#monedaS").removeClass("has-default");
						$("#monedaS").addClass("has-warning");       
						
						$("#cambioS").removeClass("has-default");
						$("#cambioS").addClass("has-warning");       
						
						$("#rucAS").removeClass("has-default");
						$("#rucAS").addClass("has-success");       
						
						$("#razonAS").removeClass("has-default");
						$("#razonAS").addClass("has-success");       

						$("#emisionS").removeClass("has-default");
						$("#emisionS").addClass("has-success"); 

						$("#vencimientoS").removeClass("has-default");
						$("#vencimientoS").addClass("has-warning");  

						$("#totalSS").removeClass("has-default");
						$("#totalSS").addClass("has-success");   
						
						$("#totalDS").removeClass("has-default");
						$("#totalDS").addClass("has-success");                       

						$("#comprS").removeClass("has-default");
						$("#comprS").addClass("has-success");   
						
						$("#contS").removeClass("has-default");
						$("#contS").addClass("has-success");   
						
						$("#condS").removeClass("has-default");
						$("#condS").addClass("has-success");                        

					}                        
					
				}


			}  
		})                                

	}else if(e.keyCode === 32 && !e.shiftKey){

		window.location.reload();

	}

}   


