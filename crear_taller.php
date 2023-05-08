<?php
$GLOBALS['menu'] = 'index';
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_GET['t'])) { #para cuando se cierra sesión y se redirige al index con un GET
    if ($_GET['t'] == "0") {
        session_destroy();
        ?>
        <script>
            window.location.replace("./index.php");
        </script>
        <?php
    }
} elseif (isset($_SESSION['admin']) == null && isset($_SESSION['cliente']) == null) { #Se redirigió a index y no hay sesión activa
} else {
    #Por si se redirige al index sin el GET y existe una sesión activa
}

include_once("./cabecera.php");
?>
   <div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                <font size="6" face="Cooper Black" color= "#3CA43C"> <h5 class="card-header">REGISTRO TALLERES(vista tentativa maestros)</h5></font>
                    <div class="card-body">
                    <font size="4" face="Constantia" color= "#356425"> 
                            <a href="registrar_taller.php"><input type="button" value="REGISTAR"></a>
                            <a href="modificar_taller.php"><input type="button" value="ACTUALIZAR"></a>
                            <a href="borrar_taller.php"><input type="button" value="BORRAR"></a>
                   </Script>
                    </p></font>
                        
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>

<?php
include_once("./pie.php");
?>