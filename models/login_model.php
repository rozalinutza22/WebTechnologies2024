<?php

class LoginModel {
    private $conn;

    public function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cupo_db";

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }

    public function validateCredentials($email, $password) {
        $query = "SELECT * FROM users WHERE emailAdress = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['passwrd'])) {
                return $user; 
            } else {
                return "Incorrect password.";
            }
        } else {
            return "Incorrect email."; 
        }

        $stmt->close();
    }
}

?>
