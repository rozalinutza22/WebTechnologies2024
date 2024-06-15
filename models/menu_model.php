<?php

class MenuModel {
    private $fname;
    private $lname;
    private $email;
    private $isVegetarian;
    private $allergens;

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

    public function getProductDetails($name) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE name = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $name);
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $products;
    }

    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY category asc");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        $allProducts = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $allProducts;
    }

    public function filterByName() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY category asc, name asc");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        $allProducts = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $allProducts;
    }

    public function filterByPrice() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY price asc");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        $allProducts = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $allProducts;
    }

    public function filterByPerishability() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY perishability asc");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();

        $result = $stmt->get_result();
        $allProducts = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $allProducts;
    }
}

?>