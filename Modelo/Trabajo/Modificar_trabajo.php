<?php
class Modificar_trabajo
{
    function update_trabajo($id, $titulo, $descripcion, $imagen, $disponibilidad){
        try {            
            include_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            $stmt = $c->connect()->prepare("UPDATE bolsa_trabajo SET TITULO = '" . $k->enc($titulo) . "' ,DESCRIPCION = '" . $k->enc($descripcion) . "' ,FOTO = '" . $k->enc($imagen) . "' ,DISPONIBILIDAD = '" . ($disponibilidad) . "' WHERE ID = '" . $id . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {
            $coincidencia = 0;
        }
        return $coincidencia;
    }
    function update_trabajo_sin_imagen($id, $titulo, $descripcion, $disponibilidad){
        try {            
            include_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $coincidencia = 0;
            echo '<script type="text/javascript">console.log(JSON.stringify("'.var_dump($id).'"));</script>';
            $stmt = $c->connect()->prepare("UPDATE bolsa_trabajo SET TITULO = '" . $k->enc($titulo) . "' ,DESCRIPCION = '" . $k->enc($descripcion) . "' ,DISPONIBILIDAD = '" . ($disponibilidad) . "' WHERE ID = '" . $id . "'");
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $coincidencia = 1;
            } else {
                $coincidencia = 0;
            }
        } catch (PDOException $e) {            
            $coincidencia = 0;
        }
        return $coincidencia;
    }
    
}
