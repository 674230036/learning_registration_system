<?php
class Database {
    private string $host = "localhost";
    private string $db = "learning_system";
    private string $user = "root";
    private string $pass = "";
    private ?PDO $conn = null;

    public function connect(): PDO {
        if ($this->conn === null) {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8mb4",
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }
        return $this->conn;
    }
}
