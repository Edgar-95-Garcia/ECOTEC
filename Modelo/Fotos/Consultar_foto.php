<?php

class Consultar_foto
{
    function selectFotoPorIdTaller($id_taller)
    {
        try {
            $result = "";
            include_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM fotos_taller WHERE ID_TALLER = '" . $id_taller . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }
}
