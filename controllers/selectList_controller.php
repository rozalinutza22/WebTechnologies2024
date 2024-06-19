<?php
session_start();
require_once(dirname(__DIR__).'/models/selectList_model.php');

$model = new SelectListModel();

$userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

if (!$userId) {
    die("User not logged in.");
}

$lists = $model->getAllLists($userId);

function handleProductDetails($model) {
    if (isset($_GET['name'])) {
        $productName = $_GET['name'];
        $productDetails = $model->getProductByName($productName);
        if ($productDetails) {
            return $productDetails;
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Product name not provided.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_item_to_list'])) {
    $product = handleProductDetails($model);

    if($product){
    $product_name = $product['name'];
    $product_price = $product['price'];
    $list_id = $_POST['list_id'];

    // Call the model function to add the product to the list
    if ($model->addProductToList($list_id, $product_name, $product_price)) {
        echo "Product added to list successfully!";
    } else {
        echo "Failed to add product to list.";
    }

    // Redirect back to the main page
    header("Location: /lists");
    exit();
}
}

include(dirname(__DIR__).'/views/select_list_page.php');

?>
