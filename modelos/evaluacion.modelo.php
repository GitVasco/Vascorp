<?php
require_once "conexion.php";

class ModeloEvaluacion{

    static public function mdlVerEvaluacion($modelo){

        $sql="SELECT 
                * 
            FROM
                evaluación e 
            WHERE modelo = '$modelo'
        ";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->execute();

        return $stmt->fetch();

        $stmt=null;

    }

    static public function mdlVerEvaluacionDetalle($modelo, $fecha){

        $sql="SELECT 
                    *,
                    DATE_FORMAT(ed.fecha_creacion, '%H:%i') AS hora 
                FROM
                    evaluacion_detalle ed 
                WHERE ed.modelo = '$modelo' 
                    AND DATE(ed.fecha_creacion) = '$fecha' 
                ORDER BY DATE_FORMAT(ed.fecha_creacion, '%H:%i') DESC
        ";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }
    static public function mdlVerFechaDetalle($modelo){

        $sql="SELECT 
                DATE(ed.fecha_creacion) AS dias 
                FROM
                evaluacion_detalle ed 
                WHERE ed.modelo = '$modelo' 
                GROUP BY DATE(ed.fecha_creacion) 
                ORDER BY DATE(ed.fecha_creacion) DESC 
        ";                

        $stmt=Conexion::conectar()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll();

        $stmt=null;

    }  

}