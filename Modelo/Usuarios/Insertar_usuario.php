<?php

class Insertar_usuario
{

    function addUser($nombres, $a_p, $a_m, $matricula, $tel_contacto, $pass)
    {
        include_once("./Controlador/key.php");
        $k = new key();
        $fecha = date("Y-m-d H:i:s");
        $temp = 0;
        /*
        NOTAS DE REVISIÓN
        El hash es un codigo generado aleatoriamente el cual enlaza los registros del usuario recientemente creados y el correo de activación (TODO)
        Por el momento el usuario registrado es activado inmediatamente y el correo es omitido
        STATUS 0 = INACTIVO
        STATUS 1 = ACTIVO
        Niveles de usuarios
        0 = Usuario administrador (se realiza registro en archivo "register_admin.php")
        1 = Usuario normal (se realiza registro en este archivo)
        2 = Usuario supervisor (se realiza registro en archivo "register_admin.php")
        */
        $hash = (md5(rand(0, 1000)));
        $to = $correo;
        $data = array(null, $k->enc($nombres), $k->enc($a_p), $k->enc($a_m), $k->enc($matricula), $k->enc($matricula), $k->enc($tel_contacto), $k->enc($pass), $k->enc($hash), 1, 1, $k->enc($fecha));
        /* 
        if ($this->mensaje_activacion($user, $correo, $k, $hash, $to) != 1) {
            //correo no envíado, no se realiza registro en base de datos
        } else {
            //correo envíado, se realiza registro en base de datos
        }
        */
        $temp = $this->registro_usuario($data);
        return $temp;
    }

    function addUserAdmin($nombres, $a_p, $a_m, $correo, $tel_contacto, $pass)
    {
        include_once("./Controlador/key.php");
        $k = new key();

        $fecha = date("Y-m-d H:i:s");
        $temp = 0;
        /*
        NOTAS DE REVISIÓN
        El hash es un codigo generado aleatoriamente el cual enlaza los registros del usuario recientemente creados y el correo de activación (TODO)
        Por el momento el usuario registrado es activado inmediatamente y el correo es omitido
        STATUS 0 = INACTIVO
        STATUS 1 = ACTIVO
        Niveles de usuarios
        0 = Usuario administrador (se realiza registro en archivo "register_admin.php")
        1 = Usuario normal (se realiza registro en este archivo)
        2 = Usuario supervisor (se realiza registro en archivo "register_admin.php")
        */
        $hash = (md5(rand(0, 1000)));
        //$to = $correo;
        $data = array(null, $k->enc($nombres), $k->enc($a_p), $k->enc($a_m), $k->enc($correo), $k->enc($correo), $k->enc($tel_contacto), $k->enc($pass), $k->enc($hash), 1, 0, $k->enc($fecha));
        /* 
        if ($this->mensaje_activacion($user, $correo, $k, $hash, $to) != 1) {
            //correo no envíado, no se realiza registro en base de datos
        } else {
            //correo envíado, se realiza registro en base de datos
        }
        */
        $temp = $this->registro_usuario($data);
        return $temp;
    }

    function mensaje_activacion($user, $correo, $k, $hash, $to)
    {
        $subject = "Verificación de cuenta | Aerolinea Patito SA de CV";
        $success = 0;
        $msg = '
        Gracias por registrarte a la página de Aerolinea Patito SA de CV: aerolineapatito.com
        Tu cuenta ha sido creada, puedes ingresar con las credenciales que insertaste en el formulario de registro
        Pero antes de ello tienes que activar primero tu cuenta haciendo click en el enlace de abajo.
        
        -------------------------------------------------------------------------------------------
        Dirección de correo registrado:' . $correo . '
        Tu usuario es: ' . $user . '
        -------------------------------------------------------------------------------------------
        Haz click en el enlace para activar tu cuenta:
        https://aerolineapatito.com/controlador/activate.php?email=' . $k->enc($correo) . '&hash=' . ($hash);
        $header = 'From: Ecotec No Reply' . "\r\n";
        try {
            $errLevel = error_reporting(E_ALL ^ E_NOTICE);  // suppress NOTICEs
            mail($to, $subject, $msg, $header);
            error_reporting($errLevel);  // restore old error levels
        } catch (Exception $e) {
            $success = 1;
        }
        return $success;
    }
    function registro_usuario($data)
    {
        $temp = 0;
        try {
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            
            $repetidos = null;
            if ($repetidos == null) {
                $statementHandle = $mysql_object->connect()->prepare("INSERT INTO usuarios(ID_USUARIO, NOMBRES, APELLIDO_PATERNO, APELLIDO_MATERNO, CORREO, MATRICULA, TEL_CONTACTO, PASS, HASH, STATUS, LEVEL,FECHA_REGISTRO) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
                $statementHandle->execute($data);                
                $temp = 1; #todo ha sido correcto
            } else {
                $temp = 4; 
            }
        } catch (PDOException $e) {
            $temp = 3; #otro tipo de error
            print "¡Error!: " . $e->getMessage() . "<br/>";
        }
        return $temp;
    }
}
