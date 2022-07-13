<?php

if (COUNT($_GET) > 0) {

    $id_prod = $_GET["id"];

    try {

        include("conexao_bd.php");

        $sql = "UPDATE produtos SET situacao = 'desabilitado' WHERE produtos.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_prod]);

        $resultado["msg"] = "Produto removido com sucesso!";
        $resultado["cod"] = 1;
        $resultado["style"] = "alert-success";
    } catch (PDOException $e) {

        $resultado["msg"] = "Erro ao remover produto" . $e->getMessage();;
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }

    $conn = null;
}

include("produto.php");