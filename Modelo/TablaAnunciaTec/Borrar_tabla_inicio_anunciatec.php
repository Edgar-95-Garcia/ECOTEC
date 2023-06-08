<?php

class Borrar_tabla_inicio_anunciatec
{
    function deleteTablaInicio($id_banner)
    {
        try {
            $coincidencia = 0;
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM anuncitec_tabla WHERE ID = '" . $id_banner . "'");
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
