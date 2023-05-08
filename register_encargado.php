<?php
$GLOBALS['menu'] = 'registro';

if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['user']) != null) {
?>
    <script>
        window.location.replace("index.php");
    </script>
<?php
} else {
    include_once("./cabecera.php");
?>

    <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                    <h5 class="card-header">Formulario de registro encargados</h5>
                    <div class="card-body">
                        <p class="card-text">
                            NOMBRE (S)<br><br><input name="nombres" type="text"> <br><br>
                            APELLIDO PATERNO <br><br><input name="paterno" type="text"> <br><br>
                            APELLIDO MATERNO<br><br><input name="materno" type="text"> <br><br>
                            TELEFONO<br><br><input name="telcontact" type="text"> <br><br>
                            CORREO<br><br><input name="correo" type="text"> <br><br>
                            CONTRASEÑA<br><br><input name="password" type="text"> <br><br><br>
                            <?php include_once("./Controlador/tipo_registro.php"); ?>
                            <?php include_once("./Controlador/registro_encargados.php"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="Aceptar" name="aceptar_encargado">
                            <br><br>
                            <a href="index.php"><input class="btn btn-success" style="width: 60%;" type="button" value="Regresar"></a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br><br>
    </div>
<?php
    include_once("./pie.php");
}
?>