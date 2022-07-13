<?php

class Produto
{
    private $id;
    private $nome;
    private $categoria;
    private $valor;
    private $foto;
    private $info;
    private $id_usuario;

    function receberValoresDoPost($valores)
    {
        $this->nome = $valores["nome_produto"];
        $this->categoria = $valores["categoria_produto"];
        $this->valor = $valores["valor_produto"];
        $this->foto = $valores["foto_produto"];
        $this->info = $valores["info_produto"];
        $this->id_usuario = $_SESSION["id_usuario"];
    }

    function inserir($valores)
    {
        session_start();
        $this->receberValoresDoPost($valores);
        
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
}

//echo "# restaurant" >> README.md
//git init
//git add README.md
//git commit -m "first commit"
//git branch -M main
//git remote add origin https://github.com/Vitor09Matos/restaurant.git
//git push -u origin main 

// teste de envio ao git