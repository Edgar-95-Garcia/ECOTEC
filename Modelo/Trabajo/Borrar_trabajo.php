<?php

class Borrar_trabajo
{
    function deleteAnuncio($id_anuncio)
    {
        try {
            $coincidencia = 0;
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM bolsa_trabajo WHERE ID = '" . $id_anuncio . "'");
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
