<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    if ($_POST["registrar_banner_imagen"] == "REGISTRAR") {
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
        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/Inicio/Insertar_inicio.php");
            $insertar = new Insertar_inicio();
            $a = $insertar->add_inicio(".", ".", $binariosImagen);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Imágen de panel registrada");</script>';
?>
                <script>
                    window.location.replace("admon_administrar_noticias_panel.php");
                </script>
<?php
            } elseif ($a == 0) {
                echo '<script type="text/javascript">alert("Imágen de panel no registrada, por favor intente en unos minutos");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
