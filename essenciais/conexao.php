<?php

class Bancodados
{
    private $usuario = "root";
    private $senha = "Senha123";
    private $host = "localhost";
    private $nomebanco = "redesocial";
    private $servidor = "mysql:host=localhost; dbname=redesocial";


    private $opcoes = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, );
    protected $conn;

    public function abrir() {
        try {
            $this->conn = new PDO($this->servidor, $this->usuario, $this->opcoes);
            return $this->conn;
        } catch (PDOException $erro) {
            echo "Teve um problema connectando com o banco de dados: {$erro->getMessage()}";
            return false;
        }
        return false;
    }

    public function fechar() {
        $this->conn = null;
        return true;
    }

}
$pdo = new Bancodados();
?>
