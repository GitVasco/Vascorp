$(".btnEne").click(function(){
	var mesG = document.getElementById("btnEne").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnFeb").click(function(){
	var mesG = document.getElementById("btnFeb").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnMar").click(function(){
	var mesG = document.getElementById("btnMar").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnAbr").click(function(){
	var mesG = document.getElementById("btnAbr").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnMay").click(function(){
	var mesG = document.getElementById("btnMay").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnJun").click(function(){
	var mesG = document.getElementById("btnJun").value;
	//console.log(mesG);

	  var datos = new FormData();
	  datos.append("mesG", mesG);

	  	$.ajax({
	
			url:"ajax/tablamaestra.ajax.php",
			method: "POST",
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType:"json",
			success:function(respuesta){
		  	
				//console.log(respuesta);
				document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
				document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
				document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
				document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

			}
	  
		})

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnJul").click(function(){
	var mesG = document.getElementById("btnJul").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnAgo").click(function(){
	var mesG = document.getElementById("btnAgo").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnSep").click(function(){
	var mesG = document.getElementById("btnSep").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnOct").click(function(){
	var mesG = document.getElementById("btnOct").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnNov").click(function(){
	var mesG = document.getElementById("btnNov").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	$(".btnDic").removeClass("btn-info");
	$(".btnDic").addClass("btn-default");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})
$(".btnDic").click(function(){
	var mesG = document.getElementById("btnDic").value;
	//console.log(mesG);

	var datos = new FormData();
	datos.append("mesG", mesG);

		$.ajax({
  
		  url:"ajax/tablamaestra.ajax.php",
		  method: "POST",
		  data: datos,
		  cache: false,
		  contentType: false,
		  processData: false,
		  dataType:"json",
		  success:function(respuesta){
			
			  //console.log(respuesta);
			  document.getElementById("saldoInicial").innerHTML=respuesta["saldo_inicial"];
			  document.getElementById("saldoIngreso").innerHTML=respuesta["ingresos"];
			  document.getElementById("saldoEgreso").innerHTML=respuesta["egresos"];
			  document.getElementById("saldoActual").innerHTML=respuesta["saldo_actual"];

		  }
	
	  })	

	$(".btnEne").removeClass("btn-info");
	$(".btnEne").addClass("btn-default");

	$(".btnFeb").removeClass("btn-info");
	$(".btnFeb").addClass("btn-default");

	$(".btnMar").removeClass("btn-info");
	$(".btnMar").addClass("btn-default");

	$(".btnAbr").removeClass("btn-info");
	$(".btnAbr").addClass("btn-default");

	$(".btnMay").removeClass("btn-info");
	$(".btnMay").addClass("btn-default");

	$(".btnJun").removeClass("btn-info");
	$(".btnJun").addClass("btn-default");

	$(".btnJul").removeClass("btn-info");
	$(".btnJul").addClass("btn-default");

	$(".btnAgo").removeClass("btn-info");
	$(".btnAgo").addClass("btn-default");

	$(".btnSep").removeClass("btn-info");
	$(".btnSep").addClass("btn-default");

	$(".btnOct").removeClass("btn-info");
	$(".btnOct").addClass("btn-default");

	$(".btnNov").removeClass("btn-info");
	$(".btnNov").addClass("btn-default");

	$(this).removeClass("btn-default");
	$(this).addClass("btn-info");

	localStorage.setItem("mesG", mesG);
	$(".TablaGastosCaja").DataTable().destroy();
	cargarTablaGastosCaja(localStorage.getItem("mesG"));
})

 //OBTENER DATOS POR RUC MEDIANTE LA API 
function ObtenerDatosRuc3(){
	
	var nuevoRuc = $("#nuevoRucProC, #editarRucProC").val();
	var tamano = nuevoRuc.length;
	// console.log(tamano);
	if(tamano == 8){
		var datos = new FormData();
		datos.append("nuevoDni",nuevoRuc);
		$.ajax({
			type: "POST",
			url: 'ajax/clientes.ajax.php',
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function( jsonx ) {
				// console.log(jsonx);
				if(jsonx["success"]==false){
					$('#nuevaRazPro').attr('readonly',false);
					$('#nuevaRazPro').val("");

					$('#editarRazPro').attr('readonly',false);
					$('#editarRazPro').val("");
					
				}else{
					$('#nuevaRazPro').val(jsonx["apellidoPaterno"]+" "+jsonx["apellidoMaterno"]+" "+jsonx["nombres"] );

					$('#editarRazPro').val(jsonx["apellidoPaterno"]+" "+jsonx["apellidoMaterno"]+" "+jsonx["nombres"] );
					
				}
			  
			}
		})
	}else if(tamano == 11){
		var datos = new FormData();
		datos.append("nuevoRuc",nuevoRuc);
		$.ajax({
			type: "POST",
			url: 'ajax/proveedor.ajax.php',
			data: datos,
			cache: false,
			contentType: false,
			processData: false,
			dataType: "json",
			success:function( jsonx ) {
				// console.log(jsonx);
				if(jsonx["success"]==false){
					$('#nuevaRazPro').attr('readonly',false);
					$('#nuevaRazPro').val("");

					$('#editarRazPro').attr('readonly',false);
					$('#editarRazPro').val("");
					
				}else{
					$('#nuevaRazPro').val(jsonx["razonSocial"]);

					$('#editarRazPro').val(jsonx["razonSocial"]);
				}
			  
			}
		})
	}else{
		
		$('#nuevaRazPro').attr('readonly',false);
		$('#nuevaRazPro').val("");

		$('#editarRazPro').attr('readonly',false);
		$('#editarRazPro').val("");

		Command: toastr["warning"]("DNI 8 digitos!");		
		Command: toastr["warning"]("RUC 11 digitos!");
	}
	
}

$("#nuevoCodCaja, #editarCodCaja").change(function(){

	var cod_caja = $(this).val();

	var datos = new FormData();

	datos.append("cod_caja", cod_caja);

	$.ajax({

		url:"ajax/centro-costos.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType:"json",
		success:function(respuesta){

			$("#editarGasto").val(respuesta["nombre_gasto"]);
			$("#editarArea").val(respuesta["nombre_area"]);
			$("#editarCaja").val(respuesta["descripcion"]);

			$("#gasto").val(respuesta["nombre_gasto"]);
			$("#area").val(respuesta["nombre_area"]);
			$("#caja").val(respuesta["descripcion"]);

			if(respuesta["tipo_gasto"] == "94"){

				document.getElementById("gasto").style.background = "#52BE80";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#52BE80";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#52BE80";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#52BE80";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BE80";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BE80";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "95"){

				document.getElementById("gasto").style.background = "#52BEB4";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#52BEB4";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#52BEB4";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#52BEB4";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BEB4";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BEB4";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "92"){

				document.getElementById("gasto").style.background = "#FF6868";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#FF6868";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#FF6868";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#FF6868";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#FF6868";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#FF6868";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "97"){

				document.getElementById("gasto").style.background = "#5F86F8";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#5F86F8";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#5F86F8";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#5F86F8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#5F86F8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#5F86F8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "60"){

				document.getElementById("gasto").style.background = "#CCF459";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#CCF459";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#CCF459";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#CCF459";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#CCF459";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#CCF459";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "10"){

				document.getElementById("gasto").style.background = "#AAE1FF";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#AAE1FF";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#AAE1FF";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#AAE1FF";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#AAE1FF";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#AAE1FF";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "11"){

				document.getElementById("gasto").style.background = "#DDDAD6";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#DDDAD6";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#DDDAD6";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#DDDAD6";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DDDAD6";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DDDAD6";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "12"){

				document.getElementById("gasto").style.background = "#FFCFE8";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#FFCFE8";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#FFCFE8";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#FFCFE8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#FFCFE8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#FFCFE8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "13"){

				document.getElementById("gasto").style.background = "#F5FAA5";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#F5FAA5";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#F5FAA5";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#F5FAA5";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#F5FAA5";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#F5FAA5";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}else if(respuesta["tipo_gasto"] == "14"){

				document.getElementById("gasto").style.background = "#DFB6F9";
				document.getElementById("gasto").style.color = "black";
				$("#gasto").css("font-weight","bold");

				document.getElementById("area").style.background = "#DFB6F9";
				document.getElementById("area").style.color = "black";
				$("#area").css("font-weight","bold");

				document.getElementById("caja").style.background = "#DFB6F9";
				document.getElementById("caja").style.color = "black";
				$("#caja").css("font-weight","bold");

				document.getElementById("editarGasto").style.background = "#DFB6F9";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DFB6F9";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DFB6F9";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");				

			}

		}
  
	}) 

})


/* 
*EDITAR GASTO
*/
$(".TablaGastosCaja tbody").on("click", "button.btnEditarGasto", function(){

	var idGasto = $(this).attr("idGasto");
	//console.log(idGasto);

	var datos = new FormData();
	datos.append("idGasto", idGasto);

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

			$("#id").val(respuesta["id"]);

			$("#editarFechaGasto").val(respuesta["fecha"]);
			$("#editarRecibo").val(respuesta["recibo"]);
			$("#editarSucursal").val(respuesta["sucursal"]);
			$("#editarSucursal").selectpicker("refresh");
			$("#editarRucProC").val(respuesta["ruc_proveedor"]);
			$("#editarRazPro").val(respuesta["proveedor"]);
			$("#editarTipo").val(respuesta["tipo_documento"]);
			$("#editarTipo").selectpicker("refresh");
			$("#editarDocumentoG").val(respuesta["documento"]);
			$("#editarCodCaja").val(respuesta["cod_caja"]);
			$("#editarCodCaja").selectpicker("refresh");
			$("#editarTotal").val(respuesta["total"]);
			$("#totalAntiguo").val(respuesta["total"]);

			$("#editarGasto").val(respuesta["nombre_gasto"]);
			$("#editarArea").val(respuesta["nombre_area"]);
			$("#editarCaja").val(respuesta["nom_caja"]);

			if(respuesta["tipo_gasto"] == "94"){

				document.getElementById("editarGasto").style.background = "#52BE80";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BE80";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BE80";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "95"){

				document.getElementById("editarGasto").style.background = "#52BEB4";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#52BEB4";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#52BEB4";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "92"){

				document.getElementById("editarGasto").style.background = "#FF6868";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#FF6868";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#FF6868";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "97"){

				document.getElementById("editarGasto").style.background = "#5F86F8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#5F86F8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#5F86F8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "60"){

				document.getElementById("editarGasto").style.background = "#CCF459";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#CCF459";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#CCF459";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "10"){

				document.getElementById("editarGasto").style.background = "#AAE1FF";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#AAE1FF";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#AAE1FF";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "11"){

				document.getElementById("editarGasto").style.background = "#DDDAD6";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DDDAD6";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DDDAD6";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "12"){

				document.getElementById("editarGasto").style.background = "#FFCFE8";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#FFCFE8";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#FFCFE8";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "13"){

				document.getElementById("editarGasto").style.background = "#F5FAA5";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#F5FAA5";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#F5FAA5";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}else if(respuesta["tipo_gasto"] == "14"){

				document.getElementById("editarGasto").style.background = "#DFB6F9";
				document.getElementById("editarGasto").style.color = "black";
				$("#editarGasto").css("font-weight","bold");

				document.getElementById("editarArea").style.background = "#DFB6F9";
				document.getElementById("editarArea").style.color = "black";
				$("#editarArea").css("font-weight","bold");

				document.getElementById("editarCaja").style.background = "#DFB6F9";
				document.getElementById("editarCaja").style.color = "black";
				$("#editarCaja").css("font-weight","bold");

			}
			
			$("#editarSolicitante").val(respuesta["solicitante"]);
			$("#editarDescripcion").val(respuesta["desc_salida"]);
			$("#editarRubro").val(respuesta["rubro_cancelacion"]);
			$("#editarObservacion").val(respuesta["observacion"]);



		}
  
	})	
})

$(".TablaGastosCaja").on("click",".btnAnularGasto",function(){
	var idGasto = $(this).attr("idGasto");
 
	// Capturamos el id de la orden de compra
	swal({
        title: '¿Está seguro de anular el gasto?',
        text: "¡Si no lo está puede cancelar la acción!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, anular gasto!'
    }).then(function (result) {

	if (result.value) {

		window.location = "index.php?ruta=gastos-caja&idGasto="+idGasto;

	}
	})

});