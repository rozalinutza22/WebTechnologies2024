<?php
session_start();
include(dirname(__DIR__).'/models/selectList_model.php');
$model = new SelectListModel();

$userId = isset($_SESSION['user_id']) ? (int)$_SESSION['user_id'] : null;

function handleProductDetails() {
    global $model;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_list'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
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
?>
