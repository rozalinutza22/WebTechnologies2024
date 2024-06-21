<?php
    class ProductController {
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
        
        public function processRequest($method, $id) {
            if($id) {
                $this->processResourceRequest($method, $id);
            }else {
                $this->processCollectionRequest($method);
            }
        }

        private function processResourceRequest($method, $id) {
            echo "\nBuna";
        }

        private function processCollectionRequest($method) {
            switch ($method) {
                case "GET":
                    echo json_encode(["id" => 123]);
                    break;
            }

        }
    }
?>