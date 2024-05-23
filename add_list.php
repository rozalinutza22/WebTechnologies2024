<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopping_lists_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $list_name = $_POST['list_name'];

    $sql = "INSERT INTO lists (name) VALUES ('$list_name')";
    if ($conn->query($sql) === TRUE) {
        echo "New list created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

header("Location: cumparaturi.php"); // Redirect back to the lists page
exit();
?>
