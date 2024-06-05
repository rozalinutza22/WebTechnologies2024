<?php
    // session_start();

    class ModifyModel {
        private $fname;
        private $lname;
        private $email;
        private $isVegetarian;
        private $allergens;
        private $pass;

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

        public function updateUserFname($fname, $email) {
            $this->fname = $fname;

            $sql = "UPDATE users SET firstName=? WHERE emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $fname, $email);
            // $stmt->execute();

            try {
                $stmt->execute();
                return true; 
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { 
                    $errorMessage = $e->getMessage();
                    return $errorMessage;
                } else {
                    return "Database error";
                }
            }

        }

        public function updateUserLname($lname, $email) {
            $this->lname = $lname;

            $sql = "UPDATE users set lastName=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $lname, $email);
            // $stmt->execute();

            try {
                $stmt->execute();
                // $_SESSION['user_lname'] = $lname;
                return true; 
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { 
                    $errorMessage = $e->getMessage();
                    return $errorMessage;
                } else {
                    return "Database error";
                }
            }
        }

        public function updateAllergens($allergens, $email) {
            $this->allergens = $allergens;
            $sql = "UPDATE users set allergens=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $allergens, $email);
            // $stmt->execute();

            try {
                $stmt->execute();
                // $_SESSION['allergens'] = $allergens;
                return true; 
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { 
                    $errorMessage = $e->getMessage();
                    return $errorMessage;
                } else {
                    return "Database error";
                }
            }
        }

        public function isVegetarian($email) {
            $this->isVegetarian = 1;
            $sql = "UPDATE users SET vegetarian=1 WHERE emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("s", $email);
            // $stmt->execute();

            try {
                $stmt->execute();
                // $_SESSION['vegetarian'] = 1;
                return true; 
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { 
                    $errorMessage = $e->getMessage();
                    return $errorMessage;
                } else {
                    return "Database error";
                }
            }
        }

        public function updatePass($pass, $email) {
            $this->pass = password_hash($pass, PASSWORD_DEFAULT);
            $sql = "UPDATE users set passwrd=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $this->pass, $email);
            // $stmt->execute();

            try {
                $stmt->execute();
                return true; 
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) { 
                    $errorMessage = $e->getMessage();
                    return $errorMessage;
                } else {
                    return "Database error";
                }
            }
        }

    }

    // header("Location: /profile");