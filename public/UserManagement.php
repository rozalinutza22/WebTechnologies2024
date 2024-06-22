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

        public function create($data) {
            $stmt = $this->conn->prepare("INSERT INTO users (firstName, lastName, emailAdress, phoneNumber, passwrd, vegetarian, admin, allergens) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $data["passwrd"] = password_hash($data["passwrd"], PASSWORD_DEFAULT);

            $stmt->bind_param("sssssiis", $data["firstName"], $data["lastName"], $data["emailAdress"], 
                                          $data["phoneNumber"], $data["passwrd"], $data["vegetarian"], $data["admin"], $data["allergens"]);
            $stmt->execute();
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
                    $data = (array) json_decode(file_get_contents("php://input"), true);
                    // var_dump($data);
                    $this->create($data);

                    echo json_encode([
                        "message" => "User created"
                    ]);
                    break;
            }

        }
    }
?>