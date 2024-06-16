<?php

include(dirname(__DIR__).'/models/product_model.php');
$model = new ProductModel();

// userId from cookies for when it will be set up
//$userId = isset($_COOKIE['userId']) ? (int)$_COOKIE['userId'] : null;
$userId = 1;


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