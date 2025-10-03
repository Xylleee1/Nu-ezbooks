<?php

class Database {
    // Properties
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "book";

    protected $conn;

    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            // set PDO error mode
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}

// Test connection
// $db = new Database();
// var_dump($db->connect());
