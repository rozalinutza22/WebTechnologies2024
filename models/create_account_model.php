<?php
$connection = include(dirname(__DIR__).'/includes/config_db.php');

    class SignUpModel {
        private $fname;
        private $lname;
        private $email;
        private $pass;
        private $phone;
        private $isVegetarian;
        private $isAdmin;
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

        public function insertNewUser($fname, $lname, $email, $pass, $phone) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->pass = $pass;
            $this->phone = $phone;
           
            $sql = "INSERT INTO users (firstName, lastName, emailAdress, passwrd, phoneNumber) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            if (! $stmt->prepare($sql)) {
                die("SQL error : " . $this->conn->error);
            }

            $stmt->bind_param("sssss", $fname, $lname, $email, $pass, $phone);

            try {
                $stmt->execute();
                return true; 
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { 
                    $errorMessage = $e->getMessage();
                    if (strpos($errorMessage, 'emailAdress') !== false) {
                        return "Duplicate email";
                    } elseif (strpos($errorMessage, 'phoneNumber') !== false) {
                        return "Duplicate phone";
                    } else {
                        return "Duplicate entry";
                    }
                } else {
                    return "Database error";
                }
            }
        }

        public function insertAllergens($allergens, $email) {
            $this->allergens = $allergens;

            $sql = "UPDATE users SET allergens=? WHERE emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            if (! $stmt->prepare($sql)) {
                die("SQL error : " . $this->conn->error);
            }

            $stmt->bind_param("ss", $allergens, $email);
            $stmt->execute();
            $stmt->close();
        }

        public function isAdmin($email) {
            $this->isAdmin = 1;

            $sql = "UPDATE users SET admin=1 WHERE emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            if (! $stmt->prepare($sql)) {
                die("SQL error : " . $this->conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();
        }

        public function isVegetarian($email) {
            $this->isVegetarian = 1;

            $sql = "UPDATE users SET vegetarian=1 WHERE emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            if (! $stmt->prepare($sql)) {
                die("SQL error : " . $this->conn->error);
            }

            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();
        }

        public function closeConnection() {
            $this->conn->close();
        }
    }