<?php

class ProductModel {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cupo_db";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getProductByName($productName) {
        $sql = "SELECT * FROM products WHERE name=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $productName);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
