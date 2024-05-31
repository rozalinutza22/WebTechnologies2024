<?php
$connection = include(dirname(__DIR__).'/includes/config_db.php');

    class SignUpModel {
        private $conn;
        private $fname;
        private $lname;
        private $email;
        private $pass;
        private $phone;
        private $isVegetarian;
        private $isAdmin;
        private $allergens;

        public function __construct() { 
            $this->conn = $connection;
        }

        public function insertNewUser($fname, $lname, $email, $pass, $phone) {
            $this->$fname = $fname;
            $this->$lname = $lname;
            $this->$email = $email;
            $this->$pass = $pass;
            $this->$phone = $phone;
            $sql = "INSERT INTO users (firstName, lastName, emailAdress, passwrd, phoneNumber) VALUES ('$fname', '$lname', '$email', '$phone')";
            
            if ($this->conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        public function insertAllergens($allergens) {
            $this->$allergens = $allergens;
            $sql = "UPDATE users SET allergens='$allergens'";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        public function isAdmin() {
            $this->$isAdmin = 1;
            $sql = "UPDATE users SET admin=$isAdmin";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        public function isVegetarian() {
            $this->$isVegetarian = 1;
            $sql = "UPDATE users SET vegetarian=$isVegetarian";

            if ($conn->query($sql) === TRUE) {
                return true;
            } else {
                return false;
            }
        }

        public function closeConnection() {
            $this->conn->close();
        }

        //get

    }