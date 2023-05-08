<?php
$GLOBALS['menu'] = 'admon';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION["admin_ecotec"]) == null) {
?>
    <script>
        window.location.replace("index.php");
    </script>
    <?php
} else if (isset($_SESSION["admin_ecotec"]) == "ecotec" && isset($_GET["id"]) && isset($_GET["u"])) {
    include_once("./cabecera.php");
    include_once("./Controlador/key.php");
    $k = new key();
    $id_alumno = $_GET['id'];
    $u = $k->dec($_GET['u']);
    if ($_SESSION["admin_ecotec"] == $u) {
        include_once("./Modelo/Usuarios/Consultar_usuario.php");
        $obj_alumnos = new Consultar_usuario();
        $datos_alumnos = $obj_alumnos->selectUserById($id_alumno);
        foreach ($datos_alumnos as $alumno) {
    ?>
            <div class="card text-center" style="height:100%; position:relative;left:0%">
                <div class="card-body">
                    <h5 class="card-title">FORMULARIO PARA MODIFICAR USUARIO ALUMNO <strong><?php echo $k->dec($alumno['NOMBRES']) ?></strong></h5>
                    <p class="card-text">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id_alumno" value="<?php echo ($alumno['ID_USUARIO']) ?>">
                        NOMBRE (S)<br><br><input name="nombres" type="text" value="<?php echo $k->dec($alumno['NOMBRES']) ?>"> <br><br>
                        APELLIDO PATERNO <br><br><input name="paterno" type="text" value="<?php echo $k->dec($alumno['APELLIDO_PATERNO']) ?>"> <br><br>
                        APELLIDO MATERNO<br><br><input name="materno" type="text" value="<?php echo $k->dec($alumno['APELLIDO_MATERNO']) ?>"> <br><br>
                        MATRICULA<br><br><input name="matricula" type="text" value="<?php echo $k->dec($alumno['MATRICULA']) ?>"> <br><br>
                        TELEFONO <br><br><input name="telcontact" type="text" value="<?php echo $k->dec($alumno['TEL_CONTACTO']) ?>"><br><br>
                        CORREO<br><br><input name="correo" type="text" value="<?php echo $k->dec($alumno['CORREO']) ?>"> <br><br>
                        CONTRASEÑA<br><br><input name="password" type="text" value="<?php echo $k->dec($alumno['PASS']) ?>"> <br><br>
                        ESTATUS<br><i>Si el estatus es 0, el usuario no podrá iniciar sesión</i><br><input name="status" type="text" value="<?php echo ($alumno['STATUS']) ?>"> <br><br>
                        NIVEL DE USUARIO<br><i>El nivel 0 corresponde a los alumnoes</i><br><i>El nivel 1 corresponde a los alumno</i><br><input name="level" type="text" value="<?php echo ($alumno['LEVEL']) ?>"> <br><br>
                        <?php include("./Controlador/modificar_alumnos.php"); ?>
                        <a class="btn btn-primary" href="./admon_administrar_alumnos.php" style="width:60% ;">CANCELAR</a>
                        <br><br>
                        <input type="submit" class="btn btn-success" style="width: 60%;" value="ACTUALIZAR" name="modificar_alumno">
                        <br></br>
                    </form>
                    </p>
                </div>
            </div>
            <br><br>
        <?php
        }
        include_once("./pie.php");
    } else {
        ?>
        <script>
            window.location.replace("index.php");
        </script>
<?php
    }
}
?>