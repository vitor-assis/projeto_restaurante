<?php

require_once("Produto.class.php");

class ProdutoController
{

    private $produto;

    function __construct()
    {
        $this->produto = new Produto();
    }

    function selecionar($id_prod = null)
    {

        return $this->produto->selecionar($id_prod);
    }

    function cadastrar($valores)
    {
        $resultado = $this->produto->inserir($valores);

        return $resultado;
    }
}
