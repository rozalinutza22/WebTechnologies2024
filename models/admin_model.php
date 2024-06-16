<?php

class AdminModel {
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

    public function deleteAllUsers() {
        $stmt = $this->conn->prepare("DELETE FROM users");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->execute();
        $stmt->close();
    }

    public function deleteUserId($id) {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id=?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteList($user_id, $list_id) {
        $stmt = $this->conn->prepare("DELETE FROM lists WHERE user_id=? AND id=?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $user_id, $list_id);
        $stmt->execute();
        $stmt->close();
    }

    public function deleteAllLists($user_id) {
        $stmt = $this->conn->prepare("DELETE FROM lists WHERE user_id=?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->close();
    }


}

?>