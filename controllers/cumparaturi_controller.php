<?php

include(dirname(__DIR__).'/models/cumparaturi_model.php');
include(dirname(__DIR__).'/views/cumparaturi_view.php');
$model = new ShoppingListModel();

// Handle add list request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_list'])) {
    $list_name = $_POST['list_name'];
    $model->addList($list_name);
    // Redirect to refresh the page after adding the list
    //header("Location: /lists"); //doesnt want to redirect bc of css
    exit();
}

// Handle delete list request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_list'])) {
    $list_id = $_POST['list_id'];
    $model->deleteList($list_id);
    // Redirect to refresh the page after adding the list
   // header("Location: /lists");
    exit();
}

// Function to calculate total of items in a list
function calculateTotal($items) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}

// Fetch all lists
$lists = $model->getAllLists();

// // Include the view file
require_once '../views/cumparaturi_view.php';
?>