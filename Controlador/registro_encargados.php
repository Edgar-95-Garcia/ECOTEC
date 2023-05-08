<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    if ($_POST["aceptar_encargado"] == "Aceptar") {
        if (isset($_POST["nombres"])) {
            $nombres = htmlentities($_POST["nombres"]);
        }
        if (isset($_POST["paterno"])) {
            $apellido_paterno = htmlentities($_POST["paterno"]);
        }
        if (isset($_POST["materno"])) {
            $apellido_materno = htmlentities($_POST["materno"]);
        }
        if (isset($_POST["telcontact"])) {
            $telcontact = htmlentities($_POST["telcontact"]);
        }
        if (isset($_POST["correo"])) {
            $correo = htmlentities(($_POST["correo"]));
        }
        if (isset($_POST["password"])) {
            $contraseña = htmlentities($_POST["password"]);
        }
        if (isset($_POST["pass_registro"])) {
            $pass_registro = htmlentities($_POST["pass_registro"]);
        }
        /*Primero se validan los campos y de haber sido rellenado se agregan los valores, en caso contrario la variable permanece
            Vacia y posteriormente la bandera se convierte en FALSE lo cual permite mostrar la alerta da javascript
            */
        if (empty($pass_registro)) {
            echo "<p style='color:red'>*Ingresa la contraseña de registro</p>";
            $flag = false;
        }
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
            //se verifica que la contraseña de registro concuerde con la existente en el sistema
            if ($pass_registro) {
                include_once("./Modelo/Config/Consultar_config.php");
                $config = new Consultar_config();
                $resul = $config->select_config();
                foreach ($resul as $r) {
                    $t = $r['re9HPwQlYcY1sJYMVA=='];
                    $c = $r['sOtAIxclbMs='];
                }
                include_once("./Controlador/key.php");
                $k = new key();
                if ($c == $k->enc($pass_registro)) {
                    include_once("./Modelo/conect.php");
                    $mysql_object = new conect();
                    include_once("./Modelo/Usuarios/Insertar_usuario.php");
                    $insertar = new Insertar_usuario();

                    $a = $insertar->addUserAdmin($nombres, $apellido_paterno, $apellido_materno, "", $telcontact, strtolower($correo), $contraseña);
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
                    echo '<script type="text/javascript">alert("La contraseña de registro no es válida");</script>';
                }
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
            unset($mysql_object);
            unset($insertar);
        }
    }
}
