<?php

session_start();

include("bd/BancoDados.class.php");

class Usuario
{
    private $id_usuario;
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

        print_r($valores["nome"]);

        if (!isset($_SESSION["id_usuario"])) session_start();

        $this->id_usuario = isset($valores["id_usuario"]) ? $valores["id_usuario"] : 0;
        $this->nome = $valores["nome"];
        $this->email = $valores["email"];
        $this->senha = $valores["senha"];
        $this->dataRegistro = isset($usuario["dataRegistro"]) ? $usuario["dataRegistro"] : date('y/m/d H:i:s');
        $this->dataAlteracao = isset($usuario["dataAlteracao"]) ? $usuario["dataAlteracao"] : date('y/m/d H:i:s');
        $this->situacao = 'habilitado';
    }

    function selecionarUsEdit($id_usuario)
    {
        $where_cod = " AND id = " . $id_usuario;

        try {

            $conn = $this->bd->conectar();

            $consulta = $conn->prepare("SELECT * FROM usuario WHERE situacao LIKE 'habilitado'" . $where_cod);
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

    function selecionarUs($filtro = array())
    {

        $where_cod = "(situacao = 'habilitado')";

        if (isset($filtro["id"]))
            $where_cod = $where_cod . " AND id = :id";
        if (isset($filtro["email"]))
            $where_cod = $where_cod . " AND email = :email";
        if (isset($filtro["senha"]))
            $where_cod = $where_cod . " AND senha = MD5(:senha)";
        //if (isset($filtro["situacao"]))
        //   $where_cod = $where_cod . " AND situacao = :situacao";


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

    function atualizarUs($valores)
    {

        session_start();
        $this->receberValoresDoPostUs($valores);

        try {

            $conn = $this->bd->conectar();

            $sql = "UPDATE usuario SET nome = ?, email = ?, senha = MD5(?), dataAlteracao = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->email, $this->senha, $this->dataAlteracao, $this->id_usuario]);

            $resultado["msg"] = "Usuário alterado com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {

            $resultado["msg"] = "Erro ao alterar usuário. " . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;

        return $resultado;
    }

    function removerUs($id_usuario)
    {

        try {

            $conn = $this->bd->conectar();

            $sql = "UPDATE usuario SET situacao = 'desabilitado' WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_usuario]);

            $resultado["msg"] = "Usuário removido com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {

            $resultado["msg"] = "Erro ao remover usuário" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;
        return $resultado;
    }
}
