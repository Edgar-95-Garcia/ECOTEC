<?php
$GLOBALS['menu'] = 'ENTRAR';

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
    <div>
        <div class="card text-center">
            <div class="card-body">
                <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <h2 class="card-title">Iniciar Sesión</h2>
                    <p class="card-text">
                        <br><br><input name="c_u" type="text" placeholder="Matricula" style="width: 25%; text-align:center"> <br>
                        <br><br><input name="con" type="password" placeholder="Contraseña" style="width: 25%; text-align:center"> <br><br>
                        <br><br>
                        <?php include_once("./Controlador/ingreso_usuarios.php"); ?>
                        <input type="submit" value="Ingresar" name="aceptar" style="width: 10%;">
                    </p>
                </form>
                <br>
            </div>
        </div>
    </div>
<?php
}
?>
<?php include_once("./pie.php"); ?>