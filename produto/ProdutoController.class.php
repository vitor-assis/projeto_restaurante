<?php

require_once("Produto.class.php");

class ProdutoController
{

    function selecionar($id_prod = null)
    {
        $produto = new Produto();
        return $produto->selecionar($id_prod);
    }

    function cadastrar($valores)
    {
        $produto = new Produto();
        $resultado = $produto->inserir($valores);
        //include("produto.php");
    }
}
