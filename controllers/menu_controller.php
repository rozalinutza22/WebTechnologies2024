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

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_category'])) {
        $category_name = $_POST['search_ct'];
        $searchResults = $model->getCategoryProducts($category_name);

        session_start();
        $_SESSION["searchByCat"] = $searchResults;
        header("Location: /menu"); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter_name'])) {
        $productsByName = $model->filterByName();

        session_start();
        $_SESSION["productsByName"] = $productsByName;
        header("Location: /menu"); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter_price'])) {
        $productsByPrice = $model->filterByPrice();

        session_start();
        $_SESSION["productsByPrice"] = $productsByPrice;
        header("Location: /menu"); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['filter_perishability'])) {
        $productsByPerishability = $model->filterByPerishability();

        session_start();
        $_SESSION["productsByPerishability"] = $productsByPerishability;
        header("Location: /menu"); 
        exit();
    }



    include(dirname(__DIR__).'/views/menu.php');

?>