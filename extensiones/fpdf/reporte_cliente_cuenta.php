<?php

require_once "../../controladores/cuentas.controlador.php";
require_once "../../modelos/cuentas.modelo.php";

require('fpdf.php');

class PDF extends FPDF
{
// Page header


function Header()
{
    $this->AddFont('Lucida','','lucida-console.php');
    // Arial bold 15
    $this->SetFont('Lucida','',7);
    // Move to the right
    // Title
    $this->Cell(50,5,utf8_decode('CORPORACIÓN VASCORP S.A.C'),0,0,'C');

    $this->Cell(250,5,'FECHA:17/03/2021',0,0,'C');
    // Line break
    $this->Ln(3);

    $this->Cell(200,5,'DOCUMENTOS POR COBRAR - 17/03/2021',0,0,'C');

    $this->Ln(5);

    $this->Cell(200,5,'TIPO     NRO. DOC.        FECHA     VENCIMIEN  VEND.    DOC. ORIGINAL     ESTADO    BANCO      NRO. UNICO          TOTAL S/     PROT.',0,0,'C');
    $this->Ln(3);
    $this->Cell(200,5,'====================================================================================================================================',0,0,'C');
    $this->Ln(3);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo(),0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


//campos de GET
$consulta= $_GET["consulta"];
$orden1= $_GET["orden1"];
$orden2= $_GET["orden2"];
$tip_doc= $_GET["tip_doc"];
$cli= $_GET["cli"];
$banco= $_GET["banco"];
$inicio= $_GET["inicio"];
$fin= $_GET["fin"];
if($consulta== 'pendiente'){
    if(empty($cli)){
        
        $clienteSaldo=ControladorCuentas::ctrMostrarClientesSaldo($cli,$vend);
        foreach($clienteSaldo as $key1 => $value1) {
            $pdf->Cell(15,10,'Cliente:',0,0);
            $pdf->Cell(12,10,$value1["cliente"],0,0);
            $pdf->Cell(50,10,$value1["nombre"],0,1);

            $cuentas=ControladorCuentas::ctrMostrarReporteCobrar($orden1,$orden2,$tip_doc,$value1["cliente"],$vend,$banco);
            foreach ($cuentas as $key => $value) {

                $pdf->Cell(10,10,$value["tipo_doc"],0,0);
                $pdf->Cell(20,10,$value["num_cta"],0,0);
                $pdf->Cell(20,10,$value["fecha"],0,0);
                $pdf->Cell(20,10,$value["fecha_ven"],0,0);
                $pdf->Cell(10,10,$value["vendedor"],0,0);
                $pdf->Cell(30,10,$value["doc_origen"],0,0);
                $pdf->Cell(20,10,$value["estado"],0,0);
                $pdf->Cell(20,10,$value["banco"],0,0);
                $pdf->Cell(20,10,$value["num_unico"],0,0);
                $pdf->Cell(20,10,$value["saldo"],0,0);
                $pdf->Cell(10,10,$value["protesta"],0,1);
            }

        }

    }else {
        $cuentas=ControladorCuentas::ctrMostrarReporteCobrar($orden1,$orden2,$tip_doc,$cli,$vend,$banco);
        $cliente=ControladorCuentas::ctrMostrarReporteNombre($cli,$vend);
        $total= ControladorCuentas::ctrMostrarReporteTotalCobrar($orden1,$orden2,$tip_doc,$cli,$vend,$banco);
    }
}else if($consulta== 'pendienteVencidoMenor'){
    
}else if($consulta== 'pendienteVencidoMayor'){
    
}else if($consulta== 'procesado'){

}else if($consulta== 'estadoEnvioVacio'){
    
}else if($consulta== 'unicoCartera'){
    
}else if($consulta== 'cancelado'){
    
}else if($consulta== 'fechaSaldo'){
    
}else if($consulta== 'pagos'){
    
}else if($consulta== 'fechaActualSaldo'){
    
}

// for($i=1;$i<=40;$i++)
//     $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>