<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    if (isset($_POST["aceptar"]) && $_POST["aceptar"] == "Aceptar") {
        if (isset($_POST["nombres"])) {
            $nombres = htmlentities($_POST["nombres"]);
        }
        if (isset($_POST["paterno"])) {
            $apellido_paterno = htmlentities($_POST["paterno"]);
        }
        if (isset($_POST["materno"])) {
            $apellido_materno = htmlentities($_POST["materno"]);
        }
        if (isset($_POST["matricula"])) {
            $matricula = htmlentities($_POST["matricula"]);
        }
        if (isset($_POST["telcontact"])) {
            $telcontact = htmlentities($_POST["telcontact"]);
        }
        if (isset($_POST["correo"])) {
            $correo = htmlentities(strtolower($_POST["correo"]));
        }
        if (isset($_POST["password"])) {
            $contraseña = htmlentities($_POST["password"]);
        }
        /*Primero se validan los campos y de haber sido rellenado se agregan los valores, en caso contrario la variable permanece
        Vacia y posteriormente la bandera se convierte en FALSE lo cual permite mostrar la alerta da javascript
        */
        if (empty($nombres)) {
            echo "<p style='color:red'>*Ingresa tu nombre o nombres</p>";
            $flag = false;
        }
        if (empty($apellido_paterno)) {
            echo "<p style='color:red'>*Ingresa apellido paterno</p>";
            $flag = false;
        }
        if (empty($apellido_materno)) {
            echo "<p style='color:red'>*Ingresa apellido materno</p>";
            $flag = false;
        }
        if (empty($matricula)) {
            echo "<p style='color:red'>*Ingresa matricula</p>";
            $flag = false;
        }
        if (empty($correo)) {
            echo "<p style='color:red'>*Ingresa correo</p>";
            $flag = false;
        }
        if (empty($contraseña)) {
            echo "<p style='color:red'>*Ingresa contraseña</p>";
            $flag = false;
        }
        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            include_once("./Modelo/Usuarios/Insertar_usuario.php");
            $insertar = new Insertar_usuario();
            $a = $insertar->addUser($nombres, $apellido_paterno, $apellido_materno, $matricula, $telcontact,strtolower($correo), $contraseña);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Registro exitoso, revisa tu correo para activar tu cuenta (NO ENVIA CORREO AUN)");</script>';
            } else if ($a == 2) {
                echo '<script type="text/javascript">alert("Registro no realizado, correo electrónico inválido");</script>';
            } elseif ($a == 3) {
                echo '<script type="text/javascript">alert("Registro no realizado, por favor intente en unos minutos");</script>';
            } elseif ($a == 4) {
                echo '<script type="text/javascript">alert("Correo ya registrado");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
            unset($mysql_object);
            unset($insertar);
        }
    } elseif (isset($_POST["aceptar"]) && $_POST["aceptar"] == "Reenviar") {
        if (isset($_POST["correo"])) {
            $correo = htmlentities($_POST["correo"]);
        }
        if (empty($correo)) {
            echo "<p style='color:red'>*Rellena el campo Correo</p>";
            $flag = false;
        }
        if ($flag == true) {
            include_once("./Modelo/conect.php");
            $mysql_object = new conect("user", ".+X?pZZ+E9hU");
            include_once("./Modelo/Usuarios/Consultar_usuario.php");
            $insertar = new Consultar_usuario;
            $a = $insertar->selectUsersCorreo($correo);
            if ($a == null) {
                echo '<script type="text/javascript">alert("Correo reenviado exitosamente!");</script>';
            } else {
                echo '<script type="text/javascript">alert("Correo no coincide!");</script>';
            }
        }
        //registro usuarios encargadoss
    } elseif ($_POST["aceptar"] == "Reenviar") {
        if (isset($_POST["correo"])) {
            $correo = htmlentities($_POST["correo"]);
        }
        if (empty($correo)) {
            echo "<p style='color:red'>*Rellena el campo Correo</p>";
            $flag = false;
        }
        if ($flag == true) {
            include_once("./Modelo/conect.php");
            $mysql_object = new conect("user", ".+X?pZZ+E9hU");
            include_once("./Modelo/Usuarios/Consultar_usuario.php");
            $insertar = new Consultar_usuario;
            $a = $insertar->selectUsersCorreo($correo);
            if ($a == null) {
                echo '<script type="text/javascript">alert("Correo reenviado exitosamente!");</script>';
            } else {
                echo '<script type="text/javascript">alert("Correo no coincide!");</script>';
            }
        }
    }
}
