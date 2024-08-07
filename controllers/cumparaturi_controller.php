<?php
require_once(dirname(__DIR__).'/public/fpdf.php');
session_start();

include(dirname(__DIR__).'/models/cumparaturi_model.php');
$model = new ShoppingListModel();

// userId from sessions for when it will be set up
$userId = $_SESSION['user_id'];


// Handle add list request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_list'])) {
    $list_name = $_POST['list_name'];
    $model->addList($list_name, $userId); 
    // Redirect to refresh the page after adding the list
    header("Location: /lists");
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
    $model->addToFav($item_name, $item_price, $userId);
    $model->updatePreferences($userId, $item_name);
    // Redirect to refresh the page after adding the list
    header("Location: /lists");
    exit();
}

//Handle view details button with redirect to product page
if (isset($_POST['view_details'])) {
    $item_name = $_POST['product_name'];
    $model->updatePreferences($userId, $item_name);
    // Redirect to the product details page
    header("Location: /product?name=" . urlencode($item_name));
    exit();
}

//Handle add to list button with redirect to select lists page
if (isset($_POST['add_to_list'])) {
    $item_name = $_POST['product_name'];
    $item_price = $_POST['product_price'];
    $model->updatePreferences($userId, $item_name);
    // Redirect to the product details page
    header("Location: /selectList?name=" . urlencode($item_name));
    exit();
}

//Handle remove item from favourites request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_favourites'])) {
    $item_name = $_POST['item_name'];
    $model->removeFromFav($item_name, $userId);
    // Redirect to refresh the page after adding the list
    header("Location: /lists"); 
    exit();
}

//Handle remove item from list request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_item_from_list'])) {
    $list_name = $_POST['list_name'];
    $item_name = $_POST['item_name'];
    $model->removeProductFromList($item_name, $list_name, $userId);
    // Redirect to refresh the page after adding the list
    header("Location: /lists"); 
    exit();
}

//Export user's statistics
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export_json'])) {
    $userData = $model->getStatisticsData($_SESSION['user_id']);
    $id = $_SESSION['user_id'];

    if ($userData) {
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="user_' . $id . '.json"');
    
        echo json_encode($userData);
        exit;
    } else {
        echo "User not found";
        header("Location: /menu"); 
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export_csv'])) {
    $userData = $model->getStatisticsData($_SESSION['user_id']);
    $id = $_SESSION['user_id'];

    if ($userData) {
        $csvData = [$userData];

        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="user_' . $id . '.csv"');

        $output = fopen('php://output', 'w');

        foreach ($csvData as $row) {
            fputcsv($output, [$row]); 
        }

        fclose($output);
        exit;
    } else {
        echo "User not found";
        header("Location: /menu"); 
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export_pdf'])) {
    $userData = $model->getStatisticsData($_SESSION['user_id']);
    $id = $_SESSION['user_id'];

    if ($userData) {
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);

        $pdf->Cell(0, 10, 'User Statistics', 0, 1, 'C');
        $pdf->Ln(10);

        $pdf->SetFont('Arial', '', 12);
        $pdf->MultiCell(0, 10, $userData);

        $pdf->Output('D', 'user_statistics_' . $id . '.pdf');
        exit;
    } else {
        echo "User not found";
        header("Location: /menu");
        exit();
    }
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
$lists = $model->getAllLists($userId);

// Fetch recommended products for the current user 
$recommendedProducts = $model->showRecommendedProducts($userId);

include(dirname(__DIR__).'/views/cumparaturi_view.php');

?>