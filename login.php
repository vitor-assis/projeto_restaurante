<?php
session_start();

if (COUNT($_POST) > 0) {

    // 1. pegar valores do form

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    try {
        include("conexao_bd.php");

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $consulta = $conn->prepare("SELECT * FROM usuario WHERE situacao = 'habilitado' AND email=:email AND senha=MD5(:senha)");
        $consulta->bindParam(':email', $email, PDO::PARAM_STR);
        $consulta->bindParam(':senha', $senha, PDO::PARAM_STR);
        $consulta->execute();

        $r = $consulta->fetchAll();
        $qtd_user = COUNT($r);
        if ($qtd_user == 1) {
            $_SESSION["email_usuario"] = $email;
            $_SESSION["nome_usuario"] = $r[0]['nome'];
            $_SESSION["id_usuario"] = $r[0]['id'];

            header("Location: pedido.php");
        } else if ($qtd_user == 0) {
            $resultado["msg"] = "Usuário não autenticado";
            $resultado["cod"] = 0;
        }
    } catch (PDOException $e) {
        echo "Falha ao conectar: " . $e->getMessage();
    }
    $conn = null;
}

include("index.php");
