<?php

class SelectListModel{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "cupo_db";
    private $conn;
    public $productInfo;

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

    // Function to add a product to a list
    public function addProductToList($list_id, $product_name, $product_price) {
        $sql = "INSERT INTO items (list_id, name, price) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isd", $list_id, $product_name, $product_price);
        return $stmt->execute();
    }

    public function getAllLists($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM lists WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $lists = [];
        while ($row = $result->fetch_assoc()) {
            $lists[] = $row;
        }
        $stmt->close();
        return $lists;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
