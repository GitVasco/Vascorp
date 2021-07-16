<?php 
require_once ("../../controladores/facturacion.controlador.php");
require_once ("../../modelos/facturacion.modelo.php");
require_once("../../extensiones/cantidad_en_letras.php");

$tipo = $_GET["tipo"];

$documento = $_GET["documento"];
$venta = ControladorFacturacion::ctrMostrarVentaImpresion($documento,$tipo);
var_dump(substr($venta["documento"],0,4));
$detalle_venta = ControladorFacturacion::ctrMostrarModeloImpresion($documento,$tipo);

$emisor = 	array(
			'tipodoc'		=> '6',
			'ruc' 			=> '20513613939', 
            'nombre_comercial'=> 'JACKY FORM',
			'razon_social'	=> 'Corporacion Vasco S.A.C.', 
			'direccion'		=> 'URB.SANTA LUISA 1RA ETAPA', 
			'pais'			=> 'PE', 
			'departamento'  => 'LIMA',
			'provincia'		=> 'LIMA',
			'distrito'		=> 'SAN MARTIN DE PORRES'
			);


$cliente = array(
			'tipodoc'		=> '6',//6->ruc, 1-> dni 
			'ruc'			=> $venta["dni"], 
			'razon_social'  => $venta["nombre"], 
			'direccion'		=> $venta["direccion"],
			'pais'			=> 'PE'
			);	

$comprobante =	array(
			'tipodoc'		=> '01', //01->FACTURA, 03->BOLETA, 07->NC, 08->ND
			'serie'			=> 'F002',
			'correlativo'	=> '1002',
			'fecha_emision' => $venta["fecha"],
			'moneda'		=> 'PEN', //PEN->SOLES; USD->DOLARES
			'total_opgravadas'=> 0, //OP. GRAVADAS
			'total_opexoneradas'=>0,
			'total_opinafectas'=>0,
			'igv'			=> 0,
			'total'			=> 0,
			'total_texto'	=> ''
		);

$detalle = 
			array(
				array(
					'item' 				=> 1,
					'codigo'			=> '11',
					'descripcion'		=> 'ACEITE CAPRI',
					'cantidad'			=> 1,
					'valor_unitario'	=> 50,
					'precio_unitario'	=> 59,
					'tipo_precio'		=> "01", //ya incluye igv
					'igv'				=> 9,
					'porcentaje_igv'	=> 18, //de 0 a 100
					'valor_total'		=> 50, 
					'importe_total'		=> 59,
					'unidad'			=> 'NIU',//unidad,
					'codigo_afectacion_alt'	=> '10', // Catálogo No. 07 - Anexo V
					'codigo_afectacion'	=> 1000,
					'nombre_afectacion'	=>'IGV',
					'tipo_afectacion'	=> 'VAT' //GRAVADAS				 
				),
				array(
					'item' 				=> 2,
					'codigo'			=> '22',
					'descripcion'		=> 'LIBRO ABC',
					'cantidad'			=> 1,
					'valor_unitario'	=> 50,
					'precio_unitario'	=> 50,
					'tipo_precio'		=> "01", //ya incluye igv
					'igv'				=> 0,
					'porcentaje_igv'	=> 18,
					'valor_total'		=> 50,
					'importe_total'		=> 50,
					'unidad'			=> 'NIU',//unidad,
					'codigo_afectacion_alt'	=> '20', // Catálogo No. 07 - Anexo V
					'codigo_afectacion'	=> 9997,
					'nombre_afectacion'	=>	'EXO',  //EXONERADOS
					'tipo_afectacion'	=> 'VAT' 			 
				),
				array(
					'item' 				=> 3,
					'codigo'			=> '33',
					'descripcion'		=> 'TOMATE ABC',
					'cantidad'			=> 1,
					'valor_unitario'	=> 50,
					'precio_unitario'	=> 50,
					'tipo_precio'		=> "01", //ya incluye igv
					'igv'				=> 0,
					'porcentaje_igv'	=> 18,
					'valor_total'		=> 50,
					'importe_total'		=> 50,
					'unidad'			=> 'NIU',//unidad,
					'codigo_afectacion_alt'	=> '30', // Catálogo No. 07 - Anexo V
					'codigo_afectacion'	=> 9998,
					'nombre_afectacion'	=>	'INA',  // INAFECTAS
					'tipo_afectacion'	=> 'FRE'  
				)								
			);

$op_gravadas = 0;
$op_inafectas = 0;
$op_exoneradas = 0;
$igv = 0;
$total = 0; 

foreach ($detalle as $k => $v) {
	if($v['codigo_afectacion_alt']=='10'){
		$op_gravadas = $op_gravadas + $v['valor_total'];
	}

	if($v['codigo_afectacion_alt']=='20'){
		$op_exoneradas = $op_exoneradas + $v['valor_total'];
	}

	if($v['codigo_afectacion_alt']=='30'){
		$op_inafectas = $op_inafectas + $v['valor_total'];
	}

	$igv = $igv + $v['igv'];
	$total = $total + $v['importe_total'];
}

$comprobante['total_opgravadas'] = $op_gravadas;
$comprobante['total_opexoneradas'] = $op_exoneradas;
$comprobante['total_opinafectas'] = $op_inafectas;
$comprobante['igv'] = $igv;
$comprobante['total'] = $total;
$comprobante['total_texto'] = CantidadEnLetra($total);

//CREAR XML INICIO
require_once("xml.php");

$xml = new GeneradorXML();

//RUC DEL EMISOR - TIPO DE COMPROBANTE - SERIE DEL DOCUMENTO - CORRELATIVO
//01-> FACTURA, 03-> BOLETA, 07-> NOTA DE CREDITO, 08-> NOTA DE DEBITO, 09->GUIA DE REMISION
$nombrexml = $emisor['ruc'].'-'.$comprobante['tipodoc'].'-'.$comprobante['serie'].'-'.$comprobante['correlativo'];

$ruta = "archivos_xml/".$nombrexml;
// $xml->CrearXMLFactura($ruta, $emisor, $cliente, $comprobante, $detalle);

// echo 'XML CREADO';
//CREAR XML FIN




?>