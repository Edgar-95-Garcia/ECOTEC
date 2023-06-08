<?php

class Insertar_tabla_inicio_anunciatec
{
    function add_tabla_inicio($titulo, $texto, $imagen)
    {
        $temp = 0;
        try {
            include_once("./Controlador/key.php");
            $k = new key();
            $data = array(null, $k->enc($imagen), $k->enc($titulo), $k->enc($texto));
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO anuncitec_tabla(ID, IMAGEN, TITULO, TEXTO) VALUES (?,?,?,?)");
            $statementHandle->execute($data);
            $temp = 1; #todo ha sido correcto
        } catch (PDOException $e) {
            $temp = 0; #otro tipo de error generalmente error al envíar el mensaje de activación
        }
        return $temp;
    }
}
