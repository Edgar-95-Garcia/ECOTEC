<?php
class Consultar_taller_alumno
{
    function selectAlumnosTallerByIdTaller($id_taller)
    {
        try {
            $result = "";
            include_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM alumno_has_taller WHERE ID_TALLER = '" . $id_taller . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}
