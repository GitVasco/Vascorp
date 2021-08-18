<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Validar Documento

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Validar Documento</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-6">

                <div class="box box-primary">

                    <form role="form">

                        <div class="box-body">

                            <div class="col-lg-12 form-group has-default">
                                <label>BUSCADOR QR</label>
                                <input type="text" class="form-control" id="buscador" name="buscador" onkeypress="pulsar(event)" placeholder="Código QR" autofocus autocomplete="off">
                            </div>
                            <br>

                            <div class="col-lg-4 form-group has-default" id="tipoA" name="tipoA">

                                <label>Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo Documento" readonly>

                            </div>  

                            <div class="col-lg-4 form-group has-default" id="serieA" name="serieA">

                                <label>Serie</label>
                                <input type="text" class="form-control" id="serie" name="serie" placeholder="Serie" readonly>

                            </div>

                            <div class="col-lg-4 form-group has-default" id="numeroA" name="numeroA"> 

                                <label>Documento</label>
                                <input type="text" class="form-control" id="numero" name="numero" placeholder="Documento" readonly>

                            </div>

                            <div class="col-lg-2 form-group has-default" id="origenA" name="origenA">

                                <label>O.</label>
                                <input type="text" class="form-control" id="origen" name="origen" placeholder="O." readonly>

                            </div>      
                            
                            <div class="col-lg-2 form-group has-default" id="voucherA" name="voucherA">

                                <label>Voucher</label>
                                <input type="text" class="form-control" id="voucher" name="voucher" placeholder="Voucher" readonly>

                            </div>              
                            
                            <div class="col-lg-4 form-group has-default" id="conceptoA" name="conceptoA">

                                <label>Descripcion</label>
                                <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Descripcion" readonly>

                            </div>    
                            
                            <div class="col-lg-2 form-group has-default" id="monedaA" name="monedaA">

                                <label>M</label>
                                <input type="text" class="form-control" id="moneda" name="moneda" placeholder="S/D" readonly>

                            </div>  
                            
                            <div class="col-lg-2 form-group has-default" id="cambioA" name="cambioA">

                                <label>T/C</label>
                                <input type="text" class="form-control" id="cambio" name="cambio" placeholder="T. Cambio" readonly>

                            </div>                              
                            
                            <div class="col-lg-4 form-group has-default" id="rucA" name="rucA">

                                <label>Ruc</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" placeholder="Ruc" readonly>

                            </div>           
                            
                            <div class="col-lg-8 form-group has-default" id="razonA" name="razonA">

                                <label>Razon Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Razon Social" readonly>

                            </div>          

                            <div class="col-lg-4 form-group has-default" id="emisionA" name="emisionA">

                                <label>Fecha Emisión</label>
                                <input type="text" class="form-control" id="emision" name="emision" placeholder="Fecha Emisión" readonly>

                            </div>      
                            
                            <div class="col-lg-4 form-group has-default" id="vencimientoA" name="vencimientoA">

                                <label>Fecha Vencimiento</label>
                                <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="Fecha Vencimiento" readonly>

                            </div> 
 
                            <div class="col-lg-2 form-group has-default" id="totalSA" name="totalSA">

                                <label>Total S/</label>
                                <input type="text" class="form-control" id="totalS" name="totalS" placeholder="Total S/" readonly>

                            </div> 

                            <div class="col-lg-2 form-group has-default" id="totalDA" name="totalDA">

                                <label>Total $</label>
                                <input type="text" class="form-control" id="totalD" name="totalD" placeholder="Total $" readonly>

                            </div>                             
                            
                            <div class="col-lg-4 form-group has-default" id="comprA" name="comprA">

                                <label>Comprobante</label>
                                <input type="text" class="form-control" id="comprobante" name="comprobante" placeholder="Comprobante" readonly>

                            </div>     
                            
                            <div class="col-lg-4 form-group has-default" id="contA" name="contA">

                                <label class="control-label">Contribuyente</label>
                                <input type="text" class="form-control" id="contribuyente" name="contribuyente" placeholder="Contribuyente" readonly>

                            </div>                  
                            
                            <div class="col-lg-4 form-group has-default" id="condA" name="condA">

                                <label class="control-label">Condicion</label>
                                <input type="text" class="form-control" id="condicion" name="condicion" placeholder="Condicion" readonly>

                            </div>     
                            
                            <button type="button" class="btn btn-success pull-right" onClick="window.location.reload();">Actualizar página</button>
                        </div>

                    </form>

                </div>

            </div>

            <div class="col-md-6">

                <div class="box box-success">

                    <form role="form">

                        <div class="box-body">

                            <div class="col-lg-4 form-group has-default">

                                <div class="input-group">
                                    <label>RUC</label>
                                    <input type="text" class="form-control" id="rucS" name="rucS" placeholder="RUC" autocomplete="off">
                                </div>

                            </div>

                            <div class="col-lg-4 form-group has-default">

                                <div class="input-group">
                                    <label>Serie</label>
                                    <input type="text" class="form-control" id="serieS" name="serieS" placeholder="SERIE" autocomplete="off">
                                </div>

                            </div>
                            
                            <div class="col-lg-4 form-group has-default">

                                <div class="input-group">
                                    <label>Numero</label>
                                    <input type="text" class="form-control" id="numeroS" name="numeroS"  onkeypress="pulsarB(event)" placeholder="NUMERO" autocomplete="off">
                                </div>

                            </div>                            
                            <br>

                            <div class="col-lg-4 form-group has-default" id="tipoS" name="tipoS">

                                <label>Tipo</label>
                                <input type="text" class="form-control" id="tipoB" name="tipoB" placeholder="Tipo Documento" readonly>

                            </div>  

                            <div class="col-lg-4 form-group has-default" id="serieAS" name="serieAS">

                                <label>Serie</label>
                                <input type="text" class="form-control" id="serieB" name="serieB" placeholder="Serie" readonly>

                            </div>

                            <div class="col-lg-4 form-group has-default" id="numeroAS" name="numeroAS"> 

                                <label>Documento</label>
                                <input type="text" class="form-control" id="numeroB" name="numeroB" placeholder="Documento" readonly>

                            </div>

                            <div class="col-lg-2 form-group has-default" id="origenS" name="origenS">

                                <label>O.</label>
                                <input type="text" class="form-control" id="origenB" name="origenB" placeholder="O." readonly>

                            </div>      
                            
                            <div class="col-lg-2 form-group has-default" id="voucherS" name="voucherS">

                                <label>Voucher</label>
                                <input type="text" class="form-control" id="voucherB" name="voucherB" placeholder="Voucher" readonly>

                            </div>              
                            
                            <div class="col-lg-4 form-group has-default" id="conceptoS" name="conceptoS">

                                <label>Descripcion</label>
                                <input type="text" class="form-control" id="conceptoB" name="conceptoB" placeholder="Descripcion" readonly>

                            </div>    
                            
                            <div class="col-lg-2 form-group has-default" id="monedaS" name="monedaS">

                                <label>M</label>
                                <input type="text" class="form-control" id="monedaB" name="monedaB" placeholder="S/D" readonly>

                            </div>  
                            
                            <div class="col-lg-2 form-group has-default" id="cambioS" name="cambioS">

                                <label>T/C</label>
                                <input type="text" class="form-control" id="cambioB" name="cambioB" placeholder="T. Cambio" readonly>

                            </div>                              
                            
                            <div class="col-lg-4 form-group has-default" id="rucAS" name="rucAS">

                                <label>Ruc</label>
                                <input type="text" class="form-control" id="rucB" name="rucB" placeholder="Ruc" readonly>

                            </div>           
                            
                            <div class="col-lg-8 form-group has-default" id="razonAS" name="razonAS">

                                <label>Razon Social</label>
                                <input type="text" class="form-control" id="razon_socialB" name="razon_socialB" placeholder="Razon Social" readonly>

                            </div>          

                            <div class="col-lg-4 form-group has-default" id="emisionS" name="emisionS">

                                <label>Fecha Emisión</label>
                                <input type="text" class="form-control" id="emisionB" name="emisionB" placeholder="Fecha Emisión" readonly>

                            </div>      
                            
                            <div class="col-lg-4 form-group has-default" id="vencimientoS" name="vencimientoS">

                                <label>Fecha Vencimiento</label>
                                <input type="text" class="form-control" id="vencimientoB" name="vencimientoB" placeholder="Fecha Vencimiento" readonly>

                            </div> 
 
                            <div class="col-lg-2 form-group has-default" id="totalSS" name="totalSS">

                                <label>Total S/</label>
                                <input type="text" class="form-control" id="totalSB" name="totalSB" placeholder="Total S/" readonly>

                            </div> 

                            <div class="col-lg-2 form-group has-default" id="totalDS" name="totalDS">

                                <label>Total $</label>
                                <input type="text" class="form-control" id="totalDB" name="totalDB" placeholder="Total $" readonly>

                            </div>                             
                            
                            <div class="col-lg-4 form-group has-default" id="comprS" name="comprS">

                                <label>Comprobante</label>
                                <input type="text" class="form-control" id="comprobanteB" name="comprobanteB" placeholder="Comprobante" readonly>

                            </div>     
                            
                            <div class="col-lg-4 form-group has-default" id="contS" name="contS">

                                <label class="control-label">Contribuyente</label>
                                <input type="text" class="form-control" id="contribuyenteB" name="contribuyenteB" placeholder="Contribuyente" readonly>

                            </div>                  
                            
                            <div class="col-lg-4 form-group has-default" id="condS" name="condS">

                                <label class="control-label">Condicion</label>
                                <input type="text" class="form-control" id="condicionB" name="condicionB" placeholder="Condicion" readonly>

                            </div>     
                            
                            <button type="button" class="btn btn-success pull-left" onClick="window.location.reload();">Actualizar página</button>

                        </div>
                            
                    </form>

                </div>

            </div>            

        </div>

    </section>

</div>

<script>
    window.document.title = "Validar Documentos";

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

        }

    }    

</script>