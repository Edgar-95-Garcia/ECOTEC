<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['admin_ecotec'])) {
    $flag = true;
    if ($_POST["modificar_panel_noticia"] == "MODIFICAR") {
        $id = ($_POST["id_vacante"]);
        $disponibilidad = htmlentities($_POST["disponibilidad"]);
        if (file_exists($_FILES['img']['tmp_name']) || is_uploaded_file($_FILES['img']['tmp_name'])) {
            if ($_FILES['img']['size'] <= 3145728 || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/pjpeg" || $_FILES['img']['type'] == "image/gif" || $_FILES['img']['type'] == "image/bmp" || $_FILES['img']['type'] == "image/png") {
                $tmp_name_img = $_FILES['img']['tmp_name'];
                $data = file_get_contents($tmp_name_img);
                $binariosImagen = base64_encode($data);
            }
        }
        if (isset($_POST["titulo"])) {
            $titulo = htmlentities($_POST["titulo"]);
        }
        if (isset($_POST["descripcion"])) {
            $descripcion = htmlentities($_POST["descripcion"]);
        }
        //verificar las variables de los campos que son obligatorios ----------------------------------------
        if (empty($titulo)) {
            echo "<p style='color:red'>*Ingresa el titulo del Anuncio</p>";
            $flag = false;
        }
        if (empty($descripcion)) {
            echo "<p style='color:red'>*Ingresa la descripcion del Anuncio</p>";
            $flag = false;
        }
        //se verifica que todos los datos hayan sido ingresados correctamente y por lo tanto que la bandera sea TRUE
        if ($flag == true) {
            include_once("./Modelo/Trabajo/Modificar_trabajo.php");
            $modificar = new Modificar_trabajo();
            if(!isset($binariosImagen)){
                $a = $modificar->update_trabajo_sin_imagen($id, $titulo, $descripcion, $disponibilidad);
            }else{
                $a = $modificar->update_trabajo($id, $titulo, $descripcion, $binariosImagen, $disponibilidad);
            }
            if ($a == 1) {
                echo '<script type="text/javascript">alert("Datos de anuncio modificados");</script>';
?>
                <script>
                    window.location.replace("admon_administrar_bolsa_trabajo.php");
                </script>
<?php
            } elseif ($a == 0) {
                echo '<script type="text/javascript">alert("Datos de anuncio no modificados, por favor intente en unos minutos");</script>';
            }
        } else {
            echo '<script type="text/javascript">alert("¡Por favor revisa los datos ingresados!");</script>';
        }
    }
}
