<?php
    class DeleteAccModel {
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

        public function getId($email) {
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE emailAdress=?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            $stmt->close();
            return $row['id'] ?? null;
        }

        public function getName($email) {
            $stmt = $this->conn->prepare("SELECT firstName FROM users WHERE emailAdress=?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result;
        }

        public function deleteUser($id) {
            $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }
    
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        public function deleteUserPref($id) {
            $stmt = $this->conn->prepare("DELETE FROM preferences WHERE user_id=?");
            
            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }
    
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        public function deleteUserLists($id) {
            $stmt = $this->conn->prepare("DELETE FROM lists WHERE user_id=?");
            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }
    
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        public function exportJson($id) {
            $sql = "SELECT * FROM users WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            return $user;
        }
    }
?>