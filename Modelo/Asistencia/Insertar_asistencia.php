<?php

class Insertar_asistencia
{
    function add_asistencia($data)
    {
        $temp = 0;
        try {
            include_once("./Controlador/key.php");
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO asistencia(ID_ASISTENCIA, ID_TALLER, ID_ALUMNO, FECHA, ASISTENCIA, PERIODO) VALUES (?,?,?,?,?,?)");
            if ($statementHandle->execute($data))
                $temp = 1; #todo ha sido correcto
            else
                $temp = 0;
        } catch (PDOException $e) {
            $temp = 0;
            print($e);
        }
        return $temp;
    }
}
