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
        
        // Adăugare utilizator predefinit temporar
        $firstName = 'Maricica';
        $lastName = 'Maria';
        $email = 'maricica@gmail.com';
        $phoneNumber = '0769999999';
        $password = 'cevaparola';
    
        if (!$this->userExists($email)) {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
            $query = "INSERT INTO users (firstName, lastName, emailAdress, phoneNumber, passwrd, admin)
                      VALUES (?, ?, ?, ?, ?, 0)";
    
            $stmt = $this->conn->prepare($query);
    
            if (!$stmt) {
                die("Prepare failed: " . $this->conn->error);
            }
    
            $stmt->bind_param("sssss", $firstName, $lastName, $email, $phoneNumber, $passwordHash);
    
            $stmt->execute();
    
            $stmt->close();
        }
    
        $this->addDefaultList();
        //sfarsit portiune de cod pentru utilizator definit temporar
    }

    //functii pentru utilizator predefinit
    private function addDefaultList() {
        $userId = 1; 
        $listName = 'Favourites';

        $query = "SELECT * FROM lists WHERE name = ? AND user_id = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("si", $listName, $userId);

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $insertQuery = "INSERT INTO lists (name, user_id) VALUES (?, ?)";
            $insertStmt = $this->conn->prepare($insertQuery);

            if (!$insertStmt) {
                die("Prepare failed: " . $this->conn->error);
            }

            $insertStmt->bind_param("si", $listName, $userId);

            $insertStmt->execute();

            $insertStmt->close();
        }

        $stmt->close();
    }

    private function userExists($email) {
        $query = "SELECT * FROM users WHERE emailAdress = ?";
        $stmt = $this->conn->prepare($query);

        if (!$stmt) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("s", $email);

        $stmt->execute();

        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }
    //sfarsit functii  pentru utilizator predefinit

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
