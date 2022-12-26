<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $flag = true;
    if ($_POST["registrar_banner"] == "REGISTRAR") {
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
        if (isset($_POST["titulo"])) {
            $titulo = htmlentities($_POST["titulo"]);
        }
        if (isset($_POST["textArea"])) {
            $textArea = htmlentities($_POST["textArea"]);
        }

        //verificar las variables de los campos que son obligatorios ----------------------------------------
        if (empty($titulo)) {
            echo "<p style='color:red'>*Ingresa el titulo del banner</p>";
            $flag = false;
        }
        if (empty($textArea)) {
            echo "<p style='color:red'>*Ingresa el texto del banner</p>";
            $flag = false;
        }

        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/Inicio/Insertar_inicio.php");
            $insertar = new Insertar_inicio();
            $a = $insertar->add_inicio($titulo, $textArea, $binariosImagen);
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Banner de noticia registrado");</script>';
?>
                <script>
                    window.location.replace("admon_administrar_noticias.php");
                </script>
<?php
            } elseif ($a == 0) {
                echo '<script type="text/javascript">alert("Banner de noticia no registrado, por favor intente en unos minutos");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
