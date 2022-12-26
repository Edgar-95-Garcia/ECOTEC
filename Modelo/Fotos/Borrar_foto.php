<?php

class Borrar_foto
{
    function deleteFotoFromIdTallerIdFoto($id_taller, $id_foto)
    {
        try {
            $result = "";
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM fotos_taller WHERE ID_FOTO = '" . $id_foto . "' AND ID_TALLER = '" . $id_taller . "'");
            if ($stmt->execute())
                $result = 1;
            else
                $result = 0;
        } catch (PDOException $e) {
        }
        return $result;
    }

    function deleteFotosFromIdTaller($id_taller)
    {
        try {
            $result = "";
            include_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("DELETE FROM fotos_taller WHERE ID_TALLER = '" . $id_taller . "'");
            if ($stmt->execute())
                $result = 1;
            else
                $result = 0;
        } catch (PDOException $e) {
        }
        return $result;
    }
}
