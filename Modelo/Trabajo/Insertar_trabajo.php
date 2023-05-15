<?php

class Insertar_trabajo
{
    function add_trabajo($titulo, $texto, $imagen, $vacantes)
    {
        $temp = 0;
        try {
            include_once("./Controlador/key.php");
            $k = new key();
            $fecha = date("Y-m-d H:i:s");
            $data = array(null,$k->enc($titulo), $k->enc($texto), $k->enc($imagen), $k->enc($vacantes), $k->enc($fecha), 1);
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO bolsa_trabajo(ID, TITULO, DESCRIPCION,FOTO,VACANTES,FECHA_PUBLICACION,DISPONIBILIDAD) VALUES (?,?,?,?,?,?,?)");
            $statementHandle->execute($data);
            $temp = 1; #todo ha sido correcto
        } catch (PDOException $e) {
            $temp = 0; #otro tipo de error
        }
        return $temp;
    }
}
