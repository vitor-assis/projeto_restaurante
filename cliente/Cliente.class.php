<?php

session_start();

include("bd/BancoDados.class.php");

class Cliente
{
    private $id_cliente;
    private $nome;
    private $cpf;
    private $telefone;
    private $endereco;
    private $dataRegistro;
    private $situacao;
    private $id_usuario;

    private $bd;

    function __construct()
    {
        $this->bd = new BancoDados();
    }

    function receberValoresDoPostCl($valores)
    {
        if (!isset($_SESSION["id_usuatio"])) session_start();

        $this->id_cliente = isset($valores["id_cliente"]) ? $valores["id_cliente"] : 0;
        $this->nome = $valores["nome_cliente"];
        $this->cpf = $valores["cpf_cliente"];
        $this->telefone = $valores["telefone_cliente"];
        $this->endereco = $valores["endereco_cliente"];
        $this->dataRegistro = isset($usuario["dataRegistro"]) ? $usuario["dataRegistro"] : date('y/m/d H:i:s');
        $this->dataAlteracao = isset($usuario["dataAlteracao"]) ? $usuario["dataAlteracao"] : date('y/m/d H:i:s');
        $this->situacao = 'habilitado';
        $this->id_usuario = $_SESSION["id_usuario"];
    }

    function selecionarClEdit($id_cliente)
    {
        $where_cod = " AND id = " . $id_cliente;

        try {

            $conn = $this->bd->conectar();

            $consulta = $conn->prepare("SELECT * FROM cliente WHERE situacao LIKE 'habilitado'" . $where_cod);
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

    function selecionarCl($id_cliente = null)
    {

        $where_cod = "";
        if (isset($id_cliente)) {
            $where_cod = " AND id = " . $id_cliente;
        }

        try {

            $conn = $this->bd->conectar();

            $consulta = $conn->prepare("SELECT * FROM cliente WHERE situacao LIKE 'habilitado'" . $where_cod);
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

    function inserirCl($cliente)
    {

        session_start();
        $this->receberValoresDoPostCl($cliente);

        try {

            $conn = $this->bd->conectar();

            $sql = "INSERT INTO cliente (nome, cpf, telefone, endereco) 
            VALUES (?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->cpf, $this->telefone, $this->endereco]);

            $resultado["msg"] = "Sucesso ao cadastrar cliente";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {

            $resultado["msg"] = "Erro ao cadastrar cliente" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }
        $conn = null;
        return $resultado;
    }

    function atualizarCl($valores)
    {

        session_start();
        $this->receberValoresDoPostCl($valores);

        try {

            $conn = $this->bd->conectar();

            $sql = "UPDATE cliente SET nome = ?, cpf = ?, telefone = ?, endereco = ?, dataAlteracao = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$this->nome, $this->cpf, $this->telefone, $this->endereco, $this->dataAlteracao, $this->id_cliente]);

            $resultado["msg"] = "Cliente alterado com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {

            $resultado["msg"] = "Erro ao alterar cliente" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;

        print_r($resultado);
        return $resultado;
    }

    function removerCl($id_cliente)
    {

        try {

            $conn = $this->bd->conectar();

            $sql = "UPDATE cliente SET situacao = 'desabilitado' WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$id_cliente]);

            $resultado["msg"] = "Cliente removido com sucesso!";
            $resultado["cod"] = 1;
            $resultado["style"] = "alert-success";
        } catch (PDOException $e) {

            $resultado["msg"] = "Erro ao remover cliente" . $e->getMessage();;
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        }

        $conn = null;
        return $resultado;
    }
}
