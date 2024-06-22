<?php
    class UserManager {
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

        public function getAll() {
            $stmt = $this->conn->prepare("SELECT * FROM  users");
            $stmt->execute();

            $result = $stmt->get_result();
            $products = $result->fetch_all(MYSQLI_ASSOC);
            return $products;
        }

        public function getUserInfo($id) {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();

            $result = $stmt->get_result();
            $products = $result->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
            return $products;
        }
        
        public function processRequest($method, $id) {
            if($id) {
                $this->processResourceRequest($method, $id);
            }else {
                $this->processCollectionRequest($method);
            }
        }

        private function processResourceRequest($method, $id) {
            switch ($method) {
                case "GET":
                    echo json_encode($this->getUserInfo($id));
                    break;
            }
        }

        private function processCollectionRequest($method) {
            switch ($method) {
                case "GET":
                    echo json_encode($this->getAll());
                    break;
                case "POST":
                    $data = json_decode(file_get_contents("php://input"), true);
                    var_dump($data);
            }

        }
    }
?>