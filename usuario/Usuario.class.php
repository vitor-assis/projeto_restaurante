<?php

session_start();

include("bd/BancoDados.class.php");

class Usuario
{
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $dataRegistro;
    private $dataAlteracao;
    private $situacao;

    private $bd;

    function __construct()
    {
        $this->bd = new BancoDados();
    }

    function receberValoresDoPostUs($valores)
    {
        if (!isset($_SESSION["id_usuario"])) session_start();

        $this->id = isset($valores["id_usuario"]) ? $valores["id_usuario"] : 0;
        $this->nome = $valores["nome_usuario"];
        $this->email = $valores["email_usuario"];
        $this->senha = $valores["senha_usuario"];
        //$this->dataRegistro = isset($valores["dataRegistro"]) ? $valores["dataRegistro"] : "now()";
        //$this->dataAlteracao = isset($valores["dataAlteracao"]) ? $valores["dataAlteracao"] : "now()";
        //$this->situacao = isset($valores["situacao"]) ? $valores["situacao"] : "habilitado";

    }

    function selecionarUs($filtro = array())
    {

        $where_cod = "(situacao = 'habilitado')";

        if (isset($filtro["id"]))
            $where_cod = $where_cod . " AND id = :id";
        if (isset($filtro["email"]))
            $where_cod = $where_cod . " AND email = :email";
        if (isset($filtro["senha"]))
            $where_cod = $where_cod . " AND senha = MD5(:senha)";
        if (isset($filtro["situacao"]))
            $where_cod = $where_cod . " AND situacao = :situacao";


        try {

            $conn = $this->bd->conectar();

            $consulta = $conn->prepare("SELECT * FROM usuario WHERE " . $where_cod);

            if (isset($filtro["id"]))
                $consulta->bindParam(':id', $filtro["id"], PDO::PARAM_INT);
            if (isset($filtro["email"]))
                $consulta->bindParam(':email', $filtro["email"], PDO::PARAM_STR);
            if (isset($filtro["senha"]))
                $consulta->bindParam(':senha', $filtro["senha"], PDO::PARAM_STR);
            if (isset($filtro["situacao"]))
                $consulta->bindParam(':situacao', $filtro["situacao"], PDO::PARAM_STR);

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

    function inserirUs($usuario)
    {
        session_start();
        $this->receberValoresDoPostUs($usuario);

        try {

            $conn = $this->bd->conectar();

            $sql = "INSERT INTO usuario (nome, email, senha) 
            VALUES (?,?, MD5(?))";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->email, $this->senha]);

            //, $this->dataRegistro, $this->dataAlteracao, $this->situacao

            $resultado["msg"] = "Sucesso ao inserir usuario";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {

            $resultado["msg"] = "Erro ao inserir usuario" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }
        $conn = null;
        return $resultado;
    }

    function atualizar($produto)
    {

        session_start();
        $this->receberValoresDoPostUs($produto);

        try {

            $conn = $this->bd->conectar();

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

    function remover($id_prod)
    {

        try {

            $conn = $this->bd->conectar();

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
