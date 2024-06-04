<?php

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

        public function updateUser($fname, $lname, $email) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;

            $sql = "UPDATE users set firstName=?, lastName=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("sss", $fname, $lname, $email);
            $stmt->execute();

            if ($this->conn->query($sql) === TRUE) {
                echo "Your data has been modified successfully!";
                header("Location: /profile");
                exit;
            } else {
                return false;
            }

        }

        public function updateUserFname($fname, $email) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->phone = $phone;

            $sql = "UPDATE users set firstName=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $fname, $email);
            $stmt->execute();

            if ($this->conn->query($sql) === TRUE) {
                echo "Your data has been modified successfully!";
                header("Location: /profile");
                exit;
            } else {
                return false;
            }

        }

        public function updateUserLname($lname, $email) {
            $this->fname = $fname;
            $this->lname = $lname;
            $this->email = $email;
            $this->phone = $phone;

            $sql = "UPDATE users set lastName=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $lname, $email);
            $stmt->execute();

            if ($this->conn->query($sql) === TRUE) {
                echo "Your data has been modified successfully!";
                header("Location: /profile");
                exit;
            } else {
                return false;
            }
        }

        public function updateVeg($allergens, $email) {
            $this->allergens = $allergens;
            $sql = "UPDATE users set allergens=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $allergens, $email);
            $stmt->execute();

            if ($this->conn->query($sql) === TRUE) {
                echo "Your data has been modified successfully!";
                header("Location: /profile");
                exit;
            } else {
                return false;
            }
        }

        public function updateAllergens($allergens, $email) {
            $this->allergens = $allergens;
            $sql = "UPDATE users set allergens=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $allergens, $email);
            $stmt->execute();

            if ($this->conn->query($sql) === TRUE) {
                echo "Your data has been modified successfully!";
                header("Location: /profile");
                exit;
            } else {
                return false;
            }
        }

        public function isVegetarian($email) {
            $this->isVegetarian = 1;
            $sql = "UPDATE users SET vegetarian=1 WHERE emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("s", $email);
            $stmt->execute();

            if ($this->conn->query($sql) === TRUE) {
                echo "Your data has been modified successfully!";
                header("Location: /profile");
                exit;
            } else {
                return false;
            }
        }

        public function updatePass($pass, $email) {
            $this->pass = $pass;
            $sql = "UPDATE users set pass=? where emailAdress=?";
            $stmt = $this->conn->stmt_init();
            $stmt->prepare($sql);

            $stmt->bind_param("ss", $pass, $email);
            $stmt->execute();

            if ($this->conn->query($sql) === TRUE) {
                echo "Your data has been modified successfully!";
                header("Location: /profile");
                exit;
            } else {
                return false;
            }
        }

    }