<?php

class BancoDados
{
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";

    function conectar()
    {
        $conn = new PDO("mysql:host=$this->servername;dbname=restaurante_bd", $this->username, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
