<?php
    include(dirname(__DIR__).'/models/menu_model.php');

    $model = new MenuModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_product'])) {
        $product_name = $_POST['search'];
        $searchResults = $model->getProductDetails($product_name);
        $allProducts = $model->getAllProducts();

        session_start();
        $_SESSION["searchResults"] = $searchResults;
        $_SESSION["allProducts"] = $allProducts;
        header("Location: /menu"); 
        exit();
    }

    include(dirname(__DIR__).'/views/menu.php');

?>