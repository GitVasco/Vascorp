<?php

require_once "conexion.php";

class ModeloCompras{

	static public function mdlCantidadDocumentos(){

        $stmt = Conexion::conectar()->prepare("SELECT 
                    COUNT(*) AS cantidad 
                FROM
                    reg_compras r 
                WHERE r.tipo_documento IN ('01', '03', '07', '08') 
                    AND r.estado = '0'");

        $stmt -> execute();

        return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}

	static public function mdlComprasSinVerificar($i){

        if($i == "1"){

            $stmt = Conexion::conectar()->prepare("SELECT 
                    CONCAT(
                    r.ruc,
                    '|',
                    r.tipo_documento,
                    '|',
                    r.serie_doc,
                    '|',
                    r.num_doc,
                    '|',
                    DATE_FORMAT(r.fecha_emision, '%d/%m/%Y'),
                    '|',
                    CASE
                        WHEN LEFT(r.serie_doc, 1) = '0' 
                        THEN '' 
                        ELSE (
                        CASE
                            WHEN r.tipo_documento = '07' 
                            THEN (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio * - 1, 2) 
                                ELSE ROUND(r.total * - 1, 2) 
                            END
                            ) 
                            ELSE (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio, 2) 
                                ELSE ROUND(r.total, 2) 
                            END
                            ) 
                        END
                        ) 
                    END
                    ) AS sunat 
                FROM
                    reg_compras r 
                WHERE r.tipo_documento IN ('01', '03', '07', '08') 
                    AND r.estado = '0' 
                ORDER BY MONTH(r.fecha_emision),
                    r.origen,
                    r.voucher
                LIMIT 100 OFFSET 0");

            $stmt -> execute();

            return $stmt -> fetchAll();            

        }else if($i == "2"){

            $stmt = Conexion::conectar()->prepare("SELECT 
                    CONCAT(
                    r.ruc,
                    '|',
                    r.tipo_documento,
                    '|',
                    r.serie_doc,
                    '|',
                    r.num_doc,
                    '|',
                    DATE_FORMAT(r.fecha_emision, '%d/%m/%Y'),
                    '|',
                    CASE
                        WHEN LEFT(r.serie_doc, 1) = '0' 
                        THEN '' 
                        ELSE (
                        CASE
                            WHEN r.tipo_documento = '07' 
                            THEN (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio * - 1, 2) 
                                ELSE ROUND(r.total * - 1, 2) 
                            END
                            ) 
                            ELSE (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio, 2) 
                                ELSE ROUND(r.total, 2) 
                            END
                            ) 
                        END
                        ) 
                    END
                    ) AS sunat 
                FROM
                    reg_compras r 
                WHERE r.tipo_documento IN ('01', '03', '07', '08') 
                    AND r.estado = '0' 
                ORDER BY MONTH(r.fecha_emision),
                    r.origen,
                    r.voucher
                LIMIT 100 OFFSET 100");

            $stmt -> execute();

            return $stmt -> fetchAll(); 

        }else if($i == "3"){

            $stmt = Conexion::conectar()->prepare("SELECT 
                    CONCAT(
                    r.ruc,
                    '|',
                    r.tipo_documento,
                    '|',
                    r.serie_doc,
                    '|',
                    r.num_doc,
                    '|',
                    DATE_FORMAT(r.fecha_emision, '%d/%m/%Y'),
                    '|',
                    CASE
                        WHEN LEFT(r.serie_doc, 1) = '0' 
                        THEN '' 
                        ELSE (
                        CASE
                            WHEN r.tipo_documento = '07' 
                            THEN (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio * - 1, 2) 
                                ELSE ROUND(r.total * - 1, 2) 
                            END
                            ) 
                            ELSE (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio, 2) 
                                ELSE ROUND(r.total, 2) 
                            END
                            ) 
                        END
                        ) 
                    END
                    ) AS sunat 
                FROM
                    reg_compras r 
                WHERE r.tipo_documento IN ('01', '03', '07', '08') 
                    AND r.estado = '0' 
                ORDER BY MONTH(r.fecha_emision),
                    r.origen,
                    r.voucher
                LIMIT 100 OFFSET 200");

            $stmt -> execute();

            return $stmt -> fetchAll();             

        }else if($i == "4"){

            $stmt = Conexion::conectar()->prepare("SELECT 
                    CONCAT(
                    r.ruc,
                    '|',
                    r.tipo_documento,
                    '|',
                    r.serie_doc,
                    '|',
                    r.num_doc,
                    '|',
                    DATE_FORMAT(r.fecha_emision, '%d/%m/%Y'),
                    '|',
                    CASE
                        WHEN LEFT(r.serie_doc, 1) = '0' 
                        THEN '' 
                        ELSE (
                        CASE
                            WHEN r.tipo_documento = '07' 
                            THEN (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio * - 1, 2) 
                                ELSE ROUND(r.total * - 1, 2) 
                            END
                            ) 
                            ELSE (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio, 2) 
                                ELSE ROUND(r.total, 2) 
                            END
                            ) 
                        END
                        ) 
                    END
                    ) AS sunat 
                FROM
                    reg_compras r 
                WHERE r.tipo_documento IN ('01', '03', '07', '08') 
                    AND r.estado = '0' 
                ORDER BY MONTH(r.fecha_emision),
                    r.origen,
                    r.voucher
                LIMIT 100 OFFSET 300");

            $stmt -> execute();

            return $stmt -> fetchAll();             

        }else if($i == "5"){

            $stmt = Conexion::conectar()->prepare("SELECT 
                    CONCAT(
                    r.ruc,
                    '|',
                    r.tipo_documento,
                    '|',
                    r.serie_doc,
                    '|',
                    r.num_doc,
                    '|',
                    DATE_FORMAT(r.fecha_emision, '%d/%m/%Y'),
                    '|',
                    CASE
                        WHEN LEFT(r.serie_doc, 1) = '0' 
                        THEN '' 
                        ELSE (
                        CASE
                            WHEN r.tipo_documento = '07' 
                            THEN (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio * - 1, 2) 
                                ELSE ROUND(r.total * - 1, 2) 
                            END
                            ) 
                            ELSE (
                            CASE
                                WHEN r.moneda = 'D' 
                                THEN ROUND(r.total / r.tipo_cambio, 2) 
                                ELSE ROUND(r.total, 2) 
                            END
                            ) 
                        END
                        ) 
                    END
                    ) AS sunat 
                FROM
                    reg_compras r 
                WHERE r.tipo_documento IN ('01', '03', '07', '08') 
                    AND r.estado = '0' 
                ORDER BY MONTH(r.fecha_emision),
                    r.origen,
                    r.voucher
                LIMIT 100 OFFSET 400");

            $stmt -> execute();

            return $stmt -> fetchAll();             

        }

		$stmt -> close();

		$stmt = null;

	}    

	static public function mdlActualizarRegCompras($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    reg_compras 
                                                SET
                                                    comprobante = :comprobante,
                                                    contribuyente = :contribuyente,
                                                    condicion = :condicion,
                                                    estado = :estado 
                                                WHERE ruc = :ruc 
                                                    AND serie_doc = :serie_doc 
                                                    AND num_doc = :num_doc");

		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":serie_doc", $datos["serie_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":num_doc", $datos["num_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":comprobante", $datos["comprobante"], PDO::PARAM_STR);
		$stmt->bindParam(":contribuyente", $datos["contribuyente"], PDO::PARAM_STR);
		$stmt->bindParam(":condicion", $datos["condicion"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";

		} else {

			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;

	}    

	static public function mdlActualizarDiario($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                    diario 
                                SET
                                    comprobante = :comprobante,
                                    contribuyente = :contribuyente,
                                    condicion = :condicion 
                                WHERE ruc = :ruc 
                                    AND serie_doc = :serie_doc 
                                    AND num_doc = :num_doc");

		$stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
		$stmt->bindParam(":serie_doc", $datos["serie_doc"], PDO::PARAM_STR);
		$stmt->bindParam(":num_doc", $datos["num_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":comprobante", $datos["comprobante"], PDO::PARAM_STR);
		$stmt->bindParam(":contribuyente", $datos["contribuyente"], PDO::PARAM_STR);
		$stmt->bindParam(":condicion", $datos["condicion"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";

		} else {

			return $stmt->errorInfo();
		}

		$stmt->close();
		$stmt = null;

	}     

}