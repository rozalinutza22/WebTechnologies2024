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
       
        public function processCSV($filePath) {
            $handle = fopen($filePath, 'r');
            if ($handle !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    $id = $this->conn->real_escape_string($data[0]);
                    $firstName = $this->conn->real_escape_string($data[1]);
                    $lastName = $this->conn->real_escape_string($data[2]);
                    $emailAdress = $this->conn->real_escape_string($data[3]);
                    $phoneNumber = $this->conn->real_escape_string($data[4]);
                    $passwrd = $this->conn->real_escape_string($data[5]);
                    $vegetarian = (int)$data[6];
                    $admin = (int)$data[7];
                    $allergens = $this->conn->real_escape_string($data[8]);
                    $session_token = $this->conn->real_escape_string($data[9]);
                    $last_login = $this->conn->real_escape_string($data[10]);
                    $session_expiry = $this->conn->real_escape_string($data[11]);
    
                    $sql = "INSERT INTO users (id, firstName, lastName, emailAdress, phoneNumber, passwrd, vegetarian, admin, allergens, session_token, last_login, session_expiry) VALUES ('$id', '$firstName', '$lastName', '$emailAdress', '$phoneNumber', '$passwrd', $vegetarian, $admin, '$allergens', '$session_token', '$last_login', '$session_expiry') ON DUPLICATE KEY UPDATE firstName='$firstName', lastName='$lastName', emailAdress='$emailAdress', phoneNumber='$phoneNumber', passwrd='$passwrd', vegetarian=$vegetarian, admin=$admin, allergens='$allergens', session_token='$session_token', last_login='$last_login', session_expiry='$session_expiry'";
                    if (!$this->conn->query($sql)) {
                        echo "Error: " . $sql . "<br>" . $this->conn->error;
                    }
                }
                fclose($handle);
            }
            return true;
        }
        
        public function processJSON($filePath) {
            $jsonContent = file_get_contents($filePath);
            $data = json_decode($jsonContent, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $id = $this->conn->real_escape_string($data['id']);
                $firstName = $this->conn->real_escape_string($data['firstName']);
                $lastName = $this->conn->real_escape_string($data['lastName']);
                $emailAdress = $this->conn->real_escape_string($data['emailAdress']);
                $phoneNumber = $this->conn->real_escape_string($data['phoneNumber']);
                $passwrd = $this->conn->real_escape_string($data['passwrd']);
                $vegetarian = (int)$data['vegetarian'];
                $admin = (int)$data['admin'];
                $allergens = $this->conn->real_escape_string($data['allergens']);
                $session_token = $this->conn->real_escape_string($data['session_token']);
                $last_login = $this->conn->real_escape_string($data['last_login']);
                $session_expiry = $this->conn->real_escape_string($data['session_expiry']);
    
                $sql = "INSERT INTO users (id, firstName, lastName, emailAdress, phoneNumber, passwrd, vegetarian, admin, allergens, session_token, last_login, session_expiry) VALUES ('$id', '$firstName', '$lastName', '$emailAdress', '$phoneNumber', '$passwrd', $vegetarian, $admin, '$allergens', '$session_token', '$last_login', '$session_expiry') ON DUPLICATE KEY UPDATE firstName='$firstName', lastName='$lastName', emailAdress='$emailAdress', phoneNumber='$phoneNumber', passwrd='$passwrd', vegetarian=$vegetarian, admin=$admin, allergens='$allergens', session_token='$session_token', last_login='$last_login', session_expiry='$session_expiry'";
                if (!$this->conn->query($sql)) {
                    echo "Error: " . $sql . "<br>" . $this->conn->error;
                }
    
                return $data;
            }
            return false;
        }
    }
?>