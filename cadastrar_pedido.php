<?php

if (COUNT($_POST) > 0) {
    session_start();

    $nome = $_POST["nome_produto"];
    $qtd = $_POST["qtd_produto"];
    $obs = $_POST["obs_produto"];
    $preco = $_POST["preco_produto"];
    $id_usuario = $_SESSION["id_usuario"];

    try {

        include("conexao_bd.php");

        $sql = "INSERT INTO item_pedido (id_usuario, nome, observacao, precoUnidade, quantidade) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_usuario, $nome, $obs, $preco, $qtd]);

        $resultado["msg"] = "Item inserido com sucesso!";
        $resultado["cod"] = 1;
        $resultado["style"] = "alert-success";
    } catch (PDOException $e) {

        $resultado["msg"] = "Item não inserido <br>" . "Inserção no banco falhou: " . $e->getMessage();;
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }
    $conn = null;

    include("pedido.php");
}
