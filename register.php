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
                   <font size="6" face="Cooper Black" color= "#3CA43C"> <h5 class="card-header">REGISTRATE</h5></font>
                    <div class="card-body">
                        <font size="4" face="Constantia" color= "#356425"><p class="card-text">
                            NOMBRE (S)<br><br><input name="nombres" type="text"> <br><br>
                            APELLIDO PATERNO <br><br><input name="paterno" type="text"> <br><br>
                            APELLIDO MATERNO<br><br><input name="materno" type="text"> <br><br>
                            No. CONTROL <br><br><input name="matricula" type="text"><br><br>
                            TELEFONO<br><br><input name="telcontact" type="text"> <br><br>
                            <!-- CORREO<br><br><input name="correo" type="text"> <br><br> -->
                            CONTRASEÑA<br><br><input name="password" type="text"> <br><br><br>
                            <?php include_once("./Controlador/registro_usuarios.php"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="Aceptar" name="aceptar">
                        </p></font>
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>
    <br><br>
    <div class="card text-center" style="width:50%;height:30%; position:relative;left:25%;">
        <br>
        <h4>
            <!-- <a href="./reenviar_correo.php" class="btn btn-warning" style="width: 60%;">NO RECIBÍ EL CORREO DE ACTIVACIÓN (TODO)</a><br><br> -->
            <a href="./register_encargado.php" class="btn btn-warning" style="width: 60%;">REGISTRAR COMO PROFESOR</a><br><br>
        </h4>
    </div>
    <br><br>
    </div>
<?php
include_once("./pie.php");
}
?>