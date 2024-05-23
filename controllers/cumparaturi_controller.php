<?php

include(dirname(__DIR__).'/models/cumparaturi_model.php');
include(dirname(__DIR__).'/views/cumparaturi_view.php');

$model = new ShoppingListModel();

// Handle actions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_list'])) { // Check if the "Add List" button was clicked
        if (isset($_POST['list_name']) && !empty($_POST['list_name'])) {
            $list_name = $_POST['list_name'];
            $model->addList($list_name);
        }
        // Redirect to the same page after adding the list
        header("Location: cumparaturi.php");
        exit();
    }

    if (isset($_POST['delete_list'])) { // Check if the "Delete" button was clicked
        $list_id = $_POST['list_id'];
        $model->deleteList($list_id);
        // Redirect to the same page after deleting the list
        header("Location: cumparaturi.php");
        exit();
    }
}

// Fetch lists
$lists = $model->getAllLists();

// Display the view
displayLists($lists, $model);

$model->closeConnection();
?>
