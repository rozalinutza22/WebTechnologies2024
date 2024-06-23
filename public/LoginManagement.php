<?php

session_start();

class LoginManager {
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

    public function processRequest($method) {
        switch ($method) {
            case "POST": 
                $this->check_login();
                break;
            // Handle other HTTP methods (POST, PUT, DELETE) 
            default:
                echo "Unsupported HTTP method.";
                break;
        }
    }
    public function check_login() {
        $data = (array) json_decode(file_get_contents("php://input"), true);

        if (isset($data['emailAdress']) && isset($data['passwrd'])) {
            $emailAdress = $data['emailAdress'];
            $passwrd = $data['passwrd'];

            $stmt = $this->conn->prepare("SELECT * FROM users WHERE emailAdress = ?");
            $stmt->bind_param("s", $emailAdress);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashed_password = $row['passwrd'];

                if (password_verify($passwrd, $hashed_password)) {


                    echo "Login successful. User ID: " . $row['id'];
                    $email = $row['emailAdress'];
                    $password = $row['passwrd'];
                    $id = $row['id'];

                    $_SESSION["user_email_API"] = $row['emailAdress'];
                    $_SESSION["user_fname_API"] = $row['firstName'];
                    $_SESSION["user_lname_API"] = $row['lastName'];
                    $_SESSION["user_phone_API"] = $row['phoneNumber'];
                    $_SESSION["allergens_API"] = $row['allergens'];
                    $_SESSION["admin_API"] = $row['admin'];
                    $_SESSION['vegetarian_API'] = $row['vegetarian'];
                    $_SESSION['user_id_API'] = $row['id'];

                    // setcookie('API_email', $email, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                    // setcookie('API_password', $password, time() + (30 * 24 * 60 * 60), '/'); // 30 days
                    // setcookie('API_id', $id, time() + (30 * 24 * 60 * 60), '/');


                } else {
                    echo "Incorrect password.";
                }
            } else {
                echo "User not found.";
            }

            $stmt->close();
        } else {
            echo "Email and password are required.";
        }
    }
}
?>
