<?php

if (COUNT($_POST) > 0) {

    require_once('produto/Produto.class.php');
    $produto = new Produto();
    $resultado = $produto -> inserir($_POST);

}

include("produto.php");