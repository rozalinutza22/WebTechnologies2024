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

    public function addList($list_name) {
        $sql = "INSERT INTO lists (name) VALUES ('$list_name')";
        if ($this->conn->query($sql) === TRUE) {
            return true;
        } else {
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
