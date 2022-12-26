<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    if ($_POST["modificar_taller"] == "AGREGAR FOTO") {
        if (file_exists($_FILES['img']['tmp_name']) || is_uploaded_file($_FILES['img']['tmp_name'])) {
            if ($_FILES['img']['size'] <= 3145728 || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/pjpeg" || $_FILES['img']['type'] == "image/gif" || $_FILES['img']['type'] == "image/bmp" || $_FILES['img']['type'] == "image/png") {
                $tmp_name_img = $_FILES['img']['tmp_name'];
                $data = file_get_contents($tmp_name_img);
                $binariosImagen = base64_encode($data);
                $id_taller = $_POST["id_taller"];
            }
        } else {
            echo "<p style='color:red'>*Ingresa una imagen</p>";
            $flag = false;
        }
        /*Primero se validan los campos y de haber sido rellenado se agregan los valores, en caso contrario la variable permanece
        Vacia y posteriormente la bandera se convierte en FALSE lo cual permite mostrar la alerta da javascript
        */

        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/conect.php");
            $mysql_object = new conect();
            include_once("./Modelo/Fotos/Insertar_foto.php");
            $insertar = new Insertar_foto();
            $a = $insertar->add_foto($binariosImagen, $id_taller);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Foto registrada exitosamente");</script>';
?>
                <script>
                    document.location.replace("./administrar_talleres.php");
                </script>
<?php
            } else if ($a == 0) {
                echo '<script type="text/javascript">alert("Registro no realizado");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
