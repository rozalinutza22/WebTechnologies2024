<?php

include(dirname(__DIR__).'/models/product_model.php');
$model = new ProductModel();

// userId from sessions
$userId = isset($_SESSION['userId']) ? (int)$_SESSION['userId'] : null;

function handleProductDetails() {
    global $model;
    if (isset($_GET['name'])) {
        $productName = $_GET['name'];
        $productDetails = $model->getProductByName($productName);
        if ($productDetails) {
            require_once '../views/product_view.php';
        } else {
            echo "Product not found.";
        }
    } else {
        echo "Product name not provided.";
    }
}

handleProductDetails();

// include(dirname(__DIR__).'/views/product_view.php');

?>