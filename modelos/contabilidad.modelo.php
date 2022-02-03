<?php
require_once "conexion.php";

class ModeloContabilidad{


    static public function mdlVentasSiscont($tipo, $documento){

        $sql="SELECT 
                    '02' AS origen,
                    DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha,
                    v.tipo,
                    v.documento,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.neto, 2) * - 1 
                        ELSE ROUND(v.neto, 2) 
                    END AS neto,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.igv, 2) * - 1 
                        ELSE ROUND(v.igv, 2) 
                    END AS igv,
                    CASE
                        WHEN v.tipo = 'E05' 
                        THEN ROUND(v.total, 2) * - 1 
                        ELSE ROUND(v.total, 2) 
                    END AS total,
                    tm.cuenta,
                    CASE
                    WHEN LEFT(c.ubigeo, 1) = 'L' 
                    OR LEFT(c.ubigeo, 2) = '15' 
                    THEN '1' 
                    ELSE '2' 
                    END AS zona,
                    CASE
                    WHEN v.tipo IN ('S02', 'S03', 'S05') 
                    AND LEFT(tm.cuenta, 2) = '12' 
                    THEN v.total 
                    WHEN v.tipo IN ('E05') 
                    AND LEFT(tm.cuenta, 2) = '40' 
                    THEN v.igv * - 1 
                    WHEN v.tipo IN ('E05') 
                    AND LEFT(tm.cuenta, 2) = '70' 
                    THEN v.neto * - 1 
                    ELSE 0 
                    END AS debe,
                    CASE
                    WHEN v.tipo IN ('S02', 'S03', 'S05') 
                    AND LEFT(tm.cuenta, 2) = '12' 
                    THEN 0 
                    WHEN v.tipo IN ('S02', 'S03', 'S05') 
                    AND LEFT(tm.cuenta, 2) = '40' 
                    THEN v.igv 
                    WHEN v.tipo IN ('S02', 'S03', 'S05') 
                    AND LEFT(tm.cuenta, 2) = '70' 
                    THEN v.neto 
                    WHEN v.tipo IN ('E05') 
                    AND LEFT(tm.cuenta, 2) = '12' 
                    THEN v.total * - 1 
                    ELSE 0 
                    END AS haber,
                    'S' AS moneda,
                    ROUND(v.tipo_cambio, 7) AS tipo_cambio,
                    CASE
                    WHEN v.tipo = 'S02' 
                    THEN '03' 
                    WHEN v.tipo = 'S03' 
                    THEN '01' 
                    WHEN v.tipo = 'E05' 
                    THEN '07' 
                    WHEN v.tipo = 'S05' 
                    THEN '08' 
                    END AS tipo_doc,
                    CONCAT(
                    LEFT(v.documento, 4),
                    '-',
                    RIGHT(v.documento, 8)
                    ) AS documentoA,
                    DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha_emi,
                    DATE_FORMAT(
                        DATE_ADD(
                        v.fecha,
                        INTERVAL IFNULL(cv.dias, 0) DAY
                        ),
                        '%d/%m/%y'
                    ) AS fecha_ven,
                    c.documento AS doc_cli,
                    '001' AS mpago,
                    'VENTA DE ROPA INTERIOR' AS glosa,
                    CONCAT(
                    LEFT(n.doc_origen, 4),
                    '-',
                    RIGHT(n.doc_origen, 8)
                    ) AS doc_origen,
                    n.tipo_doc AS tip_origen,
                    DATE_FORMAT(n.fecha_origen, '%d/%m/%y') AS fec_origen,
                    '2' AS tip_cli,
                    c.nombre AS nom_cliente,
                    c.ape_paterno,
                    c.ape_materno,
                    c.nombres,
                    c.tipo_documento 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    LEFT JOIN 
                    (SELECT 
                        tm.cod_argumento AS tipo,
                        tm.cod_tabla AS tabla,
                        tm.des_larga AS descripcion,
                        tm.des_corta AS cuenta,
                        tm.valor_1 AS zona 
                    FROM
                        tabla_m_detalle tm 
                    WHERE tm.cod_tabla = 'TASI') AS tm 
                    ON v.tipo = tm.tipo 
                    AND 
                    CASE
                        WHEN LEFT(c.ubigeo, 1) = 'L' 
                        OR LEFT(c.ubigeo, 2) = '15' 
                        THEN '1' 
                        ELSE '2' 
                    END = tm.zona 
                    LEFT JOIN condiciones_ventajf cv 
                    ON v.condicion_venta = cv.id 
                    LEFT JOIN notascd_jf n 
                    ON v.tipo = n.tipo 
                    AND v.documento = n.documento 
                WHERE v.tipo = :tipo
                    AND v.documento = :documento
                    AND v.tipo IN ('S02', 'S03', 'S05', 'E05') 
                ORDER BY v.documento,
                    tm.cuenta";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);   

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }

    static public function mdlVoucherSiscont($ano, $mes){

        $sql="SELECT 
                    tm.cod_argumento AS nmes,
                    tm.cod_tabla AS tabla,
                    tm.des_larga AS mes,
                    tm.des_corta AS ano,
                    tm.valor_1 AS correlativo,
                    tm.valor_2 AS correlativoL,
                    tm.valor_3 as correlativo04,
                    tm.valor_4 as correlativo08
                FROM
                    tabla_m_detalle tm 
                WHERE tm.cod_tabla = 'tcor' 
                    AND tm.cod_argumento = :mes 
                    AND tm.des_corta = :ano";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":ano", $ano, PDO::PARAM_STR);
		$stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();

        $stmt=null;

    }

    static public function mdlVentasConfiguradas($fechaInicio, $fechaFin){

        $sql="SELECT 
                    v.tipo,
                    v.documento 
                FROM
                    ventajf v 
                WHERE v.fecha BETWEEN :fechaInicio 
                    AND :fechaFin 
                    AND v.tipo IN ('S02', 'S03', 'S05', 'E05') 
                ORDER BY v.fecha,
                    v.tipo,
                    v.documento";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }    

	static public function mdlActualizarCorrelativo($ano, $mes, $correlativo, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                    tabla_m_detalle 
                                SET
                                    $valor = :correlativo
                                WHERE cod_tabla = 'tcor' 
                                    AND cod_argumento = :mes 
                                    AND des_corta = :ano");

		$stmt->bindParam(":ano", $ano, PDO::PARAM_STR);
		$stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
        $stmt->bindParam(":correlativo", $correlativo, PDO::PARAM_STR);
        
		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt -> errorInfo();
		
		}

		$stmt->close();
		$stmt = null;

    }    

    static public function mdlLetrasConfiguradas($fechaInicio, $fechaFin){

        $sql="SELECT 
                        cc.cod_pago,
                        cc.doc_origen
                    FROM
                        cuenta_ctejf cc 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin
                        AND cc.tipo_doc = '85' 
                        AND cc.tip_mov = '+' 
                        AND cc.cod_pago <> '85'
                    GROUP BY cc.doc_origen";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }     

    static public function mdlLetrasConfiguradasB($fechaInicio, $fechaFin){

        $sql="SELECT 
                        cc.cliente 
                    FROM
                        cuenta_ctejf cc 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin
                        AND cc.tipo_doc = '85' 
                        AND cc.cod_pago = '85' 
                        AND cc.tip_mov = '+' 
                    GROUP BY cc.cliente ";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt->bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }      
    
    static public function mdlLetrasSiscont($documento){

        $sql="SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        tm.cuenta,
                        ROUND(cc.monto, 2) AS debe,
                        ROUND('0.00', 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        'LE' AS doc,
                        cc.num_cta AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                        LEFT JOIN 
                        (SELECT 
                            tm.cod_argumento AS tipo,
                            tm.cod_tabla AS tabla,
                            tm.des_larga AS nombre,
                            tm.des_corta AS cuenta 
                        FROM
                            tabla_m_detalle tm 
                        WHERE tm.cod_tabla = 'TASL') tm 
                        ON cc.tipo_doc = tm.tipo 
                    WHERE cc.doc_origen = :documento 
                        AND cc.tip_mov = '+' 
                        AND cc.tipo_doc = '85' 
                    UNION
                    SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.cod_pago,
                        cc.num_cta,
                        cc.doc_origen,
                        CASE
                        WHEN cc.cod_pago = '85' 
                        THEN '123101' 
                        ELSE '121101' 
                        END AS cuenta,
                        ROUND('0.00', 2) AS debe,
                        ROUND(SUM(cc.monto), 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        CASE
                            WHEN cc.cod_pago = '85' 
                            THEN 'LE' 
                            ELSE cc.cod_pago 
                        END AS doc,
                        CASE
                        WHEN cc.cod_pago = '85' 
                        THEN cc.doc_origen 
                        ELSE CONCAT(
                            LEFT(cc.doc_origen, 4),
                            '-',
                            RIGHT(cc.doc_origen, 8)
                        ) 
                        END AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                    WHERE cc.doc_origen = :documento AND cc.tipo_doc = '85' 
                        AND cc.tip_mov = '+' 
                    GROUP BY cc.doc_origen 
                    ORDER BY doc_origen,
                        cuenta DESC,
                        num_cta";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);   

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }    

    static public function mdlLetrasSiscontB($cliente, $fechaInicio, $fechaFin){

        $sql="SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        '123101' AS cuenta,
                        ROUND(cc.monto, 2) AS debe,
                        ROUND('0.00', 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        'LE' AS doc,
                        cc.num_cta AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                    WHERE DATE(cc.fecha) BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.cliente = :cliente 
                        AND cc.tipo_doc = '85' 
                        AND cc.cod_pago = '85' 
                        AND cc.tip_mov = '+' 
                    UNION
                    /*HABER*/
                    SELECT 
                        '05' AS t,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.cod_pago,
                        cc.num_cta,
                        cc.doc_origen,
                        CASE
                        WHEN cc.tipo_doc = '08' 
                        THEN '121101' 
                        ELSE '123101' 
                        END AS cuenta,
                        ROUND('0.00', 2) AS debe,
                        ROUND(cc.monto, 2) AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) AS tc,
                        CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN 'LE' 
                        ELSE cc.tipo_doc 
                        END AS doc,
                        CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN cc.num_cta 
                        ELSE CONCAT(
                            LEFT(cc.num_cta, 4),
                            '-',
                            RIGHT(cc.num_cta, 8)
                        ) 
                        END AS numero,
                        DATE_FORMAT(
                        (SELECT 
                            c1.fecha 
                        FROM
                            cuenta_ctejf c1 
                        WHERE c1.num_cta = cc.num_cta 
                            AND c1.tip_mov = '+'),
                        '%d/%m/%y'
                        ) AS fechad,
                        DATE_FORMAT(
                        (SELECT 
                            c1.fecha_ven 
                        FROM
                            cuenta_ctejf c1 
                        WHERE c1.num_cta = cc.num_cta 
                            AND c1.tip_mov = '+'),
                        '%d/%m/%y'
                        ) AS fechav,
                        c.documento AS codigo,
                        'CANJE DE FACTURAS POR LETRAS' AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                    WHERE DATE(cc.fecha) BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.cliente = :cliente 
                        AND cc.tip_mov = '-' 
                        AND cc.cod_pago IN ('85', 'RF') 
                    ORDER BY ruc,
                        debe DESC";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":cliente", $cliente, PDO::PARAM_STR);   
        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }       

    static public function mdlCancelacionesSiscont04($fechaInicio, $fechaFin){

        $sql="SELECT 
                        tip.codigos_pago,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        cc.cod_pago,
                        CASE
                        WHEN cc.tipo_doc IN ('01', '03', '08') 
                        THEN '121101' 
                        ELSE '123101' 
                        END AS cuenta,
                        ROUND('0.00',2) AS debe,
                        cc.monto AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) as tc,
                        CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN 'LE' 
                        ELSE cc.tipo_doc 
                        END AS doc,
                        CASE
                        WHEN cc.tipo_doc IN ('01', '03', '08') 
                        AND LEFT(cc.num_cta, 1) <> '0' 
                        THEN CONCAT(
                            LEFT(cc.num_cta, 4),
                            '-',
                            RIGHT(cc.num_cta, 8)
                        ) 
                        WHEN cc.tipo_doc IN ('01', '03', '08') 
                        AND LEFT(cc.num_cta, 1) = '0' 
                        THEN CONCAT(
                            LEFT(cc.num_cta, 3),
                            '-',
                            RIGHT(cc.num_cta, 7)
                        ) 
                        ELSE cc.num_cta 
                        END AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        cc.cliente,
                        c.documento AS codigo,
                        CASE
                        WHEN cc.tipo_doc = '85' 
                        THEN 'CANCELACION DE LETRAS' 
                        ELSE 'CANCELACION DE DOCUMENTOS' 
                        END AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                    FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                        ON cc.cliente = c.codigo 
                        LEFT JOIN 
                        (SELECT 
                            cc.tipo_doc,
                            cc.num_cta,
                            GROUP_CONCAT(cc.cod_pago) AS codigos_pago 
                        FROM
                            cuenta_ctejf cc 
                        WHERE cc.fecha BETWEEN :fechaInicio 
                            AND :fechaFin 
                            AND cc.tip_mov = '-' 
                            AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                            AND cc.cod_pago NOT IN ('85', 'RF') 
                        GROUP BY cc.num_cta) AS tip 
                        ON cc.tipo_doc = tip.tipo_doc 
                        AND cc.num_cta = tip.num_cta 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.tip_mov = '-' 
                        AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        AND cc.cod_pago NOT IN ('85', 'RF') 
                        AND tip.codigos_pago LIKE '%80%'
            UNION
                        SELECT 
                        tip.codigos_pago,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                        cc.tipo_doc,
                        cc.num_cta,
                        cc.doc_origen,
                        cc.cod_pago,
                        CASE
                            WHEN cc.cod_pago IN ('00', '05', '82') 
                            THEN '104101' 
                            WHEN cc.cod_pago IN ('06', '14') 
                            THEN '104103' 
                            WHEN cc.cod_pago IN ('80') 
                            THEN '101100' 
                            ELSE '121101' 
                        END AS cuenta,
                        SUM(cc.monto) AS debe,
                        0 AS haber,
                        'S' AS moneda,
                        ROUND(cc.tip_cambio, 7) as tc,
                        CASE
                            WHEN cc.cod_pago IN ('96', '97') 
                            THEN '07' 
                            WHEN cc.tipo_doc = '85' 
                            THEN 'LE' 
                            ELSE cc.tipo_doc 
                        END AS doc,
                        IFNULL(
                            CASE
                            WHEN cc.cod_pago IN ('96', '97') 
                            THEN 
                            (SELECT DISTINCT 
                                CONCAT(
                                LEFT(n.documento, 4),
                                '-',
                                RIGHT(n.documento, 8)
                                ) 
                            FROM
                                notascd_jf n 
                            WHERE n.doc_origen = cc.num_cta 
                                AND n.tipo = 'E05' 
                            LIMIT 1) 
                            WHEN cc.tipo_doc IN ('01', '03', '08') 
                            AND LEFT(cc.num_cta, 1) <> '0' 
                            THEN CONCAT(
                                LEFT(cc.num_cta, 4),
                                '-',
                                RIGHT(cc.num_cta, 8)
                            ) 
                            WHEN cc.tipo_doc IN ('01', '03', '08') 
                            AND LEFT(cc.num_cta, 1) = '0' 
                            THEN CONCAT(
                                LEFT(cc.num_cta, 3),
                                '-',
                                RIGHT(cc.num_cta, 7)
                            ) 
                            ELSE cc.num_cta 
                            END,
                            (SELECT DISTINCT 
                            CONCAT(
                                LEFT(n.documento, 4),
                                '-',
                                RIGHT(n.documento, 8)
                            ) 
                            FROM
                            notascd_jf n 
                            WHERE RIGHT(cc.notas, 12) = n.documento 
                            AND n.tipo = 'E05')
                        ) AS numero,
                        DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                        DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                        cc.cliente,
                        c.documento AS codigo,
                        CASE
                            WHEN cc.tipo_doc = '85' 
                            THEN 'CANCELACION DE LETRAS' 
                            ELSE 'CANCELACION DE DOCUMENTOS' 
                        END AS glosa,
                        c.documento AS ruc,
                        '2' AS tipo,
                        c.nombre AS rs,
                        c.ape_paterno AS ape1,
                        c.ape_materno AS ape2,
                        c.nombres AS nombre,
                        c.tipo_documento AS tdoci 
                        FROM
                        cuenta_ctejf cc 
                        LEFT JOIN clientesjf c 
                            ON cc.cliente = c.codigo 
                        LEFT JOIN 
                            (SELECT 
                            cc.tipo_doc,
                            cc.num_cta,
                            GROUP_CONCAT(cc.cod_pago) AS codigos_pago 
                            FROM
                            cuenta_ctejf cc 
                            WHERE cc.fecha BETWEEN :fechaInicio 
                            AND :fechaFin 
                            AND cc.tip_mov = '-' 
                            AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                            AND cc.cod_pago NOT IN ('85', 'RF') 
                            GROUP BY cc.num_cta) AS tip 
                            ON cc.tipo_doc = tip.tipo_doc 
                            AND cc.num_cta = tip.num_cta 
                        WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.tip_mov = '-' 
                        AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        AND cc.cod_pago NOT IN ('85', 'RF') 
                        AND tip.codigos_pago LIKE '%80%'
                        GROUP BY cc.num_cta,
                        cc.cod_pago 
                        ORDER BY num_cta,
                        debe DESC,
                        fechad";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }      
    
    static public function mdlCancelacionesSiscont08($fechaInicio, $fechaFin){

        $sql="SELECT 
                    tip.codigos_pago,
                    DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                    cc.tipo_doc,
                    cc.num_cta,
                    cc.doc_origen,
                    cc.cod_pago,
                    CASE
                    WHEN cc.tipo_doc IN ('01', '03', '08') 
                    THEN '121101' 
                    ELSE '123101' 
                    END AS cuenta,
                    ROUND('0.00', 2) AS debe,
                    cc.monto AS haber,
                    'S' AS moneda,
                    ROUND(cc.tip_cambio, 7) as tc,
                    CASE
                    WHEN cc.tipo_doc = '85' 
                    THEN 'LE' 
                    ELSE cc.tipo_doc 
                    END AS doc,
                    CASE
                    WHEN cc.tipo_doc IN ('01', '03', '08') 
                    AND LEFT(cc.num_cta, 1) <> '0' 
                    THEN CONCAT(
                        LEFT(cc.num_cta, 4),
                        '-',
                        RIGHT(cc.num_cta, 8)
                    ) 
                    WHEN cc.tipo_doc IN ('01', '03', '08') 
                    AND LEFT(cc.num_cta, 1) = '0' 
                    THEN CONCAT(
                        LEFT(cc.num_cta, 3),
                        '-',
                        RIGHT(cc.num_cta, 7)
                    ) 
                    ELSE cc.num_cta 
                    END AS numero,
                    DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                    DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                    cc.cliente,
                    c.documento AS codigo,
                    CASE
                    WHEN cc.tipo_doc = '85' 
                    THEN 'CANCELACION DE LETRAS' 
                    ELSE 'CANCELACION DE DOCUMENTOS' 
                    END AS glosa,
                    c.documento AS ruc,
                    '2' AS tipo,
                    c.nombre AS rs,
                    c.ape_paterno AS ape1,
                    c.ape_materno AS ape2,
                    c.nombres AS nombre,
                    c.tipo_documento AS tdoci 
                FROM
                    cuenta_ctejf cc 
                    LEFT JOIN clientesjf c 
                    ON cc.cliente = c.codigo 
                    LEFT JOIN 
                    (SELECT 
                        cc.tipo_doc,
                        cc.num_cta,
                        GROUP_CONCAT(cc.cod_pago) AS codigos_pago 
                    FROM
                        cuenta_ctejf cc 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.tip_mov = '-' 
                        AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        AND cc.cod_pago NOT IN ('85', 'RF') 
                    GROUP BY cc.num_cta) AS tip 
                    ON cc.tipo_doc = tip.tipo_doc 
                    AND cc.num_cta = tip.num_cta 
                WHERE cc.fecha BETWEEN :fechaInicio 
                    AND :fechaFin 
                    AND cc.tip_mov = '-' 
                    AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                    AND cc.cod_pago NOT IN ('85', 'RF') 
                    AND tip.codigos_pago NOT LIKE '%80%' 
    UNION
                SELECT 
                    tip.codigos_pago,
                    DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fecha,
                    cc.tipo_doc,
                    cc.num_cta,
                    cc.doc_origen,
                    cc.cod_pago,
                    CASE
                    WHEN cc.cod_pago IN ('00', '05', '82') 
                    THEN '104101' 
                    WHEN cc.cod_pago IN ('06', '14') 
                    THEN '104103' 
                    WHEN cc.cod_pago IN ('80') 
                    THEN '101100' 
                    ELSE '121101' 
                    END AS cuenta,
                    SUM(cc.monto) AS debe,
                    0 AS haber,
                    'S' AS moneda,
                    ROUND(cc.tip_cambio, 7) as tc,
                    CASE
                    WHEN cc.cod_pago IN ('96', '97') 
                    THEN '07' 
                    WHEN cc.tipo_doc = '85' 
                    THEN 'LE' 
                    ELSE cc.tipo_doc 
                    END AS doc,
                    IFNULL(
                    CASE
                        WHEN cc.cod_pago IN ('96', '97') 
                        THEN 
                        (SELECT DISTINCT 
                        CONCAT(
                            LEFT(n.documento, 4),
                            '-',
                            RIGHT(n.documento, 8)
                        ) 
                        FROM
                        notascd_jf n 
                        WHERE n.doc_origen = cc.num_cta 
                        AND n.tipo = 'E05' 
                        LIMIT 1) 
                        WHEN cc.tipo_doc IN ('01', '03', '08') 
                        AND LEFT(cc.num_cta, 1) <> '0' 
                        THEN CONCAT(
                        LEFT(cc.num_cta, 4),
                        '-',
                        RIGHT(cc.num_cta, 8)
                        ) 
                        WHEN cc.tipo_doc IN ('01', '03', '08') 
                        AND LEFT(cc.num_cta, 1) = '0' 
                        THEN CONCAT(
                        LEFT(cc.num_cta, 3),
                        '-',
                        RIGHT(cc.num_cta, 7)
                        ) 
                        ELSE cc.num_cta 
                    END,
                    IFNULL(
                        (SELECT DISTINCT 
                        CONCAT(
                            LEFT(n.documento, 4),
                            '-',
                            RIGHT(n.documento, 8)
                        ) 
                        FROM
                        notascd_jf n 
                        WHERE RIGHT(cc.notas, 12) = n.documento 
                        AND n.tipo = 'E05'),
                        CONCAT(
                        LEFT(cc.num_cta, 4),
                        '-',
                        RIGHT(cc.num_cta, 8)
                        )
                    )
                    ) AS numero,
                    DATE_FORMAT(cc.fecha, '%d/%m/%y') AS fechad,
                    DATE_FORMAT(cc.fecha_ven, '%d/%m/%y') AS fechav,
                    cc.cliente,
                    c.documento AS codigo,
                    CASE
                    WHEN cc.tipo_doc = '85' 
                    THEN 'CANCELACION DE LETRAS' 
                    ELSE 'CANCELACION DE DOCUMENTOS' 
                    END AS glosa,
                    c.documento AS ruc,
                    '2' AS tipo,
                    c.nombre AS rs,
                    c.ape_paterno AS ape1,
                    c.ape_materno AS ape2,
                    c.nombres AS nombre,
                    c.tipo_documento AS tdoci 
                FROM
                    cuenta_ctejf cc 
                    LEFT JOIN clientesjf c 
                    ON cc.cliente = c.codigo 
                    LEFT JOIN 
                    (SELECT 
                        cc.tipo_doc,
                        cc.num_cta,
                        GROUP_CONCAT(cc.cod_pago) AS codigos_pago 
                    FROM
                        cuenta_ctejf cc 
                    WHERE cc.fecha BETWEEN :fechaInicio 
                        AND :fechaFin 
                        AND cc.tip_mov = '-' 
                        AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                        AND cc.cod_pago NOT IN ('85', 'RF') 
                    GROUP BY cc.num_cta) AS tip 
                    ON cc.tipo_doc = tip.tipo_doc 
                    AND cc.num_cta = tip.num_cta 
                WHERE DATE(cc.fecha) BETWEEN :fechaInicio 
                    AND :fechaFin 
                    AND cc.tip_mov = '-' 
                    AND cc.tipo_doc IN ('01', '03', '07', '08', '85') 
                    AND cc.cod_pago NOT IN ('85', 'RF') 
                    AND tip.codigos_pago NOT LIKE '%80%' 
                GROUP BY cc.num_cta,
                    cc.cod_pago 
                ORDER BY num_cta,
                    debe DESC,
                    fechad";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }  

    static public function mdlClientes($fechaInicio, $fechaFin){

        $sql="SELECT 
                    c.documento AS ruc,
                    '2' AS tipo,
                    c.nombre AS rs,
                    c.ape_paterno AS ape1,
                    c.ape_materno AS ape2,
                    SUBSTRING_INDEX(
                    SUBSTRING_INDEX(c.nombres, ' ', 1),
                    ' ',
                    - 1
                    ) AS nombre,
                    c.tipo_documento AS tdoci 
                FROM
                    clientesjf c 
                WHERE DATE(c.fecha) BETWEEN :fechaInicio
                    AND :fechaFin";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":fechaInicio", $fechaInicio, PDO::PARAM_STR);
		$stmt -> bindParam(":fechaFin", $fechaFin, PDO::PARAM_STR); 

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }      

}