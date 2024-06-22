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
        $stmt = $this->conn->prepare("SELECT name FROM lists WHERE user_id=? AND id=?");
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        $stmt->bind_param("ii", $id, $list_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $listName = $row['name'];
            
            if ($listName == 'Favourites') {
               $this->deleteItemsFromFavourites($id);
            }
            else{
    
        $deleteListStmt = $this->conn->prepare("DELETE FROM lists WHERE user_id=? AND id=?");
        if ($deleteListStmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        $deleteListStmt->bind_param("ii", $id, $list_id);
        $deleteListStmt->execute();
        $deleteListStmt->close();
                }
                                    }
    }
    
    public function deleteItemsFromFavourites($id) {
        $listName = "Favourites";
        $stmt = $this->conn->prepare("SELECT id FROM lists WHERE name = ? and user_id = ?");
        $stmt->bind_param("si", $listName, $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $listId = $row['id'];

            $stmt = $this->conn->prepare("DELETE FROM items WHERE list_id = ?");
            $stmt->bind_param("i", $listId);
            $stmt->execute();

            echo "All items from 'Favourites' list have been deleted successfully. \n";
        } else {
            echo "List 'Favourites' not found.";
        }

        $stmt->close();
    }

    public function deleteUserLists($id) {
        $sql = "DELETE FROM lists WHERE user_id = ? AND name != ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
        $sacredList = "Favourites";

        $stmt->bind_param("is", $id, $sacredList);
        $stmt->execute();

        $this->deleteItemsFromFavourites($id);
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

    public function printListItems($id, $list_id) {
        $stmt = $this->conn->prepare("
            SELECT id, name, price
            FROM items
            WHERE list_id = ? AND EXISTS (
                SELECT 1
                FROM lists
                WHERE id = ? AND user_id = ?
            )
        ");
    
        if ($stmt === false) {
            die("Prepare failed: " . $this->conn->error);
        }
    
        $stmt->bind_param("iii", $list_id, $list_id, $id);
        $stmt->execute();
    
        $stmt->bind_result($item_id, $item_name, $item_price);
    
        if ($stmt->fetch()) {
            echo "Items in List ID $list_id:\n";
            do {
                echo "Item ID: $item_id, Name: $item_name, Price: $item_price\n";
            } while ($stmt->fetch());
        } else {
            echo "No items found in List ID $list_id.\n";
        }
    
        $stmt->close();
    }

    public function addItemToList($id, $list_id, $product_id){
          
            $stmt_product = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
            if ($stmt_product === false) {
                http_response_code(500);
                echo json_encode(["error" => "Prepare failed: " . $this->conn->error]);
                return;
            }

            $stmt_product->bind_param("i", $product_id);
            $stmt_product->execute();
            $result_product = $stmt_product->get_result();

            if ($result_product->num_rows !== 1) {
                http_response_code(404);
                echo json_encode(["error" => "Product with ID $product_id not found."]);
                return;
            }

            $product = $result_product->fetch_assoc();
            $product_name = $product['name'];
            $product_price = $product['price'];

            $stmt_insert = $this->conn->prepare("
                INSERT INTO items (list_id, name, price)
                VALUES (?, ?, ?)
            ");

            if ($stmt_insert === false) {
                http_response_code(500);
                echo json_encode(["error" => "Prepare failed: " . $this->conn->error]);
                return;
            }

            $stmt_insert->bind_param("iss", $list_id, $product_name, $product_price);
            if (!$stmt_insert->execute()) {
                http_response_code(500);
                echo json_encode(["error" => "Execute failed: " . $stmt_insert->error]);
                return;
            }

            http_response_code(200); 
            echo json_encode(["message" => "Product added to list $list_id"]);

            $stmt_product->close();
            $stmt_insert->close();
    }
    

    public function processRequest($method, $id, $list_id,$product_id) {
        if($id && $list_id && $product_id){
            $this->processItemRequest($method, $id, $list_id, $product_id);
        }else if($id && $list_id){
            $this->processListRequest($method, $id, $list_id);
        }else if($id) {
            $this->processResourceRequest($method, $id);
        }else {
            $this->processCollectionRequest($method);
        }
    }

    private function processItemRequest($method, $id, $list_id, $product_id){
        if ($this->getUserInfo($id) === "User does not exist in the database") {
            http_response_code(404);
            echo json_encode(["message" => "User does not exist in the database"]);
            return;
        }
        switch ($method) {
            case "POST" : 
                $this->addItemToList($id, $list_id, $product_id);
                break;
            default:
            echo "Method not allowed in this format.\n";
        }

    }

    private function processListRequest($method, $id, $list_id) {
        if ($this->getUserInfo($id) === "User does not exist in the database") {
            http_response_code(404);
            echo json_encode(["message" => "User does not exist in the database"]);
            return;
        }
        switch ($method) {
            case "GET" : 
                if ($this->isList($id, $list_id) == 0) {
                    echo json_encode([
                        "message" => "This list does not exist!"
                    ]);
                    break;
                }
                else{
                $this->printListItems($id, $list_id);
                break;
            }
            case "DELETE":
                if ($this->isList($id, $list_id) == 0) {
                    echo json_encode([
                        "message" => "This list does not exist!"
                    ]);
                    break;
                }
                else{
                $this->deleteSpecificList($id, $list_id);
                echo json_encode([
                    "message" => "Users $id list $list_id has been deleted successfully!"
                ]);
                break;
            }
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