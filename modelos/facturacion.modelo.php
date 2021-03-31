<?php
require_once "conexion.php";

class ModeloFacturacion{

	/*
	* REGISTAR MOVIMIENTOS 
	*/
	static public function mdlRegistrarMovimientos($datos){

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
                                                    (
                                                    :tipo,
                                                    :documento,
                                                    DATE(NOW()),
                                                    :articulo,
                                                    :cliente,
                                                    :vendedor,
                                                    :cantidad,
                                                    :precio,
                                                    '0',
                                                    :dscto2,
                                                    :total,
                                                    :nombre_tipo
                                                    )");

        $stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":articulo", $datos["articulo"], PDO::PARAM_STR);
        $stmt->bindParam(":cliente", $datos["cliente"], PDO::PARAM_STR);
        $stmt->bindParam(":vendedor", $datos["vendedor"], PDO::PARAM_STR);
        $stmt->bindParam(":cantidad", $datos["cantidad"], PDO::PARAM_STR);
        $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
        $stmt->bindParam(":dscto2", $datos["dscto2"], PDO::PARAM_STR);
        $stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
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
                                                        usuario
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
                                                        :usuario
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
                    estado = 'FACTURADO'
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
                        saldo
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
                        :saldo
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
                    AND v.estado = :estado";

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
                                                                usuario
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
                                                                :usuario
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

    
}