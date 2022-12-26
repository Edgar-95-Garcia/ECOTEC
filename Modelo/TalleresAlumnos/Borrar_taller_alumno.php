<?php

class Borrar_taller_alumno
{
    function deleteTallerAlumnoByIdAlumno($id_alumno, $id_taller)
    {
        try {
            $coincidencia = 0;
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM alumno_has_taller WHERE ID_ALUMNO = '" . $id_alumno . "' AND ID_TALLER = '" . $id_taller . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
        }
        return $coincidencia;
    }

    function deleteTallerAlumnosByIdTaller($id_taller)
    {
        try {
            $coincidencia = 0;
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM alumno_has_taller WHERE ID_TALLER = '" . $id_taller . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
        }
        return $coincidencia;
    }
}
