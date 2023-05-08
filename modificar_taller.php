<?php 
$GLOBALS['menu'] = 'BOLSA DE TRABAJO';
include_once("./cabecera.php");
?>
<div class="card text-center" style="width:50%;height:100%; position:relative;left:25%">
        <div class="card-body">
            <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="card">
                <font size="6" face="Cooper Black" color= "#3CA43C"> <h5 class="card-header">Formulario de registroencargados</h5></font>
                    <div class="card-body">
                    <font size="4" face="Constantia" color= "#3CA43C"> <p class="card-text">
                        NOMBRE TALLER<br><br><input name="taller" type="text"> <br><br>
                            DESCRIPCIÓN TALLER<br><br><input name="descripcion" type="text"> <br><br>
                            HORA<br><br><input name="hora" type="text"> <br><br>
                            DIA QUE SE IMPARTIRÁ EL TALLER<br><br><input name="dia" type="text"><br><br>
                            <?php include("#"); ?>
                            <input type="submit" class="btn btn-success" style="width: 60%;" value="MODIFICAR" name="modificar_taller">
                            <br></br>
                            <a href="prueba_talleres.php"> <input type="button" value="REGRESAR"></a>
                       
                    </div>
                </div>
                <br>
            </form>
        </div>
    </div>

<?php
include_once("./pie.php");
?>