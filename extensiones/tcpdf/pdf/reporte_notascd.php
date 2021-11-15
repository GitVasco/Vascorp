<?php

require_once "../../../controladores/cuentas.controlador.php";
require_once "../../../modelos/cuentas.modelo.php";

require_once "../../../controladores/facturacion.controlador.php";
require_once "../../../modelos/facturacion.modelo.php";

require_once "../../cantidad_en_letras.php";


//REQUERIMOS LA CLASE TCPDF

require_once('tcpdf_include.php');
$fecha=new Datetime();
$fechaActual=$fecha->format("d / m / Y");
$fechaCabecera= "Fecha:".$fechaActual;

//parametros GET
$tipo = $_GET["tipo"];
$documento = $_GET["documento"];
$venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);



class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Set font
        $fecha=new Datetime();
        $fechaActual=$fecha->format("d/m/Y");
        $fechaCabecera= "Fecha:".$fechaActual;
        $this->SetFont('helvetica', 'B', 9);
        $tipo = $_GET["tipo"];
        $documento = $_GET["documento"];
        $venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);
        $documento2 =  substr($venta["documento"],0,4)."-".substr($venta["documento"],4,12);
        $image_file = K_PATH_IMAGES.'paloma_azul.png';
        $this->Image($image_file, 10, 10, 40, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

        $image_file = K_PATH_IMAGES.'jackyform_letras.png';
        $this->Image($image_file, 60, 10, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $this->MultiCell(15, 5, '', 0, 'C', 0, 0, '', '', true);

        $this->SetFont('helvetica', 'B', 9);
        if($tipo == 'E23'){
            $this->MultiCell(70, 35, 'RUC: 20513613939'."\n\n".'NOTAS DE DEBITO ELECTRONICA'."\n\n".'Nro.: '.$documento2.'   ', 1, 'C', 0, 0, '', '', true, 0, false, true, 35, 'M');
        }else{
            $this->MultiCell(70, 35, 'RUC: 20513613939'."\n\n".'NOTAS DE CREDITO ELECTRONICA'."\n\n".'Nro.: '.$documento2.'   ', 1, 'C', 0, 0, '', '', true, 0, false, true, 35, 'M');
        }
        
        // Title
        $this->Ln(13);
        $this->SetFont('helvetica', 'B', 9);
        $this->Cell(140, 0, 'Corporación Vasco S.A.C.', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->SetFont('helvetica', 'A', 8);
        $this->Cell(140, 0, 'Cal.Santo Toribio Nro. 259 - Urb Santa Luisa 1ra Etapa', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->Cell(140, 0, 'San Martin de Porres - Lima - Lima', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->Cell(140, 0, 'Telfs: 537-2501/536-4024 Cel 964570509 / 964543475', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->Cell(140, 0, 'Página Web: www.jackyform.com.pe', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->Cell(140, 0, 'Email: gerenciadeventas@jackyform.com.pe', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->Cell(150, 0, 'cuentascorrientes@jackyform.com.pe', 0, false, 'C', 0, '', 0, false, false, false );
        $this->Ln(4);
        $this->SetFont('helvetica', 'I', 9);
        $this->Cell(140, 0, 'Confecciones de Prendas de Ropa Interior', 0, false, 'C', 0, '', 0, false, false, false );
        

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'A', 8);
        // Page number
        $this->Cell(0, 10, 'Representación Impresa del Documento Electronico, consulte en www.efact.com', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Ln(4);
        $this->Cell(0, 10, 'Autorizado mediante Resolución de Intendencia No. 034005004177/SUNAT', 0, false, 'L', 0, '', 0, false, 'T', 'M');
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



// convert TTF font to TCPDF format and store it on the fonts folder
$fontname = TCPDF_FONTS::addTTFfont('../../lucida-console.ttf', 'TrueTypeUnicode', '', 96);

// use the font
$pdf->SetFont($fontname, 'Helvetica', 8, '', false);
//---------------------------------------------------------


$doc_origen = substr($venta["doc_origen"],0,4)."-".substr($venta["doc_origen"],4,12);
$texto =$venta["observacion"];

$monto_letra= CantidadEnLetra($venta["total"]);

// $bloque3 = <<<EOF

// <table  style="text-align:left;padding-top:90px">
// <tbody>
//     <tr><td></td></tr>
// </tbody>
// </table>
// <table>
//     <tr>
//         <td>
//         <table  style="text-align:left;padding-bottom:5px">
//             <tr>
//                 <td style="width:68px">Cliente:</td>
//                 <td style="width:140px">$venta[nombre]</td>
//             </tr>
//             <tr>
//                 <td style="width:68px">Direccion:</td>
//                 <td style="width:136px">$venta[direccion]</td>
                
//             </tr>
//             <tr>
//                 <td style="width:140px;text-align:right">$venta[nom_ubigeo]</td>
//             </tr>
//             <tr>
//                 <td style="width:68px">Ciudad:</td>
//                 <td style="width:140px">$venta[departamento]</td>
//             </tr>
//             <tr>
//                 <td style="width:68px">Nro DNI:</td>
//                 <td style="width:140px">$venta[dni]</td>
//             </tr>
//             <tr>
//                 <td style="width:68px">Cod Cliente:</td>
//                 <td style="width:140px">$venta[cliente]</td>
//             </tr>
//             <tr>
//                 <td style="width:68px">Vendedor:</td>
//                 <td style="width:140px">$venta[vendedor] $venta[nom_vendedor]</td>
//             </tr>
//         </table>
//         </td>
   
//         <td>
//         <table  style="text-align:left;padding-bottom:5px">
//             <tr>
//                 <td style="width:45px">Moneda:</td>
//                 <td style="width:140px;text-align:center">S/</td>
//                 <td style="width:30px">IGV:</td>
//                 <td style="width:30px">18%</td>
//             </tr>
//             <tr>
//                 <td style="width:68px">Tipo:</td>
//                 <td style="width:136px">Boleta de Ventas</td>
                
//             </tr>
//             <tr>
//                 <td style="width:68px">Referencia(s):</td>
//                 <td style="width:140px">$doc_origen</td>
//             </tr> 
//             <tr>
//                 <td style="width:68px">Tipo:</td>
//                 <td style="width:140px">Penalidades / otros conceptos</td>
//             </tr>
//             <tr>
//                 <td style="width:68px">Motivo:</td>
//                 <td style="width:140px">Penalidades / otros conceptos</td>
//             </tr>
//         </table>
//         </td>
//     </tr>
// </table>


// EOF;
// $pdf->writeHTML($bloque3, false, false, false, false, '');

// $bloque4 = <<<EOF
// <table  border="0.5px" style="text-align:center;">

//     <tr  >
//         <td>Fecha de emision <br> $venta[fecha]</td>
//         <td>Condición de Pago</td>  
//         <td>Orden de compra</td>  
//         <td>Fecha vencimiento</td>  
//         <td>N° Guia de Remisión</td>  
//     </tr>
    
// </table>
// <table ><tr><td></td></tr></table>
// <table border="0.5px" style="text-align:center;background-color:#ddd;padding:2px">
//     <tr>
//         <td>DESCRIPCIÓN</td>
//     </tr>
// </table>
// EOF;

// $pdf->writeHTML($bloque4, false, false, false, false, '');
        

// $bloque5 = <<<EOF
// <table><tr><td></td></tr></table>

//     <div>$texto</div>
        
    
    
// EOF;

// $pdf->writeHTML($bloque5, false, false, false, false, '');

// $bloque6 = <<<EOF
// <table><tr><td></td></tr></table>
// <table>

//     <tr>
//         <td style="width:300px">
        
//             <table style="border: 1px solid dark;padding:0px 3px"> 
//                 <tr>
//                     <td>Observaciones</td>
//                 </tr>
//                 <tr><td></td></tr>
//                 <tr><td></td></tr>
//                 <tr><td></td></tr>
//                 <tr><td></td></tr>
//                 <tr><td></td></tr>
//                 <tr><td></td></tr>
//                 <tr><td></td></tr>
//                 <tr><td></td></tr>
            
//             </table>
        
//         </td>

//         <td style="width:200px">

//             <table style="border: 1px solid dark;padding:0px 3px"> 
//                 <tr>
//                     <td style="text-align:left;width:100px">Op. Grabadas</td>
//                     <td style="text-align:center;width:40px">S/</td>
//                     <td style="text-align:right;width:60px">$venta[neto]</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left;width:150px">Op. Inafecta</td>
//                     <td style="text-align:right;width:50px">0.00</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left">Op. Exonerada</td>
//                     <td style="text-align:right">0.00</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left">Total Op. Gratuitas</td>
//                     <td style="text-align:right">0.00</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left">Descuentos Totales</td>
//                     <td style="text-align:right">0.00</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left">Sub Total</td>
//                     <td style="text-align:right">$venta[neto]</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left">ISC</td>
//                     <td style="text-align:right">0.00</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left">IGV   18%</td>
//                     <td style="text-align:right">$venta[igv]</td>
//                 </tr>
//                 <tr>
//                     <td style="text-align:left;width:100px">Total</td>
//                     <td style="text-align:center;width:40px">S/</td>
//                     <td style="text-align:right;width:60px">$venta[total]</td>
//                 </tr>
            
//             </table>
//         </td>
//     </tr>

// </table>

// EOF;

// $pdf->writeHTML($bloque6, false, false, false, false, '');

// // $style6 = array('width' => 0.25, 'cap' => 'butt', 'join' => 'miter', 'dash' =>0, 'color' => array(0, 0, 0));
// // $pdf->RoundedRect(10, 255, 190, 8, 4.0, '1111', null, $style6);
// $bloque7 = <<<EOF
// <table><tr><td></td></tr></table>
// <div style="border:1px solid blue;border-radius:10px; padding:10px">Sonvarios</div>
// <table><tr><td></td></tr></table>
// <table>
//     <tr>
//         <td style="width:300px">Cta. Recaudadora Bco. Credito: 191-1553564-0-64</td>
//         <td> CANCELADO</td>
//     </tr>
// </table>
// <table><tr><td></td></tr></table>
// <table>
//     <tr>
//         <td style="width:305px"></td>
//         <td>Lima, _______ de ______________ de _______</td>
//     </tr>
// </table>
// EOF;

// $pdf->writeHTML($bloque7, false, false, false, false, '');
$pdf->Ln(30);
$pdf->Cell(90, 10, 'Cliente:      '.$venta["nombre"], 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(60, 10, 'Moneda:              S/.', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(30, 10, 'IGV:       18%', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Ln(7);
$pdf->MultiCell(24, 5, 'Dirección:    ', 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(66, 5, $venta["direccion"], 0, 'L', 0, 0, '', '', true);
$pdf->MultiCell(90, 5, 'Tipo:           '.$venta["nom_tipo_doc"], 0, 'L', 0, 0, '', '', true );
$pdf->Ln(4);
$pdf->Cell(90, 10, 'Ciudad:       '.$venta["nom_ubigeo"], 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(60, 10, 'Referencias(s): '.$doc_origen, 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Ln(4);
$pdf->Cell(90, 10, 'Nro DNI:      '.$venta["dni"], 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(60, 10, 'Tipo:           '.$venta["nom_motivo"], 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Ln(4);
$pdf->Cell(90, 10, 'Cod. Cliente: '.$venta["cliente"], 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(60, 10, 'Motivo:         '.$venta["nom_motivo"], 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Ln(4);
$pdf->Cell(0, 10, 'Vendedor:     '.$venta["vendedor"]."-".$venta["nom_vendedor"], 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Ln(4);
$image_file = K_PATH_IMAGES.'bordes1.png';
$pdf->Image($image_file, 10, 90, 190, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Ln(0); 
$pdf->Cell(35, 10, 'Fecha de Emisión', 0, false, 'C', 0, '', 0, false, false, false );
$pdf->Cell(37, 10, 'Condición de Pago', 0, false, 'C', 0, '', 0, false, false, false );
$pdf->Cell(40, 10, 'Orden de Compra', 0, false, 'C', 0, '', 0, false, false, false );
$pdf->Cell(34, 10, 'Fecha de Vencimiento', 0, false, 'C', 0, '', 0, false, false, false );
$pdf->Cell(40, 10, 'No. Guia de Remisión', 0, false, 'C', 0, '', 0, false, false, false );
$pdf->Ln(4);  
$pdf->Cell(35, 10, $venta["fecha"], 0, false, 'C', 0, '', 0, false, false, false );

$pdf->Ln(4);
$image_file = K_PATH_IMAGES.'borde3.png';
$pdf->Image($image_file, 11, 102, 189, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Ln(0); 
$pdf->Cell(0, 5, 'DESCRIPCIÓN', 0, false, 'C', 0, '', 0, false, false, false );

$pdf->Ln(7);
$pdf->MultiCell(65, 30, $texto, 0, 'L', 0, 0, '', '', true);

$pdf->Ln(4);
$image_file = K_PATH_IMAGES.'borde4.png';
$pdf->Image($image_file, 10, 120, 190, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Ln(1);
$pdf->Cell(120, 10, 'Observaciones', 0, false, 'L', 0, '', 0, false, false, false );

$pdf->Cell(20, 10, 'Op. Gravadas', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(30, 10, 'S/', 0, false, 'C', 0, '', 0, false, false, false );
$pdf->Cell(12, 10, $venta["neto"], 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(20, 10, 'Op. Inafecta', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(42, 10, '0.00', 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(20, 10, 'Op. Exonerada', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(42, 10, '0.00', 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(20, 10, 'Total Op. Gratuitas', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(42, 10, '0.00', 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(20, 10, 'Descuentos Totales', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(42, 10, '0.00', 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(20, 10, 'Sub Total', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(42, 10, $venta["neto"], 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(20, 10, 'ISC', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(42, 10, '0.00', 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(10, 10, 'IGV', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(10, 10, '18%', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(42, 10, $venta["igv"], 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(5);
$pdf->Cell(120, 10, '', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(20, 10, 'Op. Grabadas', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(30, 10, 'S/', 0, false, 'C', 0, '', 0, false, false, false );
$pdf->Cell(12, 10, $venta["total"], 0, false, 'R', 0, '', 0, false, false, false );
$pdf->Ln(2);
$image_file = K_PATH_IMAGES.'borde2.png';
$pdf->Image($image_file, 10, 175, 190, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
$pdf->Ln(0);
$pdf->Cell(0, 7, 'Son: '.$monto_letra, 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Ln(6);
$pdf->Cell(120, 10, 'Cta. Recaudadora Bco. Crédito:  191-1553564-0-64', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Cell(70, 10, 'CANCELADO', 0, false, 'L', 0, '', 0, false, false, false );
$pdf->Ln(8);
$pdf->Cell(180, 10, 'Lima, ________ de __________________ de _______', 0, false, 'R', 0, '', 0, false, false, false );
// ---------------------------------------------------------
//SALIDA DEL ARCHIVO 

//$pdf->Output('factura.pdf', 'D');
$pdf->Output('reporte_cuenta.pdf');


