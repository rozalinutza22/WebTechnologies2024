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

// if (isset($_COOKIE["API_id"])) {
// }else{
//     echo "       \n";
//     var_dump($_COOKIE);
//     echo "Must be logged in in order to manage lists.";
//     exit();
// }

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

    public function isList($id, $list_id) {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM lists WHERE user_id=? AND id=?");

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $id, $list_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $stmt->close();

        if ($result->num_rows === 0)
            return 0;
        else return 1;
    }

    public function deleteSpecificList($id, $list_id) {
        $stmt = $this->conn->prepare("DELETE FROM lists WHERE user_id=? AND id=?");

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("ii", $id, $list_id);
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
    }

    public function deleteUserPref($id) {
        $stmt = $this->conn->prepare("DELETE FROM preferences WHERE user_id=?");

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
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

    public function processRequest($method, $id, $list_id) {
        if($id && $list_id){
            $this->processListRequest($method, $id, $list_id);
        }else if($id) {
            $this->processResourceRequest($method, $id);
        }else {
            $this->processCollectionRequest($method);
        }
    }

    private function processListRequest($method, $id, $list_id) {
        switch ($method) {
            case "DELETE":
                if ($this->isList($id, $list_id)) {
                    echo json_encode([
                        "message" => "This list does not exist!"
                    ]);
                    break;
                }
                
                $this->deleteSpecificList($id, $list_id);
                echo json_encode([
                    "message" => "Users $id list $list_id has been deleted successfully!"
                ]);
                break;
            default:
            echo "Method not allowed in this format.\n";
        }
    }

    private function processResourceRequest($method, $id) {
        if ($this->getUserInfo($id) === "User does not exist in the database") {
            http_response_code(404);
            echo json_encode(["message" => "User does not exist in the database"]);
            return;
        }
        switch ($method) {
            case "GET":
                echo json_encode($this->getUserLists($id));
                break;
            case "DELETE":
                $this->deleteUserLists($id);
                $this->deleteUserPref($id);
                    echo json_encode(["message" => "Your account's lists and preferences, with id: $id, has been deleted successfully!"]);
                    break;
                default: 
                http_response_code(405); 
                header("Allow: GET, POST, PATCH, DELETE");

                echo "Method not allowed in this format.\n";
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