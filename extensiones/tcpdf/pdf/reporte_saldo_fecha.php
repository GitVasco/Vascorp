<?php

require_once "../../../controladores/cuentas.controlador.php";
require_once "../../../modelos/cuentas.modelo.php";


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
$fecha=new Datetime();
$fechaActual=$fecha->format("d / m / Y");
$fechaCabecera= "Fecha:".$fechaActual;
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $fecha=new Datetime();
        $fechaActual=$fecha->format("d/m/Y");
        $fechaCabecera= "Fecha:".$fechaActual;
        $this->SetFont('helvetica', 'B', 7);
        // Title
        $this->Cell(0, 8, 'CORPORACIÓN VASCO S.A.C.', 0, false, 'L', 0, '', 0, false, false, false );
        $this->Cell(0, 8, $fechaCabecera, 0, false, 'R', 0, '', 0, false, false, false );
        
        $this->Ln(2);
        $this->Cell(0, 15, 'Saldos a la fecha  - '.$_GET["fin"], 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(7);
        $this->Cell(0, 9, '                   Tipo                               Nro. doc.                      Fecha                            Fecha Ven.                  Doc. Original              Ven                                    Importe S/                                 ', 0, 1, 'C', 0, '', 0, false, false, false );
        
        $this->Cell(0, 0, '====================================================================================================================================', 0, 1, 'L', 0, '', 0, false, 'M', 'M' );

    }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

$pdf->AddPage('P','A4');
$pdf->setPage(1, true);


//parametros GET
/* $inicio= $_GET["inicio"];
$fin= $_GET["fin"]; */


if($_GET["inicio"] == ""){

    $inicio = $_GET["fin"];

}else{

    $inicio = $_GET["inicio"];
}

$fin= $_GET["fin"];

$estadoCta = ControladorCuentas::ctrSaldoFecha($inicio, $fin);
#var_dump($estadoCta);

// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('../../lucida-console.ttf', 'TrueTypeUnicode', '', 96);

// use the fontz
$pdf->SetFont($fontname, '', 7, '', false);
//---------------------------------------------------------


$pdf->SetFont($fontname, '', 7, '', false);

foreach($estadoCta as  $key => $value){

    if($value["tipo_doc"] == "00"){

        $bloque1 = '<table style="text-center" >
            <tbody>
                <tr>
                    <td>Cliente</td>
                    <td>'.$value["cliente"].'</td>
                    <td style="width:200px">'.$value["nombre"].'</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>';

        $pdf->writeHTML($bloque1, false, false, false, false, '');

    }

    if($value["tipo_doc"] != "00" && $value["tipo_doc"] != "99"){

        $bloque2 = '<table style="text-center" >
            <tbody>
                <tr>
                    <td>'.$value["tipo_doc"].'</td>
                    <td>'.$value["num_cta"].'</td>
                    <td>'.$value["fecha"].'</td>
                    <td>'.$value["fecha_ven"].'</td>
                    <td>'.$value["doc_origen"].'</td>
                    <td>'.$value["vendedor"].'</td>
                    <td style="text-align:right">'.number_format((float)$value["saldoFecha"],2).'</td>
                </tr>
            </tbody>
        </table>';

        $pdf->writeHTML($bloque2, false, false, false, false, '');

    }    

    if($value["tipo_doc"] == "99"){

        $bloque3 = '<table style="text-center" >
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">'.number_format((float)$value["saldoFecha"],2).'</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>                
            </tbody>
        </table>';

        $pdf->writeHTML($bloque3, false, false, false, false, '');

    }     



}





// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_cuenta.pdf');


