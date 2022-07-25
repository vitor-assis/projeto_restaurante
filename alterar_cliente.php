<?php

if (COUNT($_POST) > 0) {

    require_once('cliente/Cliente.class.php');
    $cliente = new Cliente();
    $resultado = $cliente->atualizarCl($_POST);
    header("location: cliente.php");
}
