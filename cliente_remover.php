<?php
session_start();
if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] > 0) {
    if (COUNT($_GET) > 0) {

        $id_cliente = $_GET["id_cliente"];

        require_once('cliente/Cliente.class.php');
        $cliente = new Cliente();
        $resultado = $cliente->removerCl($id_cliente);

        echo json_encode($resultado);
    }
}
