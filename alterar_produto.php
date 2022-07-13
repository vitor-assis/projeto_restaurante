<?php

if (COUNT($_POST) > 0) {

    $nome = $_POST["nome_produto"];
    $categoria = $_POST["categoria_produto"];
    $valor = $_POST["valor_produto"];
    $info = $_POST["info_produto"];
    $id_prod = $_POST["id_prod"];

    try {

        include("conexao_bd.php");

        $sql = "UPDATE produtos SET nome = ?, categoria = ?, valor = ?, info_adicional = ?, momento = now() WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nome, $categoria, $valor, $info, $id_prod]);

        $resultado["msg"] = "Produto alterado com sucesso!";
        $resultado["cod"] = 1;
        $resultado["style"] = "alert-success";
    } catch (PDOException $e) {

        $resultado["msg"] = "Erro ao alterar produto" . $e->getMessage();;
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }

    $conn = null;
}

header("location: produto.php");