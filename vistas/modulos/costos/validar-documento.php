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

</script>