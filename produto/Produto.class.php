<?php

session_start();

class Produto
{
    private $id_prod;
    private $nome;
    private $categoria;
    private $valor;
    private $foto;
    private $info;
    private $id_usuario;

    function receberValoresDoPost($valores)
    {
        $this->id_prod = $valores["id_prod"];
        $this->nome = $valores["nome_produto"];
        $this->categoria = $valores["categoria_produto"];
        $this->valor = $valores["valor_produto"];
        $this->foto = $valores["foto_produto"];
        $this->info = $valores["info_produto"];
        $this->id_usuario = $_SESSION["id_usuario"];

    }

    function selecionar($id_prod = null){

        $where_cod = "";
        if(isset($id_prod)) {
            $where_cod = " AND id = ".$id_prod;
        }
    
        try {
            include("conexao_bd.php");
            
            $consulta = $conn->prepare("SELECT * FROM produtos WHERE situacao LIKE 'habilitado'" . $where_cod);
            $consulta->execute(); 
            $resultado = $consulta->fetchAll();
    
        } catch (PDOException $e) {
    
            $resultado["msg"] = "Erro" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }
    
        $conn = null;
        return $resultado;
    }

    function inserir($produto)
    {
        session_start();
        $this->receberValoresDoPost($produto);
        
        try {
            include("conexao_bd.php");

            $sql = "INSERT INTO produtos (nome, categoria, valor, foto, info_adicional, id_usuario) 
            VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->categoria, $this->valor, $this->foto, $this->info, $this->id_usuario]);

            $resultado["msg"] = "Sucesso ao inserir produto";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
            
        } catch (PDOException $e) {

            $resultado["msg"] = "Erro ao inserir produto" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }
        $conn = null;
        return $resultado;
    }

    function atualizar($produto){

        session_start();
        $this->receberValoresDoPost($produto);

        try {

            include("conexao_bd.php");
    
            $sql = "UPDATE produtos SET nome = ?, categoria = ?, valor = ?, info_adicional = ?, momento = now() WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->categoria, $this->valor, $this->info, $this->id_prod]);
    
            $resultado["msg"] = "Produto alterado com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {
    
            $resultado["msg"] = "Erro ao alterar produto" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }
    
        $conn = null;
        return $resultado;
    }

    function remover($id_prod){

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
        return $resultado;
    }
}