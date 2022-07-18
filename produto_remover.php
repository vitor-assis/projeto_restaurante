<?php
session_start();
if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] > 0) {
    if (COUNT($_GET) > 0) {

        $id_prod = $_GET["id_prod"];

        require_once('produto/Produto.class.php');
        $produto = new Produto();
        $resultado = $produto->remover($id_prod);

        echo json_encode($resultado);

        //header("location: produto.php");
    }
}