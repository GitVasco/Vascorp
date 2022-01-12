<?php
require_once "conexion.php";

class ModeloFacturacion{

	/*
	* REGISTAR MOVIMIENTOS 
	*/
	static public function mdlRegistrarMovimientos($detalle){

		$stmt = Conexion::conectar()->prepare("INSERT INTO movimientosjf_2021 (
                                                    tipo,
                                                    documento,
                                                    fecha,
                                                    articulo,
                                                    cliente,
                                                    vendedor,
                                                    cantidad,
                                                    precio,
                                                    dscto1,
                                                    dscto2,
                                                    total,
                                                    nombre_tipo
                                                )
                                                VALUES
                                                    $detalle");
		if ($stmt->execute()) {

			return "ok";

		} else {

			return $stmt->errorInfo();
		}

		$stmt->close();

		$stmt = null;

    }

	/*
	* REGISTAR DOCUMENTO
	*/
	static public function mdlRegistrarDocumento($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventajf (
                                                        tipo,
                                                        documento,
                                                        neto,
                                                        igv,
                                                        dscto,
                                                        total,
                                                        cliente,
                                                        vendedor,
                                                        agencia,
                                                        fecha,
                                                        tipo_documento,
                                                        lista_precios,
                                                        condicion_venta,
                                                        doc_destino,
                                                        doc_origen,
                                                        usuario,
                                                        usureg,
                                                        pcreg
                                                    )
                                                    VALUES
                                                        (
                                                        :tipo,
                                                        :documento,
                                                        :neto,
                                                        :igv,
                                                        :dscto,
                                                        :total,
                                                        :cliente,
                                                        :vendedor,
                                                        :agencia,
                                                        DATE(NOW()),
                                                        :tipo_documento,
                                                        :lista_precios,
                                                        :condicion_venta,
                                                        :doc_destino,
                                                        :doc_origen,
                                                        :usuario,
                                                        :usureg,
                                                        :pcreg
                                                        )");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
        $stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
        $stmt->bindParam(":dscto", $datos["dscto"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":agencia", $datos["agencia"], PDO::PARAM_STR);
        $stmt->bindParam(":lista_precios", $datos["lista_precios"], PDO::PARAM_STR);
        $stmt->bindParam(":condicion_venta", $datos["condicion_venta"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_destino", $datos["doc_destino"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 GUIA
    */
	static public function mdlActualizarTalonarioGuia($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    guias_remision = guias_remision + 1
                WHERE serie_guias = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 FACTURA
    */
	static public function mdlActualizarTalonarioFactura($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    facturas = facturas + 1
                WHERE serie_factura = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 BOLETA
    */
	static public function mdlActualizarTalonarioBoleta($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    boletas = boletas + 1
                WHERE serie_boletas = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 PROFORMA
    */
	static public function mdlActualizarTalonarioProforma($serie){

		$sql="UPDATE
                    talonariosjf
                SET
                    proformas = proformas + 1
                WHERE serie_proformas = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":valor", $serie, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }



    /*
    * ACTUALIZAR PEDIDO A FACTURADO
    */
	static public function mdlActualizarPedidoF($codigo){

		$sql="UPDATE
                    temporaljf
                SET
                    estado = 'FACTURADOS'
                WHERE codigo = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * ACTUALIZAR TALONARIO + 1 FACTURA
    */
	static public function mdlGenerarCtaCte($datos){

		$sql="INSERT INTO cuenta_ctejf (
                        tipo_doc,
                        num_cta,
                        cliente,
                        vendedor,
                        fecha,
                        fecha_ven,
                        monto,
                        cod_pago,
                        doc_origen,
                        usuario,
                        saldo,
                        usureg,
                        pcreg
                    )
                    VALUES
                        (
                        :tipo_doc,
                        :num_cta,
                        :cliente,
                        :vendedor,
                        DATE(NOW()),
                        :fecha_ven,
                        :monto,
                        :cod_pago,
                        :num_cta,
                        :usuario,
                        :saldo,
                        :usureg,
                        :pcreg
                        )";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":num_cta", $datos["num_cta"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_ven", $datos["fecha_ven"], PDO::PARAM_STR);
        $stmt->bindParam(":monto", $datos["monto"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_pago", $datos["cod_pago"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":saldo", $datos["saldo"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);

		if ($stmt->execute()) {

            return "ok";

		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostrarTablas($tipo, $estado, $valor){

		if($valor == null){

			$sql="SELECT
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.total,
                    v.cliente,
                    c.nombre,
                    c.tipo_documento AS tip_doc,
                    c.documento AS num_doc,
                    v.vendedor,
                    v.fecha,
                    cv.descripcion,
                    v.doc_destino,
                    LEFT(v.doc_destino,4) AS serie_dest,
                    SUBSTR(v.doc_destino,5,8) AS nro_dest,
                    v.estado,
                    IFNULL(a.nombre, '') AS agencia,
                    IFNULL(u.nom_ubi, '') AS ubigeo
                FROM
                    ventajf v
                    LEFT JOIN clientesjf c
                    ON v.cliente = c.codigo
                    LEFT JOIN condiciones_ventajf cv
                    ON v.condicion_venta = cv.id
                    LEFT JOIN agenciasjf a
                    ON v.agencia = a.id
                    LEFT JOIN ubigeojf u
                    ON c.ubigeo = u.cod_ubi
                WHERE v.tipo = :tipo
                    AND v.estado in (:estado)";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetchAll();

		}else{

			$sql="SELECT
                    v.tipo_documento,
                    v.documento,
                    v.total,
                    v.cliente,
                    c.nombre,
                    c.tipo_documento AS tip_doc,
                    c.documento AS num_doc,
                    v.vendedor,
                    v.fecha,
                    cv.descripcion,
                    v.doc_destino,
                    LEFT(v.doc_destino,4) AS serie_dest,
                    SUBSTR(v.doc_destino,5,8) AS nro_dest,
                    v.estado,
                    IFNULL(a.nombre, '') AS agencia,
                    IFNULL(u.nom_ubi, '') AS ubigeo
                FROM
                    ventajf v
                    LEFT JOIN clientesjf c
                    ON v.cliente = c.codigo
                    LEFT JOIN condiciones_ventajf cv
                    ON v.condicion_venta = cv.id
                    LEFT JOIN agenciasjf a
                    ON v.agencia = a.id
                    LEFT JOIN ubigeojf u
                    ON c.ubigeo = u.cod_ubi
                WHERE v.tipo = :tipo
                    AND v.estado = :estado
                    AND v.documento = :valor";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		$stmt->execute();

		return $stmt->fetch();

		}

		$stmt=null;

    }

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
    static public function mdlMostrarTablasB(){


        $sql="SELECT
                        v.tipo,
                        v.tipo_documento,
                        v.documento,
                        v.total,
                        v.cliente,
                        c.nombre,
                        c.tipo_documento AS tip_doc,
                        c.documento AS num_doc,
                        v.vendedor,
                        v.fecha,
                        cv.descripcion,
                        v.doc_destino,
                        LEFT(v.doc_destino,4) AS serie_dest,
                        SUBSTR(v.doc_destino,5,8) AS nro_dest,
                        v.estado,
                        IFNULL(a.nombre, '') AS agencia,
                        IFNULL(u.nom_ubi, '') AS ubigeo
                    FROM
                        ventajf v
                        LEFT JOIN clientesjf c
                        ON v.cliente = c.codigo
                        LEFT JOIN condiciones_ventajf cv
                        ON v.condicion_venta = cv.id
                        LEFT JOIN agenciasjf a
                        ON v.agencia = a.id
                        LEFT JOIN ubigeojf u
                        ON c.ubigeo = u.cod_ubi
                    WHERE v.tipo='S01' AND v.estado in ('GENERADO','FACTURADO')";

            $stmt=Conexion::conectar()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;
  
    }    

	/*
	* REGISTAR MOVIMIENTO DESDE GUIA
	*/
	static public function mdlFacturarGuiaM($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO movimientosjf_2021 (
                                                            tipo,
                                                            documento,
                                                            fecha,
                                                            articulo,
                                                            cliente,
                                                            vendedor,
                                                            cantidad,
                                                            precio,
                                                            dscto2,
                                                            total,
                                                            nombre_tipo
                                                        )
                                                        (SELECT
                                                            :tipo,
                                                            :documento,
                                                            :fecha,
                                                            m.articulo,
                                                            m.cliente,
                                                            m.vendedor,
                                                            m.cantidad,
                                                            m.precio,
                                                            m.dscto2,
                                                            m.total,
                                                            :nombre_tipo
                                                        FROM
                                                            movimientosjf_2021 m
                                                        WHERE m.documento = :codigo
                                                            AND m.tipo = :tipo_documento)");

        $stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_tipo", $datos["nombre_tipo"], PDO::PARAM_STR);





		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

	/*
	* REGISTAR VENTA DESDE GUIA
	*/
	static public function mdlFacturarGuiaV($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventajf (
                                                                tipo,
                                                                documento,
                                                                neto,
                                                                igv,
                                                                dscto,
                                                                total,
                                                                cliente,
                                                                vendedor,
                                                                agencia,
                                                                fecha,
                                                                tipo_documento,
                                                                lista_precios,
                                                                condicion_venta,
                                                                doc_origen,
                                                                usuario,
                                                                usureg,
                                                                pcreg
                                                            )
                                                            (SELECT
                                                                :tipo,
                                                                :documento,
                                                                v.neto,
                                                                v.igv,
                                                                v.dscto,
                                                                v.total,
                                                                v.cliente,
                                                                v.vendedor,
                                                                v.agencia,
                                                                v.fecha,
                                                                :tipo_documento,
                                                                v.lista_precios,
                                                                v.condicion_venta,
                                                                :codigo,
                                                                :usuario,
                                                                :usureg,
                                                                :pcreg
                                                            FROM
                                                                ventajf v
                                                            WHERE v.documento = :codigo
                                                                AND v.tipo = :tipo_ori)");

        $stmt->bindParam(":codigo", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_ori", $datos["tipo_ori"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

    /*
    * ACTUALIZAR GUIA A FACTURADO
    */
	static public function mdlActualizarGuiaF($codigo){

		$sql="UPDATE
                    ventajf
                SET
                    estado = 'FACTURADO'
                WHERE documento = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    /*
    * MOSTRAR DETALLE DE TEMPORAL
    */
	static public function mdlMostraVentaDocumento($valor, $tipoDoc){

		if($valor == null){

			$sql="SELECT
                        *
                    FROM
                        ventajf v";

		$stmt=Conexion::conectar()->prepare($sql);

		$stmt->execute();

		return $stmt->fetchAll();

		}else{

			$sql="SELECT
                        v.tipo,
                        v.documento,
                        v.neto,
                        v.igv,
                        v.dscto,
                        v.total,
                        v.cliente,
                        v.vendedor,
                        v.agencia,
                        v.fecha,
                        v.tipo_documento,
                        v.lista_precios,
                        v.condicion_venta,
                        cv.descripcion,
                        cv.dias,
                        v.doc_destino,
                        v.doc_origen
                    FROM
                        ventajf v
                        LEFT JOIN condiciones_ventajf cv
                        ON v.condicion_venta = cv.id
                    WHERE v.documento = :codigo
                        AND v.tipo = :tipo_doc";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		}

		$stmt=null;

	}

  /*
    * MOSTRAR IMPRESION DE NOTA DE DEBITO
    */
    static public function mdlMostrarDebitoImpresion($valor, $tipoDoc){

			$sql="SELECT 
            v.tipo,
            v.documento,
            v.neto,
            v.igv,
            v.dscto,
            v.total,
            n.observacion,
            n.doc_origen,
            n.motivo,
            (SELECT 
              descripcion 
            FROM
              maestrajf m 
            WHERE m.tipo_dato = 'TMOTD' 
              AND n.motivo = m.codigo) AS nom_motivo,
            (SELECT 
            descripcion 
          FROM
            maestrajf m 
          WHERE m.tipo_dato = 'TCON' 
            AND n.tip_cont = m.codigo) AS nom_tipo_con,
            DATE_FORMAT(n.fecha_origen,'%Y-%m-%d') AS fecha_origen,
            v.cliente,
            c.nombre,
            c.documento as dni,
            c.direccion,
            c.email,
            CONCAT(u.distrito, ' / ', u.provincia) AS nom_ubigeo,
            u.departamento,
            c.ubigeo,
            v.agencia,
            DATE_FORMAT(v.fecha,'%d/%m/%Y') AS fecha,
            v.fecha AS fecha_emision,
            v.tipo_documento,
            v.lista_precios,
            v.condicion_venta,
            cv.descripcion,
            v.vendedor,
            ven.descripcion AS nom_vendedor,
            cv.dias,
            v.doc_destino
            FROM
            ventajf v 
            LEFT JOIN condiciones_ventajf cv 
                ON v.condicion_venta = cv.id 
            LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
            LEFT JOIN ubigeo u 
                ON c.ubigeo = u.codigo 
                LEFT JOIN notascd_jf n
                ON v.documento=n.documento AND v.tipo=n.tipo
            LEFT JOIN 
                (SELECT 
                codigo,
                descripcion 
                FROM
                maestrajf m 
                WHERE m.tipo_dato = 'TVEND') ven 
                ON v.vendedor = ven.codigo 
            WHERE v.documento = :codigo
            AND v.tipo = :tipo_doc";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();


		$stmt=null;

	}

  /*
    * MOSTRAR IMPRESION DE FACTURA
    */
	static public function mdlMostrarVentaImpresion($valor, $tipoDoc){

			$sql="SELECT
      v.tipo,
      v.documento,
      v.neto,
      v.igv,
      v.dscto,
      v.total,
      n.observacion,
      n.tipo_doc,
      n.tip_cont,
      n.doc_origen,
      n.motivo,
      (SELECT 
          descripcion 
      FROM
          maestrajf m 
      WHERE m.tipo_dato = 'TMOT' 
          AND n.motivo = m.codigo) AS nom_motivo,
      DATE_FORMAT(n.fecha_origen, '%Y-%m-%d') AS fecha_origen,
      v.cliente,
      c.nombre,
      c.documento AS dni,
      c.direccion,
      c.email,
      CONCAT(u.distrito, ' / ', u.provincia) AS nom_ubigeo,
      u.departamento,
      c.ubigeo,
      v.agencia,
      DATE_FORMAT(v.fecha, '%d/%m/%Y') AS fecha,
      v.fecha AS fecha_emision,
      v.tipo_documento,
      v.lista_precios,
      v.condicion_venta,
      cv.descripcion,
      v.vendedor,
      ven.descripcion AS nom_vendedor,
      cv.dias,
      DATE_FORMAT(
          DATE_ADD(v.fecha, INTERVAL cv.dias DAY),
          '%d/%m/%Y'
      ) AS fecha_vencimiento,
      v.doc_destino,
      v.agencia,
      (SELECT 
          a.nombre 
      FROM
          agenciasjf a 
      WHERE v.agencia = a.id) AS nom_agencia,
      (SELECT 
          a.ruc 
      FROM
          agenciasjf a 
      WHERE v.agencia = a.id) AS ruc_agencia 
      FROM
      ventajf v 
      LEFT JOIN condiciones_ventajf cv 
          ON v.condicion_venta = cv.id 
      LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      LEFT JOIN notascd_jf n 
          ON v.documento = n.documento 
          AND v.tipo = n.tipo 
      LEFT JOIN 
          (SELECT 
          codigo,
          descripcion 
          FROM
          maestrajf m 
          WHERE m.tipo_dato = 'TVEND') ven 
          ON v.vendedor = ven.codigo 
                        WHERE v.documento = :codigo
                        AND v.tipo = :tipo_doc";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();


		$stmt=null;

	}

  /*
    * MOSTRAR MODELO PARA NC , FACTURA Y BOLETA
    */
	static public function mdlMostrarModeloImpresion($valor, $tipoDoc){

    $sql="SELECT 
    a.modelo,
    ROUND(SUM(cantidad), 0) AS cantidad,
    'C62' AS unidad,
    a.nombre,
    ROUND(m.precio, 2) AS precio,
    ROUND(m.dscto1, 2) AS dscto1,
    ROUND(SUM(m.cantidad * m.precio), 2) AS total 
  FROM
    movimientosjf_2021 m 
    LEFT JOIN articulojf a 
      ON m.articulo = a.articulo 
  WHERE m.tipo = :tipo_doc 
    AND m.documento = :codigo 
  GROUP BY a.modelo ";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);
      $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_STR);

  $stmt->execute();

  return $stmt->fetchAll();


  $stmt=null;

}

 /*
    * MOSTRAR MODELO PROFORMA IMPRESION
    */
    static public function mdlMostrarModeloProforma($valor, $tipoDoc){

      $sql="SELECT 
      a.modelo,
      ROUND(SUM(cantidad), 0) AS cantidad,
      'C62' AS unidad,
      a.nombre,
      ROUND(m.precio * 1.18, 2) AS precio,
      ROUND(m.dscto1, 2) AS dscto1,
      ROUND(SUM(m.cantidad * m.precio) * 1.18, 2) AS total 
    FROM
      movimientosjf_2021 m 
      LEFT JOIN articulojf a 
        ON m.articulo = a.articulo
    WHERE m.tipo = :tipo_doc 
      AND m.documento = :codigo 
    GROUP BY a.modelo ";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_STR);
  
    $stmt->execute();
  
    return $stmt->fetchAll();
  
  
    $stmt=null;
  
  }

 /*
    * MOSTRAR NUMERO DE UNIDADES BOLETA FACTURA
    */
    static public function mdlMostrarUnidadesImpresion($valor, $tipoDoc){

      $sql="SELECT 
      m.documento,
      ROUND(SUM(cantidad), 0) AS cantidad 
    FROM
      movimientosjf_2021 m 
    WHERE m.tipo = :tipo_doc 
      AND m.documento = :codigo 
    GROUP BY m.documento  ";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt -> bindParam(":codigo", $valor, PDO::PARAM_STR);
        $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_STR);
  
    $stmt->execute();
  
    return $stmt->fetch();
  
  
    $stmt=null;
  
  }
    /*=============================================
	MOSTRAR TIPO DE PAGO
	=============================================*/

	static public function mdlMostrarTalonarios($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT nota_credito FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT serie_nc FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    static public function mdlMostrarTalonariosDebito($tabla,$item,$valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT nota_debito FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT serie_nd FROM $tabla ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

    }

    	/*
	* REGISTAR DOCUMENTO  VENTA CON NOTA DE CREDITO O DEBITO
	*/
	static public function mdlRegistrarVentaNota($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO ventajf (
                                                        tipo,
                                                        documento,
                                                        neto,
                                                        igv,
                                                        dscto,
                                                        total,
                                                        cliente,
                                                        vendedor,
                                                        agencia,
                                                        fecha,
                                                        lista_precios,
                                                        tipo_documento,
                                                        doc_destino,
                                                        doc_origen,
                                                        usuario,
                                                        estado
                                                    )
                                                    VALUES
                                                        (
                                                        :tipo,
                                                        :documento,
                                                        :neto,
                                                        :igv,
                                                        0,
                                                        :total,
                                                        :cliente,
                                                        :vendedor,
                                                        '',
                                                        :fecha,
                                                        '',
                                                        :tipo_documento,
                                                        '',
                                                        :doc_origen,
                                                        :usuario,
                                                        'FACTURADO'
                                                        )");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
        $stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_documento", $datos["tipo_documento"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

     	/*
	* EDITAR DOCUMENTO  VENTA CON NOTA DE CREDITO O DEBITO
	*/
	static public function mdlEditarVentaNota($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE ventajf SET 
                                                        tipo = :tipo,
                                                        documento = :documento,
                                                        neto = :neto,
                                                        igv = :igv,
                                                        total = :total,
                                                        cliente = :cliente,
                                                        vendedor = :vendedor,
                                                        fecha = :fecha,
                                                        doc_origen = :doc_origen,
                                                        usuario = :usuario
                                                    WHERE tipo = :tipo
                                                    AND documento = :documento");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
        $stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }

     /*
    * Ingresar Notas de credito o debito 
    */
	static public function mdlIngresarNotaCD($datos){

		$sql="INSERT INTO notascd_jf (
                        tipo,
                        documento,
                        tipo_doc,
                        doc_origen,
                        fecha_origen,
                        motivo,
                        tip_cont,
                        observacion,
                        usuario
                    )
                    VALUES
                        (
                        :tipo,
                        :documento,
                        :tipo_doc,
                        :doc_origen,
                        :fecha_origen,
                        :motivo,
                        :tip_cont,
                        :observacion,
                        :usuario
                        )";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_origen", $datos["fecha_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":tip_cont", $datos["tip_cont"], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if ($stmt->execute()) {

            return "ok";

		} else {

			return "error";
		}

		$stmt=null;

    }

     	/*
	* EDITAR NOTA DE CREDITO O DEBITO
	*/
	static public function mdlEditarNotaCD($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE notascd_jf SET 
                                                        tipo = :tipo,
                                                        documento = :documento,
                                                        tipo_doc = :tipo_doc,
                                                        doc_origen = :doc_origen,
                                                        fecha_origen = :fecha_origen,
                                                        motivo = :motivo,
                                                        tip_cont = :tip_cont,
                                                        observacion = :observacion,
                                                        usuario = :usuario
                                                    WHERE tipo = :tipo
                                                    AND documento = :documento");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_doc", $datos["tipo_doc"], PDO::PARAM_STR);
        $stmt->bindParam(":doc_origen", $datos["doc_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_origen", $datos["fecha_origen"], PDO::PARAM_STR);
        $stmt->bindParam(":motivo", $datos["motivo"], PDO::PARAM_STR);
        $stmt->bindParam(":tip_cont", $datos["tip_cont"], PDO::PARAM_STR);
        $stmt->bindParam(":observacion", $datos["observacion"], PDO::PARAM_STR);
        $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
        


		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt->close();

		$stmt = null;

    }
    
    /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasNotasCD($fechaInicial,$fechaFinal){

        if($fechaInicial=="null"){
    
          $sql="SELECT 
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.total,
                    v.cliente,
                    c.nombre,
                    v.usuario,
                    u.nombre as nombres,
                    v.estado,
                    v.fecha,
                    CASE
                WHEN v.tipo = 'E05' 
                THEN 'NC' 
                ELSE 'ND' 
            END AS nombre_tipo  
                    FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                        ON v.cliente = c.codigo 
                    LEFT JOIN usuariosjf u 
                        ON v.usuario = u.id 
                    WHERE v.tipo IN ('E05', 'S05') 
                    AND YEAR(v.fecha) = 2022";
    
          $stmt=Conexion::conectar()->prepare($sql);
          
          $stmt->execute();
    
          return $stmt->fetchAll();
    
        }else if($fechaInicial == $fechaFinal){
    
          $sql="SELECT 
                        v.tipo,
                        v.tipo_documento,
                        v.documento,
                        v.total,
                        v.cliente,
                        c.nombre,
                        v.usuario,
                        u.nombre as nombres,
                        v.estado,
                        v.fecha ,
                        CASE
                    WHEN v.tipo = 'E05' 
                    THEN 'NC' 
                    ELSE 'ND' 
                END AS nombre_tipo 
                        FROM
                        ventajf v 
                        LEFT JOIN clientesjf c 
                            ON v.cliente = c.codigo 
                        LEFT JOIN usuariosjf u 
                            ON v.usuario = u.id 
                        WHERE v.tipo IN ('E05', 'S05') 
                        AND DATE(v.fecha)  like '%$fechaFinal%' ";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
    
          $stmt->execute();
          
          return $stmt->fetchAll();
    
        }else{
                $fechaActual = new DateTime();
                $fechaActual ->add(new DateInterval("P1D"));
                $fechaActualMasUno = $fechaActual->format("Y-m-d");
    
                $fechaFinal2 = new DateTime($fechaFinal);
                $fechaFinal2 ->add(new DateInterval("P1D"));
                $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");
    
                if($fechaFinalMasUno == $fechaActualMasUno){

                        $sql="SELECT 
                                            v.tipo,
                                            v.tipo_documento,
                                            v.documento,
                                            v.total,
                                            v.cliente,
                                            c.nombre,
                                            v.usuario,
                                            u.nombre as nombres,
                                            v.estado,
                                            v.fecha ,
                                            CASE
                                    WHEN v.tipo = 'E05' 
                                    THEN 'NC' 
                                    ELSE 'ND' 
                                END AS nombre_tipo 
                                        FROM
                                            ventajf v 
                                            LEFT JOIN clientesjf c 
                                            ON v.cliente = c.codigo 
                                            LEFT JOIN usuariosjf u 
                                            ON v.usuario = u.id 
                                        WHERE v.tipo IN ('E05', 'S05') 
                                            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
                
                    $stmt=Conexion::conectar()->prepare($sql);
                
                    $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
                
                    $stmt->execute();
                
                    return $stmt->fetchAll();
    
                }else{
                
                        $sql="SELECT 
                                            v.tipo,
                                            v.tipo_documento,
                                            v.documento,
                                            v.total,
                                            v.cliente,
                                            c.nombre,
                                            v.usuario,
                                            u.nombre as nombres,
                                            v.estado,
                                            v.fecha ,
                                            CASE
                                    WHEN v.tipo = 'E05' 
                                    THEN 'NC' 
                                    ELSE 'ND' 
                                END AS nombre_tipo 
                                        FROM
                                            ventajf v 
                                            LEFT JOIN clientesjf c 
                                            ON v.cliente = c.codigo 
                                            LEFT JOIN usuariosjf u 
                                            ON v.usuario = u.id 
                                        WHERE v.tipo IN ('E05', 'S05') 
                                            AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";
                
                        $stmt=Conexion::conectar()->prepare($sql);
                
                        $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);
                
                        $stmt->execute();
                
                        return $stmt->fetchAll();
                }
    
        }
    
          $stmt=null;
    
    }

        /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasFacturas($fechaInicial,$fechaFinal){

    if($fechaInicial=="null"){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      LEFT(v.doc_destino,4) AS serie_dest,
      SUBSTR(v.doc_destino,5,8) AS nro_dest,
      v.estado,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
  WHERE v.tipo = 'S03'
      AND v.estado = 'GENERADO'
      AND YEAR(v.fecha) = 2022";

      $stmt=Conexion::conectar()->prepare($sql);
      
      $stmt->execute();

      return $stmt->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      LEFT(v.doc_destino,4) AS serie_dest,
      SUBSTR(v.doc_destino,5,8) AS nro_dest,
      v.estado,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
  WHERE v.tipo = 'S03'
      AND v.estado = 'GENERADO'
      AND DATE(v.fecha)  like '%$fechaFinal%' ";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();
      
      return $stmt->fetchAll();

    }else{
      $fechaActual = new DateTime();
            $fechaActual ->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2 ->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if($fechaFinalMasUno == $fechaActualMasUno){
        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        LEFT(v.doc_destino,4) AS serie_dest,
        SUBSTR(v.doc_destino,5,8) AS nro_dest,
        v.estado,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
    WHERE v.tipo = 'S03'
        AND v.estado = 'GENERADO'
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetchAll();

      }else{

        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        LEFT(v.doc_destino,4) AS serie_dest,
        SUBSTR(v.doc_destino,5,8) AS nro_dest,
        v.estado,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
    WHERE v.tipo = 'S03'
        AND v.estado = 'GENERADO'
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }

    }

      $stmt=null;

  }

    /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasBoletas($fechaInicial,$fechaFinal){

    if($fechaInicial=="null"){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      LEFT(v.doc_destino,4) AS serie_dest,
      SUBSTR(v.doc_destino,5,8) AS nro_dest,
      v.estado,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
  WHERE v.tipo = 'S02'
      AND v.estado = 'GENERADO'
      AND YEAR(v.fecha) = 2022";

      $stmt=Conexion::conectar()->prepare($sql);
      
      $stmt->execute();

      return $stmt->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      LEFT(v.doc_destino,4) AS serie_dest,
      SUBSTR(v.doc_destino,5,8) AS nro_dest,
      v.estado,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
  WHERE v.tipo = 'S02'
      AND v.estado = 'GENERADO'
      AND DATE(v.fecha)  like '%$fechaFinal%' ";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();
      
      return $stmt->fetchAll();

    }else{
      $fechaActual = new DateTime();
            $fechaActual ->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2 ->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if($fechaFinalMasUno == $fechaActualMasUno){
        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        LEFT(v.doc_destino,4) AS serie_dest,
        SUBSTR(v.doc_destino,5,8) AS nro_dest,
        v.estado,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
    WHERE v.tipo = 'S02'
        AND v.estado = 'GENERADO'
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetchAll();

      }else{

        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        LEFT(v.doc_destino,4) AS serie_dest,
        SUBSTR(v.doc_destino,5,8) AS nro_dest,
        v.estado,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
    WHERE v.tipo = 'S02'
        AND v.estado = 'GENERADO'
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }

    }

      $stmt=null;

  }

    /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasProformas($fechaInicial,$fechaFinal){

    if($fechaInicial=="null"){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      LEFT(v.doc_destino,4) AS serie_dest,
      SUBSTR(v.doc_destino,5,8) AS nro_dest,
      v.estado,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
  WHERE v.tipo = 'S70'
      AND v.estado = 'GENERADO'
      AND YEAR(v.fecha) = 2022";

      $stmt=Conexion::conectar()->prepare($sql);
      
      $stmt->execute();

      return $stmt->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      LEFT(v.doc_destino,4) AS serie_dest,
      SUBSTR(v.doc_destino,5,8) AS nro_dest,
      v.estado,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
  WHERE v.tipo = 'S70'
      AND v.estado = 'GENERADO'
      AND DATE(v.fecha)  like '%$fechaFinal%' ";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();
      
      return $stmt->fetchAll();

    }else{
      $fechaActual = new DateTime();
            $fechaActual ->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2 ->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if($fechaFinalMasUno == $fechaActualMasUno){
        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        LEFT(v.doc_destino,4) AS serie_dest,
        SUBSTR(v.doc_destino,5,8) AS nro_dest,
        v.estado,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
    WHERE v.tipo = 'S70'
        AND v.estado = 'GENERADO'
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetchAll();

      }else{

        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        LEFT(v.doc_destino,4) AS serie_dest,
        SUBSTR(v.doc_destino,5,8) AS nro_dest,
        v.estado,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
    WHERE v.tipo = 'S70'
        AND v.estado = 'GENERADO'
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":mes", $mes, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }

    }

      $stmt=null;

  }


   /*
    * ACTUALIZAR PEDIDO A FACTURADO
    */
	static public function mdlActualizarPedido($codigo,$estado,$usuario){

		$sql="UPDATE
                    temporaljf
                SET
                    estado = :estado,
                    usuario_estado = :usuario_estado
                WHERE codigo = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":usuario_estado", $usuario, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }


     /*
    * ACTUALIZAR PEDIDO DE ARTICULO
    */
	static public function mdlActualizarArticuloPedido($codigo,$pedido){

		$sql="UPDATE articulojf SET pedidos = pedidos + :pedido WHERE articulo = :codigo";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
        $stmt->bindParam(":pedido", $pedido, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

    }

    static public function mdlMostrarVentaResumen($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        ve.descripcion,
        SUM(total) AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW()) 
      GROUP BY v.vendedor");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        ve.descripcion,
        ROUND(SUM(total)/1.18,2) AS total
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW()) 
      GROUP BY v.vendedor");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          ROUND(SUM(total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin 
        GROUP BY v.vendedor");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          SUM(total) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin
        GROUP BY v.vendedor");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          ROUND(SUM(total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin
          AND v.vendedor = :vendedor
        GROUP BY v.vendedor");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);

        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          SUM(total) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin
          AND v.vendedor = :vendedor
        GROUP BY v.vendedor");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          SUM(total) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.vendedor = :vendedor
        AND YEAR(v.fecha) = YEAR(NOW()) 
        GROUP BY v.vendedor");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'resumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          ROUND(SUM(total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.vendedor = :vendedor
        AND YEAR(v.fecha) = YEAR(NOW()) 
        GROUP BY v.vendedor");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

    static public function mdlMostrarTipoVentaResumen($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          SUM(total) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
        GROUP BY v.vendedor");

        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          ROUND(SUM(total)/1.18,2) AS total
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
        GROUP BY v.vendedor");

        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          ROUND(SUM(total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin 
        AND v.tipo = :documento
        GROUP BY v.vendedor");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          SUM(total) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin
        AND v.tipo = :documento
        GROUP BY v.vendedor");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          ROUND(SUM(total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin
          AND v.vendedor = :vendedor
          AND v.tipo = :documento
        GROUP BY v.vendedor");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          SUM(total) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
          AND :fin
          AND v.vendedor = :vendedor
          AND v.tipo = :documento
        GROUP BY v.vendedor");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          SUM(total) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.vendedor = :vendedor
        AND v.tipo = :documento
        AND YEAR(v.fecha) = YEAR(NOW()) 
        GROUP BY v.vendedor");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'resumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
          v.vendedor,
          ve.descripcion,
          ROUND(SUM(total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE v.vendedor = :vendedor
        AND v.tipo = :documento
        AND YEAR(v.fecha) = YEAR(NOW()) 
        GROUP BY v.vendedor");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

    static public function mdlMostrarVentaDetalle($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        
        $stmt = Conexion::conectar()->prepare("SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.fecha,
                    c.nombre,
                    v.total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.tipo NOT IN ('S01') 
                UNION
                SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    'subtotal' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    SUM(v.total) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.tipo not in ('S01')
                GROUP BY v.tipo,
                    v.tipo_documento,
                    v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'S99' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    SUM(v.total) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND  v.tipo NOT IN ('S01')
                GROUP BY v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'A00' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    ve.nom_ven AS nombre,
                    '' AS total 
                FROM
                    ventajf v 
                    LEFT JOIN 
                    (SELECT 
                        codigo,
                        descripcion AS nom_ven 
                    FROM
                        maestrajf 
                    WHERE tipo_dato = 'TVEND') AS ve 
                    ON v.vendedor = ve.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                ORDER BY vendedor,
                    tipo,
                    documento");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.fecha,
                    c.nombre,
                    ROUND(v.total/ 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.tipo NOT IN ('S01') 
                UNION
                SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    'subtotal' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    ROUND(SUM(v.total) / 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.tipo not in ('S01')
                GROUP BY v.tipo,
                    v.tipo_documento,
                    v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'S99' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    ROUND(SUM(v.total) / 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND  v.tipo NOT IN ('S01')
                GROUP BY v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'A00' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    ve.nom_ven AS nombre,
                    '' AS total 
                FROM
                    ventajf v 
                    LEFT JOIN 
                    (SELECT 
                        codigo,
                        descripcion AS nom_ven 
                    FROM
                        maestrajf 
                    WHERE tipo_dato = 'TVEND') AS ve 
                    ON v.vendedor = ve.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                ORDER BY vendedor,
                    tipo,
                    documento");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.fecha,
                    c.nombre,
                    ROUND(v.total/ 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.tipo NOT IN ('S01') 
                UNION
                SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    'subtotal' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    ROUND(SUM(v.total) / 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.tipo not in ('S01')
                GROUP BY v.tipo,
                    v.tipo_documento,
                    v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'S99' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    ROUND(SUM(v.total) / 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.tipo NOT IN ('S01')
                GROUP BY v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'A00' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    ve.nom_ven AS nombre,
                    '' AS total 
                FROM
                    ventajf v 
                    LEFT JOIN 
                    (SELECT 
                        codigo,
                        descripcion AS nom_ven 
                    FROM
                        maestrajf 
                    WHERE tipo_dato = 'TVEND') AS ve 
                    ON v.vendedor = ve.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                ORDER BY vendedor,
                    tipo,
                    documento");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
       
       $stmt = Conexion::conectar()->prepare("SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.fecha,
                    c.nombre,
                    v.total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin 
                    AND v.tipo NOT IN ('S01') 
                UNION
                SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    'subtotal' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    SUM(v.total) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.tipo not in ('S01')
                GROUP BY v.tipo,
                    v.tipo_documento,
                    v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'S99' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    SUM(v.total) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin 
                    AND v.tipo NOT IN ('S01')
                GROUP BY v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'A00' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    ve.nom_ven AS nombre,
                    '' AS total 
                FROM
                    ventajf v 
                    LEFT JOIN 
                    (SELECT 
                        codigo,
                        descripcion AS nom_ven 
                    FROM
                        maestrajf 
                    WHERE tipo_dato = 'TVEND') AS ve 
                    ON v.vendedor = ve.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                ORDER BY vendedor,
                    tipo,
                    documento");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.fecha,
                    c.nombre,
                    ROUND(v.total/ 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.vendedor = :vendedor
                    AND v.tipo not in ('S01')
                UNION
                SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    'subtotal' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    ROUND(SUM(v.total) / 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.vendedor = :vendedor
                    AND v.tipo not in ('S01')
                GROUP BY v.tipo,
                    v.tipo_documento,
                    v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'S99' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    ROUND(SUM(v.total) / 1.18, 2) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin
                    AND v.vendedor = :vendedor
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'A00' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    ve.nom_ven AS nombre,
                    '' AS total 
                FROM
                    ventajf v 
                    LEFT JOIN 
                    (SELECT 
                        codigo,
                        descripcion AS nom_ven 
                    FROM
                        maestrajf 
                    WHERE tipo_dato = 'TVEND') AS ve 
                    ON v.vendedor = ve.codigo 
                    WHERE v.fecha BETWEEN :inicio 
                    AND :fin                    
                    AND v.vendedor = :vendedor
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                ORDER BY vendedor,
                    tipo,
                    documento");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);

        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        
        $stmt = Conexion::conectar()->prepare("SELECT 
                v.vendedor,
                v.tipo,
                v.tipo_documento,
                v.documento,
                v.fecha,
                c.nombre,
                v.total 
            FROM
                ventajf v 
                LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
                WHERE v.fecha BETWEEN :inicio 
                AND :fin 
                AND v.vendedor = :vendedor
                AND v.tipo not in ('S01')
            UNION
            SELECT 
                v.vendedor,
                v.tipo,
                v.tipo_documento,
                'subtotal' AS documento,
                '' AS fecha,
                '' AS nombre,
                SUM(v.total) AS total 
            FROM
                ventajf v 
                LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
                WHERE v.fecha BETWEEN :inicio 
                AND :fin
                AND v.vendedor = :vendedor
                AND v.tipo not in ('S01')
            GROUP BY v.tipo,
                v.tipo_documento,
                v.vendedor 
            UNION
            SELECT 
                v.vendedor,
                'S99' AS tipo,
                '' AS tipo_documento,
                '' AS documento,
                '' AS fecha,
                '' AS nombre,
                SUM(v.total) AS total 
            FROM
                ventajf v 
                LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
                WHERE v.fecha BETWEEN :inicio 
                AND :fin 
                AND v.vendedor = :vendedor
                AND v.tipo not in ('S01')
            GROUP BY v.vendedor 
            UNION
            SELECT 
                v.vendedor,
                'A00' AS tipo,
                '' AS tipo_documento,
                '' AS documento,
                '' AS fecha,
                ve.nom_ven AS nombre,
                '' AS total 
            FROM
                ventajf v 
                LEFT JOIN 
                (SELECT 
                    codigo,
                    descripcion AS nom_ven 
                FROM
                    maestrajf 
                WHERE tipo_dato = 'TVEND') AS ve 
                ON v.vendedor = ve.codigo 
                WHERE v.fecha BETWEEN :inicio 
                AND :fin
                AND v.vendedor = :vendedor
                AND v.tipo not in ('S01')
            GROUP BY v.vendedor 
            ORDER BY vendedor,
                tipo,
                documento");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        
        $stmt = Conexion::conectar()->prepare("SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    v.documento,
                    v.fecha,
                    c.nombre,
                    v.total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.vendedor=:vendedor
                    AND v.tipo not in ('S01')
                UNION
                SELECT 
                    v.vendedor,
                    v.tipo,
                    v.tipo_documento,
                    'subtotal' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    SUM(v.total) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.vendedor = :vendedor
                    AND v.tipo not in ('S01')
                GROUP BY v.tipo,
                    v.tipo_documento,
                    v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'S99' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    '' AS nombre,
                    SUM(v.total) AS total 
                FROM
                    ventajf v 
                    LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.vendedor  = :vendedor
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                UNION
                SELECT 
                    v.vendedor,
                    'A00' AS tipo,
                    '' AS tipo_documento,
                    '' AS documento,
                    '' AS fecha,
                    ve.nom_ven AS nombre,
                    '' AS total 
                FROM
                    ventajf v 
                    LEFT JOIN 
                    (SELECT 
                        codigo,
                        descripcion AS nom_ven 
                    FROM
                        maestrajf 
                    WHERE tipo_dato = 'TVEND') AS ve 
                    ON v.vendedor = ve.codigo 
                    WHERE YEAR(v.fecha) = YEAR(NOW()) 
                    AND v.vendedor = :vendedor
                    AND v.tipo not in ('S01')
                GROUP BY v.vendedor 
                ORDER BY vendedor,
                    tipo,
                    documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'detallado' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
                v.vendedor,
                v.tipo,
                v.tipo_documento,
                v.documento,
                v.fecha,
                c.nombre,
                ROUND(v.total/ 1.18, 2) AS total 
            FROM
                ventajf v 
                LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
                WHERE YEAR(v.fecha) = YEAR(NOW()) 
                AND v.vendedor = :vendedor
            UNION
            SELECT 
                v.vendedor,
                v.tipo,
                v.tipo_documento,
                'subtotal' AS documento,
                '' AS fecha,
                '' AS nombre,
                ROUND(SUM(v.total) / 1.18, 2) AS total 
            FROM
                ventajf v 
                LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
                WHERE YEAR(v.fecha) = YEAR(NOW()) 
                AND v.vendedor = :vendedor
                AND v.tipo not in ('S01')
            GROUP BY v.tipo,
                v.tipo_documento,
                v.vendedor 
            UNION
            SELECT 
                v.vendedor,
                'S99' AS tipo,
                '' AS tipo_documento,
                '' AS documento,
                '' AS fecha,
                '' AS nombre,
                ROUND(SUM(v.total) / 1.18, 2) AS total 
            FROM
                ventajf v 
                LEFT JOIN clientesjf c 
                ON v.cliente = c.codigo 
                WHERE YEAR(v.fecha) = YEAR(NOW()) 
                AND v.vendedor = :vendedor
                AND v.tipo not in ('S01')
            GROUP BY v.vendedor 
            UNION
            SELECT 
                v.vendedor,
                'A00' AS tipo,
                '' AS tipo_documento,
                '' AS documento,
                '' AS fecha,
                ve.nom_ven AS nombre,
                '' AS total 
            FROM
                ventajf v 
                LEFT JOIN 
                (SELECT 
                    codigo,
                    descripcion AS nom_ven 
                FROM
                    maestrajf 
                WHERE tipo_dato = 'TVEND') AS ve 
                ON v.vendedor = ve.codigo 
                WHERE YEAR(v.fecha) = YEAR(NOW()) 
                AND v.vendedor = :vendedor
                AND v.tipo not in ('S01')
            GROUP BY v.vendedor 
            ORDER BY vendedor,
                tipo,
                documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

    static public function mdlMostrarTipoVentaDetalle($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");

        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total/ 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");
        
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total/ 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin 
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin 
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total/ 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE v.fecha BETWEEN :inicio 
        AND :fin
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor=:vendedor
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor  = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'detallado' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total/ 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        'subtotal' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.tipo,
        v.tipo_documento,
        v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        '' AS nombre,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS nombre,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW()) 
        AND v.vendedor = :vendedor
        AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        tipo,
        documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

    static public function mdlMostrarVentaPostalRsm($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio  
      AND :fin
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
        AND :fin 
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio  
      AND :fin
      AND v.vendedor= :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
        AND :fin 
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);

        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.vendedor = :vendedor
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'postalResumen' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

    static public function mdlMostrarTipoVentaPostalRsm($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");
        
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");
        
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio  
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
        AND :fin 
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio  
      AND :fin
      AND v.vendedor= :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
        AND :fin 
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'postalResumen' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
        v.vendedor,
        c.ubigeo,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        v.vendedor,
        '000000' AS ubigeo,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        v.vendedor,
        'Z' AS ubigeo,
        '' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

  static public function mdlMostrarVentaPostalDet($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
          c.ubigeo,
          v.vendedor,
          'S98' AS tipo,
          '' AS tipo_documento,
          '' AS documento,
          '' AS fecha,
          CONCAT(
            'Cod. Postal: ',
            RPAD(c.ubigeo, 6, ' '),
            ' ',
            u.departamento,
            ' / ',
            u.provincia,
            ' / ',
            u.distrito
          ) AS ubicacion,
          ROUND(SUM(v.total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN ubigeo u 
            ON c.ubigeo = u.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        GROUP BY v.vendedor,
          c.ubigeo 
        UNION
        SELECT 
          c.ubigeo,
          v.vendedor,
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.fecha,
          c.nombre,
          ROUND(v.total / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN ubigeo u 
            ON c.ubigeo = u.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        UNION
        SELECT 
          '' AS ubigeo,
          v.vendedor,
          'A00' AS tipo,
          '' AS tipo_documento,
          '' AS documento,
          '' AS fecha,
          ve.nom_ven AS ubicacion,
          '' AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion AS nom_ven 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        GROUP BY v.vendedor 
        UNION
        SELECT 
          'ZZZZZZ' AS ubigeo,
          v.vendedor,
          'S99' AS tipo,
          '' AS tipo_documento,
          '' AS documento,
          '' AS fecha,
          'TOTAL' AS ubicacion,
          ROUND(SUM(v.total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN ubigeo u 
            ON c.ubigeo = u.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        GROUP BY v.vendedor 
        ORDER BY vendedor,
          ubigeo,
          tipo,
          documento");
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);

        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.vendedor = :vendedor
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'postalDetalle' && $opdocumento == 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor  = :vendedor
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

    static public function mdlMostrarTipoVentaPostalDet($optipo,$opdocumento,$impuesto,$vend,$inicio,$fin){

      if($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '1' && $vend =='todos' && $inicio == 'todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio == 'todos' && $fin == 'todos'){
  
        $stmt = Conexion::conectar()->prepare("SELECT 
          c.ubigeo,
          v.vendedor,
          'S98' AS tipo,
          '' AS tipo_documento,
          '' AS documento,
          '' AS fecha,
          CONCAT(
            'Cod. Postal: ',
            RPAD(c.ubigeo, 6, ' '),
            ' ',
            u.departamento,
            ' / ',
            u.provincia,
            ' / ',
            u.distrito
          ) AS ubicacion,
          ROUND(SUM(v.total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN ubigeo u 
            ON c.ubigeo = u.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        AND v.tipo = :documento
        GROUP BY v.vendedor,
          c.ubigeo 
        UNION
        SELECT 
          c.ubigeo,
          v.vendedor,
          v.tipo,
          v.tipo_documento,
          v.documento,
          v.fecha,
          c.nombre,
          ROUND(v.total / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN ubigeo u 
            ON c.ubigeo = u.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        AND v.tipo = :documento
        UNION
        SELECT 
          '' AS ubigeo,
          v.vendedor,
          'A00' AS tipo,
          '' AS tipo_documento,
          '' AS documento,
          '' AS fecha,
          ve.nom_ven AS ubicacion,
          '' AS total 
        FROM
          ventajf v 
          LEFT JOIN 
            (SELECT 
              codigo,
              descripcion AS nom_ven 
            FROM
              maestrajf 
            WHERE tipo_dato = 'TVEND') AS ve 
            ON v.vendedor = ve.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        AND v.tipo = :documento
        GROUP BY v.vendedor 
        UNION
        SELECT 
          'ZZZZZZ' AS ubigeo,
          v.vendedor,
          'S99' AS tipo,
          '' AS tipo_documento,
          '' AS documento,
          '' AS fecha,
          'TOTAL' AS ubicacion,
          ROUND(SUM(v.total) / 1.18, 2) AS total 
        FROM
          ventajf v 
          LEFT JOIN clientesjf c 
            ON v.cliente = c.codigo 
          LEFT JOIN ubigeo u 
            ON c.ubigeo = u.codigo 
        WHERE YEAR(v.fecha) = YEAR(NOW())
        AND v.tipo = :documento
        GROUP BY v.vendedor 
        ORDER BY vendedor,
          ubigeo,
          tipo,
          documento");
        
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '0' && $vend == 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt -> bindParam(":inicio",$inicio, PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();
  
      }else if ($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '1' && $vend == 'todos' && $inicio !='todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.tipo = :documento
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt -> bindParam(":inicio" ,$inicio , PDO::PARAM_STR);
        $stmt -> bindParam(":fin" , $fin, PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt -> bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt -> bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt -> bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt -> bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        
        $stmt -> execute();
  
        return $stmt -> fetchAll();

      }else if ($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio != 'todos' && $fin != 'todos' ){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE v.fecha BETWEEN :inicio 
      AND :fin
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");
        
        $stmt->bindParam(":inicio",$inicio,PDO::PARAM_STR);
        $stmt->bindParam(":fin",$fin,PDO::PARAM_STR);
        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);
        $stmt -> execute();
  
        return $stmt -> fetchAll();
        
      }else if ($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '1' && $vend != 'todos' && $inicio=='todos' && $fin == 'todos'){
        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        v.total  AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        SUM(v.total) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();

      } else if($optipo == 'postalDetalle' && $opdocumento != 'todos' && $impuesto == '0' && $vend != 'todos' && $inicio == 'todos' && $fin == 'todos'){

        $stmt = Conexion::conectar()->prepare("SELECT 
        c.ubigeo,
        v.vendedor,
        'S98' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        CONCAT(
          'Cod. Postal: ',
          RPAD(c.ubigeo, 6, ' '),
          ' ',
          u.departamento,
          ' / ',
          u.provincia,
          ' / ',
          u.distrito
        ) AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor,
        c.ubigeo 
      UNION
      SELECT 
        c.ubigeo,
        v.vendedor,
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.fecha,
        c.nombre,
        ROUND(v.total / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor  = :vendedor
      AND v.tipo = :documento
      UNION
      SELECT 
        '' AS ubigeo,
        v.vendedor,
        'A00' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        ve.nom_ven AS ubicacion,
        '' AS total 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            codigo,
            descripcion AS nom_ven 
          FROM
            maestrajf 
          WHERE tipo_dato = 'TVEND') AS ve 
          ON v.vendedor = ve.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      UNION
      SELECT 
        'ZZZZZZ' AS ubigeo,
        v.vendedor,
        'S99' AS tipo,
        '' AS tipo_documento,
        '' AS documento,
        '' AS fecha,
        'TOTAL' AS ubicacion,
        ROUND(SUM(v.total) / 1.18, 2) AS total 
      FROM
        ventajf v 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
      WHERE YEAR(v.fecha) = YEAR(NOW())
      AND v.vendedor = :vendedor
      AND v.tipo = :documento
      GROUP BY v.vendedor 
      ORDER BY vendedor,
        ubigeo,
        tipo,
        documento");

        $stmt->bindParam(":vendedor",$vend,PDO::PARAM_STR);
        $stmt->bindParam(":documento",$opdocumento,PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }
  
      $stmt -> close();
  
      $stmt = null;
  
  
    }

          /*
	* Método para mostrar produccion de trusas
	*/
	static public function mdlRangoFechasProcesarCE($fechaInicial,$fechaFinal,$tipo){

    if($fechaInicial=="null"){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      v.estado,
      v.doc_origen as origen2,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo,
      n.doc_origen
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
      LEFT JOIN notascd_jf n 
      ON v.tipo = n.tipo 
      AND v.documento = n.documento 
  WHERE v.tipo = :tipo
      AND YEAR(v.fecha) = 2022";

      $stmt=Conexion::conectar()->prepare($sql);
      
      $stmt->bindParam(":tipo",$tipo,PDO::PARAM_STR);
      
      $stmt->execute();

      return $stmt->fetchAll();

    }else if($fechaInicial == $fechaFinal){

      $sql="SELECT
      v.tipo,
      v.tipo_documento,
      v.documento,
      v.total,
      v.cliente,
      c.nombre,
      c.tipo_documento AS tip_doc,
      c.documento AS num_doc,
      v.vendedor,
      v.fecha,
      cv.descripcion,
      v.doc_destino,
      v.facturacion,
      v.estado,
      v.doc_origen as origen2,
      IFNULL(a.nombre, '') AS agencia,
      IFNULL(u.nom_ubi, '') AS ubigeo,
      n.doc_origen
  FROM
      ventajf v
      LEFT JOIN clientesjf c
      ON v.cliente = c.codigo
      LEFT JOIN condiciones_ventajf cv
      ON v.condicion_venta = cv.id
      LEFT JOIN agenciasjf a
      ON v.agencia = a.id
      LEFT JOIN ubigeojf u
      ON c.ubigeo = u.cod_ubi
      LEFT JOIN notascd_jf n 
      ON v.tipo = n.tipo 
      AND v.documento = n.documento 
  WHERE v.tipo = :tipo
      AND DATE(v.fecha)  like '%$fechaFinal%' ";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);

      $stmt->execute();
      
      return $stmt->fetchAll();

    }else{
      $fechaActual = new DateTime();
            $fechaActual ->add(new DateInterval("P1D"));
            $fechaActualMasUno = $fechaActual->format("Y-m-d");

            $fechaFinal2 = new DateTime($fechaFinal);
            $fechaFinal2 ->add(new DateInterval("P1D"));
            $fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

            if($fechaFinalMasUno == $fechaActualMasUno){
        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        v.estado,
        v.doc_origen as origen2,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo,
        n.doc_origen
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
        LEFT JOIN notascd_jf n 
        ON v.tipo = n.tipo 
        AND v.documento = n.documento 
    WHERE v.tipo = :tipo
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetchAll();

      }else{

        $sql="SELECT
        v.tipo,
        v.tipo_documento,
        v.documento,
        v.total,
        v.cliente,
        c.nombre,
        c.tipo_documento AS tip_doc,
        c.documento AS num_doc,
        v.vendedor,
        v.fecha,
        cv.descripcion,
        v.doc_destino,
        v.facturacion,
        v.estado,
        v.doc_origen as origen2,
        IFNULL(a.nombre, '') AS agencia,
        IFNULL(u.nom_ubi, '') AS ubigeo,
        n.doc_origen
    FROM
        ventajf v
        LEFT JOIN clientesjf c
        ON v.cliente = c.codigo
        LEFT JOIN condiciones_ventajf cv
        ON v.condicion_venta = cv.id
        LEFT JOIN agenciasjf a
        ON v.agencia = a.id
        LEFT JOIN ubigeojf u
        ON c.ubigeo = u.cod_ubi
        LEFT JOIN notascd_jf n 
        ON v.tipo = n.tipo 
        AND v.documento = n.documento 
    WHERE v.tipo = :tipo
        AND DATE(v.fecha) BETWEEN '$fechaInicial' AND '$fechaFinal'";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();
      }

    }

      $stmt=null;

  }

   /*
    * ACTUALIZAR NOTA DE CREDITO O DEBITO + 1 POR SERIE
    */
    static public function mdlActualizarNotaSerie($item,$item2,$valor2){

      $sql="UPDATE
                      talonariosjf
                  SET
                      $item = $item + 1
                  WHERE $item2 = :$item2";
  
          $stmt=Conexion::conectar()->prepare($sql);
  
          $stmt->bindParam(":".$item2, $valor2, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
      } else {
  
        return "error";
      }
  
      $stmt=null;
  
      }
        /*
    * ACTUALIZAR ESTADO DE FACTURACION ELECTRONICA 
    */
	static public function mdlActualizarProcesoFacturacion($estado,$tipo,$documento){

		$sql="UPDATE 
                ventajf 
            SET
                facturacion = :estado 
            WHERE tipo = :tipo 
                AND documento = :documento ";

        $stmt=Conexion::conectar()->prepare($sql);

        
        $stmt->bindParam(":estado", $estado, PDO::PARAM_STR);
        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";
		} else {

			return "error";
		}

		$stmt=null;

  }

     /*
    * ACTUALIZAR TOKEN DE CONSULTA DE COMPROBANTES DE LA SUNAT
    */
    static public function mdlActualizarToken($valor,$valor2){

      $sql="UPDATE 
      maestrajf 
    SET
      descripcion = :descripcion,
      token = :token 
    WHERE tipo_dato = 'TOKEN' ";
  
          $stmt=Conexion::conectar()->prepare($sql);
          $stmt->bindParam(":descripcion", $valor2 ,PDO::PARAM_STR);
          $stmt->bindParam(":token", $valor, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
      } else {
  
        return "error";
      }
  
      $stmt=null;
  
    }

    /*
    * CONSULTA DE TOKEN
    */
    static public function mdlConsultarToken(){

      $sql="SELECT 
      *
      FROM maestrajf 
    WHERE tipo_dato = 'TOKEN' ";
  
      $stmt=Conexion::conectar()->prepare($sql);

      $stmt->execute();

      return $stmt->fetch();
  
      $stmt=null;
  
    }

    //* METODO EFACT
    static public function mdlFEFacturaCab($tipo, $documento){

    $sql="SELECT 
    /*FILA 1*/
    v.fecha AS a1,
    CONCAT(
      LEFT(v.documento, 4),
      '-',
      RIGHT(v.documento, 8)
    ) AS b1,
    CASE
      WHEN v.tipo = 'S03' 
      THEN '01' 
      ELSE '03' 
    END AS c1,
    'PEN' AS d1,
    v.neto - v.dscto AS e1,
    v.igv AS f1,
    'PEN' AS g1,
    v.total AS n1,
    '0101' AS q1,
    v.neto - v.dscto AS v1,
    COUNT(m.modelo) AS al1,
    v.dscto AS ar1,  
    v.igv AS bb1,
    v.neto - v.dscto AS bc1,
    v.total AS bd1,
    v.dscto AS bh1,
    /*FILA 3*/
    CONCAT(
      '0',
      LEFT(v.doc_origen, 3),
      '-0',
      RIGHT(v.doc_origen, 7)
    ) AS a3,
    '09' AS b3,
    'ATTACH_DOC' AS e3,
    /*FILA4*/
    'Corporacion Vasco S.A.C.' AS a4,
    'JACKYFORM' AS b4,
    '20513613939' AS c4,
    '150135' AS d4,
    'CAL. SANTO TORIBIO NRO. 259' AS e4,
    'URB. SANTA LUISA 1RA ETAPA' AS f4,
    'LIMA' AS g4,
    'LIMA' AS h4,
    'SAN MARTIN DE PORRES' AS i4,
    'PE' AS j4,
    'FINANZCO' AS k4,
    'josecorpo' AS l4,
    '0002' AS m4,
    /*FILA 5*/
    c.documento AS a5,
    c.tipo_documento AS b5,
    c.nombre AS c5,
    c.nombre AS d5,
    c.ubigeo AS e5,
    c.direccion AS f5,
    '' AS g5,
    u.departamento AS h5,
    u.provincia AS i5,
    u.distrito AS j5,
    'PE' AS k5,
    c.email AS l5,
    /*FILA 7*/
    CONCAT(
      'Nro.unidades: ',
      ROUND(SUM(m.cantidad), 3)
    ) AS a7,
    v.cliente AS d7,
    cv.descripcion AS e7,
    v.neto AS f7,
    CONCAT(ma.codigo, ' ', ma.descripcion) AS g7 
  FROM
    ventajf v 
    LEFT JOIN 
      (SELECT 
        m.tipo,
        m.documento,
        a.modelo,
        SUM(m.cantidad) AS cantidad 
      FROM
        movimientosjf_2021 m 
        LEFT JOIN articulojf a 
          ON m.articulo = a.articulo 
      WHERE m.tipo = :tipo
        AND m.documento = :documento 
      GROUP BY m.tipo,
        m.documento,
        a.modelo) AS m 
      ON v.tipo = m.tipo 
      AND v.documento = m.documento 
    LEFT JOIN clientesjf c 
      ON v.cliente = c.codigo 
    LEFT JOIN ubigeo u 
      ON c.ubigeo = u.codigo 
    LEFT JOIN condiciones_ventajf cv 
      ON v.condicion_venta = cv.codigo 
    LEFT JOIN maestrajf ma 
      ON ma.tipo_dato = 'TVEND' 
      AND v.vendedor = ma.codigo 
  WHERE v.tipo = :tipo
    AND v.documento = :documento";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);

    $stmt->execute();

    return $stmt->fetch();


    $stmt=null;

    }

    static public function mdlFEFacturaDet($tipo, $documento){

      $sql="SELECT 
      'C62' AS b9,
      ROUND(SUM(m.cantidad), 2) AS c9,
      REPLACE(a.nombre, 'Ñ', 'N') AS d9,
      ROUND(m.precio * 1.18, 2) AS e9,
      '1' AS f9,
      ROUND(m.precio * SUM(m.cantidad), 2) AS i9,
      ROUND(
        ROUND(m.precio * SUM(m.cantidad), 2) * 0.18,
        2
      ) AS j9,
      '10' AS k9,
      '1000' AS l9,
      '18' AS m9,
      a.modelo AS s9,
      ROUND(m.precio, 2) AS t9,
     ROUND(m.precio * SUM(m.cantidad), 2) AS u9 ,
       ROUND(
        ROUND(m.precio * SUM(m.cantidad), 2) * 0.18,
        2
      ) AS ak9,
      ROUND((m.precio * SUM(m.cantidad))*1.18, 2) AS al9
    FROM
      movimientosjf_2021 m 
      LEFT JOIN articulojf a 
        ON m.articulo = a.articulo 
    WHERE m.tipo = :tipo 
      AND m.documento = :documento
    GROUP BY m.tipo,
      m.documento,
      a.modelo";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);
  
      $stmt->execute();
  
      return $stmt->fetchAll();
  
  
      $stmt=null;
  
    }

    //* METODO NUBE
    static public function mdlFEFacturaCabA($tipo, $documento){

        $sql="SELECT 
            /*FILA 1*/
            DATE_FORMAT(v.fecha,'%d/%m/%Y') AS a1,
            CONCAT(
                LEFT(v.documento, 4),
                '-',
                RIGHT(v.documento, 8)
            ) AS b1,
            CASE
                WHEN v.tipo = 'S03' 
                THEN '01' 
                ELSE '03' 
            END AS c1,
            'PEN' AS d1,
            v.igv AS e1,
            v.igv AS f1,
            'PEN' AS g1,
            v.total AS n1,
            CASE
              WHEN v.condicion_venta IN ('1', '2') 
              THEN 'CONTADO' 
              ELSE 'CREDITO' 
            END AS o1,            
            '0101' AS q1,
            v.neto - v.dscto AS v1,
            v.neto - v.dscto AS z1,
            v.neto - v.dscto AS al1,
            COUNT(m.modelo) AS as1,
            '1' AS at1,
            /*v.dscto AS ar1,*/
            v.igv AS bh1,
            v.neto - v.dscto AS bi1,
            v.total AS bj1,
            /*v.dscto AS bh1,*/
            /*FILA 3*/
            CONCAT(
              '0',
              LEFT(v.doc_origen, 3),
              '-0',
              RIGHT(v.doc_origen, 7)
            ) AS a3,
            '09' AS b3,
            CASE
              WHEN v.condicion_venta IN ('1', '2') 
              THEN '' 
              ELSE 'CUOTA001' 
            END AS e3,
            CASE
              WHEN v.condicion_venta IN ('1', '2') 
              THEN '' 
              ELSE v.total 
            END AS f3,
            CASE
              WHEN v.condicion_venta IN ('1', '2') 
              THEN '' 
              ELSE DATE_FORMAT(
                DATE_ADD(v.fecha, INTERVAL cv.dias DAY),
                '%d/%m/%Y'
              ) 
            END AS g3,
            'ATTACH_DOC' AS h3,
            /*FILA4*/
            'Corporacion Vasco S.A.C.' AS a4,
            'JACKY FORM' AS b4,
            '20513613939' AS c4,
            '' AS d4,
            'CAL.SANTO TORIBIO NRO. 259' AS e4,
            'URB.SANTA LUISA 1RA ETAPA' AS f4,
            'LIMA' AS g4,
            'LIMA' AS h4,
            'SAN MARTIN DE PORRES' AS i4,
            'PE' AS j4,
            'FINANZCO' AS k4,
            'josecorpo' AS l4,
            '0000' AS m4,
            /*FILA 5*/
            c.documento AS a5,
            c.tipo_documento AS b5,
            c.nombre AS c5,
            '' AS d5,
            CASE
                WHEN LENGTH(c.ubigeo) = 6 
                THEN c.ubigeo 
                ELSE '' 
            END AS e5,
            c.direccion AS f5,
            '-' AS g5,
            u.departamento AS h5,
            u.provincia AS i5,
            u.distrito AS j5,
            'PE' AS k5,
            c.email AS l5,
            /*FILA 7*/
            CONCAT(
                'Nro.unidades: ',
                ROUND(SUM(m.cantidad), 3)
            ) AS a7,
            v.cliente AS d7,
            cv.descripcion AS e7,
            v.neto AS f7,
            CONCAT(ma.codigo, '   ', ma.descripcion) AS g7 
      FROM
        ventajf v 
        LEFT JOIN 
          (SELECT 
            m.tipo,
            m.documento,
            a.modelo,
            SUM(m.cantidad) AS cantidad 
          FROM
            movimientosjf_2021 m 
            LEFT JOIN articulojf a 
              ON m.articulo = a.articulo 
          WHERE m.tipo = :tipo
            AND m.documento = :documento 
          GROUP BY m.tipo,
            m.documento,
            a.modelo) AS m 
          ON v.tipo = m.tipo 
          AND v.documento = m.documento 
        LEFT JOIN clientesjf c 
          ON v.cliente = c.codigo 
        LEFT JOIN ubigeo u 
          ON c.ubigeo = u.codigo 
        LEFT JOIN condiciones_ventajf cv 
          ON v.condicion_venta = cv.codigo 
        LEFT JOIN maestrajf ma 
          ON ma.tipo_dato = 'TVEND' 
          AND v.vendedor = ma.codigo 
      WHERE v.tipo = :tipo
        AND v.documento = :documento";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
          $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetch();    
    
        $stmt=null;
    
    }  

    //* MODELO SEGUN NUBE    
    static public function mdlFEFacturaDetA($tipo, $documento){

        $sql="SELECT 
                'C62' AS b9,
                ROUND(SUM(m.cantidad), 3) AS c9,
                REPLACE(a.nombre, 'Ñ', 'N') AS d9,
                ROUND(m.precio * 1.18, 2) AS e9,
                '01' AS f9,
                ROUND(
                    ROUND(m.precio * SUM(m.cantidad), 2) * 0.18,
                    2
                ) AS i9,
                ROUND(
                    ROUND(m.precio * SUM(m.cantidad), 2) * 0.18,
                    2
                ) AS j9,
                '10' AS k9,
                '1000' AS l9,
                '18' AS m9,
                a.modelo AS s9,
                ROUND(m.precio, 2) AS t9,
                ROUND(ROUND(m.precio, 2) * SUM(m.cantidad), 2) AS u9,
                ROUND(ROUND(m.precio, 2) * SUM(m.cantidad), 2) AS x9,
                ROUND(
                    ROUND(m.precio * SUM(m.cantidad), 2) * 0.18,
                    2
                ) AS ap9 
      FROM
        movimientosjf_2021 m 
        LEFT JOIN articulojf a 
          ON m.articulo = a.articulo 
      WHERE m.tipo = :tipo 
        AND m.documento = :documento
      GROUP BY m.tipo,
        m.documento,
        a.modelo";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
          $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll();
    
    
        $stmt=null;
    
    }    

    //* METODO NUBE CREDITO
    static public function mdlFENCACabA($tipo, $documento){

        $sql="SELECT 
                /*FILA 1*/
                DATE_FORMAT(v.fecha, '%d/%m/%Y') AS a1,
                CONCAT(
                  LEFT(v.documento, 4),
                  '-',
                  RIGHT(v.documento, 8)
                ) AS b1,
                'PEN' AS c1,
                v.igv * - 1 AS d1,
                v.igv * - 1 AS e1,
                'PEN' AS f1,
                v.total * - 1 AS m1,
                (v.neto - v.dscto) * - 1 AS p1,
                (v.neto - v.dscto) * - 1 AS t1,
                (v.neto - v.dscto) * - 1 AS ae1,
                '1' AS aj1,
                '1' AS ak1,
                v.igv * - 1 AS an1,
                /*FILA 3*/
                'Corporacion Vasco S.A.C.' AS a3,
                'JACKY FORM' AS b3,
                '20513613939' AS c3,
                '' AS d3,
                'CAL.SANTO TORIBIO NRO. 259' AS e3,
                'URB.SANTA LUISA 1RA ETAPA' AS f3,
                'LIMA' AS g3,
                'LIMA' AS h3,
                'SAN MARTIN DE PORRES' AS i3,
                'PE' AS j3,
                'FINANZCO' AS k3,
                'josecorpo' AS l3,
                '0000' AS m3,
                /*FILA 5*/
                c.documento AS a4,
                c.tipo_documento AS b4,
                c.nombre AS c4,
                '' AS d4,
                CASE
                  WHEN LENGTH(c.ubigeo) = 6 
                  THEN c.ubigeo 
                  ELSE '' 
                END AS e4,
                c.direccion AS f4,
                '-' AS g4,
                u.departamento AS h4,
                u.provincia AS i4,
                u.distrito AS j4,
                'PE' AS k4,
                c.email AS l4,
                /*FILA 6*/
                CONCAT(
                  'Nro.unidades: ',
                  ROUND(SUM(m.cantidad) * - 1, 0)
                ) AS a6,
                v.cliente AS d6,
                '' AS e6,
                v.neto *-1 AS f6,
                CONCAT(ma.codigo, '   ', ma.descripcion) AS g6,
                /*FILA 7*/
                CONCAT(
                  LEFT(n.doc_origen, 4),
                  '-',
                  RIGHT(n.doc_origen, 8)
                ) AS a7,
                n.tipo_doc AS b7,
                (SELECT 
                  argumento 
                FROM
                  maestrajf m 
                WHERE m.tipo_dato = 'TMOT' 
                  AND m.codigo = n.motivo) AS c7,
                (SELECT 
                  descripcion 
                FROM
                  maestrajf m 
                WHERE m.tipo_dato = 'TMOT' 
                  AND m.codigo = n.motivo) AS d7,
                DATE_FORMAT(n.fecha_origen, '%d/%m/%Y') AS e7,
                'RELATED_DOC' AS f7 
                FROM
                  ventajf v 
                  LEFT JOIN 
                    (SELECT 
                      m.tipo,
                      m.documento,
                      a.modelo,
                      SUM(m.cantidad) AS cantidad 
                    FROM
                      movimientosjf_2021 m 
                      LEFT JOIN articulojf a 
                        ON m.articulo = a.articulo 
                    WHERE m.tipo = :tipo 
                      AND m.documento = :documento 
                    GROUP BY m.tipo,
                      m.documento,
                      a.modelo) AS m 
                    ON v.tipo = m.tipo 
                    AND v.documento = m.documento 
                  LEFT JOIN clientesjf c 
                    ON v.cliente = c.codigo 
                  LEFT JOIN ubigeo u 
                    ON c.ubigeo = u.codigo 
                  LEFT JOIN condiciones_ventajf cv 
                    ON v.condicion_venta = cv.codigo 
                  LEFT JOIN maestrajf ma 
                    ON ma.tipo_dato = 'TVEND' 
                    AND v.vendedor = ma.codigo 
                  LEFT JOIN notascd_jf n 
                    ON v.tipo = n.tipo 
                    AND v.documento = n.documento 
                WHERE v.tipo = :tipo 
                  AND v.documento = :documento";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetch();    

        $stmt=null;

    }    

    //* MODELO SEGUN NUBE    
    static public function mdlFENCDetA($tipo, $documento){

      $sql="SELECT 
                'C62' AS b9,
                ROUND(SUM(m.cantidad)*-1, 3) AS c9,
                REPLACE(a.nombre, 'Ñ', 'N') AS d9,
                ROUND(m.precio * 1.18, 2) AS e9,
                '01' AS f9,
                ROUND(
                    ROUND(m.precio * SUM(m.cantidad), 2) * 0.18*-1,
                    2
                ) AS i9,
                ROUND(
                    ROUND(m.precio * SUM(m.cantidad), 2) * 0.18*-1,
                    2
                ) AS j9,
                '10' AS k9,
                '1000' AS l9,
                '18' AS m9,
                a.modelo AS s9,
                ROUND(m.precio, 2) AS t9,
                ROUND(
                    ROUND(m.precio, 2) * SUM(m.cantidad)*-1,
                    2
                ) AS u9,
                    ROUND(
                ROUND(m.precio, 2) * SUM(m.cantidad)*-1,
                    2
                ) AS x9,
                ROUND(
                    ROUND(m.precio * SUM(m.cantidad), 2) * 0.18*-1,
                    2
                ) AS ad9 
                    FROM
                    movimientosjf_2021 m 
                    LEFT JOIN articulojf a 
                        ON m.articulo = a.articulo 
                    WHERE m.tipo = :tipo 
                    AND m.documento = :documento
                    GROUP BY m.tipo,
                    m.documento,
                    a.modelo";
  
        $stmt=Conexion::conectar()->prepare($sql);
  
        $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);
  
      $stmt->execute();
  
      return $stmt->fetchAll();
  
  
      $stmt=null;
  
  }    
  
    //* MODELO SEGUN NUBE    
    static public function mdlFENCDetB($tipo, $documento){

        $sql="SELECT 
                'ZZ' AS b8,
                '1' AS c8,
                n.observacion AS d8,
                v.total * - 1 AS e8,
                '01' AS f8,
                v.igv * - 1 AS i8,
                v.igv * - 1 AS j8,
                '10' AS k8,
                '1000' AS l8,
                '18' AS m8,
                v.neto * - 1 AS t8,
                v.neto * - 1 AS u8,
                v.neto * - 1 AS x8,
                v.igv * - 1 AS ad8 
                FROM
                    notascd_jf n 
                    LEFT JOIN ventajf v 
                    ON n.tipo = v.tipo 
                    AND n.documento = v.documento 
                WHERE n.tipo = :tipo 
                    AND n.documento = :documento";

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);

        $stmt->execute();

        return $stmt->fetchAll();


        $stmt=null;
  
  }  

  /*
  * MOSTRAR IMPRESION DE NOTA DE CREDITO
  */
	static public function mdlMostrarCreditoImpresion($valor, $tipoDoc){

        $sql="SELECT 
              v.tipo,
              v.documento,
              v.neto,
              v.igv,
              v.dscto,
              v.total,
              n.observacion,
              n.doc_origen,
              n.motivo,
              (SELECT 
                descripcion 
              FROM
                maestrajf m 
              WHERE m.tipo_dato = 'TMOT' 
                AND n.motivo = m.codigo) AS nom_motivo,
              (SELECT 
              descripcion 
            FROM
              maestrajf m 
            WHERE m.tipo_dato = 'TCON' 
              AND n.tip_cont = m.codigo) AS nom_tipo_con,
              DATE_FORMAT(n.fecha_origen,'%Y-%m-%d') AS fecha_origen,
              v.cliente,
              c.nombre,
              c.documento as dni,
              c.direccion,
              c.email,
              CONCAT(u.distrito, ' / ', u.provincia) AS nom_ubigeo,
              u.departamento,
              c.ubigeo,
              v.agencia,
              DATE_FORMAT(v.fecha,'%d/%m/%Y') AS fecha,
              v.fecha AS fecha_emision,
              v.tipo_documento,
              v.lista_precios,
              v.condicion_venta,
              cv.descripcion,
              v.vendedor,
              ven.descripcion AS nom_vendedor,
              cv.dias,
              v.doc_destino
              FROM
              ventajf v 
              LEFT JOIN condiciones_ventajf cv 
                  ON v.condicion_venta = cv.id 
              LEFT JOIN clientesjf c 
                  ON v.cliente = c.codigo 
              LEFT JOIN ubigeo u 
                  ON c.ubigeo = u.codigo 
                  LEFT JOIN notascd_jf n
                  ON v.documento=n.documento AND v.tipo=n.tipo
              LEFT JOIN 
                  (SELECT 
                  codigo,
                  descripcion 
                  FROM
                  maestrajf m 
                  WHERE m.tipo_dato = 'TVEND') ven 
                  ON v.vendedor = ven.codigo 
              WHERE v.documento = :codigo
              AND v.tipo = :tipo_doc";
    
                  $stmt=Conexion::conectar()->prepare($sql);
    
                  $stmt -> bindParam(":codigo", $valor, PDO::PARAM_INT);
                  $stmt -> bindParam(":tipo_doc", $tipoDoc, PDO::PARAM_INT);
    
                  $stmt->execute();
    
                  return $stmt->fetch();
    
    
                  $stmt=null;
    
    }    


    //* METODO NUBE DEBITP
    static public function mdlFENDACabA($tipo, $documento){

      $sql="SELECT 
                /*FILA 1*/
                DATE_FORMAT(v.fecha, '%d/%m/%Y') AS a1,
                CONCAT(
                  LEFT(v.documento, 4),
                  '-',
                  RIGHT(v.documento, 8)
                ) AS b1,
                'PEN' AS c1,
                v.igv AS d1,
                v.igv AS e1,
                'PEN' AS f1,
                v.total AS m1,
                v.neto - v.dscto AS p1,
                v.neto - v.dscto AS t1,
                v.neto - v.dscto AS ae1,
                '1' AS aj1,
                '1' AS ak1,
                v.igv AS an1,
                /*FILA 3*/
                'Corporacion Vasco S.A.C.' AS a3,
                'JACKY FORM' AS b3,
                '20513613939' AS c3,
                '' AS d3,
                'CAL.SANTO TORIBIO NRO. 259' AS e3,
                'URB.SANTA LUISA 1RA ETAPA' AS f3,
                'LIMA' AS g3,
                'LIMA' AS h3,
                'SAN MARTIN DE PORRES' AS i3,
                'PE' AS j3,
                'FINANZCO' AS k3,
                'josecorpo' AS l3,
                '0000' AS m3,
                /*FILA 5*/
                c.documento AS a4,
                c.tipo_documento AS b4,
                c.nombre AS c4,
                '' AS d4,
                CASE
                  WHEN LENGTH(c.ubigeo) = 6 
                  THEN c.ubigeo 
                  ELSE '' 
                END AS e4,
                c.direccion AS f4,
                '-' AS g4,
                u.departamento AS h4,
                u.provincia AS i4,
                u.distrito AS j4,
                'PE' AS k4,
                c.email AS l4,
                /*FILA 6*/
                CONCAT(
                  'Nro.unidades: ',
                  ROUND(SUM(m.cantidad) * - 1, 0)
                ) AS a6,
                v.cliente AS d6,
                '' AS e6,
                v.neto AS f6,
                CONCAT(ma.codigo, '   ', ma.descripcion) AS g6,
                /*FILA 7*/
                CONCAT(
                  LEFT(n.doc_origen, 4),
                  '-',
                  RIGHT(n.doc_origen, 8)
                ) AS a7,
                n.tipo_doc AS b7,
                (SELECT 
                  argumento 
                FROM
                  maestrajf m 
                WHERE m.tipo_dato = 'TMOTD' 
                  AND m.codigo = n.motivo) AS c7,
                (SELECT 
                  descripcion 
                FROM
                  maestrajf m 
                WHERE m.tipo_dato = 'TMOTD' 
                  AND m.codigo = n.motivo) AS d7,
                DATE_FORMAT(n.fecha_origen, '%d/%m/%Y') AS e7,
                'RELATED_DOC' AS f7 
              FROM
                ventajf v 
                LEFT JOIN 
                  (SELECT 
                    m.tipo,
                    m.documento,
                    a.modelo,
                    SUM(m.cantidad) AS cantidad 
                  FROM
                    movimientosjf_2021 m 
                    LEFT JOIN articulojf a 
                      ON m.articulo = a.articulo 
                  WHERE m.tipo = :tipo 
                    AND m.documento = :documento 
                  GROUP BY m.tipo,
                    m.documento,
                    a.modelo) AS m 
                  ON v.tipo = m.tipo 
                  AND v.documento = m.documento 
                LEFT JOIN clientesjf c 
                  ON v.cliente = c.codigo 
                LEFT JOIN ubigeo u 
                  ON c.ubigeo = u.codigo 
                LEFT JOIN condiciones_ventajf cv 
                  ON v.condicion_venta = cv.codigo 
                LEFT JOIN maestrajf ma 
                  ON ma.tipo_dato = 'TVEND' 
                  AND v.vendedor = ma.codigo 
                LEFT JOIN notascd_jf n 
                  ON v.tipo = n.tipo 
                  AND v.documento = n.documento 
              WHERE v.tipo = :tipo 
                AND v.documento = :documento";

      $stmt=Conexion::conectar()->prepare($sql);

      $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);

      $stmt->execute();

      return $stmt->fetch();    

      $stmt=null;

  }      

    //* MODELO SEGUN NUBE    
    static public function mdlFENDDetA($tipo, $documento){

        $sql="SELECT 
                'ZZ' AS b8,
                '1' AS c8,
                n.observacion AS d8,
                v.total AS e8,
                '01' AS f8,
                v.igv AS i8,
                v.igv AS j8,
                '10' AS k8,
                '1000' AS l8,
                '18.00' AS m8,
                v.neto AS t8,
                v.neto AS u8,
                v.neto AS x8,
                v.igv AS ad8 
            FROM
                notascd_jf n 
                LEFT JOIN ventajf v 
                ON n.tipo = v.tipo 
                AND n.documento = v.documento 
            WHERE n.tipo = :tipo 
                AND n.documento = :documento";
    
          $stmt=Conexion::conectar()->prepare($sql);
    
          $stmt -> bindParam(":tipo", $tipo, PDO::PARAM_STR);
          $stmt -> bindParam(":documento", $documento, PDO::PARAM_STR);
    
        $stmt->execute();
    
        return $stmt->fetchAll();
    
    
        $stmt=null;
    
    }  

    /*
	* ESTADO PROCESAR DOCUMENTO
	*/
	static public function mdlEnviarTXT($tipo, $documento){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    ventajf 
                                                SET
                                                    estado = 'ENVIADO',
                                                    facturacion = '2' 
                                                WHERE tipo = :tipo 
                                                    AND documento = :documento");

        $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
        $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		} else {

			return "error";

		}

		$stmt->close();

		$stmt = null;

    }

    static public function mdlRegresarStock($tipo, $documento){

      $sql="UPDATE 
            articulojf a 
            LEFT JOIN movimientosjf_2021 m 
              ON a.articulo = m.articulo SET a.stock = a.stock + m.cantidad 
          WHERE m.tipo = :tipo 
            AND m.documento = :documento";
  
      $stmt=Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
  
      }else{
  
        return "error";
  
      }
  
      $stmt=null;
  
    }    

    static public function mdlEliminarDetalle($tipo, $documento){

      $sql="DELETE 
              FROM
                movimientosjf_2021  
              WHERE tipo = :tipo
                AND documento = :documento";
  
      $stmt=Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
  
      }else{
  
        return $stmt->errorInfo();
  
      }
  
      $stmt=null;
  
    }      


    static public function mdlAnularCabecera($tipo, $documento, $usuario, $usureg, $pcreg){

      $sql="UPDATE 
                  ventajf 
                SET
                  neto = 0,
                  igv = 0,
                  dscto = 0,
                  total = 0,
                  cliente = '',
                  vendedor = '',
                  agencia = '',
                  lista_precios = '',
                  condicion_venta = '',
                  usuario = :usuario,
                  fecha_creacion = NOW(),
                  estado = 'ANULADO',
                  facturacion = '4',
                  usureg = :usureg,
                  pcreg = :pcreg 
                WHERE tipo = :tipo 
                  AND documento = :documento";
  
      $stmt=Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
      $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
      $stmt->bindParam(":usureg", $usureg, PDO::PARAM_STR);
      $stmt->bindParam(":pcreg", $pcreg, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
  
      }else{
  
        return $stmt->errorInfo();
  
      }
  
      $stmt=null;
  
    }  

    static public function mdlEliminarCta($tip, $documento){

      $sql="DELETE 
                FROM
                  cuenta_ctejf 
                WHERE tipo_doc = :tipo 
                  AND num_cta = :documento";
  
      $stmt=Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":tipo", $tip, PDO::PARAM_STR);
      $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
  
      }else{
  
        return $stmt->errorInfo();
  
      }
  
      $stmt=null;
  
    }  

    static public function mdlEliminarDocumento($tipo, $documento){

      $sql="DELETE 
              FROM
                ventajf 
              WHERE tipo = :tipo 
                AND documento = :documento";
  
      $stmt=Conexion::conectar()->prepare($sql);
  
      $stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
      $stmt->bindParam(":documento", $documento, PDO::PARAM_STR);
  
      if ($stmt->execute()) {
  
        return "ok";
  
      }else{
  
        return $stmt->errorInfo();
  
      }
  
      $stmt=null;
  
    }  

}