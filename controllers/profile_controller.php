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
        $res = $model->exportJson($_SESSION['user_id']);
        $id = $_SESSION['user_id'];

        if (!empty($res)) {
            $jsonData = json_encode($res, JSON_PRETTY_PRINT);
            
            $filePath = 'C:\Users\helen.ro\Downloads\\user_' . $id . '_data.json';
        
            if (file_put_contents($filePath, $jsonData)) {
                echo "Location: " . $filePath;
            } else {
                echo "Error, could not write the data.";
            }
        } else {
            header("Location: /menu"); 
            exit();
        }
    
        header("Location: /profile"); 
        exit();
    }
?>