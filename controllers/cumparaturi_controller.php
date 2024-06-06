<?php

include(dirname(__DIR__).'/models/cumparaturi_model.php');
$model = new ShoppingListModel();

// Handle add list request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_list'])) {
    $list_name = $_POST['list_name'];
    $model->addList($list_name);
    // Redirect to refresh the page after adding the list
    header("Location: /lists"); //doesnt want to redirect bc of css
    exit();
}

// Handle delete list request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_list'])) {
    $list_id = $_POST['list_id'];
    $model->deleteList($list_id);
    // Redirect to refresh the page after adding the list
    header("Location: /lists");
    exit();
}

//Handle add to favourites request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_favourites'])) {
    $item_name = $_POST['product_name'];
    $item_price = $_POST['product_price'];
    $model->addToFav($item_name, $item_price);
    // Redirect to refresh the page after adding the list
    header("Location: /lists"); //doesnt want to redirect bc of css
    exit();
}

//Handle remove item from favourites request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_favourites'])) {
    $item_name = $_POST['item_name'];
    $model->removeFromFav($item_name);
    // Redirect to refresh the page after adding the list
    header("Location: /lists"); //doesnt want to redirect bc of css
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

include(dirname(__DIR__).'/views/cumparaturi_view.php');

// Include the view file
// require_once '../views/cumparaturi_view.php';
?>