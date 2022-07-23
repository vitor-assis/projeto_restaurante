<?php

require_once("Usuario.class.php");

class UsuarioController
{
    private $usuario;

    function __construct()
    {
        $this->usuario = new Usuario();
    }

    //function selecionar($id = null)
    //{
    //      return $this->usuario->selecionar($id);
    // }

    function cadastrar($valores)
    {
        $resultado = $this->usuario->inserir($valores);
    }

    function login($valores)
    {

        $email = $valores["email"];
        $senha = $valores["senha"];

        $filtro = array();
        $filtro["email"] = $valores["email"];
        $filtro["senha"] = $valores["senha"];
        $filtro["situacao"] = 'habilitado';

        $usuario = $this->usuario->selecionar($filtro);

        if (COUNT($usuario) > 0) {
            $_SESSION["email_usuario"] = $valores["email"];
            $_SESSION["nome_usuario"] = $usuario[0]['nome'];
            $_SESSION["id_usuario"] = $usuario[0]['id'];

            header("Location: produto.php");
        } else if (COUNT($usuario) == 0) {
            $resultado["msg"] = "Usuário não encontrado";
            $resultado["cod"] = 0;
        }

    }
}
