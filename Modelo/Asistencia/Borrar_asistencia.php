<?php

class Borrar_asistencia
{
    function deleteTaller($id_taller)
    {
        try {
            $coincidencia = 0;
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM talleres WHERE ID_TALLER = '" . $id_taller . "'");
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
