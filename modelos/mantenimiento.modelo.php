<?php

require_once "conexion.php";

class ModeloMantenimiento{

    //*MOSTRAR EQUIPOS
    static public function mdlMostrarEquipos($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    e.id,
                                                    e.cod_tipo,
                                                    e.cod_tip_maquina,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TDMV' 
                                                    AND t.cod_argumento = e.cod_tip_maquina) AS nombre_tipo_maquina,
                                                    e.descripcion,
                                                    e.cod_ubicacion,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TUBI' 
                                                    AND t.cod_argumento = e.cod_ubicacion) AS ubicacion_maquina,
                                                    e.cod_marca_equi,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_equi) AS marca_equipo,
                                                    e.modelo_equipo,
                                                    e.serie_equipo,
                                                    e.tipo_motor,
                                                    e.cod_marca_motor,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_motor) AS marca_motor,
                                                    e.modelo_motor,
                                                    e.serie_motor,
                                                    e.cod_marca_caja,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_caja) AS marca_caja,
                                                    e.modelo_caja,
                                                    e.serie_caja,
                                                    e.documento,
                                                    e.ruc,
                                                    e.fecha_emision,
                                                    e.observaciones,
                                                    e.estado,
                                                    DATE(e.fec_pro_mant) AS fec_pro_mant,
                                                    DATE(e.fec_ult_mant) AS fec_ult_mant 
                                                FROM
                                                    equipos_jf e 
                                                WHERE e.id = :valor 
                                                ORDER BY e.cod_tipo ");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    e.id,
                                                    e.cod_tipo,
                                                    e.cod_tip_maquina,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TDMV' 
                                                    AND t.cod_argumento = e.cod_tip_maquina) AS nombre_tipo_maquina,
                                                    e.descripcion,
                                                    e.cod_ubicacion,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TUBI' 
                                                    AND t.cod_argumento = e.cod_ubicacion) AS ubicacion_maquina,
                                                    e.cod_marca_equi,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_equi) AS marca_equipo,
                                                    e.modelo_equipo,
                                                    e.serie_equipo,
                                                    e.tipo_motor,
                                                    e.cod_marca_motor,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_motor) AS marca_motor,
                                                    e.modelo_motor,
                                                    e.serie_motor,
                                                    e.cod_marca_caja,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TMAR' 
                                                    AND t.cod_argumento = e.cod_marca_caja) AS marca_caja,
                                                    e.modelo_caja,
                                                    e.serie_caja,
                                                    e.observaciones,
                                                    e.estado 
                                                FROM
                                                    equipos_jf e 
                                                ORDER BY e.cod_tipo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}

    //*TRAER EL UTIMO CODIGO EQUIPO
    static public function mdlTraerUltCod($valor){

        $stmt = Conexion::conectar()->prepare("SELECT 
                                        LEFT(e.cod_tipo, 3) AS tipo,
                                        LPAD(MAX(RIGHT(e.cod_tipo, 3)) + 1, 3, '0') AS correlativo,
                                        CONCAT(
                                        LEFT(e.cod_tipo, 3),
                                        LPAD(MAX(RIGHT(e.cod_tipo, 3)) + 1, 3, '0')
                                        ) AS nuevo 
                                    FROM
                                        equipos_jf e 
                                    WHERE e.cod_tip_maquina = :valor");

        $stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);                                    

        $stmt -> execute();

        return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

    }    

    //*CREAR MAQUINA
	static public function mdlCrearMaquina($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO equipos_jf (
                                                        cod_tipo,
                                                        cod_tip_maquina,
                                                        descripcion,
                                                        cod_ubicacion,
                                                        cod_marca_equi,
                                                        modelo_equipo,
                                                        serie_equipo,
                                                        tipo_motor,
                                                        cod_marca_motor,
                                                        modelo_motor,
                                                        serie_motor,
                                                        cod_marca_caja,
                                                        modelo_caja,
                                                        serie_caja,
                                                        documento,
                                                        ruc,
                                                        fecha_emision,
                                                        observaciones,
                                                        estado,
                                                        fec_pro_mant,
                                                        fec_ult_mant,
                                                        usureg,
                                                        pcreg,
                                                        fecreg
                                                    ) 
                                                    VALUES
                                                        (
                                                        :cod_tipo,
                                                        :cod_tip_maquina,
                                                        UPPER(:descripcion),
                                                        :cod_ubicacion,
                                                        :cod_marca_equi,
                                                        UPPER(:modelo_equipo),
                                                        UPPER(:serie_equipo),
                                                        UPPER(:tipo_motor),
                                                        :cod_marca_motor,
                                                        UPPER(:modelo_motor),
                                                        UPPER(:serie_motor),
                                                        :cod_marca_caja,
                                                        UPPER(:modelo_caja),
                                                        UPPER(:serie_caja),
                                                        UPPER(:documento),
                                                        :ruc,
                                                        :fecha_emision,
                                                        UPPER(:observaciones),
                                                        :estado,
                                                        :fec_pro_mant,
                                                        :fec_ult_mant,
                                                        :usureg,
                                                        :pcreg,
                                                        :fecreg
                                                        )");

		$stmt->bindParam(":cod_tipo", $datos["cod_tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_tip_maquina", $datos["cod_tip_maquina"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_ubicacion", $datos["cod_ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_marca_equi", $datos["cod_marca_equi"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_equipo", $datos["modelo_equipo"], PDO::PARAM_STR);
        $stmt->bindParam(":serie_equipo", $datos["serie_equipo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_motor", $datos["tipo_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_marca_motor", $datos["cod_marca_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_motor", $datos["modelo_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":serie_motor", $datos["serie_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_marca_caja", $datos["cod_marca_caja"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_caja", $datos["modelo_caja"], PDO::PARAM_STR);
        $stmt->bindParam(":serie_caja", $datos["serie_caja"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":fec_pro_mant", $datos["fec_pro_mant"], PDO::PARAM_STR);
        $stmt->bindParam(":fec_ult_mant", $datos["fec_ult_mant"], PDO::PARAM_STR);
        $stmt->bindParam(":fecreg", $datos["fecreg"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->ErrorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}     

    //*PROGRAMAR MANTENIMIENTO en calendario
	static public function mdlCrearCalendario($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO calendario_jf (
                                                tipo,
                                                titulo,
                                                cod_interno,
                                                inicio,
                                                fin,
                                                allday,
                                                dirurl,
                                                indicaciones,
                                                estado,
                                                usureg,
                                                pcreg,
                                                fecreg
                                            ) 
                                            VALUES
                                                (
                                                :tipo,
                                                :titulo,
                                                :cod_interno,
                                                :inicio,
                                                :fin,
                                                :allday,
                                                :dirurl,
                                                :indicaciones,
                                                :estado,
                                                :usureg,
                                                :pcreg,
                                                :fecreg
                                                )");

		$stmt->bindParam(":tipo", $datos["tipo"], PDO::PARAM_STR);
		$stmt->bindParam(":titulo", $datos["titulo"], PDO::PARAM_STR);
		$stmt->bindParam(":cod_interno", $datos["cod_interno"], PDO::PARAM_STR);
        $stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":fin", $datos["fin"], PDO::PARAM_STR);
        $stmt->bindParam(":allday", $datos["allday"], PDO::PARAM_STR);
        $stmt->bindParam(":dirurl", $datos["dirurl"], PDO::PARAM_STR);
        $stmt->bindParam(":indicaciones", $datos["indicaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":fecreg", $datos["fecreg"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->ErrorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}    

    //*MOSTRAR CALENDARIOS
    static public function mdlMostrarCalendario($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT c.*,cli.nombre FROM $tabla c LEFT JOIN clientesjf cli ON c.cliente=cli.codigo WHERE c.tip_mov ='+' AND c.$item = :$item ");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM calendario_jf c");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}    

	//*ACTUALIZAR MAQUINA
	static public function mdlEditarMaquina($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    equipos_jf 
                                                SET
                                                    descripcion = UPPER(:descripcion),
                                                    cod_ubicacion = :cod_ubicacion,
                                                    cod_marca_equi = :cod_marca_equi,
                                                    modelo_equipo = UPPER(:modelo_equipo),
                                                    serie_equipo = UPPER(:serie_equipo),
                                                    tipo_motor = UPPER(:tipo_motor),
                                                    cod_marca_motor = :cod_marca_motor,
                                                    modelo_motor = UPPER(:modelo_motor),
                                                    serie_motor = UPPER(:serie_motor),
                                                    cod_marca_caja = :cod_marca_caja,
                                                    modelo_caja = UPPER(:modelo_caja),
                                                    serie_caja = UPPER(:serie_caja),
                                                    documento = UPPER(:documento),
                                                    ruc = :ruc,
                                                    fecha_emision = :fecha_emision,
                                                    observaciones = UPPER(:observaciones),
                                                    estado = :estado,
                                                    fec_pro_mant = :fec_pro_mant,
                                                    fec_ult_mant = :fec_ult_mant,
                                                    usumod = :usumod,
                                                    pcmod = :pcmod,
                                                    fecmod = :fecmod 
                                                WHERE id = :id");

        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_ubicacion", $datos["cod_ubicacion"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_marca_equi", $datos["cod_marca_equi"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_equipo", $datos["modelo_equipo"], PDO::PARAM_STR);
        $stmt->bindParam(":serie_equipo", $datos["serie_equipo"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_motor", $datos["tipo_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_marca_motor", $datos["cod_marca_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_motor", $datos["modelo_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":serie_motor", $datos["serie_motor"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_marca_caja", $datos["cod_marca_caja"], PDO::PARAM_STR);
        $stmt->bindParam(":modelo_caja", $datos["modelo_caja"], PDO::PARAM_STR);
        $stmt->bindParam(":serie_caja", $datos["serie_caja"], PDO::PARAM_STR);
        $stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_STR);
        $stmt->bindParam(":ruc", $datos["ruc"], PDO::PARAM_STR);
        $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":fec_pro_mant", $datos["fec_pro_mant"], PDO::PARAM_STR);
        $stmt->bindParam(":fec_ult_mant", $datos["fec_ult_mant"], PDO::PARAM_STR);
        $stmt->bindParam(":usumod", $datos["usumod"], PDO::PARAM_STR);
        $stmt->bindParam(":pcmod", $datos["pcmod"], PDO::PARAM_STR);
        $stmt->bindParam(":fecmod", $datos["fecmod"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "ok";

		}else {

			return $stmt->ErrorInfo();
		}

		$stmt->close();

		$stmt = null;

	}  
    
    //*MOSTRAR CALENDARIOS - PENDIENTE
    static public function mdlMostrarCalendarioPendiente($valor){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    * 
                                                FROM
                                                    calendario_jf c 
                                                WHERE c.cod_interno = :valor 
                                                    AND c.estado = 'Pendiente'");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}   
    
	//*ACTUALIZAR MAQUINA
	static public function mdlActualizarCalendarioMaquina($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    calendario_jf 
                                                SET
                                                    inicio = :inicio,
                                                    usumod = :usumod,
                                                    pcmod = :pcmod,
                                                    fecmod = :fecmod 
                                                WHERE cod_interno = :cod_interno 
                                                    AND estado = 'Pendiente'");

        $stmt->bindParam(":cod_interno", $datos["cod_interno"], PDO::PARAM_STR);
        $stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":usumod", $datos["usumod"], PDO::PARAM_STR);
        $stmt->bindParam(":pcmod", $datos["pcmod"], PDO::PARAM_STR);
        $stmt->bindParam(":fecmod", $datos["fecmod"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		}else {

			return $stmt->ErrorInfo();
		}

		$stmt->close();

		$stmt = null;

	}  
    
    //*CREAR MAQUINA
	static public function mdlCrearMantenimiento($datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO mantenimientojf (
                                                cod_interno,
                                                tipo_mante,
                                                mante_inicio,
                                                mante_fin,
                                                cod_maquina,
                                                cod_ubi,
                                                responsable,
                                                items,
                                                operario,
                                                observaciones,
                                                estado,
                                                usureg,
                                                pcreg,
                                                fecreg
                                            ) 
                                            VALUES
                                                (
                                                :cod_interno,
                                                :tipo_mante,
                                                :mante_inicio,
                                                :mante_fin,
                                                :cod_maquina,
                                                :cod_ubi,
                                                :responsable,
                                                :items,
                                                :operario,
                                                :observaciones,
                                                :estado,
                                                :usureg,
                                                :pcreg,
                                                :fecreg
                                                )");

        $stmt->bindParam(":cod_interno", $datos["cod_interno"], PDO::PARAM_STR);
        $stmt->bindParam(":tipo_mante", $datos["tipo_mante"], PDO::PARAM_STR);
        $stmt->bindParam(":mante_inicio", $datos["mante_inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":mante_fin", $datos["mante_fin"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_maquina", $datos["cod_maquina"], PDO::PARAM_STR);
        $stmt->bindParam(":cod_ubi", $datos["cod_ubi"], PDO::PARAM_STR);
        $stmt->bindParam(":responsable", $datos["responsable"], PDO::PARAM_STR);
        $stmt->bindParam(":items", $datos["items"], PDO::PARAM_STR);
        $stmt->bindParam(":operario", $datos["operario"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);
        $stmt->bindParam(":fecreg", $datos["fecreg"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return $stmt->ErrorInfo();
		
		}

		$stmt->close();
		$stmt = null;

	}       

	//*ACTUALIZAR MANTENIMIENTO
	static public function mdlActualizarCalendarioMantenimiento($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                mantenimientojf 
                                            SET
                                                mante_inicio = :inicio,
                                                usumod = :usumod,
                                                pcmod = :pcmod,
                                                fecmod = :fecmod 
                                            WHERE estado = 'NO HECHO' 
                                                AND cod_maquina = :cod_interno");

        $stmt->bindParam(":cod_interno", $datos["cod_interno"], PDO::PARAM_STR);
        $stmt->bindParam(":inicio", $datos["inicio"], PDO::PARAM_STR);
        $stmt->bindParam(":usumod", $datos["usumod"], PDO::PARAM_STR);
        $stmt->bindParam(":pcmod", $datos["pcmod"], PDO::PARAM_STR);
        $stmt->bindParam(":fecmod", $datos["fecmod"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		}else {

			return $stmt->ErrorInfo();
		}

		$stmt->close();

		$stmt = null;

	}  
    
    //*MOSTRAR MANTENIMIENTO
    static public function mdlMostrarMantenimiento($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    m.id,
                                                    m.cod_interno,
                                                    m.tipo_mante,
                                                    m.mante_inicio,
                                                    DATE_FORMAT(
                                                        m.mante_inicio,
                                                        '%d/%m/%Y %H:%i %r'
                                                    ) AS mante_inicio_a,
                                                    m.mante_fin,
                                                        DATE_FORMAT(
                                                        m.mante_fin,
                                                        '%d/%m/%Y %H:%i:%s'
                                                    ) AS mante_fin_a,
                                                    m.cod_maquina,
                                                    CONCAT(
                                                        m.cod_maquina,
                                                        ' - ',
                                                        e.descripcion
                                                    ) AS descripcion,
                                                    m.operario,
                                                    m.cod_ubi,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TUBI' 
                                                    AND t.cod_argumento = m.cod_ubi) AS ubicacion_maquina,
                                                    m.responsable,
                                                    SUBSTRING_INDEX(
                                                        (SELECT 
                                                        t.des_larga 
                                                        FROM
                                                        tabla_m_detalle t 
                                                        WHERE t.cod_tabla = 'TMEC' 
                                                        AND t.cod_argumento = m.responsable),
                                                        ' ',
                                                        1
                                                    ) AS nom_responsable,
                                                    m.items,
                                                    m.total_soles,
                                                    m.observaciones,
                                                    m.estado 
                                                FROM
                                                    mantenimientojf m 
                                                    LEFT JOIN equipos_jf e 
                                                    ON m.cod_maquina = e.cod_tipo
                                                WHERE m.id = :valor");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    m.id,
                                                    m.cod_interno,
                                                    m.tipo_mante,
                                                    m.mante_inicio,
                                                    m.mante_fin,
                                                    m.cod_maquina,
                                                    CONCAT(
                                                        m.cod_maquina,
                                                        ' - ',
                                                        e.descripcion
                                                    ) AS descripcion,
                                                    m.cod_ubi,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TUBI' 
                                                    AND t.cod_argumento = m.cod_ubi) AS ubicacion_maquina,
                                                    m.responsable,
                                                    SUBSTRING_INDEX(
                                                        (SELECT 
                                                        t.des_larga 
                                                        FROM
                                                        tabla_m_detalle t 
                                                        WHERE t.cod_tabla = 'TMEC' 
                                                        AND t.cod_argumento = m.responsable),
                                                        ' ',
                                                        1
                                                    ) AS nom_responsable,
                                                    m.items,
                                                    m.total_soles,
                                                    SUBSTRING(m.observaciones, 1, 20) AS observaciones,
                                                    m.estado 
                                                FROM
                                                    mantenimientojf m 
                                                    LEFT JOIN equipos_jf e 
                                                    ON m.cod_maquina = e.cod_tipo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}    

    //*MOSTRAR MANTENIMIENTO DETALLE
    static public function mdlMostrarMantenimientoDetalle($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    m.cod_interno,
                                                    md.codpro,
                                                    p.despro,
                                                    CONCAT(md.codpro, ' - ', p.despro) AS item,
                                                    md.cantidad,
                                                    md.precio,
                                                    md.total,
                                                    md.observacion,
                                                    md.estado 
                                                FROM
                                                    mantenimiento_detallejf md 
                                                    LEFT JOIN mantenimientojf m 
                                                    ON md.id_mante = m.cod_interno 
                                                    LEFT JOIN producto p 
                                                    ON md.codpro = p.codpro 
                                                WHERE m.cod_interno = :valor ");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    m.id,
                                                    m.cod_interno,
                                                    m.tipo_mante,
                                                    m.mante_inicio,
                                                    m.mante_fin,
                                                    m.cod_maquina,
                                                    CONCAT(
                                                        m.cod_maquina,
                                                        ' - ',
                                                        e.descripcion
                                                    ) AS descripcion,
                                                    m.cod_ubi,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TUBI' 
                                                    AND t.cod_argumento = m.cod_ubi) AS ubicacion_maquina,
                                                    m.responsable,
                                                    SUBSTRING_INDEX(
                                                        (SELECT 
                                                        t.des_larga 
                                                        FROM
                                                        tabla_m_detalle t 
                                                        WHERE t.cod_tabla = 'TMEC' 
                                                        AND t.cod_argumento = m.responsable),
                                                        ' ',
                                                        1
                                                    ) AS nom_responsable,
                                                    m.items,
                                                    m.total_soles,
                                                    SUBSTRING(m.observaciones, 1, 20) AS observaciones,
                                                    m.estado 
                                                FROM
                                                    mantenimientojf m 
                                                    LEFT JOIN equipos_jf e 
                                                    ON m.cod_maquina = e.cod_tipo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}       

    //*MOSTRAR MANTENIMIENTO REPUESTOS
    static public function mdlMostrarMantenimientoRepuestos($valor){

		if($valor != null){

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT 
                                                    CodPro AS codpro,
                                                    CodFab AS codfab,
                                                    SUBSTR(DesPro,1,20) AS despro,
                                                    TbCol.Des_Larga AS color,
                                                    TbTal.Des_Larga AS talla,
                                                    TbUnd.Des_Corta AS unidad,
                                                    ROUND(CodAlm01, 2) AS stock,
                                                    pro.cospro 
                                                FROM
                                                    Producto AS Pro 
                                                    INNER JOIN Tabla_M_Detalle AS TbUnd 
                                                    ON Pro.UndPro = TbUnd.Cod_Argumento 
                                                    AND (TbUnd.Cod_Tabla = 'TUND') 
                                                    INNER JOIN Tabla_M_Detalle AS TbCol 
                                                    ON Pro.ColPro = TbCol.Cod_Argumento 
                                                    AND (TbCol.Cod_Tabla = 'TCOL') 
                                                    INNER JOIN Tabla_M_Detalle AS TbTal 
                                                    ON Pro.TalPro = TbTal.Cod_Argumento 
                                                    AND (TbTal.Cod_Tabla = 'TTAL') 
                                                WHERE Pro.EstPro = '1' 
                                                    AND LEFT(pro.fampro, 3) = :valor");

			$stmt -> bindParam(":valor", $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT 
                                                    m.id,
                                                    m.cod_interno,
                                                    m.tipo_mante,
                                                    m.mante_inicio,
                                                    m.mante_fin,
                                                    m.cod_maquina,
                                                    CONCAT(
                                                        m.cod_maquina,
                                                        ' - ',
                                                        e.descripcion
                                                    ) AS descripcion,
                                                    m.cod_ubi,
                                                    (SELECT 
                                                    t.des_larga 
                                                    FROM
                                                    tabla_m_detalle t 
                                                    WHERE t.cod_tabla = 'TUBI' 
                                                    AND t.cod_argumento = m.cod_ubi) AS ubicacion_maquina,
                                                    m.responsable,
                                                    SUBSTRING_INDEX(
                                                        (SELECT 
                                                        t.des_larga 
                                                        FROM
                                                        tabla_m_detalle t 
                                                        WHERE t.cod_tabla = 'TMEC' 
                                                        AND t.cod_argumento = m.responsable),
                                                        ' ',
                                                        1
                                                    ) AS nom_responsable,
                                                    m.items,
                                                    m.total_soles,
                                                    SUBSTRING(m.observaciones, 1, 20) AS observaciones,
                                                    m.estado 
                                                FROM
                                                    mantenimientojf m 
                                                    LEFT JOIN equipos_jf e 
                                                    ON m.cod_maquina = e.cod_tipo");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}      

    //*MOSTRAR CORRELATIVO MANTENIMIENTO
    static public function mdlMostrarCorrelativo(){

        $stmt = Conexion::conectar()->prepare("SELECT 
                                                    IFNULL(MAX(cod_interno) + 1, 1001) AS correlativo 
                                                FROM
                                                    mantenimientojf m");

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt = null;

    }   
    
	//*ACTUALIZAR EQUIPO CON LA FECHA DEL MANTENIMIENTO PROGRAMADO
	static public function mdlActualizarEquipoMantProg($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    equipos_jf 
                                                SET
                                                    fec_pro_mant = :fec_pro_mant,
                                                    usureg = :usureg,
                                                    pcreg = :pcreg,
                                                    fecreg = :fecreg 
                                                WHERE cod_tipo = :cod_tipo ");

        $stmt->bindParam(":cod_tipo", $datos["cod_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":fec_pro_mant", $datos["fec_pro_mant"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);
        $stmt->bindParam(":fecreg", $datos["fecreg"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		}else {

			return $stmt->ErrorInfo();
		}

		$stmt->close();

		$stmt = null;

	}    

	//*ACTUALIZAR EQUIPO CON LA FECHA DEL MANTENIMIENTO ULTIMO
	static public function mdlActualizarEquipoMantUlt($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                    equipos_jf 
                                                SET
                                                    fec_ult_mant = :fec_ult_mant,
                                                    usureg = :usureg,
                                                    pcreg = :pcreg,
                                                    fecreg = :fecreg 
                                                WHERE cod_tipo = :cod_tipo ");

        $stmt->bindParam(":cod_tipo", $datos["cod_tipo"], PDO::PARAM_STR);
        $stmt->bindParam(":fec_ult_mant", $datos["fec_ult_mant"], PDO::PARAM_STR);
        $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);
        $stmt->bindParam(":fecreg", $datos["fecreg"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		}else {

			return $stmt->ErrorInfo();
		}

		$stmt->close();

		$stmt = null;

	}    

    //*TRAER UBICACION
    static public function mdlTraerUbicacion($valor){

        $stmt = Conexion::conectar()->prepare("SELECT 
                            e.id,
                            e.cod_tipo,
                            e.cod_ubicacion,
                            (SELECT 
                            t.des_larga 
                            FROM
                            tabla_m_detalle t 
                            WHERE t.cod_tabla = 'TUBI' 
                            AND t.cod_argumento = e.cod_ubicacion) AS ubicacion_maquina  
                        FROM
                            equipos_jf e 
                        WHERE e.cod_tipo = :valor 
                        ORDER BY e.cod_tipo ");

        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);                        

        $stmt -> execute();

        return $stmt -> fetch();

        $stmt -> close();

        $stmt = null;

    }     
    
	//*AGREGAR A DETALLE - REPUESTO
	static public function mdlAgregarRepuesto($codInterno, $codpro, $cospro, $usureg, $pcreg, $fecreg){

		$stmt = Conexion::conectar()->prepare("INSERT INTO mantenimiento_detallejf (
                                                    id_mante,
                                                    codpro,
                                                    cantidad,
                                                    precio,
                                                    total,
                                                    estado,
                                                    usureg,
                                                    pcreg,
                                                    fecreg
                                                ) 
                                                VALUES
                                                    (
                                                    :codInterno,
                                                    :codpro,
                                                    1,
                                                    :precio,
                                                    (1* :precio),
                                                    'REGISTRADO',
                                                    :usureg,
                                                    :pcreg,
                                                    :fecreg
                                                    )");

        $stmt->bindParam(":codInterno", $codInterno, PDO::PARAM_STR);
        $stmt->bindParam(":codpro", $codpro, PDO::PARAM_STR);
        $stmt->bindParam(":precio", $cospro, PDO::PARAM_STR);        
        $stmt->bindParam(":usureg", $usureg, PDO::PARAM_STR);
        $stmt->bindParam(":pcreg", $pcreg, PDO::PARAM_STR);
        $stmt->bindParam(":fecreg", $fecreg, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		}else {

			return $stmt->ErrorInfo();
		}

		$stmt->close();

		$stmt = null;

	} 

	//*ACTUALIZAR TOTAL DE ITEMS Y SOLES
	static public function mdlActualizarManteTotales($valor){

		$stmt = Conexion::conectar()->prepare("UPDATE 
                                                mantenimientojf m 
                                                LEFT JOIN 
                                                (SELECT 
                                                    md.id_mante,
                                                    SUM(cantidad) AS item,
                                                    SUM(total) AS total 
                                                FROM
                                                    mantenimiento_detallejf md 
                                                WHERE md.id_mante = :valor 
                                                GROUP BY md.id_mante) md 
                                                ON m.cod_interno = md.id_mante SET m.items = md.item,
                                                m.total_soles = md.total 
                                            WHERE m.cod_interno = :valor");

        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "ok";

		}else {

			return $stmt->ErrorInfo();
		}

		$stmt->close();

		$stmt = null;

	}     

}