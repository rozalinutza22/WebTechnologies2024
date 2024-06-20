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

    public function getAllLists($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM lists WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $lists = [];
        while ($row = $result->fetch_assoc()) {
            $lists[] = $row;
        }
        $stmt->close();
        return $lists;
    }

    public function showRecommendedProducts($userId) {
        if ($userId !== null) {
            $preferences = $this->getTopPreferences($userId);
            $listItems = $this->getUserListItems($userId);

            if (!empty($preferences)) {
                $products = $this->getProductsByPreferences($preferences);
                $products = $this->filterDisplayedProducts($products, $listItems);
                $remainingSlots = 4 - count($products);

                if ($remainingSlots > 0) {
                    $randomProducts = $this->getRandomProducts($remainingSlots, $products, $listItems);
                    $products = array_merge($products, $randomProducts);
                }

                return $products;
            } else {
                return $this->getRandomProducts(4, [], $listItems);
            }
        } else {
            return $this->getRandomProducts(4);
        }
    }

    private function getTopPreferences($userId) {
        $stmt = $this->conn->prepare("SELECT preference_name FROM preferences WHERE user_id = ? ORDER BY count DESC LIMIT 3");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $preferences = [];
        while ($row = $result->fetch_assoc()) {
            $preferences[] = $row;
        }
        $stmt->close();
        return $preferences;
    }

    private function getUserListItems($userId) {
        $stmt = $this->conn->prepare("SELECT DISTINCT i.name FROM items i JOIN lists l ON i.list_id = l.id WHERE l.user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $listItems = [];
        while ($row = $result->fetch_assoc()) {
            $listItems[] = $row['name'];
        }
        $stmt->close();
        return $listItems;
    }

    private function getProductsByPreferences($preferences) {
        $placeholders = implode(',', array_fill(0, count($preferences), '?'));
        $types = str_repeat('s', count($preferences));
        $params = array_column($preferences, 'preference_name');

        $stmt = $this->conn->prepare("SELECT * FROM products WHERE name IN ($placeholders)");
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $stmt->close();
        return $products;
    }

    private function getRandomProducts($limit, $excludedProducts = [], $listItems = []) {
        $exclusions = array_merge($excludedProducts, $listItems);
    
        $query = "SELECT * FROM products";
        $bindParams = [];
        $types = '';
    
        if (!empty($exclusions)) {
            $placeholders = implode(',', array_fill(0, count($exclusions), '?'));
            $query .= " WHERE name NOT IN ($placeholders)";
    
            foreach ($exclusions as $value) {
                $types .= 's'; // all values are strings
                $bindParams[] = $value; 
            }
        }
        $query .= " ORDER BY RAND() LIMIT ?";
        $types .= 'i'; //'i' for integer limit
        $bindParams[] = $limit; 
    
        $stmt = $this->conn->prepare($query);
    
        if (!empty($bindParams)) {
            $this->bindParams($stmt, $bindParams, $types);
        } else {
            $stmt->bind_param('i', $limit);
        }
        //var_dump($bindParams); --has the correct info
        //var_dump($types); --string
    
        @ $stmt->execute(); //TODO: Array to string conversion error so solve 
        $result = $stmt->get_result();
        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
        $stmt->close();
        return $products;
    }
    
    // Helper function to bind parameters dynamically
    private function bindParams($stmt, $params, $types) {
        $bindParams = [];
        $bindParams[] = $types;
        foreach ($params as &$param) {
            $bindParams[] = &$param;
        }
        $ref = new ReflectionClass('mysqli_stmt');
        $method = $ref->getMethod('bind_param');
        $method->invokeArgs($stmt, $bindParams);
    }    
    
    private function filterDisplayedProducts($products, $listItems) {
        return array_filter($products, function($product) use ($listItems) {
            return !in_array($product['name'], $listItems);
        });
    }

    // Update preferences method
    public function updatePreferences($userId, $productName) {
        $stmt = $this->conn->prepare("SELECT id, count FROM preferences WHERE user_id = ? AND preference_name = ?");
        $stmt->bind_param("is", $userId, $productName);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['count'] + 1;
            $id = $row['id'];
            $updateStmt = $this->conn->prepare("UPDATE preferences SET count = ? WHERE id = ?");
            $updateStmt->bind_param("ii", $count, $id);
            $updateStmt->execute();
            $updateStmt->close();
        } else {
            $insertStmt = $this->conn->prepare("INSERT INTO preferences (user_id, preference_name, preference_value, count) VALUES (?, ?, ?, 1)");
            $insertStmt->bind_param("iss", $userId, $productName, $productName);
            $insertStmt->execute();
            $insertStmt->close();
        }

        $stmt->close();
    }

    public function getListItems($list_id) {
        $sql = "SELECT * FROM items WHERE list_id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $list_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
        $stmt->close();
        return $items;
    }

    public function removeFromFav($item_name, $userId) {
        $listName = "Favourites";
        $stmt = $this->conn->prepare("SELECT id FROM lists WHERE user_id = ? AND name = ?");
        $stmt->bind_param("is", $userId, $listName);
        $stmt->execute();
        $result = $stmt->get_result();
        
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
            return false; // 'Favourites' list was not found
        }
    }

    public function removeProductFromList($item_name, $list_name, $userId) {
        $listName = $list_name;
        $stmt = $this->conn->prepare("SELECT id FROM lists WHERE user_id = ? AND name = ?");
        $stmt->bind_param("is", $userId, $listName);
        $stmt->execute();
        $result = $stmt->get_result();
        
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
            return false; //list was not found
        }
    }
    

    public function addList($list_name, $user_id) {
        $stmt = $this->conn->prepare("INSERT INTO lists (name, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $list_name, $user_id);
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
    

    public function addToFav($item_name, $item_price, $userId) {
        $listName = 'Favourites';
        $stmt = $this->conn->prepare("SELECT id FROM lists WHERE user_id = ? AND name = ?");
        $stmt->bind_param("is", $userId, $listName);
        $stmt->execute();
        $result = $stmt->get_result();
        
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
            // 'Favourites' list was not found
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
