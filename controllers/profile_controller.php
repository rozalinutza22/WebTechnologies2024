<?php
    include(dirname(__DIR__).'/models/profile_model.php');
    $model = new DeleteAccModel();
    session_start();
    $email = $_SESSION['user_email'];
    $_SESSION['user_id'] = $model->getId($email);

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete-user'])) {
        $res = $model->deleteUserLists($_SESSION['user_id']);
        $allProducts = $model->deleteUserPref($_SESSION['user_id']);
        $all = $model ->deleteUser($_SESSION['user_id']);
    
        header("Location: /principal"); 
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['export'])) {
        $userData = $model->exportJson($_SESSION['user_id']);
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
        $userData = $model->exportJson($_SESSION['user_id']);
        $id = $_SESSION['user_id'];

        if ($userData) {
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="user_' . $id . '.csv"');
            
            $output = fopen('php://output', 'w');
            
            fputcsv($output, array_keys($userData));
            
            fputcsv($output, $userData);
            
            fclose($output);
        } else {
            echo "User not found";
            header("Location: /menu"); 
            exit();
        }
    }
?>