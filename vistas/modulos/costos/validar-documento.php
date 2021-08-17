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

                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" id="buscador" name="buscador" onkeypress="pulsar(event)" placeholder="RUC|" autofocus>
                            </div>
                            <br>

                            <div class="col-lg-4">

                                <label>Tipo</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Tipo Documento" readonly>

                            </div>  

                            <div class="col-lg-4">

                                <label>Serie</label>
                                <input type="text" class="form-control" id="serie" name="serie" placeholder="Serie" readonly>

                            </div>

                            <div class="col-lg-4">

                                <label>Doc</label>
                                <input type="text" class="form-control" id="documento" name="documento" placeholder="Documento" readonly>

                            </div>

                            <div class="col-lg-2">

                                <label>O.</label>
                                <input type="text" class="form-control" id="origen" name="origen" placeholder="O." readonly>

                            </div>      
                            
                            <div class="col-lg-2">

                                <label>Voucher</label>
                                <input type="text" class="form-control" id="voucher" name="voucher" placeholder="Voucher" readonly>

                            </div>              
                            
                            <div class="col-lg-2">

                                <label>Cuenta</label>
                                <input type="text" class="form-control" id="cuenta" name="cuenta" placeholder="Cuenta" readonly>

                            </div>                            
                            
                            <div class="col-lg-6">

                                <label>Descripcion</label>
                                <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Descripcion" readonly>

                            </div>      
                            
                            <div class="col-lg-4">

                                <label>Ruc</label>
                                <input type="text" class="form-control" id="ruc" name="ruc" placeholder="Ruc" readonly>

                            </div>           
                            
                            <div class="col-lg-8">

                                <label>Razon Social</label>
                                <input type="text" class="form-control" id="razon_social" name="razon_social" placeholder="Razon Social" readonly>

                            </div>          

                            <div class="col-lg-4">

                                <label>Fecha Emisión</label>
                                <input type="text" class="form-control" id="emision" name="emision" placeholder="Fecha Emisión" readonly>

                            </div>      
                            
                            <div class="col-lg-4">

                                <label>Fecha Vencimiento</label>
                                <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="Fecha Vencimiento" readonly>

                            </div> 
 
                            <div class="col-lg-4">

                                <label>Total S/</label>
                                <input type="text" class="form-control" id="total" name="total" placeholder="Total S/" readonly>

                            </div> 
                            
                            <div class="col-lg-4 form-group has-warning" id="comprA" name="comprA">

                                <label>Comprobante</label>
                                <input type="text" class="form-control" id="comprobante" name="comprobante" placeholder="Comprobante" readonly>

                            </div>     
                            
                            <div class="col-lg-4 form-group has-warning" id="contA" name="contA">

                                <label class="control-label">Contribuyente</label>
                                <input type="text" class="form-control" id="contribuyente" name="contribuyente" placeholder="Contribuyente" readonly>

                            </div>                  
                            
                            <div class="col-lg-4 form-group has-warning" id="condA" name="condA">

                                <label class="control-label">Condicion</label>
                                <input type="text" class="form-control" id="condicion" name="condicion" placeholder="Condicion" readonly>

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

        var va =   partes[0].trim();
        var vb =   partes[1].trim();

        var vc =   partes[2].trim();
        //console.log(vc.includes('-'));

        var vd =   partes[3].trim();
        var ve =   partes[4].trim();
        var vf =   partes[5].trim();
        var vg =   partes[6].trim();

        if(vc.includes('-') === true){

            var serie = vc.substring(0,vc.indexOf('-'));

            var num = vc.split('-');
            var numero = num[1].replace(/^(0+)/g, '');

            var ruc = va;
            var tipo = vb;
            var igv = vd;
            var total = ve;
            var fecha = vf;

        }else{

            var serie = vc;

            var numero = vd.replace(/^(0+)/g, '');;

            var ruc = va;
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

        }else{

            var dia = fec[2];
            var mes = fec[1];
            var ano = fec[0];

        }

        var emision = ano+'/'+mes+'/'+dia;
        //console.log(emision);

        console.log(ruc,'|',tipo,'|',serie,'|',numero,'|',igv,'|',total,'|',emision);

    }
}

</script>