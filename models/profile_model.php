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
            $stmt = $this->conn->prepare("SELECT id FROM users WHERE emailAdress = ?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();
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
    }
?>