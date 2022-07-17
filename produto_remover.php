<?php

if (COUNT($_GET) > 0) {

    $id_prod = $_GET["id_prod"];

    require_once('produto/Produto.class.php');
    $produto = new Produto();
    $resultado = $produto -> remover($id_prod);

    header("location: produto.php");
}