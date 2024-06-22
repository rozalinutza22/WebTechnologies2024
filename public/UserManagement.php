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
            $users = $result->fetch_all(MYSQLI_ASSOC);

            $stmt->close();
            
            if (!empty($users)) {
                return $users;
            }else return $emp = "User does not exist in the database";
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

        public function updateFName($firstName, $id) {
            $stmt = $this->conn->prepare("UPDATE users SET firstName=? WHERE id=?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }
            //com
            $stmt->bind_param("si", $firstName, $id);
            $stmt->execute();
        }

        public function updateLName($lastName, $id) {
            $stmt = $this->conn->prepare("UPDATE users SET lastName=? WHERE id=?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("si", $lastName, $id);
            $stmt->execute();
        }

        public function updateAllerg($allergens, $id) {
            $stmt = $this->conn->prepare("UPDATE users SET allergens=? WHERE id=?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("si", $allergens, $id);
            $stmt->execute();
        }

        public function updatePass($pass, $id) {
            $stmt = $this->conn->prepare("UPDATE users SET passwrd=? WHERE id=?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("si", $pass, $id);
            $stmt->execute();
        }

        public function updateVeg($veg, $id) {
            $stmt = $this->conn->prepare("UPDATE users SET vegetarian=? WHERE id=?");

            if ($stmt === false) {
                die("Prepare failed: " . $this->conn->error);
            }

            $stmt->bind_param("ii", $veg, $id);
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
            if ($this->getUserInfo($id) === "User does not exist in the database") {
                http_response_code(404);
                echo json_encode(["message" => "User does not exist in the database"]);
                return;
            }

            $current = $this->getUserInfo($id);

            switch ($method) {
                case "GET":
                    echo json_encode($this->getUserInfo($id));
                    break;
                case "PATCH":
                    $data = (array) json_decode(file_get_contents("php://input"), true);
                    $errors = $this->getValidationErrors($data);

                    if ($data["firstName"]) {
                        $this->updateFName($data["firstName"], $id);
                    }

                    if ($data["lastName"]) {
                        $this->updateLName($data["lastName"], $id);
                    }

                    if (!empty($data["allergens"] !== null)) {
                        $this->updateAllerg($data["allergens"], $id);
                    }else "nu modifica\n";

                    if ($data["passwrd"]) {
                        $this->updatePass($data["passwrd"], $id);
                    }

                    if ($data["vegetarian"]) {
                        $this->updateVeg($data["vegetarian"], $id);
                    }

                    if (!empty($errors)) {
                        http_response_code(422); //Unprocessable Entity
                        echo json_encode(["errors" => $errors]);
                        break;
                    }

                    echo json_encode([
                        "message" => "User $id updated successfully!"
                    ]);
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
                    $errors = $this->getValidationErrors($data);

                    if (!empty($errors)) {
                        http_response_code(422); //Unprocessable Entity
                        echo json_encode(["errors" => $errors]);
                        break;
                    }

                    $this->create($data);

                    http_response_code(201); //Created Successfully 
                    echo json_encode([
                        "message" => "User created successfully!"
                    ]);
                    break;

                default: 
                    //Method Not Allowed
                    http_response_code(405); 
                    header("Allow: GET, POST");

                    echo "Method not allowed.\n";
                    echo "Allow: GET, POST";
            }

        }

        private function getValidationErrors($data) {
            $errors = [];

            if (array_key_exists("admin", $data)) {
                if (filter_var($data["admin"], FILTER_VALIDATE_INT) === false) {
                    $errors[] = "admin must be an integer";
                }
            }

            if (array_key_exists("vegetarian", $data)) {
                if (filter_var($data["vegetarian"], FILTER_VALIDATE_INT) === false) {
                    $errors[] = "vegetarian must be an integer";
                }
            }
            return $errors;
        }
    }
?>