<?php

require_once("Cliente.class.php");

class ClienteController
{

    private $cliente;

    function __construct()
    {
        $this->cliente = new Cliente();
    }

    function selecionarClEdit($id_cliente = null)
    {
        return $this->cliente->selecionarClEdit($id_cliente);
    }

    function selecionarCl($id_cliente = null)
    {
        return $this->cliente->selecionarCl($id_cliente);
    }

    function cadastrarCl($valores)
    {
        $resultado = $this->cliente->inserirCl($valores);
        return $resultado;
    }
}
