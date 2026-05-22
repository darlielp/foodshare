<?php
class ConexaoBD {
    private $host = "localhost";
    private $dbname = "projeto_final";
    private $username = "root";
    private $password = "usbw";

    public function conectar() {

        try {
            $pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->dbname;charset=utf8",
                $this->username,
                $this->password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch(PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}

?>