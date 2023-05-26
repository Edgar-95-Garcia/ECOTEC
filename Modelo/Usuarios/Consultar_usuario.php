<?php
class Consultar_usuario
{
    function selectUserById($ID)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE ID_USUARIO = ?");
            $stmt->execute(array($ID));
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectUserByIdReporte($ID)
    {
        try {
            $result = "";
            require_once("../Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE ID_USUARIO = ?");
            $stmt->execute(array($ID));
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectUsersProfesor()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE LEVEL = 0 ");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectUsersProfesorById($id_profesor)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE LEVEL = 0 AND ID_USUARIO='" . $id_profesor . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectUsersAlumno()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE LEVEL = 1 ");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectUsersAdmin()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE LEVEL = 3 ");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectUsersCorreo($MATRICULA)
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect("aeroline_user", ".+X?pZZ+E9hU");
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE MATRICULA = '" . $MATRICULA . "'");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
        }
        return $result;
    }

    function selectUsers()
    {
        try {
            $result = "";
            require_once("./Modelo/conect.php");
            $c = new conect("aeroline_user", ".+X?pZZ+E9hU");
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios");
            $stmt->execute();
            $result = $stmt->fetchAll();
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $result;
    }
    function selectUser($MATRICULA, $HASH)
    {
        $coincidencia = 0;
        try {
            require_once("../Modelo/conect.php");
            $c = new conect("aeroline_user", ".+X?pZZ+E9hU");
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE HASH = ? AND MATRICULA = ?");
            $stmt->execute(array($HASH, $MATRICULA));
            foreach ($stmt as $v) {
                $coincidencia++;
            }
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $coincidencia;
    }
    function selectUserCorreo($MATRICULA, $PASS)
    {
        $coincidencia = 0;
        try {
            require_once("../Modelo/conect.php");
            $c = new conect("aeroline_user", ".+X?pZZ+E9hU");
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE MATRICULA = ? AND PASS = ?");
            $stmt->execute(array($HASH));
            foreach ($stmt as $v) {
                $coincidencia++;
            }
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $coincidencia;
    }

    function selectNameUserName($MATRICULA)
    {
        try {
            require_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $nombre = "";
            $stmt = $c->connect()->prepare("SELECT NOMBRES FROM usuarios WHERE MATRICULA = ?");
            $stmt->execute(array(strval($k->enc($MATRICULA))));
            foreach ($stmt as $v) {
                $nombre = $v['NOMBRES'];
            }
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $k->dec($nombre);
    }

    function selectUserUserName($MATRICULA, $PASS)
    {
        $coincidencia = 0;
        try {
            require_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $stmt = $c->connect()->prepare("SELECT * FROM usuarios WHERE MATRICULA = ? AND PASS = ?");
            $stmt->execute(array(strval($k->enc($MATRICULA)), strval($k->enc($PASS))));
            $status = 0;
            $level = null;
            $tmp = 0;
            if ($stmt == null) {
                $coincidencia = 5; #USUARIO NO EXISTE
            } else {
                include_once("./Modelo/Bitacora/Insertar_auditoria.php");
                $auditoria = new Insertar_auditoria();
                foreach ($stmt as $v) {
                    $status = $v['STATUS'];
                    $level = $v['LEVEL'];
                    $id = $v['ID_USUARIO'];
                    $_SESSION['ID'] = $id;
                    $tmp++;
                }
                if ($status == 0 && $level == null && $tmp == 0) {
                    $coincidencia = 5; #USUARIO NO EXISTE
                } elseif ($status == 1 && $level == 0 && $tmp > 0) {
                    $coincidencia = 0; #USUARIO EXISTE Y TIENE NIVEL 0 DE PROFESOR
                } elseif ($status == 0 && $level != null && $tmp > 0) {
                    $coincidencia = 4; #USUARIO EXISTE PERO NO HA ACTIVADO CUENTA 
                } elseif ($status == 1 && $level == 3 && $tmp > 0) {
                    $coincidencia = 3; #USUARIO EXISTE Y TIENE NIVEL 3
                    //$auditoria->inicio_sesion($id);
                } elseif ($status == 1 && $level == 2 && $tmp > 0) {
                    $coincidencia = 2; #USUARIO EXISTE Y TIENE NIVEL 2
                    //$auditoria->inicio_sesion($id);
                } elseif ($status == 1 && $level == 1 &&  $tmp > 0) {
                    $coincidencia = 1; #USUARIO EXISTE Y TIENE NIVEL 1
                    //$auditoria->inicio_sesion($id);
                }
            }
        } catch (PDOException $e) {
            #print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $coincidencia;
    }



    function selectUserIDFromCorreo($MATRICULA)
    {
        try {
            require_once("./Modelo/conect.php");
            $c = new conect();
            include_once("./Controlador/key.php");
            $k = new key();
            $nombre = "";
            $stmt = $c->connect()->prepare("SELECT ID_USUARIO FROM usuarios WHERE MATRICULA = ?");
            $stmt->execute(array(strval($k->enc($MATRICULA))));
            $datos = $stmt->fetchAll();
            foreach ($datos as $d) {
                $nombre = $d['ID_USUARIO'];
            }
        } catch (PDOException $e) {
        }
        return $nombre;
    }
}
