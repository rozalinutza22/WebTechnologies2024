<?php

session_start();

// if (isset($_SESSION["user_fname"])) {
//     $user_fname = $_SESSION["user_fname"];
//     $user_lname = $_SESSION["user_lname"];
//     $user_email = $_SESSION["user_email"];
//     $user_phone = $_SESSION["user_phone"];
//     $allerg = $_SESSION["allergens"];
//     $veg = $_SESSION["vegetarian"];
//     $admin = $_SESSION["admin"];
// } else {
//    echo "Must be logged in in order to manage lists.";
//    exit();
// }

if (isset($_COOKIE["API_id"])) {
}else{
    echo "Must be logged in in order to manage lists.";
    exit();
}

class ListManager {
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

    public function getListsOfEveryone() {
        $stmt = $this->conn->prepare("SELECT * FROM  lists");
        $stmt->execute();

        $result = $stmt->get_result();
        $lists = $result->fetch_all(MYSQLI_ASSOC);
        return $lists;
    }

    public function getUserLists($id) {
        $stmt = $this->conn->prepare("SELECT * FROM lists WHERE user_id = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $products = $result->fetch_all(MYSQLI_ASSOC);

        $stmt->close();
        return $products;
    }

    public function processRequest($method, $id) {
        if($id) {
            $this->processResourceRequest($method, $id);
        }else {
            $this->processCollectionRequest($method);
        }
    }

    private function processResourceRequest($method, $id) {
        switch ($method) {
            case "GET":
                echo json_encode($this->getUserLists($id));
                break;
        }
    }

    private function processCollectionRequest($method) {
        switch ($method) {
            case "GET":
                echo json_encode($this->getListsOfEveryone());
                break;
            case "POST":
                $data = json_decode(file_get_contents("php://input"), true);
                var_dump($data);
        }

    }
}

?>