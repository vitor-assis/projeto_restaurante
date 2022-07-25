<?php

if (COUNT($_POST) > 0) {

    require_once('usuario/Usuario.class.php');
    $usuario = new Usuario();
    $resultado = $usuario->atualizarUs($_POST);

    header("location: usuario.php");
}
