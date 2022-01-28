<?php
require_once "conexion.php";

class ModeloContabilidad{


    static public function mdlVentasSiscont($tipo, $documento){

        $sql="SELECT 
                    '02' AS origen,
                    DATE_FORMAT(v.fecha, '%d/%m/%y') AS fecha,
                    v.tipo,
                    v.documento,
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
                    tm.valor_1 AS correlativo 
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

	static public function mdlActualizarCorrelativo($ano, $mes, $correlativo){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                    tabla_m_detalle 
                                SET
                                    valor_1 = :correlativo - 1 
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

}