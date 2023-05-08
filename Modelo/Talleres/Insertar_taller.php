<?php

class Insertar_taller
{
    function add_taller($nombre, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado, $domingo, $clave, $descripcion, $salon, $cupo, $departamento)
    {
        $temp = 0;
        try {
            include_once("./Controlador/key.php");
            $k = new key();
            $data = array(null, $_SESSION["ID"], $k->enc($nombre), $k->enc($lunes), $k->enc($martes), $k->enc($miercoles), $k->enc($jueves), $k->enc($viernes), $k->enc($sabado), $k->enc($domingo), $k->enc($clave), $k->enc($descripcion), $k->enc($salon), ($cupo), $k->enc($departamento), ($cupo), 1);
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();

            $statementHandle = $mysql_object->connect()->prepare("INSERT INTO talleres(ID_TALLER, ID_PROFESOR, NOMBRE, LUNES, MARTES, MIERCOLES, JUEVES, VIERNES, SABADO, DOMINGO, CLAVE, DESCRIPCION, SALON, CUPO, DEPARTAMENTO, LUGARES_DISPONIBLES, STATUS) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $statementHandle->execute($data);
            $temp = 1; #todo ha sido correcto
        } catch (PDOException $e) {
            $temp = 0; #otro tipo de error generalmente error al envíar el mensaje de activación
        }
        return $temp;
    }
}
