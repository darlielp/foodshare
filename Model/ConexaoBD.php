<?php
class ConexaoBD {

    private $host = "localhost";
    private $dbname = "foodshare";
    private $username = "root";
    private $password = "";

    public function conectar() {

        try {

            $pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        } catch (PDOException $e) {
            die("Erro: " . $e->getMessage());
        }
    }
}
?>