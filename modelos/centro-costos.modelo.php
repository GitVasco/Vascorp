<?php

require_once "conexion.php";

class ModeloCentroCostos{

	/*
	* Mostrar Areas
	*/
	static public function mdlMostrarAreas($valor){

        $stmt = Conexion::conectar()->prepare("SELECT 
        cod_argumento,
        cod_tabla,
        des_larga,
        des_corta 
      FROM
        tabla_m_detalle 
      WHERE cod_tabla = 'AREA' 
        AND des_Corta = :valor");

        $stmt->bindParam(":valor", $valor, PDO::PARAM_STR);

        $stmt -> execute();

        return $stmt -> fetchAll();

		$stmt -> close();

		$stmt = null;

	}

	/*
	* Mostrar Centro de Costos
	*/
	static public function mdlMostrarCentroCostos($valor){

    if($valor != null){

      $stmt = Conexion::conectar()->prepare("SELECT 
          cc.id,
          cc.tipo_gasto,
          cc.nombre_gasto,
          cc.key_gasto,
          cc.cod_area,
          cc.nombre_area,
          IFNULL(cc.cod_caja, ' - ') AS cod_caja,
          IFNULL(cc.descripcion, ' - ') AS descripcion,
          cc.estado,
          cc.visible,
          cc.usureg,
          cc.fecreg,
          cc.pcreg,
          cc.usumod,
          cc.fecmod,
          cc.pcmod 
        FROM
          centro_costos cc 
          ORDER BY cc.key_gasto,
          cc.cod_area,
          cc.cod_caja");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }else{

      $stmt = Conexion::conectar()->prepare("SELECT 
          cc.id,
          cc.tipo_gasto,
          cc.nombre_gasto,
          cc.key_gasto,
          cc.cod_area,
          cc.nombre_area,
          IFNULL(cc.cod_caja, ' - ') AS cod_caja,
          IFNULL(cc.descripcion, ' - ') AS descripcion,
          cc.estado,
          cc.visible,
          cc.usureg,
          cc.fecreg,
          cc.pcreg,
          cc.usumod,
          cc.fecmod,
          cc.pcmod 
        FROM
          centro_costos cc 
          ORDER BY cc.key_gasto,
          cc.cod_area,
          cc.cod_caja ");

      $stmt -> execute();

      return $stmt -> fetchAll();

    }



    $stmt -> close();

    $stmt = null;

  }  

	/*
	* Mostrar Areas
	*/
	static public function mdlMostrarCorrelativo($tipoGasto, $area){

    $stmt = Conexion::conectar()->prepare("SELECT 
        CONCAT(
          cc.cod_area,
          LPAD(
            IFNULL(MAX(RIGHT(cc.cod_caja, 2)), 0) + 1,
            2,
            '0'
          )
        ) AS correlativo 
      FROM
        centro_costos cc 
      WHERE cc.tipo_gasto = :tipoGasto
        AND CC.cod_area = :area");

    $stmt->bindParam(":tipoGasto", $tipoGasto, PDO::PARAM_STR);
    $stmt->bindParam(":area", $area, PDO::PARAM_STR);

    $stmt -> execute();

    return $stmt -> fetch();

    $stmt -> close();

    $stmt = null;

  }  

    /* 
    * CREAR CENTRO COSTOS
    */
    static public function mdlCrearCentroCostos($datos){

      $stmt = Conexion::conectar()->prepare("INSERT INTO centro_costos (
                                  tipo_gasto,
                                  cod_area,
                                  cod_caja,
                                  descripcion,
                                  usureg,
                                  fecreg,
                                  pcreg
                                ) 
                                VALUES
                                  (
                                    :tipo_gasto,
                                    :cod_area,
                                    :cod_caja,
                                    UPPER(:descripcion),
                                    :usureg,
                                    :fecreg,
                                    :pcreg
                                  )");
  
      $stmt->bindParam(":tipo_gasto", $datos["tipo_gasto"], PDO::PARAM_STR);
      $stmt->bindParam(":cod_area", $datos["cod_area"], PDO::PARAM_STR);
      $stmt->bindParam(":cod_caja", $datos["cod_caja"], PDO::PARAM_STR);
      $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
      $stmt->bindParam(":usureg", $datos["usureg"], PDO::PARAM_STR);
      $stmt->bindParam(":fecreg", $datos["fecreg"], PDO::PARAM_STR);
      $stmt->bindParam(":pcreg", $datos["pcreg"], PDO::PARAM_STR);
  
      if($stmt->execute()){
  
        return "ok";
  
      }else{
  
        return "error";
      
      }
  
      $stmt->close();
      $stmt = null;
  
    }    
  
    /* 
    * ACTUALIZAR VACIOS
    */
    static public function mdlActualizarACentroCostos($datos){

      $stmt = Conexion::conectar()->prepare("UPDATE 
                              centro_costos 
                            SET
                              cod_caja = :cod_caja,
                              descripcion = UPPER(:descripcion),
                              usumod = :usumod,
                              fecmod = :fecmod,
                              pcmod = :pcmod 
                            WHERE tipo_gasto = :tipo_gasto 
                              AND cod_area = :cod_area 
                              AND (
                                cod_caja IS NULL 
                                OR cod_caja = ''
                              )");
  
      $stmt->bindParam(":tipo_gasto", $datos["tipo_gasto"], PDO::PARAM_STR);
      $stmt->bindParam(":cod_area", $datos["cod_area"], PDO::PARAM_STR);
      $stmt->bindParam(":cod_caja", $datos["cod_caja"], PDO::PARAM_STR);
      $stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
      $stmt->bindParam(":usumod", $datos["usumod"], PDO::PARAM_STR);
      $stmt->bindParam(":fecmod", $datos["fecmod"], PDO::PARAM_STR);
      $stmt->bindParam(":pcmod", $datos["pcmod"], PDO::PARAM_STR);
  
      if($stmt->execute()){
  
        return "ok";
  
      }else{
  
        return $stmt->errorInfo();
      
      }
  
      $stmt->close();
      $stmt = null;
  
    }    

	/*
	* PONER NOMBRES
	*/
	static public function mdlPonerNombres(){

    $stmt = Conexion::conectar()->prepare("UPDATE 
    centro_costos cc 
    LEFT JOIN 
      (SELECT 
        t1.cod_argumento,
        t1.cod_tabla,
        t1.des_larga,
        t1.des_corta 
      FROM
        tabla_m_detalle t1 
      WHERE t1.cod_tabla = 'tgas') t1 
      ON cc.tipo_gasto = t1.cod_argumento 
    LEFT JOIN 
      (SELECT 
        t2.cod_argumento,
        t2.cod_tabla,
        t2.des_larga,
        t2.des_corta 
      FROM
        tabla_m_detalle t2 
      WHERE t2.cod_tabla = 'area') AS t2 
      ON cc.tipo_gasto = t2.des_corta 
      AND cc.cod_area = t2.cod_argumento SET cc.nombre_gasto = t1.des_larga,
    cc.nombre_area = t2.des_larga,
    cc.key_gasto = t1.des_corta");

    $stmt->bindParam(":tipoGasto", $tipoGasto, PDO::PARAM_STR);
    $stmt->bindParam(":area", $area, PDO::PARAM_STR);

    $stmt -> execute();

    $stmt = null;

  }  

  /*
	* Mostrar Centro de Costos
	*/
	static public function mdlMostrarGastosCaja(){

    $stmt = Conexion::conectar()->prepare("SELECT 
                    g.id,
                    DATE(g.fecha) AS fecha,
                    g.recibo,
                    g.ruc_proveedor,
                    g.proveedor,
                    g.sucursal,
                    s.des_larga AS nom_sucursal,
                    g.cod_caja,
                    cc.descripcion AS nom_caja,
                    cc.tipo_gasto,
                    cc.nombre_gasto,
                    cc.cod_area,
                    cc.nombre_area,
                    g.total,
                    g.tipo_documento,
                    d.descripcion AS nombre_documento,
                    g.documento,
                    g.solicitante,
                    g.descripcion AS desc_salida,
                    g.rubro_cancelacion 
                  FROM
                    gastos_caja g 
                    LEFT JOIN 
                      (SELECT 
                        cod_argumento,
                        des_larga 
                      FROM
                        tabla_m_detalle 
                      WHERE cod_tabla = 'tsuc') s 
                      ON g.sucursal = s.cod_argumento 
                    LEFT JOIN centro_costos cc 
                      ON g.cod_caja = cc.cod_caja 
                    LEFT JOIN 
                      (SELECT 
                        codigo,
                        descripcion 
                      FROM
                        maestrajf 
                      WHERE tipo_dato = 'tdoc' 
                        AND codigo IN ('01', '03', '09', '99')) AS d 
                      ON g.tipo_documento = d.codigo");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }  

  /*
	* Mostrar Centro de Costos
	*/
	static public function mdlMostrarCentroCostosCaja(){

    $stmt = Conexion::conectar()->prepare("SELECT 
            cc.id,
            cc.tipo_gasto,
            cc.nombre_gasto,
            cc.key_gasto,
            cc.cod_area,
            cc.nombre_area,
            IFNULL(cc.cod_caja, ' - ') AS cod_caja,
            IFNULL(cc.descripcion, ' - ') AS descripcion,
            cc.estado,
            cc.visible,
            cc.usureg,
            cc.fecreg,
            cc.pcreg,
            cc.usumod,
            cc.fecmod,
            cc.pcmod 
          FROM
            centro_costos cc 
          WHERE cc.cod_caja IS NOT NULL 
          ORDER BY cc.key_gasto,
            cc.cod_area,
            cc.cod_caja");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }  

  /*
	* Mostrar Centro de Costos
	*/
	static public function mdlMostrarTipoDoc(){

    $stmt = Conexion::conectar()->prepare("SELECT 
    codigo,
    descripcion 
  FROM
    maestrajf 
  WHERE tipo_dato = 'tdoc' 
    AND codigo IN ('01', '03', '09', '99')");

    $stmt -> execute();

    return $stmt -> fetchAll();

    $stmt -> close();

    $stmt = null;

  }   

}