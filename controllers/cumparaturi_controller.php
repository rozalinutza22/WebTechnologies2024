<?php

include '../models/cumparaturi_model.php';
include '../views/cumparaturi_view.php';

$model = new ShoppingListModel();

// Handle actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['list_name']) && !empty($_POST['list_name'])) {
        $list_name = $_POST['list_name'];
        $model->addList($list_name);
    }
}

// Fetch lists
$lists = $model->getAllLists();

// Display the view
displayLists($lists);

$model->closeConnection();
?>
