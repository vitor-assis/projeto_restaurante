<?php 

    $where_cod = "";
    if(isset($id_prod)) {
        $where_cod = " AND id = ".$_GET["id_prod"];
    }

    try {
        include("conexao_bd.php");
        //trazer dados do banco
        $consulta = $conn->prepare("SELECT * FROM produtos WHERE situacao LIKE 'habilitado'" . $where_cod);
        $consulta->execute(); 
        $produtos = $consulta->fetchAll();

    } catch (PDOException $e) {

        $resultado["msg"] = "Erro" . $e->getMessage();;
        $resultado["cod"] = 0;
        $resultado["style"] = "alert-danger";
    }

    $conn = null;
