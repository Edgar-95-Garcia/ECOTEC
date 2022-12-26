<?php

class Insertar_foto
{
    function add_foto($binarios_img, $id_taller)
    {
        $temp = 0;
        try {
            include_once("./Controlador/key.php");
            $k = new key();
            $data = array(null, $id_taller,$k->enc($binarios_img));
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();

            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO fotos_taller(ID_FOTO, ID_TALLER, FOTO) VALUES (?,?,?)");
            $statementHandle->execute($data);
            $temp = 1; #todo ha sido correcto
        } catch (PDOException $e) {
            $temp = 0; #otro tipo de error generalmente error al envíar el mensaje de activación
        }
        return $temp;
    }
}
