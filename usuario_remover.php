<?php
session_start();
if (isset($_SESSION["id_usuario"]) && $_SESSION["id_usuario"] > 0) {
    if (COUNT($_GET) > 0) {

        $id_usuario = $_GET["id_usuario"];

        require_once('usuario/Usuario.class.php');
        $usuario = new Usuario();
        $resultado = $usuario->removerUs($id_usuario);

        echo json_encode($resultado);
    }
}
