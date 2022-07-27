<?php

require_once("Usuario.class.php");

class UsuarioController
{
    private $usuario;

    function __construct()
    {
        $this->usuario = new Usuario();
    }

    function selecionarUs($id = null)
    {
        return $this->usuario->selecionarUs($id);
    }

    function selecionarUsEdit($id_usuario = null)
    {
        return $this->usuario->selecionarUsEdit($id_usuario);
    }

    function cadastrarUs($valores)
    {
        $filtro = array();
        $filtro["email"] = $valores["email"];

        $usuario = $this->usuario->selecionarUs($filtro);

        if (COUNT($usuario) > 0) {
            $resultado["msg"] = "Erro ao inserir usuário. E-mail já cadastrado.";
            $resultado["cod"] = 0;
            $resultado["style"] = "alert-danger";
        } else {
            $resultado = $this->usuario->inserirUs($valores);
        }

        return $resultado;
    }

    function login($valores)
    {

        $email = $valores["email"];
        $senha = $valores["senha"];

        $filtro = array();
        $filtro["email"] = $valores["email"];
        $filtro["senha"] = $valores["senha"];
        $filtro["situacao"] = 'habilitado';

        $usuario = $this->usuario->selecionarUs($filtro);

        if (COUNT($usuario) == 1) {
            $_SESSION["email_usuario"] = $valores["email"];
            $_SESSION["nome_usuario"] = $usuario[0]['nome'];
            $_SESSION["id_usuario"] = $usuario[0]['id'];

            header("Location: home.php");
        } else if (COUNT($usuario) == 0) {
            $resultado["msg"] = "Usuário não encontrado";
            $resultado["cod"] = 0;
        }

        return $resultado;
    }
}
