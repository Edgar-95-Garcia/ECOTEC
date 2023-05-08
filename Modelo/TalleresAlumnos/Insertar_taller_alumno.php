<?php

class Insertar_taller_alumno
{
    function add_taller_alumno($id_alumno, $id_taller)
    {
        $temp = 0;
        try {
            include_once("../Controlador/key.php");
            $k = new key();
            date_default_timezone_set("America/Mexico_City");
            $data = array(null, $id_taller, $id_alumno, date("Y-m-d H:i:s"));
            include_once("../Modelo/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO alumno_has_taller(ID_MOVIMIENTO, ID_TALLER, ID_ALUMNO, FECHA_ALTA) VALUES (?,?,?,?)");
            if($statementHandle->execute($data)){
                $temp = 1; #todo ha sido correcto
                include_once("../Modelo/Talleres/Modificar_taller.php");
                $obj_talleres = new Modificar_taller();
                $temp = $obj_talleres->updateTallerLugares($id_taller);
            }else{
                $temp = 0; #otro tipo de error
            }
        } catch (PDOException $e) {
            $temp = 0; #otro tipo de error
        }
        return $temp;
    }
}