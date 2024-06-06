<?php

class ShoppingListModel {
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

    public function getAllLists() {
        $sql = "SELECT * FROM lists";
        $result = $this->conn->query($sql);
        $lists = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $lists[] = $row;
            }
        }
        return $lists;
    }

    public function getListItems($list_id) {
        $sql = "SELECT * FROM items WHERE list_id=$list_id";
        $result = $this->conn->query($sql);
        $items = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items;
    }

    public function removeFromFav($item_name) {
        // First, get the id of the 'Favourites' list
        $sql = "SELECT id FROM lists WHERE name='Favourites'";
        $result = $this->conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            // Fetch the id
            $row = $result->fetch_assoc();
            $favourites_id = $row['id'];
        
            // Delete item using the fetched id
            $stmt = $this->conn->prepare("DELETE FROM items WHERE list_id = ? AND name = ?");
            $stmt->bind_param("is", $favourites_id, $item_name); // i - integer, s - string
            
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            return false; // Handle the case where the 'Favourites' list was not found
        }
    }
    

    public function addList($list_name) {
        $sql = "INSERT INTO lists (name) VALUES ('$list_name')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function addToFav($item_name, $item_price) {
        // First, get the id of the 'Favourites' list
        $sql = "SELECT id FROM lists WHERE name='Favourites'";
        $result = $this->conn->query($sql);
        
        if ($result && $result->num_rows > 0) {
            // Fetch the id
            $row = $result->fetch_assoc();
            $favourites_id = $row['id'];
    
            // Check if the item is already in the 'Favourites' list
            $check_sql = "SELECT id FROM items WHERE list_id = ? AND name = ?";
            $check_stmt = $this->conn->prepare($check_sql);
            $check_stmt->bind_param("is", $favourites_id, $item_name);
            $check_stmt->execute();
            $check_result = $check_stmt->get_result();
    
            if ($check_result->num_rows > 0) {
                // Item already exists in the 'Favourites' list, do nothing
                $check_stmt->close();
                return false;
            }
    
            $check_stmt->close();
        
            // Now, insert the new item using the fetched id
            $stmt = $this->conn->prepare("INSERT INTO items (list_id, name, price) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $favourites_id, $item_name, $item_price);
        
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            } else {
                $stmt->close();
                return false;
            }
        } else {
            // Handle the case where the 'Favourites' list was not found
            return false;
        }
    }
    

    public function deleteList($list_id) {
        $sql = "DELETE FROM lists WHERE id=$list_id";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
            return false;
        }
    }

    public function closeConnection() {
        $this->conn->close();
    }
}
?>
