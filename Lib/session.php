<?php

class session
{
    private $usuario = null;

    function __construct()
    {
        session_start();
        if (isset($_SESSION["usuario"])) {
            $this->usuario = $_SESSION["usuario"];
        }
    }

    public function getUsuario(){
        return $this->usuario;
    }
}
