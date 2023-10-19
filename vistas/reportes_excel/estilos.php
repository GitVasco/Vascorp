<?php
#negrita subrayado T-11
$texto1 = new PHPExcel_Style();
$texto1->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'font' => array(
            'bold' => true,
            'underline' => true,
            'size' => 11
        )
    )
);

#negrita T-11
$texto2 = new PHPExcel_Style();
$texto2->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'font' => array(
            'bold' => true,
            'underline' => false,
            'size' => 11
        )
    )
);
$texto3 = new PHPExcel_Style();
$texto3->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false
        ),
        'font' => array(
            'bold' => true,
            'color' => array('rgb' => 'FF0008'),
            'underline' => true,
            'size' => 13
        )
    )
);

#bordes grueso: izquierda-arriba-derecha, color GRIS NEGRITA T11
$borde1 = new PHPExcel_Style();
$borde1->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D7DBDD')
        ),
        'borders' => array(
            'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        ),
        'font' => array(
            'bold' => true,
            'size' => 11
        )
    )
);

#bordes grueso: izquierda-derecha, color GRIS NEGRITA T11
$borde2 = new PHPExcel_Style();
$borde2->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D7DBDD')
        ),
        'borders' => array(
            'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        ),
        'font' => array(
            'bold' => true,
            'size' => 11
        )
    )
);

#bordes grueso: izquierda-derecha-abajo, color GRIS NEGRITA T11
$borde3 = new PHPExcel_Style();
$borde3->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D7DBDD')
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        ),
        'font' => array(
            'bold' => true,
            'size' => 11
        )
    )
);

#bordes derecho delgado / borde izquiedo grueso / borde abajo delgado
$borde4 = new PHPExcel_Style();
$borde4->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        ),
        'font' => array(
            'bold' => false,
            'size' => 10
        )
    )
);

#bordes derecho delgado / borde izquiedo delgado / borde abajo delgado
$borde5 = new PHPExcel_Style();
$borde5->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
        ),
        'font' => array(
            'bold' => false,
            'size' => 10
        )
    )
);

#bordes derecho grueso / borde izquiedo delgado / borde abajo delgado
$borde6 = new PHPExcel_Style();
$borde6->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        ),
        'font' => array(
            'bold' => false,
            'size' => 10
        )
    )
);

#bordes grueso: izquierda-arriba-derecha, color GRIS NEGRITA T11
$borde7 = new PHPExcel_Style();
$borde7->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D7DBDD')
        ),
        'borders' => array(
            'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        ),
        'font' => array(
            'bold' => true,
            'size' => 11
        )
    )
);

#bordes grueso: ABAJO
$borde8 = new PHPExcel_Style();
$borde8->applyFromArray(
    array(
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        )
    )
);

#bordes grueso: izquierda-derecha-abajo-arriba, color GRIS NEGRITA T10
$borde9 = new PHPExcel_Style();
$borde9->applyFromArray(
    array(
        'alignment' => array(
            'wrap' => false,
            'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
        ),
        'fill' => array(
            'type' => PHPExcel_Style_Fill::FILL_SOLID,
            'color' => array('rgb' => 'D7DBDD')
        ),
        'borders' => array(
            'bottom' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'top' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'right' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM),
            'left' => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
        ),
        'font' => array(
            'bold' => true,
            'size' => 10
        )
    )
);
